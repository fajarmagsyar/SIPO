<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Export</title>
</head>

<body>
    <table border="1" style="border-collapse: collapse;">
        <thead>
            <tr style="background-color:bisque">
                <th rowspan="2">No</th>
                <th rowspan="2">Kode Obat</th>
                <th rowspan="2">Nama Obat</th>
                <th rowspan="2">Kemasan</th>
                <th rowspan="2">Stok Awal</th>
                <th rowspan="2">No Batch</th>
                <th rowspan="2">Tgl Kadaluarsa</th>
                <th rowspan="2">Sumber Pemasukan</th>
                <th rowspan="2">Keterangan</th>
                <th colspan="4">Jumlah Pengeluaran</th>
                <th colspan="9">Jumlah Pemasukkan</th>
                <th rowspan="2">Tujuan Pengeluaran</th>
                <th rowspan="2">Keterangan</th>
                <th rowspan="2">HJD</th>
            </tr>
            <tr style="background-color:bisque">
                <th>Masuk Pabrik</th>
                <th>Masuk PBF</th>
                <th>Retur</th>
                <th>Lainnya</th>
                <th>RS</th>
                <th>Apotek</th>
                <th>PBF</th>
                <th>Sarana Pemerintahan</th>
                <th>Puskesmas</th>
                <th>Klinik</th>
                <th>Toko Obat</th>
                <th>Retur</th>
                <th>Lainnya</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $no => $r)
                <tr>
                    <td>{{ $no = $no + 1 }}</td>
                    <td>{{ $r->kode_obat }}</td>
                    <td>{{ $r->nama_obat }}</td>
                    <td>{{ $r->kemasan }}</td>
                    <td>{{ $r->stok_awal }}</td>
                    <td>{{ $r->no_batch }}</td>
                    <td>{{ $r->kadaluarsa }}</td>
                    <td>{{ $r->obat_keterangan }}</td>
                    <td>{{ $r->jenis == 'Masuk' ? $r->kode_pelaku : '' }}</td>
                    <td>{{ $r->jenis == 'Masuk' && $r->kategori == 'Pabrik' ? $r->jumlah : '' }}</td>
                    <td>{{ $r->jenis == 'Masuk' && $r->kategori == 'PBF' ? $r->jumlah : '' }}</td>
                    <td>{{ $r->jenis == 'Masuk' && $r->kategori == 'Retur' ? $r->jumlah : '' }}</td>
                    <td>{{ $r->jenis == 'Masuk' && $r->kategori == 'Lainnya' ? $r->jumlah : '' }}</td>
                    <td>{{ $r->jenis == 'Keluar' && $r->kategori == 'RS' ? $r->jumlah : '' }}</td>
                    <td>{{ $r->jenis == 'Keluar' && $r->kategori == 'Apotek' ? $r->jumlah : '' }}</td>
                    <td>{{ $r->jenis == 'Keluar' && $r->kategori == 'PBF' ? $r->jumlah : '' }}</td>
                    <td>{{ $r->jenis == 'Keluar' && $r->kategori == 'Sarana Pemerintahaan' ? $r->jumlah : '' }}</td>
                    <td>{{ $r->jenis == 'Keluar' && $r->kategori == 'Puskesmas' ? $r->jumlah : '' }}</td>
                    <td>{{ $r->jenis == 'Keluar' && $r->kategori == 'Klinik' ? $r->jumlah : '' }}</td>
                    <td>{{ $r->jenis == 'Keluar' && $r->kategori == 'Toko Obat' ? $r->jumlah : '' }}</td>
                    <td>{{ $r->jenis == 'Keluar' && $r->kategori == 'Retur' ? $r->jumlah : '' }}</td>
                    <td>{{ $r->jenis == 'Keluar' && $r->kategori == 'Lainnya' ? $r->jumlah : '' }}</td>
                    <td>{{ $r->jenis == 'Keluar' ? $r->kode_pelaku : '' }}</td>
                    <td>{{ $r->transaksi_keterangan }}</td>
                    <td>{{ number_format($r->hjd) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
