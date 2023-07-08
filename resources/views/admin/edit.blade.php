@extends('includes.layout')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-4">
                <h1 class="h3 mb-3 d-inline align-middle">

                    <strong>
                        <a class="d-inline text-sm" onclick="history.back()">
                            <i class="align-middle" data-feather="arrow-left"></i>
                        </a>Tambah Master Admin</strong>
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
                            <form action="/admin-pg/admin/{{ $data->admin_id }}" id="form" method="POST"
                                data-parsley-validate="">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="nama_admin" class="mb-2">Nama Admin <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-height" name="nama_admin"
                                            id="nama_admin" value="{{ $data->nama_admin }}" required>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="no_hp" class="mb-2">No. HP <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control form-height" name="no_hp" id="no_hp"
                                            value="{{ $data->no_hp }}" required>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <label for="email" class="mb-2">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-height" name="email" id="email"
                                            value="{{ $data->email }}" required>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="password" class="mb-2">Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control form-height" name="password"
                                            id="password" value="{{ $data->password }}" required>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="role" class="mb-2">Role <span class="text-danger">*</span></label>
                                        <select name="role" class="form-control form-height" id="">
                                            <option value=""></option>
                                            <option value="0">Admin
                                            </option>
                                            <option value="1">
                                                Super
                                                Admin</option>
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
