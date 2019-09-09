<?php
class AdminController extends CI_Controller {

    function __construct() {
        parent::__construct();

        //　URLヘルパーをロードする（リンクの生成を手伝ってくれる）
        $this->load->helper('url');

        // file upload
        $this->load->helper(array('form', 'url'));
		$this->load->model('Model_EC');
    }

    function moveAdmin(){
		$this->load->view('ec_admin');
    }

    function manager($name){
    	echo $name ;
		$this->load->view('adminManage');
	}
}


