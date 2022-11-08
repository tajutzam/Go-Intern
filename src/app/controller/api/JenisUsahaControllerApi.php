<?php

namespace LearnPhpMvc\controller\api;

use LearnPhpMvc\service\JenisUsahaService;

class JenisUsahaControllerApi
{

    private JenisUsahaService $service;

    /**
     * @param JenisUsahaService $service
     */
    public function __construct()
    {
        $this->service = new JenisUsahaService();
    }

    public function findAll() {
        $arr = $this->service->findAll();
        echo json_encode($arr);
    }

}