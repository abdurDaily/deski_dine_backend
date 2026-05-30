@extends('frontend.layout')
@section('frontend_content')

<main class="luxury-portal-container">
    <section class="premium-identity-showcase py-5">
        <div class="container px-4 px-lg-5">

            <!-- Title Panel -->
            <div class="text-center mb-5 reveal">
                <span class="luxury-meta-label mb-2">Degchi Rewards</span>
                <h2 class="luxury-title">Elevate Your Dining Experience</h2>
                <div class="luxury-accent-line mx-auto"></div>
            </div>

            <!-- Symmetrical Two-Column Card Grid -->
            <div class="row g-5 align-items-stretch justify-content-center">

                <!-- Card Option 1: Privilege Pass -->
                <div class="col-12 col-md-6 col-lg-5">
                    <a href="{{ route('frontend.card.apply') }}" class="luxury-card-anchor" aria-label="View Privilege Card">
                        <div class="luxury-interactive-card h-100">

                            <!-- Clean Image Wrapper -->
                            <div class="card-image-wrapper">
                                <img src="{{ asset('assets/frontend/images/privilege_card.svg') }}" alt="Degchi Privilege Card"
                                    class="card-img-fit" />
                            </div>

                            <!-- Text Details -->
                            <div class="card-body-details p-4 p-lg-5">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h3 class="card-main-title">Golden Card</h3>
                                    <div class="luxury-action-arrow">
                                        <iconify-icon icon="solar:alt-arrow-right-linear"></iconify-icon>
                                    </div>
                                </div>
                                <p class="card-summary-text">
                                    Unlock curated priority seating, tailored milestone rewards, and bespoke surprise
                                    kitchen treats
                                    every time you dine with us.
                                </p>
                            </div>

                        </div>
                    </a>
                </div>

                <!-- Card Option 2: Membership Pass -->
                <div class="col-12 col-md-6 col-lg-5">
                    <a href="{{ route('frontend.card.apply') }}" class="luxury-card-anchor" aria-label="View Membership Card">
                        <div class="luxury-interactive-card h-100">

                            <!-- Clean Image Wrapper -->
                            <div class="card-image-wrapper">
                                <img src="{{ asset('assets/frontend/images/membership.svg') }}" alt="Degchi Membership Card" class="card-img-fit" />
                            </div>

                            <!-- Text Details -->
                            <div class="card-body-details p-4 p-lg-5">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h3 class="card-main-title">Membership Card</h3>
                                    <div class="luxury-action-arrow">
                                        <iconify-icon icon="solar:alt-arrow-right-linear"></iconify-icon>
                                    </div>
                                </div>
                                <p class="card-summary-text">
                                    Enjoy unrestricted elite guest access, dedicated 24/7 concierge table reservations,
                                    and premium
                                    corporate seasonal member privileges.
                                </p>
                            </div>

                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>
</main>

@endsection