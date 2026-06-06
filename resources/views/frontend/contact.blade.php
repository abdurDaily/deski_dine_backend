@extends('frontend.layout')

@section('frontend_content')
<main class="main-content">
    <!-- Contact Section -->
    <section class="contact-section py-5">
        <div class="container px-4 px-lg-5">
            <div class="row align-items-center g-5">
                <!-- Contact Info -->
                <div class="col-lg-5">
                    <div class="contact-info">
                        <h2 class="mb-4 fw-bold" style="color: #333; font-size: 2rem;">Get In Touch</h2>
                        
                        <div class="contact-item mb-4">
                            <div class="contact-icon mb-3">
                                <i class="bi bi-geo-alt" style="font-size: 1.5rem; color: #667eea;"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Address</h5>
                            <p class="text-muted mb-0">
                                Boropool Circle, Kaptan Villa,<br>
                                Halishahar, Chittagong, Bangladesh
                            </p>
                        </div>

                        <div class="contact-item mb-4">
                            <div class="contact-icon mb-3">
                                <i class="bi bi-telephone" style="font-size: 1.5rem; color: #667eea;"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Phone</h5>
                            <p class="text-muted mb-0">
                                <a href="tel:01898795400" style="color: inherit; text-decoration: none;">01898-795400</a>
                            </p>
                        </div>

                        <div class="contact-item mb-4">
                            <div class="contact-icon mb-3">
                                <i class="bi bi-envelope" style="font-size: 1.5rem; color: #667eea;"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Email</h5>
                            <p class="text-muted mb-0">
                                <a href="mailto:degchidine@gmail.com" style="color: inherit; text-decoration: none;">degchidine@gmail.com</a>
                            </p>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon mb-3">
                                <i class="bi bi-clock" style="font-size: 1.5rem; color: #667eea;"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Business Hours</h5>
                            <p class="text-muted mb-0">
                                Monday - Sunday<br>
                                5:00 PM - 11:30 PM
                            </p>
                        </div>

                        <div class="contact-social mt-5">
                            <h5 class="fw-bold mb-3">Follow Us</h5>
                            <div class="d-flex gap-3">
                                <a href="https://www.facebook.com/DegchiDine" target="_blank" class="social-link" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: #f0f0f0; border-radius: 50%; color: #667eea; transition: all 0.3s;">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="#" target="_blank" class="social-link" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: #f0f0f0; border-radius: 50%; color: #667eea; transition: all 0.3s;">
                                    <i class="bi bi-instagram"></i>
                                </a>
                                <a href="#" target="_blank" class="social-link" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: #f0f0f0; border-radius: 50%; color: #667eea; transition: all 0.3s;">
                                    <i class="bi bi-twitter-x"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Review Form / Member Registration Prompt -->
                <div class="col-lg-7">
                    <div id="memberCheckCard" class="review-form-card p-5 rounded-4" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%); border: 1px solid rgba(102, 126, 234, 0.1);">
                        <h3 class="mb-3 fw-bold" style="color: #333;">
                            <i class="bi bi-star-fill" style="color: #f39c12; margin-right: 0.5rem;"></i>
                            Share Your Experience
                        </h3>
                        <p class="text-muted mb-4">Only our valued members can share reviews. Please enter your membership card number to continue.</p>
                        
                        <!-- Member Verification Form -->
                        <form id="memberVerificationForm" class="member-check-form">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="cardNumberCheck" class="form-label fw-bold">
                                    <i class="bi bi-credit-card" style="color: #667eea; margin-right: 0.5rem;"></i>
                                    Membership Card Number *
                                </label>
                                <input type="text" class="form-control" id="cardNumberCheck" name="card_number" required placeholder="Enter your membership card number">
                                <small class="text-muted">
                                    <i class="bi bi-info-circle"></i>
                                    Your card number is on your membership card
                                </small>
                            </div>

                            <div class="d-flex gap-2 mb-4">
                                <button type="submit" class="btn flex-grow-1 fw-bold py-2" id="verifyBtn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
                                    <span id="verifyBtnText">Verify Membership</span>
                                    <span id="verifyBtnSpinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
                                </button>
                            </div>

                            <p class="text-center text-muted small mb-0">
                                Not a member yet? 
                                <a href="{{ route('frontend.card.apply') }}" style="color: #667eea; font-weight: 500; text-decoration: none;">
                                    <i class="bi bi-arrow-right-circle"></i> Register for Membership
                                </a>
                            </p>
                        </form>
                    </div>

                    <!-- Review Form (Hidden until member verified) -->
                    <div id="reviewFormCard" class="review-form-card p-5 rounded-4 d-none" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%); border: 1px solid rgba(102, 126, 234, 0.1);">
                        <div class="alert alert-success mb-4 d-flex align-items-center" role="alert">
                            <i class="bi bi-check-circle-fill me-2" style="font-size: 1.25rem;"></i>
                            <div>
                                <strong>Welcome!</strong> Your membership verified. Please share your review below.
                            </div>
                        </div>

                        <form id="contactReviewForm" class="review-form">
                            @csrf
                            <input type="hidden" name="member_card_number" id="hiddenCardNumber">
                            
                            <!-- Rating Field -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">
                                    <i class="bi bi-star-fill" style="color: #f39c12; margin-right: 0.5rem;"></i>
                                    Your Rating *
                                </label>
                                <div class="rating-selector d-flex gap-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                    <label class="rating-option cursor-pointer">
                                        <input type="radio" name="rating" value="{{ $i }}" required>
                                        <i class="bi bi-star"></i>
                                    </label>
                                    @endfor
                                </div>
                            </div>

                            <!-- Title Field -->
                            <div class="mb-3">
                                <label for="title" class="form-label fw-bold">
                                    <i class="bi bi-pencil-square" style="color: #667eea; margin-right: 0.5rem;"></i>
                                    Review Title (Optional)
                                </label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="e.g., Excellent Service & Delicious Food">
                            </div>

                            <!-- Comment Field -->
                            <div class="mb-3">
                                <label for="comment" class="form-label fw-bold">
                                    <i class="bi bi-chat-left-text" style="color: #667eea; margin-right: 0.5rem;"></i>
                                    Your Review *
                                </label>
                                <textarea class="form-control" id="comment" name="comment" rows="5" required placeholder="Tell us about your dining experience..."></textarea>
                                <small class="text-muted">Minimum 10 characters</small>
                            </div>

                            <!-- Submit & Back Buttons -->
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn flex-grow-1 fw-bold py-2" id="submitReviewBtn" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white;">
                                    <span id="submitBtnText">
                                        <i class="bi bi-send-fill me-2"></i>Submit Review
                                    </span>
                                    <span id="submitBtnSpinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
                                </button>
                                <button type="button" class="btn btn-outline-secondary fw-bold py-2" id="backBtn" onclick="goBackToVerification()">
                                    <i class="bi bi-arrow-left"></i> Back
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
    .contact-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%);
    }

    .contact-info h2 {
        color: #333;
    }

    .contact-item {
        display: flex;
        gap: 1rem;
    }

    .contact-icon {
        flex-shrink: 0;
    }

    .contact-social .social-link:hover {
        background-color: #667eea !important;
        color: white !important;
        transform: translateY(-4px);
    }

    /* Form Styles */
    .form-control {
        border: 1px solid #e9ecef;
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .form-label {
        color: #333;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    /* Rating Selector */
    .rating-selector {
        font-size: 1.75rem;
        margin-top: 0.5rem;
    }

    .rating-option {
        cursor: pointer;
        color: #ddd;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .rating-option input {
        display: none;
    }

    .rating-option:hover .bi,
    .rating-option input:checked ~ .bi {
        color: #f39c12;
    }

    .review-form-card {
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.1);
        transition: all 0.3s ease;
    }

    .review-form-card:hover {
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.15);
    }

    #submitReviewBtn:hover,
    #verifyBtn:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%) !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(102, 126, 234, 0.3);
    }

    .btn-outline-secondary:hover {
        background-color: #f0f0f0;
        border-color: #ddd;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .contact-section .container {
            padding: 0;
        }

        .review-form-card {
            padding: 2rem !important;
        }
    }
