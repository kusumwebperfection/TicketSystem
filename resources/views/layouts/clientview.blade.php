<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts/header')
</head>
<body>
    <header>
        <div class="container">
            <nav class="navbar navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                         <img src="{{ asset('assets/img/logo.png')}}" alt="" width="200px" height="auto" class="d-inline-block align-text-top">
                    </a>
                    <div class="d-flex">
                        <img src="{{ asset('assets/img/logo.png')}}" alt="" width="200px" height="auto" class="d-inline-block align-text-top">
                    </div>
                </div>
            </nav>
        </div>
    </header>
    @yield('content')
</body>
</html>