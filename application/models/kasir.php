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
		return $this->db->get('user');
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

	// Function Pesanan
	public function pesanan()
	{
		return $this->db->query("SELECT o.no_meja ,o.id_order, m.nama_masakan, m.harga, r.qty, (m.harga * r.qty) AS total_harga FROM orderan o INNER JOIN detail_order r ON o.id_order = r.id_order INNER JOIN masakan m ON r.`id_masakan` = m.`id_masakan` WHERE o.keterangan = 'selesai' AND o.status_order = 'belum selesai' GROUP BY o.id_order");
	}

	public function pesanan_admin()
	{
		return $this->db->query("SELECT o.no_meja ,o.id_order, m.nama_masakan, m.harga, r.qty, (m.harga * r.qty) AS total_harga FROM orderan o INNER JOIN detail_order r ON o.id_order = r.id_order INNER JOIN masakan m ON r.`id_masakan` = m.`id_masakan`
		where o.status_order = 'belum selesai' GROUP BY o.id_order");
	}

	public function view_data($id)
	{
		return $this->db->query("SELECT  r.id_detail_order, o.tanggal, r.keterangan, o.no_meja ,o.id_order, m.nama_masakan, m.harga, r.qty, (m.harga * r.qty) AS total_harga 
		FROM orderan o INNER JOIN detail_order r ON o.id_order = r.id_order 
		INNER JOIN masakan m ON r.`id_masakan` = m.`id_masakan`
		WHERE o.status_order = 'belum selesai' AND r.id_order = '$id'");
	}

	public function trans($no_meja, $id_order, $tanggal, $total_bayar)
	{
		return $this->db->query("INSERT into transaksi (no_meja, id_order, tanggal, total_bayar) Values ('$no_meja', '$id_order', '$tanggal', '$total_bayar')");

	}

	public function o_del($id_order)
	{
		return $this->db->query("UPDATE user SET username='$username', password='$password', nama_user='$nama', id_level='$lvl' WHERE username='$username' ");
	}

	public function edit_a($id_order)
	{
		return $this->db->query("UPDATE orderan SET status_order = 'selesai' where id_order = '$id_order' ");
	}

	public function edit_a1($id_order)
	{
		return $this->db->query("UPDATE detail_order SET status_detail_order = 'selesai' where id_order = '$id_order' ");
	}
	// ----	Edit User ----

	public function laporan()
	{
		return $this->db->query("SELECT * from transaksi group by tanggal");
	}


	public function view_lapor($tanggal,$tanggal1)
	{
		return $this->db->query("SELECT * FROM transaksi WHERE tanggal BETWEEN '$tanggal' AND '$tanggal1' ");
	}

	//SELECT * FROM `transaksi` WHERE `tanggal` BETWEEN '2019-03-23' AND '2019-03-27'

	function edit_user($username, $password, $nama_user, $id_level, $id_user)
	{
		return $this->db->query("UPDATE user SET username = '$username', password = '$password', nama_user = '$nama_user', id_level = '$id_level' WHERE id_user = '$id_user' ");
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

public function waiter()
{
	return $this->db->query("SELECT  o.no_meja ,o.id_order, r.nama_masakan, r.harga, r.qty, (r.harga * r.qty) as total_harga FROM orderan o INNER join detail_order r ON o.id_order = r.id_order where o.keterangan = 'dibuat' AND o.status_order = 'belum selesai' group by o.id_order");
}

public function waiter1($id_transaksi, $tanggal, $id_order, $no_meja, $total_bayar)
{
	return $this->db->query("UPDATE orderan SET keterangan = 'selesai' where id_order = '$id_order' ");
}

public function waiter2($id_transaksi, $tanggal, $id_order, $no_meja, $total_bayar)
{
	return $this->db->query("UPDATE detail_order SET keterangan = 'selesai' where id_order = '$id_order' ");
}

public function save($upload){
	$data = array(
		'nama_masakan' => $this->input->post('nama_masakan'),
		'deskripsi' => $this->input->post('deskripsi'),
		'harga' => $this->input->post('harga'),
		'gambar' => $upload['file']['file_name'],
		'kategori'=> $this->input->post('kategori'),
		'status_masakan' => $this->input->post('status_masakan')
	);

	$this->db->insert('masakan', $data);
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

public function edit($upload, $id_masakan, $gambar1, $nama_masakan, $deskripsi, $harga, $kategori, $status_masakan){
	$cek = $this->db->query("SELECT gambar from masakan where id_masakan = '$id_masakan'");

	 $gambar = $upload['file']['file_name'];
	if($gambar ==''){

		$sql = $this->db->query("UPDATE masakan SET id_masakan = '$id_masakan', nama_masakan = '$nama_masakan', deskripsi = '$deskripsi', harga = '$harga' , kategori ='$kategori', status_masakan ='$status_masakan'  where id_masakan = '$id_masakan' ");
		return $sql;

		 // or die (mysql_error());
	}else{

		$sql = $this->db->query("UPDATE masakan SET id_masakan = '$id_masakan', nama_masakan = '$nama_masakan', deskripsi = '$deskripsi', harga = '$harga' ,  gambar = '$gambar', kategori ='$kategori', status_masakan ='$status_masakan'  where id_masakan = '$id_masakan' ");
		return $sql;
	}
	if ($sql) {
                                //jika  berhasil tampil ini
		echo '<script>alert("DATA BERHASIL DIUBAH");</script>';
	} else {
                                // jika gagal tampil ini
		echo '<script>alert("DATA GAGAL DIUBAH");</script>';
	}
}

public function cetakk($id_order, $total_bayar,$no_meja){
// Wherever you want to invoke the print from
// Maybe a model, controller or other library/helper
	 $apa = $this->db->query("SELECT  r.id_detail_order, o.tanggal, r.keterangan, o.no_meja ,o.id_order, r.nama_masakan, r.harga, r.qty, (r.harga * r.qty) as total_harga FROM orderan o INNER join detail_order r ON o.id_order = r.id_order where o.status_order = 'belum selesai' AND r.id_order = '$id_order' ");

	try {
		$this->load->library('ReceiptPrint');
		$this->receiptprint->connect("XP581");
		$this->receiptprint->print_test_receipt($apa, $total_bayar,$no_meja);
	} catch (Exception $e) {
		log_message("error", "Error: Could not print. Message ".$e->getMessage());
		$this->receiptprint->close_after_exception();
	}
}

}