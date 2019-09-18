<?php
class Controller_EC extends CI_Controller {

    function __construct() {
        parent::__construct();

        //　URLヘルパーをロードする（リンクの生成を手伝ってくれる）
        $this->load->helper('url');

        // file upload
        $this->load->helper(array('form', 'url'));
		$this->load->model('Model_EC');
    }

    // 모든 테스트를 하는 곳 (삭제할거임)
    public function test(){
        $this->load->view('upload_form');
    }
     
    // 에이젝스 테스트 (삭제할거임)
    function ajax_receive(){
        $txt = $this->input->post("txt",TRUE);
        echo $txt;
    }

    // 업로드 테스트 페이지로 (삭제할거임)
    function go_upload()
    {   
        $this->load->view('upload_form');
    }   

    // 最初一回このリンクに入ってくる（非会員）
	public function index()
	{
        if( isset( $this->session->userdata['ss_user_id'] ) ){
            $this->session->unset_userdata('ss_user_id');
            $this->session->unset_userdata('ss_user_name');
            $this->session->unset_userdata('ss_user_no');

            $this->cart->destroy();
        }
        
        // セッションの登録（customer）
        $session_data = array(    
                    'ss_user_id'        => 'costomer', 
                    'ss_user_name'      => 'costomer',
                    'ss_user_no'        => 0
                );
        $this->session->set_userdata($session_data);  
        
        // modelのModel_EC.phpファイルをロード
//        $this->load->model('Model_EC');
        // カテゴリテーブルのデータを持ってくる
        $data_list['category'] = $this->Model_EC->get_category();
        $data_list['product'] = $this->Model_EC->get_all_product();
        // ec_mainページを開く
        redirect("home");
	}

    // 商品画像の登録
    public function do_upload()
    {
        $config['upload_path'] = './img';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        
        $this->load->library('upload', $config);
        $this->upload->do_upload();


        $this->load->model('Model_EC');
        $data_list['category'] = $this->Model_EC->get_category();
        $data_list['img'] = array(    
                    'img_path'        => '/img/'.$this->upload->data()['file_name']
                );

        $this->load->view('product_upload_page', $data_list);
    }

    // ロゴをクリックするとホームに移動
	public function home()
    {
		$data_list['category'] = $this->Model_EC->get_category();
        $data_list['product'] = $this->Model_EC->get_all_product();

        $this->load->view('ec_main', $data_list);
    }

    // カテゴリ別の商品一覧ページに移動
    public function category($page_id)
    {
        $this->load->model('Model_EC');
        $data_list['product'] = $this->Model_EC->get_product($page_id);
        $data_list['category'] = $this->Model_EC->get_category();
    
        $this->load->view('category_page', $data_list);
    }

    // 商品登録ページに移動（masterアカウント限定）
    public function product_upload_page()
    {
        $data_list['category'] = $this->Model_EC->get_category();

        $this->load->view('product_upload_page', $data_list);
    }

    // カテゴリ登録（商品登録ページ内）
    public function upload_category()
    {
        $data_list['category'] = $this->Model_EC->get_category();
        $this->Model_EC->upload_category($this->input->post('cg_name'));
    
        $this->product_upload_page();
    }

    // 商品登録（商品登録ページ内）
    public function upload_product()
    {
        $product_data = array(
            'cg_no' => (int)$this->input->post('cg_no'),
            'pd_number' => $this->input->post('pd_number'),
            'pd_img' => $this->input->post('pd_img'),
            'pd_name' => $this->input->post('pd_name'),
            'pd_price' => (int)$this->input->post('pd_price'),
            'pd_stock' => (int)$this->input->post('pd_stock'),
            'pd_comment' => $this->input->post('pd_comment'),
            'pd_memo' => $this->input->post('pd_memo')
        );
        
        echo "<script>alert('商品登録が終わりました。');</script>";

        $this->load->model('Model_EC');
        $data_list['category'] = $this->Model_EC->get_category();
        $this->Model_EC->upload_product($product_data);
    
        $this->home();
    }

    // 商品詳細ページに移動（一つの商品をクリックすると移動）
    public function product($product_no)
    {
        $this->load->model('Model_EC');
        $data_list['one_product'] = $this->Model_EC->get_one_product($product_no);
        $data_list['one_product_exp'] = $this->Model_EC->get_one_product_exp($product_no);
        $data_list['category'] = $this->Model_EC->get_category();
        $data_list['review'] = $this->Model_EC->get_review($product_no);
        $data_list['review_reply'] = $this->Model_EC->get_review_reply();
        $data_list['inquery'] = $this->Model_EC->get_inquery($product_no);
        $data_list['inquire_reply'] = $this->Model_EC->get_inquire_reply();

        $this->load->view('one_product_page', $data_list);
    }

