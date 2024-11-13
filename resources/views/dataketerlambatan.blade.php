<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h4 mb-1">Data Keterlambatan</h2>
                <p class="mb-4">Berikut adalah daftar keterlambatan yang tercatat.</p>

                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Bagian</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Waktu Telat</th>
                                    <th>Alasan</th>
                                    <th>Jenis Keterlambatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($keterlambatan as $item)
                                    <tr>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->NIK }}</td>
                                        <td>{{ $item->level }}</td> <!-- Asumsi level adalah relasi dengan tabel level -->
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->waktu }}</td>
                                        <td>{{ $item->waktu_telat }} menit</td>
                                        <td>{{ $item->alasan }}</td>
                                        <td>{{ $item->jenis }}</td> <!-- Asumsi jenisKeterlambatan adalah relasi dengan tabel jenis_keterlambatan -->
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
