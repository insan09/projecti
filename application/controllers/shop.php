<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class shop extends CI_Controller {

    function index() {
        $this->load->model('Products_model');
        $data['products'] = $this->Products_model->get_all();
        $this->load->view('products', $data);
    }

    function add() {

        $this->load->model('Products_model');

        $product = $this->Products_model->get($this->input->post('id'));

        $insert = array(
            'id' => $this->input->post('id'),
            'qty' => $this->input->post('qty'),
            'price' => $product->harga,
            'name' => $product->nama
        );
        if ($product->nama_pilihan) {
            $insert['options'] = array(
                $product->nama_pilihan => $product->nilai_pilihan[$this->input->post($product->nama_pilihan)]
            );
        }

        $this->cart->insert($insert);

        redirect('shop');
    }

    function remove($rowid) {
        $this->cart->update(array(
            'rowid' => $rowid,
            'qty' => 0
        ));

        redirect('shop');
    }

}

?>