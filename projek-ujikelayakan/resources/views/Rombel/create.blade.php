@extends('layouts.template')

@section('content')
<h2>Tambah Data Rombel</h2>
<p><a href="/">Home</a> / <a href="{{ route('rombel.index') }}">Data Rombel</a> / Tambah Data Rombel</p>
    <form action="{{ route('rombel.store') }}" method="POST" class="card  p-5">
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

        @csrf
        <div class="mb-3 row">
            <label for="rombel" class="col-sm-2 col-form-laber">Rombel</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rombel" name="rombel">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
    </form>
@endsection
