<?php

use GuzzleHttp\Client;

defined('BASEPATH') or exit('No direct script access allowed');

class M_jadwal extends CI_Model
{

        private $_client;

        public function __construct()
        {
                $this->_client = new Client([
                        'base_uri' => 'http://localhost/mysite/restful_server/api/',
                ]);
        }
        public function simpan_jadwal($data)
        {
                $response = $this->_client->request(
                        'POST',
                        'jadwal_peserta',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_user_peserta' => $data['id_user_peserta'],
                                        'id_peserta' => $data['id_peserta'],
                                        'id_paket' => $data['id_paket'],
                                        'kode_jadwal' => $data['kode_jadwal'],
                                        'tgl_latihan' => $data['tgl_latihan'],
                                        'jam_latihan' => $data['jam_latihan'],
                                        'total_bayar' => $data['total_bayar'],
                                        'status_bayar' => $data['status_bayar'],
                                        'tgl_jadwal' => $data['tgl_jadwal'],
                                        'status_jadwal' => $data['status_jadwal'],

                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }

        public function get_jadwal_peserta($id_user)
        {

                $response = $this->_client->request(
                        'GET',
                        'jadwal_peserta/jadwal',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya',
                                        'id_user' => $id_user
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());
                return $result;
        }

        public function get_jadwal_peserta_bayar($id_user)
        {
                $response = $this->_client->request(
                        'GET',
                        'jadwal_peserta/jadwal_bayar',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya',
                                        'id_user' => $id_user
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());
                return $result;
        }

        public function get_jadwal_peserta_pending($id_user)
        {
                $response = $this->_client->request(
                        'GET',
                        'jadwal_peserta/jadwal_pending',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya',
                                        'id_user' => $id_user
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());
                return $result;
        }


        public function get_jadwal_peserta_aktif($id_user)
        {
                $response = $this->_client->request(
                        'GET',
                        'jadwal_peserta/jadwal_aktif',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya',
                                        'id_user' => $id_user
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());
                return $result;
        }

        public function get_jadwal_instruktur()
        {

                $response = $this->_client->request(
                        'GET',
                        'jadwal_instruktur/jadwal',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya',
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());
                return $result;
        }
        public function get_jadwal_instruktur_aktif($id_user)
        {
                $response = $this->_client->request(
                        'GET',
                        'jadwal_instruktur/jadwal_aktif',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya',
                                        'id_user' => $id_user
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());
                return $result;
        }

        public function my_jadwal($id_jadwal)
        {
                $response = $this->_client->request(
                        'GET',
                        'jadwal_peserta/bayar_peserta',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya',
                                        'id_jadwal' => $id_jadwal
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());
                return $result;
        }

        public function detail_jadwal($id_jadwal)
        {
                $response = $this->_client->request(
                        'GET',
                        'jadwal/detail_jadwal',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya',
                                        'id_jadwal' => $id_jadwal
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());
                return $result;
        }

        public function cek_jadwal($id_jadwal)
        {
                $response = $this->_client->request(
                        'GET',
                        'jadwal/cek_bukti',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya',
                                        'id_jadwal' => $id_jadwal
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }

        public function bank()
        {
                $response = $this->_client->request(
                        'GET',
                        'jadwal_peserta/bank',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya',
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());
                return $result;
        }

        public function get_all_data()
        {
                $this->db->select('*');
                $this->db->from('tbl_jadwal');
                $this->db->join('tbl_peserta', 'tbl_peserta.id_peserta = tbl_jadwal.id_peserta', 'left');
                $this->db->join('tbl_instruktur', 'tbl_instruktur.id_instruktur = tbl_jadwal.id_instruktur', 'left');
                $this->db->join('tbl_paket', 'tbl_paket.id_paket = tbl_jadwal.id_paket', 'left');
                $this->db->order_by('tbl_jadwal.id_jadwal', 'desc');

                return $this->db->get()->result();
        }
        public function get_data()
        {
                $response = $this->_client->request(
                        'GET',
                        'jadwal/data',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya'
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }
        public function get_data_belum_bayar()
        {
                $response = $this->_client->request(
                        'GET',
                        'jadwal/data_belum_bayar',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya'
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }
        public function get_data_sudah_bayar()
        {
                $response = $this->_client->request(
                        'GET',
                        'jadwal/data_sudah_bayar',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya'
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }
        public function get_data_pending()
        {
                $response = $this->_client->request(
                        'GET',
                        'jadwal/data_pending',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya'
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }
        public function get_data_active()
        {
                $response = $this->_client->request(
                        'GET',
                        'jadwal/data_active',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya'
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }

        public function simpan_rinci_jadwal($data_rinci)
        {
                $response = $this->_client->request(
                        'POST',
                        'jadwal_peserta/simpan_rinci',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_peserta' => $data_rinci['id_peserta'],
                                        'id_paket' => $data_rinci['id_paket'],
                                        'kode_jadwal' => $data_rinci['kode_jadwal'],
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }

        public function upload_buktibayar($data)
        {
                $response = $this->_client->request(
                        'PUT',
                        'jadwal_peserta/upload_bukti',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_jadwal' => $data['id_jadwal'],
                                        'atas_nama' => $data['atas_nama'],
                                        'bank' => $data['bank'],
                                        'total_bayar' => $data['total_bayar'],
                                        'no_rek' => $data['no_rek'],
                                        'status_bayar' => $data['status_bayar'],
                                        'bukti_bayar' => $data['bukti_bayar'],
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }
        public function update_jadwal($data)
        {
                $response = $this->_client->request(
                        'PUT',
                        'jadwal/update_jadwal',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_jadwal' => $data['id_jadwal'],
                                        'status_jadwal' => $data['status_jadwal']
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }
        public function update_jadwal_confirm($data)
        {
                $response = $this->_client->request(
                        'PUT',
                        'jadwal/update_jadwal_confirm',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_jadwal' => $data['id_jadwal'],
                                        'id_user_instruktur' => $data['id_user_instruktur'],
                                        'id_instruktur' => $data['id_instruktur'],
                                        'status_jadwal' => $data['status_jadwal'],
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }
}

/* End of file ModelName.php */
