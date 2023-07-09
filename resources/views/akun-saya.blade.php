@extends('includes.layout')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Profile</h1>
            </div>
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Detail Profil</h5>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ auth()->user()->img !== null ? '/' . auth()->user()->img : '/assets/img/default.jpg' }}"
                                alt="Christina Mason" class="img-fluid rounded-circle mb-2"
                                style="object-fit: cover; width: 128px; height: 128px;" />
                            <h5 class="card-title mb-0">{{ $data->nama_admin }}</h5>
                            <div class="text-muted mb-2">{{ $data->role == 1 ? 'Superadmin' : 'Admin' }}</div>

                            <div>
                                <a class="btn btn-primary btn-sm border-rr px-2" href="#"><span
                                        data-feather="whatsapp"></span>Whatsapp</a>
                                <a class="btn btn-primary btn-sm border-rr px-2" href="#"><span
                                        data-feather="mail"></span>
                                    Email</a>
                            </div>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            <h5 class="h6 card-title">Informasi Login</h5>
                            <div><strong>Akun Dibuat</strong> <br><i>{{ $data->created_at }}</i></div>
                            <div><strong>Login Terakhir</strong> <i> <br>{{ $data->last_login }}</i></div>
                            <div class="text-sm mt-3"><strong>Detail Login Terakhir</strong></div>
                            {!! $data->last_login_detail !!}
                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            <h5 class="h6 card-title">Ubah Password</h5>
                            <form action="/ganti-password" method="post">
                                @csrf
                                <div class="mb-3">
                                    <input type="password" name="password_lama" placeholder="Password Lama"
                                        class="form-control">
                                </div>
                                <div class="mb-3">
                                    <input type="password" name="password" placeholder="Password Baru" class="form-control"
                                        required>
                                </div>
                                @if (session()->has('error'))
                                    <div class="text-danger">{{ session('error') }}</div>
                                @endif
                                @if (session()->has('success'))
                                    <div class="text-success">{{ session('success') }}</div>
                                @endif
                                <div class="mb-3 mt-3">
                                    <input type="submit" name="password" value="Simpan" placeholder="Password Baru"
                                        class="btn btn-primary" required>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-xl-9">
                    <div class="card">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Aktifitas Terbaru</h5>
                        </div>
                        <div class="card-body h-100">
                            @foreach ($log as $log)
                                <div class="d-flex align-items-start">
                                    <img src="{{ auth()->user()->img !== null ? '/' . auth()->user()->img : '/assets/img/default.jpg' }}"
                                        style="width: 36px; height: 36px; object-fit: cover;" class="rounded-circle me-2"
                                        alt="Foto Profil">
                                    <div class="flex-grow-1">
                                        <strong>{{ $data->nama_admin }}</strong> {{ $log->jenis }}<br />
                                        <span class="text-muted" style="font-size: 10px">{!! $log->detail !!}</span>
                                        <br>
                                        <small class="text-muted float-end"><span
                                                data-feather="calendar"></span>{{ $log->created_at }}</small><br />

                                    </div>
                                </div>

                                <hr />
                            @endforeach
                            <div class="d-grid">
                                <a href="/admin-pg/log-activity/{{ $data->admin_id }}" class="btn btn-primary">Lihat
                                    Aktivitas Lainnya</a>
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
    @if (session()->has('error'))
        <script>
            Swal.fire(
                "Gagal",
                "{{ session('error') }}",
                "error",
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
