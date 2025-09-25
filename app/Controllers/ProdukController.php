<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\MProduk;

class ProdukController extends ResourceController
{
    protected $format = 'json';

    // Menampilkan semua produk
    public function index()
    {
        $model = new MProduk();
        $produk = $model->findAll();
        return $this->respond($produk);
    }

    // Menambahkan produk baru
    public function create()
    {
        $data = [
            'kode_produk' => $this->request->getVar('kode_produk'),
            'nama_produk' => $this->request->getVar('nama_produk'),
            'harga' => $this->request->getVar('harga')
        ];

        $model = new MProduk();
        $model->insert($data);
        $produk = $model->find($model->getInsertID());

        return $this->respondCreated($produk);
    }

    // Menampilkan list produk
    public function list()
    {
        $model = new MProduk();
        $produk = $model->findAll();
        return $this->respond($produk);
    }

    // Membuat fungsi detail produk
    public function detail($id)
    {
        $model = new MProduk();
        $produk = $model->find($id);

        if ($produk) {
            return $this->respond($produk);
        } else {
            return $this->failNotFound("Data Tidak Ditemukan");
        }
    }

    // Membuat fungsi update produk
    public function ubah($id)
    {
        $data = [
            'kode_produk' => $this->request->getVar('kode_produk'),
            'nama_produk' => $this->request->getVar('nama_produk'),
            'harga' => $this->request->getVar('harga')
        ];

        $model = new MProduk();

        if (!$model->find($id)) {
            return $this->failNotFound("Produk dengan ID $id tidak ditemukan");
        }

        $model->update($id, $data);
        $produk = $model->find($id);

        return $this->respond($produk);
    }

    // Membuat fungsi delete produk
    public function hapus($id)
    {
        $model = new MProduk();

        if (!$model->find($id)) {
            return $this->failNotFound("Produk dengan ID $id tidak ditemukan");
        }

        $model->delete($id);
        return $this->respondDeleted(['id' => $id, 'status' => 'Deleted']);
    }
}
