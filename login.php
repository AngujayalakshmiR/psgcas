

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<link rel="icon" type="image/png" href="img/ktglogo.jpg">
<title>Healstro Login</title>
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
<!-- Change this -->
<!-- <form id="loginForm"> -->
<div id="loginForm">


  <div class="d-flex align-items-center my-4">
    <h2 class="text-center fw-bold mx-3 mb-0 sign-in-text" style="color: rgb(15,29,64);">Healstro Login</h2>
  </div>
  
  <div class="divider d-flex align-items-center my-4">
    <p class="text-center fw-bold mx-3 mb-0" style="color: rgb(15,29,64);">Login</p>
  </div>

  <!-- Error Message -->
  <p id="error-message" class="error-message"></p>

 <!-- Username Label and Input -->
<label for="username">Enter Username:</label> 
<div class="form-outline mb-4">
  <input type="text" name="username" id="username" class="form-control form-control-lg" placeholder="Enter valid username" autocomplete="username" />
</div>

<!-- Password Label and Input -->
<label for="password">Enter Password:</label>
<div class="form-outline mb-3">
  <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Enter valid password" autocomplete="current-password" />
</div>


  <div class="text-center text-lg-start mt-4 pt-2">
  <button id="loginBtn" class="btn btn-lg" style="background: rgb(15,29,64); color: white;">Login</button>

    <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!" class="link-danger">Contact Admin</a></p>
  </div>
</div>


        
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
<script>
document.getElementById("loginBtn").addEventListener("click", function () {
  let username = document.getElementById("username").value.trim();
  let password = document.getElementById("password").value.trim();
  let errorMessage = document.getElementById("error-message");

  console.log("Username:", username);
  console.log("Password:", password);

  const users = {
    "d": { password: "d", redirect: "doctordashboard.php" },
    "f": { password: "f", redirect: "dailyupdatefamily.php" },
    "n": { password: "n", redirect: "nursedashboard.php" },
    "r": { password: "r", redirect: "patientcreation.php" }
  };

  if (users[username] && users[username].password === password) {
    console.log("Redirecting to:", users[username].redirect);
    setTimeout(() => {
      window.location.href = users[username].redirect;
    }, 500); 
  } else {
    errorMessage.innerText = "Invalid username or password.";
    errorMessage.style.color = "red";
  }
});

</script>





</body>
</html>
