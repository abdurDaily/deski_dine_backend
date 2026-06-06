@extends('components.admin-master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Reviews Management</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Reviews</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm stats-card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-2 small fw-bold">
                                <i class="bi bi-chat-dots me-1"></i>TOTAL REVIEWS
                            </p>
                            <h2 class="mb-0 fw-bold" style="color: #333; font-size: 2.5rem;">{{ $reviews->total() }}</h2>
                        </div>
                        <div class="avatar-lg" style="background: linear-gradient(135deg, #667eea20 0%, #764ba220 100%); border-radius: 12px; padding: 1rem; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-chat-left-quote" style="font-size: 2rem; color: #667eea;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm stats-card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-2 small fw-bold">
                                <i class="bi bi-hourglass-bottom me-1"></i>PENDING APPROVAL
                            </p>
                            <h2 class="mb-0 fw-bold" style="color: #f39c12; font-size: 2.5rem;">{{ $pending }}</h2>
                        </div>
                        <div style="background: #f39c1220; border-radius: 12px; padding: 1rem; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-clock-history" style="font-size: 2rem; color: #f39c12;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm stats-card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-2 small fw-bold">
                                <i class="bi bi-check-circle me-1"></i>APPROVED
                            </p>
                            <h2 class="mb-0 fw-bold" style="color: #28a745; font-size: 2.5rem;">{{ $approved }}</h2>
                        </div>
                        <div style="background: #28a74520; border-radius: 12px; padding: 1rem; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-check-circle-fill" style="font-size: 2rem; color: #28a745;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm stats-card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-2 small fw-bold">
                                <i class="bi bi-x-circle me-1"></i>REJECTED
                            </p>
                            <h2 class="mb-0 fw-bold" style="color: #dc3545; font-size: 2.5rem;">{{ $rejected }}</h2>
                        </div>
                        <div style="background: #dc354520; border-radius: 12px; padding: 1rem; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-x-circle-fill" style="font-size: 2rem; color: #dc3545;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light border-0">
                    <h5 class="mb-0">All Reviews</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="reviewsTable" class="table reviews-datatable table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Rating</th>
                                    <th>Title</th>
                                    <th>Comment</th>
                                    <th>Status</th>
                                    <th>Submitted</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Review Modal -->
<div class="modal fade" id="viewReviewModal" tabindex="-1" role="dialog" aria-labelledby="viewReviewTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewReviewTitle">Review Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-3 text-center">
                        <img id="modalImage" src="" alt="Member Photo" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 1rem;" />
                    </div>
                    <div class="col-md-9">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Name:</strong>
                                <p id="modalName" class="text-muted"></p>
                            </div>
                            <div class="col-md-6">
                                <strong>Email:</strong>
                                <p id="modalEmail" class="text-muted"></p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Rating:</strong>
                                <p id="modalRating" class="text-muted"></p>
                            </div>
                            <div class="col-md-6">
                                <strong>Status:</strong>
                                <p id="modalStatus" class="text-muted"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <strong>Title:</strong>
                    <p id="modalTitle" class="text-muted"></p>
                </div>

                <div class="mb-3">
                    <strong>Comment:</strong>
                    <p id="modalComment" class="text-muted" style="line-height: 1.6;"></p>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <strong>Submitted:</strong>
                        <p id="modalCreated" class="text-muted"></p>
                    </div>
                    <div class="col-md-6">
                        <strong>Approved:</strong>
                        <p id="modalApproved" class="text-muted"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="modalApproveBtn">Approve</button>
                <button type="button" class="btn btn-danger" id="modalRejectBtn">Reject</button>
            </div>
        </div>
    </div>
</div>

@push('back_css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
<style>
    .stats-card {
        transition: all 0.3s ease;
        border-radius: 12px !important;
    }

    .stats-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12) !important;
    }

    .stats-card .avatar-lg {
        min-width: 80px;
    }

    .table thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #e9ecef;
        font-weight: 600;
        color: #333;
        padding: 1rem 0.75rem;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table tbody td {
        vertical-align: middle;
        padding: 1rem 0.75rem;
        border-bottom: 1px solid #f0f0f0;
    }

    .table tbody tr:hover {
        background-color: #f9f9f9;
    }

    .badge {
        padding: 0.5rem 0.75rem;
        font-weight: 500;
        border-radius: 6px;
    }

    .btn-outline-primary,
    .btn-outline-success,
    .btn-outline-danger {
        border-width: 1.5px;
        font-size: 0.85rem;
        padding: 0.4rem 0.6rem;
        transition: all 0.2s ease;
    }

    .btn-outline-primary:hover {
        background-color: #667eea;
        border-color: #667eea;
        color: white;
    }

    .btn-outline-success:hover {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }

    .btn-group-sm .btn {
        padding: 0.5rem 0.6rem;
        margin: 0 2px;
    }

    .dataTables_wrapper {
        padding: 0;
    }

    .dataTables_paginate {
        padding-top: 1rem;
    }

    .page-item.active .page-link {
        background-color: #667eea;
        border-color: #667eea;
    }

    .page-link {
        color: #667eea;
    }

    .page-link:hover {
        color: #667eea;
        background-color: #f8f9fa;
    }
