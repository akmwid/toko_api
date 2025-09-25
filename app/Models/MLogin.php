<?php
namespace App\Models;
use CodeIgniter\Model;
class Mlogin extends Model
{
    protected $table = 'member_token';
    protected $allowedFields = [ 'member_id', 'auth_key'];
}