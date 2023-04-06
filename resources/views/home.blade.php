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
        @if (session('success'))
            <div class="alert alert-success pb">
                {{ session('success') }}
            </div>
        @endif
        @if (session('failed'))
            <div class="alert alert-danger pb">
                {{ session('failed') }}
            </div>
        @endif

        <a href="{{ route('change.email') }}"><input type="button" value="Change Email" class="btn"></a>
        <a href="{{ route('renew.licens') }}"><input type="button" value="Renew Licens" class="btn"></a>
        <a href="{{ route('remove.user') }}"><input type="button" value="Remove User" class="btn"
                onclick="return confirm('Are you sure you want to remove yourself from database?')"></a>
    </div>
</body>
<script src="{{ asset('assets/script.js') }}"></script>

</html>
