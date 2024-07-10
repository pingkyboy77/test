@extends('layouts.app')
@section('content')

    <form action="{{ url('update-Warehouse/' . $warehouse->id) . '/edit' }}" method="POST">
        @csrf
        <div class="row card m-0 py-3">
            <div class="card-header">
                <h5>Update Warehouse</h5>
            </div>

            <div class="row card-body">

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="CreateTask-Task-Name">Nama Warehouse</label>
                        <input type="text" name="nama" class="form-control" placeholder="Enter Task Name"
                            value="{{ isset($warehouse) ? $warehouse->nama : old('nama') }}" id="CreateTask-Task-Name">
                            @if ($errors->has('nama'))
                            <div class="text-danger">{{ $errors->first('nama') }}</div>
                        @endif
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="CreateTask-Task-Name">Nama Kepala</label>
                        <select name="kepala" id="kepala" class="form-control">
                                    <option value="" selected disabled>Pilih Kepala Warehouse</option>
                                    @foreach ($kepala_warehouse as $item)
                                        <option value="{{ $item->nama }}" @if (isset($warehouse) && $warehouse->kepala == $item->nama)
                                            selected
                                        @endif>{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            @if ($errors->has('kepala'))
                            <div class="text-danger">{{ $errors->first('kepala') }}</div>
                        @endif
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="CreateTask-Team-Member">Lokasi Warehouse</label>
                        <input type="text" name="lokasi" class="form-control" placeholder="Enter lokasi"
                            id="CreateTask-Team-Member" value="{{ isset($warehouse) ? $warehouse->lokasi : old('lokasi') }}">
                        @if ($errors->has('lokasi'))
                            <div class="text-danger">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="CreateTask-Team-Member">Stock</label>
                        <input type="number" name="stock" class="form-control" placeholder="Enter stock"
                            id="CreateTask-Team-Member" value="{{ isset($warehouse) ? $warehouse->stock : old('stock') }}">
                        @if ($errors->has('stock'))
                            <div class="text-danger">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                </div>

            <div class="col-12 text-end mt-3">
                <a href="#" onclick="history.back();">
                    <button type="button" class="btn btn-danger me-1">
                        <i class="bx bx-x me-1 align-middle"></i> Cancel
                    </button>
                </a>
                <button type="submit" class="btn btn-success" data-bs-toggle="modal"><i
                        class="bx bx-check me-1 align-middle"></i> Confirm</button>
            </div>
        </div>

        </div>
    </form>



@endsection
