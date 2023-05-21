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
        // Config::$serverKey = 'SB-Mid-server-nNS3EILyAfaF_Ovt9TF4lzeA';
        // Config::$clientKey = 'SB-Mid-client-KpsIaNJcMWQUc-to';
        // Config::$isProduction = false;
        // Config::$isSanitized = true;
        // Config::$is3ds = true;
        // $this->transaction = new \Midtrans\Transaction();
        $this->transactionModel = new TransactionModel();
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        $query   = $this->db->query("SELECT * FROM admin where username = 'admin' LIMIT 1");
        $result = $query->getResult();
        $nomorAdmin = $result[0]->password;
        if ($this->request->getPost()) {
            $fields['id_transaction'] = random_int(100000, 999999);
            $fields["amount"] = $this->request->getPost("amount");
            $fields["server_id"] = $this->request->getPost("server_id");
            $fields['user_id'] = $this->request->getPost("user_id");
            $fields['username'] = $this->request->getPost("username");
            $fields['email'] = $this->request->getPost("email");
            $fields['category'] = $this->request->getPost("category");
            $fields['status'] = "pending";
            $this->transactionModel->insert($fields);
            return redirect()->to("https://wa.me/6281259188983?text=Hallo%20Admin,%20saya%20sudah%20melakukan%20pesanan%20dengan%20detail%20berikut:%0A*Order number:%20" . $fields['id_transaction'] . "*%0A*Amount:%20Rp." . number_format($fields["amount"]) . "*");
            // midtrans
            // $transaction_params = array(
            //     'transaction_details' => array(
            //         'order_id' => $fields['id_transaction'],
            //         'gross_amount' => $fields['amount'],

            //     )
            // );
            // $snapurl = Snap::getSnapUrl($transaction_params);
            // return redirect()->to($snapurl);
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
            $find = $this->transactionModel->where('id_transaction', $id)->first();
            if ($find) {
                $data = [
                    'title' => "Cek Status",
                    'result' => $find,
                ];
                return view('client/cektransaksi_result', $data);
            } else {
                session()->setFlashdata('errors', "Transaction ID Not Found");
                return redirect()->to(base_url('payment/status'));
            }
        }
    }
    // public function finish()
    // {
    //     session()->setFlashdata('success', "Transaction Made");
    //     return redirect()->to(base_url());
    // }
    // public function unfinish()
    // {
    //     session()->setFlashdata('errors', "Transaction Unfinished");
    //     return redirect()->to(base_url());
    // }
    // public function error()
    // {
    //     session()->setFlashdata('errors', "Transaction Error");
    //     return redirect()->to(base_url());
    // }

    // public function notification()
    // {
    //     $json_result = file_get_contents('php://input');
    //     $result = json_decode($json_result, "true");
    //     $order_id = $result['order_id'];
    //     if ($result['transaction_status'] == 'settlement' || $result['transaction_status'] == 'capture') {
    //         $fields['status'] = "success";
    //         $this->transactionModel->update($order_id, $fields);
    //     } else {
    //         $fields['status'] = $result['transaction_status'];
    //         $this->transactionModel->update($order_id, $fields);
    //     }
    // }


}
