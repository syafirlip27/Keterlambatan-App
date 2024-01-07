@extends('layouts.template')
@section('content')
<h2>Update Data Siswa</h2>
<p><a href="/">Home</a> / <a href="{{ route('student.index') }}">Data Student</a> / Update Data Siswa</p>
    <form action="{{ route('student.update', $student['id']) }}" method="POST" class="card p-5">
        @csrf
        @method('PATCH')

        @if ($errors->any())
            <ul class="alert alert-danger p-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
            <div class="mb-3 row">
                <label for="nis" class="col-sm-2 col-form-laber">NIS</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nis" name="nis">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-laber">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="rombel_id" class="col-sm-2 col-form-laber">Rombel</label>
                <div class="col-sm-10">
                    <select name="rombel_id" id="rombel_id">
                        @foreach ($rombel as $data)
                        <option value="{{ $data->id }}">{{ $data->rombel }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="rayon_id" class="col-sm-2 col-form-laber">Rayon</label>
                <div class="col-sm-10">
                    <select name="rayon_id" id="rayon_id" class="form-select">
                        @foreach ($rayon as $item)
                        <option value="{{ $item->id }}">{{ $item->rayon }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
        </form>
@endsection
