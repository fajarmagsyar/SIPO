@extends('includes.layout')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="row">
                <div class="col-xl-12 col-sm-12">
                    <div class="card flex-fill w-100">
                        <div class="card-header">
                            <h5 class="card-title text-dark mb-0">Pilih Tanggal</h5>
                        </div>
                        <div class="card-body py-3">
                            <form action="/admin-pg/laporan/export/query">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-5 col-sm-12">
                                        <label class="mb-2"> <i class="align-middle" data-feather="calendar"></i>
                                            Dari</label>
                                        <input type="text" class="fp-date form-control" value="{{ date('Y-m-d') }}"
                                            placeholder="Pilih Tanggal" name="dari">
                                    </div>
                                    <div class="col-xl-2 mt-3 mb-3 col-sm-12 text-center align-middle my-auto">
                                        <i class="align-middle" data-feather="arrow-right" id="pointer"></i>
                                    </div>
                                    <div class="col-xl-5 col-sm-12">
                                        <label class="mb-2"> <i class="align-middle" data-feather="calendar"></i>
                                            Hingga</label>
                                        <input type="text" class="fp-date form-control" value="{{ date('Y-m-d') }}"
                                            placeholder="Pilih Tanggal" name="hingga">
                                    </div>
                                    <div class="col-sm-12 mt-4 text-end mb-2">
                                        <a href="/admin-pg/laporan/export" class="btn btn-success"><i
                                                data-feather="printer"></i> Cetak
                                            Seluruh</a>
                                        <button class="btn btn-primary"><i data-feather="printer"></i> Cetak
                                            Laporan</button>
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
        if (window.innerWidth < window.innerHeight) {
            $('#pointer').prop('style', 'transform: rotate(90deg)');
        }
    </script>
@endpush
