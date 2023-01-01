<?php



namespace LearnPhpMvc\service;

use LearnPhpMvc\Config\Database;
use LearnPhpMvc\Domain\Kategori;
use LearnPhpMvc\helper\MoveFile;
use LearnPhpMvc\repository\KategoriRepository;

class KategoriService
{

    private KategoriRepository $repository;


    public function __construct()
    {
        $this->repository = new KategoriRepository(Database::getConnection());
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function addKategori($kategori, $files): array
    {
        $response = [];
        $find = $this->repository->findByKategori($kategori);
        if ($find['status'] == 'oke') {
            $response['status'] = 'failed';
            $response['message'] = 'Gagal menambahkan kategori , terdapat kategori dengan nama yang sama';
        } else {
            $kategoriObj = new Kategori();
            $kategoriObj->setKategori($kategori);
            $kategoriObj->setFoto($files);
            $responseAdd =  $this->repository->addKategori($kategoriObj);
            if ($responseAdd != null) {
                $response['status'] = 'oke';
                $response['message'] = 'berhasil menambahkan kategori ' . $responseAdd->getKategori();
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'gagal menambahkan kategori terjadi kesalahan server';
            }
        }
        return $response;
    }
    public function updateKategori($kategorikey, $foto, $id, $tmpName, $size): array
    {
        $response = [];
        $findId = $this->repository->findById($id);
        $findKategori = $this->repository->findByKategori($kategorikey);
        if ($findId != null) {
            $kategoriLama = $findId->getKategori();
            if ($kategoriLama == $kategorikey && $size == 0) {
                $response['status'] = 'failed';
                $response['message'] = 'tidak ada perubahan kategori';
            } else {
                $kategori = new Kategori();
                $kategori->setKategori($kategorikey);
                $kategori->setFoto($foto);
                $kategori->setId($id);
                if ($size != 0) {
                    $responseUpdate =  $this->repository->updateKategori($kategori);
                    if ($responseUpdate != null) {
                        $responseMove = MoveFile::moveFilePenyedia($tmpName, $foto, "kategori");
                        if ($responseMove['status'] == 'oke') {
                            $response['status'] = 'oke';
                            $response['message'] = 'berhasil memperbarui kategori';
                        } else {
                            $response['status'] = 'failed';
                            $response['message'] = 'berhasil memperbarui kategori , gagal menghapus foto di server';
                        }
                    } else {
                        $response['status'] = 'failed';
                        $response['message'] = 'gagal memperbarui kategori';
                    }
                } else {
                    if ($findKategori['status'] == 'oke') {
                        foreach ($findKategori['body'] as $key => $value) {
                            # code...
                            if ($value['kategori'] === $kategorikey) {
                                $response['status'] = 'failed';
                                $response['message'] = 'gagal  memperbarui kategori , terdapat kategori dengan nama yang sama';
                                break;
                            } else {
                                if ($size == 0) {
                                    $responseUpdateNama =  $this->repository->updateKategoriNama($kategori);
                                    if ($responseUpdateNama != null) {
                                        $response['status'] = 'oke';
                                        $response['message'] = 'Kategori berhasil diperbarui';
                                    } else {
                                        $response['status'] = 'Failed';
                                        $response['message'] = 'Kategori gagal diperbarui';
                                    }
                                    break;
                                } else {
                                    $responseUpdate =  $this->repository->updateKategori($kategori);
                                    if ($responseUpdate != null) {
                                        $responseMove = MoveFile::moveFilePenyedia($tmpName, $foto, "kategori");
                                        if ($responseMove['status'] == 'oke') {
                                            $response['status'] = 'oke';
                                            $response['message'] = 'berhasil memperbarui kategori';
                                            
                                        } else {
                                            $response['status'] = 'failed';
                                            $response['message'] = 'berhasil memperbarui kategori , gagal menghapus foto di server';
                                        }
                                    } else {
                                        $response['status'] = 'failed';
                                        $response['message'] = 'gagal memperbarui kategori';
                                    }
                                    break;
                                }
                            }
                        }
                    } else {
                        if ($size == 0) {
                            $responseUpdateNama =  $this->repository->updateKategoriNama($kategori);
                            if ($responseUpdateNama != null) {
                                $response['status'] = 'oke';
                                $response['message'] = 'Kategori berhasil diperbarui';
                            } else {
                                $response['status'] = 'Failed';
                                $response['message'] = 'Kategori gagal diperbarui';
                            }
                        } else {
                            $responseUpdate =  $this->repository->updateKategori($kategori);
                            if ($responseUpdate != null) {
                                $responseMove = MoveFile::moveFilePenyedia($tmpName, $foto, "kategori");
                                if ($responseMove['status'] == 'oke') {
                                    $response['status'] = 'oke';
                                    $response['message'] = 'berhasil memperbarui kategori';
                                } else {
                                    $response['status'] = 'failed';
                                    $response['message'] = 'berhasil memperbarui kategori , gagal menghapus foto di server';
                                }
                            } else {
                                $response['status'] = 'failed';
                                $response['message'] = 'gagal memperbarui kategori';
                            }
                        }
                    }
                }
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'gagal memperbarui kategori data kategori tidak ditemukan';
        }
        return $response;
    }
    public function deleteKategori($id): array
    {
        $response = [];
        $find = $this->repository->findById($id);
        if ($find != null) {
            $isDelete = $this->repository->deleteById($id);
            if ($isDelete) {
                $response['status'] = 'oke';
                $response['message'] = 'Berhasil menghapus kategori';
            } else {
                $response['status'] = 'failed';
                $response['message'] = 'gagal menghapus kategori , ada data magang yang menggunakan kategori';
            }
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'data kategori tidak ditemukan';
        }
        return $response;
    }

    public function count()
    {
        return $this->repository->countKategori();
    }
}
