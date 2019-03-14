<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProducttypeController extends CI_Controller {

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
       
        $dataInfo['title']      = "Product Type";
        $dataInfo['sub_title']  = "Product Type List";
        $dataInfo['temp']       = $this->load->view('producttype/mainProducttype', $data, true);

        $this->output->set_output(json_encode($dataInfo));
	}

	public function producttypeList(){

        $post = $this->input->post();
        // debug($post, true);
        if($this->input->post('pageNum')){

            if($this->input->post('btName') == 'prevPage'){

                $pageNum = $this->input->post('pageNum') - 1;

            }else if($this->input->post('btName') == 'nextPage'){

                $pageNum = $this->input->post('pageNum') + 1;

            }else if($this->input->post('btName') == 'search'){

                $pageNum = 1;

            }else{

                $pageNum = $this->input->post('pageNum');
            }
        }else{
            
            $pageNum = '1';
        }

        $arrData            = $post;
        $arrData['page']    = $pageNum;
        // $arrData['hotel_id']	= $_COOKIE[$this->keyword."hotel_id"];
        // $arrData['user']	= $_COOKIE[$this->keyword."user"];
        $arrData = json_encode($arrData);

        $enData     = TripleDES::encryptText($arrData,$this->desKey);
        $param      = http_build_query(array('data' => $enData));

        $jsonData       = cUrl($this->apiUrl.'/producttype/read_producttype',"post",$param);
        $data_readData  = json_decode($jsonData);

        // debug($data_readData,true);

        $data['listData']       = ($data_readData->status_flag)? $data_readData->data : '';
        $dataInfo['list']       = $this->load->view('producttype/listDataProducttype',$data,true);
        
        $dataInfo['status']     = true;
        $dataInfo['optionPage'] = array(
                                            'page' => $pageNum,
                                            'listCount' => count($data_readData)
                                        );

        $this->output->set_output(json_encode($dataInfo));
	}

}