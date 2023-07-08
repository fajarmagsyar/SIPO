@extends('includes.layout')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-4">
                <h1 class="h3 mb-3 d-inline align-middle">

                    <strong>
                        <a class="d-inline text-sm" onclick="history.back()">
                            <i class="align-middle" data-feather="arrow-left"></i>
                        </a>Tambah {{ $title }}</strong>
                </h1>
                <div class="text-sm mt-1 text-muted">
                    Silahkan masukkan data sesuai dengan form dan format telah disediakan
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ $linkPost }}" id="form" method="POST" data-parsley-validate="">
                                @csrf
                                @method('PATCH')
                                <h5><strong>Pilih Obat</strong></h5>
                                <div class="row">
                                    <div class="col-sm-12 mb-4">
                                        <input type="text" class="form-control" readonly disabled
                                            placeholder="{{ $obat->nama_obat }} | {{ $obat->kode_obat }}">
                                        <span class="text-muted text-sm">Kode obat tidak dapat diganti</span>
                                    </div>
                                </div>
                                <h5><strong>Masukkan Detail Batch</strong></h5>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="no_batch" class="mb-2">No Batch<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-height" name="no_batch"
                                            id="no_batch" required value="{{ $data->no_batch }}">
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <label for="kadaluarsa" class="mb-2">Kadaluarsa <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-height fp-date" name="kadaluarsa"
                                            id="kadaluarsa" required value="{{ $data->kadaluarsa }}">
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="reset" class="btn btn-secondary border-rr d-inline text-sm"
                                            href="#">
                                            <i class="align-middle" data-feather="refresh-ccw"></i>
                                            Reset
                                        </button>
                                        <div id="submitButton" class="btn btn-primary border-rr d-inline text-sm float-end"
                                            href="#">
                                            Lanjutkan
                                            <i class="align-middle" data-feather="arrow-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
@push('js')
    <script>
        $('#submitButton').click(function() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Lanjutkan?',
                text: "Apakah data yang anda isi telah benar?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Lanjutkan',
                cancelButtonText: 'Cek Kembali',
                reverseButtons: true,
                showClass: {
                    popup: 'animate__animated animate__fadeInUp'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutDown'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form').submit();
                }
            })
        });
        $('#keterangan').on('keyup paste', function() {
            var Characters = $("#keterangan").val().replace(/(<([^>]+)>)/ig, "").length;
            $("#charlen").text(Characters);

            $('.counter').removeClass('text-danger');
            $('.counter').addClass('text-muted');
            if (Characters > 200) {
                $('.counter').removeClass('text-muted');
                $('.counter').addClass('text-danger');
            }
        });
    </script>
@endpush
