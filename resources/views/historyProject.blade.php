@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-light border-bottom">
                    <h5 class="card-title mb-0 fw-bold">Project Management</h5>
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
                            @if (auth()->user()->role == 'admin')
                                <div class="text-sm-end">
                                    <button type="button" class="btn btn-success btn-rounded waves-effect waves-light"
                                        onclick="openModal()"><i class="mdi mdi-plus me-1"></i> Create Project</button>
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
                                                class="text-dark">Lokasi Proyek</a></h5>
                                    </td>
                                    <td>
                                        <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                class="text-dark">Volume Pengerjaan Proyek</a></h5>
                                    </td>
                                    <td>
                                        <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                class="text-dark">Asal Warehouse</a></h5>
                                    </td>
                                    <td>
                                        <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                class="text-dark">Stok Material digunakan</a></h5>
                                    </td>
                                    <td>
                                        <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                class="text-dark">Tanggal Mulai</a></h5>
                                    </td>
                                    <td>
                                        <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                class="text-dark">Tanggal Selesai</a></h5>
                                    </td>
                                    <td>
                                        <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                class="text-dark">Kepala</a></h5>
                                    </td>
                                    
                                    <td>
                                        <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                            class="text-dark">Edited_by</a></h5>
                                        </td>
                                        <td>
                                            <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-dark">Status</a></h5>
                                        </td>
                                    <td>
                                        Action
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
                                            <p class="mb-0">{{ $item->lokasi }}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0">{{ $item->volume }}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0">{{ $item->asal_warehouse }}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0 text-center">{{ $item->stock }}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0">{{ $item->waktu_mulai }}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0">{{ $item->waktu_selesai }}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0">{{ $item->kepala }}</p>
                                        </td>
                                        
                                        <td>
                                            <p class="mb-0">{{ $item->edited_by }}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0">@if ($item->status == null)
                                                Belum Selesai
                                                @else
                                                {{ $item->status }}
                                            @endif </p>
                                        </td>
                                        @if (auth()->user()->role == 'admin')
                                            <td class="d-flex gap-2">
                                                {{-- <a class="btn btn-warning me-2"
                                                    href="{{ url('update-Data/' . $item->id) . '/edit' }}"><i
                                                        class="bx bx-pencil"></i>Edit</a> --}}

                                                <form action="{{ url('update-Data/' . $item->id) . '/edit' }}" method="POST">
                                                    <button type="submit" class="btn btn-warning btn-edit"><i
                                                            class="bx bx-pencil"></i> Edit</button>
                                                </form>

                                                <form action="{{ url('Project-Management/' . $item->id) }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-delete"><i
                                                            class="bx bx-trash-alt"></i> Delete</button>
                                                </form>
                                            </td>
                                        @endif
                                        @if (auth()->user()->role == 'kepala_project')
                                            <td class="d-flex gap-2">
                                                {{-- <a class="btn btn-warning me-2"
                                                    href="{{ url('update-Data/' . $item->id) . '/edit' }}"><i
                                                        class="bx bx-pencil"></i>Edit</a> --}}

                                                <form action="{{ url('update-Data/' . $item->id) . '/edit' }}" method="POST">
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
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_project">Create Project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Isi formulir modal -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="lokasi">Lokasi Proyek</label>
                                    <input type="text" name="lokasi" class="form-control" placeholder="Enter Lokasi"
                                        id="lokasi">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="volume">Volume Pengerjaan Proyek</label>
                                    <input type="text" name="volume" class="form-control" placeholder="Enter volume"
                                        id="volume">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="asal_warehouse">Asal Stock</label>
                                    <select class="form-select" name="asal_warehouse" id="asal_warehouse">
                                        <option selected disabled>Select Warehouse</option>
                                        @foreach ($warehouse as $item)
                                            <option value="{{ $item->nama }}" data-stock="{{ $item->stock }}">
                                                {{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    <label id="selected_stock" class="mt-2 ml-2"></label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="stock">Stock Material yang digunakan</label>
                                    <input type="number" name="stock" class="form-control" placeholder="stock"
                                        id="stock">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="waktu_mulai">Waktu Mulai</label>
                                    <input type="date" name="waktu_mulai" class="form-control"
                                        placeholder="waktu mulai" id="waktu_mulai">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="waktu_selesai">Waktu Selesai</label>
                                    <input type="date" name="waktu_selesai" class="form-control"
                                        placeholder="waktu selesai" id="waktu_selesai">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Category">Kepala Project</label>
                                    <select class="form-select" name="kepala" id="kategori">
                                        <option selected disabled> Select Kepala Project </option>
                                        @foreach ($kepala as $item)
                                            <option value="{{ $item->nama }}"> {{ $item->nama }} </option>
                                        @endforeach
                                    </select>
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
                    "columnDefs": [{
                            "orderable": false,
                            "targets": [10]
                        } // Disable sorting for the third column (index 2)
                        // Add more entries as needed for other columns
                    ]
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
