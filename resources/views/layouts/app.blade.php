<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireAssets
</head>
<body>
    <div class="flex px-12 py-6 border-b border-gray-300 items-center">
        <div class="flex-none">
            @include("components.logo")
        </div>
        <div class="flex-1">
            <div class="float-right">
                <a target="_blank" href="https://github.com/gissilali/livewire-playground">
                    @include("components.github-logo")
                </a>
            </div>
        </div>
    </div>
    <div class="bg-gray-100 h-screen clearfix">
        <div class="px-10 py-4">
            @yield("content")
        </div>
    </div>
</body>
</html>
