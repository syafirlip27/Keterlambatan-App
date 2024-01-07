@extends('layouts.template')

@section('content')
@if (Auth::check())
@if (Auth::user()->role == 'admin')
    <div class="container">
        <div class="jumbroton py-2 px-1">
            <h2>Detail Data Keterlambatan</h2>
            <p><a href="/">Home</a> / <a href="{{ route('late.index') }}">Data Keterlambatan</a> / Detail Data
                Keterlambatan</p>
            <hr>
            <h4 style="float:left; color:cornflowerblue;">{{ $student->name }} |
                {{ $student->nis }} | {{ $student->rombel->rombel }} | {{ $student->rayon->rayon }}</h4>
            <br>
            <hr>
        </div>
        <div class="row">
            @php $no = 1;
            @endphp
            @foreach ($lates as $item)
                <div class="card m-3 shadow p-1 mb-5 border-0 " style="width: 20rem; height:15rem;">
                    <div col-md-4>
                    <div class="card-body">
                        <h4 class="card-title">Keterlambatan ke-{{ $no++ }}</h4>
                        <div class="detail ">
                            <b>
                                <p class="card-subtitle text-body-secondary mt-3">{{ $item['date_time_late'] }}</p>
                            </b>
                            <p class="card-text" style="color:cornflowerblue;">{{ $item['information'] }}</p>
                            <img class="card-img-top my-1" src="{{ asset('/image/' . $item->bukti) }}" alt="Card image cap">
                        </div>
                    </div>
                </div>
        </div>
        @endforeach
    </div>
    @else<div class="container">
        <div class="jumbroton py-2 px-1">
            <h2>Detail Data Keterlambatan</h2>
            <p><a href="/">Home</a> / <a href="{{ route('late.index') }}">Data Keterlambatan</a> / Detail Data
                Keterlambatan</p>
            <hr>
            <h4 style="float:left; color:cornflowerblue;">{{ $student->name }} |
                {{ $student->nis }} | {{ $student->rombel->rombel }} | {{ $student->rayon->rayon }}</h4>
            <br>
            <hr>
        </div>
        <div class="row">
            @php $no = 1;
            @endphp
            @foreach ($lates as $item)
                <div class="card m-3 shadow p-1 mb-5 border-0 " style="width: 20rem; height:15rem;">
                    <div col-md-4>
                    <div class="card-body">
                        <h4 class="card-title">Keterlambatan ke-{{ $no++ }}</h4>
                        <div class="detail ">
                            <b>
                                <p class="card-subtitle text-body-secondary mt-3">{{ $item['date_time_late'] }}</p>
                            </b>
                            <p class="card-text" style="color:cornflowerblue;">{{ $item['information'] }}</p>
                            <img class="card-img-top my-1" src="{{ asset('/image/' . $item->bukti) }}" alt="Card image cap">
                        </div>
                    </div>
                </div>
        </div>
        @endforeach
    </div>
    @endif
    @endif    

@endsection

<style>
    .row img {
        width: 150px;
        height: 90px;
        display: flex;
        border-bottom-left-radius: var(--bs-card-inner-border-radius);
        border-bottom-right-radius: var(--bs-card-inner-border-radius);
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .jumbroton.py-2.px-1 p a {
        text-decoration: none;
    }
</style>
