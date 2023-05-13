<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoriesModel;
use App\Models\VoucherModel;

class Categories extends BaseController
{

	protected $categoriesModel;
	protected $validation;
	protected $voucherModel;
	public function __construct()
	{
		$this->categoriesModel = new CategoriesModel();
		$this->voucherModel = new VoucherModel();
		$this->validation =  \Config\Services::validation();
	}
	public function index()
	{
		$data = [
			'controller' => "categories",
			'page' => "Game Categories",
			'title' => "Game Categories",

		];
		return view('admin/categories', $data);
	}

	public function getAll()
	{
		$response = $data['data'] = array();

		$result = $this->categoriesModel->select()->findAll();

		foreach ($result as $key => $value) {

			$ops = '<div class="btn-group">';
			$ops .= '<button type="button" class=" btn btn-sm dropdown-toggle btn-danger" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Option</button>';
			$ops .= '<div class="dropdown-menu">';
			$ops .= '<a class="dropdown-item text-purple" onClick="save(' . $value->id_category . ')"><i class="fa-solid fa fa-edit"></i>' .  lang("App.edit")  . '</a>';
			$ops .= '<a class="dropdown-item text-danger" onClick="remove(' . $value->id_category . ')"><i class="fa-solid fa fa-trash"></i>   ' .  lang("App.delete")  . '</a>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->category,
				$value->option_user_id == 1 ? 'On' : 'Off',
				$value->option_username == 1 ? 'On' : 'Off',
				$value->option_server == 1 ? 'On' : 'Off',
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


		// optional fields
		$fields['option_user_id'] = $this->request->getPost('option_user_id') == 'on' ? '1' : '0';
		$fields['option_server'] = $this->request->getPost('option_server') == 'on' ? '1' : '0';
		$fields['option_username'] = $this->request->getPost('option_username') == 'on' ? '1' : '0';

		// image
		if ($this->request->getFile('picture')) {
			$picture = $this->request->getFile('picture');
			$newName = $picture->getRandomName();
			$picture->move('./uploads/', $newName);
			$fields['picture'] = $newName;
			if ($this->categoriesModel->insert($fields)) {
				$response['success'] = true;
				$response['messages'] = lang("App.insert-success");
			}
		} else {
			$response['success'] = false;
			$response['messages'] = lang("App.insert-error");
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
		$fields['option_user_id'] = $this->request->getPost('option_user_id') == 'on' ? '1' : '0';
		$fields['option_server'] = $this->request->getPost('option_server') == 'on' ? '1' : '0';
		$fields['option_username'] = $this->request->getPost('option_username') == 'on' ? '1' : '0';

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

		$id = $this->request->getPost('params');

		if (!$this->validation->check($id, 'required|numeric')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {
			$findRecord = $this->categoriesModel->where('id_category', $id)->first();
			$image = $findRecord->picture;
			$filepath = './uploads/' . $image;
			$deleteVoucher = $this->voucherModel->where('category', $id)->delete();
			if (file_exists($filepath)) {
				unlink($filepath);
				if ($this->categoriesModel->where('id_category', $id)->delete()) {
					$response['success'] = true;
					$response['messages'] = lang("App.delete-success");
				}
			} else {
				$response['success'] = false;
				$response['messages'] = lang("App.delete-error");
			}
		}

		return $this->response->setJSON($response);
	}
}
