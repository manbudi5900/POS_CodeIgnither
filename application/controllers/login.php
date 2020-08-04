<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
    class login extends CI_Controller{
    	public function __construct() {
            parent::__construct();
        if ($this->session->userdata('username')=="") {
            redirect('Kasir');
        }
        $this->load->helper('text');
    }
    public function index() {
        
        $this->load->model('M_barang');
        $data['barang'] = $this->M_barang->get();
        $data['anggota'] = $this->M_barang->getA1();
        $this->load->view('penjualan/transaksi',$data);
       
    }

    public function logout() {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('level');
        session_destroy();
        redirect('Kasir');
    }
}

?>