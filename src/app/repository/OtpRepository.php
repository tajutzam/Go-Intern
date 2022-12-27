<?php

namespace LearnPhpMvc\repository;

use LearnPhpMvc\Domain\Otp;
use PDO;

class OtpRepository
{


    private PDO $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function save(Otp $otp): ?Otp
    {
        try {
            $query = "insert into otp (otp , pencari_magang) values (? , ?)";
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([$otp->getOtp(), $otp->getPencari_magang()]);
            return $otp;
        } catch (\PDOException $th) {
            //throw $th;
            return null;
        }
    }

    public function findByPencariMagang(Otp $otp): ?Otp
    {
        $query = "select * from otp where pencari_magang = ?";
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$otp->getPencari_magang()]);
        if ($PDOStatement->rowCount() > 0) {
            $row = $PDOStatement->fetch(PDo::FETCH_ASSOC);
            $otp->setId($row['id']);
            $otp->setOtp($row['otp']);
            return $otp;
        } else {
            return null;
        }
    }


    public function deleteOtpByPencariMagang(Otp $otp): bool
    {
        try {
            $query = "delete from otp where pencari_magang = ?";
            $PDOstatement = $this->connection->prepare($query);
            $PDOstatement->execute([$otp->getPencari_magang()]);
            return true;
        } catch (\PDOException $th) {
            //throw $th;
            return false;
        }
    }
}
