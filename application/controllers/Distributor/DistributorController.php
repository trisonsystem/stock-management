<?php
header('Access-Control-Allow-Origin: *');

class DistributorController extends CI_Controller {
    public function __construct(){
        parent::__construct();

        $this->keyword = $this->config->config['keyword'];
        $this->apiUrl  = $this->config->config['api_url'];
        $this->desKey  = $this->config->config['des_key'];
     //    $this->token   = (isset($_COOKIE[$this->keyword.'token'])) ? $_COOKIE[$this->keyword.'token'] : '';
        // $this->token   = '4ddfdgghrdfyjhtuoookgftyu';

    }

    public function index(){

        $data                   = array();

        $dataInfo['title']      = $this->lang->line('distributor');
        $dataInfo['sub_title']  = $this->lang->line('distributor_list');
        $dataInfo['temp']       = $this->load->view('distributor/mainDistributor', $data, true);

        $this->output->set_output(json_encode($dataInfo));
    }
}