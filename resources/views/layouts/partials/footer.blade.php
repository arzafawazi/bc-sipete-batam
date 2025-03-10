<footer class="bawah-class">
  <div class="container-fluid">
    <div class="row">
      <div class="col fs-13 text-muted text-center">
        &copy;
        <script>
          document.write(new Date().getFullYear())
        </script> - <a href="https://merzha-digital.com/" target="_blank" class="text-primary fw-semibold">CV. Merzha Digital Solusindo</a>
        <span class="d-none"> | &copy; <span id="hidden-copyright" itemscope itemtype="https://schema.org/Person"><a href="https://www.linkedin.com/in/arzafawazi/" target="_blank" class="text-muted" itemprop="name">Arza Fawazi</a></span></span>
      </div>
    </div>
  </div>
</footer>



<script>
  document.addEventListener("DOMContentLoaded", function() {
    let footer = document.querySelector(".bawah-class");
    let toggleButton = document.querySelector(".button-toggle-menu");
    let sidebar = document.querySelector(".app-sidebar-menu");

    if (!footer || !toggleButton || !sidebar) {
      console.error("Salah satu elemen tidak ditemukan!");
      return;
    }

    toggleButton.addEventListener("click", function() {
      sidebar.classList.toggle("sidebar-collapsed");

      if (sidebar.classList.contains("sidebar-collapsed")) {
        footer.style.width = "100%";
      } else {
        footer.style.width = "calc(110% - 0px)";
      }
    });
  });
</script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
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
</script>