</style>
@endpush

@push('back_js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
    $(function() {
        let table = $('.reviews-datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            pageLength: 10,
            ajax: "{{ route('admin.reviews.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '60px'},
                {data: 'name_with_image', name: 'name', orderable: false},
                {data: 'email_display', name: 'email'},
                {data: 'rating_display', name: 'rating', orderable: false},
                {data: 'title', name: 'title'},
                {data: 'comment_preview', name: 'comment'},
                {data: 'status_badge', name: 'status', orderable: false},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        // View Review
        $(document).on('click', '.btn-view', function() {
            const btn = $(this);
            $('#modalImage').attr('src', btn.data('image') || 'https://i.pravatar.cc/80?u=' + encodeURIComponent(btn.data('name')));
            $('#modalName').text(btn.data('name'));
            $('#modalEmail').text(btn.data('email'));
            $('#modalTitle').text(btn.data('title') || '-');
            $('#modalComment').text(btn.data('comment'));
            $('#modalCreated').text(btn.data('created'));
            $('#modalApproved').text(btn.data('approved') || '-');
            
            const rating = btn.data('rating');
            let stars = '';
            for (let i = 1; i <= 5; i++) {
                if (i <= rating) {
                    stars += '<i class="bi bi-star-fill" style="color: #f39c12;"></i>';
                } else {
                    stars += '<i class="bi bi-star" style="color: #ddd;"></i>';
                }
            }
            $('#modalRating').html(stars);
            
            const status = btn.data('status');
            let statusBadge = 'bg-warning';
            if (status === 'approved') statusBadge = 'bg-success';
            if (status === 'rejected') statusBadge = 'bg-danger';
            $('#modalStatus').html('<span class="badge ' + statusBadge + '">' + status + '</span>');
            
            $('#modalApproveBtn').data('id', btn.data('id'));
            $('#modalRejectBtn').data('id', btn.data('id'));
            
            new bootstrap.Modal(document.getElementById('viewReviewModal')).show();
        });

        // Approve Review
        $(document).on('click', '#modalApproveBtn', function() {
            const id = $(this).data('id');
            $.ajax({
                url: '{{ route("admin.reviews.approve", ":id") }}'.replace(':id', id),
                type: 'POST',
                data: {_token: '{{ csrf_token() }}'},
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        bootstrap.Modal.getInstance(document.getElementById('viewReviewModal')).hide();
                        table.draw();
                    }
                },
                error: function() {
                    toastr.error('Failed to approve review');
                }
            });
        });

        // Reject Review
        $(document).on('click', '#modalRejectBtn', function() {
            const id = $(this).data('id');
            $.ajax({
                url: '{{ route("admin.reviews.reject", ":id") }}'.replace(':id', id),
                type: 'POST',
                data: {_token: '{{ csrf_token() }}'},
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        bootstrap.Modal.getInstance(document.getElementById('viewReviewModal')).hide();
                        table.draw();
                    }
                },
                error: function() {
                    toastr.error('Failed to reject review');
                }
            });
        });

        // Approve from button
        $(document).on('click', '.btn-approve', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            $.ajax({
                url: '{{ route("admin.reviews.approve", ":id") }}'.replace(':id', id),
                type: 'POST',
                data: {_token: '{{ csrf_token() }}'},
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        table.draw();
                    }
                },
                error: function() {
                    toastr.error('Failed to approve review');
                }
            });
        });

        // Reject from button
        $(document).on('click', '.btn-reject', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            $.ajax({
                url: '{{ route("admin.reviews.reject", ":id") }}'.replace(':id', id),
                type: 'POST',
                data: {_token: '{{ csrf_token() }}'},
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        table.draw();
                    }
                },
                error: function() {
                    toastr.error('Failed to reject review');
                }
            });
        });

        // Delete review
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            if (!confirm('Are you sure?')) return;
            
            const id = $(this).data('id');
            $.ajax({
                url: '{{ route("admin.reviews.delete", ":id") }}'.replace(':id', id),
                type: 'DELETE',
                data: {_token: '{{ csrf_token() }}'},
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        table.draw();
                    }
                },
                error: function() {
                    toastr.error('Failed to delete review');
                }
            });
        });
    });
</script>
@endpush

@endsection
