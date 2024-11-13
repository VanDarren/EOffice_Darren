<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h4 mb-1">Data Surat Pengajuan Cuti</h2>
                <p class="mb-4">Berikut adalah daftar pengajuan cuti yang diterima.</p>

                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Bagian</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Jenis Cuti</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Total Hari</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Diambil Alih</th>
                                    <th>Alamat</th>
                                    <th>Keterangan</th>
                                    <th>Jenis Pengajuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuancuti as $item)
                                    <tr>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->nik }}</td>
                                        <td>{{ $item->level }}</td> <!-- Asumsi level adalah relasi dengan tabel level -->
                                        <td>{{  $item->tanggal }}</td>
                                        <td>{{ $item->jenis_cuti }}</td>
                                        <td>{{  $item->tanggal_mulai }}</td>
                                        <td>{{  $item->tanggal_akhir }}</td>
                                        <td>{{ $item->total_hari }}</td>
                                        <td>{{  $item->tanggal_kembali }}</td>
                                        <td>{{ $item->diambil_alih }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>{{  $item->jenis }}</td> <!-- Asumsi jenisPengajuan adalah relasi dengan tabel jenis_pengajuan -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
