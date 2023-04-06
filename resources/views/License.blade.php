<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>

<body>
    <div class="form">
        <h5>{{ $license }}</h5>
        <a href="{{ url('/home') }}"><input type="button" value="back" class="btn"></a>
    </div>
</body>
<script src="{{ asset('assets/script.js') }}"></script>

</html>
