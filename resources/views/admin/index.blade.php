@extends('includes.layout')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-4">
                <a class="btn btn-success border-rr d-inline text-sm float-end" href="/admin-pg/admin/create">
                    + Tambah Data
                </a>
                <h1 class="h3 mb-3 d-inline"><strong>Master Admin</strong></h1>
                <div class="text-sm text-muted mt-1">
                    Olah Data Admin
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
                                                    <th class="text-center align-top">Foto</th>
                                                    <th class="text-center align-top">Detail Admin</th>
                                                    <th class="align-top">Role</th>
                                                    <th class="text-center"><i class="align-middle"
                                                            data-feather="settings"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $no => $r)
                                                    <tr>
                                                        <th class="text-center align-middle">{{ $no = $no + 1 }}</th>
                                                        <td class="text-center"><img
                                                                src="{{ $r->img !== null ? '/' . $r->img : '/assets/img/default.jpg' }}"
                                                                style="height: 100px; width: 100px; object-fit: cover"
                                                                class="border-rr" alt="Profil Admin">
                                                        </td>
                                                        <td><strong>{{ $r->nama_admin }}</strong> <br>
                                                            <span class="text-sm text-muted">{{ $r->no_hp }}</span><br>
                                                            <span class="text-sm text-muted">{{ $r->email }}</span>
                                                        </td>
                                                        <td>
                                                            {!! $r->role == 1
                                                                ? "<span class='text-success'>● Superadmin</span>"
                                                                : "<span class='text-primary'>● Admin</span>" !!}
                                                        </td>
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
                                                                            href="/admin-pg/admin/{{ $r->admin_id }}/edit">Sunting</a>
                                                                    </li>
                                                                    @if (auth()->user()->admin_id !== $r->admin_id)
                                                                        <li>
                                                                            <form
                                                                                action="/admin-pg/admin/{{ $r->admin_id }}"
                                                                                method="POST"
                                                                                id="form_{{ $no }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <div class="dropdown-item" type="submit"
                                                                                    onClick="deletePrompt('{{ $r->nama_admin }}', '{{ $no }}')">
                                                                                    Hapus</div>
                                                                            </form>
                                                                        </li>
                                                                    @endif
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
