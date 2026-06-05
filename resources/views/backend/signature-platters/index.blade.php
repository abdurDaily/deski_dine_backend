@extends('dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Signature Platters</h4>
                <div class="page-title-right">
                    <ol class="m-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Signature Platters</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- CREATE FORM -->
        <div class="col-xl-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Add Signature Platter</h5>
                </div>
                <div class="card-body">
                    <form id="platterForm" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" placeholder="e.g. Lunch Feast">
                            <span class="text-danger error-text title_error"></span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Subtitle</label>
                            <input type="text" name="subtitle" class="form-control" placeholder="e.g. A MID-DAY FEAST OF INDIA">
                            <span class="text-danger error-text subtitle_error"></span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Short description..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Image <small class="text-muted">(webp, png, jpg)</small></label>
                            <input type="file" name="image" class="form-control" accept="image/webp,image/png,image/jpeg">
                            <span class="text-danger error-text image_error"></span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control input-number" value="0" min="0">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <!-- FEATURES -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Features</label>
                            <div id="featuresContainer">
                                <div class="feature-row border rounded p-2 mb-2 bg-light">
                                    <div class="mb-2">
                                        <input type="text" name="features[0][icon]" class="form-control form-control-sm mb-1" placeholder="FA icon class (e.g. fa-solid fa-leaf)">
                                        <input type="text" name="features[0][label]" class="form-control form-control-sm mb-1" placeholder="Bold label (e.g. Veg Special:)">
                                        <input type="text" name="features[0][text]" class="form-control form-control-sm" placeholder="Feature description text">
                                    </div>
                                </div>
                                <div class="feature-row border rounded p-2 mb-2 bg-light">
                                    <div class="mb-2">
                                        <input type="text" name="features[1][icon]" class="form-control form-control-sm mb-1" placeholder="FA icon class">
                                        <input type="text" name="features[1][label]" class="form-control form-control-sm mb-1" placeholder="Bold label">
                                        <input type="text" name="features[1][text]" class="form-control form-control-sm" placeholder="Feature description text">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-secondary mt-1" id="addFeatureBtn">
                                <i class="ri-add-line"></i> Add Feature
                            </button>
                        </div>

                        <button type="submit" id="submitBtn" class="btn btn-primary w-100 fw-bold">
                            <i class="ri-save-line me-1"></i> Save Platter
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- DATA TABLE -->
        <div class="col-xl-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table platter-datatable table-bordered nowrap align-middle w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th>Sort</th>
                                    <th>Status</th>
                                    <th width="90px">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- EDIT MODAL -->
<div class="modal fade" id="editPlatterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editPlatterForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="edit_id">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Signature Platter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="edit_title" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Subtitle</label>
                            <input type="text" name="subtitle" id="edit_subtitle" class="form-control">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" id="edit_description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Image <small class="text-muted">(Leave blank to keep current)</small></label>
                            <input type="file" name="image" class="form-control" accept="image/webp,image/png,image/jpeg">
                            <div class="mt-1" id="edit_current_image_wrap"></div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-semibold">Sort Order</label>
                            <input type="number" name="sort_order" id="edit_sort_order" class="form-control input-number" min="0">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" id="edit_status" class="form-select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-semibold">Features</label>
                            <div id="editFeaturesContainer"></div>
                            <button type="button" class="btn btn-sm btn-outline-secondary mt-1" id="editAddFeatureBtn">
                                <i class="ri-add-line"></i> Add Feature
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="ri-save-line me-1"></i> Update Platter
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    // Initialize DataTable
    const table = $('.platter-datatable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: "{{ route('admin.signature-platters.index') }}",
            error: function(xhr, status, error) {
                console.error('DataTables error:', xhr, status, error);
                toastr.error('Failed to load platters. Check console.');
            }
        },
        columns: [
            { data: 'DT_RowIndex',    name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'image_preview',  name: 'image',        orderable: false, searchable: false },
            { data: 'title',          name: 'title' },
            { data: 'subtitle',       name: 'subtitle' },
            { data: 'sort_order',     name: 'sort_order' },
            { data: 'status',         name: 'status', orderable: false },
            { data: 'action',         name: 'action', orderable: false, searchable: false },
        ]
    });

    // --- Dynamic features rows ---
    let featureCount = 2;
    $('#addFeatureBtn').on('click', function () {
        const i = featureCount++;
        $('#featuresContainer').append(featureRowHtml('features', i));
    });

    $(document).on('click', '.remove-feature', function () {
        $(this).closest('.feature-row').remove();
    });

    function featureRowHtml(prefix, i, icon='', label='', text='') {
        return `<div class="feature-row border rounded p-2 mb-2 bg-light position-relative">
            <button type="button" class="btn btn-sm btn-danger remove-feature position-absolute top-0 end-0 m-1" style="font-size:10px;padding:2px 6px;">✕</button>
            <input type="text" name="${prefix}[${i}][icon]"  class="form-control form-control-sm mb-1" placeholder="FA icon class (e.g. fa-solid fa-leaf)" value="${icon}">
            <input type="text" name="${prefix}[${i}][label]" class="form-control form-control-sm mb-1" placeholder="Bold label (e.g. Veg Special:)" value="${label}">
            <input type="text" name="${prefix}[${i}][text]"  class="form-control form-control-sm" placeholder="Feature description text" value="${text}">
        </div>`;
    }

    // --- CREATE ---
    $('#platterForm').on('submit', function (e) {
        e.preventDefault();
        $('.error-text').text('');
        const btn = $('#submitBtn');
        btn.prop('disabled', true).text('Saving...');

        $.ajax({
            url: "{{ route('admin.signature-platters.store') }}",
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (res) {
                Command: toastr[res.status](res.message);
                $('#platterForm')[0].reset();
                table.ajax.reload();
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    $.each(xhr.responseJSON.errors, function (key, val) {
                        $('.' + key + '_error').text(val[0]);
                    });
                } else {
                    Command: toastr['error']('Something went wrong.');
                }
            },
            complete: function () { btn.prop('disabled', false).text('Save Platter'); }
        });
    });

    // --- EDIT (fetch) ---
    $(document).on('click', '.edit-btn', function () {
        const id  = $(this).data('id');
        const url = "{{ route('admin.signature-platters.edit', ':id') }}".replace(':id', id);

        $.get(url, function (data) {
            $('#edit_id').val(data.id);
            $('#edit_title').val(data.title);
            $('#edit_subtitle').val(data.subtitle);
            $('#edit_description').val(data.description);
            $('#edit_sort_order').val(data.sort_order);
            $('#edit_status').val(data.status ? '1' : '0');

            // Show current image
            const imgWrap = $('#edit_current_image_wrap');
            if (data.image) {
                imgWrap.html(`<img src="/uploads/platters/${data.image}" class="rounded mt-1" height="60" alt="current image" />`);
            } else {
                imgWrap.html('<span class="text-muted small">No current image</span>');
            }

            // Rebuild features
            const container = $('#editFeaturesContainer');
            container.html('');
            featureEditCount = 0;
            const features = data.features || [];
            features.forEach(function (f, i) {
                container.append(featureRowHtml('features', i, f.icon || '', f.label || '', f.text || ''));
                featureEditCount = i + 1;
            });
            if (featureEditCount === 0) {
                container.append(featureRowHtml('features', 0));
                container.append(featureRowHtml('features', 1));
                featureEditCount = 2;
            }

            $('#editPlatterModal').modal('show');
        });
    });

    let featureEditCount = 2;
    $('#editAddFeatureBtn').on('click', function () {
        $('#editFeaturesContainer').append(featureRowHtml('features', featureEditCount++));
    });

    // --- UPDATE ---
    $('#editPlatterForm').on('submit', function (e) {
        e.preventDefault();
        const id  = $('#edit_id').val();
        const url = "{{ route('admin.signature-platters.update', ':id') }}".replace(':id', id);

        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (res) {
                $('#editPlatterModal').modal('hide');
                Command: toastr[res.status](res.message);
                table.ajax.reload();
            },
            error: function (xhr) {
                Command: toastr['error']('Update failed.');
            }
        });
    });

    // --- DELETE ---
    $(document).on('click', '.delete-btn', function () {
        const id  = $(this).data('id');
        const url = "{{ route('admin.signature-platters.delete', ':id') }}".replace(':id', id);

        Swal.fire({
            title: 'Delete Platter?',
            text: 'This will remove the platter from the frontend.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    success: function (res) {
                        Swal.fire('Deleted!', res.message, 'success');
                        table.ajax.reload();
                    }
                });
            }
        });
    });
});
</script>
@endpush
