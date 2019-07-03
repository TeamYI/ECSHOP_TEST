<?php
	class Model_EC extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    // カテゴリ情報
    public function get_category()
    {
        $strQuery = "SELECT * FROM category";
        return $this->db->query($strQuery)->result();
    }
    
    // レビュー情報
    public function get_review($product_no)
    {
        $query = "SELECT ui.user_name, pr.rev_no, pi.pd_name, pr.rev_img, pr.rev_explain 
            FROM product_review as pr
            JOIN product_info as pi
            ON pi.pd_no = pr.pd_no
            JOIN  user_info as ui
            ON ui.user_no = pr.user_no
            WHERE pr.pd_no = '$product_no'";
        return $this->db->query($query)->result();
    }

    // レビューの返事の情報
    public function get_review_reply()
    {
        $query = $this->db->get('review_reply'); 
        return $query->result();
    }
    
    // お問い合わせ情報
    public function get_inquery($product_no)
    {
        $query = "SELECT ui.user_name, iq.inq_no, iq.inq_title, iq.inq_content 
            FROM inquire as iq
            JOIN user_info as ui
            ON ui.user_no = iq.user_no
            WHERE iq.pd_no = '$product_no'";
        return $this->db->query($query)->result();
    }

    // お問い合わせの返事の情報
    public function get_inquire_reply()
    {
        $query = $this->db->get('inquire_reply'); 
        return $query->result();
    }

    // イメージファイルの経路
    public function get_img_src($var)
    {
        $strQuery = "SELECT pd_img FROM product_info WHERE pd_no = '$var'";
        return $this->db->query($strQuery)->result();
    }

    // カテゴリ別の商品の情報
    public function get_product($page_id)
    {
        $query = $this->db->order_by("pd_no", "desc")->get_where('product_info', array(
            'cg_no' => $page_id
        )); 
        return $query->result();
    }

    // すべての商品情報
    public function get_all_product()
    {
        $query = $this->db->order_by("pd_no", "desc")->get('product_info');  
        return $query->result();
    }

    // ユーザー全員の情報
    public function get_all_user_info()
    {
        $query = $this->db->get('user_info'); 
        return $query->result();
    }

    // ユーザー一人の情報
    public function get_user_info($user_no)
    {
        $query = $this->db->get_where('user_info', array(
            'user_no' => $user_no
        )); 
        return $query->result();
    }

    // 商品一つの情報
    public function get_one_product($product_no)
    {
        $query = $this->db->get_where('product_info', array(
            'pd_no' => $product_no
        )); 
        return $query->result();
    }

    // ユーザーのカートの情報
    public function get_cart()
    {
        $user_no = $this->session->userdata['ss_user_no'];  
        $ok = $this->db->get_where('cart', array(
            'user_no' => $user_no
        )); 
        return $ok->result();
    }

    // 商品の詳細説明（イメージと説明）
    public function get_one_product_exp($product_no)
    {
        $ok = $this->db->get_where('product_page_image_explain', array(
            'pd_no' => $product_no
        )); 
        return $ok->result();
    }

    // ログイン出来たら１できなかったら0
    public function login_ok_sum($login_data)
    {
        $user_id = $login_data['user_id'];
        $user_pw = $login_data['user_pw'];

        $query = $this->db->get_where('user_info', array(
            'user_id' => $user_id,
            'user_pw' => $user_pw
        )); 
        $num = $query->num_rows();
        // アカウントとパスワードがあったら１なかったら２
        return $num;
    }

    // ログイン出来たユーザーの情報
    public function login_ok_userinfo($login_data)
    {
        $user_id = $login_data['user_id'];
        $user_pw = $login_data['user_pw'];

        $query = $this->db->get_where('user_info', array(
            'user_id' => $user_id,
            'user_pw' => $user_pw
        )); 
        return $query->result();
    }

    // 会員登録
    public function signin($signin_data)
    {
        $user_id = $signin_data['user_id'];
        $user_pw = $signin_data['user_pw'];
        $user_name = $signin_data['user_name'];
        $user_sex = $signin_data['user_sex'];
        $user_email = $signin_data['user_email'];
        $user_phoneNumber = $signin_data['user_phoneNumber'];
        $user_birth = $signin_data['user_birth'];
        $user_address = $signin_data['user_address'];

        $strQuery = "INSERT INTO user_info 
                        (user_id, user_pw, user_name, user_sex, user_email, user_phoneNumber, user_birth, user_address) 
                    VALUES ('$user_id', '$user_pw', '$user_name', '$user_sex', '$user_email', '$user_phoneNumber', '$user_birth' , '$user_address')";
        $this->db->query($strQuery);
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

    // カートのデータを入れる
    public function insert_cart($cart_data)
    {
        // 받아온 연관배열을 각각 나눈다.
        $user_no = $this->session->userdata['ss_user_no'];
        $pd_no = $cart_data['pd_no'];
        $qty = $cart_data['qty'];

        $strQuery = "INSERT INTO cart 
                        (user_no, pd_no, qty) 
                    VALUES ('$user_no', '$pd_no', '$qty')";
        $this->db->query($strQuery);
    }

    // お問い合わせ登録
    public function insert_inquire($iq_data)
    {
        $user_no = $iq_data['user_no'];
        $pd_no = $iq_data['pd_no'];
        $inq_title = $iq_data['inq_title'];
        $inq_content = $iq_data['inq_content'];

        $strQuery = "INSERT INTO inquire 
                        (user_no, pd_no, inq_title, inq_content) 
                    VALUES ('$user_no', '$pd_no', '$inq_title', '$inq_content')";
        $this->db->query($strQuery);
    }

    // カートのデータを削除
    public function delete_cart($user_no)
    {
        $query = "DELETE FROM cart WHERE user_no = '$user_no'";
        $this->db->query($query);
    }

    // カートのデータを削除
    public function delete_cart_db($cart_data)
    {
        $user_no = $cart_data['user_no'];
        $pd_no = $cart_data['pd_no'];
        //$qty = $cart_data['qty'];
        $query = "DELETE FROM cart WHERE pd_no = '$pd_no' and user_no = '$user_no'";
        $this->db->query($query);
    }

    // カートのデータ全体を削除
    public function delete_all_cart_db($user_no)
    {
        $query = "DELETE FROM cart WHERE user_no = '$user_no'";
        $this->db->query($query);
    }

    // order_main　注文確定
    public function insert_order($user_no, $od_address)
    {
        $query = "INSERT INTO order_main (user_no, od_date, od_address) 
                            VALUES ('$user_no', NOW(), '$od_address');";
        $this->db->query($query);
    }

    // order_info　注文確定　
    public function insert_order_info($order_data)
    {
        $od_no = $order_data['od_no'];
        $pd_no = $order_data['pd_no'];
        $od_qty = $order_data['od_qty'];
        $query = "INSERT INTO order_info (od_no, pd_no, od_qty) 
                                VALUES ('$od_no', '$pd_no', '$od_qty');";
        $this->db->query($query);
    }

    // 注文の時、数量を減らす
    public function update_qty($pd_no, $pd_stock)
    {
        $query = "UPDATE product_info SET pd_stock = '$pd_stock' WHERE pd_no = '$pd_no';";
        $this->db->query($query);
    }

    // order_main　注文履歴
    public function get_order()
    {
        $query = "SELECT od_no FROM order_main ORDER BY od_no DESC LIMIT 1";
        return $this->db->query($query)->result();
    }

    // order_main　注文履歴　（ユーザー一人の）
    public function get_order_main($user_no)
    {
        $query = $this->db->order_by("od_no", "desc")->get_where('order_main', array(
            'user_no' => $user_no
        )); 
        return $query->result();
    }

    // order_info　注文履歴
    public function get_order_info()
    {
        $query = "SELECT oi.pd_no, oi.od_no, pi.pd_img, pi.pd_name, oi.od_qty
                FROM order_info as oi
                JOIN product_info as pi
                ON pi.pd_no = oi.pd_no";
        return $this->db->query($query)->result();
    }

    // 注文者名で注文情報のデータ得る　
    public function get_order_main_by_order_name($od_name)
    {
        $query = $this->db->get_where('order_main', array(
            'od_name' => $od_name
        )); 
        return $query->result();
    }

    // 注文番号で注文情報のデータ得る
    public function get_order_main_by_order_no($od_no)
    {
        $query = $this->db->get_where('order_main', array(
            'od_no' => $od_no
        )); 
        return $query->result();
    }

    // public function get_order_info2()
    // {
    //     $query = $this->db->get('order_info'); 
    //     return $query->result();
    // }

    // public function update_cart_db($cart_data)
    // {
    //     $user_no = $cart_data['user_no'];
    //     $pd_no = $cart_data['pd_no'];
    //     $qty = $cart_data['qty'];

    //     $query = "UPDATE cart SET qty='$qty' WHERE pd_no = '$pd_no' and user_no = '$user_no'";
    //     $this->db->query($query);
    // }

    // public function check_cart_db($cart_data)
    // {
    //     $user_no = $cart_data['user_no'];
    //     $pd_no = $cart_data['pd_no'];
    //     $qty = $cart_data['qty'];

    //     $query = $this->db->get_where('cart', array(
    //         'user_no' => $user_no,
    //         'pd_no' => $pd_no
    //     )); 
    //     //해당 쿼리실행결과의 테이블 수
    //     $num = $query->num_rows();
    //     //아디,비번 맞으면 1 / 아니면 0이 넘어감
    //     return $num;
    // }  

    // public function get_cart_db($user_no)
    // {
    //     $query = $this->db->get_where('cart', array(
    //         'user_no' => $user_no
    //     )); 
    //     return $query->result();
    // }

    // public function insert_cart_db($cart_data)
    // {
    //     // 받아온 연관배열을 각각 나눈다.
    //     $user_no = $this->session->userdata['ss_user_no'];
    //     $pd_no = $cart_data['pd_no'];
    //     $qty = $cart_data['qty'];

    //     $strQuery = "INSERT INTO cart (user_no, pd_no, qty) 
    //                 VALUES ('$user_no', '$pd_no', '$qty')";
    //     return $this->db->query($strQuery);
    // }
}
?>