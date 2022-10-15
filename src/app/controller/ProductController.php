<?php
    namespace LearnPhpMvc\controller;
    class ProductController{  
        function categories(){
           $model = [
                'id' => 1 , 
                'nama' => "biskuit"
           ];

           echo json_encode($model);
        }
        function postCategories(){
            $method = $_SERVER["REQUEST_METHOD"];
            $result = array();

            if($method == "POST"){
                if(isset($_POST['name'])){
                    // ada 
                    $result['status'] = "ada";
                }else{
                    // tidak ada
                    $result['status'] = "tidak ada";
                }
            }else{
                // bukan post
                $result['status'] = "bukan post";
            }
            // ambil dari post 
            $data = json_decode(file_get_contents('php://input'), true);
            if($data['name']!=null){
                $result['message'] = "berhasil add";
            }else{
                $result['message'] = "gagal add";
            }
            // hasil response
            echo json_encode($result);
        }
    }
