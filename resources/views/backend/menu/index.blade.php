@extends('dashboard')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .variation-row {
            position: relative;
            transition: all 0.3s;
        }

        .variation-row:hover {
            border-color: #3577f1 !important;
        }

        .remove-variation {
            z-index: 10;
        }

        #full_description_text {
            word-break: break-word;
            white-space: pre-line;
        }

        .description-truncate {
            cursor: pointer;
            color: #3577f1;
            text-decoration: underline;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Add Menu Item & Variations</h5>
                    </div>
                    <div class="card-body">
                        <form id="menuForm" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">Category</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">-- Choose Category --</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Item Base Name</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="e.g. Hyderabadi Biryani" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Common Description</label>
                                <textarea name="description" class="form-control" rows="2"></textarea>
                            </div>

                            <hr>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="fw-bold mb-0 text-primary">Price Variations</label>
                                <button type="button" id="add_variation" class="btn btn-sm btn-soft-primary">
                                    <i class="ri-add-line"></i> Add
                                </button>
                            </div>

                            <div id="variation_wrapper">
                                <div class="variation-row border p-3 mb-3 rounded bg-light">
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <label class="small fw-bold">Size/Type</label>
                                            <input type="text" name="variations[0][name]"
                                                class="form-control form-control-sm" placeholder="1:1" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="small fw-bold">Price</label>
                                            <input type="number" name="variations[0][price]"
                                                class="form-control form-control-sm" placeholder="0.00" required>
                                        </div>
                                        <div class="col-12">
                                            <label class="small fw-bold">Image for this Size</label>
                                            <input type="file" name="variations[0][image]"
                                                class="form-control form-control-sm" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Availability</label>
                                <select name="is_available" class="form-select">
                                    <option value="1">Available</option>
                                    <option value="0">Out of Stock</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 fw-bold">Save Item</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table menu-datatable table-bordered align-middle w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Variations (Size: Price)</th>
                                        <th>Status</th>
                                        <th width="100px">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="variantDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Variant Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="variantImageWrapper" class="mb-3">
                        <img src="" id="v_modal_image" class="img-fluid rounded shadow-sm"
                            style="max-height: 300px; display: none;">
                        <div id="v_no_image" class="py-5 bg-light rounded text-muted">No Image Available</div>
                    </div>

                    <h4 id="v_modal_name" class="fw-bold mb-1"></h4>
                    <p class="text-muted">Price: <span id="v_modal_price" class="text-primary fw-bold"></span> TK</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @push('scripts')
        <script>
            // Global variable to keep track of variation rows
            let vIndex = 1;

            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const table = $('.menu-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.menu.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            render: function(data, type, row) {
                                return `<b>${data}</b><br><small class="description-truncate text-primary" data-desc="${row.description || ''}" style="cursor:pointer">View Info</small>`;
                            }
                        },
                        {
                            data: 'category_name',
                            name: 'category.name'
                        },
                        {
                            data: 'variations',
                            name: 'variations',
                            orderable: false,
                            render: function(data, type, row) {
                                let html = '';
                                // 'data' here is the HTML string or array sent from the Controller
                                // If your controller sends an array/object:
                                if (Array.isArray(data)) {
                                    data.forEach(v => {
                                        html += `
                    <div class="mb-1">
                        <span class="badge bg-soft-primary text-primary view-variant-details" 
                              style="cursor:pointer"
                              data-name="${v.name}" 
                              data-price="${v.price}" 
                              data-image="${v.image ? '/' + v.image : ''}">
                            <i class="ri-eye-line me-1"></i> ${v.name}
                        </span>
                    </div>`;
                                    });
                                } else {
                                    // If the controller already sends pre-rendered HTML, 
                                    // ensure the controller's HTML includes these data-attributes.
                                    return data;
                                }
                                return html || '<span class="text-muted">No variations</span>';
                            }
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });

                // Add Dynamic Variation Row
                $('#add_variation').click(function() {
                    addVariationRow();
                });

                // Remove Variation Row
                $(document).on('click', '.remove-variation', function() {
                    $(this).closest('.variation-row').fadeOut(300, function() {
                        $(this).remove();
                    });
                });

                // View Description
                $(document).on('click', '.description-truncate', function() {
                    let desc = $(this).data('desc');
                    $('#full_description_text').text(desc || 'No description provided.');
                    $('#viewDescModal').modal('show');
                });

                // Unified Submit Handler (Create & Update)
                $('#menuForm').on('submit', function(e) {
                    e.preventDefault();

                    let id = $(this).attr('data-edit-id');
                    let url = id ? "{{ route('admin.menu.update', ':id') }}".replace(':id', id) :
                        "{{ route('admin.menu.store') }}";

                    // Build FormData and compress images before upload
                    async function compressAndSend() {
                        let formEl = $('#menuForm')[0];
                        let formData = new FormData();

                        // Append non-file fields first
                        $(formEl).find(':input').each(function() {
                            const el = this;
                            const name = el.name;
                            if (!name) return;
                            if (el.type === 'file') return; // handle below
                            if (el.type === 'checkbox') {
                                if (el.checked) formData.append(name, el.value || '1');
                            } else {
                                formData.append(name, $(el).val() || '');
                            }
                        });

                        // Helper: compress image to webp via canvas
                        function compressImage(file, maxWidth = 1200, quality = 0.75) {
                            return new Promise((resolve, reject) => {
                                const img = new Image();
                                img.onload = () => {
                                    const ratio = img.width / img.height;
                                    let w = img.width;
                                    let h = img.height;
                                    if (w > maxWidth) {
                                        w = maxWidth;
                                        h = Math.round(w / ratio);
                                    }
                                    const canvas = document.createElement('canvas');
                                    canvas.width = w;
                                    canvas.height = h;
                                    const ctx = canvas.getContext('2d');
                                    ctx.drawImage(img, 0, 0, w, h);
                                    canvas.toBlob((blob) => {
                                        if (blob) resolve(blob);
                                        else reject(new Error('Compression failed'));
                                    }, 'image/webp', quality);
                                };
                                img.onerror = (e) => reject(e);
                                img.src = URL.createObjectURL(file);
                            });
                        }

                        // Process file inputs
                        const fileInputs = $(formEl).find('input[type=file]');
                        for (let i = 0; i < fileInputs.length; i++) {
                            const input = fileInputs[i];
                            const name = input.name;
                            if (!name) continue;
                            if (input.files && input.files.length) {
                                // If multiple files only take the first
                                const file = input.files[0];
                                try {
                                    const compressed = await compressImage(file);
                                    // Use original base name but webp extension
                                    const fname = (file.name || 'image') .replace(/\.[^.]+$/, '') + '.webp';
                                    formData.append(name, new File([compressed], fname, { type: 'image/webp' }));
                                } catch (err) {
                                    // fallback to original file
                                    formData.append(name, file);
                                }
                            }
                        }

                        try {
                            const res = await $.ajax({
                                url: url,
                                method: "POST",
                                data: formData,
                                processData: false,
                                contentType: false,
                            });
                            toastr.success(res.message);
                            location.reload();
                        } catch (xhr) {
                            console.log(xhr.responseText);
                            let message = xhr.responseJSON?.message || "Check console for details";
                            Swal.fire('Error', message, 'error');
                        }
                    }

                    compressAndSend();
                });


                // Edit Button Logic
                $(document).on('click', '.edit-btn', function() {
                    let id = $(this).data('id');
                    $.get("{{ route('admin.menu.edit', ':id') }}".replace(':id', id), function(data) {
                        $('#menuForm').attr('data-edit-id', id);
                        $('.card-header h5').text('Edit Menu Item');
                        $('button[type="submit"]').text('Update Item').removeClass('btn-primary')
                            .addClass('btn-info');

                        $('select[name="category_id"]').val(data.category_id);
                        $('input[name="name"]').val(data.name);
                        $('textarea[name="description"]').val(data.description);
                        $('select[name="is_available"]').val(data.is_available);

                        $('#variation_wrapper').html('');
                        data.variations.forEach((v, index) => {
                            addVariationRow(v, index);
                        });
                        vIndex = data.variations.length;
                        window.scrollTo(0, 0); // Scroll to form
                    });
                });

                // Delete Logic
                $(document).on('click', '.delete-btn', function() {
                    let id = $(this).data('id');
                    Swal.fire({
                        title: 'Are you sure?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('admin.menu.delete', ':id') }}".replace(':id',
                                    id),
                                method: 'DELETE',
                                success: function(res) {
                                    toastr.success(res.message);
                                    table.ajax.reload();
                                }
                            });
                        }
                    });
                });
            });

            // --- Helper Functions (Outside Document Ready) ---

            function addVariationRow(data = null, index = null) {
                let i = index !== null ? index : vIndex;
                let name = data ? data.name : '';
                let price = data ? data.price : '';
                let oldImage = data ? `<input type="hidden" name="variations[${i}][old_image]" value="${data.image}">` : '';

                let html = `
        <div class="variation-row border p-3 mb-3 rounded bg-light border-dashed">
            ${i > 0 ? '<button type="button" class="btn-close remove-variation position-absolute top-0 end-0 m-2"></button>' : ''}
            ${oldImage}
            <div class="row g-2">
                <div class="col-6">
                    <label class="small fw-bold">Size/Type</label>
                    <input type="text" name="variations[${i}][name]" value="${name}" class="form-control form-control-sm" required placeholder="e.g. Small">
                </div>
                <div class="col-6">
                    <label class="small fw-bold">Price</label>
                    <input type="number" name="variations[${i}][price]" value="${price}" class="form-control form-control-sm" required placeholder="0.00">
                </div>
                <div class="col-12">
                    <label class="small fw-bold">Image ${data && data.image ? '<span class="text-success">(Saved)</span>' : ''}</label>
                    <input type="file" name="variations[${i}][image]" class="form-control form-control-sm" accept="image/*">
                </div>
            </div>
        </div>`;
                $('#variation_wrapper').append(html);
                if (index === null) vIndex++;
            }

            function resetVariationWrapper() {
                $('#variation_wrapper').html('');
                vIndex = 0;
                addVariationRow(); // Add back the first row
            }
        </script>
        <script>
            // Click event for the variant badges
            $(document).on('click', '.view-variant-details', function() {
                const name = $(this).data('name');
                const price = $(this).data('price');
                const image = $(this).data('image');

                // Set Text Content
                $('#v_modal_name').text(name);
                $('#v_modal_price').text(price);

                // Handle Image Logic
                if (image && image !== '/') {
                    $('#v_modal_image').attr('src', image).show();
                    $('#v_no_image').hide();
                } else {
                    $('#v_modal_image').hide();
                    $('#v_no_image').show();
                }

                // Show the Modal
                $('#variantDetailsModal').modal('show');
            });

            // Optional: Logic for that "View Info" description link you added in the 'name' column
            $(document).on('click', '.description-truncate', function() {
                const desc = $(this).data('desc');
                Swal.fire({
                    title: 'Item Description',
                    text: desc || 'No description provided.',
                    icon: 'info',
                    confirmButtonText: 'Close'
                });
            });
        </script>
    @endpush
@endpush
