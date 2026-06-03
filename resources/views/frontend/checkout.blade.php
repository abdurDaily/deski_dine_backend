@extends('frontend.layout')
@section('frontend_content')
<div class="cart-page-hero">
    <div class="container px-4 px-lg-5">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <span class="menu-kicker"><i class="bi bi-shield-lock"></i> Secure Order</span>
                <h1 class="cart-hero-title mt-1">Checkout</h1>
            </div>
            <div class="cart-stepper">
                <span class="cart-step">
                    <i class="bi bi-bag me-1"></i>Cart
                </span>
                <i class="bi bi-chevron-right cart-step-arrow"></i>
                <span class="cart-step cart-step-active">
                    <i class="bi bi-credit-card me-1"></i>Checkout
                </span>
                <i class="bi bi-chevron-right cart-step-arrow"></i>
                <span class="cart-step">
                    <i class="bi bi-check-circle me-1"></i>Confirmed
                </span>
            </div>
        </div>
    </div>
</div>

<section class="section-block cart-page-section">
    <div class="container px-4 px-lg-5">
        <div class="row g-4 align-items-start">
            <div class="col-lg-7">
                <form id="checkoutForm" class="checkout-form-card" action="{{ route('frontend.order.store') }}"
                    method="POST">
                    @csrf

                    <div id="checkoutMessages"></div>

                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('clear_cart'))
                    <script>
                        localStorage.removeItem('degchi_cart');
                    </script>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="checkout-form-section">
                        <h6 class="checkout-form-heading">
                            <span class="checkout-step-num">1</span>
                            Delivery Details
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <div class="checkout-input-wrap">
                                    <i class="bi bi-person checkout-input-icon"></i>
                                    <input class="form-control checkout-input" required type="text" name="customer_name"
                                        id="customer_name" placeholder="e.g. Rahim Uddin" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <div class="checkout-input-wrap">
                                    <i class="bi bi-telephone checkout-input-icon"></i>
                                    <input class="form-control checkout-input" required type="tel" name="customer_phone"
                                        id="customer_phone" placeholder="01XXXXXXXXX" />
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Delivery Address</label>
                                <div class="checkout-input-wrap checkout-textarea-wrap">
                                    <i class="bi bi-geo-alt checkout-input-icon checkout-textarea-icon"></i>
                                    <textarea class="form-control checkout-input" required rows="3"
                                        name="customer_address" id="customer_address"
                                        placeholder="House/Flat, Road, Area, City"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Membership Card Number</label>
                                <div class="checkout-input-wrap">
                                    <i class="bi bi-credit-card checkout-input-icon"></i>
                                    <input class="form-control checkout-input" type="text" name="member_card_number"
                                        id="memberCardNumber"
                                        placeholder="Enter your registered card number (leave blank to continue as guest)" />
                                </div>
                                <div id="membershipFeedback" class="form-text text-muted mt-2">Enter your membership
                                    card number to check eligibility for a 10% discount.</div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check mt-4 pt-2">
                                    <input class="form-check-input" type="checkbox" name="student_card" value="1"
                                        id="studentCard" />
                                    <label class="form-check-label" for="studentCard">I can show a student card</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Order Total (৳)</label>
                                <div class="checkout-input-wrap">
                                    <i class="bi bi-cash-stack checkout-input-icon"></i>
                                    <input class="form-control checkout-input" required readonly type="number"
                                        step="0.01" min="0" name="order_total" id="order_total" value="0" />
                                </div>
                            </div>
                            <input type="hidden" name="items" id="cart_items" value="[]" />
                        </div>
                    </div>

                    <div class="checkout-form-divider"></div>

                    <div class="checkout-form-section">
                        <h6 class="checkout-form-heading">
                            <span class="checkout-step-num">2</span>
                            Payment Method
                        </h6>
                        <div class="checkout-payment-options">
                            <label class="checkout-payment-card">
                                <input type="radio" name="payment_method" value="cod" checked />
                                <span class="checkout-payment-body">
                                    <i class="bi bi-cash-stack checkout-payment-icon"></i>
                                    <span>Cash on Delivery</span>
                                </span>
                            </label>
                            <label class="checkout-payment-card">
                                <input type="radio" name="payment_method" value="sslcommerz" />
                                <span class="checkout-payment-body">
                                    <i class="bi bi-phone checkout-payment-icon" style="color: #e2136e"></i>
                                    <span>SSLCommerz (Online Payment)</span>
                                </span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-5">
                <div class="cart-summary-card checkout-summary-sticky">
                    <div class="cart-summary-header">
                        <i class="bi bi-receipt me-2"></i>Your Order
                    </div>

                    <div class="checkout-summary-items-wrap" id="orderSummaryList">
                        <div class="text-center py-3 text-muted">
                            Your selected products will appear here.
                        </div>
                    </div>

                    <div class="cart-summary-body">
                        <div class="cart-summary-row">
                            <span>Subtotal <small class="text-muted" id="itemCount">(0 items)</small></span>
                            <span id="checkoutSubtotal">৳ 0.00</span>
                        </div>
                        <div class="cart-summary-row">
                            <span>Membership Discount</span>
                            <span id="checkoutDiscount">৳ 0.00</span>
                        </div>
                        <div class="cart-summary-row">
                            <span>Delivery</span>
                            <span class="cart-free-tag">Free</span>
                        </div>
                        <div class="cart-summary-divider"></div>
                        <div class="cart-summary-total-row">
                            <span>Total</span>
                            <strong id="checkoutTotal" class="cart-summary-total-val">৳ 0.00</strong>
                        </div>
                    </div>

                    <div class="cart-summary-footer">
                        <button type="submit" id="placeOrderBtn" form="checkoutForm"
                            class="btn cart-checkout-btn w-100">
                            <i class="bi bi-bag-check me-2"></i>Place Order
                        </button>

                        <p class="cart-secure-note mt-3 mb-0 text-center">
                            <i class="bi bi-shield-check me-1"></i>Your information is 100% secure
                        </p>
                    </div>
                </div>

                <a href="{{ route('frontend.addtocart') }}"
                    class="cart-continue-link mt-3 d-inline-flex align-items-center">
                    <i class="bi bi-arrow-left me-2"></i>Back to Cart
                </a>
            </div>
        </div>
    </div>
