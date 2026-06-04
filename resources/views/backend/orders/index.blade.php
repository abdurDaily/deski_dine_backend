@extends('dashboard')
@section('title', 'Orders')
@section('content')
    <x-breadcrumb></x-breadcrumb>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Orders</h4>
                    <div class="d-flex align-items-center">
                        <input id="ordersSearch" type="search" class="form-control me-2" placeholder="Search by name, phone, card number" />
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered yajra-datatable w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Phone</th>
                                    <th>Card Number</th>
                                    <th>Member</th>
                                    <th>Total</th>
                                    <th>Discount</th>
                                    <th>Final</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Details Modal -->
    <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white d-flex align-items-center justify-content-between">
                    <h5 class="modal-title fw-bold" id="orderDetailsModalLabel">
                        <i class="fas fa-file-invoice me-2"></i> Order Details
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close" style="background:none; border:none; font-size:1.5rem; color:#fff; opacity:0.8;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="orderDetailsModalBody">
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted">Fetching order information...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            const table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('orders.index') }}',
                    data: function(d) {
                        d.search.value = $('#ordersSearch').val();
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'customer_name', name: 'customer_name' },
                    { data: 'customer_phone', name: 'customer_phone' },
                    { data: 'card_number', name: 'unique_card_number' },
                    { data: 'member', name: 'member.name', orderable: false, searchable: false },
                    { data: 'total', name: 'total_amount' },
                    { data: 'discount', name: 'discount_amount' },
                    { data: 'final', name: 'final_amount' },
                    { data: 'status_name', name: 'status' },
                    { data: 'date', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                order: [[9, 'desc']],
                drawCallback: function() {
                    $('[data-bs-toggle="tooltip"]').tooltip();
                }
            });

            $('#ordersSearch').on('keyup change clear', function() {
                table.search(this.value).draw();
            });

            // View details AJAX handler
            $(document).on('click', '.view-order-btn', function() {
                const url = $(this).data('url');
                const modal = $('#orderDetailsModal');
                const body = $('#orderDetailsModalBody');
                
                body.html('<div class="text-center py-5"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div><p class="mt-2 text-muted">Fetching order information...</p></div>');
                modal.modal('show');
                
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        body.html(data);
                    },
                    error: function(xhr) {
                        body.html('<div class="alert alert-danger m-3">Failed to load order details. Please try again.</div>');
                    }
                });
            });

            // Update order status AJAX handler
            $(document).on('submit', '#updateOrderStatusForm', function(e) {
                e.preventDefault();
                const form = $(this);
                const submitBtn = $('#saveOrderStatusBtn');
                const url = form.data('action-url');
                
                submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span>Saving...');
                
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: form.serialize(),
                    success: function(res) {
                        submitBtn.prop('disabled', false).html('<i class="fas fa-save me-1"></i> Save Changes');
                        if (res.success) {
                            $('#orderDetailsModal').modal('hide');
                            table.draw(false);
                            if (typeof toastr !== 'undefined') {
                                toastr.success(res.message);
                            } else {
                                alert(res.message);
                            }
                        }
                    },
                    error: function(xhr) {
                        submitBtn.prop('disabled', false).html('<i class="fas fa-save me-1"></i> Save Changes');
                        const msg = xhr.responseJSON?.message || 'Failed to update order status.';
                        alert(msg);
                    }
                });
            });
        });
    </script>
@endpush
