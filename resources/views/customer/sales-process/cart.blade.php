@extends('customer.layouts.master-two-col')

@section('head-tag')
    <title>سبد خرید شما</title>

    {{-- toaster --}}
    <link rel="stylesheet" href="{{ asset('customer-assets/css/toastr.min.css') }}">
@endsection


@section('content')
    <!-- start cart -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>سبد خرید شما</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <section class="row mt-4">
                        <section class="col-md-9 mb-3">

                            <form action="" id="cart-item" method="post"
                                class="content-wrapper bg-white p-3 rounded-2">
                                @csrf

                                @php
                                    $totalProductPrice = 0;
                                    $totalDiscount = 0;
                                @endphp

                                @foreach ($cartItems as $cartItem)
                                    @php
                                        $totalProductPrice += $cartItem->cartItemProductPrice();
                                        $totalDiscount += $cartItem->cartItemProductDiscount();
                                    @endphp

                                    <section class="cart-item d-md-flex py-3" id="{{ $cartItem->id }}">
                                        <section class="cart-img align-self-start flex-shrink-1"><img
                                                src="{{ asset($cartItem->product->image['indexArray']['medium']) }}"
                                                alt=""></section>
                                        <section class="align-self-start w-100">
                                            <p class="fw-bold">{{ $cartItem->product->name }}</p>
                                            <p>
                                                @if (!empty($cartItem->color))
                                                    <span style="background-color: {{ $cartItem->color->color }};"
                                                        class="cart-product-selected-color me-1">
                                                    </span>
                                                    <span>{{ $cartItem->color->color_name }}</span>
                                                @else
                                                    <span>کالای فوق فاقد رنگ است</span>
                                                @endif
                                            </p>
                                            <p>
                                                @if (!empty($cartItem->guarantee))
                                                    <i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i>
                                                    <span>
                                                        {{ $cartItem->guarantee->name }}</span>
                                                @else
                                                    <i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i>
                                                    <span>
                                                        فاقد گارانتی</span>
                                                @endif
                                            </p>
                                            <p><i class="fa fa-store-alt cart-product-selected-store me-1"></i> <span>کالا
                                                    موجود در انبار</span></p>
                                            <section>
                                                <section class="cart-product-number d-inline-block ">
                                                    <button class="cart-number cart-number-down" type="button">-</button>
                                                    <input class="number"
                                                        data-product-price="{{ $cartItem->cartItemProductPrice() }}"
                                                        data-product-discount="{{ $cartItem->cartItemProductDiscount() }}"
                                                        type="number" min="1" max="5" step="1"
                                                        value="1" readonly="readonly">
                                                    <button class="cart-number cart-number-up" type="button">+</button>
                                                </section>



                                                <span
                                                    data-url="{{ route('customer.sales-process.remove-from-cart', $cartItem) }}"
                                                    data-id="{{ $cartItem->id }}"
                                                    class="pointer ms-4 cart-delete"
                                                    onclick="removeFromCart(this)">
                                                    <input type="hidden" value="{{ csrf_token() }}">

                                                    <i class="fa fa-trash-alt"></i> حذف از سبد</span>


                                            </section>
                                        </section>
                                        <section class="align-self-end flex-shrink-1">
                                            @if (!empty($cartItem->product->activeAmazingSales()))
                                                <section class="cart-item-discount text-danger text-nowrap mb-1">تخفیف
                                                    {{ digitGroup($cartItem->cartItemProductDiscount()) }}</section>
                                            @endif
                                            <section class="text-nowrap fw-bold">
                                                {{ digitGroup($cartItem->cartItemProductPrice()) }} تومان</section>
                                        </section>
                                    </section>
                                @endforeach
                            </form>
                        </section>

                        <section class="col-md-3">
                            <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">تعداد کالاها </p>
                                    <p class="text-muted" id="total_count">{{ digitGroup($cartItems->count()) }} عدد</p>
                                </section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">قیمت کالاها</p>
                                    <p class="text-muted" id="total_product_price">{{ digitGroup($totalProductPrice) }}
                                        تومان</p>
                                </section>

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">تخفیف کالاها</p>
                                    <p class="text-danger fw-bolder" id="total_discount_price">
                                        {{ digitGroup($totalDiscount) }} تومان</p>
                                </section>
                                <section class="border-bottom mb-3"></section>
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">جمع سبد خرید</p>
                                    <p class="fw-bolder" id="total_price">
                                        {{ digitGroup($totalProductPrice - $totalDiscount) }} تومان</p>
                                </section>

                                <p class="my-3">
                                    <i class="fa fa-info-circle me-1"></i>کاربر گرامی خرید شما هنوز نهایی نشده است. برای ثبت
                                    سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را انتخاب کنید.
                                    نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت پرداخت این
                                    سفارش صورت میگیرد.
                                </p>


                                <section class="">
                                    <a href="address.html" class="btn btn-danger d-block">تکمیل فرآیند خرید</a>
                                </section>

                            </section>
                        </section>
                    </section>
                </section>
            </section>

        </section>
    </section>
    <!-- end cart -->


    {{-- related product --}}
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>کالاهای مرتبط با سبد خرید شما</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <!-- start vontent header -->
                        <section class="lazyload-wrapper">
                            <section class="lazyload light-owl-nav owl-carousel owl-theme">

                                @foreach ($relatedProducts as $relatedProduct)
                                    <section class="item">
                                        <section class="lazyload-item-wrapper">
                                            <section class="product">
                                                <section class="product-add-to-cart"><a href="#"
                                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                                        title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a>
                                                </section>

                                                @guest
                                                    <section class="product-add-to-favorite">
                                                        <button
                                                            data-url="{{ route('customer.market.add-to-favorite', $relatedProduct) }}"
                                                            class="btn btn-light btn-sm border-0 bg-transparent shadow-none"
                                                            data-bs-toggle="tooltip" data-bs-placement="left"
                                                            title="افزودن به علاقه مندی"><i class="fa fa-heart text-dark"></i>
                                                        </button>
                                                    </section>
                                                @endguest

                                                @auth
                                                    @if ($relatedProduct->user->contains(auth()->user()->id))
                                                        <section class="product-add-to-favorite">
                                                            <button
                                                                data-url="{{ route('customer.market.add-to-favorite', $relatedProduct) }}"
                                                                class="btn btn-light btn-sm border-0 bg-transparent shadow-none"
                                                                data-bs-toggle="tooltip" data-bs-placement="left"
                                                                title="حذف از علاقه مندی"><i
                                                                    class="fa fa-heart text-danger"></i>
                                                            </button>
                                                        </section>
                                                    @else
                                                        <section class="product-add-to-favorite">
                                                            <button
                                                                data-url="{{ route('customer.market.add-to-favorite', $relatedProduct) }}"
                                                                class="btn btn-light btn-sm border-0 bg-transparent shadow-none"
                                                                data-bs-toggle="tooltip" data-bs-placement="left"
                                                                title="اضافه به علاقه مندی"><i
                                                                    class="fa fa-heart text-dark"></i>
                                                            </button>
                                                        </section>
                                                    @endif
                                                @endauth


                                                <a class="product-link" href="#">
                                                    <section class="product-image">
                                                        <img class=""
                                                            src="{{ asset($relatedProduct->image['indexArray']['medium']) }}"
                                                            alt="">
                                                    </section>
                                                    <section class="product-name">
                                                        <h3>{{ $relatedProduct->name }}</h3>
                                                    </section>
                                                    <section class="product-price-wrapper">
                                                        <section class="product-price">
                                                            {{ digitGroup($relatedProduct->price) }} تومان</section>
                                                    </section>
                                                    <section class="product-colors">
                                                        @foreach ($relatedProduct->colors()->get() as $color)
                                                            <section class="product-colors-item"
                                                                style="background-color: {{ $color->color }};"></section>
                                                        @endforeach
                                                    </section>
                                                </a>
                                            </section>
                                        </section>
                                    </section>
                                @endforeach


                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>

    <x-loading />
