<?php

namespace LearnPhpMvc\Domain;

class Skill{

    private int $id;
    private string $skill;
    private int $pencari_magang;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of skill
     */ 
    public function getSkill()
    {
        return $this->skill;
    }

    /**
     * Set the value of skill
     *
     * @return  self
     */ 
    public function setSkill($skill)
    {
        $this->skill = $skill;

        return $this;
    }

    /**
     * Get the value of pencari_magang
     */ 
    public function getPencari_magang()
    {
        return $this->pencari_magang;
    }

    /**
     * Set the value of pencari_magang
     *
     * @return  self
     */ 
    public function setPencari_magang($pencari_magang)
    {
        $this->pencari_magang = $pencari_magang;

        return $this;
    }
}