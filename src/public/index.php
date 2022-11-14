<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use LearnPhpMvc\APP\Router;

use LearnPhpMvc\controller\api\AuthentikasiController;
use LearnPhpMvc\controller\api\KategoriControllerApi;
use LearnPhpMvc\controller\api\PencariMagangControllerApi;
use LearnPhpMvc\controller\api\PenyediaMagangControllerApi;
use LearnPhpMvc\controller\api\SkillController;
use LearnPhpMvc\controller\CompanyController;
use LearnPhpMvc\controller\HomeController;
use LearnPhpMvc\controller\ProductController;
use LearnPhpMvc\controller\LamarController;
use LearnPhpMvc\controller\LoginController;
use LearnPhpMvc\controller\MagangController;
use LearnPhpMvc\controller\PenyediaMagangController;
use LearnPhpMvc\controller\RegisterController;
use LearnPhpMvc\Domain\Role;

//api
Router::add('GET', '/api/test', ProductController::class, 'categories');
Router::add('POST', '/api/add', ProductController::class, 'postCategories');
Router::add('GET', '/api/pencarimagang/all', PencariMagangControllerApi::class, 'findAll');
Router::add('POST', '/api/login', AuthentikasiController::class, 'login');
Router::add('POST', '/api/register', AuthentikasiController::class, 'register');
Router::add('GET', '/api/verivication/{id}', AuthentikasiController::class, 'sendEmail');
Router::add('POST', '/api/mobile/register', AuthentikasiController::class, 'registerMobile');
Router::add("GET" , "/api/aktifasi/{username}/{token}", AuthentikasiController::class , 'verivikasiAkun');
Router::add("POST" , "/api/findby/username" , PencariMagangControllerApi::class , "findByUsername");
Router::add("POST" , "/api/search/user" , PencariMagangControllerApi::class , "findByUsernameLike");
Router::add("GET" , "/api/skill/findAll" , SkillController::class , "findAll");
Router::add("POST" , "/api/pencarimagang/update/" , PencariMagangControllerApi::class , "updatePencariMagang");
Router::add("POST" , "/api/skill/add", SkillController::class , "addSkill");
Router::add("POST" , "/api/skill/update" , SkillController::class , "update");
Router::add("GET" , "/api/skill/findById/{id}", SkillController::class , "findById");
Router::add("GET" , "/api/pencarimagang/aktif/user" , PencariMagangControllerApi::class, "findByStatusAktif");
Router::add("DELETE" , "/api/skill/delete", SkillController::class , "deleteSkillById" );
Router::add("GET" , "/api/kategori/all" , KategoriControllerApi::class  , "findAll");


Router::add("GET" , "/api/aktifasi/penyedia/{username}/{token}", PenyediaMagangControllerApi::class , 'verivikasiAkun');
Router::add("POST" , "/api/penyedia/register/akun" , PenyediaMagangControllerApi::class , "regristasiAkun");
Router::add("GET" , "/api/penyediamagang/all" , PenyediaMagangControllerApi::class, "findAll");
Router::add('GET', '/api/penyedia/verivication/{id}', PenyediaMagangControllerApi::class, 'sendEmail');
Router::add("POST" , "/api/penyedia/login" , PenyediaMagangControllerApi::class , "login");


//w=web
Router::add('GET', '/', HomeController::class, 'index');
Router::add('GET', '/hello', HomeController::class, 'hello', [AuthMiddleware::class]);
Router::add('GET', '/world', HomeController::class, 'world', [AuthMiddleware::class]);
Router::add('GET', '/about', HomeController::class, 'about');

Router::add('POST', '/company/search', CompanyController::class, 'search');
Router::add('GET', '/company', CompanyController::class, 'index');
Router::add('GET', '/formlamar', LamarController::class, 'formLamar');

Router::add("GET", "/company/detail", CompanyController::class, "detailCompany");

Router::add("GET", "/magang", MagangController::class, "search_magang");
Router::add("GET" , "/magang/findall" , MagangController::class , "findAll");
Router::add("GET", "/magang/cari/nama", MagangController::class, "hasil_cari");
Router::add("GET", "/magang/detail", MagangController::class, "detailMagang");
Router::add("GET", "/login", LoginController::class, "formLogin");
Router::add("POST" , "/login/post" , LoginController::class , "postLogin");
// register controler 
Router::add("GET", "/register", RegisterController::class, "formRegister");
Router::add("POST" , "/register/post" , RegisterController::class , "postRegister");
Router::add("POST" , "/company/home/dashboard/tambah/magang/update" , PenyediaMagangController::class , "updateData");

// penyedia controller
Router::add("GET", "/company/home", PenyediaMagangController::class, "home");
Router::add("GET" , "/company/home/dashboard" , PenyediaMagangController::class , "dashboardPenyedia");
Router::add("GET" , "/company/home/dashboard/tambah/magang" , PenyediaMagangController::class , "formTambahData");
Router::add("POST" , "/company/home/dashboard/tambah/magang/save" , PenyediaMagangController::class , "tambahDataPost");
Router::run();
