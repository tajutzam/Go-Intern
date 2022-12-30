<?php

namespace LearnPhpMvc\config;


    function getDbConfig():array{
        return [
            "database" =>[
                "test" =>[
                    "url" => "mysql:host=143.198.198.61;dbname=gointern_db_test",
                    "username"=>"root",
                    "password"=>"root"
                ],
                "prod"=>[
                    "url" => "mysql:host=localhost:3306;dbname=gointern_db_test",
                    "username"=>"root",
                    "password"=>""
                ]
            ]
        ];
    }   


