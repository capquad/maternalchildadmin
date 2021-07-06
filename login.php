<?php

require './init.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/vendor/Font-Awesome/css/all.min.css">
  <link rel="stylesheet" href="/assets/vendor/bootstrap/dist/css/bootstrap.min.css">
  <title>Maternal-Child Specialists' Clinics</title>

  <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body style="background-color: #ccc;">
  <header class="bg-white">
    <div class="container py-4">
      <h1>Admin</h1>
    </div>
  </header>
  <main class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-8 m-auto border border-3 rounded p-3">
          <h2>Login</h2>
          <form action="" method="post">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group mt-3">
              <label for="password">Password</label>
              <input type="text" name="password" id="password" class="form-control" placeholder="Password" aria-describedby="helpId" required>
              <!-- <small id="helpId" class="text-muted">Type Password here</small> -->
            </div>
            <div class="form-group mt-4">
              <button type="submit" class="btn btn-dark">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="copyright">
      <p>Maternal-Child Specialists' Clinics &copy;2021</p>
    </div>
  </main>
</body>

</html>