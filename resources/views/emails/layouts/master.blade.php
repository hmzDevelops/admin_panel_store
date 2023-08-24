<!DOCTYPE html>
<html lang="en">
<head>

    @include('emails.layouts.head-tag')
    @yield('head-tag')

</head>
<body>

    {{-- start header --}}
    @include('emails.layouts.header')
    {{-- end header --}}


    {{-- starts main one col --}}
    <main id="main-body-one-col" class="main-body">
        @yield('content')
    </main>
    {{-- en main one col --}}


    {{-- starts footer --}}
    @include('emails.layouts.footer')
    {{-- end footer --}}

    
</body>
</html>
