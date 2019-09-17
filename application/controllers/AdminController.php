<?php
class AdminController extends CI_Controller {

	function __construct() {
		parent::__construct();

		//　URLヘルパーをロードする（リンクの生成を手伝ってくれる）
		$this->load->helper('url');

		// file upload
		$this->load->helper(array('form', 'url'));
		$this->load->model('AdminModel');
	}

	function moveAdmin(){
		$this->load->view('ec_admin');
	}

	function manager($name){
		echo $name ;
		if($name === "order"){
			$data["orderList"] = $this->AdminModel->orderList();
			$this->load->view('/admin/adminManage',$data);
		}else if($name === "product"){
			$data["productList"] = $this->AdminModel->selectProduct();
			$this->load->view('/admin/adminManage',$data);
		}else if($name === "productUploadPage"){
			$data["productRegister"] = "";
			$data['category'] = $this->AdminModel->get_category();
			$this->load->view('/admin/adminManage',$data);

		}

	}

	function order($od_no){
		echo $od_no;
		$data["orderInfo"] = $this->AdminModel->selectOrderInfo($od_no);
		$data["ordererInfo"] = $this->AdminModel->selectOrdererInfo($od_no);
		$data["receiverInfo"] = $this->AdminModel->selectReceiverInfo($od_no);
		$data["orderProductInfo"] = $this->AdminModel->selectOrderProductInfo($od_no);
		$this->load->view('/admin/orderManage',$data);
	}

	function orderStatusChange(){
		$od_no = $this->input->post('od_no');
		$paymentStatus = $this->input->post('paymentStatus');
		$deliveryStatus = $this->input->post('deliveryStatus');

		$this->AdminModel->updateOrderStatus($od_no,$paymentStatus, $deliveryStatus);


	}

	function deleteOrder(){
		$odArray = $this->input->post('odArray') ;

		for($i=0; $i<count($odArray); $i++){
			$this->AdminModel->deleteOrder($odArray[$i]);
		}
	}

	public function productList(){
		$this->load->view('productList');
	}

	// 商品登録ページに移動（masterアカウント限定）
	public function productUploadPage()
	{
		$this->load->view('product_upload_page');
	}

	// カテゴリ登録（商品登録ページ内）
	public function uploadCategory()
	{
		$this->AdminModel->upload_category($this->input->post('cg_name'));

		$this->manager("productUploadPage");
	}

	// 商品登録（商品登録ページ内）
	public function uploadProduct()
	{


		$config['upload_path'] = './img';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '204800';


		$this->load->library('upload', $config);

		if ( !$this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
//			print_r($this->upload->display_errors());

		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
//			print_r($data);
			$this->upload->do_upload();

		}


		$pd_img = '/img/'.$this->upload->data()['file_name'];

		$product_data = array(
			'cg_no' => (int)$this->input->post('cg_no'),
			'pd_number' => $this->input->post('pd_number'),
			'pd_img' => $pd_img,
			'pd_name' => $this->input->post('pd_name'),
			'pd_price' => (int)$this->input->post('pd_price'),
			'pd_stock' => (int)$this->input->post('pd_stock'),
			'pd_comment' => $this->input->post('pd_comment'),
			'pd_memo' => $this->input->post('pd_memo')
		);

		echo "<script>alert('商品登録が終わりました。');</script>";

		$this->AdminModel->upload_product($product_data);

		redirect();$this->manager("product");
	}

	public function deleteProduct(){
		$pdArray = $this->input->post('pdArray') ;

		for($i=0; $i<count($pdArray); $i++){
			$this->AdminModel->deleteProduct($pdArray[$i]);
		}

	}

}


