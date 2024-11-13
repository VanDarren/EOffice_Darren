<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">Form Keterlambatan Kehadiran</h2>
                <p class="text-muted">Formulir untuk mencatat keterlambatan kehadiran.</p>
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <strong class="card-title">Form Keterlambatan Kehadiran</strong>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('aksiTambahKeterlambatan') }}" method="POST">
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

                            <!-- Bagian -->
                            <div class="form-group row">
                                <label for="bagian" class="col-sm-2 col-form-label">Bagian</label>
                                <div class="col-sm-10">
                                    <select id="bagian" name="bagian" class="form-control" required>
                                        <option value="" disabled selected>Pilih Bagian...</option>
                                        @foreach($bagian as $bagianItem)
                                            <option value="{{ $bagianItem->id_level }}">{{ $bagianItem->level }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Hari/Tanggal -->
                            <div class="form-group row">
                                <label for="hari_tanggal" class="col-sm-2 col-form-label">Hari/Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="hari_tanggal" name="hari_tanggal" required>
                                </div>
                            </div>

                            <!-- Jam Kedatangan -->
                            <div class="form-group row">
                                <label for="jam_kedatangan" class="col-sm-2 col-form-label">Jam Kedatangan</label>
                                <div class="col-sm-10">
                                    <input type="time" class="form-control" id="jam_kedatangan" name="jam_kedatangan" required>
                                </div>
                            </div>

                            <!-- Jumlah Waktu Keterlambatan -->
                            <div class="form-group row">
                                <label for="waktu_keterlambatan" class="col-sm-2 col-form-label">Jumlah Waktu Keterlambatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="waktu_keterlambatan" name="waktu_keterlambatan" readonly>
                                </div>
                            </div>

                            <!-- Alasan Keterlambatan -->
                            <div class="form-group row">
                                <label for="alasan" class="col-sm-2 col-form-label">Alasan Keterlambatan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="alasan" name="alasan" rows="3" required></textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Kirim Form</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // Fungsi untuk menghitung waktu keterlambatan
    document.getElementById('jam_kedatangan').addEventListener('change', function() {
        var jamKedatangan = this.value;
        var jamMulai = '07:00'; // Jam mulai 07:00 AM

        // Menghitung keterlambatan dalam menit
        var start = new Date('1970-01-01T' + jamMulai + ':00');
        var end = new Date('1970-01-01T' + jamKedatangan + ':00');
        var diff = (end - start) / 60000; // Mengubah milidetik ke menit

        // Jika terlambat, tampilkan jumlah keterlambatan
        if (diff > 0) {
            document.getElementById('waktu_keterlambatan').value = diff + ' menit';
        } else {
            document.getElementById('waktu_keterlambatan').value = 'Tepat waktu';
        }
    });
</script>
