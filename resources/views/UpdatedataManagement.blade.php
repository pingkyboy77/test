{{-- @dd($warehouse) --}}
@extends('layouts.app')
@section('content')

    <form action="{{ url('update-Data/' . $data->id) . '/edit' }}" method="POST">
        @csrf
        <div class="row card m-0 py-3">
            <div class="card-header">
                <h5>Update Project Management</h5>
            </div>

            <div class="row card-body">

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="CreateTask-Task-Name">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" placeholder="Enter Task Name"
                            value="{{ isset($data) ? $data->lokasi : old('lokasi') }}" id="CreateTask-Task-Name">
                            @if ($errors->has('lokasi'))
                            <div class="text-danger">{{ $errors->first('lokasi') }}</div>
                        @endif
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="CreateTask-Task-Name">Volume</label>
                        <input type="text" name="volume" class="form-control"
                            value="{{ isset($data) ? $data->volume : old('volume') }}" placeholder="Masukan Nama volume"
                            id="CreateTask-Task-Name">
                            @if ($errors->has('volume'))
                            <div class="text-danger">{{ $errors->first('volume') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="asal_warehouse">Asal Stock</label>
                        <input type="hidden" name="asal_warehouse" value="{{ $data->asal_warehouse }}">
                        <select class="form-select" name="asal_warehouse" id="asal_warehouse" disabled>
                            <option selected disabled>Select Warehouse</option>
                            @foreach ($warehouse as $item)
                            <option value="{{ $item->nama }}" data-stock="{{ $item->stock }}"  @if ($item->nama == $data->asal_warehouse)
                                selected
                            @endif>
                                {{ $item->nama }}</option>
                            @endforeach
                        </select>
                        <label id="selected_stock" class="mt-2 ml-2"></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="CreateTask-Team-Member">Stock</label>
                        <input type="number" name="stock" class="form-control" placeholder="Enter stock"
                            id="CreateTask-Team-Member" value="{{ isset($data) ? $data->stock : old('stock') }}">
                        @if ($errors->has('stock'))
                            <div class="text-danger">{{ $errors->first('stock') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="CreateTask-Team-Member">Waktu Mulai</label>
                        <input type="date" name="waktu_mulai" class="form-control" placeholder="Enter waktu_mulai"
                            id="CreateTask-Team-Member" value="{{ isset($data) ? $data->waktu_mulai : old('waktu_mulai') }}">
                        @if ($errors->has('waktu_mulai'))
                            <div class="text-danger">{{ $errors->first('waktu_mulai') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="CreateTask-Team-Member">Waktu Selesai</label>
                        <input type="date" name="waktu_selesai" class="form-control" placeholder="Enter waktu_selesai"
                            id="CreateTask-Team-Member" value="{{ isset($data) ? $data->waktu_selesai : old('waktu_selesai') }}">
                        @if ($errors->has('waktu_selesai'))
                            <div class="text-danger">{{ $errors->first('waktu_selesai') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="CreateTask-Category">Kepala</label>
                        <select class="form-select" name="kepala" id="kepala">
                            @foreach ($kepala as $option)
                                <option value="{{ $option->nama }}" {{ isset($data) && $data->nama == $option->nama ? 'selected' : '' }}>{{ $option->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="CreateTask-Category">Status</label>
                        <select class="form-select" name="status" id="kepala">
                                <option value="Belum selesai" @if ($data->status == 'Belum selesai')
                                selected
                                @endif>Belum Selesai</option>
                                <option value="selesai" @if ($data->status == 'selesai')
                                    selected
                                    @endif>Selesai</option>
                        </select>
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

    <script>
        document.getElementById('asal_warehouse').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        var stock = selectedOption.getAttribute('data-stock');
        document.getElementById('selected_stock').textContent = "Stock: " + stock;
    });
    </script>



@endsection
