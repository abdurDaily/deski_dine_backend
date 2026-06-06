@extends('frontend.layout')

@section('frontend_content')
<main class="main-content">
    <section class="section-block reviews-section" id="testimonials">
        <div class="container px-4 px-lg-5">
            <!-- Reviews Header -->
            <div class="mb-4 text-center reveal">
                <h2 class="section-title">What Our Guests Say</h2>
                <div class="title-divider mx-auto"></div>
            </div>

            <!-- Reviews Shell -->
            <div class="reviews-shell">
                <!-- Review Toolbar -->
                <div class="reviews-toolbar">
                    <div>
                        <p class="reviews-kicker">Review layout</p>
                        <h3 class="reviews-toolbar-title">Choose how you want to browse</h3>
                    </div>
                    <div class="reviews-view-switch" role="tablist" aria-label="Switch review layout">
                        <button type="button" class="review-view-btn is-active" data-view="single" aria-pressed="true">Single row</button>
                        <button type="button" class="review-view-btn" data-view="double" aria-pressed="false">Double column</button>
                    </div>
                </div>

                <p class="reviews-hint">Swipe horizontally on mobile in Single row mode, or use a cleaner two-column view on larger screens.</p>

                <!-- Reviews Gallery -->
                <div class="reviews-gallery reviews-gallery--double" id="reviewsGallery">
                    @forelse($reviews as $review)
                    <article class="review-card">
                        <div class="review-quote-icon">
                            <i class="bi bi-quote"></i>
                        </div>
                        <div class="review-stars mb-3">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rating)
                                    <i class="bi bi-star-fill"></i>
                                @else
                                    <i class="bi bi-star"></i>
                                @endif
                            @endfor
                        </div>
                        <p class="review-text">"{{ $review->comment }}"</p>
                        <div class="review-author">
                            @if($review->image)
                                <img src="{{ asset('storage/' . $review->image) }}" class="review-avatar" alt="{{ $review->name }}" />
                            @else
                                @php
                                    $gravatarId = $review->email ? urlencode($review->email) : urlencode($review->name);
                                @endphp
                                <img src="https://i.pravatar.cc/150?u={{ $gravatarId }}" class="review-avatar" alt="{{ $review->name }}" />
                            @endif
                            <div class="author-info">
                                <strong class="d-block">{{ $review->name }}</strong>
                                <span class="text-muted small">{{ $review->title ?? 'Valued Member' }}</span>
                            </div>
                        </div>
                    </article>
                    @empty
                    <div class="col-12">
                        <p class="text-center text-muted py-5">No reviews yet. Be the first to share your experience!</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Pagination -->
            @if($reviews->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $reviews->links() }}
            </div>
            @endif
        </div>
    </section>
</main>

<style>
    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 1rem;
    }

    .title-divider {
        width: 80px;
        height: 4px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        margin: 1rem auto;
    }

    .reviews-shell {
        margin-bottom: 3rem;
    }

    .reviews-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 2rem;
    }

    .reviews-kicker {
        font-size: 0.875rem;
        color: #f39c12;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }

    .reviews-toolbar-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #333;
        margin: 0;
    }

    .reviews-view-switch {
        display: flex;
        gap: 1rem;
        border: 2px solid #e9ecef;
        border-radius: 0.5rem;
        padding: 0.25rem;
    }

    .review-view-btn {
        padding: 0.5rem 1.5rem;
        border: none;
        background: transparent;
        cursor: pointer;
        font-size: 0.95rem;
        font-weight: 500;
        color: #666;
        transition: all 0.3s ease;
        border-radius: 0.375rem;
    }

    .review-view-btn.is-active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .review-view-btn:hover:not(.is-disabled) {
        background-color: #f0f0f0;
    }

    .review-view-btn.is-disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .reviews-hint {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 2rem;
        font-style: italic;
    }

    .reviews-gallery {
        display: grid;
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .reviews-gallery--single {
        grid-template-columns: 1fr;
    }

    .reviews-gallery--double {
        grid-template-columns: repeat(2, 1fr);
    }

    .review-card {
        background: white;
        padding: 2rem;
        border-radius: 0.75rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
    }

    .review-card:hover {
        box-shadow: 0 8px 24px rgba(102, 126, 234, 0.15);
        transform: translateY(-4px);
    }

    .review-quote-icon {
        font-size: 2.5rem;
        color: #f39c12;
        opacity: 0.3;
        margin-bottom: 1rem;
        line-height: 1;
    }

    .review-stars {
        display: flex;
        gap: 0.25rem;
        font-size: 1.1rem;
    }

    .review-stars .bi-star-fill {
        color: #f39c12;
    }

    .review-stars .bi-star {
        color: #ddd;
    }

    .review-text {
        font-size: 1rem;
        line-height: 1.6;
        color: #555;
        margin-bottom: 1.5rem;
        font-style: italic;
    }

    .review-author {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .review-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
    }

    .author-info strong {
        font-size: 0.95rem;
        color: #333;
    }

    .author-info span {
        display: block;
        font-size: 0.85rem;
        color: #999;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .reviews-gallery--double {
            grid-template-columns: 1fr;
        }

        .section-title {
            font-size: 1.75rem;
        }

        .reviews-toolbar {
            flex-direction: column;
            align-items: flex-start;
        }

        .review-card {
            padding: 1.5rem;
        }
    }
</style>

<script>
    // Review Layout Switcher
    document.addEventListener('DOMContentLoaded', function () {
        const gallery = document.getElementById('reviewsGallery');
        const buttons = document.querySelectorAll('.review-view-btn');
        const mobileBreakpoint = 992;

        if (!gallery || buttons.length === 0) {
            return;
        }

        function syncReviewLayout() {
            const isMobile = window.innerWidth < mobileBreakpoint;
            const currentView = isMobile ? 'single' : (gallery.dataset.currentView || 'double');

            gallery.classList.remove('reviews-gallery--single', 'reviews-gallery--double');
            gallery.classList.add(`reviews-gallery--${currentView}`);
            gallery.dataset.currentView = currentView;

            buttons.forEach((button) => {
                const isActive = button.dataset.view === currentView;
                const disableDoubleOnMobile = isMobile && button.dataset.view === 'double';

                button.classList.toggle('is-active', isActive);
                button.setAttribute('aria-pressed', String(isActive));
                button.disabled = disableDoubleOnMobile;
                button.classList.toggle('is-disabled', disableDoubleOnMobile);
            });
        }

        buttons.forEach((button) => {
            button.addEventListener('click', () => {
                if (button.disabled) {
                    return;
                }
                gallery.dataset.currentView = button.dataset.view;
                syncReviewLayout();
            });
        });

        syncReviewLayout();
        window.addEventListener('resize', syncReviewLayout);
    });
</script>
@endsection
