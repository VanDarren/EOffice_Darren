<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="page-title">Surat Masuk</h2>
                <p class="text-muted">Formulir untuk mengelola data surat masuk.</p>
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <strong class="card-title">Form Surat Masuk</strong>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('aksiTambahSuratMasuk') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Nomor Surat -->
<div class="form-group row">
    <label for="nomor_surat" class="col-sm-2 col-form-label">Nomor Surat</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="{{ $nomor_surat }}" readonly>
    </div>
</div>


                            <!-- Lampiran -->
                            <div class="form-group row">
                                <label for="lampiran" class="col-sm-2 col-form-label">Lampiran</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="lampiran" name="lampiran" required>
                                        <label class="custom-file-label" for="lampiran">Pilih file</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Tanggal Terima -->
                            <div class="form-group row">
                                <label for="tanggal_terima" class="col-sm-2 col-form-label">Tanggal Terima</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="tanggal_terima" name="tanggal_terima" required>
                                </div>
                            </div>

                            <!-- Perihal -->
                            <div class="form-group row">
                                <label for="perihal" class="col-sm-2 col-form-label">Perihal</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="perihal" name="perihal" required>
                                </div>
                            </div>

                            <!-- Pengirim -->
                            <div class="form-group row">
                                <label for="pengirim" class="col-sm-2 col-form-label">Pengirim</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="pengirim" name="pengirim" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Tambah Surat Masuk</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // Mengubah label input file ketika file dipilih
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = document.getElementById("lampiran").files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>
