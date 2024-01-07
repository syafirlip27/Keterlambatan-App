@extends('layouts.template')

@section('content')
    <h2>Tambah Data Rayon</h2>
    <p><a href="/">Home</a> / <a href="{{ route('rayon.index') }}">Data Rayon</a> / Tambah Data Rayon</p>
    <form action="{{ route('rayon.store') }}" method="POST" class="card  p-5">
        @csrf
        @if (Session::get('success'))
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
            <label for="rayon" class="col-sm-2 col-form-laber">Rayon</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rayon" name="rayon">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="user_id" class="col-sm-2 col-form-laber">Pembimbing siswa</label>
            <div class="col-sm-10">

                <select name="user_id" id="user_id" class="form-select">
                    @foreach ($user as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
    </form>
@endsection
