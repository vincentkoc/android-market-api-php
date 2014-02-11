<?php
/**
 * @author Niklas Nilsson <splitfeed@gmail.com>
 *
 *
 */
class MarketSession {
	public $context = NULL;
	public $authSubToken = "";

	/**
	 *
	 */
	function __construct () {
		$this->context = new RequestContext();
		$this->context->setUnknown1(0);
		$this->context->setVersion(8013013);
		$this->context->setDeviceAndSdkVersion("crespo:15");

		$this->context->setUserLanguage("en");
		$this->context->setUserCountry("US");

		$this->setOperatorTmobile();
	}

	function setOperatorTmobile() {
		$this->setOperator("T-Mobile", "310260");
	}

	public function setOperatorSFR() {
		$this->setOperator("F SFR", "20810");
	}

	public function setOperatorO2() {
		$this->setOperator("o2 - de", "26207");
	}

	public function setOperatorSimyo() {
		$this->setOperator("E-Plus", "simyo", "26203", "26203");
	}

	public function setOperatorSunrise() {
		$this->setOperator("sunrise", "22802");
	}

	public function setOperator($alpha, $simAlpha, $numeric = "", $simNumeric = "") {
		if (!$numeric && !$simNumeric) {
			$this->context->setOperatorAlpha($alpha);
			$this->context->setSimOperatorAlpha($alpha);

			$this->context->setOperatorNumeric($simAlpha);
			$this->context->setSimOperatorNumeric($simAlpha);

		} else {
			$this->context->setOperatorAlpha($alpha);
			$this->context->setSimOperatorAlpha($simAlpha);

			$this->context->setOperatorNumeric($numeric);
			$this->context->setSimOperatorNumeric($simNumeric);
		}
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
		@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


		$headers = array(
			//"User-Agent: Android-Market/2 (sapphire PLAT-RC33); gzip",
			//"Content-Type: application/x-www-form-urlencoded",
			//"Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
			
			//New Headers - Old Ones Commented Out for Refernce
			"User-Agent: Android-Finsky/3.7.13 (api=3,versionCode=8013013,sdk=15,device=crespo,hardware=herring,product=soju)",
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
	 * @param integer $id Android Device ID
	 */
	public function setAndroidId($deviceId) {
		$this->context->setAndroidId($deviceId);
	}

	/**
	 * Validate all settings needed to make a request
	 */
	public function validate() {
		return true;

		//Check login
		/*
		if (!$this->context->hasAuthSubToken) return false;

		//Check androidId
		if (!$this->context->hasAndroidId) return false;

		return true;
		*/
	}

	/**
	 *
	 * @param unknown_type $requestGroup
	 */
	public function execute($requestGroup) {
		$request = new Request();
		$request->setContext($this->context);
		$request->addRequestGroup($requestGroup);

		return $this->executeProtobuf($request);
	}

	/**
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function executeProtobuf($request) {
		if (!$this->validate()) {
			throw new Exception("Missing authentication or Android ID");
		}

		$http = $this->executeRawHttpQuery($this->protobufToStr($request));

		$fp = fopen("php://memory", "w+b");
		fwrite($fp, $http, strlen($http));
		rewind($fp);
		$response = new Response();
		$response->read($fp);

		return $response;
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
		curl_setopt($ch, CURLOPT_URL, "https://android.clients.google.com/market/api/ApiRequest");
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_COOKIE, "ANDROID=".$this->authSubToken);
		//curl_setopt($ch, CURLOPT_USERAGENT, "Android-Market/2 (sapphire PLAT-RC33); gzip");
		curl_setopt($ch, CURLOPT_USERAGENT, "Android-Finsky/3.7.13 (api=3,versionCode=8013013,sdk=15,device=crespo,hardware=herring,product=soju)");
		
		$post = "version=2&request=".base64_encode($request);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

		$headers = array(
			"Content-Type: application/x-www-form-urlencoded",
			"Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
			'Content-Length: '.strlen($post)
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$ret = curl_exec($ch);

		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if ($http_code != 200) {
			throw new Exception("HTTP request returned code $http_code");
		}

		curl_close($ch);

		$ret = $this->gzdecode($ret);
		return $ret;
	}

	/**
	 * Borrowed from http://php.net/manual/en/function.gzdecode.php until a better solution is found
	 *
	 * Written by katzlbtjunk at hotmail dot com
	 */
	private function gzdecode($data,&$filename='',&$error='',$maxlength=null){
	    $len = strlen($data);
	    if ($len < 18 || strcmp(substr($data,0,2),"\x1f\x8b")) {
	        $error = "Not in GZIP format.";
	        return null;  // Not GZIP format (See RFC 1952)
	    }
	    $method = ord(substr($data,2,1));  // Compression method
	    $flags  = ord(substr($data,3,1));  // Flags
	    if ($flags & 31 != $flags) {
	        $error = "Reserved bits not allowed.";
	        return null;
	    }
	    // NOTE: $mtime may be negative (PHP integer limitations)
	    $mtime = unpack("V", substr($data,4,4));
	    $mtime = $mtime[1];
	    $xfl   = substr($data,8,1);
	    $os    = substr($data,8,1);
	    $headerlen = 10;
	    $extralen  = 0;
	    $extra     = "";
	    if ($flags & 4) {
	        // 2-byte length prefixed EXTRA data in header
	        if ($len - $headerlen - 2 < 8) {
	            return false;  // invalid
	        }
	        $extralen = unpack("v",substr($data,8,2));
	        $extralen = $extralen[1];
	        if ($len - $headerlen - 2 - $extralen < 8) {
	            return false;  // invalid
	        }
	        $extra = substr($data,10,$extralen);
	        $headerlen += 2 + $extralen;
	    }
	    $filenamelen = 0;
	    $filename = "";
	    if ($flags & 8) {
	        // C-style string
	        if ($len - $headerlen - 1 < 8) {
	            return false; // invalid
	        }
	        $filenamelen = strpos(substr($data,$headerlen),chr(0));
	        if ($filenamelen === false || $len - $headerlen - $filenamelen - 1 < 8) {
	            return false; // invalid
	        }
	        $filename = substr($data,$headerlen,$filenamelen);
	        $headerlen += $filenamelen + 1;
	    }
	    $commentlen = 0;
	    $comment = "";
	    if ($flags & 16) {
	        // C-style string COMMENT data in header
	        if ($len - $headerlen - 1 < 8) {
	            return false;    // invalid
	        }
	        $commentlen = strpos(substr($data,$headerlen),chr(0));
	        if ($commentlen === false || $len - $headerlen - $commentlen - 1 < 8) {
	            return false;    // Invalid header format
	        }
	        $comment = substr($data,$headerlen,$commentlen);
	        $headerlen += $commentlen + 1;
	    }
	    $headercrc = "";
	    if ($flags & 2) {
	        // 2-bytes (lowest order) of CRC32 on header present
	        if ($len - $headerlen - 2 < 8) {
	            return false;    // invalid
	        }
	        $calccrc = crc32(substr($data,0,$headerlen)) & 0xffff;
	        $headercrc = unpack("v", substr($data,$headerlen,2));
	        $headercrc = $headercrc[1];
	        if ($headercrc != $calccrc) {
	            $error = "Header checksum failed.";
	            return false;    // Bad header CRC
	        }
	        $headerlen += 2;
	    }
	    // GZIP FOOTER
	    $datacrc = unpack("V",substr($data,-8,4));
	    $datacrc = sprintf('%u',$datacrc[1] & 0xFFFFFFFF);
	    $isize = unpack("V",substr($data,-4));
	    $isize = $isize[1];
	    // decompression:
	    $bodylen = $len-$headerlen-8;
	    if ($bodylen < 1) {
	        // IMPLEMENTATION BUG!
	        return null;
	    }
	    $body = substr($data,$headerlen,$bodylen);
	    $data = "";
	    if ($bodylen > 0) {
	        switch ($method) {
	        case 8:
	            // Currently the only supported compression method:
	            $data = gzinflate($body,$maxlength);
	            break;
	        default:
	            $error = "Unknown compression method.";
	            return false;
	        }
	    }  // zero-byte body content is allowed
	    // Verifiy CRC32
	    $crc   = sprintf("%u",crc32($data));
	    $crcOK = $crc == $datacrc;
	    $lenOK = $isize == strlen($data);
	    if (!$lenOK || !$crcOK) {
	        $error = ( $lenOK ? '' : 'Length check FAILED. ') . ( $crcOK ? '' : 'Checksum FAILED.');
	        return false;
	    }
	    return $data;
	}
}
?>
