<?php

namespace LearnPhpMvc\config;
    function getDbConfig():array{
        return [
            "database" =>[
                "test" =>[
                    "url" => "mysql:host=127.0.0.1:3306;dbname=gointern_db_test",
                    "username"=>"root",
                    "password"=>""
                ],
                "prod"=>[
                    "url" => "mysql:host=localhost:3306;dbname=gointern_db_test",
                    "username"=>"root",
                    "password"=>""
                ]   
            ]
        ];
    }   


