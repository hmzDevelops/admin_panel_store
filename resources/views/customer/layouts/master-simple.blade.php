<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>


    @include('customer.layouts.head-tag')
    @yield('head-tag')


</head>

<body>

    <!-- start main one col -->
    <main id="main-body-one-col" class="main-body">

        @yield('content')

    </main>


    @include('customer.layouts.script')
    @yield('script')

</body>

</html>
