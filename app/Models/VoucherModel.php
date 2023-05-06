<?php

namespace App\Models;

use CodeIgniter\Model;

class VoucherModel extends Model
{

	protected $table = 'voucher';
	protected $primaryKey = 'id_voucher';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['amount', 'category', 'status', 'deskripsi'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;
}
