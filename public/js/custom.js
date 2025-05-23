document.documentElement.classList.remove("no-js");
window.addEventListener("load", () => {
    const prefersReducedMotion = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    );

    if (!prefersReducedMotion.matches) {
        Promise.all([
            document.fonts.ready,
            new Promise((resolve) => setTimeout(resolve, 100)),
        ]).then(() => {
            requestAnimationFrame(() => {
                document.body.style.visibility = "visible";
                document.body.offsetHeight;
                document.body.classList.add("is-loaded");
            });
        });
    } else {
        document.body.style.visibility = "visible";
        document.body.style.opacity = "1";
    }
});

document.addEventListener("DOMContentLoaded", function () {
    flatpickr("#basic-datepicker", {
        dateFormat: "Y-m-d",
        locale: "id",
    });
});

document.addEventListener("DOMContentLoaded", function () {
    flatpickr("#date-range-picker", {
        mode: "range",
        dateFormat: "Y-m-d",
        locale: "id",
    });
});

document.addEventListener("DOMContentLoaded", function () {
    flatpickr("#datetime-datepicker", {
        dateFormat: "Y-m-d H:i",
        enableTime: true,
        time_24hr: true,
        locale: "id",
        onClose: function (selectedDates) {
            console.log("Selected range:", selectedDates);
        },
    });
});

const videoInput = document.querySelector("#rekaman-video");
if (videoInput) {
    const videoTagify = new Tagify(videoInput, {
        delimiters: ",",
        maxTags: 10,
        placeholder: "Masukkan Link Video",
        dropdown: {
            enabled: 0,
        },
    });

    videoTagify.on("change", function (e) {
        const values = e.detail.value.map((tag) => tag.value);
        videoInput.value = values.length ? values.join(",") : "";
    });
}

const audioInput = document.querySelector("#rekaman-audio");
if (audioInput) {
    const audioTagify = new Tagify(audioInput, {
        delimiters: ",",
        maxTags: 10,
        placeholder: "Masukkan Link Audio",
        dropdown: {
            enabled: 0,
        },
    });

    audioTagify.on("change", function (e) {
        const values = e.detail.value.map((tag) => tag.value);
        audioInput.value = values.length ? values.join(",") : "";
    });
}

const form = document.querySelector("form");
if (form) {
    form.addEventListener("submit", function (e) {
        try {
            const videoInput = document.querySelector("#rekaman-video");
            if (videoInput && window.videoTagify) {
                const videoLinks = videoTagify.value.map((tag) => tag.value);
                videoInput.value = videoLinks.length
                    ? videoLinks.join(",")
                    : "";
            }

            const audioInput = document.querySelector("#rekaman-audio");
            if (audioInput && window.audioTagify) {
                const audioLinks = audioTagify.value.map((tag) => tag.value);
                audioInput.value = audioLinks.length
                    ? audioLinks.join(",")
                    : "";
            }

            console.log("Form submitted with:", {
                video: videoInput ? videoInput.value : "no video input",
                audio: audioInput ? audioInput.value : "no audio input",
            });
        } catch (error) {
            console.error("Error preparing form data:", error);
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    // Inisialisasi Quill.js
    var quill = new Quill("#editor-container", {
        theme: "snow",
        modules: {
            toolbar: [
                ["bold", "italic", "underline"],
                [{ list: "ordered" }, { list: "bullet" }],
                [{ align: [] }],
                ["clean"],
            ],
        },
    });

    var hiddenInput = document.querySelector("#melaksanakan_tugas_st");

    hiddenInput.value = quill.root.innerHTML;

    quill.on("text-change", function () {
        hiddenInput.value = quill.root.innerHTML;
    });

    var form = document.querySelector("form");
    form.onsubmit = function () {
        hiddenInput.value = quill.root.innerHTML;
    };
});



// footer


$(document).ready(function () {
    // Trigger saat tab aktif
    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        const target = $(e.target).attr("href");

        if (target === '#navtabs2-profile') {
            setTimeout(function () {
                const $el = $('#kesimpulan_lap');

                if ($el.length === 0) {
                    // console.warn('#kesimpulan_lap tidak ditemukan');
                    return;
                }

                if ($el.hasClass('select2-hidden-accessible')) {
                    // console.log('Select2 sudah diinisialisasi, skip...');
                    return; // Hindari duplikat inisialisasi
                }

                // console.log('Inisialisasi select2...');
                $el.select2({
                    placeholder: 'Cari atau ketik kesimpulan...',
                    allowClear: true,
                    tags: true,
                    ajax: {
                        url: '/api/kesimpulan',
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            // console.log('Kirim ke server:', params.term);
                            return { term: params.term };
                        },
                        processResults: function (data) {
                            // console.log('Dari server:', data);
                            return { results: data };
                        },
                        cache: true
                    },
                    createTag: function (params) {
                        return {
                            id: params.term,
                            text: params.term,
                            newOption: true
                        };
                    },
                    insertTag: function (data, tag) {
                        data.push(tag);
                    }
                });

                // Paksa fokus ke input select2
                // setTimeout(function () {
                //     $el.select2('open');
                //     $('.select2-search__field').focus();
                // }, 500);
            }, 300); // Delay cukup supaya DOM siap
        }
    });
});










