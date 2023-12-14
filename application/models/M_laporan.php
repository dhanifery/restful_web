<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class M_laporan extends CI_Model
{
        private $_client;

        public function __construct()
        {
                $this->_client = new Client([
                        'base_uri' => 'http://localhost/mysite/restful_server/api/',
                ]);
        }

        public function lap_harian($tanggal, $bulan, $tahun)
        {
                $response = $this->_client->request(
                        'POST',
                        'laporan/lap_harian',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'tanggal' => $tanggal,
                                        'bulan' => $bulan,
                                        'tahun' => $tahun
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }

        public function lap_bulanan($bulan, $tahun)
        {
                $response = $this->_client->request(
                        'POST',
                        'laporan/lap_bulan',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'bulan' => $bulan,
                                        'tahun' => $tahun
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }

        public function lap_tahunan($tahun)
        {
                $response = $this->_client->request(
                        'POST',
                        'laporan/lap_tahun',
                        [
                                'form_params' => [
                                        'kursus_key' => 'apaya',
                                        'tahun' => $tahun
                                ]
                        ]
                );

                $result = json_decode($response->getBody()->getContents());

                return $result;
        }
}

/* End of file ModelName.php */
