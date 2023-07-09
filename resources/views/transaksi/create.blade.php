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
                                @method('POST')
                                <h5><strong>Masukkan Transaksi</strong></h5>
                                <div class="row">
                                    <div class="col-lg-5 col-sm-12 col-md-12 mb-3">
                                        <label for="batch_id" class="mb-2">No Batch<span
                                                class="text-danger">*</span></label>
                                        <select name="batch_id" class="form-control w-100 select2-nc" id="batch_id">
                                            @foreach ($batch as $r)
                                                <option value="{{ $r->batch_id }}">
                                                    {{ $r->nama_obat . ' | ' . $r->kode_obat }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-2 text-center col-sm-12 col-md-12 mb-3">

                                        <label for="jenis" class="mb-2">
                                            <i class="align-middle" id="truck" data-feather="truck"></i>
                                        </label>
                                        <select name="jenis" class="form-control select2-nc" id="jenis">
                                            <option value="Keluar">Keluar</option>
                                            <option value="Masuk">Masuk</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-5 col-sm-12 col-md-12 mb-3">
                                        <label for="pelaku_id" class="mb-2">Tujuan<span
                                                class="text-danger">*</span></label>
                                        <select name="pelaku_id" class="form-control select2-nc" id="pelaku">
                                            @foreach ($pelaku as $r)
                                                <option value="{{ $r->pelaku_id }}" data-hak="{{ $r->hak }}"
                                                    data-jenis="{{ $r->kategori }}">
                                                    {{ $r->nama_pelaku . ' | ' . $r->kode_pelaku }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-12 mb-3 d-none" id="detail">
                                        <label for="no_batch" class="mb-2">Detail<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-height" name="no_batch"
                                            id="no_batch">
                                        <span class="text-muted text-sm">Masukkan Tujuan jika anda memilih
                                            <strong>"Lainnya"</strong> pada
                                            kolom <strong>"Tujuan"</strong></span>
                                    </div>
                                </div>
                                <h5><strong>Masukkan Detail Transaksi</strong></h5>
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <label for="no_batch" class="mb-2">Keterangan</label>
                                        <textarea name="keterangan" data-parsley-maxlength="200" id="keterangan" class="form-control" cols="30"
                                            rows="5"></textarea>
                                        <div class="text-sm text-muted counter"><span id="charlen"></span>/200 Karakter.
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-4">
                                        <label for="admin" class="mb-2">Admin <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-height" name="admin" id="admin"
                                            readonly disabled value="{{ auth()->user()->nama_admin }}">
                                    </div>
                                    <div class="col-lg-12 mb-4">
                                        <label for="jumlah" class="mb-2">Jumlah <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control form-height" name="jumlah"
                                            id="jumlah">
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
        $(('#jenis')).on('change', function() {
            if ($('#jenis').val() == 'Masuk') {
                $('#truck').addClass('putar-balik');
            } else {
                $('#truck').removeClass('putar-balik');
            }
        });
        let hak = $(this).find("option:selected, #pelaku").data('hak');
        console.log(hak);
        if (hak == 1) {
            console.log('Masuk');
        } else if (hak == 2) {
            console.log('Keluar');
        } else {
            console.log('masuk dan keluar');
        }
        $('#pelaku').on('change', function() {
            console.log();
            let hak = $(this).find("option:selected").data('hak');
            let kat = $(this).find("option:selected").data('jenis');
            if (hak == 1) {
                $('#jenis').empty();
                $('#jenis').append(" <option value='1'> Masuk </option>");
            } else if (hak == 2) {
                $('#jenis').empty();
                $('#jenis').append(" <option value='2'> Keluar </option>");
            } else {
                $('#jenis').empty();
                $('#jenis').append(" <option value='1'> Masuk </option>");
                $('#jenis').append(" <option value='2'> Keluar </option>");
            }

            if (kat == 'Lainnya') {
                $('#detail').removeClass('d-none');
            } else {
                $('#detail').addClass('d-none');
            }
        });
    </script>
@endpush
