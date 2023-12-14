<?php

defined('BASEPATH') or exit('No direct script access allowed');
// done
class Jadwal extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->user_login->proteksi_halaman();
		$this->load->model(['m_user', 'm_home', 'm_peserta', 'm_paket', 'm_jadwal', 'm_instruktur']);
	}

	// done
	public function jadwal_peserta()
	{
		$id_user = $this->session->userdata('id_user');
		$email = $this->session->userdata('email');
		$value = $this->m_jadwal->get_jadwal_peserta($id_user);
		if ($value) {
			$data = array(
				'title' => 'B I S T I R | My Jadwal ',
				'user' => $this->m_user->cek_data($email),
				'jadwal' => $this->m_jadwal->get_jadwal_peserta($id_user),
				'data_peserta' => $this->m_peserta->get_peserta($id_user),
				'isi' => 'peserta/v_my_jadwal',
			);
		} elseif ($this->m_jadwal->get_jadwal_peserta_pending($id_user)) {
			$data = array(
				'title' => 'B I S T I R | My Jadwal ',
				'user' => $this->m_user->cek_data($email),
				'jadwal' => $this->m_jadwal->get_jadwal_peserta_pending($id_user),
				'data_peserta' => $this->m_peserta->get_peserta($id_user),
				'isi' => 'peserta/v_my_jadwal',
			);
		} elseif ($this->m_jadwal->get_jadwal_peserta_bayar($id_user)) {
			$data = array(
				'title' => 'B I S T I R | My Jadwal ',
				'user' => $this->m_user->cek_data($email),
				'jadwal' => $this->m_jadwal->get_jadwal_peserta_bayar($id_user),
				'data_peserta' => $this->m_peserta->get_peserta($id_user),
				'isi' => 'peserta/v_my_jadwal',
			);
		} elseif ($this->m_jadwal->get_jadwal_peserta_aktif($id_user)) {
			$data = array(
				'title' => 'B I S T I R | My Jadwal ',
				'user' => $this->m_user->cek_data($email),
				'jadwal' => $this->m_jadwal->get_jadwal_peserta_aktif($id_user),
				'data_peserta' => $this->m_peserta->get_peserta($id_user),
				'isi' => 'peserta/v_my_jadwal_aktif',
			);
		} else {
			$data = array(
				'title' => 'B I S T I R | My Jadwal ',
				'user' => $this->m_user->cek_data($email),
				'peserta' => $this->m_peserta->get_peserta($id_user),
				'isi' => 'peserta/v_my_jadwal_off',
			);
		}

		$this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
	}

	// done
	public function jadwal_instruktur()
	{
		$id_user = $this->session->userdata('id_user');
		$email = $this->session->userdata('email');
		$value = $this->m_jadwal->get_jadwal_instruktur();
		if ($value) {
			$data = array(
				'title' => 'B I S T I R | My Jadwal ',
				'user' => $this->m_user->cek_data($email),
				'jadwal' => $this->m_jadwal->get_jadwal_instruktur(),
				'data_instruktur' => $this->m_instruktur->get_instruktur($id_user),
				'isi' => 'instruktur/v_my_jadwal',
			);
		} else {
			$data = array(
				'title' => 'B I S T I R | My Jadwal ',
				'data_instruktur' => $this->m_instruktur->get_instruktur($id_user),
				'user' => $this->m_user->cek_data($email),
				'isi' => 'instruktur/v_my_jadwal_off',
			);
		}

		$this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
	}

	// done
	public function jadwal_instruktur_aktif()
	{
		$email = $this->session->userdata('email');
		$id_user = $this->session->userdata('id_user');
		$value = $this->m_jadwal->get_jadwal_instruktur_aktif($id_user);
		if ($value) {
			$data = array(
				'title' => 'B I S T I R | My Jadwal ',
				'user' => $this->m_user->cek_data($email),
				'jadwal' => $this->m_jadwal->get_jadwal_instruktur_aktif($id_user),
				'data_instruktur' => $this->m_instruktur->get_instruktur($id_user),
				'isi' => 'instruktur/v_my_jadwal',
			);
		} else {
			$data = array(
				'title' => 'B I S T I R | My Jadwal ',
				'data_instruktur' => $this->m_instruktur->get_instruktur($id_user),
				'user' => $this->m_user->cek_data($email),
				'isi' => 'instruktur/v_my_jadwal_off',
			);
		}

		$this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
	}

	// done
	public function daftar_jadwal_peserta()
	{
		$email = $this->session->userdata('email');
		$data = array(
			'title' => 'B I S T I R | My Jadwal ',
			'sub_title' => 'Daftar Jadwal',
			'user' => $this->m_user->cek_data($email),
			'user_peserta' => $this->m_peserta->get_all_data(),
			'paket' => $this->m_paket->get_all_data(),
			'isi' => 'peserta/v_daftar_jadwal',
		);
		$this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
	}

	// done
	public function add_jadwal()
	{
		$this->form_validation->set_rules(
			'id_peserta',
			'Anda',
			'required',
			array(
				'required' => '%s Belum mengisi form pendaftaran !!!!'
			)
		);
		$this->form_validation->set_rules(
			'jam_latihan',
			'Jam Latihan',
			'required',
			array(
				'required' => '%s Harus Diisi !!!!'
			)
		);
		$this->form_validation->set_rules(
			'tgl_latihan',
			'Tanggal Latihan',
			'required',
			array(
				'required' => '%s Harus Diisi !!!!'
			)
		);
		$this->form_validation->set_rules(
			'id_paket',
			'Paket',
			'required',
			array(
				'required' => '%s Belum dipilih !!!!'
			)
		);

		$id_user = $this->session->userdata('id_user');
		$email = $this->session->userdata('email');
		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'title' => 'B I S T I R | Daftar ',
				'user' => $this->m_user->cek_data($email),
				'user_peserta' => $this->m_peserta->get_all_data(),
				'paket' => $this->m_paket->get_all_data(),
				'isi' => 'peserta/v_daftar_jadwal',
			);
			$this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
		} else {
			$data = array(

				'id_user_peserta' => $id_user,
				'id_peserta' => $this->input->post('id_peserta'),
				'id_paket' => $this->input->post('id_paket'),
				'kode_jadwal' => $this->input->post('kode_jadwal'),
				'tgl_latihan' => $this->input->post('tgl_latihan'),
				'jam_latihan' => $this->input->post('jam_latihan'),
				'total_bayar' => $this->input->post('total_bayar'),
				'status_bayar' => '0',
				'tgl_jadwal' => date('Y-m-d'),
				'status_jadwal' => '0',

			);
			$this->m_jadwal->simpan_jadwal($data);

			// simpan ke tabel rinci transaksi
			$data_rinci = array(
				'kode_jadwal' => $this->input->post('kode_jadwal'),
				'id_peserta' => $this->input->post('id_peserta'),
				'id_paket' => $this->input->post('id_paket'),
			);
			$this->m_jadwal->simpan_rinci_jadwal($data_rinci);

			$this->session->set_flashdata('pesan', 'Jadwal berhasil ditambahkan!');
			redirect('jadwal/jadwal_peserta');
		}


		$data = array(
			'title' => 'B I S T I R | My Jadwal ',
			'user' => $this->m_user->cek_data(['email' => $this->session->userdata('email')])->row_array(),
			'user_peserta' => $this->m_peserta->get_all_data(),
			'paket' => $this->m_paket->get_all_data(),
			'isi' => 'peserta/v_daftar_jadwal',
		);
		$this->load->view('layout/frontend/v_wrapper_frontend', $data, FALSE);
	}
}

/* End of file Jadwal.php */
