<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ball News</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="{{asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i')}}"
        rel="stylesheet">
    <link href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="...">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">BaLl News</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            {{-- <li class="nav-item {{ Request::is('dashboard') ? 'active' : ''}}">
                <a class="nav-link" href="/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li> --}}
            
            <li class="nav-item {{ Request::is('posts/*') || Request::is('posts') ? 'active' : ''}}">
                <a class="nav-link" href="/posts">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Posts</span></a>
            </li>

            <li class="nav-item {{ Request::is('dashboard/post') || Request::is('dashboard/post/*') ? 'active' : ''}}">
                <a class="nav-link" href="/dashboard/post">
                    <i class="fas fa-fw fa-table"></i>
                    <span>My Posts</span></a>
            </li>

            <li class="nav-item {{ Request::is('dashboard/my-users') || Request::is('dashboard/my-users/*') ? 'active' : ''}}">
                <a class="nav-link" href="/dashboard/my-users">
                    <i class="fas fa-fw fa-table"></i>
                    <span>My Users</span></a>
            </li>

        </ul>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <ul class="navbar-nav ml-auto">
                @auth  
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Welcome Back, {{ auth()->user()->name}}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/dashboard">My Dashboard</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                        <form action="{{route('logout')}}" action="GET">
                            @csrf
                            <button type="submit" class="dropdown-item">
                            <i class="bi bi-box-arrow-right"></i> Logout</a></li>
                        </form>
                        </li>
                    </ul>
                @else
                    
                        <li>
                            <a href="/login" class="nav-link">
                            <i class="bi bi-box-arrow-in-right"></i> Login</a>
                        </li>
                    
                @endauth
                </ul>
                </nav>
                <div class="container mt-4">
                    @yield('container')
                </div>
            </div>
        </div>
    
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>

</body>

</html>