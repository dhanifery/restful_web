<?php
// done
use GuzzleHttp\Client;

defined('BASEPATH') or exit('No direct script access allowed');

class M_paket extends CI_Model
{


        private $_client;

        public function __construct()
        {
                $this->_client = new Client([
                        'base_uri' => 'http://localhost/mysite/restful_server/api/',
                ]);
        }


        public function get_all_data()
        {
                $response = $this->_client->request(
                        'GET',
                        'paket/join',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya'
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }

        public function get_data($id_paket)
        {
                $response = $this->_client->request(
                        'GET',
                        'paket',
                        [
                                'query' => [
                                        'kursus_key' => 'apaya',
                                        'id_paket' => $id_paket
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }
        //  tambah data
        public function add($data)
        {
                $response = $this->_client->request(
                        'POST',
                        'paket',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'nama_paket' => $data['nama_paket'],
                                        'id_mobil' => $data['id_mobil'],
                                        'harga' => $data['harga'],
                                        'byk_pertemuan' => $data['byk_pertemuan'],
                                        'deskripsi_paket' => $data['deskripsi_paket'],
                                        'image' => $data['image']

                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }

        // update data
        public function update($data)
        {
                $response = $this->_client->request(
                        'PUT',
                        'paket',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_paket' => $data['id_paket'],
                                        'nama_paket' => $data['nama_paket'],
                                        'id_mobil' => $data['id_mobil'],
                                        'harga' => $data['harga'],
                                        'byk_pertemuan' => $data['byk_pertemuan'],
                                        'deskripsi_paket' => $data['deskripsi_paket'],
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }
        // update data
        public function update_gambar($data)
        {
                $response = $this->_client->request(
                        'PUT',
                        'paket/update_gambar',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_paket' => $data['id_paket'],
                                        'nama_paket' => $data['nama_paket'],
                                        'id_mobil' => $data['id_mobil'],
                                        'harga' => $data['harga'],
                                        'byk_pertemuan' => $data['byk_pertemuan'],
                                        'deskripsi_paket' => $data['deskripsi_paket'],
                                        'image' => $data['image'],
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }


        // done
        // hapus data
        public function delete($data)
        {
                $response = $this->_client->request(
                        'DELETE',
                        'paket',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'id_paket' => $data['id_paket'],
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents(), true);

                return $result;
        }
}
