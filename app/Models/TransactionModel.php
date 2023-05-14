<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{

    protected $table = 'transaction';
    protected $primaryKey = 'id_transaction';
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_transaction', 'category', 'email', 'server_id', 'user_id', 'username', 'amount', 'status'];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;
}
