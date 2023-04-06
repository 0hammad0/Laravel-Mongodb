<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>verification</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>

<body>
    <form method="post" action="{{ route('confirmCode') }}" class="form">
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

        @csrf
        <input type="number" placeholder="enter code..." name="code" class="inputCode" required>
        <input type="submit" value="Submit">
    </form>
</body>
<script src="{{ asset('assets/script.js') }}"></script>

</html>
