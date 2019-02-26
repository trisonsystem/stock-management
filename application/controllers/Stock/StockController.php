<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockController extends CI_Controller {

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
       
        $dataInfo['title']      = "Stock";
        $dataInfo['sub_title']  = "Stock List";
        $dataInfo['temp']       = $this->load->view('stock/mainStock', $data, true);

        $this->output->set_output(json_encode($dataInfo));
	}

    public function stockList(){

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
        $arrData = json_encode($arrData);

        $enData     = TripleDES::encryptText($arrData,$this->desKey);
        $param      = http_build_query(array('data' => $enData));

        $jsonData       = cUrl($this->apiUrl.'/stock/read_stock',"post",$param);
        $data_readData  = json_decode($jsonData);

        // debug($data_readData,true);

        $data['listData']       = ($data_readData->status_flag)? $data_readData->data : '';
        $dataInfo['list']       = $this->load->view('stock/listDataStock',$data,true);
        
        $dataInfo['status']     = true;
        $dataInfo['optionPage'] = array(
                                            'page' => $pageNum,
                                            'listCount' => count($data_readData)
                                        );

        $this->output->set_output(json_encode($dataInfo));
    }

    public function addStock(){

        $data                   = array();
       
        $dataInfo['title']      = "Stock";
        $dataInfo['sub_title']  = "Add Stock";
        $dataInfo['temp']       = $this->load->view('stock/AddStock', $data, true);

        $this->output->set_output(json_encode($dataInfo));
    }

    public function saveProduct(){

        $post = $this->input->post();

        $arrData = $post;
        $arrData = json_encode($arrData);

        $desData    = TripleDES::encryptText($arrData,$this->desKey);
        $param      = http_build_query(array('data' => $desData));

        $jsonData    = cUrl($this->apiUrl.'/product/save_product',"post",$param);
        $dataInsert  = json_decode($jsonData,true);

        // debug($dataInsert,true);

        if(!empty($dataInsert['status_flag'])){

            $dataSuccess['status']  = 1;
            $dataSuccess['msg']     = 'save_success';

        }else{
            
            $dataSuccess['status']  = 0;
            $dataSuccess['msg']     = 'save_error  '.$dataInsert['msg'];
        }

        echo json_encode($dataSuccess);
    }

    public function editProduct($id){

        $arrData['id']  = $id;
        $arrData        = json_encode($arrData);

        $enData         = TripleDES::encryptText($arrData,$this->desKey);
        $param          = http_build_query(array('data' => $enData));
        $jsonData       = cUrl($this->apiUrl.'/product/readedit_product',"post",$param);
        $data_readData  = json_decode($jsonData,true);

        $data                   = $data_readData['msg'];

        // debug($data);
    
        $dataInfo['title']      = "Product";
        $dataInfo['sub_title']  = "Edit Product";
        $dataInfo['temp']       = $this->load->view('product/AddProduct', $data, true);

        $this->output->set_output(json_encode($dataInfo));
    }

    public function delProduct(){

        $post = $this->input->post();

        $arrData = $post;
        $arrData = json_encode($arrData);

        $desData    = TripleDES::encryptText($arrData,$this->desKey);
        $param      = http_build_query(array('data' => $desData));

        $jsonData    = cUrl($this->apiUrl.'/product/del_product',"post",$param);
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
