<div class="row g-4 justify-content-center">
    @forelse($menus as $menu)
        @php
            $firstVariation = $menu->variations->sortBy('price')->first();
            $imagePath = $firstVariation?->image ?? 'assets/frontend/images/signature_menu/2.jpg';
            $imageUrl = \Illuminate\Support\Str::startsWith($imagePath, ['http://', 'https://'])
                ? $imagePath
                : asset($imagePath);
        @endphp
        <div class="col-12 col-sm-6 col-lg-4 d-flex reveal-scale visible">
            <a href="#" class="menu-offer-card">
                <div class="menu-offer-image-wrap">
                    <img src="{{ $imageUrl }}" alt="{{ $menu->name }}" class="menu-offer-image" />
                </div>
                <div class="menu-offer-body">
                    <h5 class="menu-offer-title">{{ $menu->name }}</h5>
                    <p class="menu-offer-meta mb-0">
                        {{ \Illuminate\Support\Str::limit($menu->description ?? 'Freshly prepared signature dish from Degchi Dine.', 95) }}
                    </p>
                    <div class="menu-offer-divider"></div>
                    <div class="menu-offer-footer">
                        <div class="menu-offer-price-wrap">
                            <span class="menu-offer-price-label">Starts from</span>
                            <span class="menu-offer-price">৳ {{ number_format((float) ($firstVariation?->price ?? 0), 2) }}</span>
                        </div>
                        <span class="menu-offer-serve">
                            <i class="bi bi-collection"></i> {{ $menu->variations->count() }} option{{ $menu->variations->count() > 1 ? 's' : '' }}
                        </span>
                    </div>
                    <div class="menu-offer-actions" onclick="event.preventDefault()">
                        <button class="menu-offer-cart-btn" type="button">
                            <i class="bi bi-bag-plus" aria-hidden="true"></i>
                            Order Now
                        </button>
                    </div>
                </div>
            </a>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <div class="empty-state-wrap p-5">
                <iconify-icon icon="solar:sad-smiley-outline" width="64" height="64" class="text-muted mb-3"></iconify-icon>
                <h4 class="text-muted">No items found matching your criteria.</h4>
                <p class="text-muted">Try choosing a different category or adjusting the price range.</p>
            </div>
        </div>
    @endforelse
</div>

{{-- Pagination --}}
@if($menus->hasPages())
    <div class="d-flex justify-content-center mt-5">
        <nav class="modern-pagination" aria-label="Menu pagination">
            <ul class="pagination mb-0">
                {{-- Previous Page Link --}}
                @if ($menus->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link" aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link pagination-ajax" href="{{ $menus->previousPageUrl() }}" data-page="{{ $menus->currentPage() - 1 }}" rel="prev" aria-label="Previous">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    </li>
                @endif

                {{-- Pagination Links --}}
                @foreach ($menus->getUrlRange(max(1, $menus->currentPage() - 2), min($menus->lastPage(), $menus->currentPage() + 2)) as $page => $url)
                    @if ($page == $menus->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link pagination-ajax" href="{{ $url }}" data-page="{{ $page }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($menus->hasMorePages())
                    <li class="page-item">
                        <a class="page-link pagination-ajax" href="{{ $menus->nextPageUrl() }}" data-page="{{ $menus->currentPage() + 1 }}" rel="next" aria-label="Next">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link" aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif
