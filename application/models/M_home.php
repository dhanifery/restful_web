<?php

use GuzzleHttp\Client;

defined('BASEPATH') or exit('No direct script access allowed');

class M_home extends CI_Model
{

        private $_client;

        public function __construct()
        {
                $this->_client = new Client([
                        'base_uri' => 'http://localhost/mysite/restful_server/api/',
                ]);
        }

        public function total_peserta()
        {
                $response = $this->_client->request(
                        'GET',
                        'rows/peserta',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya'
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }
        public function total_instruktur()
        {
                $response = $this->_client->request(
                        'GET',
                        'rows/instr',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya'
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }
        public function total_jadwal()
        {
                $response = $this->_client->request(
                        'GET',
                        'rows/jadwal',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya'
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }
        public function total_daftar_online()
        {
                $response = $this->_client->request(
                        'GET',
                        'kantor/total_online',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya'
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }
        public function total_daftar_offline()
        {
                $response = $this->_client->request(
                        'GET',
                        'kantor/total_offline',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya'
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }
        public function total_user()
        {
                $response = $this->_client->request(
                        'GET',
                        'kantor/total_user',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya'
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }

        public function get_kantor()
        {
                $response = $this->_client->request(
                        'GET',
                        'kantor',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya'
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }
        public function get_id_kantor($id_kantor)
        {
                $response = $this->_client->request(
                        'GET',
                        'kantor',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya',
                                        'id_kantor' => $id_kantor
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }

        // updata data kantor
        public function update_kantor($data)
        {
                $response = $this->_client->request(
                        'put',
                        'kantor',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_kantor' => $data['id_kantor'],
                                        'alamat' => $data['alamat'],
                                        'no_telp' => $data['no_telp'],
                                        'deskripsi' => $data['deskripsi']
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }


        // updata data kantor dgn gambar
        public function update_kantor_gambar($data)
        {
                $response = $this->_client->request(
                        'put',
                        'kantor/kantor_gambar',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_kantor' => $data['id_kantor'],
                                        'alamat' => $data['alamat'],
                                        'no_telp' => $data['no_telp'],
                                        'deskripsi' => $data['deskripsi'],
                                        'image' => $data['image']
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }

        public function user_online()
        {
                $response = $this->_client->request(
                        'GET',
                        'kantor/online',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya',
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }
        public function user_offline()
        {
                $response = $this->_client->request(
                        'GET',
                        'kantor/offline',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya',
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }
}

/* End of file ModelName.php */
