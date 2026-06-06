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
                <div class="card-header bg-light border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">All Reviews</h5>
                    <div class="search-box">
                        <input type="text" id="searchInput" placeholder="Search by name, email, or comment...">
                    </div>
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
                    <div class="d-flex justify-content-between align-items-center p-3">
                        <div id="paginationInfo" class="flex-grow-1"></div>
                    </div>
                    <ul id="reviewsPagination" class="pagination mb-3"></ul>
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

@push('styles')
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

    .reviews-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        gap: 1rem;
    }

    .search-box {
        flex: 1;
        max-width: 400px;
    }

    .search-box input {
        padding: 0.5rem 1rem;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        font-size: 0.9rem;
    }

    .search-box input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    #reviewsPagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        justify-content: center;
        gap: 0.25rem;
        margin-top: 1.5rem;
    }

    #reviewsPagination .page-item .page-link {
        padding: 0.5rem 0.75rem;
        border: 1px solid #dee2e6;
        color: #667eea;
        text-decoration: none;
        border-radius: 4px;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }

    #reviewsPagination .page-item .page-link:hover {
        background-color: #f8f9fa;
        border-color: #667eea;
    }

    #reviewsPagination .page-item.active .page-link {
        background-color: #667eea;
        border-color: #667eea;
        color: white;
    }

    #paginationInfo {
        text-align: center;
        font-size: 0.875rem;
        color: #666;
        margin-top: 0.5rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    let currentPage = 1;
    const perPage = 10;

    function loadReviews(page = 1, search = '') {
        currentPage = page;
        
        console.log('loadReviews called with page:', page, 'search:', search);
        console.log('URL:', "{{ route('admin.reviews.index') }}");
        
        $.ajax({
            url: "{{ route('admin.reviews.index') }}",
            type: 'GET',
            data: {
                page: page,
                search: search
            },
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            success: function(response) {
                console.log('✓ AJAX success - Full response:', response);
                console.log('✓ response.success:', response.success);
                console.log('✓ response.data type:', typeof response.data);
                console.log('✓ response.data:', response.data);
                console.log('✓ response.data is array:', Array.isArray(response.data));
                console.log('✓ response.data length:', response.data ? response.data.length : 'N/A');
                console.log('✓ response.pagination:', response.pagination);
                
                if (response.success && Array.isArray(response.data)) {
                    console.log('Rendering', response.data.length, 'reviews');
                    renderTable(response.data);
                    renderPagination(response.pagination);
                } else {
                    console.error('✗ Invalid response structure');
                    renderTable([]);
                    if (response.pagination) renderPagination(response.pagination);
                }
            },
            error: function(xhr, status, error) {
                console.error('✗ AJAX error');
                console.error('Status:', status);
                console.error('Error:', error);
                console.error('XHR status code:', xhr.status);
                console.error('XHR responseText:', xhr.responseText);
                console.error('XHR responseJSON:', xhr.responseJSON);
                toastr.error('Error loading reviews: ' + (error || xhr.status || 'Unknown error'));
            }
        });
    }

    function renderTable(data) {
        const tbody = $('#reviewsTable tbody');
        tbody.empty();

        if (data.length === 0) {
            tbody.html('<tr><td colspan="9" class="text-center text-muted py-4">No reviews found</td></tr>');
            return;
        }

        data.forEach(row => {
            const tr = $('<tr></tr>');
            tr.append(`<td>${row.DT_RowIndex}</td>`);
            tr.append(`<td>${row.name_with_image}</td>`);
            tr.append(`<td>${row.email_display}</td>`);
            tr.append(`<td>${row.rating_display}</td>`);
            tr.append(`<td>${row.title}</td>`);
            tr.append(`<td>${row.comment_preview}</td>`);
            tr.append(`<td>${row.status_badge}</td>`);
            tr.append(`<td>${row.created_at}</td>`);
            tr.append(`<td>${row.action}</td>`);
            tbody.append(tr);
        });

        // Rebind event handlers after rendering
        bindActionHandlers();
    }

    function renderPagination(pagination) {
        const paginationContainer = $('#reviewsPagination');
        paginationContainer.empty();

        // Previous button
        if (pagination.current_page > 1) {
            paginationContainer.append(`
                <li class="page-item">
                    <a class="page-link" href="#" onclick="loadReviews(1, getSearchValue()); return false;">First</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" onclick="loadReviews(${pagination.current_page - 1}, getSearchValue()); return false;">Previous</a>
                </li>
            `);
        }

        // Page numbers
        const maxPagesToShow = 5;
        let startPage = Math.max(1, pagination.current_page - Math.floor(maxPagesToShow / 2));
        let endPage = Math.min(pagination.total_pages, startPage + maxPagesToShow - 1);
        
        if (endPage - startPage < maxPagesToShow - 1) {
            startPage = Math.max(1, endPage - maxPagesToShow + 1);
        }

        for (let i = startPage; i <= endPage; i++) {
            const activeClass = i === pagination.current_page ? 'active' : '';
            paginationContainer.append(`
                <li class="page-item ${activeClass}">
                    <a class="page-link" href="#" onclick="loadReviews(${i}, getSearchValue()); return false;">${i}</a>
                </li>
            `);
        }

        // Next button
        if (pagination.current_page < pagination.total_pages) {
            paginationContainer.append(`
                <li class="page-item">
                    <a class="page-link" href="#" onclick="loadReviews(${pagination.current_page + 1}, getSearchValue()); return false;">Next</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" onclick="loadReviews(${pagination.total_pages}, getSearchValue()); return false;">Last</a>
                </li>
            `);
        }

        // Update info
        $('#paginationInfo').text(`Showing ${pagination.from} to ${pagination.to} of ${pagination.total} reviews`);
    }

    function getSearchValue() {
        return $('#searchInput').val();
    }

    function bindActionHandlers() {
        // View Review
        $(document).off('click', '.btn-view').on('click', '.btn-view', function() {
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
        $(document).off('click', '#modalApproveBtn').on('click', '#modalApproveBtn', function() {
            const id = $(this).data('id');
            $.ajax({
                url: '{{ route("admin.reviews.approve", ":id") }}'.replace(':id', id),
                type: 'POST',
                data: {_token: '{{ csrf_token() }}'},
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        bootstrap.Modal.getInstance(document.getElementById('viewReviewModal')).hide();
                        loadReviews(currentPage, getSearchValue());
                    }
                },
                error: function() {
                    toastr.error('Failed to approve review');
                }
            });
        });

        // Reject Review
        $(document).off('click', '#modalRejectBtn').on('click', '#modalRejectBtn', function() {
            const id = $(this).data('id');
            $.ajax({
                url: '{{ route("admin.reviews.reject", ":id") }}'.replace(':id', id),
                type: 'POST',
                data: {_token: '{{ csrf_token() }}'},
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        bootstrap.Modal.getInstance(document.getElementById('viewReviewModal')).hide();
                        loadReviews(currentPage, getSearchValue());
                    }
                },
                error: function() {
                    toastr.error('Failed to reject review');
                }
            });
        });

        // Approve from button
        $(document).off('click', '.btn-approve').on('click', '.btn-approve', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            $.ajax({
                url: '{{ route("admin.reviews.approve", ":id") }}'.replace(':id', id),
                type: 'POST',
                data: {_token: '{{ csrf_token() }}'},
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        loadReviews(currentPage, getSearchValue());
                    }
                },
                error: function() {
                    toastr.error('Failed to approve review');
                }
            });
        });

        // Reject from button
        $(document).off('click', '.btn-reject').on('click', '.btn-reject', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            $.ajax({
                url: '{{ route("admin.reviews.reject", ":id") }}'.replace(':id', id),
                type: 'POST',
                data: {_token: '{{ csrf_token() }}'},
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        loadReviews(currentPage, getSearchValue());
                    }
                },
                error: function() {
                    toastr.error('Failed to reject review');
                }
            });
        });

        // Delete review
        $(document).off('click', '.btn-delete').on('click', '.btn-delete', function(e) {
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
                        loadReviews(currentPage, getSearchValue());
                    }
                },
                error: function() {
                    toastr.error('Failed to delete review');
                }
            });
        });
    }

    // Search functionality
    let searchTimeout;
    $('#searchInput').on('keyup', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            loadReviews(1, getSearchValue());
        }, 300);
    });

    // Initial load
    $(function() {
        console.log('Document ready - triggering initial load');
        loadReviews(1);
    });
</script>
@endpush

@endsection
