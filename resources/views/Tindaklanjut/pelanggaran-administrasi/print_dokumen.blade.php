<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Dokumen</title>
  <script>
    window.onload = function() {
      var dokumenLinks = @json($dokumenLinks);

      if (dokumenLinks.length > 0) {
        dokumenLinks.forEach(link => {
          window.open(link, '_blank');
        });
      }

      window.close();
    };
  </script>
</head>

<body>
  <p>Dokumen sedang dibuka...</p>
</body>

</html>
