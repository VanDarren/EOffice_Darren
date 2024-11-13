<main role="main" class="main-content">
    <div class="container-fluid">
        <h2 class="page-title">E-Document</h2>
        <p class="text-muted">Pilih jenis dokumen untuk melihat data dan detailnya di satu halaman.</p>

        <div class="card shadow">
            <div class="card-body">
                <!-- Nav Tabs for Document Categories -->
                <ul class="nav nav-tabs" id="documentTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link @if(request('tab') == 'suratmasuk') active @endif" href="{{ route('document', ['tab' => 'suratmasuk']) }}">Surat Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request('tab') == 'suratkeluar') active @endif" href="{{ route('document', ['tab' => 'suratkeluar']) }}">Surat Keluar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request('tab') == 'keterlambatan') active @endif" href="{{ route('document', ['tab' => 'keterlambatan']) }}">Keterlambatan Hadir</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request('tab') == 'pengajuancuti') active @endif" href="{{ route('document', ['tab' => 'pengajuancuti']) }}">Pengajuan Cuti</a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content mt-3" id="documentTabContent">
                    <!-- Surat Masuk Tab -->
                    @if(request('tab') == 'suratmasuk')
                    <div class="tab-pane fade show active" id="suratmasuk" role="tabpanel">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Perihal</th>
                                    <th>Tanggal Terima</th>
                                    <th>Pengirim</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suratmasuk as $surat)
                                    <tr>
                                        <td>{{ $surat->perihal }}</td>
                                        <td>{{ $surat->tanggal_terima }}</td>
                                        <td>{{ $surat->pengirim }}</td>
                                        <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#dataModal" onclick="showDocumentDetail('{{ $surat->id_suratmasuk }}')">Lihat</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    <!-- Surat Keluar Tab -->
                    @if(request('tab') == 'suratkeluar')
                    <div class="tab-pane fade show active" id="suratkeluar" role="tabpanel">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Perihal</th>
                                    <th>Tanggal Terima</th>
                                    <th>Pengirim</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suratkeluar as $surat)
                                    <tr>
                                        <td>{{ $surat->perihal }}</td>
                                        <td>{{ $surat->tanggal_terima }}</td>
                                        <td>{{ $surat->pengirim }}</td>
                                        <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#dataModal" onclick="showDocumentDetail('{{ $surat->id_suratkeluar }}')">Lihat</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    <!-- Keterlambatan Tab -->
                    @if(request('tab') == 'keterlambatan')
                    <div class="tab-pane fade show active" id="keterlambatan" role="tabpanel">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Level</th>
                                    <th>Tanggal</th>
                                    <th>Waktu Telat</th>
                                    <th>Alasan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($keterlambatan as $item)
                                    <tr>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->NIK }}</td>
                                        <td>{{ $item->id_level }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->waktu_telat }}</td>
                                        <td>{{ $item->alasan }}</td>
                                        <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#dataModal" onclick="showDocumentDetail('{{ $item->id_keterlambatan }}')">Lihat</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    <!-- Pengajuan Cuti Tab -->
                    @if(request('tab') == 'pengajuancuti')
                    <div class="tab-pane fade show active" id="pengajuancuti" role="tabpanel">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Level</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Jenis Cuti</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Total Hari</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuancuti as $cuti)
                                    <tr>
                                        <td>{{ $cuti->nama }}</td>
                                        <td>{{ $cuti->nik }}</td>
                                        <td>{{ $cuti->id_level }}</td>
                                        <td>{{ $cuti->tanggal }}</td>
                                        <td>{{ $cuti->jenis_cuti }}</td>
                                        <td>{{ $cuti->tanggal_mulai }}</td>
                                        <td>{{ $cuti->tanggal_akhir }}</td>
                                        <td>{{ $cuti->total_hari }}</td>
                                        <td>{{ $cuti->tanggal_kembali }}</td>
                                        <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#dataModal" onclick="showDocumentDetail('{{ $cuti->id_pengajuan }}')">Lihat</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
