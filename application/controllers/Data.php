<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        
        $query = $this->db->query("SELECT * FROM data ORDER BY createdAt DESC LIMIT 20 ");
        $data['jarak'] = $query->result();
        $data['title'] = "Data Sensor Jarak";

        $this->load->view("v_header", $data);
        $this->load->view("v_index", $data);
        $this->load->view("v_footer", $data);
    }
    public function showFlame()
    {
        
        $query = $this->db->query("SELECT * FROM flame ORDER BY createdAt DESC LIMIT 20 ");
        $data['flame'] = $query->result();
        $data['title'] = "Data Sensor Flame";

        $this->load->view("v_header", $data);
        $this->load->view("v_flame", $data);
        $this->load->view("v_footer", $data);
    }
    public function kontrol()
    {
      
        $query = $this->db->query("SELECT * FROM relay_satu ORDER BY createdAt DESC LIMIT 20 ");
        $data['relaySatu'] = $query->result();

 
        $query = $this->db->query("SELECT * FROM relay_dua ORDER BY createdAt DESC LIMIT 20 ");;
        $data['relayDua'] = $query->result();

        $data['title'] = "Kontrol Relay";
        $this->load->view("v_header", $data);
        $this->load->view("v_kontrol", $data);
        $this->load->view("v_footer", $data);
    }

    public function simpan()
    {
        $jarak = $this->input->get('jarak');

        $result = '';

        if ($jarak != '') {
            $buzzer = "";
            if ($jarak < 50) {
                $buzzer = "Berbunyi";
            } else {
                $buzzer = "Tidak Berbunyi";
            }

            $data = [
                'jarak' => $jarak,
                'buzzer' => $buzzer
            ];

            $insert = $this->db->insert('data', $data);

            if ($insert) {
                $result = 'Data berhasil disimpan';
            } else {
                $result = 'Server Error';
            }
        } else {
            $result = 'Jarak tidak boleh kosong';
        }

        echo $result;
    }

    public function flame()
    {
        $flame = $this->input->get('status');

        $result = '';

        if ($flame != '') {
            $led = "";
            if ($flame == "true") {
                $led = "Menyala";
            } else {
                $led = "Tidak Menyala";
            }

            $data = [
                'status' => $flame,
                'led' => $led
            ];

            $insert = $this->db->insert('flame', $data);

            if ($insert) {
                $result = 'Data berhasil disimpan';
            } else {
                $result = 'Server Error';
            }
        } else {
            $result = 'Data tidak boleh kosong';
        }

        echo $result;
    }

    public function getJarak()
    {
        $query =  $this->db->query("SELECT * FROM data ORDER BY createdAt DESC LIMIT 1 ");
        $jarak = $query->result_array();
        
        echo json_encode ($jarak);
    }

    public function getApi()
    {
        $query =  $this->db->query("SELECT * FROM flame ORDER BY createdAt DESC LIMIT 1 ");
        $api = $query->result_array();
        
        echo json_encode ($api);
    }

    public function sendKontrol(){

        $buzzer = $_POST['buzzer'];
        $jarak = $_POST['jarak'];
        $led = $_POST['led'];
        $api = $_POST['api'];

        $dataJarak = [
            'status' => $buzzer,
            'sensor' => $jarak
            
        ];
        $dataApi = [
            'status' => $led,
            'sensor' => $api
            
        ];

        $insert = $this->db->insert('relay_satu', $dataJarak);
        $insert = $this->db->insert('relay_dua', $dataApi);

        if ($insert) {
            echo 'Data berhasil disimpan';
        } else {
            echo 'Server Error';
        }


    }

    public function getRelay()
    {
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $relay = $this->db->get('relay_satu')->result_array();
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $relayDua = $this->db->get('relay_dua')->result_array();

        
        if ($relay[0]['status'] == 'true') {
            $relayValue = '1';
        } else {
            $relayValue = '0';
        }
        if ($relayDua[0]['status'] == 'true') {
            $relayValueDua = '1';
        } else {
            $relayValueDua = '0';
        }
        
        
        $statusRelay =  $relayValue.','.$relayValueDua;
        echo ($statusRelay);
    }
}

/* End of file Data.php */
