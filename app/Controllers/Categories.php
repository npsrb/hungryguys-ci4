<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\CategoriesModel;

class Categories extends BaseController
{

	protected $categoriesModel;
	protected $validation;

	public function __construct()
	{
		$this->categoriesModel = new CategoriesModel();
		$this->validation =  \Config\Services::validation();
	}


	public function getAll()
	{
		$response = $data['data'] = array();

		$result = $this->categoriesModel->select()->findAll();

		foreach ($result as $key => $value) {

			$ops = '<div class="btn-group">';
			$ops .= '<button type="button" class=" btn btn-sm dropdown-toggle btn-primary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Option</button>';
			$ops .= '<div class="dropdown-menu">';
			$ops .= '<a class="dropdown-item text-info" onClick="save(' . $value->id_category . ')">' .  lang("App.edit")  . '</a>';
			$ops .= '<a class="dropdown-item text-danger" onClick="remove(' . $value->id_category . ')"><i class="fa-solid fa-trash"></i>   ' .  lang("App.delete")  . '</a>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->category,
				$value->desc,

				$ops
			);
		}

		return $this->response->setJSON($data);
	}
	public function add()
	{
		$response = array();
		$fields['id_category'] = $this->request->getPost('id_category');
		$fields['category'] = $this->request->getPost('category');
		$fields['desc'] = $this->request->getPost('desc');

		$this->validation->setRules([
			'category' => ['label' => 'category', 'rules' => 'required|min_length[0]|max_length[36]'],
			'desc' => ['label' => 'category', 'rules' => 'required|min_length[0]|max_length[100]'],
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($this->categoriesModel->insert($fields)) {

				$response['success'] = true;
				$response['messages'] = lang("App.insert-success");
			} else {

				$response['success'] = false;
				$response['messages'] = lang("App.insert-error");
			}
		}

		return $this->response->setJSON($response);
	}

	public function getOne()
	{
		$response = array();

		$id = $this->request->getPost('id_category');

		if ($this->validation->check($id, 'required|numeric')) {

			$data = $this->categoriesModel->where('id_category', $id)->first();

			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function edit()
	{
		$response = array();
		$fields['id_category'] = $this->request->getPost('id_category');
		$fields['category'] = $this->request->getPost('category');
		$fields['desc'] = $this->request->getPost('desc');

		$this->validation->setRules([
			'category' => ['label' => 'category', 'rules' => 'required|min_length[0]|max_length[36]'],
			'desc' => ['label' => 'category', 'rules' => 'required|min_length[0]|max_length[100]'],
		]);


		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($this->categoriesModel->update($fields['id_category'], $fields)) {

				$response['success'] = true;
				$response['messages'] = lang("App.update-success");
			} else {

				$response['success'] = false;
				$response['messages'] = lang("App.update-error");
			}
		}

		return $this->response->setJSON($response);
	}

	public function remove()
	{
		$response = array();

		$id = $this->request->getPost('id_category');

		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {

			if ($this->categoriesModel->where('id_category', $id)->delete()) {

				$response['success'] = true;
				$response['messages'] = lang("App.delete-success");
			} else {

				$response['success'] = false;
				$response['messages'] = lang("App.delete-error");
			}
		}

		return $this->response->setJSON($response);
	}
}
