<?php 
include 'views/components/Header.php'
?>
  <div class="container">
    <?php
    if (isset($_GET['pesan'])) {
      if ($_GET['pesan'] == "gagal") {
        echo "<script>
        swal('Login Gagal', 'Pastikan username dan pasword benar!', 'error');
        </script>";
      } else if ($_GET['pesan'] == "logout") {
        echo "<script>
        swal('Anda berhasil logout', 'Silahkan Login Kembali', 'info');
        </script>";
      } else if ($_GET['pesan'] == "belum_login") {
        echo "<script>
        swal('Login Gagal', 'Pastikan anda sudah login', 'error');
        </script>";
      }
    }
    ?>
    <div class="login">
      <div class="login-logo">
        <img src="assets/images/logotext.png" alt="" />
        <img src="assets/images/elnusa.jpg" alt="" />
      </div>
      <div class="login-title">
        <!-- <h1>Welcome Back</h1>
          <p>pleas enter your details to sign in</p> -->
      </div>
      <form method="post" action="controlers/cek_login.php" class="login-form">
        <div class="login-input">
          <input type="text" name="username" id="username" placeholder="Username" required/>
          <i class="bx bx-envelope"></i>
        </div>
        <div class="login-input">
          <input type="password" name="password" id="password" placeholder="Password" required/>
          <i class="bx bx-lock"></i>
        </div>
        <button class="btn-login" type="submit">Login</button>
      </form>
    </div>
  </div>

  <?php 
  include 'views/components/footer.php'
  ?>