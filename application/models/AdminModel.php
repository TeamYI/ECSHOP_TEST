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
				order by a.od_date desc";

		$result = $this->db->query($sql);

		return $result->result() ;
	}

	public function selectOrderInfo($od_no){
		$sql = "select DATE_FORMAT(a.od_date, '%Y-%m-%d') as od_date,od_price ,od_no, b.payment_name, payment_check, delivery_status
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

		$sql ="select * from order_info 
			   where od_no = $od_no";

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

	public function selectProductList(){
		$sql = "select * from product_info";

		$result = $this->db->query($sql);

		return $result->result() ;
	}

	public function selectProduct($pd_no){
		$sql = "select * from product_info as p 
				left join category as c
				on c.cg_no = p.cg_no 
				where pd_no = '$pd_no' ";

		$result = $this->db->query($sql);
		$result = $result->result();
		$result = $result[0];
		return $result ;
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

	public function confirmCategoryNameOverlap($cg_name){
		$sql = "select count(*) as count from category where cg_name = '$cg_name'";

		$result = $this->db->query($sql);
		$result = $result->result();
		$result = $result[0];
		return $result ;
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

	public function updateProduct($data, $pd_no){
		$query = $this->db->update('product_info', $data, "pd_no = '$pd_no'");

	}

	public function confirmProductNumberOverlap($pdNumber){
		$sql = "select count(*) as count from product_info where pd_Number = '$pdNumber'";

		$result = $this->db->query($sql);
		$result = $result->result();
		$result = $result[0];
		return $result ;
	}

	public function selectUserList(){
		$sql = "select * from user_info";

		$result = $this->db->query($sql);

		return $result->result() ;
	}

	public function deleteCustomer($user_no){
		$sql = "delete from user_info where user_no = $user_no";

		$this->db->query($sql);
	}

}
?>
