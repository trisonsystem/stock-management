<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImportorderController extends CI_Controller {

  	public function __construct(){
	    parent::__construct();

	    $this->keyword = $this->config->config['keyword'];
    	$this->apiUrl  = $this->config->config['api_url'];
        $this->token   = (isset($_COOKIE[$this->keyword.'token'])) ? $_COOKIE[$this->keyword.'token'] : '';
        $this->desKey  = $this->config->config['des_key'];
    	// $this->token   = '4ddfdgghrdfyjhtuoookgftyu';

  	}

	public function index(){

        $data = array();
        $data['billNo'] = $this->runbill();

        $dataInfo['title']      = 'admin';
        $dataInfo['sub_title']  = 'Import Order';
        $dataInfo['temp']       = $this->load->view('importOrder/mainImport',$data,true);

        $this->output->set_output(json_encode($dataInfo));
    }

    public function runbill(){
        $arrData['ddate'] = date('Y-m-d');
        $arrData['hotel_id'] = $_COOKIE[$this->keyword."hotel_id"];
        
        $arrData    = json_encode($arrData);
        $desData    = TripleDES::encryptText($arrData,$this->desKey);
        $param      = http_build_query(array('data' => $desData));

        $jsonData    = cUrl($this->apiUrl.'/importorder/read_runbill',"post",$param);
        $dataInsert  = json_decode($jsonData,true);

        if($dataInsert['status_flag'] == 1){
            $d = "IPO-".date('Ym')."-".$dataInsert['data'];
        }else{
            $d = '';
        }

        return $d;
    }

    public function saveImportOrder(){

        $arrpost = $this->input->post();
        $arrpost["hotel_id"]  = $_COOKIE[$this->keyword."hotel_id"];
        $arrpost["user"]      = $_COOKIE[$this->keyword."user"];
        // debug($arrpost, true);
        
        $arrData    = json_encode($arrpost);
        $desData    = TripleDES::encryptText($arrData,$this->desKey);
        $param      = http_build_query(array('data' => $desData));

        $jsonData       = cUrl($this->apiUrl.'/importorder/save_importorder',"post",$param);
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






    public function importorder_list(){

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
        $arrData['limit']    = 15;
        $arrData['hotel_id'] = $_COOKIE[$this->keyword."hotel_id"];
        $arrData['user'] = $_COOKIE[$this->keyword."user"];
        $arrData = json_encode($arrData);
        $enData     = TripleDES::encryptText($arrData,$this->desKey);
        $param      = http_build_query(array('data' => $enData));

        $jsonData       = cUrl($this->apiUrl.'/importorder/read_importorder',"post",$param); 
        // debug($jsonData, true);
        $data_readData  = json_decode($jsonData);
        $data['checkdata']      = ($data_readData->status_flag)? $data_readData->status_flag : '';
        $data['listData']       = ($data_readData->status_flag)? $data_readData->data : '';
        
        $dataInfo['list']       = $this->load->view('importOrder/listImport',$data,true);
        
        $dataInfo['status']     = true;
        $dataInfo['optionPage'] = array(
                                            'page' => $pageNum,
                                            'listCount' => count($data_readData)
                                        );

        $this->output->set_output(json_encode($dataInfo));
    }

	public function adminList(){

        $data = array();


        // $vdata      = json_encode(array(1,3));
        // $arrData    =  cUrl($this->apiUrl."adminList","post","token=".$this->token."&vdata=".$vdata);
        // $arrData    = json_decode($arrData);

        // echo $arrData; exit();

        // $data['adminlist'] = $arrData;

        // $dataInfo['title']      = 'admin';
        // $dataInfo['sub_title']  = 'Import Order';
        // $dataInfo['temp']       = $this->load->view('importOrder/mainImport',$data,true);

        // $this->output->set_output(json_encode($dataInfo));
    }


}
