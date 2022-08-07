<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kasir1 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('id_level') !== '3') {
			redirect('login');
		}
		$this->load->model('kasir');
	}

	public function index()
	{
		if($this->kasir->logged_id())	
		{
			$data['transaksi']=$this->kasir->jml_pesanan_kasir()->jml_pesanan;

			$this->load->view('heater/header');
			$this->load->view('kasir/dashboard',$data);
			$this->load->view('heater/footer');
		}else{

			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");

		}

	}

	public function s_pesanan()
	{

		$id_order = $this->input->post('id_order');
		$tanggal = $this->input->post('tanggal');
		$total_bayar = $this->input->post('total_bayar');
		$trans = $this->kasir->trans( $id_order, $tanggal, $total_bayar);
		redirect ('kasir1/pesanan');

	}


	public function pesanan()
	{
		if($this->kasir->logged_id())	
		{
			$data['pes'] = $this->kasir->list_pesanan_kasir();
			$this->load->view('heater/header');
			$this->load->view('kasir/pesanan',$data);
			$this->load->view('heater/footer');
		}else{

				//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");

		}
	}	

	public function view_data()
	{
		if (isset($_POST['cari'])) {
			$data['pesan']	 = $this->kasir->view_data($this->input->post('id_order'));
			$this->load->view('heater/header');
			$this->load->view('kasir/data', $data);
			$this->load->view('heater/footer');
		}else {
			echo "Ada Kesalahan saat mengambil data !!!";
		}
	}
}