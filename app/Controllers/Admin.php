<?php

namespace App\Controllers;


use App\Models\CategoriesModel;
use App\Models\TransactionModel;
use App\Models\VoucherModel;

class Admin extends BaseController
{
    protected $db;
    protected $voucherModel;
    protected $categoriesModel;
    protected $transactionModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->voucherModel = new VoucherModel();
        $this->categoriesModel = new CategoriesModel();
        $this->transactionModel = new TransactionModel();
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
    public function transaction()
    {
        if (session()->logged_in == false) {
            return redirect()->to(site_url('admin/login'));
        }
        $data = [
            'controller' => "Admin",
            'page' => "Transaction",
            'title' => "Transaction Page",
        ];

        return view('admin/transaction', $data);
    }

    public function getAll()
    {
        $response = $data['data'] = array();
        $result = $this->transactionModel->select()->findAll();

        foreach ($result as $key => $value) {
            $ops = '<div class="btn-group">';
            $ops .= '<button type="button" class=" btn btn-sm dropdown-toggle btn-danger" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Option</button>';
            $ops .= '<div class="dropdown-menu">';
            $ops .= '<a class="dropdown-item text-primary" onClick="approve(' . $value->id_transaction . ')"><i class="fa-solid fa fa-check"></i>  Approve</a>';
            $ops .= '<a class="dropdown-item text-warning" onClick="reject(' . $value->id_transaction . ')"><i class="fa-solid fa fa-window-close"></i>  Reject</a>';
            $ops .= '<a class="dropdown-item text-danger" onClick="remove(' . $value->id_transaction . ')"><i class="fa-solid fa fa-trash"></i>   ' .  lang("App.delete")  . '</a>';
            $ops .= '</div>';
            $data['data'][$key] = array(
                $value->id_transaction,
                $value->email,
                $value->server_id,
                $value->user_id,
                $value->username,
                $value->amount,
                $value->status,
                $value->category,
                $ops
            );
        }
        return $this->response->setJSON($data);
    }
    // swapfire 
    public function approve()
    {
        $response = array();
        $id = $this->request->getPost('params');
        if ($this->transactionModel->where('id_transaction', $id)->set(['status' => "approved"])->update()) {
            $response['success'] = true;
            $response['messages'] = "Transaction Approved";
        } else {
            $response['success'] = false;
            $response['messages'] = "Transaction Approve Failed";
        }
        return $this->response->setJSON($response);
    }
    public function reject()
    {
        $response = array();
        $id = $this->request->getPost('params');
        if ($this->transactionModel->where('id_transaction', $id)->set(['status' => "rejected"])->update()) {
            $response['success'] = true;
            $response['messages'] = "Transaction Rejected";
        } else {
            $response['success'] = false;
            $response['messages'] = "Transaction Reject Failed";
        }
        return $this->response->setJSON($response);
    }
    public function remove()
    {
        $response = array();

        $id = $this->request->getPost('params');

        if ($this->transactionModel->where('id_transaction', $id)->delete()) {
            $response['success'] = true;
            $response['messages'] = lang("App.delete-success");
        } else {
            $response['success'] = false;
            $response['messages'] = lang("App.delete-error");
        }

        return $this->response->setJSON($response);
    }
}
