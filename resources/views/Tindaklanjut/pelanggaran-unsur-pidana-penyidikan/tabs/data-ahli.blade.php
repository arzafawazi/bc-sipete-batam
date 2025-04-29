<div class="container-fluid mt-4">
    <!-- Header with Logo -->
    <div class="row mb-4 align-items-center text-black">
        <div class="col-md-2 col-sm-12 text-center mb-3 mb-md-0">
            <img src="/images/logocop.png" alt="Logo" class="img-fluid" style="max-height:170px;">
        </div>
        <div class="col-md-10 col-sm-12 text-center">
            <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</h5>
            <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI</p>
            <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI TIPE B BATAM</p>
            <p class="small mb-0">
                JALAN KUDA LAUT, BATU AMPAR, BATAM, KEPULAUAN RIAU 29432;
                TELEPON (0778) 458118, 458263; FAKSIMILE (0778) 458149;
            </p>
            <p class="small mb-0">
                LAMAN WWW.BCBATAM.BEACUKAI.GO.ID;
                PUSAT KONTAK LAYANAN 1500225;
                SUREL BCBPBATAM@CUSTOMS.GO.ID,
                KPBC.BATAM@KEMENKEU.GO.ID
            </p>
        </div>
    </div>

    <hr class="border border-dark border-2 bg-dark">

    <h5 class="fw-bold text-black">"PRO JUSTITIA"</h5>


    <!-- Main Form -->
    <div class="card p-1">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="container-fluid px-0 px-sm-3">


                        <div class="mb-3 row">
                            <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">Insert Data
                                Ahli</label>
                            <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                            <div class="col-md-8 col-sm-11">

                                <div id="form-ahli">
                                    <h5 class="fw-bold text-primary">Kumpulan Data Ahli</h5>
                                    <div id="dynamic-form-ahli">
                                        <div class="entry-ahli text-black">
                                            <hr>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Nama Lengkap</div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7"><input type="text" class="form-control py-1"
                                                        name="ahli_nama[]"></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Tempat /Tanggal Lahir
                                                </div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7"><input type="text" class="form-control py-1"
                                                        name="ahli_ttl[]"></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Jenis Kelamin</div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7">
                                                    <select class="form-select py-1 select2" name="ahli_kelamin[]">
                                                        <option value="" selected disabled>Pilih</option>
                                                        <option value="Laki-laki">Laki-laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Agama</div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7"><input type="text" class="form-control py-1"
                                                        name="ahli_agama[]"></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Pekerjaan</div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7"><input type="text" class="form-control py-1"
                                                        name="ahli_pekerjaan[]"></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Alamat Domisili</div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7"><input type="text" class="form-control py-1"
                                                        name="ahli_alamat_domisili[]"></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Alamat Kantor</div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7"><input type="text" class="form-control py-1"
                                                        name="ahli_alamat_kantor[]"></div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-2">
                                        <button type="button" class="btn btn-primary me-2" id="add-ahli"><i
                                                data-feather="plus"></i></button>
                                        <button type="button" class="btn btn-danger" id="remove-ahli"
                                            style="display: none;"><i data-feather="trash-2"></i></button>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function() {
    initializeSelect2();
    
    initializeFormDataAhli();

    document.getElementById("add-ahli").addEventListener("click", function() {
        addEntryAhli("ahli");
    });

    document.getElementById("remove-ahli").addEventListener("click", function() {
        removeEntryAhli("ahli");
    });

    updateRemoveButtonVisibilityAhli("ahli");
    feather.replace();
});

let data_ahli = <?php echo json_encode($ahliData, JSON_PRETTY_PRINT); ?>; 

function initializeFormDataAhli() {
    if (typeof data_ahli !== "undefined" && data_ahli.length > 0) {
        let container = document.getElementById("dynamic-form-ahli");
        container.innerHTML = ""; 

        data_ahli.forEach((ahli, index) => {
            let newEntry = generateAhliEntryHTML(ahli, index === 0, index);
            container.appendChild(newEntry);
        });

        updateRemoveButtonVisibilityAhli("ahli");
        initializeSelect2();
    }
}


