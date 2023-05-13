<?php

namespace App\Controllers;

use App\Models\CategoriesModel;
use App\Models\VoucherModel;

class Client extends BaseController
{
    protected $voucherModel;
    protected $categoriesModel;
    public function __construct()
    {
        $this->voucherModel = new VoucherModel();
        $this->categoriesModel = new CategoriesModel();
    }
    public function index()
    {
        $data = [
            'title' => "Home",
            'categories' => $this->categoriesModel->findAll(),
            'voucher' => $this->voucherModel->findAll(),
        ];
        session()->set('game', '');
        return view('Client/Home', $data);
    }
    public function setSession()
    {
        if ($this->request->getPost('id')) {
            $id = $this->request->getPost('id');
            session()->set('game', $id);
            $response['success'] = false;
            $response['messages'] = "No Voucher Found";
            if (session()->game == $id) {
                $voucer = $this->voucherModel->where('category', session()->game)->first();
                if ($voucer) {
                    $response['success'] = true;
                    $response['messages'] = "We Voucher Found";
                }
            }
            return $this->response->setJSON($response);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }
    public function selection()
    {
        if (session()->game == NULL | session()->game == "") {
            return redirect()->to(base_url());
        } else {
            $voucer = $this->voucherModel->where('category', session()->game)->findAll();
            $data = [
                'title' => "Home",
                'category' => $this->categoriesModel->find(session()->game),
                'voucer' => $voucer,
            ];
            return view('Client/Purchase', $data);
        }
    }
}
