<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Posyandu | @yield('title')</title>
    
    @include('template.partials._style')
</head>

<body>
    @include('template.partials._navbar')

    <div class="hero d-flex justify-content-center align-items-center text-white">
        <h2 class="font-weight-bold">@yield('title')</h2>
    </div>

    <div class="bg-light">
        <div class="container">
            <nav class="py-2" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    @yield('breadcrumb')
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-5">
        @yield('content')
    </div>

    @include('template.partials._footer')
</body>

</html>
