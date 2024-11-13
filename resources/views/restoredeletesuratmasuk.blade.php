<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h4 mb-1">Data Surat Masuk yang Dihapus</h2>
                <p class="mb-4">Berikut adalah daftar surat masuk yang telah dihapus. Klik "Restore" untuk mengembalikannya.</p>

                <div class="card shadow">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Lampiran</th>
                                    <th>Nomor Surat</th>
                                    <th>Tanggal Terima</th>
                                    <th>Perihal</th>
                                    <th>Pengirim</th>
                                    <th>Aksi</th> <!-- Kolom untuk tombol restore -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deletesuratmasuk as $item)
                                    <tr>
                                        <td>
                                            @if($item->lampiran)
                                                <a href="{{ asset('public/dokumen/' . $item->lampiran) }}" download="{{ $item->lampiran }}" target="_blank">Lihat Lampiran</a>
                                            @else
                                                Tidak ada lampiran
                                            @endif
                                        </td>
                                        <td>{{ $item->nomor_surat }}</td>
                                        <td>{{ $item->tanggal_terima }}</td>
                                        <td>{{ $item->perihal }}</td>
                                        <td>{{ $item->pengirim }}</td>
                                        <td>
                                            <!-- Tombol Restore -->
                                            <form action="{{ route('restoreSuratMasuk', ['id' => $item->id_suratmasuk]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengembalikan surat ini?');">
                                            @csrf
                                                <button type="submit" class="btn btn-warning btn-sm">Restore</button>
                                            </form>
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
</main>
