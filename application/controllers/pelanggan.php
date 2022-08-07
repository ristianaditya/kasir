<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pelanggan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('id_level') !== '5') {
			redirect('login');
		}
		$this->load->library('cart');
		$this->load->model('keranjang_model');
		$this->load->model('kasir');

	}

	public function index()
	{
		if($this->kasir->logged_id())	
		{
			$kategori=($this->uri->segment(3))?$this->uri->segment(3):1;
			$data['kategori'] = $this->keranjang_model->get_kategori_all();
			$data['produk'] = $this->keranjang_model->get_produk_kategori($kategori);
			$this->load->view('pelanggan/dashboard1',$data);
		}else{

			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");

		}

	}

	function tambah()
	{
		$data_produk= array('id' => $this->input->post('id'),
			'name' => $this->input->post('nama'),
			'price' => $this->input->post('harga'),
			'gambar' => $this->input->post('gambar'),
			'qty' =>$this->input->post('qty')
		);
		$this->cart->insert($data_produk);
		redirect('pelanggan');
	}


	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

	public function tampil_cart()
	{

		$data['kategori'] = $this->keranjang_model->get_kategori_all();
		$this->load->view('pelanggan/tampil_cart',$data);
	}
	
	public function check_out()
	{
		$data['kategori'] = $this->keranjang_model->get_kategori_all();
		$this->load->view('index.php/pelanggan/check_out',$data);
	}
	
	public function detail_produk()
	{
		$id=($this->uri->segment(3))?$this->uri->segment(3):0;
		$data['kategori'] = $this->keranjang_model->get_kategori_all();
		$data['detail'] = $this->keranjang_model->get_produk_id($id)->row_array();
		$this->load->view('pelanggan/detail_produk',$data);
	}

	function hapus($rowid) 
	{
		if ($rowid=="all")
		{
			$this->cart->destroy();
		}
		else
		{
			$data = array('rowid' => $rowid,
				'qty' =>0);
			$this->cart->update($data);
		}
		redirect('pelanggan');
	}

	function ubah_cart()
	{
		$cart_info = $_POST['cart'] ;
		foreach( $cart_info as $id => $cart)
		{
			$rowid = $cart['rowid'];
			$price = $cart['price'];
			$gambar = $cart['gambar'];
			$amount = $price * $cart['qty'];
			$qty = $cart['qty'];
			$data = array('rowid' => $rowid,
				'price' => $price,
				'gambar' => $gambar,
				'amount' => $amount,
				'qty' => $qty);
			$this->cart->update($data);
		}
		redirect('pelanggan/tampil_cart');
	}

	public function proses_order()
	{
		//------------------Input data order---------------------
		$data_order = array(
			'no_meja' => $this->session->userdata("user_nama"),
			'tanggal' => date('Y-m-d'),
			'id_user' =>$this->session->userdata("id_user"),
			'keterangan' => 'dibuat',
			'status_order' => 'belum selesai');
		$id_order = $this->keranjang_model->tambah_order($data_order);
		//-------------------------Input data detail_order-------
		if ($cart = $this->cart->contents())
		{
			foreach ($cart as $item)
			{
				$data_dorder = array(
					'id_order' => $id_order,
					'id_masakan' => $item['id'],
					'qty' => $item['qty']);
				$proses = $this->keranjang_model->tambah_dorder($data_dorder);
			}
		}
		$this->cart->destroy();
		$_SESSION['pesan'] = 'Pesanan Berhasil !';
		$data['kategori'] = $this->keranjang_model->get_kategori_all();
		redirect('pelanggan',$data);
	}
}
?>

