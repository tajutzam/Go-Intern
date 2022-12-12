<?php

use LearnPhpMvc\Config\Url;
?>

<footer class="text-center text-lg-start text-muted mt">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between  border-bottom"></section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
        <div class="container-fluid text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->
                    <img src=<?= Url::BaseUrl() . "/assets/logo.png" ?> alt="Logo Go Intern" style="width: 100px; height: 100px" />
                    <h6>Go Intern</h6>
                    <p>
                        Situs informasi lowongan magang yang menyediakan layanan yang
                        memudahkan pencari magang dan penyedia tempat magang agar
                        menemukan kandidat yang tepat.
                    </p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05)">
        © 2022 Copyright:
        <a class="text-reset fw-bold" href="https://mdbootstrap.com/">Built with love zam.dev </a>
    </div>
    <!-- Copyright -->
</footer>