<li class="nav-item">
    <a class="nav-link menu-link" href="#dashboard-nav" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="dashboard-nav">
    <i class="ri-ancient-gate-line"></i><span data-key="t-dashboard">{{__('Dashboard')}}</span>
    </a>
    <div class="collapse menu-dropdown" id="dashboard-nav">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="{{route('dashboard')}}" class="nav-link"><span data-key="t-general-dashboard">{{__('General Dashboard')}}</span></a>
            </li>
            <li class="nav-item">
                <a href="{{route('orders.index')}}" class="nav-link"><span data-key="t-orders">{{__('Orders')}}</span></a>
            </li>
            <li class="nav-item">
                <a href="{{route('members.index')}}" class="nav-link"><span data-key="t-members">{{__('Members')}}</span></a>
            </li>
        </ul>
    </div>
</li>
