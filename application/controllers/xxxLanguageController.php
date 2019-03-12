<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LanguageController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->keyword = $this->config->config['keyword'];
        $this->apiUrl = $this->config->config['api_url'];
        $this->token = (isset($_COOKIE[$this->keyword . 'token'])) ? $_COOKIE[$this->keyword . 'token'] : '';
        // $this->token = $this->keyword;
    }

    public function index()
    { 
        // $this->listLanguage();
        $data = array();
        $data['title'] = 'Insert Language';        
        $dataInfo['title'] = "Setting Language";
        $dataInfo['sub_title']  = $data['title'];
        $dataInfo['temp'] = $this->load->view('language/mainLanguage', $data, true);

        $this->output->set_output(json_encode($dataInfo));
    }

    public function infoLanguage(){
        $arrData = array( 'arrData'=> "" );
        $arrData = json_encode($arrData);
        $xdata = TripleDES::encryptText($arrData,'KsAsFUHSyl9bH3qUTxxHg1mZGRgwQpQ4');
        $apiUrl = $this->apiUrl;
        $param = http_build_query(array('data' => $xdata));
        echo cUrl($apiUrl.'/lang/infoLanguage',"get",$param);
    }

    public function saveLanguage(){
        $post = $this->input->post();
        
        $arrData = array();

        $arrData    = json_encode($post);
        $dataInfo   = TripleDES::encryptText($arrData,'KsAsFUHSyl9bH3qUTxxHg1mZGRgwQpQ4');
        $param = http_build_query(array('data' => $dataInfo));
        $apiUrl = $this->apiUrl;
        echo cUrl($apiUrl.'/lang/saveLanguage',"post",$param);
    }

    public function saveFieldLang(){
        $post = $this->input->post();
        
        $arrData = array();

        $arrData    = json_encode($post);
        $dataInfo   = TripleDES::encryptText($arrData,'KsAsFUHSyl9bH3qUTxxHg1mZGRgwQpQ4');
        $param = http_build_query(array('data' => $dataInfo));
        $apiUrl = $this->apiUrl;
        echo cUrl($apiUrl.'/lang/saveFieldLang',"post",$param);
    }

    public function deleteLanguage(){
        $post = $this->input->post();
        
        $arrData = array();

        $arrData    = json_encode($post);
        $dataInfo   = TripleDES::encryptText($arrData,'KsAsFUHSyl9bH3qUTxxHg1mZGRgwQpQ4');
        $param = http_build_query(array('data' => $dataInfo));
        $apiUrl = $this->apiUrl;
        echo cUrl($apiUrl.'/lang/deleteLanguage',"post",$param);
    }

    public function deleteFieldLang(){
        $post = $this->input->post();
        
        $arrData = array();

        $arrData    = json_encode($post);
        $dataInfo   = TripleDES::encryptText($arrData,'KsAsFUHSyl9bH3qUTxxHg1mZGRgwQpQ4');
        $param = http_build_query(array('data' => $dataInfo));
        $apiUrl = $this->apiUrl;
        echo cUrl($apiUrl.'/lang/deleteFieldLang',"post",$param);
    }

    public function saveEditLanguage(){
        $post = $this->input->post();
        $arrData = array();

        $arrData    = json_encode($post);
        $dataInfo   = TripleDES::encryptText($arrData,'KsAsFUHSyl9bH3qUTxxHg1mZGRgwQpQ4');
        $param = http_build_query(array('data' => $dataInfo));
        $apiUrl = $this->apiUrl;
        echo cUrl($apiUrl.'/lang/saveEditLanguage',"post",$param);
    }

    public function getLanguageFromWord(){
        $get = $this->input->get();
        $arrData = array();

        $arrData    = json_encode($get);
        $dataInfo   = TripleDES::encryptText($arrData,'KsAsFUHSyl9bH3qUTxxHg1mZGRgwQpQ4');
        $param = http_build_query(array('data' => $dataInfo));
        $apiUrl = $this->apiUrl;
        $data['byword'] = cUrl($apiUrl.'/lang/getLanguageFromWord',"get",$param);
        $this->load->view('language/md_editlanguage', $data);
    }


}