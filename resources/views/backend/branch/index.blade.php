@extends('dashboard')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-7 mx-auto">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <!-- Added an ID to the form for jQuery targeting -->
                        <form id="branchForm">
                            @csrf
                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Branch Name</label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Downtown Central">
                                    <span class="text-danger error-text name_error"></span>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold">Contact Phone</label>
                                    <input type="text" name="phone" class="form-control" placeholder="+1 555-0000">
                                    <span class="text-danger error-text phone_error"></span>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold">Full Address</label>
                                    <textarea name="location" class="form-control" rows="3"></textarea>
                                    <span class="text-danger error-text location_error"></span>
                                </div>

                                <div class="col-12 pt-2 text-end">
                                    <button type="submit" id="submitBtn" class="btn btn-primary px-5 fw-bold">
                                        Save Branch
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- jQuery and Toastr JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#branchForm').on('submit', function(e) {
                e.preventDefault();

                // Clear previous errors
                $('.error-text').text('');
                $('#submitBtn').prop('disabled', true).text('Saving...');

                $.ajax({
                    url: "{{ route('admin.branch.store') }}",
                    method: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 'success') {
                            toastr.success(response.message);
                            $('#branchForm')[0].reset(); // Clear form
                        }
                        $('#submitBtn').prop('disabled', false).text('Save Branch');
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) { // Validation Error
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('.' + key + '_error').text(value[0]);
                            });
                            toastr.error("Please check the form for errors.");
                        } else {
                            toastr.error("An unexpected error occurred.");
                        }
                        $('#submitBtn').prop('disabled', false).text('Save Branch');
                    }
                });
            });
        });
    </script>
@endpush

