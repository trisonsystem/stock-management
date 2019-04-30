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

    public function distributorList(){

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
        $arrData['hotel_id'] = $_COOKIE[$this->keyword."hotel_id"];

        // $arrData['user'] = $_COOKIE[$this->keyword."user"];
        $arrData = json_encode($arrData);
        $enData     = TripleDES::encryptText($arrData,$this->desKey);
        $param      = http_build_query(array('data' => $enData));

        $jsonData       = cUrl($this->apiUrl.'/distributor/read_distributor',"post",$param);
        
        $data_readData  = json_decode($jsonData);
        $p = json_decode($jsonData, true);
        
        $data['checkdata']      = ($data_readData->status_flag)? $data_readData->status_flag : '';
        $data['listData']       = ($data_readData->status_flag)? $data_readData->data : '';
        
        $dataInfo['list']       = $this->load->view('distributor/listDistributor',$data,true);
        
        $dataInfo['status']     = true;
        $dataInfo['optionPage'] = array(
                                            'page' => $p['optionPage']['page'],
                                            'listCount' => $p['optionPage']['listCount']
                                        );

        $this->output->set_output(json_encode($dataInfo));
    }

    public function addDistributor(){

        $data['data']                   = array(
                                            'id' => "",
                                            'dis_name' => "",
                                            'dis_address' => "",
                                            'dis_vat' => ""
                                        );


        $dataInfo['title']      = $this->lang->line('distributor');
        $dataInfo['sub_title']  = $this->lang->line('add_distributor');
        $dataInfo['temp']       = $this->load->view('distributor/AddDistributor', $data, true);

        $this->output->set_output(json_encode($dataInfo));
    }

    public function saveDistributor(){

        $post = $this->input->post(); 
        $post["user"]      = $_COOKIE[$this->keyword."user"];
        $post['hotel_id'] = $_COOKIE[$this->keyword."hotel_id"];
        
        $arrData    = json_encode($post);
        $desData    = TripleDES::encryptText($arrData,$this->desKey);
        $param      = http_build_query(array('data' => $desData));

        $jsonData    = cUrl($this->apiUrl.'/distributor/save_distributor',"post",$param);
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

    public function editDistributor($id){

        $arrData['id']  = $id;
        $arrData['page']    = 1;
        $arrData['limit']    = 5;
        $arrData['hotel_id'] = $_COOKIE[$this->keyword."hotel_id"];
        $arrData        = json_encode($arrData);

        $enData         = TripleDES::encryptText($arrData,$this->desKey);
        $param          = http_build_query(array('data' => $enData));
        $jsonData       = cUrl($this->apiUrl.'/distributor/readedit_distributor',"post",$param);

        $data_readData  = json_decode($jsonData,true);

        $data['data'] = array(
            'id' => $data_readData['data'][0]['id'],
            'dis_name' => $data_readData['data'][0]['name'],
            'dis_address' => $data_readData['data'][0]['address'],
            'dis_vat' => $data_readData['data'][0]['vatid']
        );
    
        $dataInfo['temp']       = $this->load->view('distributor/AddDistributor', $data, true);

        $this->output->set_output(json_encode($dataInfo));
    }

    public function delDistributor(){
        $post = $this->input->post();

        $arrData = $post;
        $arrData = json_encode($arrData);

        $desData    = TripleDES::encryptText($arrData,$this->desKey);
        $param      = http_build_query(array('data' => $desData));

        $jsonData    = cUrl($this->apiUrl.'/distributor/del_distributor',"post",$param);
        
        $dataJson  = json_decode($jsonData,true);

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