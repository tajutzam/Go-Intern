<?php

use LearnPhpMvc\Config\Url;
?>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html"><b>Admin </b>MASTER GO INTERN</a>
    </div>
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-body login-card-body justify-content-center">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="<?= Url::BaseUrl()."/admin/login/post" ?>" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" name="username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="">
            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
          </div>
        </form>
        <a href="<?= Url::BaseUrl()."/admin/register"?>" class="link-primary">Belum punya akun ? klick disini</a>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>