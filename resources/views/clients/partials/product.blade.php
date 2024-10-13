@if (isset($products) && $products->isNotEmpty())
    @foreach ($products as $row)
        <div class="col-lg-4 col-md-4 col-6">
            <div class="collection-card h-100">
                <div class="offer-card">
                    <span>Nổi bật</span>
                </div>
                <div class="collection-img">
                    <a href="{{ route('product.detail', ['slug' => $row->slug]) }}" class="image-wrapper">
                        <img class="img-gluid" src="{{ getImage($row->image) }}" alt="{{ $row->name }}">
                    </a>
                    <div class="view-dt-btn">
                        <div class="plus-icon">
                            <i class="bi bi-plus"></i>
                        </div>
                        <a href="{{ route('product.detail', ['slug' => $row->slug]) }}">Xem chi
                            tiết</a>
                    </div>
                    <ul class="cart-icon-list">
                        <li>
                            <a onclick="showProductDetailsModal({{ $row->id }})">
                                <i class="bi bi-eye-fill text-white"></i>
                            </a>
                        </li>
                        <li><a href="#"><img src="{{ asset('assets/clients/images/icon/Icon-favorites3.svg') }}"
                                    alt></a>
                        </li>
                    </ul>
                </div>
                <div class="collection-content text-center">
                    <h4 class="title-limit"><a
                            href="{{ route('product.detail', ['slug' => $row->slug]) }}">{{ $row->name }}</a>
                    </h4>
                    <div class="price">
                        @if ($row->min_price == $row->max_price)
                            <h6>{{ format_cash($row->min_price) }}</h6>
                        @else
                            <h6>{{ format_cash($row->min_price) . '-' . format_cash($row->max_price) }}</h6>
                        @endif
                        @if ($row->old_price)
                            <del>{{ format_cash($row->old_price) }}</del>
                        @endif
                    </div>
                    <div class="review">
                        <ul>
                            <li><i class="bi bi-star-fill"></i></li>
                            <li><i class="bi bi-star-fill"></i></li>
                            <li><i class="bi bi-star-fill"></i></li>
                            <li><i class="bi bi-star-fill"></i></li>
                            <li><i class="bi bi-star-fill"></i></li>
                        </ul>
                        <span>(50)</span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @if ($products->hasPages())
        <div class="col-lg-12 d-flex justify-content-center">
            <div class="paginations-area">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        {{-- Nút trang trước --}}
                        @if ($products->onFirstPage())
                            <li class="page-item disabled">
                                <a class="page-link">
                                    <i class="bi bi-arrow-left-short"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $products->previousPageUrl() }}">
                                    <i class="bi bi-arrow-left-short"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Các trang --}}
                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Nút trang tiếp theo --}}
                        @if ($products->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $products->nextPageUrl() }}">
                                    <i class="bi bi-arrow-right-short"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <a class="page-link">
                                    <i class="bi bi-arrow-right-short"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    @endif
@else
    <p class="text-center">Không có sản phẩm nào</p>
@endif
