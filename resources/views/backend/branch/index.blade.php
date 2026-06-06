@extends('dashboard')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        /* Force table to respect container width */
        table.dataTable {
            width: 100% !important;
            margin: 0 auto;
            clear: both;
            border-collapse: collapse !important;
        }

        /* Handle long text in cells */
        .branch-datatable td {
            white-space: normal !important;
            /* Allows text to wrap */
            word-wrap: break-word;
            max-width: 200px;
            /* Limits width to trigger wrapping */
        }

        /* Ensure the form card doesn't get squashed on small screens */
        @media (max-width: 1200px) {
            .col-xl-4 {
                margin-bottom: 20px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Add New Branch</h5>
                    </div>
                    <div class="card-body">
                        <form id="branchForm">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">Branch Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter branch name">
                                <span class="text-danger error-text name_error" style="font-size: 13px;"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Contact Phone</label>
                                <input type="text" name="phone" class="form-control" placeholder="e.g. +123456789">
                                <span class="text-danger error-text phone_error" style="font-size: 13px;"></span>
                            </div>
                    <div class="mb-3">
                                <label class="form-label fw-bold">Full Address</label>
                                <textarea name="location" class="form-control" rows="3" placeholder="Enter full address"></textarea>
                                <span class="text-danger error-text location_error" style="font-size: 13px;"></span>
                            </div>
                            <hr class="my-3">
                            <h6 class="mb-3 fw-bold">Delivery Services (Optional)</h6>
                            <div class="mb-3">
                                <label class="form-label fw-bold">FoodPanda URL</label>
                                <input type="url" name="foodpanda_url" class="form-control" placeholder="https://www.foodpanda.com.bd/restaurant/...">
                                <span class="text-danger error-text foodpanda_url_error" style="font-size: 13px;"></span>
                                <small class="text-muted d-block mt-1">If provided, logo is required</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Pathao URL</label>
                                <input type="url" name="pathao_url" class="form-control" placeholder="https://www.pathao.com/...">
                                <span class="text-danger error-text pathao_url_error" style="font-size: 13px;"></span>
                                <small class="text-muted d-block mt-1">If provided, logo is required</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Foodi URL</label>
                                <input type="url" name="foodi_url" class="form-control" placeholder="https://www.foodi.com/...">
                                <span class="text-danger error-text foodi_url_error" style="font-size: 13px;"></span>
                                <small class="text-muted d-block mt-1">If provided, logo is required</small>
                            </div>
                            <hr class="my-3">
                            <h6 class="mb-3 fw-bold">Delivery Service Logos</h6>
                            <div class="mb-3">
                                <label class="form-label fw-bold" for="foodpanda_logo">FoodPanda Logo</label>
                                <input type="file" id="foodpanda_logo" name="foodpanda_logo" class="form-control" accept="image/*">
                                <small class="text-muted">JPG, PNG, GIF or SVG (Max 2MB)</small>
                                <span class="text-danger error-text foodpanda_logo_error" style="font-size: 13px;"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold" for="pathao_logo">Pathao Logo</label>
                                <input type="file" id="pathao_logo" name="pathao_logo" class="form-control" accept="image/*">
                                <small class="text-muted">JPG, PNG, GIF or SVG (Max 2MB)</small>
                                <span class="text-danger error-text pathao_logo_error" style="font-size: 13px;"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold" for="foodi_logo">Foodi Logo</label>
                                <input type="file" id="foodi_logo" name="foodi_logo" class="form-control" accept="image/*">
                                <small class="text-muted">JPG, PNG, GIF or SVG (Max 2MB)</small>
                                <span class="text-danger error-text foodi_logo_error" style="font-size: 13px;"></span>
                            </div>
                            <button type="submit" id="submitBtn" class="btn btn-primary w-100 py-2">
                                <i class="fas fa-save me-1"></i> Save Branch
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table branch-datatable table-hover table-bordered align-middle w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">No</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Location</th>
                                        <th width="100">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h5 class="modal-title">Branch Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <p id="view_name" class="form-control-plaintext"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Phone</label>
                        <p id="view_phone" class="form-control-plaintext"></p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Location</label>
                        <p id="view_location" class="form-control-plaintext" style="word-break: break-word;"></p>
                    </div>
                    <hr class="my-3">
                    <h6 class="mb-3 fw-bold">Delivery Services</h6>
                    <div id="view_delivery_services">
                        <p class="text-muted">No delivery services added</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editBranchModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <form id="editBranchForm">
                    @csrf
                    <input type="hidden" id="edit_id">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Branch Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" id="edit_name" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" id="edit_phone" name="phone" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <textarea id="edit_location" name="location" class="form-control" rows="3"></textarea>
                        </div>
                        <hr class="my-3">
                        <h6 class="mb-3 fw-bold">Delivery Services (Optional)</h6>
                        <div class="mb-3">
                            <label class="form-label">FoodPanda URL</label>
                            <input type="url" id="edit_foodpanda_url" name="foodpanda_url" class="form-control" placeholder="https://www.foodpanda.com.bd/restaurant/...">
                            <small class="text-muted d-block mt-1">If provided, logo is required</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pathao URL</label>
                            <input type="url" id="edit_pathao_url" name="pathao_url" class="form-control" placeholder="https://www.pathao.com/...">
                            <small class="text-muted d-block mt-1">If provided, logo is required</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foodi URL</label>
                            <input type="url" id="edit_foodi_url" name="foodi_url" class="form-control" placeholder="https://www.foodi.com/...">
                            <small class="text-muted d-block mt-1">If provided, logo is required</small>
                        </div>
                        <hr class="my-3">
                        <h6 class="mb-3 fw-bold">Delivery Service Logos</h6>
                        <div class="mb-3">
                            <label class="form-label" for="edit_foodpanda_logo">FoodPanda Logo</label>
                            <input type="file" id="edit_foodpanda_logo" name="foodpanda_logo" class="form-control" accept="image/*">
                            <small class="text-muted">JPG, PNG, GIF or SVG (Max 2MB)</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="edit_pathao_logo">Pathao Logo</label>
                            <input type="file" id="edit_pathao_logo" name="pathao_logo" class="form-control" accept="image/*">
                            <small class="text-muted">JPG, PNG, GIF or SVG (Max 2MB)</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="edit_foodi_logo">Foodi Logo</label>
                            <input type="file" id="edit_foodi_logo" name="foodi_logo" class="form-control" accept="image/*">
                            <small class="text-muted">JPG, PNG, GIF or SVG (Max 2MB)</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Changes</button>
                    </div>
                </form>
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
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Initialize DataTable with Responsive plugin
            const table = $('.branch-datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true, // Enables responsive behavior
                autoWidth: false, // Prevents DataTables from calculating widths incorrectly
                ajax: "{{ route('admin.branch.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'location',
                        name: 'location'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                columnDefs: [{
                        className: "desktop",
                        "targets": [1, 2, 3]
                    }, // Priority columns
                    {
                        responsivePriority: 1,
                        targets: 0
                    },
                    {
                        responsivePriority: 2,
                        targets: 4
                    }
                ]
            });

            // 1. CREATE
            $('#branchForm').on('submit', function(e) {
                e.preventDefault();
                $('.error-text').text('');
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.branch.store') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#submitBtn').prop('disabled', true).text('Processing...');
                    },
                    success: function(res) {
                        toastr.success(res.message);
                        $('#branchForm')[0].reset();
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function(key, val) {
                                $('.' + key + '_error').text(val[0]);
                            });
                        }
                    },
                    complete: function() {
                        $('#submitBtn').prop('disabled', false).text('Save Branch');
                    }
                });
            });

            // Dynamic logo requirement based on URL input
            $('input[name="foodpanda_url"], input[name="pathao_url"], input[name="foodi_url"]').on('change', function() {
                const serviceType = $(this).attr('name').replace('_url', '');
                const hasUrl = $(this).val().trim() !== '';
                const logoLabel = $(this).closest('form').find(`label[for="${serviceType}_logo"]`);
                const logoInput = $(this).closest('form').find(`input[name="${serviceType}_logo"]`);
                
                if (hasUrl) {
                    logoLabel.html(`<span class="text-danger">*</span> ${serviceType.charAt(0).toUpperCase() + serviceType.slice(1)} Logo`);
                    logoInput.attr('required', 'required');
                } else {
                    logoLabel.html(`${serviceType.charAt(0).toUpperCase() + serviceType.slice(1)} Logo`);
                    logoInput.removeAttr('required');
                }
            });

            // Copy Link Button
            $(document).on('click', '.copy-link-btn', function() {
                const url = $(this).data('url');
                
                // Copy relative URL to clipboard
                navigator.clipboard.writeText(url).then(function() {
                    toastr.success('Branch link copied to clipboard!', 'Success', { timeOut: 2000 });
                }).catch(function(err) {
                    toastr.error('Failed to copy link', 'Error');
                });
            });

            // VIEW DETAILS
            $(document).on('click', '.view-details-btn', function() {
                let id = $(this).data('id');
                let url = "{{ route('admin.branch.edit', ':id') }}".replace(':id', id);
                $.get(url, function(data) {
                    $('#view_name').text(data.name);
                    $('#view_phone').text(data.phone);
                    $('#view_location').text(data.location);
                    
                    let servicesHtml = '';
                    if (data.foodpanda_url) {
                        servicesHtml += '<div class="mb-2"><strong>FoodPanda:</strong> <a href="' + data.foodpanda_url + '" target="_blank">' + data.foodpanda_url + '</a></div>';
                    }
                    if (data.pathao_url) {
                        servicesHtml += '<div class="mb-2"><strong>Pathao:</strong> <a href="' + data.pathao_url + '" target="_blank">' + data.pathao_url + '</a></div>';
                    }
                    if (data.foodi_url) {
                        servicesHtml += '<div class="mb-2"><strong>Foodi:</strong> <a href="' + data.foodi_url + '" target="_blank">' + data.foodi_url + '</a></div>';
                    }
                    
                    if (servicesHtml === '') {
                        servicesHtml = '<p class="text-muted">No delivery services added</p>';
                    }
                    
                    $('#view_delivery_services').html(servicesHtml);
                    $('#viewDetailsModal').modal('show');
                });
            });

            // 2. EDIT (Fetch)
            $(document).on('click', '.edit-btn', function() {
                let id = $(this).data('id');
                let url = "{{ route('admin.branch.edit', ':id') }}".replace(':id', id);
                $.get(url, function(data) {
                    $('#edit_id').val(data.id);
                    $('#edit_name').val(data.name);
                    $('#edit_phone').val(data.phone);
                    $('#edit_location').val(data.location);
                    $('#edit_foodpanda_url').val(data.foodpanda_url);
                    $('#edit_pathao_url').val(data.pathao_url);
                    $('#edit_foodi_url').val(data.foodi_url);
                    $('#editBranchModal').modal('show');
                });
            });

            // 3. UPDATE
            $('#editBranchForm').on('submit', function(e) {
                e.preventDefault();
                let id = $('#edit_id').val();
                let url = "{{ route('admin.branch.update', ':id') }}".replace(':id', id);
                let formData = new FormData(this);
                
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        $('#editBranchModal').modal('hide');
                        toastr.success(res.message);
                        table.ajax.reload(null, false); // Reload without resetting pagination
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            $.each(xhr.responseJSON.errors, function(key, val) {
                                toastr.error(val[0], 'Validation Error');
                            });
                        }
                    }
                });
            });

            // 4. DELETE
            $(document).on('click', '.delete-btn', function() {
                let id = $(this).data('id');
                let url = "{{ route('admin.branch.delete', ':id') }}".replace(':id', id);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(res) {
                                if (res.status === 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        res.message,
                                        'success'
                                    );
                                    table.ajax.reload(); // Reload the Yajra DataTable
                                }
                            },
                            error: function() {
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong while deleting.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
