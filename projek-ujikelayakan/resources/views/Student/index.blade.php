@extends('layouts.template')

@section('content')
    <h2> Data Siswa</h2>
    <p><a href="/">Home</a> / Data Siswa</p>
    @if (Auth::check())
    @if (Auth::user()->role == 'admin')

    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif

    <a href="{{ route('student.create') }}"><button class="btn btn-primary mt-3">Tambah Data</button></a>
    <br>
    <br>
    <table class="table table-striped table-bordered table-hover" style="text-align: center">
        <thead>
            <tr>
                <th>No</th>
                <th>Nis</th>
                <th>Nama</th>
                <th>Rombel</th>
                <th>Rayon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($student as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['nis'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item->rombel->rombel }}</td>
                    <td>{{$item->rayon['rayon']}}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('student.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a>
                        <span>&nbsp;</span> <!-- Space menggunakan &nbsp; -->
                        <form action="{{ route('student.delete', $item['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <table class="table table-striped table-bordered table-hover" style="text-align: center">
        <thead>
            <tr>
                <th>No</th>
                <th>Nis</th>
                <th>Nama</th>
                <th>Rombel</th>
                <th>Rayon</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($students as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['nis'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item->rombel->rombel }}</td>
                    <td>{{ $item->rayon->rayon }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        @endif
@endsection

{{-- {{ route('rombel.create') }} --}}
{{-- {{ route('rombel.edit', $item['id']) }} --}}
{{-- {{ route('rombel.delete', $item['id']) }} --}}
