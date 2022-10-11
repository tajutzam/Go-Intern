<div class="jumbotron-v2">

</div>

<div class="row justify-content-between mt-2">
    <aside class="col col-12">
        <div class="box">
            <div class="card js-sidebar" style="width: 40rem">
                <div class="card-body text-center" style="padding: 20px">
                    <h5 class="card-title text-start">
                        Cari penyedia magang
                    </h5>
                    <form action="" method="post" class="form">
                        <div class="input-group mb-3">
                            <div class="divider"></div>
                            <input type="text" class="form-control" placeholder="Cari penyedia . . ." aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text bg-white" id="basic-addon2"><i data-feather="search"></i></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </aside>
</div>
<div class="container-fluid" style="margin-top: 150px">
    <h3 class="text-center mb-5">Hasil Pencarian </h3>
    <?php for ($i = 0; $i <= 20; $i++) { ?>
        <div class="row d-flex">
            <div class="col col-4 mb-3 d-flex justify-content-around">
                <div class="card" style="width: 17rem;">
                    <img src="http://localhost:8080/assets/logo.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Detail Magang
                        </button>
                    </div>
                </div>
            </div>
            <div class="col col-4 mb-3 d-flex justify-content-around">
                <div class="card" style="width: 17rem;">
                    <img src="http://localhost:8080/assets/logo.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Detail Magang
                        </button>
                    </div>
                </div>
            </div>
            <div class="col col-4 mb-3 d-flex justify-content-around">
                <div class="card" style="width: 17rem;">
                    <img src="http://localhost:8080/assets/logo.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Detail Magang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<div class="mt-5"></div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Magang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="" method="post">
                        <h3 style="font-weight: 700 ;">Detail Magang</h3> <br>
                        <label for="">
                            Nama Pekerjaan
                        </label>
                        <br>
                        <div class="form-floating mb-3">
                            <input type="email" readonly class="form-control-plaintext" id="floatingEmptyPlaintextInput" placeholder="name@example.com">
                            <label for="floatingEmptyPlaintextInput">Backend Developer</label>
                        </div>
                        <label for="">
                            Kisaran gaji
                        </label>
                        <br>
                        <div class="form-floating mb-3">
                            <input type="email" readonly class="form-control-plaintext" id="floatingEmptyPlaintextInput" placeholder="name@example.com">
                            <label for="floatingEmptyPlaintextInput">Rp. 5.00.000 - Rp. 1-000.000</label>
                        </div>
                        <label for="">
                            Deskripsi Pekerjaan
                        </label>
                        <br>
                        <div class="form-floating mb-3">
                            <input type="email" readonly class="form-control-plaintext" id="floatingEmptyPlaintextInput" placeholder="name@example.com">
                            <label for="floatingEmptyPlaintextInput">
                                <?php for ($i = 0; $i < 5; $i++) { ?>
                                    - membantu senior <br>
                                <?php } ?>
                            </label>
                        </div>
                        <label for="">
                            Deskripsi Pekerjaan
                        </label>
                        <br>
                        <div class="form-floating mb-3">
                            <input type="email" readonly class="form-control-plaintext" id="floatingEmptyPlaintextInput" placeholder="name@example.com">
                            <label for="floatingEmptyPlaintextInput">Empty input</label>
                        </div>

                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Apply Now</button>
            </div>
        </div>
    </div>
</div>