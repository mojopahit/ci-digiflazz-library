<?php 

	// Codeigniter 3 API Digiflazz Created By PT. Digital Media Bangsa
	// Nugasin.com (Marketplace Freelance Online Indonesia)
	// ---------------------------------------------------------------

	/**
	 * 
	 */
	class Digilib
	{
		public static $sandbox;
		public static $user_digi;
		public static $key_digi;
		private static $header = 'Content-Type: application/json';
		private static $endpoint = 'https://api.digiflazz.com/v1/';

		function __construct()
		{
			$a =& get_instance();
			$a->load->model('Mapi', 'ma');
			$val = $a->ma->get(['a.api'=>'digiflazz'])->row();
			$val = json_decode($val->value, true);

			self::$user_digi = $val['user_digi'];
			self::$key_digi = $val['key_digi'];
		}

		private static function request($url, $data)
		{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, self::$endpoint.$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, [self::$header]);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			$result = curl_exec($ch);
			curl_close($ch);
    		$json = (!empty(json_decode($result, true)['data']) ? json_decode($result, true)['data'] : null);
			return $json;
		}

		public static function getSaldo()
		{
			$url = 'cek-saldo';

			$sign = self::$user_digi.self::$key_digi.'depo';
			$data = array('cmd'=> 'deposit',
					    'username'=> self::$user_digi,
					    'sign'=> md5($sign));

			$exec = self::request($url, $data);
			return $exec;
		}

		public static function getHarga($code = null) {
		
			$url = 'price-list';

			$sign = self::$user_digi.self::$key_digi.'pricelist';

			$data = array( 
				'cmd' => 'prepaid',
			    'username'=> self::$user_digi,
			    'sign'=> md5($sign),
			    'code'=>$code
			);
			$exec = self::request($url, $data);
			return $exec;
		}

		public static function getTopUp($trxid, $customer_no, $skuCode) {
			$url = 'transaction';

			$sign = self::$user_digi.self::$key_digi.$trxid;
			
			$data = array( 
			    'username'=> self::$user_digi,
			    'buyer_sku_code'=> $skuCode,
	    		'customer_no'=> $customer_no,
	    		'ref_id'=> $trxid,
			    'sign'=> md5($sign),
			    'msg'=>''
			);
			$exec = self::request($url, $data);
			return $exec;
		}

		public static function getStatus($trxid, $customer_no, $trx_code) {
			$url = 'transaction';
			$sign = self::$user_digi.self::$key_digi.$trxid;

			$data = array(
			    'username'=> self::$user_digi,
			    'buyer_sku_code'=> $trx_code,
	    		'customer_no'=> $customer_no,
	    		'ref_id'=> $trxid,
			    'sign'=> md5($sign),
			    'msg'=>''
			);
			$exec = self::request($url, $data);
			return $exec;
		}

	}
?>