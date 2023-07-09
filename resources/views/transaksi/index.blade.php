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
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table dt">
                                            <thead>
                                                <tr>
                                                    <th class="text-center align-top">No</th>
                                                    <th class="align-top">Tgl Transaksi</th>
                                                    <th class="align-top">No Batch</th>
                                                    <th class="align-top">Detail Transaksi</th>
                                                    <th class="align-top">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $no => $r)
                                                    <tr>
                                                        <th class="text-center align-middle">{{ $no = $no + 1 }}</th>
                                                        <td>
                                                            <i class="align-middle" data-feather="calendar"></i>
                                                            <strong>{{ $r->created_at }}</strong>
                                                            <br> <span class="text-sm text-muted">By:
                                                                {!! $r->role == 1
                                                                    ? "<span class='text-success'>● " . $r->nama_admin . '</span>'
                                                                    : "<span class='text-primary'>● " . $r->nama_admin . '</span>' !!}</span>
                                                        </td>

                                                        <td><strong><a
                                                                    href="/admin-pg/batch?obat={{ $r->obat_id }}">{{ $r->no_batch }}
                                                                    <sup class="text-sm"><i class="align-middle"
                                                                            data-feather="link"></i></sup></a></strong> <br>
                                                            <span class="text-sm text-muted">{{ $r->kode_obat }} |
                                                                {{ $r->nama_obat }} <br>
                                                                Jumlah: {{ $r->jumlah }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <strong>{{ $r->nama_pelaku }}</strong> <br>
                                                            <span class="text-muted text-sm">{!! $r->jenis == 'Masuk'
                                                                ? "<span class='text-primary'>● Masuk</span>"
                                                                : "<span class='text-info'>● Keluar</span>" !!}
                                                                {{ $r->detail }}</span>
                                                        </td>
                                                        <td>
                                                            {{ $r->keterangan }}</td>
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
