<?php
namespace App\Controllers;
use App\Models\MRegistrasi;
use CodeIgniter\RESTful\ResourceController;


class RegistrasiController extends ResourceController
{
   protected $format = 'json';
   
   public function registrasi()
   {
   $data = [
    'nama' => $this->request->getJSON()->nama,
    'email' => $this->request->getJSON()->email,
    'password' => password_hash($this->request->getJSON()->password, PASSWORD_DEFAULT)
];

   
   $model = new MRegistrasi();
   $model->save($data);
   return $this->respondCreated($data);
   }
    
}