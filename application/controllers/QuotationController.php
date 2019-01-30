<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuotationController extends CI_Controller {

  	public function __construct(){
	    parent::__construct();

	    $this->keyword = $this->config->config['keyword'];
    	$this->apiUrl  = $this->config->config['api_url'];
        $this->token   = (isset($_COOKIE[$this->keyword.'token'])) ? $_COOKIE[$this->keyword.'token'] : '';
    	// $this->token   = '4ddfdgghrdfyjhtuoookgftyu';

  	}

	public function index(){ 
		$data = array();
        // $vdata      = json_encode(array(1,3));
        // $arrData    =  cUrl($this->apiUrl."adminList","post","token=".$this->token."&vdata=".$vdata);
        // $arrData    = json_decode($arrData);

        // echo $arrData; exit();

        $data['adminlist'] 		= array();
        $data['title']      	= 'ใบเสนอสินค้า';
        $data['product']        = $this->get_product();
        $dataInfo['title']      = $data['title'];
        $dataInfo['sub_title']  = '';
        $dataInfo['temp']       = $this->load->view('Quotation/index',$data,true);
        $this->output->set_output(json_encode($dataInfo));
	}

    public function get_product(){
        $this->load->model('MProduct');
        $pd = $this->MProduct->getProduct_all();

        return $pd;
    }

    public function save(){
        $this->load->model('MQuotation');
        $res = $this->MQuotation->save_data( $_POST );

        print_r( json_encode($res) );
    }
}