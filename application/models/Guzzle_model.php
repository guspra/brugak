<?php 
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class Guzzle_model extends CI_model {
    private $_client;

    public function __construct()
    {
        $userID = $this->session->userdata('id_user');
        $token = $this->session->userdata('token');

        $this->_client = new Client([
            'base_uri' => 'http://localhost/brugakapi/index.php/',
            'headers' => [
                'Client-Service' => 'frontend-client',
                'Auth-Key' => 'simplerestapi',
                'Content-Type' => 'application/json',
                'User-ID' => $userID,
                'Authorization' => $token
               ]
        ]);
    }

    // Model User
    public function getAllUser()
    {
        $response = $this->_client->request('GET', 'User');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }


    public function getUserById($id)
    {
//        'User/detail/' mengarah ke brugakapi , controller User.php dan function detail
        $response = $this->_client->request('GET', 'User/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function createUser($data)
    {
        $response = $this->_client->request('POST', 'User/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function updateUser($id, $data)
    {
        $response = $this->_client->request('PUT', 'User/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deleteUser($id)
    {
        $response = $this->_client->request('DELETE', 'User/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

     // Model Ruangan
    public function getAllRuangan()
    {
//        _client didefinisikan di function __construct, dmn disana telah terdefinisi header2 value dsb
        $response = $this->_client->request('GET', 'Ruangan');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getRuanganById($id)
    {
        $response = $this->_client->request('GET', 'Ruangan/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function createRuangan($data)
    {
        $response = $this->_client->request('POST', 'Ruangan/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function updateRuangan($id, $data)
    {
        $response = $this->_client->request('PUT', 'Ruangan/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deleteRuangan($id)
    {
        $response = $this->_client->request('DELETE', 'Ruangan/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    // Model Status Ruangan
    public function getAllStatusRuangan()
    {
        $response = $this->_client->request('GET', 'StatusRuangan');
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getStatusRuanganById($id)
    {
        $response = $this->_client->request('GET', 'StatusRuangan/detail/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getStatusRuanganByWaktu($waktu)
    {
        $response = $this->_client->request('GET', 'StatusRuangan/statusRuanganByWaktu/' . $waktu);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }
    public function getStatusRuanganByTanggal($tgl_awal, $tgl_akhir)
    {
        $response = $this->_client->request('GET', 'StatusRuangan/statusRuanganByTanggal/' . $tgl_awal . '/' . $tgl_akhir);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getStatusRuanganByTanggalByID($tgl_awal, $tgl_akhir,$idRuangan)
    {
        $response = $this->_client->request('GET', 'StatusRuangan/statusRuanganByTanggalByID/' . $tgl_awal . '/' . $tgl_akhir. '/' .$idRuangan);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

//    dirubahJo
    public function tesData($IdRuangan){
        $response = $this->_client->request('GET','StatusRuangan/testData/'.$IdRuangan);
        $result = json_decode($response->getBody()->getContents(),true);
        return $result;
    }

    public function getStatusShiftWaktu($IdRuangan, $Tanggal, $Waktu){
        $response = $this->_client->request('GET','StatusRuangan/getStatusShiftWaktu/'.$IdRuangan . '/' . $Tanggal. '/' .$Waktu);
        $result = json_decode($response->getBody()->getContents(),true);
        return $result;
    }


    public function createStatusRuangan($data)
    {
        $response = $this->_client->request('POST', 'StatusRuangan/create', [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function updateStatusRuangan($id, $data)
    {
        $response = $this->_client->request('PUT', 'StatusRuangan/update/' . $id, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function deleteStatusRuangan($id)
    {
        $response = $this->_client->request('DELETE', 'StatusRuangan/delete/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    
}