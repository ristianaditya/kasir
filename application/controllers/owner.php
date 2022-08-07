<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class owner extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('id_level') !== '4') {
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
			$data['transaksi']=$this->kasir->transaksi()->num_rows();
			$this->load->view('heater/header');
			$this->load->view('owner/dashboard',$data);
			$this->load->view('heater/footer');
		}else{

			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");

		}
	}

	public function laporan()
	{
		if($this->kasir->logged_id())	
		{
			$data['lap'] = $this->kasir->laporan();
			$this->load->view('heater/header');
			$this->load->view('owner/laporan',$data);
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
			$this->load->view('owner/data', $data);
			$this->load->view('heater/footer');
		}else {
			echo "Ada Kesalahan saat mengambil data !!!";
		}
	}

	public function view_lapor()
	{
		if (isset($_POST['cari'])) {
			$data['lapor']	 = $this->kasir->view_lapor($this->input->post('tanggal'),$this->input->post('tanggal1'));
			$this->load->view('heater/header');
			$this->load->view('owner/data1', $data);
			$this->load->view('heater/footer');
		}else {
			echo "Ada Kesalahan saat mengambil data !!!";
		}
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
	$this->load->view('owner/transaksi',$data);
	$this->load->view('heater/footer');
}

public function laporanpenjualan(){
	$id_transaksi =$this->input->post('id_transaksi');
	$tanggal =$this->input->post('tanggal');
	$id_order =$this->input->post('id_order');
	$no_meja =$this->input->post('no_meja');
	$total_bayar =$this->input->post('total_bayar');
	$tanggal1 = $this->input->post('tanggal1');
	$cet = $this->db->query("SELECT * FROM transaksi LEFT JOIN orderan ON transaksi.id_order = orderan.id_order ");

	$pdf = new FPDF("P","mm","A4");
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',13);
	$pdf->Cell(45);
	$pdf->Cell(100,0,'Laporan Data Penjualan '.$tanggal.' - '.$tanggal1.' '  ,0,0,'C');
	$pdf->Ln(5);
	$pdf->SetFont('Arial','',10);
	$pdf->SetFillColor(100,0,0);
	$pdf->SetTextColor(255);
	$pdf->SetDrawColor(0,0,0);
	$header = array('Id_trans', 'Id Order', 'No Meja', 'Total Harga');
        // Lebar Header Sesuaikan Jumlahnya dengan Jumlah Field Tabel Database
	$w = array(47.5, 47.5, 47.5, 47.5);
	for($i=0;$i<count($header);$i++)
		$pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
	$pdf->Ln();
	$fill = false; // Data
	$pdf->SetFillColor(224,235,255);
	$pdf->SetTextColor(0);
	$pdf->SetFont('');

	foreach ($cet->result_array() as $i):
		$id_transaksi = $i['id_transaksi'];
		$tanggal = $tanggal;
		$id_order = $i['id_order'];
		$no_meja = $i['no_meja'];
		$total_bayar = $i['total_bayar'];
		$tanggal12 = $tanggal1;

		$pdf->Cell($w[0],6,$id_transaksi,'LR',0,'L',$fill); 
		$pdf->Cell($w[1],6,$id_order,'LR',0,'L',$fill);
		$pdf->Cell($w[2],6,$no_meja,'LR',0,'L',$fill);
		$pdf->Cell($w[3],6,$total_bayar,'LR',0,'L',$fill);
		
		$pdf->Ln();
		$fill = !$fill;
	endforeach;
	$pdf->Cell(array_sum($w),0,'','T');

	return $pdf->Output();

}

public function cetakk(){
// Wherever you want to invoke the print from
// Maybe a model, controller or other library/helper

	try {
		$this->load->library('ReceiptPrint');
		$this->receiptprint->connect("XP58");
		$this->receiptprint->print_test_receipt('Enak CUy ');
	} catch (Exception $e) {
		log_message("error", "Error: Could not print. Message ".$e->getMessage());
		$this->receiptprint->close_after_exception();
	}
}

}