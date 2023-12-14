<?php


defined('BASEPATH') or exit('No direct script access allowed');
// done
class Courses extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->user_login->proteksi_halaman();
		$this->load->model(['m_user', 'm_paket', 'm_mobil']);
	}

	// done
	public function paket()
	{
		$email = $this->session->userdata('email');
		$data = array(
			'title' => 'B I S T I R | Home',
			'sub_title' => 'Courses',
			'sub_heading' => 'Paket & Mobil',
			'paket' => $this->m_paket->get_all_data(),
			'mobil' => $this->m_mobil->get_all_data(),
			'user' => $this->m_user->cek_data($email),
			'isi' => 'paket/v_paket',
		);

		$this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
	}

	// done
	public function rinci_paket($id_paket = NULL)
	{
		$email = $this->session->userdata('email');
		$data = array(
			'title' => 'Courses Paket',
			'paket' => $this->m_paket->get_data($id_paket),
			'isi' => 'paket/v_rinci_paket',
			'user' => $this->m_user->cek_data($email),


		);
		$this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
	}

	// done
	public function rinci_mobil($id_mobil = NULL)
	{
		$email = $this->session->userdata('email');
		$data = array(
			'title' => 'Courses Mobil',
			'sub_title' => 'Rinci Mobil',
			'mobil' => $this->m_mobil->get_data($id_mobil),
			'isi' => 'paket/v_rinci_mobil',
			'user' => $this->m_user->cek_data($email),

		);
		$this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
	}
}

/* End of file Controllername.php */
