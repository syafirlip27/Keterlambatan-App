@extends('layouts.template')

@section('content')
<h2> Data Rayon</h2>
<p><a href="/">Home</a> / Data Rayon</p>
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif
    <a href="{{ route('rayon.create') }}"><button class="btn btn-primary mt-3">Tambah Data</button></a>
    <br>
    <br>
    <table class="table table-striped table-bordered table-hover" style="text-align: center">
        <thead>
            <tr>
                <th>No</th>
                <th>Rayon</th>
                <th>Pembimbing Siswa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($rayon as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['rayon'] }}</td>
                    {{-- <td>{{ $item->user['name'] }}</td> --}}
                    <td>
                        @if ($item->user)
                            {{ $item->user->name }}
                        @else
                       
                        @endif
                    </td>
                    <td class="d-flex justify-content-center"></td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('rayon.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a>
                        <span>&nbsp;</span> <!-- Space menggunakan &nbsp; -->
                        <form action="{{ route('rayon.delete', $item['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

{{-- {{ route('rombel.create') }} --}}
{{-- {{ route('rombel.edit', $item['id']) }} --}}
{{-- {{ route('rombel.delete', $item['id']) }} --}}
