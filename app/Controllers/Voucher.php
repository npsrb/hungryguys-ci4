<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\VoucherModel;

class Voucher extends BaseController
{

	protected $voucherModel;
	protected $validation;

	public function __construct()
	{
		$this->voucherModel = new VoucherModel();
		$this->validation =  \Config\Services::validation();
	}

	public function getAll()
	{
		$response = $data['data'] = array();

		$result = $this->voucherModel->select()->findAll();

		foreach ($result as $key => $value) {

			$ops = '<div class="btn-group">';
			$ops .= '<button type="button" class=" btn btn-sm dropdown-toggle btn-primary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Option</button>';
			$ops .= '<div class="dropdown-menu">';
			$ops .= '<a class="dropdown-item text-info" onClick="save(' . $value->id_voucher . ')">' .  lang("App.edit")  . '</a>';
			$ops .= '<a class="dropdown-item text-danger" onClick="remove(' . $value->id_voucher . ')"><i class="fa-solid fa-trash"></i>   ' .  lang("App.delete")  . '</a>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->amount,
				$value->category,
				$value->stock,
				$value->deskripsi,
				$ops
			);
		}

		return $this->response->setJSON($data);
	}

	public function getOne()
	{
		$response = array();

		$id = $this->request->getPost('id_voucher');

		if ($this->validation->check($id, 'required|numeric')) {

			$data = $this->voucherModel->where('id_voucher', $id)->first();

			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{
		$response = array();

		$fields['id_voucher'] = $this->request->getPost('id_voucher');
		$fields['amount'] = $this->request->getPost('amount');
		$fields['category'] = $this->request->getPost('category');
		$fields['stock'] = $this->request->getPost('stock');
		$fields['deskripsi'] = $this->request->getPost('deskripsi');


		$this->validation->setRules([
			'amount' => ['label' => 'Amount', 'rules' => 'required|numeric|min_length[0]|max_length[36]'],
			'category' => ['label' => 'Category', 'rules' => 'required|numeric|min_length[0]|max_length[36]'],
			'stock' => ['label' => 'Stock', 'rules' => 'required|numeric|min_length[0]|max_length[36]'],
			'deskripsi' => ['label' => 'Deskripsi', 'rules' => 'required|min_length[0]|max_length[100]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($this->voucherModel->insert($fields)) {

				$response['success'] = true;
				$response['messages'] = lang("App.insert-success");
			} else {

				$response['success'] = false;
				$response['messages'] = lang("App.insert-error");
			}
		}

		return $this->response->setJSON($response);
	}

	public function edit()
	{
		$response = array();

		$fields['id_voucher'] = $this->request->getPost('id_voucher');
		$fields['amount'] = $this->request->getPost('amount');
		$fields['category'] = $this->request->getPost('category');
		$fields['stock'] = $this->request->getPost('stock');
		$fields['deskripsi'] = $this->request->getPost('deskripsi');


		$this->validation->setRules([
			'amount' => ['label' => 'Amount', 'rules' => 'required|numeric|min_length[0]|max_length[36]'],
			'category' => ['label' => 'Category', 'rules' => 'required|numeric|min_length[0]|max_length[36]'],
			'stock' => ['label' => 'Stock', 'rules' => 'required|numeric|min_length[0]|max_length[36]'],
			'deskripsi' => ['label' => 'Deskripsi', 'rules' => 'required|min_length[0]|max_length[100]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($this->voucherModel->update($fields['id_voucher'], $fields)) {

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

		$id = $this->request->getPost('id_voucher');

		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {

			if ($this->voucherModel->where('id_voucher', $id)->delete()) {

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
