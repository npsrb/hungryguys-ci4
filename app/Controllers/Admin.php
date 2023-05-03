<?php

namespace App\Controllers;


class Admin extends BaseController
{
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function dashboard()
    {
        if (session()->logged_in == false) {
            return redirect()->to(site_url('admin/login'));
        } else {
            $data = [
                'title' => "Dashboard",
                'page' => "Dashboard",
                'controller' => "dashboard"
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
            'page' => "Voucher Page",
            'title' => "Voucher Page"
        ];
        return view('admin/voucher', $data);
    }
    public function categories()
    {
        $data = [
            'controller' => "Categories",
            'page' => "Categories",
            'title' => "Categories Page"
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
