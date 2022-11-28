<?php

namespace LearnPhpMvc\dto;

class SkillRequest
{

    private string $skill;
    private int $pencari_magang;
    private int $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getSkill(): string
    {
        return $this->skill;
    }

    /**
     * @param string $skill
     */
    public function setSkill(string $skill): void
    {
        $this->skill = $skill;
    }

    /**
     * @return string
     */
    public function getPencariMagang(): string
    {
        return $this->pencari_magang;
    }

    /**
     * @param string $pencari_magang
     */
    public function setPencariMagang(int $pencari_magang): void
    {
        $this->pencari_magang = $pencari_magang;
    }



}