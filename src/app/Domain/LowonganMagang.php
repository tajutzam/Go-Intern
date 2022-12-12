<?php

namespace LearnPhpMvc\Domain;
class LowonganMagang{

    private int $id;

    private int $id_magang;

    private int $id_penyediaMagang;

    private int $id_pencariMagang;
     
    private string $start_on;

    private string $finish_on;

    private string $status;


	/**
	 * @return int
	 */
	public function getId(): int {
		return $this->id;
	}
	
	/**
	 * @param int $id 
	 * @return self
	 */
	public function setId(int $id): self {
		$this->id = $id;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getId_magang(): int {
		return $this->id_magang;
	}
	
	/**
	 * @param int $id_magang 
	 * @return self
	 */
	public function setId_magang(int $id_magang): self {
		$this->id_magang = $id_magang;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getId_penyediaMagang(): int {
		return $this->id_penyediaMagang;
	}
	
	/**
	 * @param int $id_penyediaMagang 
	 * @return self
	 */
	public function setId_penyediaMagang(int $id_penyediaMagang): self {
		$this->id_penyediaMagang = $id_penyediaMagang;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getId_pencariMagang(): int {
		return $this->id_pencariMagang;
	}
	
	/**
	 * @param int $id_pencariMagang 
	 * @return self
	 */
	public function setId_pencariMagang(int $id_pencariMagang): self {
		$this->id_pencariMagang = $id_pencariMagang;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getStart_on(): string {
		return $this->start_on;
	}
	
	/**
	 * @param string $start_on 
	 * @return self
	 */
	public function setStart_on(string $start_on): self {
		$this->start_on = $start_on;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getFinish_on(): string {
		return $this->finish_on;
	}
	
	/**
	 * @param string $finish_on 
	 * @return self
	 */
	public function setFinish_on(string $finish_on): self {
		$this->finish_on = $finish_on;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getStatus(): string {
		return $this->status;
	}
	
	/**
	 * @param string $status 
	 * @return self
	 */
	public function setStatus(string $status): self {
		$this->status = $status;
		return $this;
	}
}