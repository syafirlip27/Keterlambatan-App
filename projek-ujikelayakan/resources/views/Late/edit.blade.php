@extends('layouts.template')

@section('content')
    <h2>Update Data Keterlambatan</h2>
    <p><a href="/">Home</a> / <a href="{{ route('late.index') }}">Data Keterlambatan</a> / Update Data Keterlambatan</p>

    <form action="{{ route('late.update', $lates['id']) }}" method="POST" class="card  p-5" enctype="multipart/form-data">
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
            <label for="student_id" class="col-sm-2 col-form-laber">Name</label>
            <div class="col-sm-10">
                <select name="student_id" id="student_id" class="form-select">
                    @foreach ($student as $data)
                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="date_time_late" class="col-sm-2 col-form-laber">Waktu Terlambat</label>
            <div class="col-sm-10">
                <input type="datetime-local" class="form-control" id="date_time_late" name="date_time_late"
                    value="{{ $lates['date_time_late'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="information" class="col-sm-2 col-form-laber">Information</label>
            <div class="col-sm-10">
                <textarea name="information" id="information" cols="50" rows="6" value="{{ $lates['information'] }}"></textarea>

            </div>
        </div>
        <div class="mb-3 row">
            <label for="information" class="col-sm-2 col-form-label">Bukti</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="bukti" name="bukti">
                @if ($lates['bukti'])
                    <img style="width:200px;" src="{{ asset('image/' . $lates['bukti']) }}" alt="Bukti">
                @endif
            </div>
            
        </div>
        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
@endsection
