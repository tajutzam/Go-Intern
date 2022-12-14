<?php
require_once __DIR__ . '/../../../../vendor/autoload.php';

use LearnPhpMvc\Config\Url;
use LearnPhpMvc\Session\MySession;

?>
<!-- Url::BaseUrl()."/assets/logo.png -->
<!-- config for base url -->
<body>
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href=<?= Url::BaseUrl() ?>>
        <img src=<?= Url::BaseUrl() . "/assets/logo.png" ?> alt="logo" style="height:80px;">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="margin-right:30px ;">
          <li class="nav-item mb-2" hidden>
            <a href=<?= Url::BaseUrl() . "/magang" ?> style="margin-right:30px ; font-size: 20px">
              Magang
            </a>
          </li>
          <li hidden class="nav-item mb-2">
            <a href=<?= Url::BaseUrl() . "/company" ?> style="margin-right:30px; font-size: 20px;">
              Penyedia Magang
            </a>
          </li>
          <li class="nav-item mb-2">
            <a href=<?= Url::BaseUrl() . "#tentang-kami" ?> style="margin-right:30px ; font-size: 20px">
              Tentang Kami
            </a>
          </li>
          <li class="nav-item mb-2" id="login">
            <a href=<?= Url::BaseUrl() . "/login"; ?> style="margin-right:15px ; font-size: 20px">
              Login
            </a>
          </li>
        </ul>
        <a id="register" href=<?= Url::BaseUrl() . "/register" ?> style="margin-right:30px ; font-size: 20px">
          <button class="btn register" type="submit"><span>Register</span></button>
        </a>
        <a hidden href="" id="btn-logout">
          <div class="btn btn-primary">Logout</div>
        </a>
      </div>
    </div>
  </nav>
