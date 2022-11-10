<!-- start footer -->
<?php
require_once __DIR__ . "/../../../../vendor/autoload.php";

use LearnPhpMvc\config\Url;
use LearnPhpMvc\Session\MySession;

?>

<footer class="text-center text-lg-start text-muted mt" style="">
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
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">Go Intern</h6>
                    <a href=<?= Url::BaseUrl() . "" ?>>
                        <p>Halaman Depan</p>
                    </a>
                    <a href=<?= Url::BaseUrl() . "/magang" ?>>
                        <p>List Magang</p>
                    </a>
                    <a href=<?= Url::BaseUrl() . "/company" ?>>
                        <p>List Perusahaan</p>
                    </a>
                    <a href=<?= Url::BaseUrl() . "" ?>>
                        <p>Tentang kami</p>
                    </a>
                    <a href=<?= Url::BaseUrl() . "/login" ?>>
                        <p>Login</p>
                    </a>
                    <a href=<?= Url::BaseUrl() . "/register" ?>>
                        <p>Register</p>
                    </a>
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
<!-- Footer -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<!-- modal script -->
<script>
    const myModal = new bootstrap.Modal(document.getElementById('myModal'), options)
</script>
<!-- end modal script -->
<script>
    feather.replace()
</script>

<script>
    // var e = document.getElementById("id_select");
    // var value = e.value;
    // const margin_top_value = document.getElementById('id1');

    // function onChange() {
    //     console.log(margin_top_value);

    //     value = e.value;
    //     const a = document.getElementById('form-pencari');
    //     const b = document.getElementById('form-penyedia');
    //     if (value == "0") {
    //         a.hidden = true;
    //         b.hidden = true;
    //         margin_top_value.style.marginTop = "500px";
    //     }
    //     if (value == "1") {
    //         a.hidden = false;
    //         b.hidden = true;
    //         margin_top_value.style.marginTop = "800px";
    //     } else if (value == "2") {
    //         a.hidden = true;
    //         b.hidden = false;
    //         margin_top_value.style.marginTop = "650px";
    //     }
    // }
    // e.onchange = onChange;
    // onChange();
    // pencari magang 
    // penyedia magang
</script>
<script>
    const register = document.getElementById('register');
    const login = document.getElementById('login');
    const logout = document.getElementById('btn-logout');
    const img_profile = document.getElementById('profile-img')
    if (<?php echo  MySession::getCurrentSession()['status'] == true?>) {
        console.log("ok");
        login.hidden = true;
        register.hidden = true;
        logout.hidden = false;
        img_profile.hidden = false;
    }
    $(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});
</script>


</body>

</html>