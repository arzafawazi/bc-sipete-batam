<!-- UPLOAD FORM UR -->
<div class="container mb-5">
    <div class="card shadow">
        <div class="card-body p-4">
            <h5 class="fw-bold text-center text-uppercase mb-4">UPLOAD FORM UR</h5>

            <!-- Upload Berita Acara Wawancara -->
            <div class="mb-3">
                <label for="berita_acara" class="form-label">1. Upload Berita Acara Wawancara UR</label>
                <input class="form-control" type="file" name="berita_acara[]" id="berita_acara" multiple>

                @if (isset($unsurpenyidikanur) &&
                        !empty(json_decode($unsurpenyidikanur->upload_ur_tersangka ?? '{}', true)['berita_acara'] ?? []))
                    <div class="mt-2">
                        <p class="fw-bold">File yang sudah diupload:</p>
                        <div class="row">
                            @foreach (json_decode($unsurpenyidikanur->upload_ur_tersangka, true)['berita_acara'] as $index => $file)
                                <div class="col-md-6 mb-2">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-file-earmark-pdf me-2 text-danger"></i>
                                        <a href="{{ asset('storage/' . $file['path']) }}" target="_blank">
                                            {{ $file['original_name'] }}
                                        </a>
                                        <a href="#" class="text-danger ms-2 delete-file" data-type="berita_acara"
                                            data-index="{{ $index }}" data-id="{{ $unsurpenyidikanur->id }}">
                                            <i data-feather="trash"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Upload Surat Permohonan -->
            <div class="mb-3">
                <label for="surat_permohonan" class="form-label">2. Upload Surat Permohonan UR</label>
                <input class="form-control" type="file" name="surat_permohonan[]" id="surat_permohonan" multiple>

                @if (isset($unsurpenyidikanur) &&
                        !empty(json_decode($unsurpenyidikanur->upload_ur_tersangka ?? '{}', true)['surat_permohonan'] ?? []))
                    <div class="mt-2">
                        <p class="fw-bold">File yang sudah diupload:</p>
                        <div class="row">
                            @foreach (json_decode($unsurpenyidikanur->upload_ur_tersangka, true)['surat_permohonan'] as $index => $file)
                                <div class="col-md-6 mb-2">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-file-earmark-pdf me-2 text-danger"></i>
                                        <a href="{{ asset('storage/' . $file['path']) }}" target="_blank">
                                            {{ $file['original_name'] }}
                                        </a>
                                        <a href="#" class="text-danger ms-2 delete-file"
                                            data-type="surat_permohonan" data-index="{{ $index }}"
                                            data-id="{{ $unsurpenyidikanur->id }}">
                                            <i data-feather="trash"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Upload Surat Pengakuan -->
            <div class="mb-3">
                <label for="surat_pengakuan" class="form-label">3. Surat Pernyataan Pengakuan Bersalah</label>
                <input class="form-control" type="file" name="surat_pengakuan[]" id="surat_pengakuan" multiple>

                @if (isset($unsurpenyidikanur) &&
                        !empty(json_decode($unsurpenyidikanur->upload_ur_tersangka ?? '{}', true)['surat_pengakuan'] ?? []))
                    <div class="mt-2">
                        <p class="fw-bold">File yang sudah diupload:</p>
                        <div class="row">
                            @foreach (json_decode($unsurpenyidikanur->upload_ur_tersangka, true)['surat_pengakuan'] as $index => $file)
                                <div class="col-md-6 mb-2">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-file-earmark-pdf me-2 text-danger"></i>
                                        <a href="{{ asset('storage/' . $file['path']) }}" target="_blank">
                                            {{ $file['original_name'] }}
                                        </a>
                                        <a href="#" class="text-danger ms-2 delete-file"
                                            data-type="surat_pengakuan" data-index="{{ $index }}"
                                            data-id="{{ $unsurpenyidikanur->id }}">
                                            <i data-feather="trash"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Upload Tanda Terima -->
            <div class="mb-3">
                <label for="tanda_terima" class="form-label">4. Upload Tanda Terima Penyetoran Dana</label>
                <input class="form-control" type="file" name="tanda_terima[]" id="tanda_terima" multiple>

                @if (isset($unsurpenyidikanur) &&
                        !empty(json_decode($unsurpenyidikanur->upload_ur_tersangka ?? '{}', true)['tanda_terima'] ?? []))
                    <div class="mt-2">
                        <p class="fw-bold">File yang sudah diupload:</p>
                        <div class="row">
                            @foreach (json_decode($unsurpenyidikanur->upload_ur_tersangka, true)['tanda_terima'] as $index => $file)
                                <div class="col-md-6 mb-2">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-file-earmark-pdf me-2 text-danger"></i>
                                        <a href="{{ asset('storage/' . $file['path']) }}" target="_blank">
                                            {{ $file['original_name'] }}
                                        </a>
                                        <a href="#" class="text-danger ms-2 delete-file" data-type="tanda_terima"
                                            data-index="{{ $index }}" data-id="{{ $unsurpenyidikanur->id }}">
                                            <i data-feather="trash"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Upload ND Permohonan -->
            <div class="mb-4">
                <label for="nd_permohonan" class="form-label">5. Upload ND Permohonan ke Bid. Penerimaan</label>
                <input class="form-control" type="file" name="nd_permohonan[]" id="nd_permohonan" multiple>

                @if (isset($unsurpenyidikanur) &&
                        !empty(json_decode($unsurpenyidikanur->upload_ur_tersangka ?? '{}', true)['nd_permohonan'] ?? []))
                    <div class="mt-2">
                        <p class="fw-bold">File yang sudah diupload:</p>
                        <div class="row">
                            @foreach (json_decode($unsurpenyidikanur->upload_ur_tersangka, true)['nd_permohonan'] as $index => $file)
                                <div class="col-md-6 mb-2">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-file-earmark-pdf me-2 text-danger"></i>
                                        <a href="{{ asset('storage/' . $file['path']) }}" target="_blank">
                                            {{ $file['original_name'] }}
                                        </a>
                                        <a href="#" class="text-danger ms-2 delete-file"
                                            data-type="nd_permohonan" data-index="{{ $index }}"
                                            data-id="{{ $unsurpenyidikanur->id }}">
                                            <i data-feather="trash"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-file').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                if (!confirm('Anda yakin ingin menghapus file ini?')) {
                    return;
                }

                const type = btn.dataset.type;
                const index = btn.dataset.index;
                const id = btn.dataset.id;

                fetch('/TindakLanjut/unsur-pidana-ur/delete-file/' + id, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            type: type,
                            index: index
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Hapus elemen dari DOM
                            const col = btn.closest('.col-md-6');
                            col.style.transition = 'opacity 0.3s';
                            col.style.opacity = 0;
                            setTimeout(() => col.remove(), 300);
                            alert('File berhasil dihapus');
                        } else {
                            alert('Gagal menghapus file');
                        }
                    })
                    .catch(() => {
                        alert('Terjadi kesalahan saat menghapus file');
                    });
            });
        });

        // Inisialisasi feather icons
        if (window.feather) {
            feather.replace();
        }
    });
</script>