</section>

@push('front_js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
                const checkoutForm = document.getElementById('checkoutForm');
                const submitButton = document.getElementById('placeOrderBtn');
                const memberCardInput = document.getElementById('memberCardNumber');
                const membershipFeedback = document.getElementById('membershipFeedback');
                const discountDisplay = document.getElementById('checkoutDiscount');
                const totalDisplay = document.getElementById('checkoutTotal');
                const subtotalDisplay = document.getElementById('checkoutSubtotal');
                const orderTotalInput = document.getElementById('order_total');

                function showToast(type, text) {
                    if (typeof toastr !== 'undefined') {
                        toastr.options = {
                            closeButton: true,
                            progressBar: true,
                            positionClass: 'toast-top-right',
                        };
                        toastr[type](text);
                    } else {
                        alert(text);
                    }
                }

                function updateDiscountDisplay(discountAmount) {
                    discountDisplay.textContent = `৳ ${discountAmount.toFixed(2)}`;
                    const subtotal = parseFloat(orderTotalInput.value) || 0;
                    totalDisplay.textContent = `৳ ${(subtotal - discountAmount).toFixed(2)}`;
                }

                function handleQueryMessage() {
                    const params = new URLSearchParams(window.location.search);
                    const result = params.get('payment_result');
                    if (!result) {
                        return;
                    }
                    const message = params.get('payment_message') || (result === 'success' ? 'Payment completed.' : 'Payment failed.');
                    showToast(result === 'success' ? 'success' : 'error', message);
                    if (params.get('clear_cart') === '1') {
                        localStorage.removeItem('degchi_cart');
                    }
                    window.history.replaceState({}, document.title, window.location.pathname);
                }

                async function checkMemberCardEligibility(cardNumber) {
                    if (!cardNumber) {
                        membershipFeedback.textContent = 'Enter your membership card number to check eligibility for a 10% discount.';
                        membershipFeedback.classList.remove('text-success', 'text-danger');
                        updateDiscountDisplay(0);
                        return;
                    }

                    try {
                        const response = await fetch(`{{ route('frontend.member.check') }}?member_card_number=${encodeURIComponent(cardNumber)}`);
                        const result = await response.json();

                        if (!response.ok) {
                            membershipFeedback.textContent = result.message || 'Unable to verify membership card.';
                            membershipFeedback.classList.remove('text-success');
                            membershipFeedback.classList.add('text-danger');
                            updateDiscountDisplay(0);
                            return;
                        }

                        membershipFeedback.textContent = result.message;
                        membershipFeedback.classList.remove('text-danger');
                        membershipFeedback.classList.add('text-success');

                        const subtotal = parseFloat(orderTotalInput.value) || 0;
                        const discountAmount = result.eligible ? parseFloat((subtotal * (result.discount_rate / 100)).toFixed(2)) : 0;
                        updateDiscountDisplay(discountAmount);
                    } catch (error) {
                        membershipFeedback.textContent = 'Unable to verify membership card at the moment.';
                        membershipFeedback.classList.remove('text-success');
                        membershipFeedback.classList.add('text-danger');
                        updateDiscountDisplay(0);
                    }
                }

                function buildFormData(form) {
                    const formData = new FormData(form);
                    formData.set('_token', document.querySelector('input[name="_token"]').value);
                    return formData;
                }

                if (memberCardInput) {
                    memberCardInput.addEventListener('change', function() {
                        checkMemberCardEligibility(this.value.trim());
                    });
                }

                if (checkoutForm) {
                    checkoutForm.addEventListener('submit', async function(event) {
                        event.preventDefault();

                        if (!submitButton) {
                            return;
                        }

                        submitButton.disabled = true;
                        submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Processing...';

                        try {
                            const response = await fetch(checkoutForm.action, {
                                method: 'POST',
                                body: buildFormData(checkoutForm),
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                },
                            });

                            const result = await response.json();

                            if (!response.ok) {
                                if (result.errors) {
                                    const messages = Object.values(result.errors).flat().join('\n');
                                    showToast('error', messages);
                                } else {
                                    showToast('error', result.message || 'Unable to place order.');
                                }
                                return;
                            }

                            if (result.redirect_url) {
                                window.location.href = result.redirect_url;
                                return;
                            }

                            if (result.success) {
                                if (result.clear_cart) {
                                    localStorage.removeItem('degchi_cart');
                                }
                                showToast('success', result.message || 'Order placed successfully.');
                                checkoutForm.reset();
                                document.getElementById('orderSummaryList').innerHTML = '<div class="text-center py-3 text-muted">Your selected products will appear here.</div>';
                                subtotalDisplay.textContent = '৳ 0.00';
                                totalDisplay.textContent = '৳ 0.00';
                                discountDisplay.textContent = '৳ 0.00';
                                document.getElementById('itemCount').textContent = '(0 items)';
                                membershipFeedback.textContent = 'Enter your membership card number to check eligibility for a 10% discount.';
                                membershipFeedback.classList.remove('text-success', 'text-danger');
                            }
                        } catch (error) {
                            showToast('error', error.message || 'Server error while placing order.');
                        } finally {
                            submitButton.disabled = false;
                            submitButton.innerHTML = '<i class="bi bi-bag-check me-2"></i>Place Order';
                        }
                    });
                }

                handleQueryMessage();

                const flashMessage = @json(session('success') ?? session('error'));
                const flashType = @json(session('success') ? 'success' : 'error');
                if (flashMessage) {
                    showToast(flashType, flashMessage);
                }
            });
</script>
@endpush
@endsection