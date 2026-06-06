@extends('dashboard')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .datatable-wrapper {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }

        .branch-datatable {
            margin-bottom: 0;
        }

        .branch-datatable thead th {
            background: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
            font-weight: 600;
            color: #495057;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1rem;
        }

        .branch-datatable tbody td {
            padding: 0.9rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
        }

        .branch-datatable tbody tr:hover {
            background-color: #f8f9fa;
        }

        .branch-datatable tbody tr {
            transition: background-color 0.2s;
        }

        .badge {
            font-weight: 500;
            padding: 0.5rem 0.75rem;
            font-size: 0.8rem;
        }

        .btn-sm {
            padding: 0.4rem 0.7rem;
            font-size: 0.8rem;
        }

        .add-new-btn {
            padding: 0.6rem 1.2rem;
            font-weight: 500;
        }

        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }

        .modal-header .modal-title {
            color: white;
            font-weight: 600;
        }

        .modal-header .btn-close {
            filter: invert(1);
        }

        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .detail-section {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
        }

        .detail-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.3rem;
        }

        .detail-value {
            font-size: 1rem;
            color: #212529;
            font-weight: 500;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-header h3 {
            font-weight: 700;
            color: #212529;
            margin-bottom: 0.25rem;
        }

        .page-header .text-muted {
            font-size: 0.95rem;
        }

        .header-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        table.dataTable {
            width: 100% !important;
        }

        .delivery-service {
            background: #f0f3ff;
            border-left: 3px solid #667eea;
            padding: 0.8rem;
            margin-bottom: 0.8rem;
            border-radius: 4px;
        }

        .delivery-service-label {
            font-weight: 600;
            color: #667eea;
            font-size: 0.9rem;
        }

        .delivery-service-value {
            color: #212529;
            word-break: break-all;
            margin-top: 0.3rem;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-4">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="header-actions">
                    <div class="page-header">
                        <h3 class="mb-0">Branch Management</h3>
                        <p class="text-muted mb-0">Add, edit, and manage your restaurant branches with delivery service details</p>
                    </div>
                    <button type="button" class="btn btn-primary add-new-btn" data-bs-toggle="modal" data-bs-target="#addBranchModal">
                        <i class="ri-add-line me-2"></i>Add New Branch
                    </button>
                </div>
            </div>
        </div>

        <!-- DataTable Card -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive datatable-wrapper">
                            <table class="table branch-datatable table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th width="60">No</th>
                                        <th>Branch Name</th>
                                        <th>Phone</th>
                                        <th>Location</th>
                                        <th width="100">Delivery Services</th>
                                        <th width="120">Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit Branch Modal -->
    <div class="modal fade" id="addBranchModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="ri-store-2-fill me-2"></i>Add Branch Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="branchForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Branch Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="e.g. Downtown Branch" required>
                                <span class="text-danger error-text name_error d-block mt-1" style="font-size: 0.85rem;"></span>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" placeholder="e.g. +8801234567890" required>
                                <span class="text-danger error-text phone_error d-block mt-1" style="font-size: 0.85rem;"></span>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Location <span class="text-danger">*</span></label>
                                <input type="text" name="location" class="form-control" placeholder="e.g. 123 Main Street, Downtown" required>
                                <span class="text-danger error-text location_error d-block mt-1" style="font-size: 0.85rem;"></span>
                            </div>

                            <!-- Delivery Services Section -->
                            <div class="col-12">
                                <hr class="my-2">
                                <label class="form-label mb-3">
                                    <strong>Delivery Services (Optional)</strong>
                                    <small class="text-muted d-block">Add delivery partner links and logos</small>
                                </label>

                                <!-- FoodPanda -->
                                <div class="row g-2 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label small">FoodPanda URL</label>
                                        <input type="url" name="foodpanda_url" class="form-control form-control-sm" placeholder="https://www.foodpanda.com/...">
                                        <span class="text-danger error-text foodpanda_url_error d-block mt-1" style="font-size: 0.85rem;"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small">FoodPanda Logo</label>
                                        <input type="file" name="foodpanda_logo" class="form-control form-control-sm" accept="image/*">
                                        <small class="text-muted d-block mt-1">Max: 2MB</small>
                                    </div>
                                </div>

                                <!-- Pathao -->
                                <div class="row g-2 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label small">Pathao URL</label>
                                        <input type="url" name="pathao_url" class="form-control form-control-sm" placeholder="https://www.pathao.com/...">
                                        <span class="text-danger error-text pathao_url_error d-block mt-1" style="font-size: 0.85rem;"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small">Pathao Logo</label>
                                        <input type="file" name="pathao_logo" class="form-control form-control-sm" accept="image/*">
                                        <small class="text-muted d-block mt-1">Max: 2MB</small>
                                    </div>
                                </div>

                                <!-- Foodi -->
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <label class="form-label small">Foodi URL</label>
                                        <input type="url" name="foodi_url" class="form-control form-control-sm" placeholder="https://www.foodiapp.com/...">
                                        <span class="text-danger error-text foodi_url_error d-block mt-1" style="font-size: 0.85rem;"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small">Foodi Logo</label>
                                        <input type="file" name="foodi_logo" class="form-control form-control-sm" accept="image/*">
                                        <small class="text-muted d-block mt-1">Max: 2MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ri-save-line me-2"></i>Save Branch
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Details Modal -->
    <div class="modal fade" id="viewDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="ri-file-info-fill me-2"></i>Branch Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="detail-section">
                                <div class="detail-label">Branch Name</div>
                                <h4 id="detail_name" class="detail-value mb-0"></h4>
                            </div>

                            <div class="detail-section">
                                <div class="detail-label">Phone</div>
                                <p id="detail_phone" class="detail-value mb-0"></p>
                            </div>

                            <div class="detail-section">
                                <div class="detail-label">Location</div>
                                <p id="detail_location" class="detail-value mb-0"></p>
                            </div>

                            <div class="detail-section">
                                <div class="detail-label">Delivery Services</div>
                                <div id="detail_services" class="mb-0">
                                    <p class="text-muted">No delivery services configured</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="edit_from_detail">
                        <i class="ri-pencil-line me-2"></i>Edit Branch
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let table;
        let currentEditId = null;

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Initialize DataTable
            table = $('.branch-datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                pageLength: 25,
                ajax: "{{ route('admin.branch.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', width: '60px' },
                    { data: 'name', name: 'name' },
                    { data: 'phone', name: 'phone' },
                    { data: 'location', name: 'location' },
                    { 
                        data: null, 
                        name: 'services',
                        orderable: false,
                        searchable: false,
                        width: '100px',
                        render: function(data) {
                            let count = 0;
                            if (data.foodpanda_url) count++;
                            if (data.pathao_url) count++;
                            if (data.foodi_url) count++;
                            return count > 0 ? '<span class="badge bg-success">' + count + ' Services</span>' : '<span class="badge bg-secondary">None</span>';
                        }
                    },
                    { data: 'action', name: 'action', orderable: false, searchable: false, width: '120px' }
                ]
            });

            // Form Submit
            $('#branchForm').on('submit', function(e) {
                e.preventDefault();
                $('.error-text').text('');

                // Get ID from both sources to be sure
                let editId = $(this).attr('data-edit-id') || $(this)[0].dataset.editId || '';
                
                // Ensure it's not undefined, 'undefined', 'store', or empty string
                currentEditId = (editId && editId !== 'undefined' && editId !== 'store' && editId !== '') ? editId : null;
                
                let url = currentEditId ? "{{ route('admin.branch.update', ':id') }}".replace(':id', currentEditId) : "{{ route('admin.branch.store') }}";

                let formData = new FormData(this);
                
                console.log('=== FORM SUBMIT ===');
                console.log('Raw ID:', editId);
                console.log('Processed ID:', currentEditId);
                console.log('URL:', url);
                console.log('Is Edit Mode:', !!currentEditId);

                $.ajax({
                    url: url,
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        console.log('Success response:', res);
                        if (res.status === 'success') {
                            toastr.success(res.message, 'Success', { timeOut: 3000 });
                            $('#addBranchModal').modal('hide');
                            resetForm();
                            
                            // Reload table with error handling
                            setTimeout(function() {
                                console.log('Reloading DataTable...');
                                table.ajax.reload(function() {
                                    console.log('DataTable reloaded successfully');
                                });
                            }, 300);
                        } else {
                            toastr.error(res.message || 'Error', 'Error');
                        }
                    },
                    error: function(xhr) {
                        console.log('=== ERROR RESPONSE ===');
                        console.log('Status:', xhr.status);
                        console.log('Response:', xhr.responseJSON);
                        
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            console.log('Validation Errors:', errors);
                            $.each(errors, function(key, val) {
                                let errorClass = '.' + key + '_error';
                                $(errorClass).text(val[0]);
                                console.log('Set error for', errorClass, ':', val[0]);
                            });
                            toastr.error('Please fix validation errors', 'Validation Error');
                        } else if (xhr.status === 404) {
                            toastr.error(xhr.responseJSON?.message || 'Branch not found', 'Error');
                        } else {
                            toastr.error('Error: ' + (xhr.responseJSON?.message || 'Unknown error'), 'Error', { timeOut: 3000 });
                        }
                    }
                });
            });

            // Edit Button
            $(document).on('click', '.edit-btn', function() {
                let id = $(this).data('id');
                console.log('Loading branch for edit, ID:', id);
                $.get("{{ route('admin.branch.edit', ':id') }}".replace(':id', id), function(data) {
                    console.log('Branch data loaded:', data);
                    currentEditId = id;
                    $('#branchForm').attr('data-edit-id', id);
                    $('#branchForm')[0].dataset.editId = id;  // Double set to ensure it's there
                    
                    $('input[name="name"]').val(data.name || '');
                    $('input[name="phone"]').val(data.phone || '');
                    $('input[name="location"]').val(data.location || '');
                    $('input[name="foodpanda_url"]').val(data.foodpanda_url || '');
                    $('input[name="pathao_url"]').val(data.pathao_url || '');
                    $('input[name="foodi_url"]').val(data.foodi_url || '');

                    $('#addBranchModal').modal('show');
                }).fail(function(xhr) {
                    console.error('Failed to load branch:', xhr);
                    toastr.error('Failed to load branch', 'Error');
                });
            });

            // View Details Button
            $(document).on('click', '.view-details-btn', function() {
                let id = $(this).data('id');
                $.get("{{ route('admin.branch.edit', ':id') }}".replace(':id', id), function(data) {
                    currentEditId = id;

                    $('#detail_name').text(data.name);
                    $('#detail_phone').text(data.phone);
                    $('#detail_location').text(data.location);

                    // Build delivery services HTML
                    let servicesHtml = '';
                    if (data.foodpanda_url || data.pathao_url || data.foodi_url) {
                        if (data.foodpanda_url) {
                            servicesHtml += `<div class="delivery-service">
                                <div class="delivery-service-label">🍔 FoodPanda</div>
                                <div class="delivery-service-value"><a href="${data.foodpanda_url}" target="_blank">${data.foodpanda_url}</a></div>
                            </div>`;
                        }
                        if (data.pathao_url) {
                            servicesHtml += `<div class="delivery-service">
                                <div class="delivery-service-label">🚚 Pathao</div>
                                <div class="delivery-service-value"><a href="${data.pathao_url}" target="_blank">${data.pathao_url}</a></div>
                            </div>`;
                        }
                        if (data.foodi_url) {
                            servicesHtml += `<div class="delivery-service">
                                <div class="delivery-service-label">🛵 Foodi</div>
                                <div class="delivery-service-value"><a href="${data.foodi_url}" target="_blank">${data.foodi_url}</a></div>
                            </div>`;
                        }
                        $('#detail_services').html(servicesHtml);
                    } else {
                        $('#detail_services').html('<p class="text-muted">No delivery services configured</p>');
                    }

                    $('#viewDetailsModal').modal('show');
                }).fail(function() {
                    toastr.error('Failed to load branch details', 'Error');
                });
            });

            // Edit from detail modal
            $(document).on('click', '#edit_from_detail', function() {
                $('#viewDetailsModal').modal('hide');
                let id = currentEditId;
                $.get("{{ route('admin.branch.edit', ':id') }}".replace(':id', id), function(data) {
                    $('#branchForm').attr('data-edit-id', id);
                    $('input[name="name"]').val(data.name);
                    $('input[name="phone"]').val(data.phone);
                    $('input[name="location"]').val(data.location);
                    $('input[name="foodpanda_url"]').val(data.foodpanda_url || '');
                    $('input[name="pathao_url"]').val(data.pathao_url || '');
                    $('input[name="foodi_url"]').val(data.foodi_url || '');

                    $('#addBranchModal').modal('show');
                });
            });

            // Copy Link Button
            $(document).on('click', '.copy-link-btn', function() {
                let slug = $(this).data('slug');
                let linkUrl = "{{ url('/branches') }}/" + slug;
                
                // Copy to clipboard
                navigator.clipboard.writeText(linkUrl).then(function() {
                    toastr.success('Link copied to clipboard!', 'Success', { timeOut: 2000 });
                }).catch(function() {
                    // Fallback for older browsers
                    let tempInput = $('<input>');
                    $('body').append(tempInput);
                    tempInput.val(linkUrl).select();
                    document.execCommand('copy');
                    tempInput.remove();
                    toastr.success('Link copied to clipboard!', 'Success', { timeOut: 2000 });
                });
            });

            // Delete Button
            $(document).on('click', '.delete-btn', function() {
                let id = $(this).data('id');
                let name = $(this).data('name');
                Swal.fire({
                    title: 'Delete Branch?',
                    text: "Delete '" + name + "'? This action cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, Delete',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.branch.delete', ':id') }}".replace(':id', id),
                            method: 'DELETE',
                            data: { _token: "{{ csrf_token() }}" },
                            success: function(res) {
                                if (res.status === 'success') {
                                    toastr.success(res.message, 'Deleted', { timeOut: 3000 });
                                    setTimeout(function() {
                                        console.log('Reloading DataTable after delete...');
                                        table.ajax.reload(function() {
                                            console.log('DataTable reloaded after delete');
                                        });
                                    }, 300);
                                }
                            },
                            error: function() {
                                toastr.error('Error deleting branch', 'Error');
                            }
                        });
                    }
                });
            });

            // Reset form when modal is hidden
            $('#addBranchModal').on('hidden.bs.modal', function() {
                resetForm();
            });
        });

        function resetForm() {
            $('#branchForm')[0].reset();
            $('#branchForm').removeAttr('data-edit-id');
            $('.error-text').text('');
            currentEditId = null;
        }
    </script>
@endpush
