<?php

namespace LearnPhpMvc\helper;

class ModelMapper
{
    static function array_trans(array $lookup, $data) : array
    {
        $translated = array();

        foreach($lookup as $from => $to)
        {
            if (array_key_exists($from, $data))
            {
                $translated[$to] = $data[$from];
            }
        }

        return $translated;
    }
}