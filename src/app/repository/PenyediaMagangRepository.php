<?php

namespace LearnPhpMvc\repository;

use DateTime;
use LearnPhpMvc\Domain\PenyediaMagang;
use LearnPhpMvc\dto\AktivasiAkunResponse;
use PDO;
use PDOException;

class PenyediaMagangRepository
{

    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $query = "select * from penyedia_magang";
        $PDOStatement = $this->connection->query($query);
        $response = array();
        $response['body'] = array();
        if ($PDOStatement->rowCount() > 0) {
            $response['status'] = "oke";
            while ($row = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);
                $s = array(
                    "id" => $id,
                    "nama_perusahaan" => $nama_perusahaan,
                    "alamat_perusahaan" => $alamat_perusahaan,
                    "email" => $email,
                    "no_telp" => $no_telp,
                    "password" => $password,
                    "username" => $username,
                    "token" => $token,
                    "role" => $role,
                    "jenis_usaha" => $jenis_usaha,
                    "status" => $status,
                    "create_at" => $create_at,
                    "update_at" => $update_at,
                    "lokasi" => $lokasi,
                    "foto" => $foto,
                );
                array_push($response['body'], $s);
            }
            return $response;
        } else {
            $response['status'] = "data tidak ada";
            return $response;
        }
    }

    public function save(PenyediaMagang $penyediaMagang): ?PenyediaMagang
    {
        $date = new DateTime();
        $timestamp = $date->getTimestamp();
        $dtNow = gmdate("Y-m-d\TH:i:s", $timestamp);

        // set default value for penyedia magang
        $penyediaMagang->setStatus('tidak-aktif');
        $penyediaMagang->setRole(5);
        try {
            $query = "INSERT INTO `penyedia_magang`(`nama_perusahaan`, `email`, `no_telp`, `password`, `username`, `token`, `role`, `status`, `create_at`, `update_at` , `alamat_perusahaan` , `jenis_usaha`) VALUES (?, ? , ? , ? , ? , ? , ? , ? , ? , ? , ? , ? )";
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([
                $penyediaMagang->getNamaPerushaan(),
                $penyediaMagang->getEmail(),
                $penyediaMagang->getNoTelp(),
                $penyediaMagang->getPassword(),
                $penyediaMagang->getUsername(),
                $penyediaMagang->getToken(),
                $penyediaMagang->getRole(),
                $penyediaMagang->getStatus(),
                $dtNow,
                $dtNow,
                $penyediaMagang->getAlamaPerushaan(),
                $penyediaMagang->getJenisUsaha()
            ]);
            $penyediaMagang->setId($this->connection->lastInsertId());
            return $penyediaMagang;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return null;
        }
    }

    public function findById($id): ?PenyediaMagang
    {
        $penyediaMagang = new PenyediaMagang();
        $query = "select * from penyedia_magang where id = ?";
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$id]);
        if ($PDOStatement->rowCount() > 0) {
            while ($row = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
                $penyediaMagang->setId($row['id']);
                $penyediaMagang->setNamaPerushaan($row['nama_perusahaan']);
                $penyediaMagang->setAlamaPerushaan($row['alamat_perusahaan']);
                $penyediaMagang->setEmail($row['email']);
                $penyediaMagang->setNoTelp($row['no_telp']);
                $penyediaMagang->setPassword($row['password']);
                $penyediaMagang->setUsername($row['username']);
                $penyediaMagang->setToken($row['token']);
                $penyediaMagang->setRole($row['role']);
                $penyediaMagang->setJenisUsaha($row['jenis_usaha']);
                $penyediaMagang->setStatus($row['status']);
                $penyediaMagang->setCreateAt($row['create_at']);
                $penyediaMagang->setUpdateAt($row['update_at']);
            }
        } else {
            echo "data tidak ada";
            return null;
        }
        return $penyediaMagang;
    }

    public function findByUsername(PenyediaMagang $penyediaMagang): array
    {
        $response = array();
        $query = <<<SQL
        select * from penyedia_magang where username = ?
SQL;
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$penyediaMagang->getUsername()]);
        if ($PDOStatement->rowCount() > 0) {
            while ($row = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);
                $item = array(
                    "id" => $id,
                    "username" => $username,
                    "password" => $password,
                    "nama_perushaan" => $nama_perusahaan,
                    "alamat" => $alamat_perusahaan,
                    "email" => $email,
                    "no_telp" => $no_telp,
                    "role" => $role,
                    "jenis_usaha" => $jenis_usaha,
                    "status" => $status,
                    "create_at" => $create_at,
                    "update_at" => $update_at,
                    "token" => $token,
                    "foto" => $foto,
                    "expired_token" => $expired_token
                );
                array_push($response, $item);
            }
            $response['status'] = 'oke';
            $response['message'] = 'data ditemukan';
            return $response;
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'data tidak ditemukan';
            return $response;
        }
    }
    public function findByEmail(PenyediaMagang $penyediaMagang): ?PenyediaMagang
    {
        $query = <<<SQL
        select * from penyedia_magang where email = ?
SQL;
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$penyediaMagang->getEmail()]);
        if ($PDOStatement->rowCount() > 0) {
            while ($row = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);
                $penyediaMagang->setId($id);
                $penyediaMagang->setUsername($username);
                $penyediaMagang->setPassword($password);
                $penyediaMagang->setNamaPerushaan($nama_perusahaan);
                $penyediaMagang->setEmail($email);
                $penyediaMagang->setNoTelp($no_telp);
                $penyediaMagang->setRole($role);
                $penyediaMagang->setStatus($status);
                $penyediaMagang->setCreateAt($create_at);
                $penyediaMagang->setUpdateAt($update_at);
            }
            return $penyediaMagang;
        } else {
            return null;
        }
    }

    public function updateExpaired(AktivasiAkunResponse $aktivasiAkunResponse, PenyediaMagang $penyediaMagang): array
    {
        $query = <<<SQL
        update penyedia_magang set expired_token=? where username=?
SQL;
        try {
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([$aktivasiAkunResponse->getExpired(), $penyediaMagang->getUsername()]);
            $response = array();
            $response['status'] = "oke";
            return $response;
        } catch (\Exception $exception) {
            $response['status'] = $exception->getMessage();
            return $response;
        }
    }

    public function updateStatus(PenyediaMagang $penyediaMagang): array
    {
        $queryUpdate = "select status from penyedia_magang where username = ?";
        $PDOUpdate =  $this->connection->prepare($queryUpdate);
        $response = array();
        $PDOUpdate->execute([$penyediaMagang->getUsername()]);
        if ($PDOUpdate->rowCount() > 0) {
            $query = <<<SQL
            update penyedia_magang set status='aktif' where username=?
    SQL;
            try {
                $PDOStatement = $this->connection->prepare($query);
                $PDOStatement->execute([$penyediaMagang->getUsername()]);
                $response['status'] = "oke";
                return $response;
            } catch (\Exception $exception) {
                $response['status'] = $exception->getMessage();
                return $response;
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'gagal update status';
            return $response;
        }
    }
    public function updateData(PenyediaMagang $penyediaMagang): ?PenyediaMagang
    {
        $query = "update penyedia_magang set nama_perusahaan = ? , alamat_perusahaan = ? , email = ? , no_telp = ?  , username = ? , jenis_usaha = ?  where id = ?  ";
        $Pdostatement = $this->connection->prepare($query);
        try {
            $Pdostatement->execute([
                $penyediaMagang->getNamaPerushaan(),
                $penyediaMagang->getAlamaPerushaan(),
                $penyediaMagang->getEmail(),
                $penyediaMagang->getNoTelp(),
                $penyediaMagang->getUsername(),
                $penyediaMagang->getJenisUsaha(),
                $penyediaMagang->getId()
            ]);
            return $penyediaMagang;
        } catch (\PDOException $th) {
            return null;
        }
    }

    public function updatePathFoto(PenyediaMagang $penyediaMagang): bool
    {
        $query = "update penyedia_magang set foto = ? where id = ? ";
        try {
            $responseStatement =  $this->connection->prepare($query);
            $responseStatement->execute([$penyediaMagang->getFoto(), $penyediaMagang->getId()]);
            return true;
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }


    public function countMagangIklan(PenyediaMagang $penyediaMagang): int
    {
        $count = 0;
        $query =  'select count(id) as jumlah from magang where penyedia = ?';
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$penyediaMagang->getId()]);
        if ($PDOStatement->rowCount() > 0) {
            $row = $PDOStatement->fetch(PDO::FETCH_ASSOC);
            $count = $row['jumlah'];
        } else {
        }
        return $count;
    }

    public function countMagangYangsedangDitempati(PenyediaMagang $penyediaMagang)
    {
        $count = 0;
        $query =  "select count(id) as jumlah from magang where status != 'kosong' and penyedia = ?";
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$penyediaMagang->getId()]);
        if ($PDOStatement->rowCount() > 0) {
            $row = $PDOStatement->fetch(PDO::FETCH_ASSOC);
            $count = $row['jumlah'];
        } else {
        }
        return $count;
    }

    public function countLamaranMasuk(PenyediaMagang $penyediaMagang)
    {
        $count = 0;
        $query = "SELECT COUNT(id) as jumlah from lowongan_magang WHERE penyediaMagang = ? and status = 'pending'";
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$penyediaMagang->getId()]);
        if ($PDOStatement->rowCount() > 0) {
            $row = $PDOStatement->fetch(PDO::FETCH_ASSOC);
            $count = $row['jumlah'];
        } else {
        }
        return $count;
    }
    public function countPemagang(PenyediaMagang $penyediaMagang)
    {
        $count = 0;
        $query = "SELECT COUNT(id) as jumlah from lowongan_magang WHERE penyediaMagang = ? and status = 'acc'";
        $PDOStatement = $this->connection->prepare($query);
        $PDOStatement->execute([$penyediaMagang->getId()]);
        if ($PDOStatement->rowCount() > 0) {
            $row = $PDOStatement->fetch(PDO::FETCH_ASSOC);
            $count = $row['jumlah'];
        } else {
        }
        return $count;
    }


    public function showPopularCompanies(): array
    {
        $response = array();
        $query = "select penyedia_magang.id ,  penyedia_magang.nama_perusahaan , penyedia_magang.foto , penyedia_magang.alamat_perusahaan , penyedia_magang.email  , penyedia_magang.no_telp , COUNT(lowongan_magang.id) as jumlah from penyedia_magang JOIN lowongan_magang on penyedia_magang.id = lowongan_magang.penyediaMagang  GROUP BY(penyedia_magang.id) ORDER BY(jumlah) DESC";
        $PDOstatement = $this->connection->query($query);
        if ($PDOstatement->rowCount() > 0) {
            $response['body'] = array();
            $response['status'] = 'oke';
            $response['message'] = 'terdapat data popular';
            http_response_code(200);
            while ($row = $PDOstatement->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $item = array(
                    "id" => $id,
                    "nama_perusahaan" => $nama_perusahaan,
                    "foto" => $foto,
                    "alamat_perusahaan" => $alamat_perusahaan,
                    "email" => $email,
                    "no_telp" => $no_telp,
                    "jumlah" => $jumlah
                );
                array_push($response['body'], $item);
            }
        } else {
            http_response_code(404);
            $response['status'] = 'failed';
            $response['message'] = 'data popular tidak tersedia';
        }
        return $response;
    }



    public  function showPopularClose(): array
    {
        $query = "select DISTINCT penyedia_magang.id ,  penyedia_magang.nama_perusahaan , penyedia_magang.foto , penyedia_magang.alamat_perusahaan , penyedia_magang.email  , penyedia_magang.no_telp from penyedia_magang join lowongan_magang on penyedia_magang.id != lowongan_magang.penyediaMagang";

        $PDOstatement = $this->connection->query($query);
        if ($PDOstatement->rowCount() > 0) {
            $response['body'] = array();
            $response['status'] = 'oke';
            http_response_code(200);
            while ($row = $PDOstatement->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $item = array(
                    "id" => $id,
                    "nama_perusahaan" => $nama_perusahaan,
                    "foto" => $foto,
                    "alamat_perusahaan" => $alamat_perusahaan,
                    "email" => $email,
                    "no_telp" => $no_telp,
                    "jumlah" => 0
                );
                array_push($response['body'], $item);
            }
        } else {
            http_response_code(404);
            $response['status'] = 'failed';
            $response['message'] = 'data popular tidak tersedia';
        }
        return $response;
    }

    public function updatePassword(PenyediaMagang $penyediaMagang): bool
    {
        try {
            $query = "update penyedia_magang set password = ? where id = ?";
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([$penyediaMagang->getPassword(), $penyediaMagang->getId()]);
            return true;
        } catch (\PDOException $th) {
            //throw $th;
            return false;
        }
    }


    public function enable($id): bool
    {
        try {
            $query = "update penyedia_magang set status = 'aktif' where id = ?";
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([$id]);
            return true;
        } catch (PDOException $th) {
            //throw $th;
            return false;
        }
    }

    public function disable($id)
    {
        try {
            $query = "update penyedia_magang set status = 'tidak-aktif' where id = ?";
            $PDOStatement = $this->connection->prepare($query);
            $PDOStatement->execute([$id]);
            return true;
        } catch (PDOException $th) {
            //throw $th;
            return false;
        }
    }

    public function countPenyedia()
    {
        $query = "select * from penyedia_magang";
        $PDOStatement = $this->connection->query($query);
        return $PDOStatement->rowCount();
    }
}
