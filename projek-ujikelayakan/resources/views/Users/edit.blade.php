@extends('layouts.template')
@section('content')
<h2>Update Data User</h2>
<p><a href="/">Home</a> / <a href="{{ route('user.index') }}">Data User</a> / Update Data User</p>
    <form action="{{ route('user.update', $user['id']) }}" method="POST" class="card p-5">
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
            <label for="name" class="col-sm-2 col-form-laber">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ $user['name'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-laber">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" name="email" value="{{ $user['email'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="role" class="col-sm-2 col-form-label">Role </label>
            <div class="col-sm-10">
                <select name="role" id="role" class="form-select">
                    <option value="{{ $user['role'] }}">Admin</option>
                    <option value="{{ $user['role'] }}">Pembimbing Siswa</option>

                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="role" class="col-sm-2 col-form-label">Rayon </label>
            <div class="col-sm-10">
                <select name="rayon" id="rayon_id" class="form-select">
                    <option selected disabled hidden>Pilih</option>
                    @foreach ($rayon as $item)
                    {{-- <option value="{{$item['id']}}">{{$item['rayon']}}</option> --}}
                    <option value="{{ $item['id'] }}" {{ $item['id'] === $user['rayon_id'] ? 'selected' : '' }}>{{ $item['rayon'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-laber">Password</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="password" name="password" value="{{ $user['password'] }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
@endsection

