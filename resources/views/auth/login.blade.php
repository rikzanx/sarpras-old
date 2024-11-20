<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@if (session()->has('error'))
<p>{{ session()->get("error") }}</p>
@endif

@if (session()->has('success'))
<p>
    {{ session()->get("success") }}
</p>
@endif
    <form action="{{ route('login.post') }}" method="post">
        @csrf
        <label for="nik">NIK</label>
        <input type="text" name="nik" id="nik" required>
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <br>
        <input type="submit" value="Login">
    </form>
</body>
</html>