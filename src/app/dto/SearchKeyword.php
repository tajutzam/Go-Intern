<?php

namespace LearnPhpMvc\dto;

class SearchKeyword{
    
    private mixed $keyword;
    /**
     * Get the value of keyword
     */ 
    public function getKeyword()
    {
        return $this->keyword;
    }
    /**
     * Set the value of keyword
     *
     * @return  self
     */ 
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;
        return $this;
    }
    
}