</style>

<script>
    // Member Verification
    document.getElementById('memberVerificationForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        const verifyBtn = document.getElementById('verifyBtn');
        const verifyBtnText = document.getElementById('verifyBtnText');
        const verifyBtnSpinner = document.getElementById('verifyBtnSpinner');
        const cardNumber = document.getElementById('cardNumberCheck').value;

        verifyBtn.disabled = true;
        verifyBtnText.textContent = 'Verifying...';
        verifyBtnSpinner.classList.remove('d-none');

        try {
            const response = await fetch('{{ route("frontend.reviews.verify-member") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ card_number: cardNumber }),
            });

            const data = await response.json();

            if (data.success) {
                // Store card number for review form
                document.getElementById('hiddenCardNumber').value = cardNumber;
                
                // Hide verification form, show review form
                document.getElementById('memberCheckCard').classList.add('d-none');
                document.getElementById('reviewFormCard').classList.remove('d-none');
                
                toastr.success(data.message, 'Member Verified');
                
                // Scroll to form
                document.getElementById('reviewFormCard').scrollIntoView({ behavior: 'smooth' });
            } else {
                toastr.error(data.message || 'Verification failed', 'Error');
            }
        } catch (error) {
            toastr.error('An error occurred. Please try again.', 'Error');
            console.error('Error:', error);
        } finally {
            verifyBtn.disabled = false;
            verifyBtnText.textContent = 'Verify Membership';
            verifyBtnSpinner.classList.add('d-none');
        }
    });

    // Go back to verification form
    function goBackToVerification() {
        document.getElementById('memberCheckCard').classList.remove('d-none');
        document.getElementById('reviewFormCard').classList.add('d-none');
        document.getElementById('memberVerificationForm').reset();
        document.getElementById('contactReviewForm').reset();
        document.querySelector('html').scrollTop = 0;
    }

    // Review Form Submit
    document.getElementById('contactReviewForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        const submitBtn = document.getElementById('submitReviewBtn');
        const submitBtnText = document.getElementById('submitBtnText');
        const submitBtnSpinner = document.getElementById('submitBtnSpinner');

        submitBtn.disabled = true;
        submitBtnText.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Submitting...';
        submitBtnSpinner.classList.remove('d-none');

        const formData = new FormData(document.getElementById('contactReviewForm'));
        
        // Log form data for debugging
        console.log('Form Data being sent:');
        for (let [key, value] of formData.entries()) {
            console.log(key + ':', value);
        }

        try {
            const response = await fetch('{{ route("frontend.reviews.store") }}', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                body: formData,
            });

            console.log('Response status:', response.status);
            const data = await response.json();
            console.log('Response data:', data);

            if (data.success) {
                toastr.success(data.message, 'Success');
                document.getElementById('contactReviewForm').reset();
                document.getElementById('memberVerificationForm').reset();
                
                // Reset forms and go back
                setTimeout(() => {
                    window.location.href = '{{ route("frontend.reviews.index") }}';
                }, 2000);
            } else {
                toastr.error(data.message || 'Failed to submit review', 'Error');
            }
        } catch (error) {
            console.error('Fetch error:', error);
            toastr.error('An error occurred. Please try again.', 'Error');
        } finally {
            submitBtn.disabled = false;
            submitBtnText.innerHTML = '<i class="bi bi-send-fill me-2"></i>Submit Review';
            submitBtnSpinner.classList.add('d-none');
        }
    });

    // Star rating interaction
    const ratingOptions = document.querySelectorAll('.rating-option');
    ratingOptions.forEach((option, index) => {
        option.addEventListener('click', () => {
            ratingOptions.forEach((opt, optIndex) => {
                if (optIndex <= index) {
                    opt.classList.add('checked');
                } else {
                    opt.classList.remove('checked');
                }
            });
        });
    });
</script>
@endsection
