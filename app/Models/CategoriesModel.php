<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;

use CodeIgniter\Model;

class CategoriesModel extends Model
{

	protected $table = 'categories';
	protected $primaryKey = 'id_category';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['category', 'desc'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;
}
