<?php

/**
 * @author splitfeed
 *
 *
 */
class MarketSession {
	private $context = NULL;

	/**
	 *
	 */
	function __construct () {
		$this->context = new RequestContext();
		$this->context->setUnknown1(0);
		$this->context->setVersion(1002);
		$this->context->setAndroidId("0000000000000000");
		$this->context->setDeviceAndSdkVersion("sapphire:7");
		$this->context->setOperatorAlpha("T-Mobile");
		$this->context->setSimOperatorAlpha("310260");
	}

	/**
	 *
	 * @param unknown_type $email
	 * @param unknown_type $password
	 */
	public function login($email, $password) {
		$postFields	= array(
			"Email"			=> $email,
			"Passwd"		=> $password,
			"service"		=> "android",
			"accountType"	=> "GOOGLE",
		);
		$post = "";
		foreach ($postFields as $field => $val) {
			$post .= $field."=".urlencode($val)."&";
		}

		// create a new cURL resource
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://www.google.com/accounts/ClientLogin");
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

		$headers = array(
			"User-Agent: Android-Market/2 (sapphire PLAT-RC33); gzip",
			"Content-Type: application/x-www-form-urlencoded",
			"Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$ret = curl_exec($ch);
		curl_close($ch);

		$aRet = explode("\n", $ret);
		foreach ($aRet as $line) {
			if (substr($line,0,5) == "Auth=") {
				$this->authSubToken = substr($line,5);
				$this->context->setAuthSubToken($this->authSubToken);
				return $this->authSubToken;
			}
		}

		return false;
	}

	/**
	 *
	 * @param unknown_type $requestGroup
	 */
	public function execute($requestGroup) {
		$request = new Request();
		$request->setContext($this->context);
		$request->addRequestGroup($requestGroup);

		$this->executeProtobuf($request);
	}

	/**
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function executeProtobuf($request) {
		$response = $this->executeRawHttpQuery($this->protobufToStr($request));
	}

	private function protobufToStr($protoBuf) {
		$fp = fopen("php://memory", "w+b");
		$protoBuf->write($fp);

		rewind($fp);
		$str = '';
		while (!feof($fp)) {
			$str .= fread($fp, 8192);
		}

		return $str;
	}

	/**
	 *
	 * @param unknown_type $request
	 */
	private function executeRawHttpQuery($request) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://android.clients.google.com/market/api/ApiRequest");
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_COOKIE, "ANDROID=".$this->authSubToken);
		curl_setopt($ch, CURLOPT_USERAGENT, "Android-Market/2 (sapphire PLAT-RC33); gzip");

		$post = "version=2&request=".base64_encode($request);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

		$headers = array(
			"Content-Type: application/x-www-form-urlencoded",
			"Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
			'Content-Length: '.strlen($post)
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_VERBOSE, TRUE);

		$ret = curl_exec($ch);

		curl_close($ch);

		$ret = gzdecode($ret);

		$fp = fopen("php://memory", "w+b");
		fwrite($fp, $ret, strlen($ret));
		rewind($fp);


		$response = new Response();
		$response->read($fp);

		return $response;
	}
}

?>