<?php

define('WASAP', true);

require 'init.php';

// cek jika tombol buat link di tekan
if (isset($_POST['tombol'])) {
  $number  = isset($_POST['number']) ? $_POST['number'] : null;
  $message = isset($_POST['message']) ? $_POST['message'] : null;

  if (strpos($number, '+') > -1) {
      $number = substr($number, 1);
  }

  $link = "https://api.whatsapp.com/send?phone=$number&text=".rawurlencode($message);
  $tinyurl = urlencode($link);

  $shortlink = tinyurl($tinyurl);

  QRcode::png($link, 'img/qrcode.png', 'L', 4, 2);

  // var_dump($shortlink);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <?php require 'head.php'; ?>
  <style type="text/css">
    .CodeMirror, .CodeMirror-scroll {
      min-height: 150px;
    }
  </style>

</head>

<body id="page-top">

  <!-- Navigation -->
  <?php require 'nav.php'; ?>

  <!-- Header -->
  <header class="bg-primary py-5 mb-5 text-center">
    <div class="container h-100">
      <div class="row h-100 align-items-center">
        <div class="col-lg-12">
          <h1 class="display-4 text-white mt-5 mb-2">WhatsApp Link Generator</h1>
          <p class="lead mb-5 text-white-50">Tools sederhana untuk membuat tautan link WhatsApp dengan mudah.</p>
        </div>
      </div>
    </div>
  </header>

  <!-- Page Content -->
  <div class="container">

    <div class="row">
      <div class="col-md-6 mb-5">
        <h2>Whatsapp Generator</h2>
        <hr>
        <p>Buat link instan ke chat WhatsApp anda. Link instan akan mempercepat interaksi dan publikasi anda. Dengan sekali pencet link, maka aplikasi WhatsApp akan terbuka dan siap mengirim pesan.</p>
        <form action="" method="post">
            <div class="form-group">
              <label for="number">Nomor Whatsapp</label>
              <input type="text" class="form-control" name="number" id="number" placeholder="6285740974765" required>
            </div>
            <div class="form-group">
              <label for="message">Pesan</label>
              <textarea class="form-control" name="message" id="message" rows="6"></textarea>
              <span>
                Kode yang bisa digunakan :
                <li>*tebal* : <b>Tebal</b></li>
                <li>_miring_ : <i>Miring</i></li>
                <li>~coret~ : <strike>Coret</strike></li>
                <li>```monospace``` : <code>Monospace</code></li>
              </span>
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit" name="tombol">Buat Link !</button>
            </div>
          </form>
      </div>
      <!-- end div.col-md-6 -->

      <div class="col-md-6 mb-5">
        <?php if (isset($_POST['tombol'])) { ?>
          <h2>Generate Link Berhasil !</h2>
          <p>Silahkan copy paste link whatsapp dibawah ini</p>

          <label for="basic-url">Link Whatsapp</label>
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="linkwa" value="<?php echo $link; ?>">
            <div class="input-group-append">
              <button class="btn btn-primary" onclick="copyLinkwa()">Copy!</button>
            </div>
          </div>

          <label for="basic-url">Link TinyUrl</label>
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="shortlink" value="<?php echo $shortlink; ?>">
            <div class="input-group-append">
              <button class="btn btn-primary" onclick="copyShortlink()">Copy!</button>
            </div>
          </div>

          <p><a class="btn btn-success" target="_blank" href="<?php echo $link; ?>"> Test Kirim WA</a></p>
          <p>Atau bisa Scan QR Code dibawah ini</p>
          <div class="input-group mb-3">
            <div class="card"><img class="img-fluid" src="img/qrcode.png"></div>
          </div>
          <p>
            <ol>
              <li>Copy paste linknya</li>
              <li>Pasang di sosial media atau olshop.</li>
              <li>Orang lain klik link dan langsung masuk aplikasi WhatsApp.</li>
            </ol>
          </p>
        <?php } else { ?>
          <h2>Contoh Hasil Linknya</h2>
          <hr>
          <img src="img/link-wa.png" class="img-fluid">
          <ol>
            <li>Masukkan nomor whatsapp dan pesan.</li>
            <li>Klik buat link dan dapatkan linknya.</li>
            <li>Pasang di sosial media atau olshop.</li>
            <li>Orang lain klik link dan langsung masuk aplikasi WhatsApp.</li>
          </ol>
        <?php } ?>
      </div>
      <!-- end div.col-md-6 -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- jika tambah fitur -->
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <?php require 'footer.php'; ?>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="js/scrolling-nav.js"></script>

  <!-- JavaScript text editor markdown -->
  <script>
    var simplemde = new SimpleMDE({
      toolbar: [
        {
          name: "bold",
          action: SimpleMDE.toggleBold,
          className: "fa fa-bold",
          title: "bold",
        },
        {
          name: "italic",
          action: SimpleMDE.toggleItalic,
          className: "fa fa-italic",
          title: "italic",
        },
        {
          name: "code",
          action: SimpleMDE.toggleCodeBlock,
          className: "fa fa-code",
          title: "code",
        }
      ],
      blockStyles: {
        bold: "*",
        italic: "_",
        code: "```"
      },
      hideIcons: ["guide", "heading", "quote", "link", "image", "unordered-list", "ordered-list", "preview", "fullscreen", "side-by-side"],
      element: document.getElementById("message"),
    });
  </script>

  <script>
    function copyLinkwa() {
      /* Get the text field */
      var copyText = document.getElementById("linkwa");

      /* Select the text field */
      copyText.select();
      copyText.setSelectionRange(0, 99999); /*For mobile devices*/

      /* Copy the text inside the text field */
      document.execCommand("copy");

      /* Alert the copied text */
      Swal.fire({
        position: 'center',
        type: 'success',
        title: 'Link whatsapp berhasil di copy!',
        showConfirmButton: false,
        timer: 1500
      });
    } 
  </script>
  <script>
    function copyShortlink() {
      var copyText = document.getElementById("shortlink");
      copyText.select();
      copyText.setSelectionRange(0, 99999);
      document.execCommand("copy");
      Swal.fire({
        position: 'center',
        type: 'success',
        title: 'Link TinyUrl berhasil di copy!',
        showConfirmButton: false,
        timer: 1500
      });
    } 
  </script>

</body>

</html>
