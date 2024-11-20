<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('judul')</title>
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


<table>
    <tr>
        <td>@include('layout.header')</td>
        <td style="padding:10px;">@yield('isi')</td>
    </tr>
</table>
</body>
</html>