@extends('layouts.template')

@section('content')
<h2> Data User</h2>
<p><a href="/">Home</a> / Data User</p>
@if(Session::get('success'))
    <div class="alert alert-success">{{ Session::get('success')}}</div>
@endif
@if(Session::get('deleted'))
    <div class="alert alert-warning">{{ Session::get('deleted')}}</div>
@endif

<a href="{{ route('user.create') }}"><button class="btn btn-primary mt-3">Tambah Data</button></a>
    <br>
    <br>
    <table class="table table-striped table-bordered table-hover" style="text-align: center">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Rayon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($user as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['email'] }}</td>
                    <td>{{ $item['role'] }}</td>
                    <td>
                        @foreach ($item['rayon'] as $item2)
                            {{$item2['rayon']}}
                        @endforeach
                    </td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('user.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a> 
                        <span>&nbsp;</span> <!-- Space menggunakan &nbsp; -->
                        <form action="{{ route('user.delete', $item->id) }}" method="POST">
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