function generateAhliEntryHTML(ahli = {}, isFirst = false, index = 0) {
    let entryDiv = document.createElement('div');
    entryDiv.className = 'entry-ahli text-black';

    entryDiv.innerHTML = `
        <hr>
        <div class="row mb-3">
            <div class="col-md-4 d-flex align-items-center">Nama Lengkap</div>
            <div class="col-md-1 text-center">:</div>
            <div class="col-md-7"><input type="text" class="form-control py-1" name="ahli_nama[]" value="${ahli.nama || ''}"></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 d-flex align-items-center">Tempat /Tanggal Lahir</div>
            <div class="col-md-1 text-center">:</div>
            <div class="col-md-7"><input type="text" class="form-control py-1" name="ahli_ttl[]" value="${ahli.ttl || ''}"></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 d-flex align-items-center">Jenis Kelamin</div>
            <div class="col-md-1 text-center">:</div>
            <div class="col-md-7">
                <select class="form-select py-1 select2" name="ahli_kelamin[]">
                    <option value="" disabled>Pilih</option>
                    <option value="Laki-laki" ${(ahli.jenis_kelamin === "Laki-laki") ? "selected" : ""}>Laki-laki</option>
                    <option value="Perempuan" ${(ahli.jenis_kelamin === "Perempuan") ? "selected" : ""}>Perempuan</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 d-flex align-items-center">Agama</div>
            <div class="col-md-1 text-center">:</div>
            <div class="col-md-7"><input type="text" class="form-control py-1" name="ahli_agama[]" value="${ahli.agama || ''}"></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 d-flex align-items-center">Pekerjaan</div>
            <div class="col-md-1 text-center">:</div>
            <div class="col-md-7"><input type="text" class="form-control py-1" name="ahli_pekerjaan[]" value="${ahli.pekerjaan || ''}"></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 d-flex align-items-center">Alamat Domisili</div>
            <div class="col-md-1 text-center">:</div>
            <div class="col-md-7"><input type="text" class="form-control py-1" name="ahli_alamat_domisili[]" value="${ahli.alamat_domisili || ''}"></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 d-flex align-items-center">Alamat Kantor</div>
            <div class="col-md-1 text-center">:</div>
            <div class="col-md-7"><input type="text" class="form-control py-1" name="ahli_alamat_kantor[]" value="${ahli.alamat_kantor || ''}"></div>
        </div>
        <button type="button" class="btn btn-danger remove-btn my-2" style="display:none;">
            <i data-feather="trash-2"></i> Hapus
        </button>
        <hr>
    `;

    let removeBtn = entryDiv.querySelector('.remove-btn');
    if (removeBtn) {
        removeBtn.addEventListener('click', function() {
            entryDiv.remove();
            updateRemoveButtonVisibilityAhli("ahli");
        });
    }

    return entryDiv;
}

function addEntryAhli(formType) {
    let formContainer = document.getElementById(`dynamic-form-${formType}`);
    let currentEntries = formContainer.querySelectorAll(`.entry-${formType}`);
    let newIndex = currentEntries.length;
    
    let newEntry;
    if (formType === "ahli") {
        newEntry = generateAhliEntryHTML({}, false, newIndex);
    } 
    
    if (newEntry) {
        $(formContainer).find('.select2-hidden-accessible').select2('destroy');
        
        formContainer.appendChild(newEntry);
        
        let removeBtn = newEntry.querySelector('.remove-btn');
        if (removeBtn) {
            removeBtn.addEventListener('click', function() {
                newEntry.remove();
                updateRemoveButtonVisibilityAhli(formType);
                initializeSelect2ForContainer(formContainer);
            });
        }
        
        initializeSelect2ForContainer(formContainer);
        
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
        
        updateRemoveButtonVisibilityAhli(formType);
    }
}

function removeEntryAhli(formType) {
    let entries = document.querySelectorAll(`#dynamic-form-${formType} .entry-${formType}`);
    if (entries.length > 1) {
        let lastEntry = entries[entries.length - 1];

        $(lastEntry).find(".select2-hidden-accessible").each(function() {
            $(this).select2("destroy");
        });

        lastEntry.remove();
        updateRemoveButtonVisibilityAhli(formType);
    }
}

function updateRemoveButtonVisibilityAhli(formType) {
    let entries = document.querySelectorAll(`#dynamic-form-${formType} .entry-${formType}`);
    let removeButton = document.getElementById(`remove-${formType}`);

    if (removeButton) {
        removeButton.style.display = entries.length > 1 ? "block" : "none";
    }

    if (entries.length > 0) {
        entries[0].querySelector(".remove-btn").style.display = "none";
    }
    
    for (let i = 1; i < entries.length; i++) {
        let btn = entries[i].querySelector(".remove-btn");
        if (btn) btn.style.display = "block";
    }
}

function initializeSelect2ForContainer(container) {
    $(container).find('.select2:not(.select2-hidden-accessible)').each(function() {
        $(this).select2();
    });
}
</script>