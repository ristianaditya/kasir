<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class kasir extends CI_Model
{
	function logged_id()
	{
		return $this->session->userdata('id_user');
	}

	public function user()
	{
		return $this->db->query("SELECT * FROM data_user_level");
	}  

	function check_login($field1, $field2)
	{
		$query = $this->db->query("CALL validate_login('$field1', '$field2')");
		if ($query->num_rows() == 0) {
			return FALSE;
		} else {
			return $query->result();
		}
	}

	function barcode_login($field1, $field2)
	{
		$query = $this->db->query("CALL barcode_login('$field1', '$field2')");
		if ($query->num_rows() == 0) {
			return FALSE;
		} else {
			return $query->result();
		}
	}

	public function transaksi()
	{
		return $this->db->get('transaksi');
	}

	public function jml_user()
	{
		return $this->db->query("SELECT jml_user() as jml_user")->row();
	}

	public function jml_masakan()
	{
		return $this->db->query("SELECT jml_masakan() as jml_masakan")->row();
	}

	public function jml_pesanan()
	{
		return $this->db->query("SELECT jml_pesanan() as jml_pesanan")->row();
	}

	public function jml_transaksi()
	{
		return $this->db->query("SELECT jml_transaksi() as jml_transaksi")->row();
	}

	public function jml_pesanan_kasir()
	{
		return $this->db->query("SELECT jml_pesanan_kasir() as jml_pesanan")->row();
	}

	public function jml_waiter()
	{
		return $this->db->query("SELECT jml_pesanan_waiter() AS jumlah_pesanan")->row();
	}

	function edit_user($username, $new_password, $confirm_password, $nama_user, $id_level, $id_user)
	{
		return $this->db->query("SELECT edit_user('$username', '$new_password', '$confirm_password', '$nama_user', $id_level, $id_user) as status")->row();
	}

	function tambah_user($nama_user, $user_name, $user_pass, $id_level)
	{
		return $this->db->query("CALL tambah_user('$nama_user', '$user_name', '$user_pass', $id_level)");
	}

	public function masakan()
	{
		return $this->db->get('data_masakan');
	}

	public function save($upload){
		$data = array(
			'nama_masakan' => $this->input->post('nama_masakan'),
			'deskripsi' => $this->input->post('deskripsi'),
			'harga' => $this->input->post('harga'),
			'gambar' => $upload['file']['file_name'],
			'id_kategori'=> $this->input->post('kategori'),
			'status_masakan' => $this->input->post('status_masakan')
		);
	
		$this->db->insert('masakan', $data);
	}

	public function edit($upload, $id_masakan, $gambar1, $nama_masakan, $deskripsi, $harga, $kategori, $status_masakan){
		$sql ="";
		$gambar = $upload['file']['file_name'];

		if($gambar ==''){
	
			$sql = $this->db->query("UPDATE masakan SET id_masakan = '$id_masakan', nama_masakan = '$nama_masakan', deskripsi = '$deskripsi', harga = '$harga' , id_kategori ='$kategori', status_masakan ='$status_masakan'  where id_masakan = '$id_masakan' ");
			return $sql;

		}else{
			$sql = $this->db->query("UPDATE masakan SET id_masakan = '$id_masakan', nama_masakan = '$nama_masakan', deskripsi = '$deskripsi', harga = '$harga' ,  gambar = '$gambar', id_kategori ='$kategori', status_masakan ='$status_masakan'  where id_masakan = '$id_masakan' ");
			return $sql;
		}
	}

	public function soft_delete_masakan($id)
	{
		return $this->db->query("UPDATE masakan SET soft_delete = 0 where id_masakan = '$id'");
	}

	public function waiter()
	{
		return $this->db->query("SELECT * FROM list_pesanan_waiter");
	}

	public function waiter1($id_order)
	{
		return $this->db->query("UPDATE orderan SET keterangan = 'selesai' where id_order = '$id_order' ");
	}

	// ---- Nambah Masakan dengan foto ---- 
	public function upload(){
			$config['upload_path'] = './assets/pelanggan/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['remove_space'] = TRUE;

		$this->load->library('upload', $config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('gambar')){ // Lakukan upload dan Cek jika proses upload berhasil
		// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
		// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}

	public function pesanan_admin()
	{
		return $this->db->query("SELECT * FROM list_pesanan");
	}

	public function view_data($id)
	{
		return $this->db->query("CALL list_detail_pesanan('$id')");
	}

	public function list_pesanan_kasir()
	{
		return $this->db->query("SELECT * FROM list_pesanan_kasir");
	}

	public function trans($id_order, $tanggal, $total_bayar)
	{
		return $this->db->query("CALL transaksi_proses ('$id_order', '$tanggal', '$total_bayar')");

	}

	public function laporan()
	{
		return $this->db->query("SELECT tanggal from transaksi GROUP BY tanggal");
	}


	public function view_lapor($tanggal,$tanggal1)
	{
		return $this->db->query("SELECT * FROM transaksi LEFT JOIN orderan ON orderan.id_order = transaksi.id_order WHERE transaksi.tanggal BETWEEN '$tanggal' AND '$tanggal1' ");
	}



	// ---- Edit Foto Masakan ----

public function eupload(){
	$config['upload_path'] = './assets/pelanggan/';
	$config['allowed_types'] = 'jpg|png|jpeg';
	$config['remove_space'] = TRUE;

    $this->load->library('upload', $config); // Load konfigurasi uploadnya
    if($this->upload->do_upload('gambar')){ // Lakukan upload dan Cek jika proses upload berhasil
      // Jika berhasil :
    	$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
    	return $return;
    }else{
      // Jika gagal :
    	$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
    	return $return;
    }
}

}