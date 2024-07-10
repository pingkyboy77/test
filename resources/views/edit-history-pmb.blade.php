@extends('layouts.app')
@section('content')
    <form action="{{ route('history-edit-store.admin', ['id' => $data->id]) }}" method="POST">
        @csrf
        <div class="row card m-0 py-3">
            <div class="card-header">
                <h5>Update User</h5>
            </div>

            <div class="row card-body">

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="CreateTask-Task-Name">Nama Warehouse</label>
                        <input type="hidden" value="{{ $data->warehouse_name }}" name="warehouse_name">
                        <select class="form-select" name="warehouse_name" id="warehouse_name" disabled>
                            <option selected disabled>Select Warehouse</option >
                            @foreach ($warehouse as $item)
                            <option value="{{ $item->nama }}" data-stock="{{ $item->stock }}"  @if ($item->nama == $data->warehouse_name)
                                selected
                            @endif>
                                {{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="CreateTask-Task-Name">Banyak Stock</label>
                        <input type="number" name="stock" class="form-control"
                            value="{{ isset($data) ? $data->stock : old('stock') }}" placeholder="Enter Task Name"
                            id="CreateTask-Task-Name">
                        @if ($errors->has('stock'))
                            <div class="text-danger">{{ $errors->first('stock') }}</div>
                        @endif
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="CreateTask-Category">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" class="form-control"
                            value="{{ isset($data) ? $data->tanggal_masuk : old('tanggal_masuk') }}" placeholder="Enter Task Name"
                            id="CreateTask-Task-Name">
                        @if ($errors->has('tanggal_masuk'))
                            <div class="text-danger">{{ $errors->first('tanggal_masuk') }}</div>
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



    <script>
        var user = @JSON($user);
        document.getElementById('role_update').addEventListener('change', function() {
            var role = this.value;
            var userDropdown = document.getElementById('user_update');
            userDropdown.innerHTML = '';

            if (role === 'admin') {
                var option = document.createElement('option');
                option.text = 'admin';
                kategoriDropdown.add(option);
            } else if (role === 'kepala_warehouse') {
                var option_dosen = @JSON($user);
                var options = option_dosen;
                kategoriDropdown.add(option);
            };
        } else if (role === 'admin') {
            var options = ['Super Admin'];
            options.forEach(function(optionValue) {
                var option = document.createElement('option');
                option.text = optionValue;
                kategoriDropdown.add(option);
            });
        }
        });
    </script>
@endsection
