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
        $arrData = array( 
            'begin_date'=> "2018-11-01",
            "end_date"  => "2018-11-30",

            'aaa'     => 'aa',
            'date'      => date('Y-m-d H:i:s')
        );

        $arrData    = json_encode($arrData);
        $dataInfo['title']      = 'admin';
        $dataInfo['sub_title']  = 'Setting Language';
        $xdata = TripleDES::encryptText($arrData,'KsAsFUHSyl9bH3qUTxxHg1mZGRgwQpQ4');
        exit();
        $xdata = base64_encode($xdata);
        
        $apiUrl = 'http://122.155.201.37/api-yotaka';
        $param = http_build_query(array('data' => $xdata));
        debug(cUrl($apiUrl.'/infolang',"get",$param));
        exit();
        $dataInfo['temp']   = $this->load->view('language/mainLanguage', $data, true);

        $this->output->set_output(json_encode($dataInfo));
    }
}