<?php

namespace LearnPhpMvc\config;


    function getDbConfig():array{
        return [
            "database" =>[
                "test" =>[
                    "url" => "mysql:host=localhost:3306;dbname=gointern_db_test",
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


