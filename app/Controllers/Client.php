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
        return view('Client/Home', $data);
    }
    public function setSession()
    {
        if ($this->request->getPost('id')) {
            $session = session();
            $session->set('test', 'Hello, session!');
            return redirect()->to(site_url('client/purchase'));
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }
    public function purchase()
    {
        $data = [
            'title' => "Home",
            'categories' => $this->categoriesModel->findAll(),
            'voucher' => $this->voucherModel->findAll(),
        ];
        return view('Client/Purchase', $data);
    }
}