@endsection


@section('script')
    {{-- اضافه و حذف از علاقمندی ها --}}
    @include('customer.layouts.toastr')


    {{-- افزودن به علاقمندی --}}
    <script>
        $('.product-add-to-favorite button').click(function() {
            var url = $(this).attr('data-url');
            var element = $(this);

            useAjax(element, url, "btn");

        });

        $('.product-add-to-favorite i').click(function() {
            var url = $(this).attr('data-url');
            var element = $(this);

            useAjax(element, url, "i");

        });


        function useAjax(element, url, type) {


            // display loading
            $('#loading').fadeIn();
            $('#loading').css('display', 'flex');


            $.ajax({
                url: url,
                type: 'get',
                success: function(result) {

                    // hide loading
                    $('#loading').fadeOut()

                    if (result.status == 1) {

                        if (type == "btn") {
                            $(element).children().first().addClass('text-danger');
                            $(element).children().first().removeClass('text-dark');
                            $(element).attr('data-original-title', 'حذف از لیست علاقه مندی ها');
                            $(element).attr('data-bs-original-title', 'حذف از لیست علاقه مندی ها');
                        } else {
                            $(element).addClass('text-danger');
                            $(element).removeClass('text-dark');
                            $('.product-add-to-favorite span').html('حذف از لیست علاقه مندی ها');
                        }

                        toastr.success("  .به لیست علاقه مندی ها اضافه گردید");

                    } else if (result.status == 2) {

                        if (type == "btn") {
                            $(element).children().first().addClass('text-dark');
                            $(element).children().first().removeClass('text-danger');
                            $(element).attr('data-original-title', 'افزودن به لیست علاقه مندی ها');
                            $(element).attr('data-bs-original-title', 'افزودن به لیست علاقه مندی ها');
                        } else {
                            $(element).addClass('text-dark');
                            $(element).removeClass('text-danger');
                            $('.product-add-to-favorite span').html('افزودن به لیست علاقه مندی ها');
                        }

                        toastr.error("  .از لیست علاقه مندی ها حذف گردید");

                    } else if (result.status == 3) {

                        toastr.warning(
                            "لطفا وارد حساب کاربری خود شوید  <br> <a href='{{ route('auth.customer.login-register-form') }}'>ورود / ثبت نام</a"
                        );

                    }
                },
                statusCode: {
                    400: function() {
                        $('#loading').fadeOut();
                        toastr.error("صفحه مورد نظر یافت نشد!");
                    },
                    500: function() {
                        $('#loading').fadeOut();
                        toastr.error("خطای سرور!");
                    }
                }
            });
        }
    </script>


    {{-- ***************************************************************** --}}

    {{-- محاسبه سبد خرید --}}

    <script>
        $(function() {

            bill();

            $('.cart-number').click(function() {
                bill();
            });

        });


        function bill() {

            var total_product_price = 0;
            var total_discount = 0;
            var total_price = 0;

            $('.number').each(function() {
                var productPrice = parseFloat($(this).data('product-price'));
                var productDiscount = parseFloat($(this).data('product-discount'));
                var number = parseFloat($(this).val());

                total_product_price += productPrice * number;
                total_discount += productDiscount * number;

            });

            total_price = total_product_price - total_discount;

            $('#total_product_price').html(toPersianNumber(total_product_price));
            $('#total_discount').html(toPersianNumber(total_discount));
            $('#total_price').html(toPersianNumber(total_price));

        }
    </script>


    {{-- حذف از سبد خرید --}}
    <script>
        function removeFromCart(element) {

            var id = $(element).attr('data-id');
            var url = $(element).attr('data-url');
            var token = $(element).children('input').val();

            // display loading
            $('#loading').fadeIn();
            $('#loading').css('display', 'flex');


            $.ajax({
                url: url,
                method: 'post',
                data: {
                    '_token': token,
                },
                success: function(response) {

                    $('#loading').fadeOut();

                    if (response == 1) {
                        toastr.success("محصول از سبد خرید حذف گردید");
                        $("section#"+id).closest('section').remove();
                    } else {
                        toastr.error("خطایی بوجود آمده است!");
                    }

                },
                error: function() {

                    $('#loading').fadeOut();

                    toastr.error("خطایی بوجود آمده است!");
                }
            });


        }
    </script>
@endsection