    // お問い合わせの登録（商品詳細ページ内）
    public function insert_inquire()
    {
        $inquire_data = array(
            'user_no' => (int)$this->input->post('user_no'),
            'pd_no' => (int)$this->input->post('pd_no'),
            'inq_title' => $this->input->post('inq_title'),
            'inq_content' => $this->input->post('inq_content')
        );
        
        $this->load->model('Model_EC');
        $this->Model_EC->insert_inquire($inquire_data);

        $this->product($inquire_data['pd_no']);
    }

    // お問い合わせの返事の登録（商品詳細ページ内）
    public function insert_inquire_reply()
    {
        $inquire_data = array(
            'inq_no' => (int)$this->input->post('inq_no'),
            'inq_rp_title' => $this->input->post('inq_rp_title'),
            'inq_rp_content' => $this->input->post('inq_rp_content')
        );
        
        $this->load->model('Model_EC');
        $this->Model_EC->insert_inquire($inquire_data);

        $this->product($inquire_data['pd_no']);
    }

    //　ログインページに移動
    public function login_page()
    {   
        $this->load->model('Model_EC');
        $category_list['category'] = $this->Model_EC->get_category();

        $this->load->view('login_page', $category_list);
    }

    // ログインする
    public function login()
    {
        // ログインページの入力欄から値をもらう
        $login_data = array(
            'user_id' => $this->input->post('user_id'),
            'user_pw' => $this->input->post('user_pw')
        );

        if($login_data["user_id"] == "master"){
			$session_data = array(
				'ss_user_id'        => 'master',
				'ss_user_name'      => 'master',
				'ss_user_no'        => 0
			);
			$this->session->set_userdata($session_data);
			$this->load->view('ec_admin');

		}else {
			// アカウントとパスワードが一致するテーブルの数をもらう
			$login_ok_sum = $this->Model_EC->login_ok_sum($login_data);

			// $login_ok_sumが1ならログイン成功
			if ($login_ok_sum == 1) {
				// アカウントとパスワードが一致するテーブルをもらう
				$login_ok_userinfo = $this->Model_EC->login_ok_userinfo($login_data);
				// ログインに成功 > 該当ログイン情報でセッション生成
				$session_data = array(
					'ss_user_id' => $login_ok_userinfo[0]->user_id,
					'ss_user_name' => $login_ok_userinfo[0]->user_name,
					'ss_user_no' => $login_ok_userinfo[0]->user_no
				);
				$this->session->set_userdata($session_data);
				// 既存の非会員のカートの情報削除
				$this->cart->destroy();
				echo "<script>alert('ログインできました。');</script>";
				redirect("home");
			} else {
				echo "<script>alert('ログインできませんでした。正しい情報を入力してください。');</script>";
				$this->login_page();
			}
		}

        
    }

    // ログアウト実行
    public function logout()
    {
        echo "<script>alert('ログアウト完了');</script>";
		$this->index();
    }

    // 会員登録ページ移動
    public function signin_page()
    {
    	$this->load->model('Model_EC');
		$category_list['category'] = $this->Model_EC->get_category();
        
        $this->load->view('signin_page', $category_list);
    }

    // 会員登録実行
    public function signin()
    {
    	$signin_data = array(
			'user_id' => $this->input->post('user_id'),
			'user_pw' => $this->input->post('user_pw'),
			'user_name' => $this->input->post('user_name'),
			'user_sex' => $this->input->post('user_sex'),
			'user_email' => $this->input->post('user_email'),
			'user_phoneNumber' => $this->input->post('user_phoneNumber'),
			'user_birth' => $this->input->post('user_birth'),
			'user_address' => $this->input->post('user_address')
		);
		
		$this->load->model('Model_EC');

        $user_info = $this->Model_EC->get_all_user_info();
        foreach ($user_info as $ls) {
            if ($ls->user_id == $this->input->post('user_id')) {
                echo "<script>alert('同じアカウントがあります。ほかのIDを入力してください。');</script>";
                $this->signin_page();
                return ;
            }
        }

		$this->Model_EC->signin($signin_data);
        echo "<script>alert('会員登録完了　＞　ログインページに');</script>";
        $this->login_page();
    }

    // MyPageに移動($varが 1-非会員/２-会員)
    public function mypage($var)
    {

        $user_no = (int)$this->session->userdata['ss_user_no'];
        $data_list['user_info'] = $this->Model_EC->get_user_info($user_no);
        $data_list['order_main'] = $this->Model_EC->get_order_main($user_no);            
        $data_list['order_info'] = $this->Model_EC->get_order_info();
        $data_list['category'] = $this->Model_EC->get_category();
            
        $this->load->view('mypage', $data_list); 
    }

