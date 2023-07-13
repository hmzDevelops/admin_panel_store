<aside id="sidebar" class="sidebar">
    <section class="sidebar-container">
        <section class="sidebar-wrapper">

            <a href="{{ route('admin.home') }}" class="sidebar-link">
                <i class="fas fa-home"></i>
                <span>خانه</span>
            </a>

            <section class="sidebar-part-title">بخش محتوی</section>

            <a href="{{ route('admin.content.category.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>دسته ها</span>
            </a>

            <a href="{{ route('admin.content.comment.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>نظرات</span>
            </a>


            <a href="{{ route('admin.content.faq.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>سوالات متداول</span>
            </a>


{{-- ********************************************************************************************** --}}


            <section class="sidebar-part-title">بخش فروشگاه</section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-chart-bar icon"></i>
                    <span>ویترین</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.market.category.index') }}">دسته بندی</a>
                    <a href="{{ route('admin.market.property.index') }}">فرم کالاها</a>
                    <a href="{{ route('admin.market.brand.index') }}">برندها</a>
                    <a href="{{ route('admin.market.product.index') }}">کالاها</a>
                    <a href="{{ route('admin.market.store.index') }}">انبار</a>
                    <a href="{{ route('admin.market.comment.index') }}">نظرات</a>
                </section>
            </section>




            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-chart-bar icon"></i>
                    <span>سفارشات</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.market.order.newOrders') }}">جدید</a>
                    <a href="{{ route('admin.market.order.sending') }}">در حال ارسال</a>
                    <a href="{{ route('admin.market.order.unpaied') }}">پرداخت نشده</a>
                    <a href="{{ route('admin.market.order.canceled') }}">باطل شده</a>
                    <a href="{{ route('admin.market.order.returned') }}">مرجوعی</a>
                    <a href="{{ route('admin.market.order.all') }}">تمام سفارشات</a>
                </section>
            </section>



            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-chart-bar icon"></i>
                    <span>پرداخت</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.market.payment.index') }}">تمام پرداخت ها</a>
                    <a href="{{ route('admin.market.payment.index') }}">پرداخت های آنلاین</a>
                    <a href="{{ route('admin.market.payment.index') }}">پرداخت های آفلاین</a>
                    <a href="{{ route('admin.market.payment.index') }}">پرداخت در محل</a>
                </section>
            </section>



            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-chart-bar icon"></i>
                    <span>تخفیف ها</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="{{ route('admin.market.discount.copan') }}">کوپن تخفیف</a>
                    <a href="{{ route('admin.market.discount.commonDiscount') }}">تخفیف عمومی</a>
                    <a href="{{ route('admin.market.discount.amazingSale') }}">فروش شگفت انگیز</a>
                </section>
            </section>


            <a href="{{ route('admin.market.delivery.index') }}" class="sidebar-link">
                <i class="fas fa-bars"></i>
                <span>روش های ارسال</span>
            </a>


            <section class="sidebar-part-title">بخش کاربران</section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-users icon"></i>
                    <span>کاربران</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="#">ادمین</a>
                    <a href="#">مدرس ها</a>
                    <a href="#">دانشجو </a>
                </section>
            </section>

            <section class="sidebar-part-title">بخش کاربران</section>

            <section class="sidebar-group-link">
                <section class="sidebar-dropdown-toggle">
                    <i class="fas fa-cogs icon"></i>
                    <span>تنظیمات منو</span>
                    <i class="fas fa-angle-left angle"></i>
                </section>
                <section class="sidebar-dropdown">
                    <a href="#">منوی هدر</a>
                    <a href="#">منوی فوتر</a>
                </section>
            </section>


        </section>
    </section>
</aside>
