<?php

namespace App\Controllers;

use App\Models\CategoriesModel;
use App\Models\VoucherModel;

class Admin extends BaseController
{
    protected $db;
    protected $voucherModel;
    protected $categoriesModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->voucherModel = new VoucherModel();
        $this->categoriesModel = new CategoriesModel();
    }
    public function dashboard()
    {
        if (session()->logged_in == false) {
            return redirect()->to(site_url('admin/login'));
        } else {
            $data = [
                'title' => "Dashboard",
                'page' => "Dashboard",
                'controller' => "Categories",
                'categorytot' => '20',
                'transaksitot' => '20',
                'producttot' => '20'
            ];
            return view('Admin/Dashboard', $data);
        }
    }
    public function handleLogin()
    {
        if ($this->request->getPost()) {
            $postdata = $this->request->getPost();
            $username = $postdata['username'];
            $query   = $this->db->query("SELECT * FROM admin where username = '$username' LIMIT 1");
            $result = $query->getResult();
            if (count($result) == 1) {
                if ($postdata['password'] == $result[0]->password) {
                    $loginData = [
                        'username'  => 'johndoe',
                        'email'     => 'johndoe@some-site.com',
                        'logged_in' => true,
                    ];
                    session()->set($loginData);
                    return redirect()->to(base_url('admin/dashboard'));
                } else {
                    session()->setFlashdata('errors', "Something went wrong");
                    return redirect()->to(base_url('admin/login'));
                }
            } else {
                session()->setFlashdata('errors', "Something went wrong");
                return redirect()->to(base_url('admin/login'));
            }
        }
    }
    public function login()
    {
        $data = [
            'title' => "Login",
        ];
        // if not logged in
        if (session()->logged_in == true) {
            return redirect()->to(site_url('admin/dashboard'));
        } else {
            return view('Admin/Login', $data);
        }
    }
    public function logout()
    {
        session()->logged_in = false;
        session_destroy();
        return redirect()->to(base_url('admin/login'));
    }
    public function voucher()
    {
        $data = [
            'controller' => "voucher",
            'category' => $this->categoriesModel->findAll(),
            'page' => "Voucher Page",
            'title' => "Voucher Page"
        ];
        return view('admin/voucher', $data);
    }
    public function categories()
    {
        $data = [
            'controller' => "categories",
            'page' => "Game Categories",
            'title' => "Game Categories",

        ];
        return view('admin/categories', $data);
    }
    public function transaction()
    {
        $data = [
            'controller' => "Admin",
            'page' => "Transaction",
            'title' => "Transaction Page"
        ];
        return view('admin/transaction', $data);
    }
    public function report()
    {
        $data = [
            'controller' => "Report",
            'page' => "Report",
            'title' => "Report Page"
        ];
        return view('admin/report', $data);
    }
}
