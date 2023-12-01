<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-POSYANDU | @yield('title')</title>

    @include('template.partials._style')
</head>

<body>
    <div class="herodashboard">
        @include('template.partials._navbar')

        <div class="kemala d-flex justify-content-center align-items-center">
        </div>
        {{-- <div class="container">
        <nav class="py-2" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                @yield('breadcrumb')
            </ol>
        </nav>
    </div> --}}

        <div class="container py-4">
            @yield('content')
        </div>

</body>
<div class="herodashboard">
    @include('template.partials._footer')

</html>
