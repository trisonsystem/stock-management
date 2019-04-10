<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {

  	public function __construct(){
        parent::__construct();

        $this->baseUrl = $this->config->config['base_url'];
	    $this->keyword = $this->config->config['keyword'];
        $this->apiUrl  = $this->config->config['api_url'];
    	$this->desKey  = $this->config->config['des_key'];
     //    $this->token   = (isset($_COOKIE[$this->keyword.'token'])) ? $_COOKIE[$this->keyword.'token'] : '';
    	// $this->token   = '4ddfdgghrdfyjhtuoookgftyu';

  	}

	public function index(){

        $data                   = array();
       
        $dataInfo['title']      = "Product";
        $dataInfo['sub_title']  = "Product list";
        $dataInfo['temp']       = $this->load->view('product/mainProduct', $data, true);

        $this->output->set_output(json_encode($dataInfo));
	}

    public function productList(){

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

        $jsonData       = cUrl($this->apiUrl.'/product/read_product',"post",$param);
        $data_readData  = json_decode($jsonData);

        // debug($jsonData);

        $data['listData']   = $data_readData;
        $dataInfo['list']       = $this->load->view('product/listDataProduct',$data,true);
        
        $dataInfo['status']     = true;
        $dataInfo['optionPage'] = array(
                                            'page' => $pageNum,
                                            'listCount' => count($data_readData)
                                        );

        $this->output->set_output(json_encode($dataInfo));
    }

    public function addProduct(){

        $data                   = array();
       
        $dataInfo['title']      = "Product";
        $dataInfo['sub_title']  = "Add Product";
        $dataInfo['temp']       = $this->load->view('product/AddProduct', $data, true);

        $this->output->set_output(json_encode($dataInfo));
    }

    public function saveProduct(){

        $post = $this->input->post();

         $fileName   = $_FILES['fileToUpload']['name'];

        // debug($_FILES,true);

        $config['upload_path']      = $this->baseUrl.'assets/upload/';
        // $config['upload_path']      = '../assets/upload/'; 
        $config['allowed_types']    = 'gif|jpg|png'; 
        $config['file_name']        = date('Ymd-his').'-'.$post['barcode'];
        // $config['max_size']         = 1000;
        // $config['max_width']        = 1024;
        // $config['max_height']       = 768;
         $this->load->library('upload', $config);

         debug($config);

         $uploadImg = ($fileName !='')? $this->upload->do_upload('fileToUpload') :1;


        if ($uploadImg) {

            echo 555;

            // $this->load->model('NewsModel');

            // if($id !='' && $fileName !=''){

            //     // $dataNews   = $this->NewsModel->getNews($id);
            //     $exImg      = explode('/', $dataNews['msg']['news_img']);
            //     $imgName    = $exImg[count($exImg)-1];
            //     unlink('assets/upload/'.$imgName);

            // }

            // $arrpost    = array('id'=>$id,'head'=>$head,'title'=>$title,'detail'=>$detail);
            // $arrUpload  = $this->upload->data();
            // $saveNews   = json_decode($this->NewsModel->saveNews($arrpost,$arrUpload),true);

            // $arrRetrun['status_flag']   = $saveNews['status_flag'];
            // $arrRetrun['msg']           = $saveNews['msg'];

        }else{
            echo $ermsg                      = $this->upload->display_errors();
            // $arrRetrun['status_flag']   = 0;
            // $arrRetrun['msg']           = $ermsg;
        }

        // ========================

        debug($_FILES);

        debug($post,true);

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
