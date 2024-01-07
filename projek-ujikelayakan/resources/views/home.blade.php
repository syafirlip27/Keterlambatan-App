@extends('layouts.template')

@section('content')

<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
<div class="jumbotron py-4 px-5">
<h1 class="display-4">
    Selamat Datang <b>{{ Auth::user()->name }}!</b>
</h1>
<hr class="my-4">
    <div class="container-fluid">
        <div class="container mt-4">
            {{-- <main>
            <div class="row mb-4">
                <div class="col">
                    <h2 class="mb-0">Dashboard</h2>
                    <ul class="breadcrumbs">
                        <li><a href="#">Home</a></li>
                        <li class="divider">/</li>
                        <li><a href="#" class="active">Dashboard</a></li>
                    </ul>
                </div>
            </div>
            </main> --}}
            <div class="row">
                @if (Auth::check())
                @if(Auth::user()->role == 'admin')
                <div class="col-lg-6 mb-4">
                    <div class="card h-200 text-dark shadow" style="">
                        <div class="card-body">
                            <h5 class="card-title">Peserta Didik</h5>
                            <div class="row align-items-center mt-2">
                                <div class="col-md-1">
                                    <i class='bx bxs-user icon' style="color: blue "></i>
                                </div>
                                <div class="col-md-10">
                                    <p class="card-text"><b>{{App\Models\students::count()}}</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <div class="card h-200 text-dark shadow" style="backgorund-color:blue">
                        <div class="card-body">
                            <h5 class="card-title">Administrator</h5>
                            <div class="row align-items-center mt-2">
                                <div class="col-md-2">
                                    <i class='bx bxs-user icon' style="color: blue"></i>
                                </div>
                                <div class="col-md-10">
                                    <p class="card-text"><b>{{App\Models\User::where('role', '=', 'admin')->count()}}</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <div class="card h-200 text-dark shadow" >
                        <div class="card-body">
                            <h5 class="card-title">Pembimbing Siswa</h5>
                            <div class="row align-items-center mt-2">
                                <div class="col-md-2">
                                    <i class='bx bxs-user icon' style="color: blue"></i>
                                </div>
                                <div class="col-md-10">
                                    <p class="card-text"><b>{{App\Models\User::where('role', '=', 'ps')->count()}}</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card h-200 text-dark shadow" style="">
                        <div class="card-body">
                            <h5 class="card-title">Rombel</h5>
                            <div class="row align-items-center mt-2">
                                <div class="col-md-1">
                                    <i class='bx bx-folder-open icon' style="color: blue"></i>
                                </div>
                                <div class="col-md-10">
                                    <p class="card-text"><b>{{App\Models\rombels::count()}}</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card h-200 text-dark shadow" style="">
                        <div class="card-body">
                            <h5 class="card-title">Rayon</h5>
                            <div class="row align-items-center mt-2">
                                <div class="col-md-1">
                                    <i class='bx bx-folder-open icon' style="color: blue;"></i>
                                </div>
                                <div class="col-md-5">
                                    <p  class="card-text"><b>{{App\Models\rayons::count()}}</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else 
<div class="col-lg-6 mb-4">
    <div class="card h-200 text-dark shadow" style="">
        <div class="card-body">
            <h5 class="card-title">Peserta Didik</h5>
            <div class="row align-items-center mt-2">
                <div class="col-md-1">
                    <i class='bx bxs-user icon' style="color: blue "></i>
                </div>
                <div class="col-md-10">
                    <p class="card-text"><b>{{count($students)}}</b></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6 mb-4">
    <div class="card h-200 text-dark shadow" style="">
        <div class="card-body">
            <h5 class="card-title">Keterlambatan Hari ini</h5>
            <p class="card-text">{{ date("j F Y", time()) }}</p>
            <div class="row align-items-center mt-2">
                <div class="col-md-1">
                    <i class='bx bxs-user icon' style="color: blue "></i>
                </div>
                <div class="col-md-10">
                    <p class="card-text"></p>
                </div>
            </div>
        </div>
    </div>
</div>

@endif
@endif
@endsection

