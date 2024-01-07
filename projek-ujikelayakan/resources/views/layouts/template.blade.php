<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Rekam Keterlambatan</title>
</head>

<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand"><i class='bx bx-book-open icon'></i>Rekap Keterlambatan</a>

        <ul class="side-menu">
            <li><a href="/" class="active"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
            @if (Auth::check())
                @if (Auth::user()->role == 'admin')
                    <li class="divider" data-text="main">Main</li>
                    <li>
                        <a href="#"><i class='bx bxs-inbox icon'></i>Data Master<i
                                class='bx bx-chevron-right icon-right'></i></a>
                        <ul class="side-dropdown">
                            <li><a aria-current="page" href="{{ route('rombel.index') }}">Data Rombel</a></li>
                            <li><a aria-current="page" href="{{ route('rayon.index') }}">Data Rayon</a></li>
                            <li><a aria-current="page" href="{{ route('student.index') }}">Data Siswa</a></li>
                            <li><a aria-current="page" href="{{ route('user.index') }}">Data User</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('late.index') }}"><i class='bx bxs-chart icon'></i>Data Keterlambatan</a>
                    </li>
                    @elseif (Auth::user()->role == 'ps')
                    <li>
                        <a href="#"><i class='bx bxs-inbox icon'></i>Data Master<i
                                class='bx bx-chevron-right icon-right'></i></a>
                        <ul class="side-dropdown">
                            <li><a aria-current="page" href="{{ route('student.index') }}">Data Siswa</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('late.index') }}"><i class='bx bxs-chart icon'></i>Data Keterlambatan</a>
                    </li>
                    @endif
                    @endif


                    <!-- <li>
    <a href="#"><i class='bx bxs-notepad icon' ></i> Forms <i class='bx bx-chevron-right icon-right' ></i></a>
    <ul class="side-dropdown">
     <li><a href="#">Basic</a></li>
     <li><a href="#">Select</a></li>
     <li><a href="#">Checkbox</a></li>
     <li><a href="#">Radio</a></li>
    </ul>
   </li> -->
        </ul>

    </section>
    <!-- SIDEBAR -->

    <!-- NAVBAR -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu toggle-sidebar'></i>
            <!-- <form action="#">
    <div class="form-group">
     <input type="text" placeholder="Search...">
     <i class='bx bx-search icon' ></i>
    </div>
   </form> -->

            <span class="divider"></span>
            <div class="profile">
                {{-- <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cGVvcGxlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt=""> --}}
                <i class='bx bxs-user-circle icon '></i>


                <ul class="profile-link">
                    {{-- <li><a href="#"><i class='bx bxs-user-circle icon'></i> Profile</a></li>
                    <li><a href="#"><i class='bx bxs-cog'></i> Settings</a></li> --}}
                    <p class="px-2">Hallo, <b style="color: blue">!</b></p>
                    @if (Auth::check())
                        <li><a href="{{ route('logout') }}"><i class='bx bxs-log-out-circle'></i> Logout</a></li>
                    @endif
                </ul>
            </div>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        {{-- <main>
			<h1 class="title">Dashboard</h1>
			<ul class="breadcrumbs">
				<li><a href="#">Home</a></li>
				<li class="divider">/</li>
				<li><a href="#" class="active">Dashboard</a></li>
			</ul>
			
		</main> --}}
        <!-- MAIN -->
        <div class="container mt-5 content-a">

            @yield('content')

        </div>
    </section>
    <!-- NAVBAR -->
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
