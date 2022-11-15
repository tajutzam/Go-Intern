<?php

namespace LearnPhpMvc\repository;

use LearnPhpMvc\Domain\Magang;
use PDO;

class MagangRepository
{
    protected PDO $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }


    public function findAll(): array
    {
        $query = "select * from magang";

        $PDOstatment = $this->connection->query($query);
        $response = array();

        if ($PDOstatment->rowCount() > 0) {
            $response['status'] = 'oke';
            $response['message'] = 'data ditemukan';
            $response['body'] = array();
            while ($row = $PDOstatment->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $items  = array(
                    'id' => $id,
                    'posisi_magang' => $posisi_magang,
                    'status' => $status,
                    'penyedia' => $penyedia,
                    'lama_magang' => $lama_magang,
                    'jumlah_maksimal' => $jumlah_maksimal,
                    'jumlah_saatini' => $jumlah_saatini,
                    'create_at' => $create_at
                );
                array_push($response['body'], $items);
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'data ditemukan';
        };
        return $response;
    }

    public function addMagang(Magang $magang): ?Magang
    {
        $query = "insert into magang (posisi_magang , status , penyedia , lama_magang , jumlah_maksimal , jumlah_saatini , deskripsi , kategori) values (? , 'kosong' , ? , ? , ? , 0 , ? , ?)";
        $PDOstatment = $this->connection->prepare($query);
        try {
            $this->connection->beginTransaction();
            $PDOstatment->execute([$magang->getPosisi_magang(), $magang->getPenyedia(), $magang->getLama_magang(), $magang->getJumlah_maksimal(), $magang->getDeskripsi(), $magang->getKategori()]);
            $magang->setId($this->connection->lastInsertId());
            $this->connection->commit();
            return $magang;
        } catch (\PDOException $th) {
            //throw $th;
            var_dump($th);
            $this->connection->rollBack();
            return null;
        }
    }
    public function showMagang(Magang $magang): array
    {
        $response = array();
        $querry = "select magang.id , kategori.id as kategoriid , magang.posisi_magang , penyedia_magang.nama_perusahaan , kategori.kategori , magang.status , magang.lama_magang , magang.jumlah_maksimal , magang.jumlah_saatini , magang.create_at , magang.deskripsi  from magang join penyedia_magang on magang.penyedia = penyedia_magang.id join kategori on kategori.id = magang.kategori where penyedia_magang.id = ?";
        $PDOstatement =  $this->connection->prepare($querry);
        $PDOstatement->execute([$magang->getPenyedia()]);
        if ($PDOstatement->rowCount() > 0) {
            $response['status'] = 'oke';
            $response['message'] = 'data  ditemukan';
            $response['body'] = array();
            http_response_code(200);
            while ($row = $PDOstatement->fetch(PDO::FETCH_ASSOC)) {

                $item = array(
                    "id" => $row['id'],
                    "id_kategori" => $row['kategoriid'],
                    "posisi_magang" => $row['posisi_magang'],
                    "penyedia_magang" => $row['nama_perusahaan'],
                    "kategori" => $row['kategori'],
                    "status" => $row['status'],
                    "lama_magang" => $row['lama_magang'],
                    "jumlah_maksimal" => $row['jumlah_maksimal'],
                    "jumlah_saatini" => $row['jumlah_saatini'],
                    "create_at" => $row['create_at'],
                    "deskripsi" => $row['deskripsi'],
                    // "syarat" => $row['syarat'],
                );
                array_push($response['body'], $item);
            }
        } else {
            http_response_code(404);
            $response['status'] = "failed";
            $response['message'] = "data null";
        }
        return $response;
    }

    public function updateMagang(Magang $magang) : ?Magang{
        try {
            
            $now_stamp = date("Y-m-d H:i:s");
            $query = "update magang set posisi_magang  = ? , kategori = ? , lama_magang = ? , jumlah_maksimal = ? , deskripsi = ?  where id = ? ";
            $PDOstatement = $this->connection->prepare($query);
            $PDOstatement->execute([
                $magang->getPosisi_magang() , 
                $magang->getKategori() , 
                $magang->getLama_magang(),
                $magang->getJumlah_maksimal() , 
                $magang->getDeskripsi(),
                $magang->getId()
            ]);
            return $magang;        
        } catch (\PDOException $th) {
            var_dump($th);
            return null;
        }
        
    }

    public function deleteById(Magang $magang) : bool{
        try {
            $query = "delete from magang where id= ? ";
            $PDOstatement = $this->connection->prepare($query);
            $PDOstatement->execute([$magang->getId()]);
            return true;
        } catch (\PDOException $th) {
           return false;
        }
}
}
