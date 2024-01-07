@extends('layouts.template')

@section('content')
<h2>Tambah Data Keterlambatan</h2>
<p><a href="/">Home</a> / <a href="{{ route('late.index') }}">Data Keterlambatan</a> / Tambah Data Keterlambatan</p>

    <form action="{{ route('late.store')}}" method="POST" class="card  p-5">
        @csrf
        @csrf
        @if(Session::get('success'))
            <div class="alert alert-success"> {{ Session::get('success') }}</div>
        @endif
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            
        <div class="mb-3 row">
            <label for="student_id" class="col-sm-2 col-form-laber">Nama</label>
            <div class="col-sm-10">
                <select name="student_id" id="student_id" class="form-select">
                @foreach ($student as $std)
                <option  value="{{$std->id}}">{{$std->name}}</option>
                @endforeach
            </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="date_time_late" class="col-sm-2 col-form-laber">Waktu Terlambat</label>
            <div class="col-sm-10">
                <input type="datetime-local" class="form-control" id="date_time_late" name="date_time_late">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="information" class="col-sm-2 col-form-laber">Information</label>
            <div class="col-sm-10">
                <textarea name="information" id="information" cols="50" rows="6"></textarea>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="information" class="col-sm-2 col-form-laber">Bukti</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="bukti" name="bukti">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
    </form>
@endsection


