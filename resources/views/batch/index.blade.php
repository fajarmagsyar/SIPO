@extends('includes.layout')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-4">
                <a class="btn btn-success border-rr d-inline text-sm float-end" href="{{ $link_tambah }}">
                    + Tambah Data
                </a>
                <h1 class="h3 mb-3 d-inline"><strong>{{ $title }}</strong></h1>
                <div class="text-sm text-muted mt-1">
                    Halaman untuk mengolah data batch untuk obat
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card p-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 mb-4">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Cari kode obat..."
                                            aria-label="Cari kode obat" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button"><i class="align-middle"
                                                    data-feather="search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table dt">
                                            <thead>
                                                <tr>
                                                    <th class="text-center align-top">No</th>
                                                    <th class="align-top">No Batch</th>
                                                    <th class="align-top">Obat</th>
                                                    <th class="align-top">Kadaluarsa</th>
                                                    <th class="text-center"><i class="align-middle"
                                                            data-feather="settings"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $no => $r)
                                                    <tr>
                                                        <th class="text-center align-middle">{{ $no = $no + 1 }}</th>
                                                        <td><strong>{{ $r->no_batch }}</strong> <br> <span
                                                                class="text-sm text-muted">{{ $r->created_at }}</span></td>

                                                        <td><strong>{{ $r->nama_obat }}</strong> <br> <span
                                                                class="text-sm text-muted">{{ $r->kode_obat }}</span></td>
                                                        <td><i class="align-middle" data-feather="calendar"></i>
                                                            {{ $r->kadaluarsa }}</td>
                                                        <td class="text-center">
                                                            <div class="dropdown">
                                                                <div type="button" id="dropdownMenuButton2"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="align-middle"
                                                                        data-feather="more-horizontal"></i>
                                                                </div>

                                                                <ul class="dropdown-menu dropdown-menu-dark"
                                                                    aria-labelledby="dropdownMenuButton2">
                                                                    <li><a class="dropdown-item"
                                                                            href="/admin-pg/batch/{{ $r->batch_id }}/edit">Sunting</a>
                                                                    </li>
                                                                    <li>
                                                                        <form action="/admin-pg/batch/{{ $r->batch_id }}"
                                                                            method="POST" id="form_{{ $no }}">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <div class="dropdown-item" type="submit"
                                                                                onClick="deletePrompt('{{ $r->nama_obat }}', '{{ $no }}')">
                                                                                Hapus</div>
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
@push('js')
    @if (session()->has('success'))
        <script>
            Swal.fire(
                "Berhasil",
                "{{ session('success') }}",
                "success",
            )
        </script>
    @endif

    <script>
        function deletePrompt(nama, no) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-success'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Lanjutkan?',
                text: "Apakah anda ingin menghapus data " + nama + "?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                showClass: {
                    popup: 'animate__animated animate__fadeInUp'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutDown'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form_' + no).submit();
                }
            });
        }
    </script>
@endpush
