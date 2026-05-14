<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="{{route('dashboard')}}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{asset(Session::get('logo'))}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset(Session::get('logo'))}}" alt="" height="17">
                        </span>
                    </a>

                    <a href="{{route('dashboard')}}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{asset(Session::get('logo'))}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset(Session::get('logo'))}}" alt="" height="17">
                        </span>
                    </a>
                </div>

                <button type="button"
                    class="px-3 btn btn-sm fs-16 header-item vertical-menu-btn topnav-hamburger material-shadow-none"
                    id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->
                <form class="app-search d-none d-md-block">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search..." autocomplete="off"
                            id="search-options" value="">
                        <span class="mdi mdi-magnify search-widget-icon"></span>
                        <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                            id="search-close-options"></span>
                    </div>
                    <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                        <div data-simplebar style="max-height: 320px;">
                            <!-- item-->
                            <div class="dropdown-header">
                                <h6 class="mb-0 text-overflow text-muted text-uppercase">Recent Searches</h6>
                            </div>

                            <div class="bg-transparent dropdown-item text-wrap">
                                <a href="{{route('dashboard')}}" class="btn btn-soft-secondary btn-sm rounded-pill">how
                                    to setup <i class="mdi mdi-magnify ms-1"></i></a>
                                <a href="{{route('dashboard')}}"
                                    class="btn btn-soft-secondary btn-sm rounded-pill">buttons <i
                                        class="mdi mdi-magnify ms-1"></i></a>
                            </div>
                            <!-- item-->
                            <div class="mt-2 dropdown-header">
                                <h6 class="mb-1 text-overflow text-muted text-uppercase">Pages</h6>
                            </div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="align-middle ri-bubble-chart-line fs-18 text-muted me-2"></i>
                                <span>Analytics Dashboard</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="align-middle ri-lifebuoy-line fs-18 text-muted me-2"></i>
                                <span>Help Center</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="align-middle ri-user-settings-line fs-18 text-muted me-2"></i>
                                <span>My account settings</span>
                            </a>

                            <!-- item-->
                            <div class="mt-2 dropdown-header">
                                <h6 class="mb-2 text-overflow text-muted text-uppercase">Members</h6>
                            </div>

                            <div class="notification-list">
                                <!-- item -->
                                <a href="javascript:void(0);" class="py-2 dropdown-item notify-item">
                                    <div class="d-flex">
                                        <img src="{{asset('assets/images/users/avatar-2.jpg')}}"
                                            class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="m-0">Angela Bernier</h6>
                                            <span class="mb-0 fs-11 text-muted">Manager</span>
                                        </div>
                                    </div>
                                </a>
                                <!-- item -->
                                <a href="javascript:void(0);" class="py-2 dropdown-item notify-item">
                                    <div class="d-flex">
                                        <img src="{{asset('assets/images/users/avatar-3.jpg')}}"
                                            class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="m-0">David Grasso</h6>
                                            <span class="mb-0 fs-11 text-muted">Web Designer</span>
                                        </div>
                                    </div>
                                </a>
                                <!-- item -->
                                <a href="javascript:void(0);" class="py-2 dropdown-item notify-item">
                                    <div class="d-flex">
                                        <img src="{{asset('assets/images/users/avatar-5.jpg')}}"
                                            class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="m-0">Mike Bunch</h6>
                                            <span class="mb-0 fs-11 text-muted">React Developer</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="pt-3 pb-1 text-center">
                            <a href="pages-search-results.html" class="btn btn-primary btn-sm">View All Results <i
                                    class="ri-arrow-right-line ms-1"></i></a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center">

                <div class="dropdown d-md-none topbar-head-dropdown header-item">
                    <button type="button"
                        class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle"
                        id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="bx bx-search fs-22"></i>
                    </button>
                    <div class="p-0 dropdown-menu dropdown-menu-lg dropdown-menu-end"
                        aria-labelledby="page-header-search-dropdown">
                        <form class="p-3">
                            <div class="m-0 form-group">

                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..."
                                        aria-label="Recipient's username">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div>
                    <button class="btn btn-primary" id="cacheClear" type="button"><i class="ri-brush-line"></i> Clear
                        Cache</button>
                </div>
                <div class="dropdown ms-1 topbar-head-dropdown header-item">
                    <select name="" class="form-select" id="appLocatization">
                        <option value="en">English</option>
                        <option value="bn" {{Cookie::get('locale')=='bn' ? 'selected' : '' }}>বাংলা</option>
                    </select>
                </div>

                <div class="dropdown topbar-head-dropdown ms-1 header-item">
                    <button type="button"
                        class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class='bx bx-category-alt fs-22'></i>
                    </button>
                    <div class="p-0 dropdown-menu dropdown-menu-lg dropdown-menu-end">
                        <div class="p-3 border border-dashed border-top-0 border-start-0 border-end-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 fw-semibold fs-15"> Web Apps </h6>
                                </div>
                                <div class="col-auto">
                                    <a href="#!" class="btn btn-sm btn-soft-info"> View All Apps
                                        <i class="align-middle ri-arrow-right-s-line"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="p-2">
                            <div class="row g-0">
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="{{asset('assets/images/brands/github.png')}}" alt="Github">
                                        <span>GitHub</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="{{asset('assets/images/brands/bitbucket.png')}}" alt="bitbucket">
                                        <span>Bitbucket</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="{{asset('assets/images/brands/dribbble.png')}}" alt="dribbble">
                                        <span>Dribbble</span>
                                    </a>
                                </div>
                            </div>

                            <div class="row g-0">
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="{{asset('assets/images/brands/dropbox.png')}}" alt="dropbox">
                                        <span>Dropbox</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="{{asset('assets/images/brands/mail_chimp.png')}}" alt="mail_chimp">
                                        <span>Mail Chimp</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="{{asset('assets/images/brands/slack.png')}}" alt="slack">
                                        <span>Slack</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dropdown topbar-head-dropdown ms-1 header-item">
                    <button type="button"
                        class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle"
                        id="page-header-cart-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                        aria-haspopup="true" aria-expanded="false">
                        <i class='bx bx-shopping-bag fs-22'></i>
                        <span
                            class="position-absolute topbar-badge cartitem-badge fs-10 translate-middle badge rounded-pill bg-info">5</span>
                    </button>
                    <div class="p-0 dropdown-menu dropdown-menu-xl dropdown-menu-end dropdown-menu-cart"
                        aria-labelledby="page-header-cart-dropdown">
                        <div class="p-3 border border-dashed border-top-0 border-start-0 border-end-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 fs-16 fw-semibold"> My Cart</h6>
                                </div>
                                <div class="col-auto">
                                    <span class="badge bg-warning-subtle text-warning fs-13"><span
                                            class="cartitem-badge">7</span>
                                        items</span>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 300px;">
                            <div class="p-2">
                                <div class="text-center empty-cart" id="empty-cart">
                                    <div class="mx-auto my-3 avatar-md">
                                        <div class="avatar-title bg-info-subtle text-info fs-36 rounded-circle">
                                            <i class='bx bx-cart'></i>
                                        </div>
                                    </div>
                                    <h5 class="mb-3">Your Cart is Empty!</h5>
                                    <a href="apps-ecommerce-products.html" class="mb-3 btn btn-success w-md">Shop
                                        Now</a>
                                </div>
                                <div class="px-3 py-2 d-block dropdown-item dropdown-item-cart text-wrap">
                                    <div class="d-flex align-items-center">
                                        <img src="{{asset('assets/images/products/img-1.png')}}"
                                            class="p-2 me-3 rounded-circle avatar-sm bg-light" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="mt-0 mb-1 fs-14">
                                                <a href="apps-ecommerce-product-details.html" class="text-reset">Branded
                                                    T-Shirts</a>
                                            </h6>
                                            <p class="mb-0 fs-12 text-muted">
                                                Quantity: <span>10 x $32</span>
                                            </p>
                                        </div>
                                        <div class="px-2">
                                            <h5 class="m-0 fw-normal">$<span class="cart-item-price">320</span></h5>
                                        </div>
                                        <div class="ps-2">
                                            <button type="button"
                                                class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn"><i
                                                    class="ri-close-fill fs-16"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-3 py-2 d-block dropdown-item dropdown-item-cart text-wrap">
                                    <div class="d-flex align-items-center">
                                        <img src="{{asset('assets/images/products/img-2.png')}}"
                                            class="p-2 me-3 rounded-circle avatar-sm bg-light" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="mt-0 mb-1 fs-14">
                                                <a href="apps-ecommerce-product-details.html"
                                                    class="text-reset">Bentwood Chair</a>
                                            </h6>
                                            <p class="mb-0 fs-12 text-muted">
                                                Quantity: <span>5 x $18</span>
                                            </p>
                                        </div>
                                        <div class="px-2">
                                            <h5 class="m-0 fw-normal">$<span class="cart-item-price">89</span></h5>
                                        </div>
                                        <div class="ps-2">
                                            <button type="button"
                                                class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn"><i
                                                    class="ri-close-fill fs-16"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-3 py-2 d-block dropdown-item dropdown-item-cart text-wrap">
                                    <div class="d-flex align-items-center">
                                        <img src="{{asset('assets/images/products/img-3.png')}}"
                                            class="p-2 me-3 rounded-circle avatar-sm bg-light" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="mt-0 mb-1 fs-14">
                                                <a href="apps-ecommerce-product-details.html" class="text-reset">
                                                    Borosil Paper Cup</a>
                                            </h6>
                                            <p class="mb-0 fs-12 text-muted">
                                                Quantity: <span>3 x $250</span>
                                            </p>
                                        </div>
                                        <div class="px-2">
                                            <h5 class="m-0 fw-normal">$<span class="cart-item-price">750</span></h5>
                                        </div>
                                        <div class="ps-2">
                                            <button type="button"
                                                class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn"><i
                                                    class="ri-close-fill fs-16"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-3 py-2 d-block dropdown-item dropdown-item-cart text-wrap">
                                    <div class="d-flex align-items-center">
                                        <img src="{{asset('assets/images/products/img-6.png')}}"
                                            class="p-2 me-3 rounded-circle avatar-sm bg-light" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="mt-0 mb-1 fs-14">
                                                <a href="apps-ecommerce-product-details.html" class="text-reset">Gray
                                                    Styled T-Shirt</a>
                                            </h6>
                                            <p class="mb-0 fs-12 text-muted">
                                                Quantity: <span>1 x $1250</span>
                                            </p>
                                        </div>
                                        <div class="px-2">
                                            <h5 class="m-0 fw-normal">$ <span class="cart-item-price">1250</span></h5>
                                        </div>
                                        <div class="ps-2">
                                            <button type="button"
                                                class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn"><i
                                                    class="ri-close-fill fs-16"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-3 py-2 d-block dropdown-item dropdown-item-cart text-wrap">
                                    <div class="d-flex align-items-center">
                                        <img src="{{asset('assets/images/products/img-5.png')}}"
                                            class="p-2 me-3 rounded-circle avatar-sm bg-light" alt="user-pic">
                                        <div class="flex-grow-1">
                                            <h6 class="mt-0 mb-1 fs-14">
                                                <a href="apps-ecommerce-product-details.html"
                                                    class="text-reset">Stillbird Helmet</a>
                                            </h6>
                                            <p class="mb-0 fs-12 text-muted">
                                                Quantity: <span>2 x $495</span>
                                            </p>
                                        </div>
                                        <div class="px-2">
                                            <h5 class="m-0 fw-normal">$<span class="cart-item-price">990</span></h5>
                                        </div>
                                        <div class="ps-2">
                                            <button type="button"
                                                class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn"><i
                                                    class="ri-close-fill fs-16"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 border border-dashed border-bottom-0 border-start-0 border-end-0"
                            id="checkout-elem">
                            <div class="pb-3 d-flex justify-content-between align-items-center">
                                <h5 class="m-0 text-muted">Total:</h5>
                                <div class="px-2">
                                    <h5 class="m-0" id="cart-item-total">$1258.58</h5>
                                </div>
                            </div>

                            <a href="apps-ecommerce-checkout.html" class="text-center btn btn-success w-100">
                                Checkout
                            </a>
                        </div>
                    </div>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                        class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle"
                        data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                        class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

                <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                    <button type="button"
                        class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle"
                        id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                        aria-haspopup="true" aria-expanded="false">
                        <i class='bx bx-bell fs-22'></i>
                        <span
                            class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{
                            auth()->user()->unreadNotifications->count() }}
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </button>
                    <div class="p-0 dropdown-menu dropdown-menu-lg dropdown-menu-end"
                        aria-labelledby="page-header-notifications-dropdown">

                        <div class="dropdown-head bg-primary bg-pattern rounded-top">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 text-white fs-16 fw-semibold"> Notifications </h6>
                                    </div>
                                    <div class="col-auto dropdown-tabs">
                                        <span class="badge bg-light text-body fs-13"> {{
                                            auth()->user()->unreadNotifications->count() }} New</span>
                                    </div>
                                </div>
                            </div>

                            <div class="px-2 pt-2">
                                <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true"
                                    id="notificationItemsTab" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab"
                                            aria-selected="true">
                                            All
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab" href="#messages-tab" role="tab"
                                            aria-selected="false">
                                            Messages
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab" href="#alerts-tab" role="tab"
                                            aria-selected="false">
                                            Alerts
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="tab-content position-relative" id="notificationItemsTabContent">
                            <div class="py-2 tab-pane fade show active ps-2" id="all-noti-tab" role="tabpanel">
                                <div data-simplebar style="max-height: 300px;" class="pe-2">
                                    @foreach(auth()->user()->unreadNotifications()->latest()->paginate(5) as $notification)
                                    {{-- Notification for File System --}}
                                    @if ($notification->type == 'App\Notifications\FileNotification')
                                    <div class="text-reset notification-item d-block dropdown-item position-relative">
                                        <div class="d-flex">
                                            <img src="{{isset($notification?->data['profile']) ? $notification?->data['profile'] : '' }}"
                                                class="flex-shrink-0 me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-grow-1">
                                                <a href="{{ $notification->type == 'App\Notifications\FileNotification' ?
                                                        route('files.show', ['notifyId'=> $notification->id,'id'=>$notification->data['id']]) : '' }}"
                                                    class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">{{
                                                        $notification->data['sharer_name'] ?? '' }}</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <a class="mb-1"
                                                        href="{{ $notification->type == 'App\Notifications\FileNotification' ?
                                                        route('files.show', ['notifyId'=> $notification->id,'id'=>$notification->data['id']]) : '' }}">
                                                        {{ $notification->data['msg'] }}
                                                    </a>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> {{
                                                        Carbon\Carbon::parse($notification->created_at)->diffForHumans()
                                                        }} </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    {{-- Notification for Complaint System --}}
                                    @if ($notification->type == 'App\Notifications\ComplaintNotification')
                                    <div class="text-reset notification-item d-block dropdown-item position-relative">
                                        <div class="d-flex">
                                            <img src="{{asset(Session::get('logo'))}}"
                                                class="flex-shrink-0 me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-grow-1">
                                                <a href="{{ $notification->type == 'App\Notifications\ComplaintNotification' ?
                                                    route($notification->data['type'] == "show" ? 'complaints.show'
                                                    : 'complaints.show.remarks' ,
                                                    [$notification->data['complaintId'],$notification->id]) : '' }}"
                                                    class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">{{ Config::get('app.name') .
                                                        __(' HR Department') }}</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <a class="mb-1"
                                                        href="{{ $notification->type == 'App\Notifications\ComplaintNotification' ?
                                                                                            route($notification->data['type'] == "show" ? 'complaints.show' : 'complaints.show.remarks' ,
                                                        [$notification->data['complaintId'],$notification->id]) : ''
                                                        }}">
                                                        {{ $notification->data['msg'] }}
                                                    </a>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> {{
                                                        Carbon\Carbon::parse($notification->created_at)->diffForHumans()
                                                        }} </span>
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                    {{-- Notification for Complaint System --}}





                                    <div class="my-3 text-center view-all">
                                        <a href="{{ route('notify.index') }}"
                                            class="btn btn-soft-success waves-effect waves-light">View
                                            All Notifications <i class="align-middle ri-arrow-right-line"></i></a>
                                    </div>
                                </div>

                            </div>



                            <div class="notification-actions" id="notification-actions">
                                <div class="d-flex text-muted justify-content-center">
                                    Select <div id="select-content" class="px-1 text-body fw-semibold">0</div> Result
                                    <button type="button" class="p-0 btn btn-link link-danger ms-3"
                                        data-bs-toggle="modal" data-bs-target="#removeNotificationModal">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user"
                                src="{{ Auth::user()->profile_image }}" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span
                                    class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{Auth::user()->name}}</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome {{Auth::user()->name}}</h6>
                        <a class="dropdown-item" href="{{route('profile')}}"><i
                                class="align-middle mdi mdi-account-circle text-muted fs-16 me-1"></i> <span
                                class="align-middle">Profile</span></a>
                        <a class="dropdown-item" href="apps-chat.html"><i
                                class="align-middle mdi mdi-message-text-outline text-muted fs-16 me-1"></i> <span
                                class="align-middle">Messages</span></a>
                        <a class="dropdown-item" href="apps-tasks-kanban.html"><i
                                class="align-middle mdi mdi-calendar-check-outline text-muted fs-16 me-1"></i> <span
                                class="align-middle">Taskboard</span></a>
                        <a class="dropdown-item" href="pages-faqs.html"><i
                                class="align-middle mdi mdi-lifebuoy text-muted fs-16 me-1"></i> <span
                                class="align-middle">Help</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="pages-profile.html"><i
                                class="align-middle mdi mdi-wallet text-muted fs-16 me-1"></i> <span
                                class="align-middle">Balance : <b>$5971.67</b></span></a>
                        <a class="dropdown-item" href="pages-profile-settings.html"><span
                                class="mt-1 badge bg-success-subtle text-success float-end">New</span><i
                                class="align-middle mdi mdi-cog-outline text-muted fs-16 me-1"></i> <span
                                class="align-middle">Settings</span></a>
                        <a class="dropdown-item" href="auth-lockscreen-basic.html"><i
                                class="align-middle mdi mdi-lock text-muted fs-16 me-1"></i> <span
                                class="align-middle">Lock screen</span></a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i
                                        class="align-middle mdi mdi-logout text-muted fs-16 me-1"></i> <span
                                        class="align-middle" data-key="t-logout">Logout</span></button>
                                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
