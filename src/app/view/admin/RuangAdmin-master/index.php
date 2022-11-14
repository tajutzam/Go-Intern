<?php

?>
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
  </div>

  <div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Magang Yang sudah di iklankan</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= 10 ?></div>
              <div class="mt-2 mb-0 text-muted text-xs">
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-primary"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Magang Yang Sedang di tempati</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo 10 ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-shopping-cart fa-2x text-success"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- New User Card Example -->
    <!-- <div class="col-xl-3 col-md-6 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-uppercase mb-1"></div>
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">366</div>
                  <div class="mt-2 mb-0 text-muted text-xs">
                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                    <span>Since last month</span>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-users fa-2x text-info"></i>
                </div>
              </div>
            </div>
          </div>
        </div> -->
    <!-- Pending Requests Card Example
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                  <div class="mt-2 mb-0 text-muted text-xs">
                    <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                    <span>Since yesterday</span>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-comments fa-2x text-warning"></i>
                </div>
              </div>
            </div>
          </div>
        </div> -->

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Daftar Posisi yang paling banyak diminati </h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header"> Tampilkan Menurut</div>
              <a class="dropdown-item" href="#">Naik</a>
              <a class="dropdown-item" href="#">Turun</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <div class="table">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>Magang ID</th>
                    <th>Posisi Magang </th>
                    <th>Status</th>
                    <th>Jumlah SDM</th>
                    <th>Action</th>
                  </tr>
                  <tr>
                    <td>
                      <?=$model['magang'][0]['id']?>
                    </td>
                    <td>
                    <?=$model['magang'][0]['posisi_magang']?>
                    </td>
                    <td>
                    <?=$model['magang'][0]['status']?>
                    </td>
                    <td>
                    <?=$model['magang'][0]['penyedia']?>
                    </td>
                    <td>
                      <a href="" class="btn btn-warning">detail</a>
                    </td>
                  </tr>
                </thead>

              </table>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Lamaran Masuk</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle btn btn-primary btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Month <i class="fas fa-chevron-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Select Periode</div>
              <a class="dropdown-item" href="#">Today</a>
              <a class="dropdown-item" href="#">Week</a>
              <a class="dropdown-item active" href="#">Month</a>
              <a class="dropdown-item" href="#">This Year</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <div class="small text-gray-500">Oblong T-Shirt
              <div class="small float-right"><b>600 of 800 Items</b></div>
            </div>
            <div class="progress" style="height: 12px;">
              <div class="progress-bar bg-warning" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <div class="mb-3">
            <div class="small text-gray-500">Gundam 90'Editions
              <div class="small float-right"><b>500 of 800 Items</b></div>
            </div>
            <div class="progress" style="height: 12px;">
              <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <div class="mb-3">
            <div class="small text-gray-500">Rounded Hat
              <div class="small float-right"><b>455 of 800 Items</b></div>
            </div>
            <div class="progress" style="height: 12px;">
              <div class="progress-bar bg-danger" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <div class="mb-3">
            <div class="small text-gray-500">Indomie Goreng
              <div class="small float-right"><b>400 of 800 Items</b></div>
            </div>
            <div class="progress" style="height: 12px;">
              <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <div class="mb-3">
            <div class="small text-gray-500">Remote Control Car Racing
              <div class="small float-right"><b>200 of 800 Items</b></div>
            </div>
            <div class="progress" style="height: 12px;">
              <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
        <div class="card-footer text-center">
          <a class="m-0 small text-primary card-link" href="#">View More <i class="fas fa-chevron-right"></i></a>
        </div>
      </div>
  
    <!-- Message From Customer-->
    <!-- <div class="col-xl-4 col-lg-5 ">
      <div class="card">
        <div class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-light">Message From Customer</h6>
        </div>
        <div>
          <div class="customer-message align-items-center">
            <a class="font-weight-bold" href="#">
              <div class="text-truncate message-title">Hi there! I am wondering if you can help me with a
                problem I've been having.</div>
              <div class="small text-gray-500 message-time font-weight-bold">Udin Cilok · 58m</div>
            </a>
          </div>
          <div class="customer-message align-items-center">
            <a href="#">
              <div class="text-truncate message-title">But I must explain to you how all this mistaken idea
              </div>
              <div class="small text-gray-500 message-time">Nana Haminah · 58m</div>
            </a>
          </div>
          <div class="customer-message align-items-center">
            <a class="font-weight-bold" href="#">
              <div class="text-truncate message-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit
              </div>
              <div class="small text-gray-500 message-time font-weight-bold">Jajang Cincau · 25m</div>
            </a>
          </div>
          <div class="customer-message align-items-center">
            <a class="font-weight-bold" href="#">
              <div class="text-truncate message-title">At vero eos et accusamus et iusto odio dignissimos
                ducimus qui blanditiis
              </div>
              <div class="small text-gray-500 message-time font-weight-bold">Udin Wayang · 54m</div>
            </a>
          </div>
          <div class="card-footer text-center">
            <a class="m-0 small text-primary card-link" href="#">View More <i class="fas fa-chevron-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div> -->
  <!--Row-->
<!-- 
  <div class="row">
    <div class="col-lg-12 text-center">
      <p>Do you like this template ? you can download from <a href="https://github.com/indrijunanda/RuangAdmin" class="btn btn-primary btn-sm" target="_blank"><i class="fab fa-fw fa-github"></i>&nbsp;GitHub</a></p>
    </div>
  </div> -->
</div>
<!---Container Fluid-->
</div>