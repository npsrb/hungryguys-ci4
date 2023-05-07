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
        session()->set('game', '');
        $data = [
            'title' => "Home",
            'categories' => $this->categoriesModel->findAll(),
            'voucher' => $this->voucherModel->findAll(),
        ];
        return view('Client/Home', $data);
    }
    public function setSession()
    {
        if ($this->request->getPost('id')) {
            $id = $this->request->getPost('id');
            session()->set('game', $id);
            return redirect()->to(site_url('client/purchase'));
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }
    public function purchase()
    {
        if (session()->game == NULL | session()->game == "") {
            return redirect()->to(base_url());
        } else {
            $voucer = $this->voucherModel->where('category', session()->game)->findAll();
            if (count($voucer) < 1) {
                session()->setFlashdata('errors', "No Voucher Found");
                return redirect()->to(base_url());
            } else {
                $data = [
                    'title' => "Home",
                    'category' => $this->categoriesModel->find(session()->game),
                    'voucer' => $voucer,
                ];
                return view('Client/Purchase', $data);
            }
        }
    }
}
