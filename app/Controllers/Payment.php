<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;

class Payment extends BaseController
{
    protected $transaction;
    protected $transactionModel;
    protected $db;
    public function __construct()
    {
        Config::$serverKey = 'SB-Mid-server-nNS3EILyAfaF_Ovt9TF4lzeA';
        Config::$clientKey = 'SB-Mid-client-KpsIaNJcMWQUc-to';
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
        $this->transaction = new \Midtrans\Transaction();
        $this->transactionModel = new TransactionModel();
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        if ($this->request->getPost()) {
            $fields['id_transaction'] = 'ORD-' . substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 5) . random_int(1, 2000);
            $fields["amount"] = $this->request->getPost("amount");
            $fields["server_id"] = $this->request->getPost("server_id");
            $fields['user_id'] = $this->request->getPost("user_id");
            $fields['username'] = $this->request->getPost("username");
            $fields['email'] = $this->request->getPost("email");
            $fields['category'] = $this->request->getPost("category");
            $fields['status'] = "pending";
            $transaction_params = array(
                'transaction_details' => array(
                    'order_id' => $fields['id_transaction'],
                    'gross_amount' => $fields['amount'],

                )
            );
            $this->transactionModel->insert($fields);
            $snapurl = Snap::getSnapUrl($transaction_params);
            return redirect()->to($snapurl);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }
    public function finish()
    {
        session()->setFlashdata('success', "Transaction Made");
        return redirect()->to(base_url());
    }
    public function unfinish()
    {
        session()->setFlashdata('errors', "Transaction Unfinished");
        return redirect()->to(base_url());
    }
    public function error()
    {
        session()->setFlashdata('errors', "Transaction Error");
        return redirect()->to(base_url());
    }
    public function checkTransaction()
    {
    }
    public function notification()
    {
        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result, "true");
        $order_id = $result['order_id'];
        if ($result['transaction_status'] == 'settlement' || $result['transaction_status'] == 'capture') {
            $fields['status'] = "success";
            $this->transactionModel->update($order_id, $fields);
        } else {
            $fields['status'] = $result['transaction_status'];
            $this->transactionModel->update($order_id, $fields);
        }
    }
    public function status()
    {
        $data = [
            'title' => "Cek Status",
        ];
        if ($this->request->getPost("id")) {
            $id = $this->request->getPost("id");
            $data = [
                'title' => "Cek Status",
                'result' => $this->transactionModel->where('id_transaction', $id)->first(),
            ];
        }
        return view('client/cektransaksi', $data);
    }
    public function cekStatus()
    {

        if ($this->request->getPost("id")) {
            $id = $this->request->getPost("id");
            $data = [
                'title' => "Cek Status",
                'result' => $this->transactionModel->where('id_transaction', $id)->first(),
            ];
            return view('client/cektransaksi_result', $data);
        }
    }
}
