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
       
        $dataInfo['title']      = $this->lang->line('product_type');
        $dataInfo['sub_title']  = $this->lang->line('product_type_list');
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
        // echo "test data";
        // debug($data_readData,true);
        $data['checkdata']      = ($data_readData->status_flag)? $data_readData->status_flag : '';
        $data['listData']       = ($data_readData->status_flag)? $data_readData->data : '';
        // $data['listData']       = ($data_readData->status_flag == 1)? 'Yes' : 'No';
        // debug($post);
        // debug($data['listData'], true);
        $dataInfo['list']       = $this->load->view('producttype/listDataProducttype',$data,true);
        
        $dataInfo['status']     = true;
        $dataInfo['optionPage'] = array(
                                            'page' => $pageNum,
                                            'listCount' => count($data_readData)
                                        );

        $this->output->set_output(json_encode($dataInfo));
	}

    public function addProducttype(){

        $data                   = array();
       
        $dataInfo['title']      = $this->lang->line('product_type');
        $dataInfo['sub_title']  = $this->lang->line('add_product_type');
        $dataInfo['temp']       = $this->load->view('producttype/AddProducttype', $data, true);

        $this->output->set_output(json_encode($dataInfo));
    }

    public function saveProducttype(){
        
        $post = $this->input->post(); 
        $post["user"]      = $_COOKIE[$this->keyword."user"];
        
        $arrData    = json_encode($post);
        $desData    = TripleDES::encryptText($arrData,$this->desKey);
        $param      = http_build_query(array('data' => $desData));

        $jsonData    = cUrl($this->apiUrl.'/producttype/save_producttype',"post",$param);
        $dataInsert  = json_decode($jsonData,true);
        
        if(!empty($dataInsert['status_flag'])){

            $dataSuccess['status']  = 1;
            $dataSuccess['msg']     = 'save_success';

        }else{
            
            $dataSuccess['status']  = 0;
            $dataSuccess['msg']     = 'save_error  '.$dataInsert['msg'];
        }

        echo json_encode($dataSuccess);
    }

    public function editProducttype($id){
        $arrData['id']  = $id;
        $arrData        = json_encode($arrData);

        $enData         = TripleDES::encryptText($arrData,$this->desKey);
        $param          = http_build_query(array('data' => $enData));
        $jsonData       = cUrl($this->apiUrl.'/producttype/readedit_producttype',"post",$param);
        $data_readData  = json_decode($jsonData,true);

        $data                   = $data_readData['msg'];

        // debug($data,true);
    
        $dataInfo['title']      = $this->lang->line('product_type');;
        $dataInfo['sub_title']  = $this->lang->line('edit_product_type');
        $dataInfo['temp']       = $this->load->view('producttype/AddProducttype', $data, true);

        $this->output->set_output(json_encode($dataInfo));
    }

    public function delProducttype(){

        $post = $this->input->post();
        // debug($post, true);
        $arrData = $post;
        $arrData = json_encode($arrData);

        $desData    = TripleDES::encryptText($arrData,$this->desKey);
        $param      = http_build_query(array('data' => $desData));

        $jsonData    = cUrl($this->apiUrl.'/producttype/del_producttype',"post",$param);
        // debug($jsonData, true);
        $dataJson  = json_decode($jsonData,true);

        // debug($dataJson,true);

        if(!empty($dataJson['status_flag'])){
            $dataSuccess['status']  = 1;
            $dataSuccess['msg']     = 'save_success';
        }else{
            $dataSuccess['status']  = 0;
            $dataSuccess['msg']     = 'save_error  '.$dataJson['msg'];
        }

        echo json_encode($dataSuccess);
    }

}