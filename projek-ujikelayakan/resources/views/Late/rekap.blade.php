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
                    <a class="nav-link" href="{{ route('late.index') }}">Keseluruhan Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('late.rekap') }}">Rekapitulasi Data</a>
                </li>
            </ul>
            <br>
            <table class="table table-hover" style="text-align: center border">
                <thead class="">
                    <tr>
                        <th>No</th>
                        <th>Nis</th>
                        <th>Nama</th>
                        <th>Jumlah Keterlambatan</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($lates as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td> {{ $item->nis }}</td>
                            <td> {{ $item->name }}</td>
                            <td>{{ $item->lates_count }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('late.detail', ['student_id' => $item->id]) }}"
                                    class="btn btn-primary me-3">Detail</a>
                            </td>
                            @if ($item->lates_count >= 3)
                                <td>
                                    <a href="{{ route('late.download', $item['id']) }}" class="btn btn-primary me-3">Cetak
                                        Surat Pernyataan</a>
                                </td>
                                @else
                                <td></td>
                            @endif
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <a href="{{ route('late.export-excel') }}"><button class="btn btn-info mt-3">Export Data
                    Keterlambatan</button></a>
            <br>
            <br>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('late.index') }}">Keseluruhan Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('late.rekap') }}">Rekapitulasi Data</a>
                </li>
            </ul>
            <br>
            <table class="table table-hover" style="text-align: center border">
                <thead class="">
                    <tr>
                        <th>No</th>
                        <th>Nis</th>
                        <th>Nama</th>
                        <th>Jumlah Keterlambatan</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($studenRayon as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td> {{ $item->nis }}</td>
                            <td> {{ $item->name }}</td>
                            <td>{{ $lateCounts[$item->id] }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('late.detail', ['student_id' => $item->id]) }}"
                                    class="btn btn-primary me-3">Detail</a>
                            </td>
                            @if ($lateCounts[$item->id] >= 3)
                                <td>
                                    <a href="{{ route('late.download', $item->id) }}" class="btn btn-primary me-3">Cetak
                                        Surat Pernyataan</a>
                                </td>
                            @else
                                <td></td>
                                <!-- Atau isi dengan teks atau tag HTML yang sesuai untuk menunjukkan tidak ada aksi yang tersedia -->
                            @endif

                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endif
@endsection
