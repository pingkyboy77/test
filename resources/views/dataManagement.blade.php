@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-light border-bottom">
                    <h5 class="card-title mb-0 fw-bold">Pendaftaran Management</h5>
                </div>
                <div class="card-body">

                    <div class="">
                        <div class="row mb-2 d-flex">
                            <div class="d-flex justify-content-between gap-2 align-items-center">
                                @if (auth()->user()->role == 'admin')

                                    <div class="text-sm-end">
                                        <button type="button" class="btn btn-success btn-rounded waves-effect waves-light"
                                            onclick="openModal()"><i class="mdi mdi-plus me-1"></i> Create Pendaftaran</button>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-nowrap align-middle mb-0 table-borderless" id="myTable">
                                <thead>
                                    <tr>
                                        <td class=" d-flex justify-content-start">
                                            <h5 class="text-truncate font-size-14 m-0">No</h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-dark">Wilayah Klinik</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-dark">Nama Pasien</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-dark">Nama Dokter</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-dark">Keluhan</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-dark">Tinggi berat badan</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-dark">Gula Darah</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-dark">Tensi</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-dark">Alegi Obat</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-dark">Di edit Oleh</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-dark">Action</a></h5>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td class=" d-flex justify-content-start">
                                                <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                        class="text-dark">{{ $loop->iteration }}</a></h5>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->wilayah }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->nama_pasien }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->dokter }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-center">{{ $item->keluhan }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->tbbb }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->guldar }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->tensi }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->alergi }}</p>
                                            </td>

                                            <td>
                                                <p class="mb-0">{{ $item->edited_by }}</p>
                                            </td>
                                            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'direktur')
                                                <td class="d-flex gap-2">

                                                    <form action="{{ url('update-Data/' . $item->id) . '/edit' }}"
                                                        method="POST">
                                                        <button type="submit" class="btn btn-warning btn-edit"><i
                                                                class="bx bx-pencil"></i> Edit</button>
                                                    </form>

                                                    <form action="{{ url('Project-Management/' . $item->id) }}"
                                                        method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-delete"><i
                                                                class="bx bx-trash-alt"></i> Delete</button>
                                                    </form>
                                                </td>
                                            @endif
                                            @if (auth()->user()->role == 'kepala_project')
                                                <td class="d-flex gap-2">

                                                    <form action="{{ url('update-Data/' . $item->id) . '/edit' }}"
                                                        method="POST">
                                                        <button type="submit" class="btn btn-success btn-edit"><i
                                                                class="bx bx-check"></i> Selesaikan Project</button>
                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!-- Modal -->
        <form action="{{ route('data-Management.store') }}" method="POST">
            @csrf
            <input type="hidden" name="edited_by" value="{{ $nama }}">
            <div class="modal fade create-project" tabindex="-1" role="dialog" aria-labelledby="modal_project"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal_project">Create Pendaftaran Pasien</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Isi formulir modal -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="wilayah">Wilayah Klinik</label>
                                        <input type="text" name="wilayah" class="form-control"
                                            placeholder="Enter Wilayah Klinik" id="wilayah">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="nama_pasien">Nama Pasien</label>
                                        <input type="text" name="nama_pasien" class="form-control"
                                            placeholder="Enter Nama Pasiena" id="nama_pasien">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="dokter">Dokter</label>
                                        <select class="form-select" name="dokter" id="dokter">
                                            <option selected disabled>Select Dokter</option>
                                            @foreach ($Dokter as $item)
                                                <option value="{{ $item->nama }}">
                                                    {{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="keluhan">Keluhan</label>
                                        <textarea type="text" name="keluhan" class="form-control" placeholder="Masukan Keluhan Pasien"
                                            id="keluhan"></textarea>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="tbbb">Tinggi Badan / Berat Badan</label>
                                        <input type="text" name="tbbb" class="form-control"
                                            placeholder="Enter Nama Pasiena" id="tbbb">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="guldar">Gula Darah</label>
                                        <input type="text" name="guldar" class="form-control"
                                            placeholder="Enter Nama Pasiena" id="guldar">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="tensi">Tensi Darah</label>
                                        <input type="text" name="tensi" class="form-control"
                                            placeholder="Enter Nama Pasiena" id="tensi">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="alergi">Alergi Obat</label>
                                        <textarea type="text" name="alergi" class="form-control"
                                            placeholder="Enter Nama Pasiena" id="alergi"></textarea>
                                    </div>
                                </div>



                                <!-- Tambahkan input lainnya di sini -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i
                                            class="bx bx-x me-1 align-middle"></i> Cancel</button>
                                    <button type="submit" class="btn btn-success"><i
                                            class="bx bx-check me-1 align-middle"></i>
                                        Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div>
        </form>
@endsection
        <script>
            document.getElementById('asal_warehouse').addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex];
                var stock = selectedOption.getAttribute('data-stock');
                document.getElementById('selected_stock').textContent = "Stock: " + stock;
            });

            function openModal() {
                var modal = document.querySelector('.create-project');
                var modalBootstrap = new bootstrap.Modal(modal);
                modalBootstrap.show();
            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                var dataTableExists = $.fn.DataTable.isDataTable('#myTable');
                if (dataTableExists) {
                    $('#myTable').DataTable().destroy();
                }

                setTimeout(() => {

                    $('#myTable').DataTable({
                        scrollCollapse: true,
                        responsive: true,
                    });
                }, 100);
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var deleteButtons = document.querySelectorAll('.btn-delete');

                deleteButtons.forEach(function(button) {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();

                        var form = this.parentElement;
                        var url = form.getAttribute('action');

                        Swal.fire({
                            title: 'Apakah anda yakin menghapus data?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var editButtons = document.querySelectorAll('.btn-edit');

                editButtons.forEach(function(button) {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();

                        var form = this.parentElement;
                        var url = form.getAttribute('action');

                        Swal.fire({
                            title: 'Apakah anda ingin mengedit data?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = url;
                            }
                        });
                    });
                });
            });
        </script>
