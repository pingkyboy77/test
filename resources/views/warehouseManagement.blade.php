@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header bg-light border-bottom">
                <h5 class="card-title mb-0 fw-bold">Warehouse Management</h5>
            </div>
            <div class="card-body">

                <div class="">
                    <div class="row mb-2">
                        {{-- <div class="col-xl-3 col-md-12">
                            <div class="pb-3 pb-xl-0">
                                <form class="email-search">
                                    <div class="position-relative">
                                        <input type="text" class="form-control bg-light" placeholder="Search...">
                                        <span class="bx bx-search font-size-18"></span>
                                    </div>
                                </form>
                            </div>
                        </div> --}}
                        <!-- Button untuk membuka modal -->
                        @if(auth()->user()->role=='admin')
                        <div class="text-sm-end">
                            <button type="button" class="btn btn-success btn-rounded waves-effect waves-light"
                                onclick="openModal()"><i class="mdi mdi-plus me-1"></i> Create Warehouse</button>
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
                                            class="text-dark">Nama Warehouse</a></h5>
                                </td>
                                <td>
                                    <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                            class="text-dark">Nama Kepala</a></h5>
                                </td>
                                <td>
                                    <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                            class="text-dark">Lokasi</a></h5>
                                </td>
                                <td>
                                    <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                            class="text-dark">Stock ( Membran Bakar )</a></h5>
                                </td>
                                <td>
                                    <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                            class="text-dark">Edited By</a></h5>
                                </td>
                                <td>
                                    Action
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($warehouse as $item)
                            <tr>
                                <td class=" d-flex justify-content-start">
                                    <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                            class="text-dark">{{ $loop->iteration }}</a></h5>
                                </td>
                                <td>
                                    <p class="mb-0">{{ $item->nama }}</p>
                                </td>
                                <td>
                                    <p class="mb-0">{{ $item->kepala }}</p>
                                </td>
                                <td>
                                    <p class="mb-0">{{ $item->lokasi}}</p>
                                </td>
                                <td>
                                    <p class="mb-0">{{ $item->stock}}</p>
                                </td>
                                <td>
                                    <p class="mb-0">{{ $item->edited_by}}</p>
                                </td>
                                @if(auth()->user()->role=='admin')
                                <td class="d-flex gap-2">
                                    {{-- <a class="btn btn-warning me-2"
                                        href="{{ url('update-Warehouse/' . $item->id) . '/edit' }}"><i
                                            class="bx bx-pencil"></i>Edit</a> --}}
                                    <form action="{{ url('update-Warehouse/' . $item->id) . '/edit' }}"
                                        method="POST">
                                        
                                        <button type="submit" class="btn btn-warning btn-edit"><i
                                                class="bx bx-pencil"></i> Edit</button>
                                    </form>

                                    <form action="{{ url('warehouse-Management/' . $item->id) }}"
                                        method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-delete"><i
                                                class="bx bx-trash-alt"></i> Delete</button>
                                    </form>
                                </td>
                                @endif
                                @if(auth()->user()->role=='kepala_warehouse')
                                <td class="d-flex">
                                    <form action="{{ url('update-Warehouse/' . $item->id) . '/edit' }}"
                                        method="POST">
                                        
                                        <button type="submit" class="btn btn-warning btn-edit"><i
                                                class="bx bx-pencil"></i> Edit</button>
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
<form action="{{ route('warehouse-Management.store') }}" method="POST">
    @csrf
    <div class="modal fade create-warehouse" tabindex="-1" role="dialog" aria-labelledby="modal_warehouse"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_warehouse">Create Warehouse</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Isi formulir modal -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="nama">Nama Warehouse</label>
                                <input type="text" name="nama" class="form-control" placeholder="Enter Name"
                                    id="nama">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="kepala">Kepala Warehouse</label>
                                <select name="kepala" id="kepala" class="form-control">
                                    <option value="" selected disabled>Pilih Kepala Warehouse</option>
                                    @foreach ($kepala_warehouse as $item)
                                        <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="lokasi">Lokasi Warehouse</label>
                                <input type="text" name="lokasi" class="form-control" placeholder="lokasi"
                                    id="lokasi">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="stock">Stock</label>
                                <input type="number" name="stock" class="form-control" placeholder="stock"
                                    id="stock">
                            </div>
                        </div>

                        </div>
                        <!-- Tambahkan input lainnya di sini -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i
                                    class="bx bx-x me-1 align-middle"></i> Cancel</button>
                            <button type="submit" class="btn btn-success"><i class="bx bx-check me-1 align-middle"></i>
                                Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
</form>
@endsection
<script>
    function openModal() {
        var modal = document.querySelector('.create-warehouse');
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
                    "columnDefs": [{
                            "orderable": false,
                            "targets": [6]
                        } // Disable sorting for the third column (index 2)
                        // Add more entries as needed for other columns
                    ]
                });
            }, 100);
        });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
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
    document.addEventListener('DOMContentLoaded', function () {
        var editButtons = document.querySelectorAll('.btn-edit');

        editButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
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

