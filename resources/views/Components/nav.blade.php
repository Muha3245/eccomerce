@php
    // Fetch categories with their subcategories
    $categories = helper::category();
@endphp

<nav class="main-nav">
    <ul class="menu sf-arrows">
        <li>
            <a href="category.html" class="sf-with-ul">Shop</a>

            <div class="megamenu megamenu-md">
                <div class="row no-gutters">
                    <div class="col-md-8">
                        <div class="menu-col">
                            <div class="row">
                                <div class="col-md-6">
                                    @foreach ($categories as $category)
                                        <div class="menu-title">{{ $category->name }}</div>
                                        <!-- End .menu-title -->
                                        <ul>
                                            @if ($category->subcategories->isNotEmpty())
                                                @foreach ($category->subcategories as $subcategory)
                                                    <li>
                                                        <a
                                                            href="{{ url('category/' . $subcategory->slug) }}">{{ $subcategory->name }}</a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    @endforeach
                                </div><!-- End .col-md-6 -->

                                <div class="col-md-6">
                                    <div class="menu-title">Shop Pages</div>
                                    <!-- End .menu-title -->
                                    <ul>
                                        <li><a href="cart.html">Cart</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                        <li><a href="wishlist.html">Wishlist</a></li>
                                        <li><a href="dashboard.html">My Account</a></li>
                                        <li><a href="#">Lookbook</a></li>
                                    </ul>
                                </div><!-- End .col-md-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .menu-col -->
                    </div><!-- End .col-md-8 -->

                    <div class="col-md-4">
                        <div class="banner banner-overlay">
                            <a href="category.html" class="banner banner-menu">
                                <img src="assets/images/menu/banner-1.jpg" alt="Banner">

                                <div class="banner-content banner-content-top">
                                    <div class="banner-title text-white">Last
                                        <br>Chance<br><span><strong>Sale</strong></span>
                                    </div>
                                    <!-- End .banner-title -->
                                </div><!-- End .banner-content -->
                            </a>
                        </div><!-- End .banner banner-overlay -->
                    </div><!-- End .col-md-4 -->
                </div><!-- End .row -->
            </div><!-- End .megamenu megamenu-md -->
        </li>
    </ul>
</nav>
