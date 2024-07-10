@extends('layouts.app')

@section('content')
    <div class="row">

        {{-- HISTORY STOCK MASUK  --}}
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-light border-bottom  d-flex justify-content-between">
                    <h5 class="card-title mb-0 fw-bold">HISTORY PENERIMAAN STOCK</h5>
                    <form action="{{ route('cetak.laporan.PMB') }}">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <label for="bulan">Bulan:</label>
                                <select class="form-select" name="bulan" id="bulan">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ date('n') == $i ? 'selected' : '' }}>
                                            {{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div>
                                <label for="tahun">Tahun:</label>
                                <select class="form-select" name="tahun" id="tahun">
                                    @for ($i = date('Y'); $i >= 2020; $i--)
                                        <option value="{{ $i }}" {{ date('Y') == $i ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger d-flex align-items-center ms-3"><i
                                    class="bx bxs-file me-1"></i> Export</button>
                        </div>
                    </form>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-nowrap align-middle mb-0 table-borderless" id="myTable2">
                            <thead>
                                <tr>
                                    <td class="d-flex justify-content-start">
                                        <h5 class="text-truncate font-size-14 m-0">No</h5>
                                    </td>
                                    <td>
                                        <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                class="text-dark">Nama Warehouse</a></h5>
                                    </td>
                                    <td>
                                        <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                class="text-dark">Stock Masuk</a></h5>
                                    </td>
                                    <td>
                                        <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                class="text-dark">Tanggal Masuk</a></h5>
                                    </td>
                                    <td>
                                        <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                class="text-dark">Action</a></h5>
                                    </td>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($history_masuk != null)
                                    @foreach ($history_masuk as $item)
                                        <tr>
                                            <td class="d-flex justify-content-start">
                                                <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                        class="text-dark">{{ $loop->iteration }}</a></h5>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->warehouse_name }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->stock }}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0">{{ $item->tanggal_masuk }}</p>
                                            </td>
                                            <td class="d-flex gap-2">
                                                {{-- <a class="btn btn-warning me-2"
                                        href="{{ url('update-Data/' . $item->id) . '/edit' }}"><i
                                            class="bx bx-pencil"></i>Edit</a> --}}

                                                <form action="{{ route('history-edit.admin', ['id' => $item->id]) }}"
                                                    method="POST">
                                                    <button type="submit" class="btn btn-warning btn-edit"><i
                                                            class="bx bx-pencil"></i> Edit</button>
                                                </form>

                                                <form
                                                    action="{{ route('history-delete-store.admin', ['id' => $item->id]) }}"
                                                    method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-delete"><i
                                                            class="bx bx-trash-alt"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            var dataTableExists = $.fn.DataTable.isDataTable('#myTable2');
            if (dataTableExists) {
                $('#myTable2').DataTable().destroy();
            }

            setTimeout(() => {

                $('#myTable2').DataTable({
                    scrollCollapse: true,
                    responsive: true,

                    "columnDefs": [{
                        "orderable": false,
                        "targets": [4]
                    }]
                });
            }, 100);
        });
    </script>

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
