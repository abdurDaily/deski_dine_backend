@canAny(['branch-list', 'branch-create'])
    <li class="nav-item">
        <a class="nav-link menu-link" href="#branchNav" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="branchNav">
            <i class="ri-store-2-line"></i> <span data-key="t-branches">Branch Management</span>
        </a>
        <div class="collapse menu-dropdown" id="branchNav">
            <ul class="nav nav-sm flex-column">
                
                @can('branch-list')
                <li class="nav-item">
                    <a href="" class="nav-link" data-key="t-branch-list">
                        Branch List
                    </a>
                </li>
                @endcan

                @can('branch-create')
                <li class="nav-item">
                    <a href="{{ route('admin.branch.create') }}" class="nav-link" data-key="t-branch-create">
                        Create New Branch
                    </a>
                </li>
                @endcan

            </ul>
        </div>
    </li>
@endcanAny