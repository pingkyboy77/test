@extends('layouts.app')
@section('content')

    <form action="{{ url('update-User/' . $user_id->id) . '/edit' }}" method="POST">
        @csrf
        <div class="row card m-0 py-3">
            <div class="card-header">
                <h5>Update User</h5>
            </div>

            <div class="row card-body">

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="CreateTask-Task-Name">Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Enter Task Name"
                            value="{{ isset($user_id) ? $user_id->nama : old('nama') }}" id="CreateTask-Task-Name">
                            @if ($errors->has('nama'))
                            <div class="text-danger">{{ $errors->first('nama') }}</div>
                        @endif
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="CreateTask-Task-Name">Username</label>
                        <input type="text" name="username" class="form-control"
                            value="{{ isset($user_id) ? $user_id->username : old('username') }}" placeholder="Enter Task Name"
                            id="CreateTask-Task-Name">
                            @if ($errors->has('username'))
                            <div class="text-danger">{{ $errors->first('username') }}</div>
                        @endif
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label" for="CreateTask-Team-Member">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter Password"
                            id="CreateTask-Team-Member" value="{{ isset($user_id) ? '' : old('password') }}">
                        @if ($errors->has('password'))
                            <div class="text-danger">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="CreateTask-Category">Role</label>
                    <select class="form-select" name="role" id="role_update">
                        {{-- <option selected disabled>Role Sebelumnya - {{ isset($user_id) ? $user_id->role : old('role') }}
                    </option> --}}
                        <option value="admin" @if (isset($user_id) && $user_id->role == 'admin') selected @endif>Admin</option>
                        <option value="kepala_warehouse" @if (isset($user_id) && $user_id->role == 'kepala_warehouse') selected @endif>Kepala Warehouse</option>
                        <option value="kepala_project" @if (isset($user_id) && $user_id->role == 'kepala_project') selected @endif>Kepala Project</option>
                        <option value="direktur" @if (isset($user_id) && $user_id->role == 'direktur') selected @endif>Direktur</option>
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
