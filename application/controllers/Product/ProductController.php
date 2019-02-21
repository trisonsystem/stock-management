<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {

  	public function __construct(){
	    parent::__construct();

	    $this->keyword = $this->config->config['keyword'];
        $this->apiUrl  = $this->config->config['api_url'];
    	$this->desKey  = $this->config->config['des_key'];
     //    $this->token   = (isset($_COOKIE[$this->keyword.'token'])) ? $_COOKIE[$this->keyword.'token'] : '';
    	// $this->token   = '4ddfdgghrdfyjhtuoookgftyu';

  	}

	public function index(){

        // debug(444,true);

        $data                   = array();
       
        $dataInfo['title']      = "Product";
        $dataInfo['sub_title']  = "Product list";
        $dataInfo['temp']       = $this->load->view('product/mainProduct', $data, true);

        $this->output->set_output(json_encode($dataInfo));

	}

    public function productList(){
        // debug($_POST);

        $post = $this->input->post();

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
        $arrData['limit']   = 5;
        $arrData = json_encode($arrData);

        $enData     = TripleDES::encryptText($arrData,$this->desKey);
        $param      = http_build_query(array('data' => $enData));

        $jsonData       = cUrl($this->apiUrl.'/product/read_product',"post",$param);
        $data_readData  = json_decode($jsonData);

        // debug($jsonData);

        // $data['page']       = $pageNum;
        // $data['listCount']  = count($data_readData);
        $data['listData']   = $data_readData;
        // $data['mainUser']   = $this->userData->main_username;

        // debug($data,true);

        // if(!empty($data_readData)){

            $dataInfo['list']       = $this->load->view('product/listDataProduct',$data,true);

        // }else{
        //     $dataInfo['list']       = '<tr><td colspan="17"><center>'.$this->lang->line('no_data').'</center></td></tr>';
        // }

        
        $dataInfo['status']     = true;
        $dataInfo['optionPage'] = array(
                                            'page' => $pageNum,
                                            'listCount' => count($data_readData)
                                        );

        $this->output->set_output(json_encode($dataInfo));
    }


}
