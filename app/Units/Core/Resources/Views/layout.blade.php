<!DOCTYPE html>
<html lang="{{ app()->getLocale() or 'en' }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="CODECASTS">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <!-- Token for JS -->
    <script>
        window.Laravel = {!!   json_encode([
                'csrfToken' => csrf_token(),
            ])
        !!}
    </script>

    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
</head>
<body>
@include('core::_partials.header')


<script src="{{ elixir('js/vendor.js') }}"></script>
<script src="{{ elixir('js/app.js') }}"></script>
</body>
</html>