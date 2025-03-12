<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<link rel="icon" type="image/png" href="img/ktglogo.jpg">
<title>KTG TaskFlow</title>
<link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
<link rel="stylesheet" href="package/css/mdb.min.css" />
<style>
:root, [data-mdb-theme=light] {
    --mdb-input-focus-border-color: rgb(15,29,64);
    --mdb-input-focus-label-color: rgb(15,29,64);
    --mdb-picker-header-bg: rgb(15,29,64);
}
.divider:after, .divider:before {
    content: "";
    flex: 1;
    height: 1px;
    background: #eee;
}
.h-custom { height: calc(100% - 73px); }
@media (max-width: 450px) { .h-custom { height: 100%; } }
.sign-in-text {
    font-size: 2.5rem;
    font-weight: bold;
    font-family: var(--mdb-font-sans-serif);
    text-align: center;
    width: 100%;
}
.bg-primary {
    color: rgb(15,29,64);
    background: rgb(15,29,64);
}
.error-message {
    color: red;
    text-align: center;
    font-weight: bold;
}

.form-outline{
    border: 2px solid rgb(15,29,64);
    border-radius: 15px;
}
</style>
</head>
<body>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="img/Login.jpg" class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form action="validate.php" method="POST">
          <div class="d-flex align-items-center my-4">
            <h2 class="text-center fw-bold mx-3 mb-0 sign-in-text" style="color: rgb(15,29,64);">KTG TaskFlow</h2>
          </div>
          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0" style="color: rgb(15,29,64);">Login</p>
           
          </div>
          <?php
if (isset($_SESSION['login_error'])) {
    echo "<p style='color: red;text-align:center;'>" . $_SESSION['login_error'] . "</p>";
    unset($_SESSION['login_error']); // Clear error after displaying
}
?>
          <?php if (isset($error)) { echo "<p class='error-message'>$error</p>"; } ?>
         <!-- Username input -->
         <label>Enter Username:</label> 
<div class="form-outline mb-4">
    
  <input type="text" name="username" id="form3Example3" class="form-control form-control-lg"
    placeholder="Enter valid username" autocomplete="username" />
</div>
<label>Enter Password:</label>
<!-- Password input -->
<div class="form-outline mb-3">
  <input type="password" id="form3Example4" name="password" class="form-control form-control-lg"
    placeholder="Enter valid password" autocomplete="current-password" />
</div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;background: rgb(15,29,64);color:white;">Login</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!" class="link-danger">Contact Admin</a></p>
          </div>
        </form>

        
      </div>
    </div>
  </div>
  <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5" style="background: rgb(15,29,64);">
    <div class="text-white mb-3 mb-md-0">Copyright © 2025. All rights reserved.</div>
    <div>
      <a href="#!" class="text-white me-4"><i class="fab fa-facebook-f"></i></a>
      <a href="#!" class="text-white me-4"><i class="fab fa-twitter"></i></a>
      <a href="#!" class="text-white me-4"><i class="fab fa-google"></i></a>
      <a href="#!" class="text-white"><i class="fab fa-linkedin-in"></i></a>
    </div>
  </div>
</section>
<script type="text/javascript" src="package/js/mdb.umd.min.js"></script>
</body>
</html>
