@extends('frontend.layout')
@push('front_css')

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

                <div class="dd-apply-card-stage">
                    <div class="dd-apply-glow"></div>
                    <!-- Reference your actual card image here -->
                    <img src="./images/membership.svg" alt="Degchi Premium Card" class="dd-apply-card-img" />
                </div>

                <div class="dd-apply-perks-list">
                    <h3 class="dd-apply-perks-title">Membership Benefits</h3>

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

                <form id="privilegeCardForm" class="dd-apply-form-element" method="POST" action="{{ route('frontend.members.register') }}">
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

                    <div class="dd-input-grid">
                        <div class="dd-input-group">
                            <label class="form-check form-check-inline">
                                <input type="checkbox" name="is_student" value="1" class="form-check-input">
                                <span class="form-check-label">I am a student</span>
                            </label>
                        </div>
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
                        $('#privilegeCardForm').on('submit', function(e){
                            e.preventDefault();
                            var form = $(this);
                            $.ajax({
                                url: form.attr('action'),
                                method: 'POST',
                                data: form.serialize(),
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                success: function(res){
                                    if(res.success){
                                        $('#privilegeThanks').removeClass('d-none').text(res.message);
                                        form[0].reset();
                                    }
                                },
                                error: function(xhr){
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