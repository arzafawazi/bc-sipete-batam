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

const textarea = document.querySelector("textarea.auto-expand");
textarea.addEventListener("input", function () {
    this.style.height = "auto";
    this.style.height = this.scrollHeight + "px";
});

// footer
document.addEventListener("DOMContentLoaded", function () {
    let footer = document.querySelector(".bawah-class");

    function checkScroll() {
        let scrollPosition = window.innerHeight + window.scrollY;
        let documentHeight = document.body.offsetHeight;

        if (scrollPosition >= documentHeight - 10) {
            footer.style.transform = "translateY(0)";
        } else {
            footer.style.transform = "translateY(100%)";
        }
    }

    window.addEventListener("scroll", checkScroll);
});

document.addEventListener("DOMContentLoaded", function () {
    let footer = document.querySelector(".bawah-class");
    let toggleButton = document.querySelector(".button-toggle-menu");
    let sidebar = document.querySelector(".app-sidebar-menu");

    if (!footer || !toggleButton || !sidebar) {
        console.error("Salah satu elemen tidak ditemukan!");
        return;
    }

    toggleButton.addEventListener("click", function () {
        sidebar.classList.toggle("sidebar-collapsed");

        if (sidebar.classList.contains("sidebar-collapsed")) {
            footer.style.width = "100%";
        } else {
            footer.style.width = "calc(110% - 0px)";
        }
    });
});
