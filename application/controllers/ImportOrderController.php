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

        $dataInfo['title']      = $this->lang->line('import_order');
        $dataInfo['sub_title']  = $this->lang->line('create_import_order');

        $data['billNo'] = $this->runbill();
        $data['title'] = $dataInfo['sub_title'];
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
        $data = array();
        $data['adminlist']      = array();
        $data['title']          = $this->lang->line('manage_import_order');

        $dataInfo['title']      = $data['title'];
        $dataInfo['sub_title']  = $this->lang->line('import_order');
        $dataInfo['temp']       = $this->load->view('importOrder/listImport',$data,true);
        $this->output->set_output(json_encode($dataInfo));
    }

    public function get_importorder_list(){
        
        $get = $this->input->get();
                
        if ($this->input->get('btName')) {
            
            switch ($this->input->get('btName')) {
                case 'prevPage':
                    $pageNum = $this->input->get('pageNum') - 1;
                    break;

                case 'nextPage':
                    $pageNum = $this->input->get('pageNum') + 1;
                    break;

                case 'search':
                    $pageNum = 1;
                    break;
                
                default:
                    $pageNum = $this->input->get('pageNum');
                    break;
            }

        } else {
            $pageNum = '1';
        }

        $arrData            = $get;
        $arrData['page']    = $pageNum;
        $arrData['limit']    = 15;
        $arrData['hotel_id'] = $_COOKIE[$this->keyword."hotel_id"];
        
        $arrData    = json_encode($arrData);
        $desData    = TripleDES::encryptText($arrData,$this->desKey);
        $param      = http_build_query(array('data' => $desData));

        $jsonData    = cUrl($this->apiUrl.'/importorder/read_importorder',"post",$param);
        echo $jsonData;
        // debug(json_decode($jsonData), true);
        // debug(json_decode($jsonData), true);
        // $res = json_decode($jsonData);
        // debug($res, true);
        // print_r( json_decode($jsonData) );

        // $post = $this->input->post();
        // // debug($post, true);
        

        // if($this->input->post('pageNum')){

        //     if($this->input->post('btName') == 'prevPage'){

        //         $pageNum = $this->input->post('pageNum') - 1;

        //     }else if($this->input->post('btName') == 'nextPage'){

        //         $pageNum = $this->input->post('pageNum') + 1;

        //     }else if($this->input->post('btName') == 'search'){

        //         $pageNum = 1;

        //     }else{

        //         $pageNum = $this->input->post('pageNum');
        //     }
        // }else{
            
        //     $pageNum = '1';
        // }
        // // debug("ddddd", true);
        // $arrData            = $post;
        // $arrData['page']    = $pageNum;
        // $arrData['limit']    = 15;
        // $arrData['hotel_id'] = $_COOKIE[$this->keyword."hotel_id"];
        // $arrData['user'] = $_COOKIE[$this->keyword."user"];
        // $arrData = json_encode($arrData);
        // $enData     = TripleDES::encryptText($arrData,$this->desKey);
        // $param      = http_build_query(array('data' => $enData));

        // $jsonData       = cUrl($this->apiUrl.'/importorder/read_importorder',"post",$param); 
        // // debug($jsonData, true);
        // $data_readData  = json_decode($jsonData);
        // $data['checkdata']      = ($data_readData->status_flag)? $data_readData->status_flag : '';
        // $data['listData']       = ($data_readData->status_flag)? $data_readData->data : '';

        // $data['title']      = $this->lang->line('manage_import_order');
        // // debug($data, true);
        // // $dataInfo['title']      = $this->lang->line('import_order');
        // // $dataInfo['sub_title']  = $data['title'];
        // // $dataInfo['temp']       = $this->load->view('importOrder/listImport',$data,true);
        
        // $data['status']     = true;
        // $data['optionPage'] = array(
        //                                     'page' => $pageNum,
        //                                     'listCount' => count($data_readData)
                                        // );

        // $this->output->set_output(json_encode($dataInfo));
        // print_r( json_encode($res) );
    }

}
