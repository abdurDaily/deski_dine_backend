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
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
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
                    { data: 'date', name: 'created_at' }
                ],
                order: [[9, 'desc']],
                drawCallback: function() {
                    $('[data-bs-toggle="tooltip"]').tooltip();
                }
            });

            $('#ordersSearch').on('keyup change clear', function() {
                table.search(this.value).draw();
            });
        });
    </script>
@endpush
