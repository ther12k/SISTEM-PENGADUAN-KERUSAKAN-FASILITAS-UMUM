<?php

namespace App\Models;

use CodeIgniter\Model;

class ComplaintModel extends Model
{
    protected $table            = 'complaints';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function getByUserId($user_id) {
        return $this -> where('user_id', $user_id)->findAll();
    }
    function countStatusByUser($userId) {
        return [
            'baru'=> $this->where(['user_id'=> $userId, 'status'=>'baru'])->countAllResults(),
            'proses'=> $this->where(['user_id'=> $userId, 'status'=>'proses'])->countAllResults(),
            'selesai'=> $this->where(['user_id'=> $userId, 'status'=>'selesai'])->countAllResults(),
        ];    
    }
}
