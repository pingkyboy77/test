{{-- @dd($data) --}}
@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-light border-bottom">
                    <h5 class="card-title mb-0 fw-bold">WORK ORDER</h5>
                </div>
                <div class="card-body">
                    @if (auth()->user()->role=='kepala_project')
                        <form action="{{ route('cetak.laporanProject') }}">
                            <button type="submit" class="btn btn-danger d-flex justify-content-end ms-3"><i
                                class="bx bxs-file me-1"></i> Export</button>
                        </form>
                    @endif
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
                                        @if (auth()->user()->role == 'Dokter')
                                            <td class="d-flex gap-2 justify-content-center align-items-center ">
                                                @if ($item->tindakan !== null)
                                                    <i class="bx bx-check-circle fw-bold text-success"></i>Sudah Di Update Tindakan
                                                    @else
                                                    {{-- <form action="{{ route('accepted.keproj', ['id' =>$item->id]) }}" method="GET"> --}}
                                                        <button type="submit" onclick="openModal()" class="btn btn-success btn-edit"> MASUKAN TINDAKAN</button>
                                                    {{-- </form> --}}
                                                @endif
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
    <form action="{{ route('data-Management.update', ['id' => $item->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="edited_by" value="{{ $nama }}">
        <div class="modal fade create-tindakan" tabindex="-1" role="dialog" aria-labelledby="modal_project"
            aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_project">TINDAKAN DOKTER</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Isi formulir modal -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="tindakan">TINDAKAN YANG DI BERIKAN</label>
                                    <textarea type="text" name="tindakan" class="form-control" placeholder="Enter tindakan"
                                        id="tindakan"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="obat">Resep Obat</label>
                                    <textarea type="text" name="obat" class="form-control" placeholder="Enter obat"
                                        id="obat"></textarea>
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
            var modal = document.querySelector('.create-tindakan');
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

