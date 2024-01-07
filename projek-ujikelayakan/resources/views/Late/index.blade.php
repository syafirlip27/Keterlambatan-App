@extends('layouts.template')
@section('content')
    @if (Auth::check())
        @if (Auth::user()->role == 'admin')
            @if (Session::get('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if (Session::get('deleted'))
                <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
            @endif

            <a href="{{ route('late.create') }}"><button class="btn btn-primary mt-3">Tambah Data</button></a>
            <a href="{{ route('late.export-excel') }}"><button class="btn btn-info mt-3">Export Data
                    Keterlambatan</button></a>
            <br>
            <br>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('late.index') }}">Keseluruhan Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('late.rekap') }}">Rekapitulasi Data</a>
                </li>
            </ul>
            <br>
            <table class="table table-hover" style="text-align: center">
                <thead class="">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Information</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($lates as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>

                                {{ $item->students->nis }}
                                {{ $item->students->name }}
                            </td>
                            <td>{{ $item['date_time_late'] }}</td>
                            <td>{{ $item['information'] }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('late.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a>
                                <span>&nbsp;</span> <!-- Space menggunakan &nbsp; -->
                                <form action="{{ route('late.delete', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @elseif  (Auth::user()->role == 'ps')
            <a href="{{ route('late.export-excel') }}"><button class="btn btn-info mt-3">Export Data
                Keterlambatan</button></a>
        <br>
        <br>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('late.index') }}">Keseluruhan Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('late.rekap') }}">Rekapitulasi Data</a>
            </li>
        </ul>
        <br>
        <table class="table table-hover" style="text-align: center">
            <thead class="">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Information</th>
                    
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($lates as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>

                            {{ $item->students->nis }} 
                            {{ $item->students->name }}
                        </td>
                        <td>{{ $item['date_time_late'] }}</td>
                        <td>{{ $item['information'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
            @endif
        @endsection