    public function updateUserInfo(){
		$user_id = $this->session->userdata['ss_user_id'];
		$user_pw = $this->input->post('user_pw');
		$user_name = $this->input->post('user_name');
		$user_email = $this->input->post('user_email');
		$user_phoneNumber = $this->input->post('user_phoneNumber');
		$user_address = $this->input->post('user_address');


		$data = array(
			"user_pw" => $user_pw,
			"user_name" => $user_name,
			"user_email" => $user_email,
			"user_phoneNumber" => (int)$user_phoneNumber,
			"user_address" => $user_address
		);
		$result = $this->Model_EC->updateUserInfo($data,$user_id);

		echo $result;

	}

	public function cartAll()
	{
		$user_no = $this->session->userdata['ss_user_no'];
		if($user_no != 0){
			$this->cart->destroy();
			$data = $this->Model_EC->get_cart($user_no);

			foreach($data as $data){
				$cart_data = array(
					// idには商品PKが入っている
					'id'      => $data->pd_no,
					'qty'     => $data->qty,
					'price'   => $data->pd_price,
					'name'    => $data->pd_name,
					'img'     => $data->pd_img,
					'stock'   => $data->pd_stock
				);
				$this->cart->insert($cart_data);
			}

		}

		$category_list['category'] = $this->Model_EC->get_category();
		$this->load->view('cart_page', $category_list);

	}

    // カートページに移動
    public function cart_page()
    {
		$pd_no = $this->input->get('pd_no');
		$od_qty = $this->input->get('qty');
		$this->cart($pd_no,$od_qty);
		$category_list['category'] = $this->Model_EC->get_category();
//		$this->load->view('cart_page', $category_list);

		redirect("cartAll");

    }

    // カートの実行（アップデートなどの実行）
    public function cart($pd_no,$od_qty)
    {

		$user_no = $this->session->userdata['ss_user_no'];
		$data = $this->Model_EC->get_one_product($pd_no) ;
		$overlap = false ;
		foreach ($this->cart->contents() as $items){
			if($items["id"] == $pd_no){
				$overlap = true ;
			}
		}
		$cart_data = array(
			// idには商品PKが入っている
			'id'      => $pd_no,
			'qty'     => $od_qty,
			'price'   => $data[0]->pd_price,
			'name'    => $data[0]->pd_name,
			'img'     => $data[0]->pd_img,
			'stock'   => $data[0]->pd_stock
 		);

		$this->cart->insert($cart_data);

		if($overlap == true){
			// product cart is already
			if($user_no != 0){
				foreach ($this->cart->contents() as $items){
					if($items["id"] == $pd_no){
						$to_cart_db = array(
							'user_no' => $user_no,
							'pd_no' => $pd_no,
							'qty' => $items["qty"]
						);
					}
				}
				// カートのデータをデータベースに入れる
				$this->Model_EC->update_cart_db($to_cart_db);
			}
		}else{
			if($user_no != 0){
				$to_cart_db = array(
					'user_no' => $user_no,
					'pd_no' => $pd_no,
					'qty' => $od_qty
				);
				// カートのデータをデータベースに入れる
				$this->Model_EC->insert_cart($to_cart_db);
			}
		}

    }

    // カートの実行
    public function update() {

		$user_no = $this->session->userdata['ss_user_no'];
        $cart_data = array();
        $qty = $this->input->post('qty');
        $rowid = $this->input->post('rowid');


        $flag = 0;
        for($i=0; $i < count($rowid); $i++) {
            $cart_data[$i] = array('qty' => $qty[$i], 'rowid' => $rowid[$i]);
        }

        $this->cart->update($cart_data);


		if($user_no != 0){
			$this->Model_EC->delete_all_cart_db((int)$this->session->userdata['ss_user_no']);
			foreach ( $this->cart->contents() as $ls) {
				$to_cart_data = array(
					'user_no'      => (int)$this->session->userdata['ss_user_no'],
					'pd_no'     => $ls['id'],
					'qty'     => $ls['qty']
				);
				$this->Model_EC->insert_cart( $to_cart_data );
			}
		}

		echo "successs";

    }
     
    // カートの実行
    public function destroy() {

    	$user_no = (int)$this->session->userdata['ss_user_no'] ;
        $this->cart->destroy();

        print_r($user_no);

		if($user_no != 0){
			$this->Model_EC->delete_all_cart_db($user_no);
		}


		echo "success";
    }

    // メインページと商品詳細ページでカゴへボタンを押した場合
//    public function quick_cart($pd_no)
//    {
//
//        $pd_info = $this->Model_EC->get_one_product($pd_no);
//
//        $cart_data = array(
//                // idには商品PKが入っている
//               'id'      => $pd_info[0]->pd_no,
//               'qty'     => 1,
//               'price'   => (int)$pd_info[0]->pd_price,
//               'name'    => $pd_info[0]->pd_name,
//               'img'     => $pd_info[0]->pd_img
//            );
//
//        echo $this->cart->insert($cart_data);
//
//
//		if($this->session->userdata['ss_user_no'] > 0){
//			$to_cart_db = array(
//				'user_no' => (int)$this->session->userdata['ss_user_no'],
//				'pd_no' => $pd_info[0]->pd_no,
//				'qty' => 1
//			);
//
//			//　データベースにカートのデータを入れる
//			$this->Model_EC->insert_cart($to_cart_db);
//		}
//
//
//        $category_list['category'] = $this->Model_EC->get_category();
//        $this->load->view('cart_page',$category_list);
//    }

