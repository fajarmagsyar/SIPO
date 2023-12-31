@extends('includes.layout')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-4">
                <h1 class="h3 mb-3 d-inline align-middle">

                    <strong>
                        <a class="d-inline text-sm" onclick="history.back()">
                            <i class="align-middle" data-feather="arrow-left"></i>
                        </a>Tambah Master Pelaku</strong>
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
                            <form action="/admin-pg/pelaku/{{ $data->pelaku_id }}" id="form" method="POST"
                                data-parsley-validate="">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="kode_pelaku" class="mb-2">Kode Pelaku <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-height" name="kode_pelaku"
                                            id="kode_pelaku" value="{{ $data->kode_pelaku }}" required>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="nama_pelaku" class="mb-2">Nama Pelaku <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-height" name="nama_pelaku"
                                            id="nama_pelaku" value="{{ $data->nama_pelaku }}" required>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="kategori" class="mb-2">Kategori <span
                                                class="text-danger">*</span></label>
                                        <select name="kategori" class="form-control form-height" id="">
                                            <option value=""></option>
                                            <option {{ $data->kategori == 'Apotek' ? 'selected' : '' }} value="Apotek">
                                                Apotek</option>
                                            <option {{ $data->kategori == 'Klinik' ? 'selected' : '' }} value="Klinik">
                                                Klinik</option>
                                            <option {{ $data->kategori == 'Pabrik' ? 'selected' : '' }} value="Pabrik">
                                                Pabrik</option>
                                            <option {{ $data->kategori == 'PBF' ? 'selected' : '' }} value="PBF">PBF
                                            </option>
                                            <option {{ $data->kategori == 'Puskesmas' ? 'selected' : '' }}
                                                value="Puskesmas">Puskesmas</option>
                                            <option {{ $data->kategori == 'Retur' ? 'selected' : '' }} value="Retur">Retur
                                            </option>
                                            <option {{ $data->kategori == 'RS' ? 'selected' : '' }} value="RS">RS
                                            </option>
                                            <option {{ $data->kategori == 'Status Pemerintah' ? 'selected' : '' }}
                                                value="Status Pemerintah">Status Pemerintah</option>
                                            <option {{ $data->kategori == 'Toko Obat' ? 'selected' : '' }}
                                                value="Toko Obat">Toko Obat</option>
                                            <option {{ $data->kategori == 'Lainnya' ? 'selected' : '' }} value="Lainnya">
                                                Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="hak" class="mb-2">Hak <span class="text-danger">*</span></label>
                                        <select name="hak" value="{{ $data->hak }}" class="form-control form-height"
                                            id="">
                                            <option value="1" {{ $data->hak == 1 ? 'selected' : '' }}>Masuk</option>
                                            <option value="2" {{ $data->hak == 2 ? 'selected' : '' }}>Keluar</option>
                                            <option value="3" {{ $data->hak == 3 ? 'selected' : '' }}>Masuk & Keluar
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="status" class="mb-2">Status <span
                                                class="text-danger">*</span></label>
                                        <select name="status" value="{{ $data->kode_pelaku }}"
                                            class="form-control form-height" id="">
                                            <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Aktif
                                            </option>
                                            <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Tidak Aktif
                                            </option>
                                        </select>
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
