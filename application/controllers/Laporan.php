<?php
defined('BASEPATH') or exit('No direct script access allowed');
// done

class Laporan extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->user_login->proteksi_halaman();
		$this->load->model(['m_user', 'm_laporan']);
	}

	// done
	public function index()
	{
		$email = $this->session->userdata('email');
		$data = array(
			'title' => 'Laporan',
			'admin' => $this->m_user->cek_data($email),
			'isi' => 'admin/laporan/v_laporan',
		);
		$this->load->view('layout/backend/v_wrapper_backend', $data, FALSE);
	}

	// done
	public function lap_harian()
	{
		$tanggal = $this->input->post('tanggal');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$data = array(
			'title' => 'Laporan',
			'tanggal' => $tanggal,
			'bulan' => $bulan,
			'tahun' => $tahun,
			'laporan' => $this->m_laporan->lap_harian($tanggal, $bulan, $tahun),
		);
		$this->load->view('admin/laporan/v_lap_harian', $data, FALSE);
	}

	// done
	public function lap_bulanan()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$data = array(
			'title' => 'Laporan',
			'bulan' => $bulan,
			'tahun' => $tahun,
			'laporan' => $this->m_laporan->lap_bulanan($bulan, $tahun),
		);
		$this->load->view('admin/laporan/v_lap_bulanan', $data, FALSE);
	}

	// done
	public function lap_tahunan()
	{
		$tahun = $this->input->post('tahun');
		$data = array(
			'title' => 'Laporan',
			'tahun' => $tahun,
			'laporan' => $this->m_laporan->lap_tahunan($tahun),
		);
		$this->load->view('admin/laporan/v_lap_tahunan', $data, FALSE);
	}
}
