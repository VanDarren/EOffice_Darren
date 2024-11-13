<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="h4 mb-1">Data Surat Keluar</h2>
                <p class="mb-4">Berikut adalah daftar surat kasuk yang diterima.</p>

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
                                    <th>Jenis Surat</th>
                                    <th>Aksi</th> <!-- Kolom aksi -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suratkeluar as $item)
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
                                        <td>{{ $item->jenis }}</td>
                                        <td>
                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('deletesuratkeluar', ['id' => $item->id_suratkeluar]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="text-center mt-4">
                    <a href="{{ route('restoredeletesuratkeluar') }}" class="btn btn-info btn-sm">Lihat Surat Keluar yang Dihapus</a>
                </div>
            </div>
        </div>
    </div>
</main>
