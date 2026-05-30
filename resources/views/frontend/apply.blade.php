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

                <form class="dd-apply-form-element" onsubmit="event.preventDefault();">

                    <!-- 2-Column Grid for Names -->
                    <div class="dd-input-grid">
                        <div class="dd-input-group">
                            <input type="text" id="dd_fname" class="dd-input-field" placeholder=" " required>
                            <label for="dd_fname" class="dd-floating-label">First Name</label>
                        </div>
                        <div class="dd-input-group">
                            <input type="text" id="dd_lname" class="dd-input-field" placeholder=" " required>
                            <label for="dd_lname" class="dd-floating-label">Last Name</label>
                        </div>
                    </div>

                    <!-- 2-Column Grid for Contact -->
                    <div class="dd-input-grid">
                        <div class="dd-input-group">
                            <input type="email" id="dd_email" class="dd-input-field" placeholder=" " required>
                            <label for="dd_email" class="dd-floating-label">Email Address</label>
                        </div>
                        <div class="dd-input-group">
                            <input type="tel" id="dd_phone" class="dd-input-field" placeholder=" " required>
                            <label for="dd_phone" class="dd-floating-label">Phone Number</label>
                        </div>
                    </div>

                    <!-- Full Width Select -->
                    <div class="dd-input-group">
                        <select id="dd_tier" class="dd-input-field dd-select" required>
                            <option value="" disabled selected hidden></option>
                            <option value="privilege">Privilege Membership (Tier I)</option>
                            <option value="membership">VIP Membership (Tier II)</option>
                        </select>
                        <label for="dd_tier" class="dd-floating-label">Select Requested Tier</label>
                        <iconify-icon icon="solar:alt-arrow-down-linear" class="dd-select-arrow"></iconify-icon>
                    </div>

                    <!-- Custom Terms Checkbox -->
                    <label class="dd-terms-wrapper">
                        <input type="checkbox" id="dd_terms" class="dd-hidden-check" required>
                        <div class="dd-visible-check">
                            <iconify-icon icon="solar:check-read-linear"></iconify-icon>
                        </div>
                        <span class="dd-terms-text">
                            I confirm that the details provided are accurate and agree to the terms of the Degchi Dine
                            rewards
                            program.
                        </span>
                    </label>

                    <!-- Submit Button -->
                    <button type="submit" class="dd-submit-btn">
                        <span>Submit Application</span>
                        <iconify-icon icon="solar:arrow-right-linear" class="dd-btn-icon"></iconify-icon>
                    </button>

                </form>
            </div>

        </div>
    </div>
</section>
@endsection