    // 注文履歴確認ページに（非会員限定）
    public function order_info_page()
    {   

        $category_list['category'] = $this->Model_EC->get_category();
        $this->load->view('order_info_page', $category_list);
    }

    // 注文履歴確認（注文者名で確認）
    public function check_order_info_by_order_name()
    {   
        //echo $this->input->post('order_name');

        $data_list['category'] = $this->Model_EC->get_category();
        $data_list['order_main'] = $this->Model_EC->get_order_main_by_order_name( $this->input->post('order_name') );
        $data_list['order_info'] = $this->Model_EC->get_order_info();
        $this->load->view('order_info_page_for_customer', $data_list);
    }

    // 注文履歴確認（注文番号で確認）
    public function check_order_info_by_order_no()
    {   

        $data_list['category'] = $this->Model_EC->get_category();
        $data_list['order_main'] = $this->Model_EC->getOrderMain( (int)$this->input->post('order_no') );
        $data_list['order_info'] = $this->Model_EC->getOrderInfo((int)$this->input->post('order_no'));

        $this->load->view('order_info_page_for_customer', $data_list);
    }

    // カート＞注文ページに進む
    public function order_page()
    {


        $data_list['category'] = $this->Model_EC->get_category();
        $data_list['user_info'] = $this->Model_EC->get_user_info((int)$this->session->userdata['ss_user_no']);

        $this->load->view('order_page', $data_list);
    }

    // 注文確定実行
    public function order()
    {


        $order_info["user_no"] = (int)$this->session->userdata['ss_user_no'];
        $order_info["order_name"] = $this->input->post('order_name');
		$order_info["order_email"] = $this->input->post('order_email');
		$order_info["order_hp"] = $this->input->post('order_hp');
		$order_info["order_price"] = $this->input->post('order_price');
		$order_info["receiver_name"] = $this->input->post('receiver_name');
		$order_info["receiver_hp"] = $this->input->post('receiver_hp');
		$order_info["receiver_address"] = $this->input->post('receiver_address');
		$order_info["memo"] = $this->input->post('memo');
		$order_info["payment_option"] = $this->input->post('payment_option');
		$order_product = array();
		$orderType = $this->input->post('orderType');

		echo $order_info["order_price"];
		echo count($this->cart->contents());

		if($orderType === "orderCart"){

			foreach ( $this->cart->contents() as $ls) {

				$product['pd_no'] = $ls['id'];
				$product['od_qty'] = $ls['qty'];

				array_push($order_product,$product);
				$this->Model_EC->delete_cart($order_info["user_no"]);
				$this->destroy();
			}
		}else{
			echo  "ddd";
			$product['pd_no'] = $this->input->post('pd_no');
			$product['od_qty'] = $this->input->post('od_qty');
			array_push($order_product,$product);
		}


		$order_info["order_product"] = $order_product;

        $this->Model_EC->insert_order($order_info);


		redirect('orderSuccess');
//        $this->home();

    }


    // カート＞注文ページに進む
    public function buy_page()
    {
		$pd_no = $this->input->get('pd_no');
        $od_qty = $this->input->get('qty');

        if ( isset( $od_qty ))  {
            //echo $od_qty;

            $data_list['od_qty'] = $od_qty;
        }else{
			$data_list['od_qty'] = 1;
        }

        $data_list['category'] = $this->Model_EC->get_category();
        $data_list['user_info'] = $this->Model_EC->get_user_info((int)$this->session->userdata['ss_user_no']);
        $data_list['product'] = $this->Model_EC->get_one_product($pd_no);

        $this->load->view('order_page', $data_list);
    }

    function confirmCartStock(){
		$pd_no = $this->input->post('pd_no');
		$qty = "" ;
		foreach ( $this->cart->contents() as $ls) {

			if($ls["id"] == $pd_no){

				$qty = $ls["qty"];
			}
//			$qty = $ls;
		}


		echo json_encode($qty);


	}

	function orderStockCheck(){
		$pd_no = $this->input->post('pd_no');
	}

	function orderSuccess(){

    	$od_no = $this->Model_EC->get_order();
		$data["orderMain"] = $this->Model_EC->getOrderMain($od_no);
		$data["orderInfo"] = $this->Model_EC->getOrderInfo($od_no);
		$this->load->view('order_success',$data);
	}
}
?>
     



