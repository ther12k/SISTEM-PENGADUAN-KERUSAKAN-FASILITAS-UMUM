<?php

namespace App\Models;

use CodeIgniter\Model;

class ResponseModel extends Model
{
    protected $table            = 'responses';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = ['complaint_id', 'user_id', 'message', 'craeted_at', 'update_at'];

    // Note: The actual column names in the database have typos
    // 'craeted_at' should be 'created_at'
    // 'update_at' should be 'updated_at'

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'craeted_at'; // Using the actual column name
    protected $updatedField  = 'update_at';  // Using the actual column name

    function getResponsesByComplaint($complaint_id) {
        return $this->select('responses.*, users.username')
                    ->join('users', 'users.id = responses.user_id')
                    ->where('responses.complaint_id', $complaint_id)
                    ->orderBy('responses.craeted_at', 'ASC')
                    ->findAll();
    }
}