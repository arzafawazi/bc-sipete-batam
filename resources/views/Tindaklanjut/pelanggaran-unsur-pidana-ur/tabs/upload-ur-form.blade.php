<div class="container mt-5 mb-5">
    <div class="card shadow">
        <div class="card-body p-4">
            <h5 class="fw-bold text-center text-uppercase mb-4">UPLOAD FORM UR</h5>

            <!-- Upload Berita Acara Wawancara -->
            <div class="mb-3">
                <label for="berita_acara" class="form-label">1. Upload Berita Acara Wawancara UR</label>
                <input class="form-control" type="file" name="berita_acara[]" id="berita_acara" multiple required>
            </div>

            <!-- Upload Tanda Terima Penyetoran Dana -->
            <div class="mb-3">
                <label for="tanda_terima" class="form-label">2. Upload Tanda Terima Penyetoran Dana</label>
                <input class="form-control" type="file" name="tanda_terima[]" id="tanda_terima" multiple required>
            </div>

            <!-- Upload ND Permohonan ke Bid. Penerimaan -->
            <div class="mb-4">
                <label for="nd_permohonan" class="form-label">3. Upload ND Permohonan ke Bid. Penerimaan</label>
                <input class="form-control" type="file" name="nd_permohonan[]" id="nd_permohonan" multiple required>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-upload me-1"></i> Upload
                </button>
            </div>

        </div>
    </div>
</div>
