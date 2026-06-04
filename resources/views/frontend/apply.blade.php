@extends('frontend.layout')
@push('front_css')
<style>
    .dd-input-field[type="file"] {
        padding-top: 24px;
        padding-bottom: 8px;
        line-height: 1.2;
    }
    .dd-input-field[type="file"] ~ .dd-floating-label {
        transform: translateY(-10px) !important;
        font-size: 0.75rem !important;
        color: var(--dd-gold) !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
    }
</style>
@endpush
@section('frontend_content')

<section class="dd-apply-wrapper">

    <!-- The Dark Atmospheric Hero Banner -->
    <div class="dd-apply-hero-banner">
        <div class="container px-4 px-lg-5 text-center position-relative">

            <a href="{{ route('frontend.cards') }}" class="dd-apply-back-btn">
                <iconify-icon icon="solar:alt-arrow-left-linear"></iconify-icon>
                <span>Return to Portfolio</span>
            </a>

            <span class="dd-apply-badge">Exclusive Access</span>
            <h1 class="dd-apply-headline">Request Your Privileges</h1>
            <p class="dd-apply-subhead">Join our inner circle to unlock a world of bespoke culinary experiences.</p>

        </div>
    </div>

    <!-- The Main Overlapping Content Box -->
    <div class="container px-4 px-lg-5">
        <div class="dd-apply-main-box">

            <!-- LEFT SIDE: Card Showcase & Perks -->
            <div class="dd-apply-left-showcase">

                <div class="dd-apply-stage-wrap" style="position: relative;">
                    <div class="dd-apply-card-stage">
                        <div class="dd-apply-glow"></div>
                        <!-- Reference your actual card image here -->
                        <img src="./images/membership.svg" alt="Degchi Premium Card" class="dd-apply-card-img" />
                    </div>
                </div>

                <div class="dd-apply-perks-list">
                    <h3 class="dd-apply-perks-title">Membership Perks</h3>

                    <div class="dd-perk-row">
                        <div class="dd-perk-icon">
                            <iconify-icon icon="solar:verified-check-linear"></iconify-icon>
                        </div>
                        <div class="dd-perk-text">
                            <strong>Priority Reservations</strong>
                            <span>Skip the waitlist with 24/7 dedicated booking.</span>
                        </div>
                    </div>

                    <div class="dd-perk-row">
                        <div class="dd-perk-icon">
                            <iconify-icon icon="solar:wad-of-money-linear"></iconify-icon>
                        </div>
                        <div class="dd-perk-text">
                            <strong>Preferred Pricing</strong>
                            <span>Automatic deductions applied to your dining checks.</span>
                        </div>
                    </div>

                    <div class="dd-perk-row">
                        <div class="dd-perk-icon">
                            <iconify-icon icon="solar:gift-linear"></iconify-icon>
                        </div>
                        <div class="dd-perk-text">
                            <strong>Curated Surprises</strong>
                            <span>Complimentary chef treats on your special dates.</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE: The Application Form -->
            <div class="dd-apply-right-form">

                <div class="dd-apply-form-header">
                    <h2>Application Form</h2>
                    <p>Please provide your details below. Approvals are typically processed within one business day.</p>
                </div>

                <form id="privilegeCardForm" class="dd-apply-form-element" method="POST" action="{{ route('frontend.members.register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="dd-input-group">
                        <input type="text" name="name" id="dd_name" class="dd-input-field" placeholder=" " required>
                        <label for="dd_name" class="dd-floating-label">Full Name</label>
                    </div>

                    <div class="dd-input-grid">
                        <div class="dd-input-group">
                            <input type="email" name="email" id="dd_email" class="dd-input-field" placeholder=" ">
                            <label for="dd_email" class="dd-floating-label">Email Address</label>
                        </div>
                        <div class="dd-input-group">
                            <input type="tel" name="phone" id="dd_phone" class="dd-input-field" placeholder=" " required>
                            <label for="dd_phone" class="dd-floating-label">Phone Number</label>
                        </div>
                    </div>

                    <div class="dd-input-grid">
                        <div class="dd-input-group">
                            <input type="date" name="dob" id="dd_dob" class="dd-input-field" placeholder=" ">
                            <label for="dd_dob" class="dd-floating-label">Date of Birth</label>
                        </div>
                        <div class="dd-input-group">
                            <input type="date" name="marriage_date" id="dd_marriage" class="dd-input-field" placeholder=" ">
                            <label for="dd_marriage" class="dd-floating-label">Marriage Date (optional)</label>
                        </div>
                    </div>

                    <div class="dd-input-group">
                        <textarea name="address" id="dd_address" class="dd-input-field" rows="2" placeholder=" "></textarea>
                        <label for="dd_address" class="dd-floating-label">Address (optional)</label>
                    </div>

                    <div class="dd-input-grid align-items-center">
                        <div class="dd-input-group">
                            <label class="form-check form-check-inline" style="cursor: pointer;">
                                <input type="checkbox" name="is_student" id="dd_is_student" value="1" class="form-check-input">
                                <span class="form-check-label text-dark fw-semibold ms-1">I am a student</span>
                            </label>
                        </div>
                    </div>

                    {{-- Student discount info callout --}}
                    <div class="d-none" id="student_discount_info" style="background: linear-gradient(135deg, rgba(40,167,69,0.08), rgba(40,167,69,0.02)); border: 1px solid rgba(40,167,69,0.2); border-radius: 12px; padding: 14px 18px; margin-bottom: 16px;">
                        <div style="display:flex;align-items:flex-start;gap:10px;">
                            <iconify-icon icon="solar:graduation-cap-bold" style="font-size:22px;color:#28a745;margin-top:2px;"></iconify-icon>
                            <div>
                                <strong style="color:#28a745;font-size:0.92rem;">Student Benefit — 35% First Order Discount!</strong>
                                <p style="margin:4px 0 0;font-size:0.82rem;color:#555;line-height:1.5;">Upload your valid student ID card to verify your student status. Students receive a <strong>35% discount</strong> on their first order, compared to <strong>30%</strong> for non-student members. The image is required for student verification.</p>
                            </div>
                        </div>
                    </div>

                    <div class="dd-input-group d-none" id="student_card_group">
                        <input type="file" name="student_card" id="dd_student_card" class="dd-input-field" accept="image/*">
                        <label for="dd_student_card" class="dd-floating-label">Upload Student Card (Image)*</label>
                    </div>

                    {{-- Image preview --}}
                    <div class="d-none mb-3" id="student_card_preview_wrap" style="text-align:center;">
                        <img id="student_card_preview" src="" alt="Student Card Preview" style="max-height:180px;border-radius:10px;border:2px solid rgba(40,167,69,0.3);box-shadow:0 2px 12px rgba(0,0,0,0.08);" />
                        <div style="margin-top:6px;font-size:0.78rem;color:#888;">Preview of your student card</div>
                    </div>

                    <label class="dd-terms-wrapper">
                        <input type="checkbox" id="dd_terms" name="terms" class="dd-hidden-check" required>
                        <div class="dd-visible-check">
                            <iconify-icon icon="solar:check-read-linear"></iconify-icon>
                        </div>
                        <span class="dd-terms-text">I confirm that the details provided are accurate and agree to the terms of the Degchi Dine rewards program.</span>
                    </label>

                    <button type="submit" id="privilegeSubmitBtn" class="dd-submit-btn">
                        <span>Submit Application</span>
                        <iconify-icon icon="solar:arrow-right-linear" class="dd-btn-icon"></iconify-icon>
                    </button>
                </form>

                <div id="privilegeThanks" class="d-none mt-3 alert alert-success"></div>

                <script>
                    $(function(){
                        // Toggle student card upload input
                        $('#dd_is_student').on('change', function() {
                            if($(this).is(':checked')) {
                                $('#student_card_group').removeClass('d-none');
                                $('#dd_student_card').prop('required', true);
                            } else {
                                $('#student_card_group').addClass('d-none');
                                $('#dd_student_card').prop('required', false).val('');
                            }
                        });

                        $('#privilegeCardForm').on('submit', function(e){
                            e.preventDefault();
                            var form = $(this);
                            var submitBtn = $('#privilegeSubmitBtn');
                            
                            submitBtn.prop('disabled', true).addClass('is-loading');
                            
                            var formData = new FormData(this);
                            
                            $.ajax({
                                url: form.attr('action'),
                                method: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                success: function(res){
                                    submitBtn.prop('disabled', false).removeClass('is-loading');
                                    if(res.success){
                                        $('#privilegeThanks').removeClass('d-none').text(res.message);
                                        form[0].reset();
                                        $('#student_card_group').addClass('d-none');
                                        $('#dd_student_card').prop('required', false);
                                    }
                                },
                                error: function(xhr){
                                    submitBtn.prop('disabled', false).removeClass('is-loading');
                                    var msg = xhr.responseJSON?.errors ? Object.values(xhr.responseJSON.errors)[0][0] : xhr.responseJSON?.message || 'Unable to register';
                                    alert(msg);
                                }
                            });
                        });
                    });
                </script>
            </div>

        </div>
    </div>
</section>
@endsection