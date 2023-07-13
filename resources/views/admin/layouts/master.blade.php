<!DOCTYPE html>
<html lang="en">

<head>

    {{-- css and meta tags --}}
    @include('admin.layouts.head-tag')

    {{-- add custom css --}}
    @yield('style')
    @yield('page-title')

</head>


<body dir="rtl">

    {{-- page header --}}
    @include('admin.layouts.header')

    <section class="body-container">

        {{-- sidebar --}}
        @include('admin.layouts.sidebar')

        <section id="main-body" class="main-body">

            {{-- main content --}}
            @yield('content')

        </section>
    </section>


    {{-- js file --}}
    @include('admin.layouts.script')

    {{-- add custom js --}}
    @yield('script')

</body>


</html>
