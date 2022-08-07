<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('id_level') !== '1') {
			redirect('login');
		}

		$this->load->model('kasir');
	}

	public function index()
	{
		if($this->kasir->logged_id())	
		{
			$data['user']=$this->kasir->jml_user()->jml_user;
			$data['masakan']=$this->kasir->jml_masakan()->jml_masakan;
			$data['transaksi']=$this->kasir->jml_transaksi()->jml_transaksi;
			$this->load->view('heater/header');
			$this->load->view('admin/dashboard',$data);
			$this->load->view('heater/footer');
		}else{

			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");

		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

	public function manage()
	{
		if($this->kasir->logged_id())	
		{
			$data['cek']=$this->kasir->user();
			$this->load->view('heater/header');
			$this->load->view('admin/manage',$data);
			$this->load->view('heater/footer');
		}else{

			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");

		}
	}

	public function edituser(){

		$username = $this->input->post('username');
		$new_password = $this->input->post('new_password');
		$confirm_password = $this->input->post('confirm_password');
		$nama_user = $this->input->post('nama_user');
		$id_level = $this->input->post('id_level');
		$id_user = $this->input->post('id_user');
		
		$this->kasir->edit_user($username, $new_password, $confirm_password, $nama_user, $id_level, $id_user);
		redirect('admin/manage');
	}

	public function hakplus(){
		$nama_user = $this->input->post('nama_user');
		$user_name = $this->input->post('username');
		$user_pass = $this->input->post('password');
		$id_level = $this->input->post('id_level');

		$this->kasir->tambah_user($nama_user, $user_name, $user_pass, $id_level);
		redirect('admin/manage');
	}	

	public function masakan()
	{
		if($this->kasir->logged_id())	
		{
			$data['mas']=$this->kasir->masakan();
			$this->load->view('heater/header');
			$this->load->view('admin/masakan',$data);
			$this->load->view('heater/footer');
		}else{

			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");

		}
	}

	public function tambah_masakan(){
		$data = array();
	
		if($this->input->post('submit')){ // Jika user menekan tombol Submit (Simpan) pada form
			// lakukan upload file dengan memanggil function upload yang ada di kasir.php
				$upload = $this->kasir->upload();
				
			if($upload['result'] == "success"){ // Jika proses upload sukses
				// Panggil function save yang ada di kasir.php untuk menyimpan data ke database
				$this->kasir->save($upload);
				
				redirect('admin/masakan'); // Redirect kembali ke halaman awal / halaman view data
			}else{ // Jika proses upload gagal
				$data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}
		redirect ('admin/masakan');
	}

	public function edit_masakan(){

		$data = array();
	
		if($this->input->post('submit')){ // Jika user menekan tombol Submit (Simpan) pada form
			// lakukan upload file dengan memanggil function upload yang ada di kasir.php
				$upload = $this->kasir->eupload();
				$id_masakan = $this->input->post('id_masakan');
				$nama_masakan = $this->input->post('nama_masakan');
				$gambar1 = $this->input->post('gambar');
				$deskripsi = $this->input->post('deskripsi');
				$harga = $this->input->post('harga');
				$kategori = $this->input->post('kategori');
				$status_masakan = $this->input->post('status_masakan');
				
				$this->kasir->edit($upload, $id_masakan,$gambar1, $nama_masakan, $deskripsi, $harga, $kategori, $status_masakan);
				// Panggil function save yang ada di kasir.php untuk menyimpan data ke database
			if($upload['result'] == "success"){ // Jika proses upload sukses
				redirect('admin/masakan'); // Redirect kembali ke halaman awal / halaman view data
			}else{ // Jika proses upload gagal
				$data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}
		redirect ('admin/masakan');
	}

	public function hapus_masakan($id)
	{
		$this->kasir->soft_delete_masakan($id);
		redirect('admin/masakan');
	}

	public function pesanan()
	{
		if($this->kasir->logged_id())	
		{
			$data['pes'] = $this->kasir->pesanan_admin();
			$this->load->view('heater/header');
			$this->load->view('admin/pesanan',$data);
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
			$this->load->view('admin/data', $data);
			$this->load->view('heater/footer');
		}else {
			echo "Ada Kesalahan saat mengambil data !!!";
		}
	}

	public function s_pesanan()
	{
		$id_order = $this->input->post('id_order');
		$tanggal = $this->input->post('tanggal');
		$total_bayar = $this->input->post('total_bayar');
		$trans = $this->kasir->trans( $id_order, $tanggal, $total_bayar);
		redirect('admin/pesanan');
	}


public function alldata(){	
	$id_order = $this->input->post('kode');
	$data = $this->kasir->detail($id_order)->result();
	echo json_encode($data);
}

public function transaksi()
{
	$data['tran']=$this->kasir->transaksi();
	$this->load->view('heater/header');
	$this->load->view('admin/transaksi',$data);
	$this->load->view('heater/footer');
}

public function hapususer($id)
{
	$where = array(
		'id_user' => $id
	);
	$this->db->where($where);
	$this->db->delete('user');
	redirect('admin/manage');
}

function hapuspes($nama_mas,$id_d)
{
	$this->db->query("DELETE orderan, detail_order FROM orderan , detail_order WHERE orderan.id_order = detail_order.id_order AND detail_order.nama_masakan = '$nama_mas' AND detail_order.id_detail_order = '$id_d'");
	redirect('admin/pesanan');
}
}
