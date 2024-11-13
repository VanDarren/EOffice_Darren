<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">Form Pengajuan Cuti</h2>
                <p class="text-muted">Formulir untuk mengajukan cuti.</p>
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <strong class="card-title">Form Pengajuan Cuti</strong>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('aksiTambahCuti') }}" method="POST">
                            @csrf
                            
                            <!-- Nama -->
                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                            </div>

                            <!-- NIK -->
                            <div class="form-group row">
                                <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nik" name="nik" required>
                                </div>
                            </div>

                            <!-- Jabatan -->
                            <div class="form-group row">
                                <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-10">
                                    <select id="jabatan" name="jabatan" class="form-control" required>
                                        <option value="" disabled selected>Pilih Jabatan...</option>
                                        @foreach($bagian as $jabatanItem)
                                            <option value="{{ $jabatanItem->id_level }}">{{ $jabatanItem->level }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Tanggal -->
                            <div class="form-group row">
                                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                </div>
                            </div>

                            <!-- Jenis Cuti -->
                            <div class="form-group row">
                                <label for="jenis_cuti" class="col-sm-2 col-form-label">Jenis Cuti</label>
                                <div class="col-sm-10">
                                    <select id="jenis_cuti" name="jenis_cuti" class="form-control" required>
                                        <option value="" disabled selected>Pilih Jenis Cuti...</option>
                                        <option value="Cuti Tahunan">Cuti Tahunan</option>
                                        <option value="Cuti Khusus">Cuti Khusus</option>
                                        <option value="WFH">WFH</option>
                                        <option value="Sakit dengan Surat">Sakit dengan Surat</option>
                                        <option value="Sakit tanpa Surat">Sakit tanpa Surat</option>
                                        <option value="Ijin tanpa Bayar">Ijin tanpa Bayar</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Tanggal Mulai -->
                            <div class="form-group row">
                                <label for="tanggal_mulai" class="col-sm-2 col-form-label">Tanggal Mulai</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                                </div>
                            </div>

                            <!-- Tanggal Akhir -->
                            <div class="form-group row">
                                <label for="tanggal_akhir" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" required>
                                </div>
                            </div>

                            <!-- Total Hari -->
                            <div class="form-group row">
                                <label for="total_hari" class="col-sm-2 col-form-label">Total Hari</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="total_hari" name="total_hari" readonly>
                                </div>
                            </div>

                            <!-- Tanggal Kembali -->
                            <div class="form-group row">
                                <label for="tanggal_kembali" class="col-sm-2 col-form-label">Tanggal Kembali</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" required>
                                </div>
                            </div>

                            <!-- Diambil Alih Oleh -->
                            <div class="form-group row">
                                <label for="diambil_alih" class="col-sm-2 col-form-label">Diambil Alih Oleh</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="diambil_alih" name="diambil_alih" required>
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div class="form-group row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="alamat" name="alamat" rows="2" required></textarea>
                                </div>
                            </div>

                            <!-- Keterangan -->
                            <div class="form-group row">
                                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Ajukan Cuti</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // Fungsi untuk menghitung total hari cuti
    document.getElementById('tanggal_akhir').addEventListener('change', function() {
        var tanggalMulai = document.getElementById('tanggal_mulai').value;
        var tanggalAkhir = this.value;

        if (tanggalMulai && tanggalAkhir) {
            var start = new Date(tanggalMulai);
            var end = new Date(tanggalAkhir);
            var diff = Math.round((end - start) / (1000 * 60 * 60 * 24)) + 1; // Tambahkan 1 agar inklusif
            
            if (diff > 0) {
                document.getElementById('total_hari').value = diff + ' hari';
            } else {
                document.getElementById('total_hari').value = 'Tanggal tidak valid';
            }
        }
    });
</script>
