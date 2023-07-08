@extends('includes.layout')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-4">
                <h1 class="h3 mb-3 d-inline align-middle">

                    <strong>
                        <a class="d-inline text-sm" onclick="history.back()">
                            <i class="align-middle" data-feather="arrow-left"></i>
                        </a>Tambah Master Obat</strong>
                </h1>
                <div class="text-sm mt-1 text-muted">
                    Silahkan masukkan data sesuai dengan form dan format telah disediakan
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Form Tambah</h5>
                        </div>
                        <div class="card-body">
                            <form action="/admin-pg/obat/{{ $data->obat_id }}" id="form" method="POST"
                                data-parsley-validate="">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="kode_obat" class="mb-2">Kode Obat <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-height" name="kode_obat"
                                            id="kode_obat" value="{{ $data->kode_obat }}" required>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="nama_obat" class="mb-2">Nama Obat <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-height" name="nama_obat"
                                            id="nama_obat" required value="{{ $data->nama_obat }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="kemasan" class="mb-2">Kemasan <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-height" name="kemasan" id="kemasan"
                                            required value="{{ $data->kemasan }}">
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="stok_awal" class="mb-2">Stok Awal <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control form-height" name="stok_awal"
                                            id="stok_awal" readonly disabled placeholder="{{ $data->stok_awal }}">
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="hjd" class="mb-2">HJD (Harga Jual Dagang) <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control form-height" name="hjd" id="hjd"
                                            required value="{{ $data->hjd }}">
                                        <span class="text-sm text-muted">HJD (Harga Jual Dagang) = HNA (Harga Netto Apotek)
                                            +
                                            PPN</span>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="keterangan" class="mb-2">Keterangan</label>
                                        <textarea name="keterangan" class="form-control" id="keterangan" cols="30" rows="5"
                                            data-parsley-maxlength="200">{{ $data->keterangan }}</textarea>
                                        <span class="text-sm text-muted counter" data-parsley-maxlength="200">Maksimal 200
                                            karakter. <i id="charlen"></i>/200 karakter.</span>
                                    </div>
                                    <div class="col-lg-12">
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
