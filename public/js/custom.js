window.addEventListener("load", function () {
    document.body.style.opacity = "1";
});

document.addEventListener("DOMContentLoaded", function () {
    flatpickr("#date-range-picker", {
        mode: "range",
        dateFormat: "Y-m-d",
    });
});


// Inisialisasi Tagify untuk input video
const videoInput = document.querySelector("#rekaman-video");
if (videoInput) {
    const videoTagify = new Tagify(videoInput, {
        delimiters: ",", 
        maxTags: 10,
        placeholder: "Masukkan Link Video",
        dropdown: {
            enabled: 0
        }
    });

    // Event listener untuk perubahan video tags
    videoTagify.on('change', function(e) {
        // Ambil hanya nilai 'value' dari setiap tag
        const values = e.detail.value.map(tag => tag.value);  // Ambil URL saja
        videoInput.value = values.length ? values.join(',') : '';  // Gabungkan sebagai string
    });
}

// Inisialisasi Tagify untuk input audio
const audioInput = document.querySelector("#rekaman-audio");
if (audioInput) {
    const audioTagify = new Tagify(audioInput, {
        delimiters: ",",
        maxTags: 10,
        placeholder: "Masukkan Link Audio",
        dropdown: {
            enabled: 0
        }
    });

    // Event listener untuk perubahan audio tags
    audioTagify.on('change', function(e) {
        // Ambil hanya nilai 'value' dari setiap tag
        const values = e.detail.value.map(tag => tag.value);  // Ambil URL saja
        audioInput.value = values.length ? values.join(',') : '';  // Gabungkan sebagai string
    });
}

// Handle form submission
const form = document.querySelector("form");
if (form) {
    form.addEventListener('submit', function(e) {
        try {
            // Persiapkan data video jika ada
            const videoInput = document.querySelector("#rekaman-video");
            if (videoInput && window.videoTagify) {
                // Ambil nilai 'value' dari tag video
                const videoLinks = videoTagify.value.map(tag => tag.value);  
                videoInput.value = videoLinks.length ? videoLinks.join(',') : '';  // Gabungkan sebagai string
            }
            
            // Persiapkan data audio jika ada
            const audioInput = document.querySelector("#rekaman-audio");
            if (audioInput && window.audioTagify) {
                // Ambil nilai 'value' dari tag audio
                const audioLinks = audioTagify.value.map(tag => tag.value);  
                audioInput.value = audioLinks.length ? audioLinks.join(',') : '';  // Gabungkan sebagai string
            }
            
            // Log untuk debugging
            console.log('Form submitted with:', {
                video: videoInput ? videoInput.value : 'no video input',
                audio: audioInput ? audioInput.value : 'no audio input'
            });
            
        } catch (error) {
            console.error('Error preparing form data:', error);
        }
    });
}

