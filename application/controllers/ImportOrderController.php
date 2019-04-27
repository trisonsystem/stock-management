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
        $this->create_importOrder( );
    }

    public function edit_importOrder( $doc_id ){
        $this->create_importOrder( $doc_id );
    }

    public function create_importOrder( $doc_id = "" ){
        $data = array();

        if($doc_id == ""){
            $title = $this->lang->line('create_import_order');
            $data['billNo'] = $this->runbill();
        }else{
            $title = "แก้ไข create_import_order";

            $arrpost["doc_id"]          = $doc_id;

            $arrData                    = json_encode($arrpost);
            $enData                     = TripleDES::encryptText($arrData,$this->desKey);
            $param                      = http_build_query(array('data' => $enData));

            $jsonData                   = cUrl($this->apiUrl.'/importorder/readedit_importorder',"post",$param);
            $listData                   = json_decode($jsonData, true);
            $data['id']                 = $listData[0]['id'];
            $data['billNo']             = $listData[0]['order_no'];
            $data['order_date']         = $listData[0]['order_date'];
            $data['order_refer']        = $listData[0]['order_refer'];
            $data['distributor_id']     = $listData[0]['distributor_id'];
            $data['distributor_name']   = $listData[0]['distri_name'];
            $data['remark']             = $listData[0]['remark'];
            $data['order_list']         = json_encode($listData['list']);

        }

        $dataInfo['title']      = $this->lang->line('import_order');
        $dataInfo['sub_title']  = $title;

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
    }

    public function approve(){
        $arrpost = $this->input->post();
        $arrpost["sapprove"]      = "approve";

        $arrData    = json_encode($arrpost);
        $desData    = TripleDES::encryptText($arrData,$this->desKey);
        $param      = http_build_query(array('data' => $desData));

        $jsonData       = cUrl($this->apiUrl.'/importorder/approve_importorder',"post",$param);
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

    public function no_approve(){
        $arrpost = $this->input->post();
        $arrpost["sapprove"]      = "no_approve";

        $arrData    = json_encode($arrpost);
        $desData    = TripleDES::encryptText($arrData,$this->desKey);
        $param      = http_build_query(array('data' => $desData));

        $jsonData       = cUrl($this->apiUrl.'/importorder/approve_importorder',"post",$param);
        // debug($jsonData, true);
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
}
