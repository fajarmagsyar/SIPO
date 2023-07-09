@extends('includes.layout')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-4">
                <h1 class="h3 mb-3 d-inline"><strong>{{ $title }}</strong></h1>
                <div class="text-sm text-muted mt-1">
                    Data ini menampilkan seluruh aktifitas yang dilakukan oleh admin
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
                                                    <th class="align-top">Admin</th>
                                                    <th class="align-top text-center">Aktifitas</th>
                                                    <th class="align-top">Detail</th>
                                                    <th class="align-top">Waktu</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $no => $r)
                                                    <tr>
                                                        <th class="text-center align-middle">{{ $no = $no + 1 }}</th>
                                                        <td><strong>{{ $r->nama_admin }}</strong> <br> <span
                                                                class="text-sm text-muted">{{ $r->email }} <br>
                                                                {{ $r->no_hp }}</span></td>

                                                        <td class="text-center">{{ $r->jenis }} <br>
                                                            <span class="text-sm text-muted">{{ $r->kode_obat }}</span>
                                                        </td>
                                                        <td>
                                                            {!! $r->detail !!}
                                                        </td>
                                                        <td>{{ $r->created_at }}</td>
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
