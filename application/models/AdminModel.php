<?php

class AdminModel extends CI_Model
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function orderList(){
		$sql = "select DATE_FORMAT(a.od_date, '%Y-%m-%d') as od_date ,od_no, od_name, od_price, b.payment_name, payment_check, delivery_status
				from order_main as a 
				left join payment as b
				on a.payment_option = b.payment_no
				order by od_date";

		$result = $this->db->query($sql);

		return $result->result() ;
	}

	public function selectOrderInfo($od_no){
		$sql = "select DATE_FORMAT(a.od_date, '%Y-%m-%d') as od_date ,od_no, b.payment_name, payment_check, delivery_status
				from order_main as a 
				left join payment as b
				on a.payment_option = b.payment_no
				where od_no = '$od_no'";

		$result = $this->db->query($sql);
		$result = $result->result();
		$result = $result[0];
		return $result ;
	}

	public function selectOrdererInfo($od_no){
		$sql = "SELECT od_name,od_email, od_hp 
				from order_main
				where od_no = $od_no;";

		$result = $this->db->query($sql);
		$result = $result->result();
		$result = $result[0];
		return $result ;

	}

	public function selectReceiverInfo($od_no){
		$sql = "SELECT receiver_name,receiver_hp, receiver_address,memo 
				from delivery_info
				where od_no = $od_no;";

		$result = $this->db->query($sql);
		$result = $result->result();
		$result = $result[0];
		return $result ;
	}

	public function selectOrderProductInfo($od_no){

		$sql ="SELECT om.od_price ,oi.pd_no, oi.od_no, pi.pd_img, pi.pd_name, pi.pd_price, oi.od_qty
                FROM order_info as oi
                JOIN product_info as pi
                ON pi.pd_no = oi.pd_no
                JOIN order_main as om 
                ON om.od_no = oi.od_no
				where oi.od_no = $od_no";

		$result = $this->db->query($sql);
		$result = $result->result();
		return $result ;

	}

	public function updateOrderStatus($od_no,$paymentStatus, $deliveryStatus){

		$sql = "update order_main set payment_check = '$paymentStatus',delivery_status = '$deliveryStatus' where od_no = '$od_no'";

		$this->db->query($sql);


	}

	public function deleteOrder($od_no){
		$sql = "delete from order_main where od_no = $od_no";

		$this->db->query($sql);

	}

	public function selectProduct(){
		$sql = "select * from product_info";

		$result = $this->db->query($sql);

		return $result->result() ;
	}

	// カテゴリ情報
	public function get_category()
	{
		$strQuery = "SELECT * FROM category";
		return $this->db->query($strQuery)->result();
	}

	// カテゴリ登録
	public function upload_category($cg_name)
	{
		$object = array(
			'cg_name' => $cg_name
		);

		$this->db->insert('category', $object);
	}


	// 商品登録
	public function upload_product($product_data)
	{
		$product_data = array(
			'cg_no' => $product_data['cg_no'],
			'pd_number' => $product_data['pd_number'],
			'pd_img' => $product_data['pd_img'],
			'pd_name' => $product_data['pd_name'],
			'pd_price' => $product_data['pd_price'],
			'pd_stock' => $product_data['pd_stock'],
			'pd_comment' => $product_data['pd_comment'],
			'pd_memo' => $product_data['pd_memo']
		);
		$this->db->insert('product_info', $product_data);
	}

	public function deleteProduct($pd_no){
		$sql = "delete from product_info where pd_no = $pd_no";

		$this->db->query($sql);

	}

}
?>
