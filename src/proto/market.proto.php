<?php
// Please include the below file before market.proto.php
//require('protocolbuffers.inc.php');
// enum AppsRequest.OrderType
class AppsRequest_OrderType {
  const NONE = 0;
  const POPULAR = 1;
  const NEWEST = 2;
  const FEATURED = 3;

  public static $_values = array(
    0 => self::NONE,
    1 => self::POPULAR,
    2 => self::NEWEST,
    3 => self::FEATURED,
  );

  public static function toString($value) {
    if (is_null($value)) return null;
    if (array_key_exists($value, self::$_values))
      return self::$_values[$value];
    return 'UNKNOWN';
  }
}

// enum AppsRequest.ViewType
class AppsRequest_ViewType {
  const ALL = 0;
  const FREE = 1;
  const PAID = 2;

  public static $_values = array(
    0 => self::ALL,
    1 => self::FREE,
    2 => self::PAID,
  );

  public static function toString($value) {
    if (is_null($value)) return null;
    if (array_key_exists($value, self::$_values))
      return self::$_values[$value];
    return 'UNKNOWN';
  }
}

// message AppsRequest
class AppsRequest {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("AppsRequest: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->appType_ = $tmp;

          break;
        case 2:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->query_ = $tmp;
          $limit-=$len;
          break;
        case 3:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->categoryId_ = $tmp;
          $limit-=$len;
          break;
        case 4:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->appId_ = $tmp;
          $limit-=$len;
          break;
        case 6:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->withExtendedInfo_ = $tmp > 0 ? true : false;
          break;
        case 7:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->orderType_ = $tmp;

          break;
        case 8:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->startIndex_ = $tmp;

          break;
        case 9:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->entriesCount_ = $tmp;

          break;
        case 10:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->viewType_ = $tmp;

          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->appType_)) {
      fwrite($fp, "\x08");
      Protobuf::write_varint($fp, $this->appType_);
    }
    if (!is_null($this->query_)) {
      fwrite($fp, "\x12");
      Protobuf::write_varint($fp, strlen($this->query_));
      fwrite($fp, $this->query_);
    }
    if (!is_null($this->categoryId_)) {
      fwrite($fp, "\x1a");
      Protobuf::write_varint($fp, strlen($this->categoryId_));
      fwrite($fp, $this->categoryId_);
    }
    if (!is_null($this->appId_)) {
      fwrite($fp, "\"");
      Protobuf::write_varint($fp, strlen($this->appId_));
      fwrite($fp, $this->appId_);
    }
    if (!is_null($this->withExtendedInfo_)) {
      fwrite($fp, "0");
      Protobuf::write_varint($fp, $this->withExtendedInfo_ ? 1 : 0);
    }
    if (!is_null($this->orderType_)) {
      fwrite($fp, "8");
      Protobuf::write_varint($fp, $this->orderType_);
    }
    if (!is_null($this->startIndex_)) {
      fwrite($fp, "@");
      Protobuf::write_varint($fp, $this->startIndex_);
    }
    if (!is_null($this->entriesCount_)) {
      fwrite($fp, "H");
      Protobuf::write_varint($fp, $this->entriesCount_);
    }
    if (!is_null($this->viewType_)) {
      fwrite($fp, "P");
      Protobuf::write_varint($fp, $this->viewType_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->appType_)) {
      $size += 1 + Protobuf::size_varint($this->appType_);
    }
    if (!is_null($this->query_)) {
      $l = strlen($this->query_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->categoryId_)) {
      $l = strlen($this->categoryId_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->appId_)) {
      $l = strlen($this->appId_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->withExtendedInfo_)) {
      $size += 2;
    }
    if (!is_null($this->orderType_)) {
      $size += 1 + Protobuf::size_varint($this->orderType_);
    }
    if (!is_null($this->startIndex_)) {
      $size += 1 + Protobuf::size_varint($this->startIndex_);
    }
    if (!is_null($this->entriesCount_)) {
      $size += 1 + Protobuf::size_varint($this->entriesCount_);
    }
    if (!is_null($this->viewType_)) {
      $size += 1 + Protobuf::size_varint($this->viewType_);
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('appType_', AppType::toString($this->appType_))
         . Protobuf::toString('query_', $this->query_)
         . Protobuf::toString('categoryId_', $this->categoryId_)
         . Protobuf::toString('appId_', $this->appId_)
         . Protobuf::toString('withExtendedInfo_', $this->withExtendedInfo_)
         . Protobuf::toString('orderType_', AppsRequest_OrderType::toString($this->orderType_))
         . Protobuf::toString('startIndex_', $this->startIndex_)
         . Protobuf::toString('entriesCount_', $this->entriesCount_)
         . Protobuf::toString('viewType_', AppsRequest_ViewType::toString($this->viewType_));
  }

  // optional .AppType appType = 1;

  private $appType_ = null;
  public function clearAppType() { $this->appType_ = null; }
  public function hasAppType() { return $this->appType_ !== null; }
  public function getAppType() { if($this->appType_ === null) return AppType::NONE; else return $this->appType_; }
  public function setAppType($value) { $this->appType_ = $value; }

  // optional string query = 2;

  private $query_ = null;
  public function clearQuery() { $this->query_ = null; }
  public function hasQuery() { return $this->query_ !== null; }
  public function getQuery() { if($this->query_ === null) return ""; else return $this->query_; }
  public function setQuery($value) { $this->query_ = $value; }

  // optional string categoryId = 3;

  private $categoryId_ = null;
  public function clearCategoryId() { $this->categoryId_ = null; }
  public function hasCategoryId() { return $this->categoryId_ !== null; }
  public function getCategoryId() { if($this->categoryId_ === null) return ""; else return $this->categoryId_; }
  public function setCategoryId($value) { $this->categoryId_ = $value; }

  // optional string appId = 4;

  private $appId_ = null;
  public function clearAppId() { $this->appId_ = null; }
  public function hasAppId() { return $this->appId_ !== null; }
  public function getAppId() { if($this->appId_ === null) return ""; else return $this->appId_; }
  public function setAppId($value) { $this->appId_ = $value; }

  // optional bool withExtendedInfo = 6;

  private $withExtendedInfo_ = null;
  public function clearWithExtendedInfo() { $this->withExtendedInfo_ = null; }
  public function hasWithExtendedInfo() { return $this->withExtendedInfo_ !== null; }
  public function getWithExtendedInfo() { if($this->withExtendedInfo_ === null) return false; else return $this->withExtendedInfo_; }
  public function setWithExtendedInfo($value) { $this->withExtendedInfo_ = $value; }

  // optional .AppsRequest.OrderType orderType = 7 [default = NONE];

  private $orderType_ = null;
  public function clearOrderType() { $this->orderType_ = null; }
  public function hasOrderType() { return $this->orderType_ !== null; }
  public function getOrderType() { if($this->orderType_ === null) return AppsRequest_OrderType::NONE; else return $this->orderType_; }
  public function setOrderType($value) { $this->orderType_ = $value; }

  // optional uint64 startIndex = 8;

  private $startIndex_ = null;
  public function clearStartIndex() { $this->startIndex_ = null; }
  public function hasStartIndex() { return $this->startIndex_ !== null; }
  public function getStartIndex() { if($this->startIndex_ === null) return 0; else return $this->startIndex_; }
  public function setStartIndex($value) { $this->startIndex_ = $value; }

  // optional int32 entriesCount = 9;

  private $entriesCount_ = null;
  public function clearEntriesCount() { $this->entriesCount_ = null; }
  public function hasEntriesCount() { return $this->entriesCount_ !== null; }
  public function getEntriesCount() { if($this->entriesCount_ === null) return 0; else return $this->entriesCount_; }
  public function setEntriesCount($value) { $this->entriesCount_ = $value; }

  // optional .AppsRequest.ViewType viewType = 10 [default = ALL];

  private $viewType_ = null;
  public function clearViewType() { $this->viewType_ = null; }
  public function hasViewType() { return $this->viewType_ !== null; }
  public function getViewType() { if($this->viewType_ === null) return AppsRequest_ViewType::ALL; else return $this->viewType_; }
  public function setViewType($value) { $this->viewType_ = $value; }

  // @@protoc_insertion_point(class_scope:AppsRequest)
}

// message AppsResponse
class AppsResponse {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("AppsResponse: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->app_[] = new App($fp, $len);
          ASSERT('$len == 0');
          break;
        case 2:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->numTotalEntries_ = $tmp;

          break;
        case 3:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->correctedQuery_ = $tmp;
          $limit-=$len;
          break;
        case 4:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->altAsset_[] = new App($fp, $len);
          ASSERT('$len == 0');
          break;
        case 5:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->numCorrectedEntries_ = $tmp;

          break;
        case 6:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->header_ = $tmp;
          $limit-=$len;
          break;
        case 7:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->listType_ = $tmp;

          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->app_))
      foreach($this->app_ as $v) {
        fwrite($fp, "\x0a");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
    if (!is_null($this->numTotalEntries_)) {
      fwrite($fp, "\x10");
      Protobuf::write_varint($fp, $this->numTotalEntries_);
    }
    if (!is_null($this->correctedQuery_)) {
      fwrite($fp, "\x1a");
      Protobuf::write_varint($fp, strlen($this->correctedQuery_));
      fwrite($fp, $this->correctedQuery_);
    }
    if (!is_null($this->altAsset_))
      foreach($this->altAsset_ as $v) {
        fwrite($fp, "\"");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
    if (!is_null($this->numCorrectedEntries_)) {
      fwrite($fp, "(");
      Protobuf::write_varint($fp, $this->numCorrectedEntries_);
    }
    if (!is_null($this->header_)) {
      fwrite($fp, "2");
      Protobuf::write_varint($fp, strlen($this->header_));
      fwrite($fp, $this->header_);
    }
    if (!is_null($this->listType_)) {
      fwrite($fp, "8");
      Protobuf::write_varint($fp, $this->listType_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->app_))
      foreach($this->app_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->numTotalEntries_)) {
      $size += 1 + Protobuf::size_varint($this->numTotalEntries_);
    }
    if (!is_null($this->correctedQuery_)) {
      $l = strlen($this->correctedQuery_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->altAsset_))
      foreach($this->altAsset_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->numCorrectedEntries_)) {
      $size += 1 + Protobuf::size_varint($this->numCorrectedEntries_);
    }
    if (!is_null($this->header_)) {
      $l = strlen($this->header_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->listType_)) {
      $size += 1 + Protobuf::size_varint($this->listType_);
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('app_', $this->app_)
         . Protobuf::toString('numTotalEntries_', $this->numTotalEntries_)
         . Protobuf::toString('correctedQuery_', $this->correctedQuery_)
         . Protobuf::toString('altAsset_', $this->altAsset_)
         . Protobuf::toString('numCorrectedEntries_', $this->numCorrectedEntries_)
         . Protobuf::toString('header_', $this->header_)
         . Protobuf::toString('listType_', $this->listType_);
  }

  // repeated .App app = 1;

  private $app_ = null;
  public function clearApp() { $this->app_ = null; }
  public function getAppCount() { if ($this->app_ === null ) return 0; else return count($this->app_); }
  public function getApp($index) { return $this->app_[$index]; }
  public function getAppArray() { if ($this->app_ === null ) return array(); else return $this->app_; }
  public function setApp($index, $value) {$this->app_[$index] = $value;	}
  public function addApp($value) { $this->app_[] = $value; }
  public function addAllApp(array $values) { foreach($values as $value) {$this->app_[] = $value;} }

  // optional int64 numTotalEntries = 2;

  private $numTotalEntries_ = null;
  public function clearNumTotalEntries() { $this->numTotalEntries_ = null; }
  public function hasNumTotalEntries() { return $this->numTotalEntries_ !== null; }
  public function getNumTotalEntries() { if($this->numTotalEntries_ === null) return 0; else return $this->numTotalEntries_; }
  public function setNumTotalEntries($value) { $this->numTotalEntries_ = $value; }

  // optional string correctedQuery = 3;

  private $correctedQuery_ = null;
  public function clearCorrectedQuery() { $this->correctedQuery_ = null; }
  public function hasCorrectedQuery() { return $this->correctedQuery_ !== null; }
  public function getCorrectedQuery() { if($this->correctedQuery_ === null) return ""; else return $this->correctedQuery_; }
  public function setCorrectedQuery($value) { $this->correctedQuery_ = $value; }

  // repeated .App altAsset = 4;

  private $altAsset_ = null;
  public function clearAltAsset() { $this->altAsset_ = null; }
  public function getAltAssetCount() { if ($this->altAsset_ === null ) return 0; else return count($this->altAsset_); }
  public function getAltAsset($index) { return $this->altAsset_[$index]; }
  public function getAltAssetArray() { if ($this->altAsset_ === null ) return array(); else return $this->altAsset_; }
  public function setAltAsset($index, $value) {$this->altAsset_[$index] = $value;	}
  public function addAltAsset($value) { $this->altAsset_[] = $value; }
  public function addAllAltAsset(array $values) { foreach($values as $value) {$this->altAsset_[] = $value;} }

  // optional int64 numCorrectedEntries = 5;

  private $numCorrectedEntries_ = null;
  public function clearNumCorrectedEntries() { $this->numCorrectedEntries_ = null; }
  public function hasNumCorrectedEntries() { return $this->numCorrectedEntries_ !== null; }
  public function getNumCorrectedEntries() { if($this->numCorrectedEntries_ === null) return 0; else return $this->numCorrectedEntries_; }
  public function setNumCorrectedEntries($value) { $this->numCorrectedEntries_ = $value; }

  // optional string header = 6;

  private $header_ = null;
  public function clearHeader() { $this->header_ = null; }
  public function hasHeader() { return $this->header_ !== null; }
  public function getHeader() { if($this->header_ === null) return ""; else return $this->header_; }
  public function setHeader($value) { $this->header_ = $value; }

  // optional int32 listType = 7;

  private $listType_ = null;
  public function clearListType() { $this->listType_ = null; }
  public function hasListType() { return $this->listType_ !== null; }
  public function getListType() { if($this->listType_ === null) return 0; else return $this->listType_; }
  public function setListType($value) { $this->listType_ = $value; }

  // @@protoc_insertion_point(class_scope:AppsResponse)
}



// group App.ExtendedInfo.PackageDependency
class App_ExtendedInfo_PackageDependency {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("App_ExtendedInfo_PackageDependency: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 39:
          ASSERT('$wire == 4');
          break 2;
        case 41:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->packageName_ = $tmp;
          $limit-=$len;
          break;
        case 42:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->skipPermissions_ = $tmp > 0 ? true : false;
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->packageName_)) {
      fwrite($fp, "\xca\x02");
      Protobuf::write_varint($fp, strlen($this->packageName_));
      fwrite($fp, $this->packageName_);
    }
    if (!is_null($this->skipPermissions_)) {
      fwrite($fp, "\xd0\x02");
      Protobuf::write_varint($fp, $this->skipPermissions_ ? 1 : 0);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->packageName_)) {
      $l = strlen($this->packageName_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->skipPermissions_)) {
      $size += 3;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('packageName_', $this->packageName_)
         . Protobuf::toString('skipPermissions_', $this->skipPermissions_);
  }

  // optional string packageName = 41;

  private $packageName_ = null;
  public function clearPackageName() { $this->packageName_ = null; }
  public function hasPackageName() { return $this->packageName_ !== null; }
  public function getPackageName() { if($this->packageName_ === null) return ""; else return $this->packageName_; }
  public function setPackageName($value) { $this->packageName_ = $value; }

  // optional bool skipPermissions = 42;

  private $skipPermissions_ = null;
  public function clearSkipPermissions() { $this->skipPermissions_ = null; }
  public function hasSkipPermissions() { return $this->skipPermissions_ !== null; }
  public function getSkipPermissions() { if($this->skipPermissions_ === null) return false; else return $this->skipPermissions_; }
  public function setSkipPermissions($value) { $this->skipPermissions_ = $value; }

  // @@protoc_insertion_point(class_scope:App.ExtendedInfo.PackageDependency)
}

// group App.ExtendedInfo
class App_ExtendedInfo {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("App_ExtendedInfo: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 12:
          ASSERT('$wire == 4');
          break 2;
        case 13:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->description_ = $tmp;
          $limit-=$len;
          break;
        case 14:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->downloadsCount_ = $tmp;

          break;
        case 15:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->permissionId_[] = $tmp;
          $limit-=$len;
          break;
        case 16:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->installSize_ = $tmp;

          break;
        case 17:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->packageName_ = $tmp;
          $limit-=$len;
          break;
        case 18:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->category_ = $tmp;
          $limit-=$len;
          break;
        case 20:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->contactEmail_ = $tmp;
          $limit-=$len;
          break;
        case 23:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->downloadsCountText_ = $tmp;
          $limit-=$len;
          break;
        case 26:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->contactPhone_ = $tmp;
          $limit-=$len;
          break;
        case 27:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->contactWebsite_ = $tmp;
          $limit-=$len;
          break;
        case 30:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->screenshotsCount_ = $tmp;

          break;
        case 31:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->promoText_ = $tmp;
          $limit-=$len;
          break;
        case 36:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->contentRatingLevel_ = $tmp;

          break;
        case 37:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->contentRatingString_ = $tmp;
          $limit-=$len;
          break;
        case 38:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->recentChanges_ = $tmp;
          $limit-=$len;
          break;
        case 39:
          ASSERT('$wire == 3');
          $this->packagedependency_[] = new App_ExtendedInfo_PackageDependency($fp, $limit);
          break;
        case 43:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->videoLink_ = $tmp;
          $limit-=$len;
          break;
        case 49:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->downloadInfo_ = new DownloadInfo($fp, $len);
          ASSERT('$len == 0');
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->description_)) {
      fwrite($fp, "j");
      Protobuf::write_varint($fp, strlen($this->description_));
      fwrite($fp, $this->description_);
    }
    if (!is_null($this->downloadsCount_)) {
      fwrite($fp, "p");
      Protobuf::write_varint($fp, $this->downloadsCount_);
    }
    if (!is_null($this->permissionId_))
      foreach($this->permissionId_ as $v) {
        fwrite($fp, "z");
        Protobuf::write_varint($fp, strlen($v));
        fwrite($fp, $v);
      }
    if (!is_null($this->installSize_)) {
      fwrite($fp, "\x80\x01");
      Protobuf::write_varint($fp, $this->installSize_);
    }
    if (!is_null($this->packageName_)) {
      fwrite($fp, "\x8a\x01");
      Protobuf::write_varint($fp, strlen($this->packageName_));
      fwrite($fp, $this->packageName_);
    }
    if (!is_null($this->category_)) {
      fwrite($fp, "\x92\x01");
      Protobuf::write_varint($fp, strlen($this->category_));
      fwrite($fp, $this->category_);
    }
    if (!is_null($this->contactEmail_)) {
      fwrite($fp, "\xa2\x01");
      Protobuf::write_varint($fp, strlen($this->contactEmail_));
      fwrite($fp, $this->contactEmail_);
    }
    if (!is_null($this->downloadsCountText_)) {
      fwrite($fp, "\xba\x01");
      Protobuf::write_varint($fp, strlen($this->downloadsCountText_));
      fwrite($fp, $this->downloadsCountText_);
    }
    if (!is_null($this->contactPhone_)) {
      fwrite($fp, "\xd2\x01");
      Protobuf::write_varint($fp, strlen($this->contactPhone_));
      fwrite($fp, $this->contactPhone_);
    }
    if (!is_null($this->contactWebsite_)) {
      fwrite($fp, "\xda\x01");
      Protobuf::write_varint($fp, strlen($this->contactWebsite_));
      fwrite($fp, $this->contactWebsite_);
    }
    if (!is_null($this->screenshotsCount_)) {
      fwrite($fp, "\xf0\x01");
      Protobuf::write_varint($fp, $this->screenshotsCount_);
    }
    if (!is_null($this->promoText_)) {
      fwrite($fp, "\xfa\x01");
      Protobuf::write_varint($fp, strlen($this->promoText_));
      fwrite($fp, $this->promoText_);
    }
    if (!is_null($this->contentRatingLevel_)) {
      fwrite($fp, "\xa0\x02");
      Protobuf::write_varint($fp, $this->contentRatingLevel_);
    }
    if (!is_null($this->contentRatingString_)) {
      fwrite($fp, "\xaa\x02");
      Protobuf::write_varint($fp, strlen($this->contentRatingString_));
      fwrite($fp, $this->contentRatingString_);
    }
    if (!is_null($this->recentChanges_)) {
      fwrite($fp, "\xb2\x02");
      Protobuf::write_varint($fp, strlen($this->recentChanges_));
      fwrite($fp, $this->recentChanges_);
    }
    if (!is_null($this->packagedependency_))
      foreach($this->packagedependency_ as $v) {
        fwrite($fp, "\xbb\x02");
        $v->write($fp); // group
        fwrite($fp, "\xbc\x02");
      }
    if (!is_null($this->videoLink_)) {
      fwrite($fp, "\xda\x02");
      Protobuf::write_varint($fp, strlen($this->videoLink_));
      fwrite($fp, $this->videoLink_);
    }
    if (!is_null($this->downloadInfo_)) {
      fwrite($fp, "\x8a\x03");
      Protobuf::write_varint($fp, $this->downloadInfo_->size()); // message
      $this->downloadInfo_->write($fp);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->description_)) {
      $l = strlen($this->description_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->downloadsCount_)) {
      $size += 1 + Protobuf::size_varint($this->downloadsCount_);
    }
    if (!is_null($this->permissionId_))
      foreach($this->permissionId_ as $v) {
        $l = strlen($v);
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->installSize_)) {
      $size += 2 + Protobuf::size_varint($this->installSize_);
    }
    if (!is_null($this->packageName_)) {
      $l = strlen($this->packageName_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->category_)) {
      $l = strlen($this->category_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->contactEmail_)) {
      $l = strlen($this->contactEmail_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->downloadsCountText_)) {
      $l = strlen($this->downloadsCountText_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->contactPhone_)) {
      $l = strlen($this->contactPhone_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->contactWebsite_)) {
      $l = strlen($this->contactWebsite_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->screenshotsCount_)) {
      $size += 2 + Protobuf::size_varint($this->screenshotsCount_);
    }
    if (!is_null($this->promoText_)) {
      $l = strlen($this->promoText_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->contentRatingLevel_)) {
      $size += 2 + Protobuf::size_varint($this->contentRatingLevel_);
    }
    if (!is_null($this->contentRatingString_)) {
      $l = strlen($this->contentRatingString_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->recentChanges_)) {
      $l = strlen($this->recentChanges_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->packagedependency_))
      foreach($this->packagedependency_ as $v) {
        $size += 4 + $v->size();
      }
    if (!is_null($this->videoLink_)) {
      $l = strlen($this->videoLink_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->downloadInfo_)) {
      $l = $this->downloadInfo_->size();
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('description_', $this->description_)
         . Protobuf::toString('downloadsCount_', $this->downloadsCount_)
         . Protobuf::toString('permissionId_', $this->permissionId_)
         . Protobuf::toString('installSize_', $this->installSize_)
         . Protobuf::toString('packageName_', $this->packageName_)
         . Protobuf::toString('category_', $this->category_)
         . Protobuf::toString('contactEmail_', $this->contactEmail_)
         . Protobuf::toString('downloadsCountText_', $this->downloadsCountText_)
         . Protobuf::toString('contactPhone_', $this->contactPhone_)
         . Protobuf::toString('contactWebsite_', $this->contactWebsite_)
         . Protobuf::toString('screenshotsCount_', $this->screenshotsCount_)
         . Protobuf::toString('promoText_', $this->promoText_)
         . Protobuf::toString('contentRatingLevel_', $this->contentRatingLevel_)
         . Protobuf::toString('contentRatingString_', $this->contentRatingString_)
         . Protobuf::toString('recentChanges_', $this->recentChanges_)
         . Protobuf::toString('packagedependency_', $this->packagedependency_)
         . Protobuf::toString('videoLink_', $this->videoLink_)
         . Protobuf::toString('downloadInfo_', $this->downloadInfo_);
  }

  // optional string description = 13;

  private $description_ = null;
  public function clearDescription() { $this->description_ = null; }
  public function hasDescription() { return $this->description_ !== null; }
  public function getDescription() { if($this->description_ === null) return ""; else return $this->description_; }
  public function setDescription($value) { $this->description_ = $value; }

  // optional int32 downloadsCount = 14;

  private $downloadsCount_ = null;
  public function clearDownloadsCount() { $this->downloadsCount_ = null; }
  public function hasDownloadsCount() { return $this->downloadsCount_ !== null; }
  public function getDownloadsCount() { if($this->downloadsCount_ === null) return 0; else return $this->downloadsCount_; }
  public function setDownloadsCount($value) { $this->downloadsCount_ = $value; }

  // repeated string permissionId = 15;

  private $permissionId_ = null;
  public function clearPermissionId() { $this->permissionId_ = null; }
  public function getPermissionIdCount() { if ($this->permissionId_ === null ) return 0; else return count($this->permissionId_); }
  public function getPermissionId($index) { return $this->permissionId_[$index]; }
  public function getPermissionIdArray() { if ($this->permissionId_ === null ) return array(); else return $this->permissionId_; }
  public function setPermissionId($index, $value) {$this->permissionId_[$index] = $value;	}
  public function addPermissionId($value) { $this->permissionId_[] = $value; }
  public function addAllPermissionId(array $values) { foreach($values as $value) {$this->permissionId_[] = $value;} }

  // optional int32 installSize = 16;

  private $installSize_ = null;
  public function clearInstallSize() { $this->installSize_ = null; }
  public function hasInstallSize() { return $this->installSize_ !== null; }
  public function getInstallSize() { if($this->installSize_ === null) return 0; else return $this->installSize_; }
  public function setInstallSize($value) { $this->installSize_ = $value; }

  // optional string packageName = 17;

  private $packageName_ = null;
  public function clearPackageName() { $this->packageName_ = null; }
  public function hasPackageName() { return $this->packageName_ !== null; }
  public function getPackageName() { if($this->packageName_ === null) return ""; else return $this->packageName_; }
  public function setPackageName($value) { $this->packageName_ = $value; }

  // optional string category = 18;

  private $category_ = null;
  public function clearCategory() { $this->category_ = null; }
  public function hasCategory() { return $this->category_ !== null; }
  public function getCategory() { if($this->category_ === null) return ""; else return $this->category_; }
  public function setCategory($value) { $this->category_ = $value; }

  // optional string contactEmail = 20;

  private $contactEmail_ = null;
  public function clearContactEmail() { $this->contactEmail_ = null; }
  public function hasContactEmail() { return $this->contactEmail_ !== null; }
  public function getContactEmail() { if($this->contactEmail_ === null) return ""; else return $this->contactEmail_; }
  public function setContactEmail($value) { $this->contactEmail_ = $value; }

  // optional string downloadsCountText = 23;

  private $downloadsCountText_ = null;
  public function clearDownloadsCountText() { $this->downloadsCountText_ = null; }
  public function hasDownloadsCountText() { return $this->downloadsCountText_ !== null; }
  public function getDownloadsCountText() { if($this->downloadsCountText_ === null) return ""; else return $this->downloadsCountText_; }
  public function setDownloadsCountText($value) { $this->downloadsCountText_ = $value; }

  // optional string contactPhone = 26;

  private $contactPhone_ = null;
  public function clearContactPhone() { $this->contactPhone_ = null; }
  public function hasContactPhone() { return $this->contactPhone_ !== null; }
  public function getContactPhone() { if($this->contactPhone_ === null) return ""; else return $this->contactPhone_; }
  public function setContactPhone($value) { $this->contactPhone_ = $value; }

  // optional string contactWebsite = 27;

  private $contactWebsite_ = null;
  public function clearContactWebsite() { $this->contactWebsite_ = null; }
  public function hasContactWebsite() { return $this->contactWebsite_ !== null; }
  public function getContactWebsite() { if($this->contactWebsite_ === null) return ""; else return $this->contactWebsite_; }
  public function setContactWebsite($value) { $this->contactWebsite_ = $value; }

  // optional int32 screenshotsCount = 30;

  private $screenshotsCount_ = null;
  public function clearScreenshotsCount() { $this->screenshotsCount_ = null; }
  public function hasScreenshotsCount() { return $this->screenshotsCount_ !== null; }
  public function getScreenshotsCount() { if($this->screenshotsCount_ === null) return 0; else return $this->screenshotsCount_; }
  public function setScreenshotsCount($value) { $this->screenshotsCount_ = $value; }

  // optional string promoText = 31;

  private $promoText_ = null;
  public function clearPromoText() { $this->promoText_ = null; }
  public function hasPromoText() { return $this->promoText_ !== null; }
  public function getPromoText() { if($this->promoText_ === null) return ""; else return $this->promoText_; }
  public function setPromoText($value) { $this->promoText_ = $value; }

  // optional int32 contentRatingLevel = 36;

  private $contentRatingLevel_ = null;
  public function clearContentRatingLevel() { $this->contentRatingLevel_ = null; }
  public function hasContentRatingLevel() { return $this->contentRatingLevel_ !== null; }
  public function getContentRatingLevel() { if($this->contentRatingLevel_ === null) return 0; else return $this->contentRatingLevel_; }
  public function setContentRatingLevel($value) { $this->contentRatingLevel_ = $value; }

  // optional string contentRatingString = 37;

  private $contentRatingString_ = null;
  public function clearContentRatingString() { $this->contentRatingString_ = null; }
  public function hasContentRatingString() { return $this->contentRatingString_ !== null; }
  public function getContentRatingString() { if($this->contentRatingString_ === null) return ""; else return $this->contentRatingString_; }
  public function setContentRatingString($value) { $this->contentRatingString_ = $value; }

  // optional string recentChanges = 38;

  private $recentChanges_ = null;
  public function clearRecentChanges() { $this->recentChanges_ = null; }
  public function hasRecentChanges() { return $this->recentChanges_ !== null; }
  public function getRecentChanges() { if($this->recentChanges_ === null) return ""; else return $this->recentChanges_; }
  public function setRecentChanges($value) { $this->recentChanges_ = $value; }

  // repeated group PackageDependency = 39
  private $packagedependency_ = null;
  public function clearPackagedependency() { $this->packagedependency_ = null; }
  public function getPackagedependencyCount() { if ($this->packagedependency_ === null ) return 0; else return count($this->packagedependency_); }
  public function getPackagedependency($index) { return $this->packagedependency_[$index]; }
  public function getPackagedependencyArray() { if ($this->packagedependency_ === null ) return array(); else return $this->packagedependency_; }
  public function setPackagedependency($index, $value) {$this->packagedependency_[$index] = $value;	}
  public function addPackagedependency($value) { $this->packagedependency_[] = $value; }
  public function addAllPackagedependency(array $values) { foreach($values as $value) {$this->packagedependency_[] = $value;} }

  // optional string videoLink = 43;

  private $videoLink_ = null;
  public function clearVideoLink() { $this->videoLink_ = null; }
  public function hasVideoLink() { return $this->videoLink_ !== null; }
  public function getVideoLink() { if($this->videoLink_ === null) return ""; else return $this->videoLink_; }
  public function setVideoLink($value) { $this->videoLink_ = $value; }

  // optional .DownloadInfo downloadInfo = 49;

  private $downloadInfo_ = null;
  public function clearDownloadInfo() { $this->downloadInfo_ = null; }
  public function hasDownloadInfo() { return $this->downloadInfo_ !== null; }
  public function getDownloadInfo() { if($this->downloadInfo_ === null) return null; else return $this->downloadInfo_; }
  public function setDownloadInfo(DownloadInfo $value) { $this->downloadInfo_ = $value; }

  // @@protoc_insertion_point(class_scope:App.ExtendedInfo)
}

// message App
class App {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("App: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->id_ = $tmp;
          $limit-=$len;
          break;
        case 2:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->title_ = $tmp;
          $limit-=$len;
          break;
        case 3:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->appType_ = $tmp;

          break;
        case 4:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->creator_ = $tmp;
          $limit-=$len;
          break;
        case 5:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->version_ = $tmp;
          $limit-=$len;
          break;
        case 6:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->price_ = $tmp;
          $limit-=$len;
          break;
        case 7:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->rating_ = $tmp;
          $limit-=$len;
          break;
        case 8:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->ratingsCount_ = $tmp;

          break;
        case 12:
          ASSERT('$wire == 3');
          $this->extendedinfo_ = new App_ExtendedInfo($fp, $limit);
          break;
        case 22:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->creatorId_ = $tmp;
          $limit-=$len;
          break;
        case 24:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->packageName_ = $tmp;
          $limit-=$len;
          break;
        case 25:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->versionCode_ = $tmp;

          break;
        case 32:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->priceCurrency_ = $tmp;
          $limit-=$len;
          break;
        case 33:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->priceMicros_ = $tmp;

          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->id_)) {
      fwrite($fp, "\x0a");
      Protobuf::write_varint($fp, strlen($this->id_));
      fwrite($fp, $this->id_);
    }
    if (!is_null($this->title_)) {
      fwrite($fp, "\x12");
      Protobuf::write_varint($fp, strlen($this->title_));
      fwrite($fp, $this->title_);
    }
    if (!is_null($this->appType_)) {
      fwrite($fp, "\x18");
      Protobuf::write_varint($fp, $this->appType_);
    }
    if (!is_null($this->creator_)) {
      fwrite($fp, "\"");
      Protobuf::write_varint($fp, strlen($this->creator_));
      fwrite($fp, $this->creator_);
    }
    if (!is_null($this->version_)) {
      fwrite($fp, "*");
      Protobuf::write_varint($fp, strlen($this->version_));
      fwrite($fp, $this->version_);
    }
    if (!is_null($this->price_)) {
      fwrite($fp, "2");
      Protobuf::write_varint($fp, strlen($this->price_));
      fwrite($fp, $this->price_);
    }
    if (!is_null($this->rating_)) {
      fwrite($fp, ":");
      Protobuf::write_varint($fp, strlen($this->rating_));
      fwrite($fp, $this->rating_);
    }
    if (!is_null($this->ratingsCount_)) {
      fwrite($fp, "@");
      Protobuf::write_varint($fp, $this->ratingsCount_);
    }
    if (!is_null($this->extendedinfo_)) {
      fwrite($fp, "c");
      $this->extendedinfo_->write($fp); // group
      fwrite($fp, "d");
    }
    if (!is_null($this->creatorId_)) {
      fwrite($fp, "\xb2\x01");
      Protobuf::write_varint($fp, strlen($this->creatorId_));
      fwrite($fp, $this->creatorId_);
    }
    if (!is_null($this->packageName_)) {
      fwrite($fp, "\xc2\x01");
      Protobuf::write_varint($fp, strlen($this->packageName_));
      fwrite($fp, $this->packageName_);
    }
    if (!is_null($this->versionCode_)) {
      fwrite($fp, "\xc8\x01");
      Protobuf::write_varint($fp, $this->versionCode_);
    }
    if (!is_null($this->priceCurrency_)) {
      fwrite($fp, "\x82\x02");
      Protobuf::write_varint($fp, strlen($this->priceCurrency_));
      fwrite($fp, $this->priceCurrency_);
    }
    if (!is_null($this->priceMicros_)) {
      fwrite($fp, "\x88\x02");
      Protobuf::write_varint($fp, $this->priceMicros_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->id_)) {
      $l = strlen($this->id_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->title_)) {
      $l = strlen($this->title_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->appType_)) {
      $size += 1 + Protobuf::size_varint($this->appType_);
    }
    if (!is_null($this->creator_)) {
      $l = strlen($this->creator_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->version_)) {
      $l = strlen($this->version_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->price_)) {
      $l = strlen($this->price_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->rating_)) {
      $l = strlen($this->rating_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->ratingsCount_)) {
      $size += 1 + Protobuf::size_varint($this->ratingsCount_);
    }
    if (!is_null($this->extendedinfo_)) {
      $size += 2 + $this->extendedinfo_->size();
    }
    if (!is_null($this->creatorId_)) {
      $l = strlen($this->creatorId_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->packageName_)) {
      $l = strlen($this->packageName_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->versionCode_)) {
      $size += 2 + Protobuf::size_varint($this->versionCode_);
    }
    if (!is_null($this->priceCurrency_)) {
      $l = strlen($this->priceCurrency_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->priceMicros_)) {
      $size += 2 + Protobuf::size_varint($this->priceMicros_);
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('id_', $this->id_)
         . Protobuf::toString('title_', $this->title_)
         . Protobuf::toString('appType_', AppType::toString($this->appType_))
         . Protobuf::toString('creator_', $this->creator_)
         . Protobuf::toString('version_', $this->version_)
         . Protobuf::toString('price_', $this->price_)
         . Protobuf::toString('rating_', $this->rating_)
         . Protobuf::toString('ratingsCount_', $this->ratingsCount_)
         . Protobuf::toString('extendedinfo_', $this->extendedinfo_)
         . Protobuf::toString('creatorId_', $this->creatorId_)
         . Protobuf::toString('packageName_', $this->packageName_)
         . Protobuf::toString('versionCode_', $this->versionCode_)
         . Protobuf::toString('priceCurrency_', $this->priceCurrency_)
         . Protobuf::toString('priceMicros_', $this->priceMicros_);
  }

  // optional string id = 1;

  private $id_ = null;
  public function clearId() { $this->id_ = null; }
  public function hasId() { return $this->id_ !== null; }
  public function getId() { if($this->id_ === null) return ""; else return $this->id_; }
  public function setId($value) { $this->id_ = $value; }

  // optional string title = 2;

  private $title_ = null;
  public function clearTitle() { $this->title_ = null; }
  public function hasTitle() { return $this->title_ !== null; }
  public function getTitle() { if($this->title_ === null) return ""; else return $this->title_; }
  public function setTitle($value) { $this->title_ = $value; }

  // optional .AppType appType = 3 [default = NONE];

  private $appType_ = null;
  public function clearAppType() { $this->appType_ = null; }
  public function hasAppType() { return $this->appType_ !== null; }
  public function getAppType() { if($this->appType_ === null) return AppType::NONE; else return $this->appType_; }
  public function setAppType($value) { $this->appType_ = $value; }

  // optional string creator = 4;

  private $creator_ = null;
  public function clearCreator() { $this->creator_ = null; }
  public function hasCreator() { return $this->creator_ !== null; }
  public function getCreator() { if($this->creator_ === null) return ""; else return $this->creator_; }
  public function setCreator($value) { $this->creator_ = $value; }

  // optional string version = 5;

  private $version_ = null;
  public function clearVersion() { $this->version_ = null; }
  public function hasVersion() { return $this->version_ !== null; }
  public function getVersion() { if($this->version_ === null) return ""; else return $this->version_; }
  public function setVersion($value) { $this->version_ = $value; }

  // optional string price = 6;

  private $price_ = null;
  public function clearPrice() { $this->price_ = null; }
  public function hasPrice() { return $this->price_ !== null; }
  public function getPrice() { if($this->price_ === null) return ""; else return $this->price_; }
  public function setPrice($value) { $this->price_ = $value; }

  // optional string rating = 7;

  private $rating_ = null;
  public function clearRating() { $this->rating_ = null; }
  public function hasRating() { return $this->rating_ !== null; }
  public function getRating() { if($this->rating_ === null) return ""; else return $this->rating_; }
  public function setRating($value) { $this->rating_ = $value; }

  // optional int32 ratingsCount = 8;

  private $ratingsCount_ = null;
  public function clearRatingsCount() { $this->ratingsCount_ = null; }
  public function hasRatingsCount() { return $this->ratingsCount_ !== null; }
  public function getRatingsCount() { if($this->ratingsCount_ === null) return 0; else return $this->ratingsCount_; }
  public function setRatingsCount($value) { $this->ratingsCount_ = $value; }

  // optional group ExtendedInfo = 12
  private $extendedinfo_ = null;
  public function clearExtendedinfo() { $this->extendedinfo_ = null; }
  public function hasExtendedinfo() { return $this->extendedinfo_ !== null; }
  public function getExtendedinfo() { if($this->extendedinfo_ === null) return null; else return $this->extendedinfo_; }
  public function setExtendedinfo(App_ExtendedInfo $value) { $this->extendedinfo_ = $value; }

  // optional string creatorId = 22;

  private $creatorId_ = null;
  public function clearCreatorId() { $this->creatorId_ = null; }
  public function hasCreatorId() { return $this->creatorId_ !== null; }
  public function getCreatorId() { if($this->creatorId_ === null) return ""; else return $this->creatorId_; }
  public function setCreatorId($value) { $this->creatorId_ = $value; }

  // optional string packageName = 24;

  private $packageName_ = null;
  public function clearPackageName() { $this->packageName_ = null; }
  public function hasPackageName() { return $this->packageName_ !== null; }
  public function getPackageName() { if($this->packageName_ === null) return ""; else return $this->packageName_; }
  public function setPackageName($value) { $this->packageName_ = $value; }

  // optional int32 versionCode = 25;

  private $versionCode_ = null;
  public function clearVersionCode() { $this->versionCode_ = null; }
  public function hasVersionCode() { return $this->versionCode_ !== null; }
  public function getVersionCode() { if($this->versionCode_ === null) return 0; else return $this->versionCode_; }
  public function setVersionCode($value) { $this->versionCode_ = $value; }

  // optional string priceCurrency = 32;

  private $priceCurrency_ = null;
  public function clearPriceCurrency() { $this->priceCurrency_ = null; }
  public function hasPriceCurrency() { return $this->priceCurrency_ !== null; }
  public function getPriceCurrency() { if($this->priceCurrency_ === null) return ""; else return $this->priceCurrency_; }
  public function setPriceCurrency($value) { $this->priceCurrency_ = $value; }

  // optional int32 priceMicros = 33;

  private $priceMicros_ = null;
  public function clearPriceMicros() { $this->priceMicros_ = null; }
  public function hasPriceMicros() { return $this->priceMicros_ !== null; }
  public function getPriceMicros() { if($this->priceMicros_ === null) return 0; else return $this->priceMicros_; }
  public function setPriceMicros($value) { $this->priceMicros_ = $value; }

  // @@protoc_insertion_point(class_scope:App)
}

// message DownloadInfo
class DownloadInfo {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("DownloadInfo: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->apkSize_ = $tmp;

          break;
        case 2:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->additionalFile_[] = new AppFileMetadata($fp, $len);
          ASSERT('$len == 0');
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->apkSize_)) {
      fwrite($fp, "\x08");
      Protobuf::write_varint($fp, $this->apkSize_);
    }
    if (!is_null($this->additionalFile_))
      foreach($this->additionalFile_ as $v) {
        fwrite($fp, "\x12");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->apkSize_)) {
      $size += 1 + Protobuf::size_varint($this->apkSize_);
    }
    if (!is_null($this->additionalFile_))
      foreach($this->additionalFile_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('apkSize_', $this->apkSize_)
         . Protobuf::toString('additionalFile_', $this->additionalFile_);
  }

  // optional int64 apkSize = 1;

  private $apkSize_ = null;
  public function clearApkSize() { $this->apkSize_ = null; }
  public function hasApkSize() { return $this->apkSize_ !== null; }
  public function getApkSize() { if($this->apkSize_ === null) return 0; else return $this->apkSize_; }
  public function setApkSize($value) { $this->apkSize_ = $value; }

  // repeated .AppFileMetadata additionalFile = 2;

  private $additionalFile_ = null;
  public function clearAdditionalFile() { $this->additionalFile_ = null; }
  public function getAdditionalFileCount() { if ($this->additionalFile_ === null ) return 0; else return count($this->additionalFile_); }
  public function getAdditionalFile($index) { return $this->additionalFile_[$index]; }
  public function getAdditionalFileArray() { if ($this->additionalFile_ === null ) return array(); else return $this->additionalFile_; }
  public function setAdditionalFile($index, $value) {$this->additionalFile_[$index] = $value;	}
  public function addAdditionalFile($value) { $this->additionalFile_[] = $value; }
  public function addAllAdditionalFile(array $values) { foreach($values as $value) {$this->additionalFile_[] = $value;} }

  // @@protoc_insertion_point(class_scope:DownloadInfo)
}

// message Comment
class Comment {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("Comment: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->text_ = $tmp;
          $limit-=$len;
          break;
        case 2:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->rating_ = $tmp;

          break;
        case 3:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->authorName_ = $tmp;
          $limit-=$len;
          break;
        case 4:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->creationTime_ = $tmp;

          break;
        case 5:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->authorId_ = $tmp;
          $limit-=$len;
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->text_)) {
      fwrite($fp, "\x0a");
      Protobuf::write_varint($fp, strlen($this->text_));
      fwrite($fp, $this->text_);
    }
    if (!is_null($this->rating_)) {
      fwrite($fp, "\x10");
      Protobuf::write_varint($fp, $this->rating_);
    }
    if (!is_null($this->authorName_)) {
      fwrite($fp, "\x1a");
      Protobuf::write_varint($fp, strlen($this->authorName_));
      fwrite($fp, $this->authorName_);
    }
    if (!is_null($this->creationTime_)) {
      fwrite($fp, " ");
      Protobuf::write_varint($fp, $this->creationTime_);
    }
    if (!is_null($this->authorId_)) {
      fwrite($fp, "*");
      Protobuf::write_varint($fp, strlen($this->authorId_));
      fwrite($fp, $this->authorId_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->text_)) {
      $l = strlen($this->text_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->rating_)) {
      $size += 1 + Protobuf::size_varint($this->rating_);
    }
    if (!is_null($this->authorName_)) {
      $l = strlen($this->authorName_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->creationTime_)) {
      $size += 1 + Protobuf::size_varint($this->creationTime_);
    }
    if (!is_null($this->authorId_)) {
      $l = strlen($this->authorId_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('text_', $this->text_)
         . Protobuf::toString('rating_', $this->rating_)
         . Protobuf::toString('authorName_', $this->authorName_)
         . Protobuf::toString('creationTime_', $this->creationTime_)
         . Protobuf::toString('authorId_', $this->authorId_);
  }

  // optional string text = 1;

  private $text_ = null;
  public function clearText() { $this->text_ = null; }
  public function hasText() { return $this->text_ !== null; }
  public function getText() { if($this->text_ === null) return ""; else return $this->text_; }
  public function setText($value) { $this->text_ = $value; }

  // optional int32 rating = 2;

  private $rating_ = null;
  public function clearRating() { $this->rating_ = null; }
  public function hasRating() { return $this->rating_ !== null; }
  public function getRating() { if($this->rating_ === null) return 0; else return $this->rating_; }
  public function setRating($value) { $this->rating_ = $value; }

  // optional string authorName = 3;

  private $authorName_ = null;
  public function clearAuthorName() { $this->authorName_ = null; }
  public function hasAuthorName() { return $this->authorName_ !== null; }
  public function getAuthorName() { if($this->authorName_ === null) return ""; else return $this->authorName_; }
  public function setAuthorName($value) { $this->authorName_ = $value; }

  // optional uint64 creationTime = 4;

  private $creationTime_ = null;
  public function clearCreationTime() { $this->creationTime_ = null; }
  public function hasCreationTime() { return $this->creationTime_ !== null; }
  public function getCreationTime() { if($this->creationTime_ === null) return 0; else return $this->creationTime_; }
  public function setCreationTime($value) { $this->creationTime_ = $value; }

  // optional string authorId = 5;

  private $authorId_ = null;
  public function clearAuthorId() { $this->authorId_ = null; }
  public function hasAuthorId() { return $this->authorId_ !== null; }
  public function getAuthorId() { if($this->authorId_ === null) return ""; else return $this->authorId_; }
  public function setAuthorId($value) { $this->authorId_ = $value; }

  // @@protoc_insertion_point(class_scope:Comment)
}

// message CommentsRequest
class CommentsRequest {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("CommentsRequest: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->appId_ = $tmp;
          $limit-=$len;
          break;
        case 2:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->startIndex_ = $tmp;

          break;
        case 3:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->entriesCount_ = $tmp;

          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->appId_)) {
      fwrite($fp, "\x0a");
      Protobuf::write_varint($fp, strlen($this->appId_));
      fwrite($fp, $this->appId_);
    }
    if (!is_null($this->startIndex_)) {
      fwrite($fp, "\x10");
      Protobuf::write_varint($fp, $this->startIndex_);
    }
    if (!is_null($this->entriesCount_)) {
      fwrite($fp, "\x18");
      Protobuf::write_varint($fp, $this->entriesCount_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->appId_)) {
      $l = strlen($this->appId_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->startIndex_)) {
      $size += 1 + Protobuf::size_varint($this->startIndex_);
    }
    if (!is_null($this->entriesCount_)) {
      $size += 1 + Protobuf::size_varint($this->entriesCount_);
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('appId_', $this->appId_)
         . Protobuf::toString('startIndex_', $this->startIndex_)
         . Protobuf::toString('entriesCount_', $this->entriesCount_);
  }

  // optional string appId = 1;

  private $appId_ = null;
  public function clearAppId() { $this->appId_ = null; }
  public function hasAppId() { return $this->appId_ !== null; }
  public function getAppId() { if($this->appId_ === null) return ""; else return $this->appId_; }
  public function setAppId($value) { $this->appId_ = $value; }

  // optional int32 startIndex = 2;

  private $startIndex_ = null;
  public function clearStartIndex() { $this->startIndex_ = null; }
  public function hasStartIndex() { return $this->startIndex_ !== null; }
  public function getStartIndex() { if($this->startIndex_ === null) return 0; else return $this->startIndex_; }
  public function setStartIndex($value) { $this->startIndex_ = $value; }

  // optional int32 entriesCount = 3;

  private $entriesCount_ = null;
  public function clearEntriesCount() { $this->entriesCount_ = null; }
  public function hasEntriesCount() { return $this->entriesCount_ !== null; }
  public function getEntriesCount() { if($this->entriesCount_ === null) return 0; else return $this->entriesCount_; }
  public function setEntriesCount($value) { $this->entriesCount_ = $value; }

  // @@protoc_insertion_point(class_scope:CommentsRequest)
}

// message CommentsResponse
class CommentsResponse {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("CommentsResponse: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->comments_[] = new Comment($fp, $len);
          ASSERT('$len == 0');
          break;
        case 2:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->entriesCount_ = $tmp;

          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->comments_))
      foreach($this->comments_ as $v) {
        fwrite($fp, "\x0a");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
    if (!is_null($this->entriesCount_)) {
      fwrite($fp, "\x10");
      Protobuf::write_varint($fp, $this->entriesCount_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->comments_))
      foreach($this->comments_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->entriesCount_)) {
      $size += 1 + Protobuf::size_varint($this->entriesCount_);
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('comments_', $this->comments_)
         . Protobuf::toString('entriesCount_', $this->entriesCount_);
  }

  // repeated .Comment comments = 1;

  private $comments_ = null;
  public function clearComments() { $this->comments_ = null; }
  public function getCommentsCount() { if ($this->comments_ === null ) return 0; else return count($this->comments_); }
  public function getComments($index) { return $this->comments_[$index]; }
  public function getCommentsArray() { if ($this->comments_ === null ) return array(); else return $this->comments_; }
  public function setComments($index, $value) {$this->comments_[$index] = $value;	}
  public function addComments($value) { $this->comments_[] = $value; }
  public function addAllComments(array $values) { foreach($values as $value) {$this->comments_[] = $value;} }

  // optional int32 entriesCount = 2;

  private $entriesCount_ = null;
  public function clearEntriesCount() { $this->entriesCount_ = null; }
  public function hasEntriesCount() { return $this->entriesCount_ !== null; }
  public function getEntriesCount() { if($this->entriesCount_ === null) return 0; else return $this->entriesCount_; }
  public function setEntriesCount($value) { $this->entriesCount_ = $value; }

  // @@protoc_insertion_point(class_scope:CommentsResponse)
}

// message CategoriesRequest
class CategoriesRequest {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("CategoriesRequest: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  public function size() {
    $size = 0;
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown);
  }

  // @@protoc_insertion_point(class_scope:CategoriesRequest)
}

// message CategoriesResponse
class CategoriesResponse {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("CategoriesResponse: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->categories_[] = new Category($fp, $len);
          ASSERT('$len == 0');
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->categories_))
      foreach($this->categories_ as $v) {
        fwrite($fp, "\x0a");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->categories_))
      foreach($this->categories_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('categories_', $this->categories_);
  }

  // repeated .Category categories = 1;

  private $categories_ = null;
  public function clearCategories() { $this->categories_ = null; }
  public function getCategoriesCount() { if ($this->categories_ === null ) return 0; else return count($this->categories_); }
  public function getCategories($index) { return $this->categories_[$index]; }
  public function getCategoriesArray() { if ($this->categories_ === null ) return array(); else return $this->categories_; }
  public function setCategories($index, $value) {$this->categories_[$index] = $value;	}
  public function addCategories($value) { $this->categories_[] = $value; }
  public function addAllCategories(array $values) { foreach($values as $value) {$this->categories_[] = $value;} }

  // @@protoc_insertion_point(class_scope:CategoriesResponse)
}

// message Category
class Category {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("Category: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 2:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->appType_ = $tmp;

          break;
        case 3:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->categoryId_ = $tmp;
          $limit-=$len;
          break;
        case 4:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->title_ = $tmp;
          $limit-=$len;
          break;
        case 5:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->subtitle_ = $tmp;
          $limit-=$len;
          break;
        case 8:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->subCategories_[] = new Category($fp, $len);
          ASSERT('$len == 0');
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->appType_)) {
      fwrite($fp, "\x10");
      Protobuf::write_varint($fp, $this->appType_);
    }
    if (!is_null($this->categoryId_)) {
      fwrite($fp, "\x1a");
      Protobuf::write_varint($fp, strlen($this->categoryId_));
      fwrite($fp, $this->categoryId_);
    }
    if (!is_null($this->title_)) {
      fwrite($fp, "\"");
      Protobuf::write_varint($fp, strlen($this->title_));
      fwrite($fp, $this->title_);
    }
    if (!is_null($this->subtitle_)) {
      fwrite($fp, "*");
      Protobuf::write_varint($fp, strlen($this->subtitle_));
      fwrite($fp, $this->subtitle_);
    }
    if (!is_null($this->subCategories_))
      foreach($this->subCategories_ as $v) {
        fwrite($fp, "B");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->appType_)) {
      $size += 1 + Protobuf::size_varint($this->appType_);
    }
    if (!is_null($this->categoryId_)) {
      $l = strlen($this->categoryId_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->title_)) {
      $l = strlen($this->title_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->subtitle_)) {
      $l = strlen($this->subtitle_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->subCategories_))
      foreach($this->subCategories_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('appType_', $this->appType_)
         . Protobuf::toString('categoryId_', $this->categoryId_)
         . Protobuf::toString('title_', $this->title_)
         . Protobuf::toString('subtitle_', $this->subtitle_)
         . Protobuf::toString('subCategories_', $this->subCategories_);
  }

  // optional int32 appType = 2;

  private $appType_ = null;
  public function clearAppType() { $this->appType_ = null; }
  public function hasAppType() { return $this->appType_ !== null; }
  public function getAppType() { if($this->appType_ === null) return 0; else return $this->appType_; }
  public function setAppType($value) { $this->appType_ = $value; }

  // optional string categoryId = 3;

  private $categoryId_ = null;
  public function clearCategoryId() { $this->categoryId_ = null; }
  public function hasCategoryId() { return $this->categoryId_ !== null; }
  public function getCategoryId() { if($this->categoryId_ === null) return ""; else return $this->categoryId_; }
  public function setCategoryId($value) { $this->categoryId_ = $value; }

  // optional string title = 4;

  private $title_ = null;
  public function clearTitle() { $this->title_ = null; }
  public function hasTitle() { return $this->title_ !== null; }
  public function getTitle() { if($this->title_ === null) return ""; else return $this->title_; }
  public function setTitle($value) { $this->title_ = $value; }

  // optional string subtitle = 5;

  private $subtitle_ = null;
  public function clearSubtitle() { $this->subtitle_ = null; }
  public function hasSubtitle() { return $this->subtitle_ !== null; }
  public function getSubtitle() { if($this->subtitle_ === null) return ""; else return $this->subtitle_; }
  public function setSubtitle($value) { $this->subtitle_ = $value; }

  // repeated .Category subCategories = 8;

  private $subCategories_ = null;
  public function clearSubCategories() { $this->subCategories_ = null; }
  public function getSubCategoriesCount() { if ($this->subCategories_ === null ) return 0; else return count($this->subCategories_); }
  public function getSubCategories($index) { return $this->subCategories_[$index]; }
  public function getSubCategoriesArray() { if ($this->subCategories_ === null ) return array(); else return $this->subCategories_; }
  public function setSubCategories($index, $value) {$this->subCategories_[$index] = $value;	}
  public function addSubCategories($value) { $this->subCategories_[] = $value; }
  public function addAllSubCategories(array $values) { foreach($values as $value) {$this->subCategories_[] = $value;} }

  // @@protoc_insertion_point(class_scope:Category)
}

// message SubCategoriesRequest
class SubCategoriesRequest {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("SubCategoriesRequest: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->appType_ = $tmp;

          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->appType_)) {
      fwrite($fp, "\x08");
      Protobuf::write_varint($fp, $this->appType_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->appType_)) {
      $size += 1 + Protobuf::size_varint($this->appType_);
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('appType_', AppType::toString($this->appType_));
  }

  // optional .AppType appType = 1;

  private $appType_ = null;
  public function clearAppType() { $this->appType_ = null; }
  public function hasAppType() { return $this->appType_ !== null; }
  public function getAppType() { if($this->appType_ === null) return AppType::NONE; else return $this->appType_; }
  public function setAppType($value) { $this->appType_ = $value; }

  // @@protoc_insertion_point(class_scope:SubCategoriesRequest)
}

// message SubCategoriesResponse
class SubCategoriesResponse {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("SubCategoriesResponse: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->category_[] = new Category($fp, $len);
          ASSERT('$len == 0');
          break;
        case 2:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->subCategoryDisplay_ = $tmp;
          $limit-=$len;
          break;
        case 3:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->subCategoryId_ = $tmp;

          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->category_))
      foreach($this->category_ as $v) {
        fwrite($fp, "\x0a");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
    if (!is_null($this->subCategoryDisplay_)) {
      fwrite($fp, "\x12");
      Protobuf::write_varint($fp, strlen($this->subCategoryDisplay_));
      fwrite($fp, $this->subCategoryDisplay_);
    }
    if (!is_null($this->subCategoryId_)) {
      fwrite($fp, "\x18");
      Protobuf::write_varint($fp, $this->subCategoryId_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->category_))
      foreach($this->category_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->subCategoryDisplay_)) {
      $l = strlen($this->subCategoryDisplay_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->subCategoryId_)) {
      $size += 1 + Protobuf::size_varint($this->subCategoryId_);
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('category_', $this->category_)
         . Protobuf::toString('subCategoryDisplay_', $this->subCategoryDisplay_)
         . Protobuf::toString('subCategoryId_', $this->subCategoryId_);
  }

  // repeated .Category category = 1;

  private $category_ = null;
  public function clearCategory() { $this->category_ = null; }
  public function getCategoryCount() { if ($this->category_ === null ) return 0; else return count($this->category_); }
  public function getCategory($index) { return $this->category_[$index]; }
  public function getCategoryArray() { if ($this->category_ === null ) return array(); else return $this->category_; }
  public function setCategory($index, $value) {$this->category_[$index] = $value;	}
  public function addCategory($value) { $this->category_[] = $value; }
  public function addAllCategory(array $values) { foreach($values as $value) {$this->category_[] = $value;} }

  // optional string subCategoryDisplay = 2;

  private $subCategoryDisplay_ = null;
  public function clearSubCategoryDisplay() { $this->subCategoryDisplay_ = null; }
  public function hasSubCategoryDisplay() { return $this->subCategoryDisplay_ !== null; }
  public function getSubCategoryDisplay() { if($this->subCategoryDisplay_ === null) return ""; else return $this->subCategoryDisplay_; }
  public function setSubCategoryDisplay($value) { $this->subCategoryDisplay_ = $value; }

  // optional int32 subCategoryId = 3;

  private $subCategoryId_ = null;
  public function clearSubCategoryId() { $this->subCategoryId_ = null; }
  public function hasSubCategoryId() { return $this->subCategoryId_ !== null; }
  public function getSubCategoryId() { if($this->subCategoryId_ === null) return 0; else return $this->subCategoryId_; }
  public function setSubCategoryId($value) { $this->subCategoryId_ = $value; }

  // @@protoc_insertion_point(class_scope:SubCategoriesResponse)
}

// enum GetImageRequest.AppImageUsage
class GetImageRequest_AppImageUsage {
  const ICON = 0;
  const SCREENSHOT = 1;
  const SCREENSHOT_THUMBNAIL = 2;
  const PROMO_BADGE = 3;
  const BILING_ICON = 4;

  public static $_values = array(
    0 => self::ICON,
    1 => self::SCREENSHOT,
    2 => self::SCREENSHOT_THUMBNAIL,
    3 => self::PROMO_BADGE,
    4 => self::BILING_ICON,
  );

  public static function toString($value) {
    if (is_null($value)) return null;
    if (array_key_exists($value, self::$_values))
      return self::$_values[$value];
    return 'UNKNOWN';
  }
}

// message GetImageRequest
class GetImageRequest {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("GetImageRequest: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->appId_ = $tmp;
          $limit-=$len;
          break;
        case 3:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->imageUsage_ = $tmp;

          break;
        case 4:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->imageId_ = $tmp;
          $limit-=$len;
          break;
        case 5:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->screenPropertyWidth_ = $tmp;

          break;
        case 6:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->screenPropertyHeight_ = $tmp;

          break;
        case 7:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->screenPropertyDensity_ = $tmp;

          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->appId_)) {
      fwrite($fp, "\x0a");
      Protobuf::write_varint($fp, strlen($this->appId_));
      fwrite($fp, $this->appId_);
    }
    if (!is_null($this->imageUsage_)) {
      fwrite($fp, "\x18");
      Protobuf::write_varint($fp, $this->imageUsage_);
    }
    if (!is_null($this->imageId_)) {
      fwrite($fp, "\"");
      Protobuf::write_varint($fp, strlen($this->imageId_));
      fwrite($fp, $this->imageId_);
    }
    if (!is_null($this->screenPropertyWidth_)) {
      fwrite($fp, "(");
      Protobuf::write_varint($fp, $this->screenPropertyWidth_);
    }
    if (!is_null($this->screenPropertyHeight_)) {
      fwrite($fp, "0");
      Protobuf::write_varint($fp, $this->screenPropertyHeight_);
    }
    if (!is_null($this->screenPropertyDensity_)) {
      fwrite($fp, "8");
      Protobuf::write_varint($fp, $this->screenPropertyDensity_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->appId_)) {
      $l = strlen($this->appId_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->imageUsage_)) {
      $size += 1 + Protobuf::size_varint($this->imageUsage_);
    }
    if (!is_null($this->imageId_)) {
      $l = strlen($this->imageId_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->screenPropertyWidth_)) {
      $size += 1 + Protobuf::size_varint($this->screenPropertyWidth_);
    }
    if (!is_null($this->screenPropertyHeight_)) {
      $size += 1 + Protobuf::size_varint($this->screenPropertyHeight_);
    }
    if (!is_null($this->screenPropertyDensity_)) {
      $size += 1 + Protobuf::size_varint($this->screenPropertyDensity_);
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('appId_', $this->appId_)
         . Protobuf::toString('imageUsage_', GetImageRequest_AppImageUsage::toString($this->imageUsage_))
         . Protobuf::toString('imageId_', $this->imageId_)
         . Protobuf::toString('screenPropertyWidth_', $this->screenPropertyWidth_)
         . Protobuf::toString('screenPropertyHeight_', $this->screenPropertyHeight_)
         . Protobuf::toString('screenPropertyDensity_', $this->screenPropertyDensity_);
  }

  // optional string appId = 1;

  private $appId_ = null;
  public function clearAppId() { $this->appId_ = null; }
  public function hasAppId() { return $this->appId_ !== null; }
  public function getAppId() { if($this->appId_ === null) return ""; else return $this->appId_; }
  public function setAppId($value) { $this->appId_ = $value; }

  // optional .GetImageRequest.AppImageUsage imageUsage = 3;

  private $imageUsage_ = null;
  public function clearImageUsage() { $this->imageUsage_ = null; }
  public function hasImageUsage() { return $this->imageUsage_ !== null; }
  public function getImageUsage() { if($this->imageUsage_ === null) return GetImageRequest_AppImageUsage::ICON; else return $this->imageUsage_; }
  public function setImageUsage($value) { $this->imageUsage_ = $value; }

  // optional string imageId = 4;

  private $imageId_ = null;
  public function clearImageId() { $this->imageId_ = null; }
  public function hasImageId() { return $this->imageId_ !== null; }
  public function getImageId() { if($this->imageId_ === null) return ""; else return $this->imageId_; }
  public function setImageId($value) { $this->imageId_ = $value; }

  // optional int32 screenPropertyWidth = 5;

  private $screenPropertyWidth_ = null;
  public function clearScreenPropertyWidth() { $this->screenPropertyWidth_ = null; }
  public function hasScreenPropertyWidth() { return $this->screenPropertyWidth_ !== null; }
  public function getScreenPropertyWidth() { if($this->screenPropertyWidth_ === null) return 0; else return $this->screenPropertyWidth_; }
  public function setScreenPropertyWidth($value) { $this->screenPropertyWidth_ = $value; }

  // optional int32 screenPropertyHeight = 6;

  private $screenPropertyHeight_ = null;
  public function clearScreenPropertyHeight() { $this->screenPropertyHeight_ = null; }
  public function hasScreenPropertyHeight() { return $this->screenPropertyHeight_ !== null; }
  public function getScreenPropertyHeight() { if($this->screenPropertyHeight_ === null) return 0; else return $this->screenPropertyHeight_; }
  public function setScreenPropertyHeight($value) { $this->screenPropertyHeight_ = $value; }

  // optional int32 screenPropertyDensity = 7;

  private $screenPropertyDensity_ = null;
  public function clearScreenPropertyDensity() { $this->screenPropertyDensity_ = null; }
  public function hasScreenPropertyDensity() { return $this->screenPropertyDensity_ !== null; }
  public function getScreenPropertyDensity() { if($this->screenPropertyDensity_ === null) return 0; else return $this->screenPropertyDensity_; }
  public function setScreenPropertyDensity($value) { $this->screenPropertyDensity_ = $value; }

  // @@protoc_insertion_point(class_scope:GetImageRequest)
}

// message GetImageResponse
class GetImageResponse {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("GetImageResponse: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->imageData_ = $tmp;
          $limit-=$len;
          break;
        case 2:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->imageDensity_ = $tmp;

          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->imageData_)) {
      fwrite($fp, "\x0a");
      Protobuf::write_varint($fp, strlen($this->imageData_));
      fwrite($fp, $this->imageData_);
    }
    if (!is_null($this->imageDensity_)) {
      fwrite($fp, "\x10");
      Protobuf::write_varint($fp, $this->imageDensity_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->imageData_)) {
      $l = strlen($this->imageData_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->imageDensity_)) {
      $size += 1 + Protobuf::size_varint($this->imageDensity_);
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('imageData_', $this->imageData_)
         . Protobuf::toString('imageDensity_', $this->imageDensity_);
  }

  // optional bytes imageData = 1;

  private $imageData_ = null;
  public function clearImageData() { $this->imageData_ = null; }
  public function hasImageData() { return $this->imageData_ !== null; }
  public function getImageData() { if($this->imageData_ === null) return ""; else return $this->imageData_; }
  public function setImageData($value) { $this->imageData_ = $value; }

  // optional int32 imageDensity = 2;

  private $imageDensity_ = null;
  public function clearImageDensity() { $this->imageDensity_ = null; }
  public function hasImageDensity() { return $this->imageDensity_ !== null; }
  public function getImageDensity() { if($this->imageDensity_ === null) return 0; else return $this->imageDensity_; }
  public function setImageDensity($value) { $this->imageDensity_ = $value; }

  // @@protoc_insertion_point(class_scope:GetImageResponse)
}

// message GetAssetRequest
class GetAssetRequest {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("GetAssetRequest: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->assetId_ = $tmp;
          $limit-=$len;
          break;
        case 2:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->directDownloadKey_ = $tmp;
          $limit-=$len;
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->assetId_)) {
      fwrite($fp, "\x0a");
      Protobuf::write_varint($fp, strlen($this->assetId_));
      fwrite($fp, $this->assetId_);
    }
    if (!is_null($this->directDownloadKey_)) {
      fwrite($fp, "\x12");
      Protobuf::write_varint($fp, strlen($this->directDownloadKey_));
      fwrite($fp, $this->directDownloadKey_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->assetId_)) {
      $l = strlen($this->assetId_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->directDownloadKey_)) {
      $l = strlen($this->directDownloadKey_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    if ($this->assetId_ === null) return false;
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('assetId_', $this->assetId_)
         . Protobuf::toString('directDownloadKey_', $this->directDownloadKey_);
  }

  // required string assetId = 1;

  private $assetId_ = null;
  public function clearAssetId() { $this->assetId_ = null; }
  public function hasAssetId() { return $this->assetId_ !== null; }
  public function getAssetId() { if($this->assetId_ === null) return ""; else return $this->assetId_; }
  public function setAssetId($value) { $this->assetId_ = $value; }

  // optional string directDownloadKey = 2;

  private $directDownloadKey_ = null;
  public function clearDirectDownloadKey() { $this->directDownloadKey_ = null; }
  public function hasDirectDownloadKey() { return $this->directDownloadKey_ !== null; }
  public function getDirectDownloadKey() { if($this->directDownloadKey_ === null) return ""; else return $this->directDownloadKey_; }
  public function setDirectDownloadKey($value) { $this->directDownloadKey_ = $value; }

  // @@protoc_insertion_point(class_scope:GetAssetRequest)
}


// group GetAssetResponse.InstallAsset
class GetAssetResponse_InstallAsset {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("GetAssetResponse_InstallAsset: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 4');
          break 2;
        case 2:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->assetId_ = $tmp;
          $limit-=$len;
          break;
        case 3:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->assetName_ = $tmp;
          $limit-=$len;
          break;
        case 4:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->assetType_ = $tmp;
          $limit-=$len;
          break;
        case 5:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->assetPackage_ = $tmp;
          $limit-=$len;
          break;
        case 6:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->blobUrl_ = $tmp;
          $limit-=$len;
          break;
        case 7:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->assetSignature_ = $tmp;
          $limit-=$len;
          break;
        case 8:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->assetSize_ = $tmp;

          break;
        case 9:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->refundTimeout_ = $tmp;

          break;
        case 10:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->forwardLocked_ = $tmp > 0 ? true : false;
          break;
        case 11:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->secured_ = $tmp > 0 ? true : false;
          break;
        case 12:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->versionCode_ = $tmp;

          break;
        case 13:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->downloadAuthCookieName_ = $tmp;
          $limit-=$len;
          break;
        case 14:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->downloadAuthCookieValue_ = $tmp;
          $limit-=$len;
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->assetId_)) {
      fwrite($fp, "\x12");
      Protobuf::write_varint($fp, strlen($this->assetId_));
      fwrite($fp, $this->assetId_);
    }
    if (!is_null($this->assetName_)) {
      fwrite($fp, "\x1a");
      Protobuf::write_varint($fp, strlen($this->assetName_));
      fwrite($fp, $this->assetName_);
    }
    if (!is_null($this->assetType_)) {
      fwrite($fp, "\"");
      Protobuf::write_varint($fp, strlen($this->assetType_));
      fwrite($fp, $this->assetType_);
    }
    if (!is_null($this->assetPackage_)) {
      fwrite($fp, "*");
      Protobuf::write_varint($fp, strlen($this->assetPackage_));
      fwrite($fp, $this->assetPackage_);
    }
    if (!is_null($this->blobUrl_)) {
      fwrite($fp, "2");
      Protobuf::write_varint($fp, strlen($this->blobUrl_));
      fwrite($fp, $this->blobUrl_);
    }
    if (!is_null($this->assetSignature_)) {
      fwrite($fp, ":");
      Protobuf::write_varint($fp, strlen($this->assetSignature_));
      fwrite($fp, $this->assetSignature_);
    }
    if (!is_null($this->assetSize_)) {
      fwrite($fp, "@");
      Protobuf::write_varint($fp, $this->assetSize_);
    }
    if (!is_null($this->refundTimeout_)) {
      fwrite($fp, "H");
      Protobuf::write_varint($fp, $this->refundTimeout_);
    }
    if (!is_null($this->forwardLocked_)) {
      fwrite($fp, "P");
      Protobuf::write_varint($fp, $this->forwardLocked_ ? 1 : 0);
    }
    if (!is_null($this->secured_)) {
      fwrite($fp, "X");
      Protobuf::write_varint($fp, $this->secured_ ? 1 : 0);
    }
    if (!is_null($this->versionCode_)) {
      fwrite($fp, "`");
      Protobuf::write_varint($fp, $this->versionCode_);
    }
    if (!is_null($this->downloadAuthCookieName_)) {
      fwrite($fp, "j");
      Protobuf::write_varint($fp, strlen($this->downloadAuthCookieName_));
      fwrite($fp, $this->downloadAuthCookieName_);
    }
    if (!is_null($this->downloadAuthCookieValue_)) {
      fwrite($fp, "r");
      Protobuf::write_varint($fp, strlen($this->downloadAuthCookieValue_));
      fwrite($fp, $this->downloadAuthCookieValue_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->assetId_)) {
      $l = strlen($this->assetId_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->assetName_)) {
      $l = strlen($this->assetName_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->assetType_)) {
      $l = strlen($this->assetType_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->assetPackage_)) {
      $l = strlen($this->assetPackage_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->blobUrl_)) {
      $l = strlen($this->blobUrl_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->assetSignature_)) {
      $l = strlen($this->assetSignature_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->assetSize_)) {
      $size += 1 + Protobuf::size_varint($this->assetSize_);
    }
    if (!is_null($this->refundTimeout_)) {
      $size += 1 + Protobuf::size_varint($this->refundTimeout_);
    }
    if (!is_null($this->forwardLocked_)) {
      $size += 2;
    }
    if (!is_null($this->secured_)) {
      $size += 2;
    }
    if (!is_null($this->versionCode_)) {
      $size += 1 + Protobuf::size_varint($this->versionCode_);
    }
    if (!is_null($this->downloadAuthCookieName_)) {
      $l = strlen($this->downloadAuthCookieName_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->downloadAuthCookieValue_)) {
      $l = strlen($this->downloadAuthCookieValue_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('assetId_', $this->assetId_)
         . Protobuf::toString('assetName_', $this->assetName_)
         . Protobuf::toString('assetType_', $this->assetType_)
         . Protobuf::toString('assetPackage_', $this->assetPackage_)
         . Protobuf::toString('blobUrl_', $this->blobUrl_)
         . Protobuf::toString('assetSignature_', $this->assetSignature_)
         . Protobuf::toString('assetSize_', $this->assetSize_)
         . Protobuf::toString('refundTimeout_', $this->refundTimeout_)
         . Protobuf::toString('forwardLocked_', $this->forwardLocked_)
         . Protobuf::toString('secured_', $this->secured_)
         . Protobuf::toString('versionCode_', $this->versionCode_)
         . Protobuf::toString('downloadAuthCookieName_', $this->downloadAuthCookieName_)
         . Protobuf::toString('downloadAuthCookieValue_', $this->downloadAuthCookieValue_);
  }

  // optional string assetId = 2;

  private $assetId_ = null;
  public function clearAssetId() { $this->assetId_ = null; }
  public function hasAssetId() { return $this->assetId_ !== null; }
  public function getAssetId() { if($this->assetId_ === null) return ""; else return $this->assetId_; }
  public function setAssetId($value) { $this->assetId_ = $value; }

  // optional string assetName = 3;

  private $assetName_ = null;
  public function clearAssetName() { $this->assetName_ = null; }
  public function hasAssetName() { return $this->assetName_ !== null; }
  public function getAssetName() { if($this->assetName_ === null) return ""; else return $this->assetName_; }
  public function setAssetName($value) { $this->assetName_ = $value; }

  // optional string assetType = 4;

  private $assetType_ = null;
  public function clearAssetType() { $this->assetType_ = null; }
  public function hasAssetType() { return $this->assetType_ !== null; }
  public function getAssetType() { if($this->assetType_ === null) return ""; else return $this->assetType_; }
  public function setAssetType($value) { $this->assetType_ = $value; }

  // optional string assetPackage = 5;

  private $assetPackage_ = null;
  public function clearAssetPackage() { $this->assetPackage_ = null; }
  public function hasAssetPackage() { return $this->assetPackage_ !== null; }
  public function getAssetPackage() { if($this->assetPackage_ === null) return ""; else return $this->assetPackage_; }
  public function setAssetPackage($value) { $this->assetPackage_ = $value; }

  // optional string blobUrl = 6;

  private $blobUrl_ = null;
  public function clearBlobUrl() { $this->blobUrl_ = null; }
  public function hasBlobUrl() { return $this->blobUrl_ !== null; }
  public function getBlobUrl() { if($this->blobUrl_ === null) return ""; else return $this->blobUrl_; }
  public function setBlobUrl($value) { $this->blobUrl_ = $value; }

  // optional string assetSignature = 7;

  private $assetSignature_ = null;
  public function clearAssetSignature() { $this->assetSignature_ = null; }
  public function hasAssetSignature() { return $this->assetSignature_ !== null; }
  public function getAssetSignature() { if($this->assetSignature_ === null) return ""; else return $this->assetSignature_; }
  public function setAssetSignature($value) { $this->assetSignature_ = $value; }

  // optional uint64 assetSize = 8;

  private $assetSize_ = null;
  public function clearAssetSize() { $this->assetSize_ = null; }
  public function hasAssetSize() { return $this->assetSize_ !== null; }
  public function getAssetSize() { if($this->assetSize_ === null) return 0; else return $this->assetSize_; }
  public function setAssetSize($value) { $this->assetSize_ = $value; }

  // optional uint64 refundTimeout = 9;

  private $refundTimeout_ = null;
  public function clearRefundTimeout() { $this->refundTimeout_ = null; }
  public function hasRefundTimeout() { return $this->refundTimeout_ !== null; }
  public function getRefundTimeout() { if($this->refundTimeout_ === null) return 0; else return $this->refundTimeout_; }
  public function setRefundTimeout($value) { $this->refundTimeout_ = $value; }

  // optional bool forwardLocked = 10;

  private $forwardLocked_ = null;
  public function clearForwardLocked() { $this->forwardLocked_ = null; }
  public function hasForwardLocked() { return $this->forwardLocked_ !== null; }
  public function getForwardLocked() { if($this->forwardLocked_ === null) return false; else return $this->forwardLocked_; }
  public function setForwardLocked($value) { $this->forwardLocked_ = $value; }

  // optional bool secured = 11;

  private $secured_ = null;
  public function clearSecured() { $this->secured_ = null; }
  public function hasSecured() { return $this->secured_ !== null; }
  public function getSecured() { if($this->secured_ === null) return false; else return $this->secured_; }
  public function setSecured($value) { $this->secured_ = $value; }

  // optional int32 versionCode = 12;

  private $versionCode_ = null;
  public function clearVersionCode() { $this->versionCode_ = null; }
  public function hasVersionCode() { return $this->versionCode_ !== null; }
  public function getVersionCode() { if($this->versionCode_ === null) return 0; else return $this->versionCode_; }
  public function setVersionCode($value) { $this->versionCode_ = $value; }

  // optional string downloadAuthCookieName = 13;

  private $downloadAuthCookieName_ = null;
  public function clearDownloadAuthCookieName() { $this->downloadAuthCookieName_ = null; }
  public function hasDownloadAuthCookieName() { return $this->downloadAuthCookieName_ !== null; }
  public function getDownloadAuthCookieName() { if($this->downloadAuthCookieName_ === null) return ""; else return $this->downloadAuthCookieName_; }
  public function setDownloadAuthCookieName($value) { $this->downloadAuthCookieName_ = $value; }

  // optional string downloadAuthCookieValue = 14;

  private $downloadAuthCookieValue_ = null;
  public function clearDownloadAuthCookieValue() { $this->downloadAuthCookieValue_ = null; }
  public function hasDownloadAuthCookieValue() { return $this->downloadAuthCookieValue_ !== null; }
  public function getDownloadAuthCookieValue() { if($this->downloadAuthCookieValue_ === null) return ""; else return $this->downloadAuthCookieValue_; }
  public function setDownloadAuthCookieValue($value) { $this->downloadAuthCookieValue_ = $value; }

  // @@protoc_insertion_point(class_scope:GetAssetResponse.InstallAsset)
}

// message GetAssetResponse
class GetAssetResponse {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("GetAssetResponse: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 3');
          $this->installasset_[] = new GetAssetResponse_InstallAsset($fp, $limit);
          break;
        case 15:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->additionalFile_[] = new AppFileMetadata($fp, $len);
          ASSERT('$len == 0');
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->installasset_))
      foreach($this->installasset_ as $v) {
        fwrite($fp, "\x0b");
        $v->write($fp); // group
        fwrite($fp, "\x0c");
      }
    if (!is_null($this->additionalFile_))
      foreach($this->additionalFile_ as $v) {
        fwrite($fp, "z");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->installasset_))
      foreach($this->installasset_ as $v) {
        $size += 2 + $v->size();
      }
    if (!is_null($this->additionalFile_))
      foreach($this->additionalFile_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('installasset_', $this->installasset_)
         . Protobuf::toString('additionalFile_', $this->additionalFile_);
  }

  // repeated group InstallAsset = 1
  private $installasset_ = null;
  public function clearInstallasset() { $this->installasset_ = null; }
  public function getInstallassetCount() { if ($this->installasset_ === null ) return 0; else return count($this->installasset_); }
  public function getInstallasset($index) { return $this->installasset_[$index]; }
  public function getInstallassetArray() { if ($this->installasset_ === null ) return array(); else return $this->installasset_; }
  public function setInstallasset($index, $value) {$this->installasset_[$index] = $value;	}
  public function addInstallasset($value) { $this->installasset_[] = $value; }
  public function addAllInstallasset(array $values) { foreach($values as $value) {$this->installasset_[] = $value;} }

  // repeated .AppFileMetadata additionalFile = 15;

  private $additionalFile_ = null;
  public function clearAdditionalFile() { $this->additionalFile_ = null; }
  public function getAdditionalFileCount() { if ($this->additionalFile_ === null ) return 0; else return count($this->additionalFile_); }
  public function getAdditionalFile($index) { return $this->additionalFile_[$index]; }
  public function getAdditionalFileArray() { if ($this->additionalFile_ === null ) return array(); else return $this->additionalFile_; }
  public function setAdditionalFile($index, $value) {$this->additionalFile_[$index] = $value;	}
  public function addAdditionalFile($value) { $this->additionalFile_[] = $value; }
  public function addAllAdditionalFile(array $values) { foreach($values as $value) {$this->additionalFile_[] = $value;} }

  // @@protoc_insertion_point(class_scope:GetAssetResponse)
}


// group Request.RequestGroup
class Request_RequestGroup {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("Request_RequestGroup: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 2:
          ASSERT('$wire == 4');
          break 2;
        case 4:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->appsRequest_ = new AppsRequest($fp, $len);
          ASSERT('$len == 0');
          break;
        case 5:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->commentsRequest_ = new CommentsRequest($fp, $len);
          ASSERT('$len == 0');
          break;
        case 10:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->getAssetRequest_ = new GetAssetRequest($fp, $len);
          ASSERT('$len == 0');
          break;
        case 11:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->imageRequest_ = new GetImageRequest($fp, $len);
          ASSERT('$len == 0');
          break;
        case 14:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->subCategoriesRequest_ = new SubCategoriesRequest($fp, $len);
          ASSERT('$len == 0');
          break;
        case 21:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->categoriesRequest_ = new CategoriesRequest($fp, $len);
          ASSERT('$len == 0');
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->appsRequest_)) {
      fwrite($fp, "\"");
      Protobuf::write_varint($fp, $this->appsRequest_->size()); // message
      $this->appsRequest_->write($fp);
    }
    if (!is_null($this->commentsRequest_)) {
      fwrite($fp, "*");
      Protobuf::write_varint($fp, $this->commentsRequest_->size()); // message
      $this->commentsRequest_->write($fp);
    }
    if (!is_null($this->getAssetRequest_)) {
      fwrite($fp, "R");
      Protobuf::write_varint($fp, $this->getAssetRequest_->size()); // message
      $this->getAssetRequest_->write($fp);
    }
    if (!is_null($this->imageRequest_)) {
      fwrite($fp, "Z");
      Protobuf::write_varint($fp, $this->imageRequest_->size()); // message
      $this->imageRequest_->write($fp);
    }
    if (!is_null($this->subCategoriesRequest_)) {
      fwrite($fp, "r");
      Protobuf::write_varint($fp, $this->subCategoriesRequest_->size()); // message
      $this->subCategoriesRequest_->write($fp);
    }
    if (!is_null($this->categoriesRequest_)) {
      fwrite($fp, "\xaa\x01");
      Protobuf::write_varint($fp, $this->categoriesRequest_->size()); // message
      $this->categoriesRequest_->write($fp);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->appsRequest_)) {
      $l = $this->appsRequest_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->commentsRequest_)) {
      $l = $this->commentsRequest_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->getAssetRequest_)) {
      $l = $this->getAssetRequest_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->imageRequest_)) {
      $l = $this->imageRequest_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->subCategoriesRequest_)) {
      $l = $this->subCategoriesRequest_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->categoriesRequest_)) {
      $l = $this->categoriesRequest_->size();
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('appsRequest_', $this->appsRequest_)
         . Protobuf::toString('commentsRequest_', $this->commentsRequest_)
         . Protobuf::toString('getAssetRequest_', $this->getAssetRequest_)
         . Protobuf::toString('imageRequest_', $this->imageRequest_)
         . Protobuf::toString('subCategoriesRequest_', $this->subCategoriesRequest_)
         . Protobuf::toString('categoriesRequest_', $this->categoriesRequest_);
  }

  // optional .AppsRequest appsRequest = 4;

  private $appsRequest_ = null;
  public function clearAppsRequest() { $this->appsRequest_ = null; }
  public function hasAppsRequest() { return $this->appsRequest_ !== null; }
  public function getAppsRequest() { if($this->appsRequest_ === null) return null; else return $this->appsRequest_; }
  public function setAppsRequest(AppsRequest $value) { $this->appsRequest_ = $value; }

  // optional .CommentsRequest commentsRequest = 5;

  private $commentsRequest_ = null;
  public function clearCommentsRequest() { $this->commentsRequest_ = null; }
  public function hasCommentsRequest() { return $this->commentsRequest_ !== null; }
  public function getCommentsRequest() { if($this->commentsRequest_ === null) return null; else return $this->commentsRequest_; }
  public function setCommentsRequest(CommentsRequest $value) { $this->commentsRequest_ = $value; }

  // optional .GetAssetRequest getAssetRequest = 10;

  private $getAssetRequest_ = null;
  public function clearGetAssetRequest() { $this->getAssetRequest_ = null; }
  public function hasGetAssetRequest() { return $this->getAssetRequest_ !== null; }
  public function getGetAssetRequest() { if($this->getAssetRequest_ === null) return null; else return $this->getAssetRequest_; }
  public function setGetAssetRequest(GetAssetRequest $value) { $this->getAssetRequest_ = $value; }

  // optional .GetImageRequest imageRequest = 11;

  private $imageRequest_ = null;
  public function clearImageRequest() { $this->imageRequest_ = null; }
  public function hasImageRequest() { return $this->imageRequest_ !== null; }
  public function getImageRequest() { if($this->imageRequest_ === null) return null; else return $this->imageRequest_; }
  public function setImageRequest(GetImageRequest $value) { $this->imageRequest_ = $value; }

  // optional .SubCategoriesRequest subCategoriesRequest = 14;

  private $subCategoriesRequest_ = null;
  public function clearSubCategoriesRequest() { $this->subCategoriesRequest_ = null; }
  public function hasSubCategoriesRequest() { return $this->subCategoriesRequest_ !== null; }
  public function getSubCategoriesRequest() { if($this->subCategoriesRequest_ === null) return null; else return $this->subCategoriesRequest_; }
  public function setSubCategoriesRequest(SubCategoriesRequest $value) { $this->subCategoriesRequest_ = $value; }

  // optional .CategoriesRequest categoriesRequest = 21;

  private $categoriesRequest_ = null;
  public function clearCategoriesRequest() { $this->categoriesRequest_ = null; }
  public function hasCategoriesRequest() { return $this->categoriesRequest_ !== null; }
  public function getCategoriesRequest() { if($this->categoriesRequest_ === null) return null; else return $this->categoriesRequest_; }
  public function setCategoriesRequest(CategoriesRequest $value) { $this->categoriesRequest_ = $value; }

  // @@protoc_insertion_point(class_scope:Request.RequestGroup)
}

// message Request
class Request {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("Request: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->context_ = new RequestContext($fp, $len);
          ASSERT('$len == 0');
          break;
        case 2:
          ASSERT('$wire == 3');
          $this->requestgroup_[] = new Request_RequestGroup($fp, $limit);
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->context_)) {
      fwrite($fp, "\x0a");
      Protobuf::write_varint($fp, $this->context_->size()); // message
      $this->context_->write($fp);
    }
    if (!is_null($this->requestgroup_))
      foreach($this->requestgroup_ as $v) {
        fwrite($fp, "\x13");
        $v->write($fp); // group
        fwrite($fp, "\x14");
      }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->context_)) {
      $l = $this->context_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->requestgroup_))
      foreach($this->requestgroup_ as $v) {
        $size += 2 + $v->size();
      }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('context_', $this->context_)
         . Protobuf::toString('requestgroup_', $this->requestgroup_);
  }

  // optional .RequestContext context = 1;

  private $context_ = null;
  public function clearContext() { $this->context_ = null; }
  public function hasContext() { return $this->context_ !== null; }
  public function getContext() { if($this->context_ === null) return null; else return $this->context_; }
  public function setContext(RequestContext $value) { $this->context_ = $value; }

  // repeated group RequestGroup = 2
  private $requestgroup_ = null;
  public function clearRequestgroup() { $this->requestgroup_ = null; }
  public function getRequestgroupCount() { if ($this->requestgroup_ === null ) return 0; else return count($this->requestgroup_); }
  public function getRequestgroup($index) { return $this->requestgroup_[$index]; }
  public function getRequestgroupArray() { if ($this->requestgroup_ === null ) return array(); else return $this->requestgroup_; }
  public function setRequestgroup($index, $value) {$this->requestgroup_[$index] = $value;	}
  public function addRequestgroup($value) { $this->requestgroup_[] = $value; }
  public function addAllRequestgroup(array $values) { foreach($values as $value) {$this->requestgroup_[] = $value;} }

  // @@protoc_insertion_point(class_scope:Request)
}

// message RequestContext
class RequestContext {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("RequestContext: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->authSubToken_ = $tmp;
          $limit-=$len;
          break;
        case 2:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->userAuthTokenSecure_ = $tmp;

          break;
        case 3:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->version_ = $tmp;

          break;
        case 4:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->androidId_ = $tmp;
          $limit-=$len;
          break;
        case 5:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->deviceAndSdkVersion_ = $tmp;
          $limit-=$len;
          break;
        case 6:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->userLanguage_ = $tmp;
          $limit-=$len;
          break;
        case 7:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->userCountry_ = $tmp;
          $limit-=$len;
          break;
        case 8:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->operatorAlpha_ = $tmp;
          $limit-=$len;
          break;
        case 9:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->simOperatorAlpha_ = $tmp;
          $limit-=$len;
          break;
        case 10:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->operatorNumeric_ = $tmp;
          $limit-=$len;
          break;
        case 11:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->simOperatorNumeric_ = $tmp;
          $limit-=$len;
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->authSubToken_)) {
      fwrite($fp, "\x0a");
      Protobuf::write_varint($fp, strlen($this->authSubToken_));
      fwrite($fp, $this->authSubToken_);
    }
    if (!is_null($this->userAuthTokenSecure_)) {
      fwrite($fp, "\x10");
      Protobuf::write_varint($fp, $this->userAuthTokenSecure_);
    }
    if (!is_null($this->version_)) {
      fwrite($fp, "\x18");
      Protobuf::write_varint($fp, $this->version_);
    }
    if (!is_null($this->androidId_)) {
      fwrite($fp, "\"");
      Protobuf::write_varint($fp, strlen($this->androidId_));
      fwrite($fp, $this->androidId_);
    }
    if (!is_null($this->deviceAndSdkVersion_)) {
      fwrite($fp, "*");
      Protobuf::write_varint($fp, strlen($this->deviceAndSdkVersion_));
      fwrite($fp, $this->deviceAndSdkVersion_);
    }
    if (!is_null($this->userLanguage_)) {
      fwrite($fp, "2");
      Protobuf::write_varint($fp, strlen($this->userLanguage_));
      fwrite($fp, $this->userLanguage_);
    }
    if (!is_null($this->userCountry_)) {
      fwrite($fp, ":");
      Protobuf::write_varint($fp, strlen($this->userCountry_));
      fwrite($fp, $this->userCountry_);
    }
    if (!is_null($this->operatorAlpha_)) {
      fwrite($fp, "B");
      Protobuf::write_varint($fp, strlen($this->operatorAlpha_));
      fwrite($fp, $this->operatorAlpha_);
    }
    if (!is_null($this->simOperatorAlpha_)) {
      fwrite($fp, "J");
      Protobuf::write_varint($fp, strlen($this->simOperatorAlpha_));
      fwrite($fp, $this->simOperatorAlpha_);
    }
    if (!is_null($this->operatorNumeric_)) {
      fwrite($fp, "R");
      Protobuf::write_varint($fp, strlen($this->operatorNumeric_));
      fwrite($fp, $this->operatorNumeric_);
    }
    if (!is_null($this->simOperatorNumeric_)) {
      fwrite($fp, "Z");
      Protobuf::write_varint($fp, strlen($this->simOperatorNumeric_));
      fwrite($fp, $this->simOperatorNumeric_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->authSubToken_)) {
      $l = strlen($this->authSubToken_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->userAuthTokenSecure_)) {
      $size += 1 + Protobuf::size_varint($this->userAuthTokenSecure_);
    }
    if (!is_null($this->version_)) {
      $size += 1 + Protobuf::size_varint($this->version_);
    }
    if (!is_null($this->androidId_)) {
      $l = strlen($this->androidId_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->deviceAndSdkVersion_)) {
      $l = strlen($this->deviceAndSdkVersion_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->userLanguage_)) {
      $l = strlen($this->userLanguage_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->userCountry_)) {
      $l = strlen($this->userCountry_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->operatorAlpha_)) {
      $l = strlen($this->operatorAlpha_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->simOperatorAlpha_)) {
      $l = strlen($this->simOperatorAlpha_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->operatorNumeric_)) {
      $l = strlen($this->operatorNumeric_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->simOperatorNumeric_)) {
      $l = strlen($this->simOperatorNumeric_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    if ($this->authSubToken_ === null) return false;
    if ($this->userAuthTokenSecure_ === null) return false;
    if ($this->version_ === null) return false;
    if ($this->androidId_ === null) return false;
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('authSubToken_', $this->authSubToken_)
         . Protobuf::toString('userAuthTokenSecure_', $this->userAuthTokenSecure_)
         . Protobuf::toString('version_', $this->version_)
         . Protobuf::toString('androidId_', $this->androidId_)
         . Protobuf::toString('deviceAndSdkVersion_', $this->deviceAndSdkVersion_)
         . Protobuf::toString('userLanguage_', $this->userLanguage_)
         . Protobuf::toString('userCountry_', $this->userCountry_)
         . Protobuf::toString('operatorAlpha_', $this->operatorAlpha_)
         . Protobuf::toString('simOperatorAlpha_', $this->simOperatorAlpha_)
         . Protobuf::toString('operatorNumeric_', $this->operatorNumeric_)
         . Protobuf::toString('simOperatorNumeric_', $this->simOperatorNumeric_);
  }

  // required string authSubToken = 1;

  private $authSubToken_ = null;
  public function clearAuthSubToken() { $this->authSubToken_ = null; }
  public function hasAuthSubToken() { return $this->authSubToken_ !== null; }
  public function getAuthSubToken() { if($this->authSubToken_ === null) return ""; else return $this->authSubToken_; }
  public function setAuthSubToken($value) { $this->authSubToken_ = $value; }

  // required int32 userAuthTokenSecure = 2;

  private $userAuthTokenSecure_ = null;
  public function clearUserAuthTokenSecure() { $this->userAuthTokenSecure_ = null; }
  public function hasUserAuthTokenSecure() { return $this->userAuthTokenSecure_ !== null; }
  public function getUserAuthTokenSecure() { if($this->userAuthTokenSecure_ === null) return 0; else return $this->userAuthTokenSecure_; }
  public function setUserAuthTokenSecure($value) { $this->userAuthTokenSecure_ = $value; }

  // required int32 version = 3;

  private $version_ = null;
  public function clearVersion() { $this->version_ = null; }
  public function hasVersion() { return $this->version_ !== null; }
  public function getVersion() { if($this->version_ === null) return 0; else return $this->version_; }
  public function setVersion($value) { $this->version_ = $value; }

  // required string androidId = 4;

  private $androidId_ = null;
  public function clearAndroidId() { $this->androidId_ = null; }
  public function hasAndroidId() { return $this->androidId_ !== null; }
  public function getAndroidId() { if($this->androidId_ === null) return ""; else return $this->androidId_; }
  public function setAndroidId($value) { $this->androidId_ = $value; }

  // optional string deviceAndSdkVersion = 5;

  private $deviceAndSdkVersion_ = null;
  public function clearDeviceAndSdkVersion() { $this->deviceAndSdkVersion_ = null; }
  public function hasDeviceAndSdkVersion() { return $this->deviceAndSdkVersion_ !== null; }
  public function getDeviceAndSdkVersion() { if($this->deviceAndSdkVersion_ === null) return ""; else return $this->deviceAndSdkVersion_; }
  public function setDeviceAndSdkVersion($value) { $this->deviceAndSdkVersion_ = $value; }

  // optional string userLanguage = 6;

  private $userLanguage_ = null;
  public function clearUserLanguage() { $this->userLanguage_ = null; }
  public function hasUserLanguage() { return $this->userLanguage_ !== null; }
  public function getUserLanguage() { if($this->userLanguage_ === null) return ""; else return $this->userLanguage_; }
  public function setUserLanguage($value) { $this->userLanguage_ = $value; }

  // optional string userCountry = 7;

  private $userCountry_ = null;
  public function clearUserCountry() { $this->userCountry_ = null; }
  public function hasUserCountry() { return $this->userCountry_ !== null; }
  public function getUserCountry() { if($this->userCountry_ === null) return ""; else return $this->userCountry_; }
  public function setUserCountry($value) { $this->userCountry_ = $value; }

  // optional string operatorAlpha = 8;

  private $operatorAlpha_ = null;
  public function clearOperatorAlpha() { $this->operatorAlpha_ = null; }
  public function hasOperatorAlpha() { return $this->operatorAlpha_ !== null; }
  public function getOperatorAlpha() { if($this->operatorAlpha_ === null) return ""; else return $this->operatorAlpha_; }
  public function setOperatorAlpha($value) { $this->operatorAlpha_ = $value; }

  // optional string simOperatorAlpha = 9;

  private $simOperatorAlpha_ = null;
  public function clearSimOperatorAlpha() { $this->simOperatorAlpha_ = null; }
  public function hasSimOperatorAlpha() { return $this->simOperatorAlpha_ !== null; }
  public function getSimOperatorAlpha() { if($this->simOperatorAlpha_ === null) return ""; else return $this->simOperatorAlpha_; }
  public function setSimOperatorAlpha($value) { $this->simOperatorAlpha_ = $value; }

  // optional string operatorNumeric = 10;

  private $operatorNumeric_ = null;
  public function clearOperatorNumeric() { $this->operatorNumeric_ = null; }
  public function hasOperatorNumeric() { return $this->operatorNumeric_ !== null; }
  public function getOperatorNumeric() { if($this->operatorNumeric_ === null) return ""; else return $this->operatorNumeric_; }
  public function setOperatorNumeric($value) { $this->operatorNumeric_ = $value; }

  // optional string simOperatorNumeric = 11;

  private $simOperatorNumeric_ = null;
  public function clearSimOperatorNumeric() { $this->simOperatorNumeric_ = null; }
  public function hasSimOperatorNumeric() { return $this->simOperatorNumeric_ !== null; }
  public function getSimOperatorNumeric() { if($this->simOperatorNumeric_ === null) return ""; else return $this->simOperatorNumeric_; }
  public function setSimOperatorNumeric($value) { $this->simOperatorNumeric_ = $value; }

  // @@protoc_insertion_point(class_scope:RequestContext)
}


// group Response.ResponseGroup
class Response_ResponseGroup {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("Response_ResponseGroup: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 4');
          break 2;
        case 2:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->context_ = new ResponseContext($fp, $len);
          ASSERT('$len == 0');
          break;
        case 3:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->appsResponse_ = new AppsResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        case 4:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->commentsResponse_ = new CommentsResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        case 9:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->getAssetResponse_ = new GetAssetResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        case 10:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->imageResponse_ = new GetImageResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        case 20:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->categoriesResponse_ = new CategoriesResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        case 13:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->subCategoriesResponse_ = new SubCategoriesResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->context_)) {
      fwrite($fp, "\x12");
      Protobuf::write_varint($fp, $this->context_->size()); // message
      $this->context_->write($fp);
    }
    if (!is_null($this->appsResponse_)) {
      fwrite($fp, "\x1a");
      Protobuf::write_varint($fp, $this->appsResponse_->size()); // message
      $this->appsResponse_->write($fp);
    }
    if (!is_null($this->commentsResponse_)) {
      fwrite($fp, "\"");
      Protobuf::write_varint($fp, $this->commentsResponse_->size()); // message
      $this->commentsResponse_->write($fp);
    }
    if (!is_null($this->getAssetResponse_)) {
      fwrite($fp, "J");
      Protobuf::write_varint($fp, $this->getAssetResponse_->size()); // message
      $this->getAssetResponse_->write($fp);
    }
    if (!is_null($this->imageResponse_)) {
      fwrite($fp, "R");
      Protobuf::write_varint($fp, $this->imageResponse_->size()); // message
      $this->imageResponse_->write($fp);
    }
    if (!is_null($this->categoriesResponse_)) {
      fwrite($fp, "\xa2\x01");
      Protobuf::write_varint($fp, $this->categoriesResponse_->size()); // message
      $this->categoriesResponse_->write($fp);
    }
    if (!is_null($this->subCategoriesResponse_)) {
      fwrite($fp, "j");
      Protobuf::write_varint($fp, $this->subCategoriesResponse_->size()); // message
      $this->subCategoriesResponse_->write($fp);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->context_)) {
      $l = $this->context_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->appsResponse_)) {
      $l = $this->appsResponse_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->commentsResponse_)) {
      $l = $this->commentsResponse_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->getAssetResponse_)) {
      $l = $this->getAssetResponse_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->imageResponse_)) {
      $l = $this->imageResponse_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->categoriesResponse_)) {
      $l = $this->categoriesResponse_->size();
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->subCategoriesResponse_)) {
      $l = $this->subCategoriesResponse_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('context_', $this->context_)
         . Protobuf::toString('appsResponse_', $this->appsResponse_)
         . Protobuf::toString('commentsResponse_', $this->commentsResponse_)
         . Protobuf::toString('getAssetResponse_', $this->getAssetResponse_)
         . Protobuf::toString('imageResponse_', $this->imageResponse_)
         . Protobuf::toString('categoriesResponse_', $this->categoriesResponse_)
         . Protobuf::toString('subCategoriesResponse_', $this->subCategoriesResponse_);
  }

  // optional .ResponseContext context = 2;

  private $context_ = null;
  public function clearContext() { $this->context_ = null; }
  public function hasContext() { return $this->context_ !== null; }
  public function getContext() { if($this->context_ === null) return null; else return $this->context_; }
  public function setContext(ResponseContext $value) { $this->context_ = $value; }

  // optional .AppsResponse appsResponse = 3;

  private $appsResponse_ = null;
  public function clearAppsResponse() { $this->appsResponse_ = null; }
  public function hasAppsResponse() { return $this->appsResponse_ !== null; }
  public function getAppsResponse() { if($this->appsResponse_ === null) return null; else return $this->appsResponse_; }
  public function setAppsResponse(AppsResponse $value) { $this->appsResponse_ = $value; }

  // optional .CommentsResponse commentsResponse = 4;

  private $commentsResponse_ = null;
  public function clearCommentsResponse() { $this->commentsResponse_ = null; }
  public function hasCommentsResponse() { return $this->commentsResponse_ !== null; }
  public function getCommentsResponse() { if($this->commentsResponse_ === null) return null; else return $this->commentsResponse_; }
  public function setCommentsResponse(CommentsResponse $value) { $this->commentsResponse_ = $value; }

  // optional .GetAssetResponse getAssetResponse = 9;

  private $getAssetResponse_ = null;
  public function clearGetAssetResponse() { $this->getAssetResponse_ = null; }
  public function hasGetAssetResponse() { return $this->getAssetResponse_ !== null; }
  public function getGetAssetResponse() { if($this->getAssetResponse_ === null) return null; else return $this->getAssetResponse_; }
  public function setGetAssetResponse(GetAssetResponse $value) { $this->getAssetResponse_ = $value; }

  // optional .GetImageResponse imageResponse = 10;

  private $imageResponse_ = null;
  public function clearImageResponse() { $this->imageResponse_ = null; }
  public function hasImageResponse() { return $this->imageResponse_ !== null; }
  public function getImageResponse() { if($this->imageResponse_ === null) return null; else return $this->imageResponse_; }
  public function setImageResponse(GetImageResponse $value) { $this->imageResponse_ = $value; }

  // optional .CategoriesResponse categoriesResponse = 20;

  private $categoriesResponse_ = null;
  public function clearCategoriesResponse() { $this->categoriesResponse_ = null; }
  public function hasCategoriesResponse() { return $this->categoriesResponse_ !== null; }
  public function getCategoriesResponse() { if($this->categoriesResponse_ === null) return null; else return $this->categoriesResponse_; }
  public function setCategoriesResponse(CategoriesResponse $value) { $this->categoriesResponse_ = $value; }

  // optional .SubCategoriesResponse subCategoriesResponse = 13;

  private $subCategoriesResponse_ = null;
  public function clearSubCategoriesResponse() { $this->subCategoriesResponse_ = null; }
  public function hasSubCategoriesResponse() { return $this->subCategoriesResponse_ !== null; }
  public function getSubCategoriesResponse() { if($this->subCategoriesResponse_ === null) return null; else return $this->subCategoriesResponse_; }
  public function setSubCategoriesResponse(SubCategoriesResponse $value) { $this->subCategoriesResponse_ = $value; }

  // @@protoc_insertion_point(class_scope:Response.ResponseGroup)
}

// message Response
class Response {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("Response: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 3');
          $this->responsegroup_[] = new Response_ResponseGroup($fp, $limit);
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->responsegroup_))
      foreach($this->responsegroup_ as $v) {
        fwrite($fp, "\x0b");
        $v->write($fp); // group
        fwrite($fp, "\x0c");
      }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->responsegroup_))
      foreach($this->responsegroup_ as $v) {
        $size += 2 + $v->size();
      }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('responsegroup_', $this->responsegroup_);
  }

  // repeated group ResponseGroup = 1
  private $responsegroup_ = null;
  public function clearResponsegroup() { $this->responsegroup_ = null; }
  public function getResponsegroupCount() { if ($this->responsegroup_ === null ) return 0; else return count($this->responsegroup_); }
  public function getResponsegroup($index) { return $this->responsegroup_[$index]; }
  public function getResponsegroupArray() { if ($this->responsegroup_ === null ) return array(); else return $this->responsegroup_; }
  public function setResponsegroup($index, $value) {$this->responsegroup_[$index] = $value;	}
  public function addResponsegroup($value) { $this->responsegroup_[] = $value; }
  public function addAllResponsegroup(array $values) { foreach($values as $value) {$this->responsegroup_[] = $value;} }

  // @@protoc_insertion_point(class_scope:Response)
}

// enum ResponseContext.ResultType
class ResponseContext_ResultType {
  const OK = 0;
  const BAD_REQUEST = 1;
  const INTERNAL_SERVICE_ERROR = 2;
  const NOT_MODIFIED = 3;
  const USER_INPUT_ERROR = 4;

  public static $_values = array(
    0 => self::OK,
    1 => self::BAD_REQUEST,
    2 => self::INTERNAL_SERVICE_ERROR,
    3 => self::NOT_MODIFIED,
    4 => self::USER_INPUT_ERROR,
  );

  public static function toString($value) {
    if (is_null($value)) return null;
    if (array_key_exists($value, self::$_values))
      return self::$_values[$value];
    return 'UNKNOWN';
  }
}

// message ResponseContext
class ResponseContext {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("ResponseContext: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->result_ = $tmp;

          break;
        case 2:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->maxAge_ = $tmp;

          break;
        case 3:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->etag_ = $tmp;
          $limit-=$len;
          break;
        case 4:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->serverVersion_ = $tmp;

          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->result_)) {
      fwrite($fp, "\x08");
      Protobuf::write_varint($fp, $this->result_);
    }
    if (!is_null($this->maxAge_)) {
      fwrite($fp, "\x10");
      Protobuf::write_varint($fp, $this->maxAge_);
    }
    if (!is_null($this->etag_)) {
      fwrite($fp, "\x1a");
      Protobuf::write_varint($fp, strlen($this->etag_));
      fwrite($fp, $this->etag_);
    }
    if (!is_null($this->serverVersion_)) {
      fwrite($fp, " ");
      Protobuf::write_varint($fp, $this->serverVersion_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->result_)) {
      $size += 1 + Protobuf::size_varint($this->result_);
    }
    if (!is_null($this->maxAge_)) {
      $size += 1 + Protobuf::size_varint($this->maxAge_);
    }
    if (!is_null($this->etag_)) {
      $l = strlen($this->etag_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->serverVersion_)) {
      $size += 1 + Protobuf::size_varint($this->serverVersion_);
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('result_', ResponseContext_ResultType::toString($this->result_))
         . Protobuf::toString('maxAge_', $this->maxAge_)
         . Protobuf::toString('etag_', $this->etag_)
         . Protobuf::toString('serverVersion_', $this->serverVersion_);
  }

  // optional .ResponseContext.ResultType result = 1;

  private $result_ = null;
  public function clearResult() { $this->result_ = null; }
  public function hasResult() { return $this->result_ !== null; }
  public function getResult() { if($this->result_ === null) return ResponseContext_ResultType::OK; else return $this->result_; }
  public function setResult($value) { $this->result_ = $value; }

  // optional int32 maxAge = 2;

  private $maxAge_ = null;
  public function clearMaxAge() { $this->maxAge_ = null; }
  public function hasMaxAge() { return $this->maxAge_ !== null; }
  public function getMaxAge() { if($this->maxAge_ === null) return 0; else return $this->maxAge_; }
  public function setMaxAge($value) { $this->maxAge_ = $value; }

  // optional string etag = 3;

  private $etag_ = null;
  public function clearEtag() { $this->etag_ = null; }
  public function hasEtag() { return $this->etag_ !== null; }
  public function getEtag() { if($this->etag_ === null) return ""; else return $this->etag_; }
  public function setEtag($value) { $this->etag_ = $value; }

  // optional int32 serverVersion = 4;

  private $serverVersion_ = null;
  public function clearServerVersion() { $this->serverVersion_ = null; }
  public function hasServerVersion() { return $this->serverVersion_ !== null; }
  public function getServerVersion() { if($this->serverVersion_ === null) return 0; else return $this->serverVersion_; }
  public function setServerVersion($value) { $this->serverVersion_ = $value; }

  // @@protoc_insertion_point(class_scope:ResponseContext)
}

// message Payload
class Payload {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("Payload: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->listResponse_ = new ListResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        case 2:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->detailsResponse_ = new DetailsResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        case 4:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->buyResponse_ = new BuyResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        case 5:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->searchResponse_ = new SearchResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        case 19:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->bulkDetailsResponse_ = new BulkDetailsResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        case 21:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->deliveryResponse_ = new DeliveryResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->listResponse_)) {
      fwrite($fp, "\x0a");
      Protobuf::write_varint($fp, $this->listResponse_->size()); // message
      $this->listResponse_->write($fp);
    }
    if (!is_null($this->detailsResponse_)) {
      fwrite($fp, "\x12");
      Protobuf::write_varint($fp, $this->detailsResponse_->size()); // message
      $this->detailsResponse_->write($fp);
    }
    if (!is_null($this->buyResponse_)) {
      fwrite($fp, "\"");
      Protobuf::write_varint($fp, $this->buyResponse_->size()); // message
      $this->buyResponse_->write($fp);
    }
    if (!is_null($this->searchResponse_)) {
      fwrite($fp, "*");
      Protobuf::write_varint($fp, $this->searchResponse_->size()); // message
      $this->searchResponse_->write($fp);
    }
    if (!is_null($this->bulkDetailsResponse_)) {
      fwrite($fp, "\x9a\x01");
      Protobuf::write_varint($fp, $this->bulkDetailsResponse_->size()); // message
      $this->bulkDetailsResponse_->write($fp);
    }
    if (!is_null($this->deliveryResponse_)) {
      fwrite($fp, "\xaa\x01");
      Protobuf::write_varint($fp, $this->deliveryResponse_->size()); // message
      $this->deliveryResponse_->write($fp);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->listResponse_)) {
      $l = $this->listResponse_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->detailsResponse_)) {
      $l = $this->detailsResponse_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->buyResponse_)) {
      $l = $this->buyResponse_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->searchResponse_)) {
      $l = $this->searchResponse_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->bulkDetailsResponse_)) {
      $l = $this->bulkDetailsResponse_->size();
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->deliveryResponse_)) {
      $l = $this->deliveryResponse_->size();
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('listResponse_', $this->listResponse_)
         . Protobuf::toString('detailsResponse_', $this->detailsResponse_)
         . Protobuf::toString('buyResponse_', $this->buyResponse_)
         . Protobuf::toString('searchResponse_', $this->searchResponse_)
         . Protobuf::toString('bulkDetailsResponse_', $this->bulkDetailsResponse_)
         . Protobuf::toString('deliveryResponse_', $this->deliveryResponse_);
  }

  // optional .ListResponse listResponse = 1;

  private $listResponse_ = null;
  public function clearListResponse() { $this->listResponse_ = null; }
  public function hasListResponse() { return $this->listResponse_ !== null; }
  public function getListResponse() { if($this->listResponse_ === null) return null; else return $this->listResponse_; }
  public function setListResponse(ListResponse $value) { $this->listResponse_ = $value; }

  // optional .DetailsResponse detailsResponse = 2;

  private $detailsResponse_ = null;
  public function clearDetailsResponse() { $this->detailsResponse_ = null; }
  public function hasDetailsResponse() { return $this->detailsResponse_ !== null; }
  public function getDetailsResponse() { if($this->detailsResponse_ === null) return null; else return $this->detailsResponse_; }
  public function setDetailsResponse(DetailsResponse $value) { $this->detailsResponse_ = $value; }

  // optional .BuyResponse buyResponse = 4;

  private $buyResponse_ = null;
  public function clearBuyResponse() { $this->buyResponse_ = null; }
  public function hasBuyResponse() { return $this->buyResponse_ !== null; }
  public function getBuyResponse() { if($this->buyResponse_ === null) return null; else return $this->buyResponse_; }
  public function setBuyResponse(BuyResponse $value) { $this->buyResponse_ = $value; }

  // optional .SearchResponse searchResponse = 5;

  private $searchResponse_ = null;
  public function clearSearchResponse() { $this->searchResponse_ = null; }
  public function hasSearchResponse() { return $this->searchResponse_ !== null; }
  public function getSearchResponse() { if($this->searchResponse_ === null) return null; else return $this->searchResponse_; }
  public function setSearchResponse(SearchResponse $value) { $this->searchResponse_ = $value; }

  // optional .BulkDetailsResponse bulkDetailsResponse = 19;

  private $bulkDetailsResponse_ = null;
  public function clearBulkDetailsResponse() { $this->bulkDetailsResponse_ = null; }
  public function hasBulkDetailsResponse() { return $this->bulkDetailsResponse_ !== null; }
  public function getBulkDetailsResponse() { if($this->bulkDetailsResponse_ === null) return null; else return $this->bulkDetailsResponse_; }
  public function setBulkDetailsResponse(BulkDetailsResponse $value) { $this->bulkDetailsResponse_ = $value; }

  // optional .DeliveryResponse deliveryResponse = 21;

  private $deliveryResponse_ = null;
  public function clearDeliveryResponse() { $this->deliveryResponse_ = null; }
  public function hasDeliveryResponse() { return $this->deliveryResponse_ !== null; }
  public function getDeliveryResponse() { if($this->deliveryResponse_ === null) return null; else return $this->deliveryResponse_; }
  public function setDeliveryResponse(DeliveryResponse $value) { $this->deliveryResponse_ = $value; }

  // @@protoc_insertion_point(class_scope:Payload)
}

// message ResponseWrapper
class ResponseWrapper {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("ResponseWrapper: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->payload_ = new Payload($fp, $len);
          ASSERT('$len == 0');
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->payload_)) {
      fwrite($fp, "\x0a");
      Protobuf::write_varint($fp, $this->payload_->size()); // message
      $this->payload_->write($fp);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->payload_)) {
      $l = $this->payload_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('payload_', $this->payload_);
  }

  // optional .Payload payload = 1;

  private $payload_ = null;
  public function clearPayload() { $this->payload_ = null; }
  public function hasPayload() { return $this->payload_ !== null; }
  public function getPayload() { if($this->payload_ === null) return null; else return $this->payload_; }
  public function setPayload(Payload $value) { $this->payload_ = $value; }

  // @@protoc_insertion_point(class_scope:ResponseWrapper)
}

// message AndroidAppDeliveryData
class AndroidAppDeliveryData {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("AndroidAppDeliveryData: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->downloadSize_ = $tmp;

          break;
        case 2:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->signature_ = $tmp;
          $limit-=$len;
          break;
        case 3:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->downloadUrl_ = $tmp;
          $limit-=$len;
          break;
        case 4:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->additionalFile_[] = new AppFileMetadata($fp, $len);
          ASSERT('$len == 0');
          break;
        case 5:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->downloadAuthCookie_[] = new HttpCookie($fp, $len);
          ASSERT('$len == 0');
          break;
        case 6:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->forwardLocked_ = $tmp > 0 ? true : false;
          break;
        case 7:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->refundTimeout_ = $tmp;

          break;
        case 8:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->serverInitiated_ = $tmp > 0 ? true : false;
          break;
        case 9:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->postInstallRefundWindowMillis_ = $tmp;

          break;
        case 10:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->immediateStartNeeded_ = $tmp > 0 ? true : false;
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->downloadSize_)) {
      fwrite($fp, "\x08");
      Protobuf::write_varint($fp, $this->downloadSize_);
    }
    if (!is_null($this->signature_)) {
      fwrite($fp, "\x12");
      Protobuf::write_varint($fp, strlen($this->signature_));
      fwrite($fp, $this->signature_);
    }
    if (!is_null($this->downloadUrl_)) {
      fwrite($fp, "\x1a");
      Protobuf::write_varint($fp, strlen($this->downloadUrl_));
      fwrite($fp, $this->downloadUrl_);
    }
    if (!is_null($this->additionalFile_))
      foreach($this->additionalFile_ as $v) {
        fwrite($fp, "\"");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
    if (!is_null($this->downloadAuthCookie_))
      foreach($this->downloadAuthCookie_ as $v) {
        fwrite($fp, "*");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
    if (!is_null($this->forwardLocked_)) {
      fwrite($fp, "0");
      Protobuf::write_varint($fp, $this->forwardLocked_ ? 1 : 0);
    }
    if (!is_null($this->refundTimeout_)) {
      fwrite($fp, "8");
      Protobuf::write_varint($fp, $this->refundTimeout_);
    }
    if (!is_null($this->serverInitiated_)) {
      fwrite($fp, "@");
      Protobuf::write_varint($fp, $this->serverInitiated_ ? 1 : 0);
    }
    if (!is_null($this->postInstallRefundWindowMillis_)) {
      fwrite($fp, "H");
      Protobuf::write_varint($fp, $this->postInstallRefundWindowMillis_);
    }
    if (!is_null($this->immediateStartNeeded_)) {
      fwrite($fp, "P");
      Protobuf::write_varint($fp, $this->immediateStartNeeded_ ? 1 : 0);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->downloadSize_)) {
      $size += 1 + Protobuf::size_varint($this->downloadSize_);
    }
    if (!is_null($this->signature_)) {
      $l = strlen($this->signature_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->downloadUrl_)) {
      $l = strlen($this->downloadUrl_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->additionalFile_))
      foreach($this->additionalFile_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->downloadAuthCookie_))
      foreach($this->downloadAuthCookie_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->forwardLocked_)) {
      $size += 2;
    }
    if (!is_null($this->refundTimeout_)) {
      $size += 1 + Protobuf::size_varint($this->refundTimeout_);
    }
    if (!is_null($this->serverInitiated_)) {
      $size += 2;
    }
    if (!is_null($this->postInstallRefundWindowMillis_)) {
      $size += 1 + Protobuf::size_varint($this->postInstallRefundWindowMillis_);
    }
    if (!is_null($this->immediateStartNeeded_)) {
      $size += 2;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('downloadSize_', $this->downloadSize_)
         . Protobuf::toString('signature_', $this->signature_)
         . Protobuf::toString('downloadUrl_', $this->downloadUrl_)
         . Protobuf::toString('additionalFile_', $this->additionalFile_)
         . Protobuf::toString('downloadAuthCookie_', $this->downloadAuthCookie_)
         . Protobuf::toString('forwardLocked_', $this->forwardLocked_)
         . Protobuf::toString('refundTimeout_', $this->refundTimeout_)
         . Protobuf::toString('serverInitiated_', $this->serverInitiated_)
         . Protobuf::toString('postInstallRefundWindowMillis_', $this->postInstallRefundWindowMillis_)
         . Protobuf::toString('immediateStartNeeded_', $this->immediateStartNeeded_);
  }

  // optional int64 downloadSize = 1;

  private $downloadSize_ = null;
  public function clearDownloadSize() { $this->downloadSize_ = null; }
  public function hasDownloadSize() { return $this->downloadSize_ !== null; }
  public function getDownloadSize() { if($this->downloadSize_ === null) return 0; else return $this->downloadSize_; }
  public function setDownloadSize($value) { $this->downloadSize_ = $value; }

  // optional string signature = 2;

  private $signature_ = null;
  public function clearSignature() { $this->signature_ = null; }
  public function hasSignature() { return $this->signature_ !== null; }
  public function getSignature() { if($this->signature_ === null) return ""; else return $this->signature_; }
  public function setSignature($value) { $this->signature_ = $value; }

  // optional string downloadUrl = 3;

  private $downloadUrl_ = null;
  public function clearDownloadUrl() { $this->downloadUrl_ = null; }
  public function hasDownloadUrl() { return $this->downloadUrl_ !== null; }
  public function getDownloadUrl() { if($this->downloadUrl_ === null) return ""; else return $this->downloadUrl_; }
  public function setDownloadUrl($value) { $this->downloadUrl_ = $value; }

  // repeated .AppFileMetadata additionalFile = 4;

  private $additionalFile_ = null;
  public function clearAdditionalFile() { $this->additionalFile_ = null; }
  public function getAdditionalFileCount() { if ($this->additionalFile_ === null ) return 0; else return count($this->additionalFile_); }
  public function getAdditionalFile($index) { return $this->additionalFile_[$index]; }
  public function getAdditionalFileArray() { if ($this->additionalFile_ === null ) return array(); else return $this->additionalFile_; }
  public function setAdditionalFile($index, $value) {$this->additionalFile_[$index] = $value;	}
  public function addAdditionalFile($value) { $this->additionalFile_[] = $value; }
  public function addAllAdditionalFile(array $values) { foreach($values as $value) {$this->additionalFile_[] = $value;} }

  // repeated .HttpCookie downloadAuthCookie = 5;

  private $downloadAuthCookie_ = null;
  public function clearDownloadAuthCookie() { $this->downloadAuthCookie_ = null; }
  public function getDownloadAuthCookieCount() { if ($this->downloadAuthCookie_ === null ) return 0; else return count($this->downloadAuthCookie_); }
  public function getDownloadAuthCookie($index) { return $this->downloadAuthCookie_[$index]; }
  public function getDownloadAuthCookieArray() { if ($this->downloadAuthCookie_ === null ) return array(); else return $this->downloadAuthCookie_; }
  public function setDownloadAuthCookie($index, $value) {$this->downloadAuthCookie_[$index] = $value;	}
  public function addDownloadAuthCookie($value) { $this->downloadAuthCookie_[] = $value; }
  public function addAllDownloadAuthCookie(array $values) { foreach($values as $value) {$this->downloadAuthCookie_[] = $value;} }

  // optional bool forwardLocked = 6;

  private $forwardLocked_ = null;
  public function clearForwardLocked() { $this->forwardLocked_ = null; }
  public function hasForwardLocked() { return $this->forwardLocked_ !== null; }
  public function getForwardLocked() { if($this->forwardLocked_ === null) return false; else return $this->forwardLocked_; }
  public function setForwardLocked($value) { $this->forwardLocked_ = $value; }

  // optional int64 refundTimeout = 7;

  private $refundTimeout_ = null;
  public function clearRefundTimeout() { $this->refundTimeout_ = null; }
  public function hasRefundTimeout() { return $this->refundTimeout_ !== null; }
  public function getRefundTimeout() { if($this->refundTimeout_ === null) return 0; else return $this->refundTimeout_; }
  public function setRefundTimeout($value) { $this->refundTimeout_ = $value; }

  // optional bool serverInitiated = 8;

  private $serverInitiated_ = null;
  public function clearServerInitiated() { $this->serverInitiated_ = null; }
  public function hasServerInitiated() { return $this->serverInitiated_ !== null; }
  public function getServerInitiated() { if($this->serverInitiated_ === null) return false; else return $this->serverInitiated_; }
  public function setServerInitiated($value) { $this->serverInitiated_ = $value; }

  // optional int64 postInstallRefundWindowMillis = 9;

  private $postInstallRefundWindowMillis_ = null;
  public function clearPostInstallRefundWindowMillis() { $this->postInstallRefundWindowMillis_ = null; }
  public function hasPostInstallRefundWindowMillis() { return $this->postInstallRefundWindowMillis_ !== null; }
  public function getPostInstallRefundWindowMillis() { if($this->postInstallRefundWindowMillis_ === null) return 0; else return $this->postInstallRefundWindowMillis_; }
  public function setPostInstallRefundWindowMillis($value) { $this->postInstallRefundWindowMillis_ = $value; }

  // optional bool immediateStartNeeded = 10;

  private $immediateStartNeeded_ = null;
  public function clearImmediateStartNeeded() { $this->immediateStartNeeded_ = null; }
  public function hasImmediateStartNeeded() { return $this->immediateStartNeeded_ !== null; }
  public function getImmediateStartNeeded() { if($this->immediateStartNeeded_ === null) return false; else return $this->immediateStartNeeded_; }
  public function setImmediateStartNeeded($value) { $this->immediateStartNeeded_ = $value; }

  // @@protoc_insertion_point(class_scope:AndroidAppDeliveryData)
}

// message AppFileMetadata
class AppFileMetadata {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("AppFileMetadata: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->fileType_ = $tmp;

          break;
        case 2:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->versionCode_ = $tmp;

          break;
        case 3:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->size_ = $tmp;

          break;
        case 4:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->downloadUrl_ = $tmp;
          $limit-=$len;
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->fileType_)) {
      fwrite($fp, "\x08");
      Protobuf::write_varint($fp, $this->fileType_);
    }
    if (!is_null($this->versionCode_)) {
      fwrite($fp, "\x10");
      Protobuf::write_varint($fp, $this->versionCode_);
    }
    if (!is_null($this->size_)) {
      fwrite($fp, "\x18");
      Protobuf::write_varint($fp, $this->size_);
    }
    if (!is_null($this->downloadUrl_)) {
      fwrite($fp, "\"");
      Protobuf::write_varint($fp, strlen($this->downloadUrl_));
      fwrite($fp, $this->downloadUrl_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->fileType_)) {
      $size += 1 + Protobuf::size_varint($this->fileType_);
    }
    if (!is_null($this->versionCode_)) {
      $size += 1 + Protobuf::size_varint($this->versionCode_);
    }
    if (!is_null($this->size_)) {
      $size += 1 + Protobuf::size_varint($this->size_);
    }
    if (!is_null($this->downloadUrl_)) {
      $l = strlen($this->downloadUrl_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('fileType_', $this->fileType_)
         . Protobuf::toString('versionCode_', $this->versionCode_)
         . Protobuf::toString('size_', $this->size_)
         . Protobuf::toString('downloadUrl_', $this->downloadUrl_);
  }

  // optional int32 fileType = 1;

  private $fileType_ = null;
  public function clearFileType() { $this->fileType_ = null; }
  public function hasFileType() { return $this->fileType_ !== null; }
  public function getFileType() { if($this->fileType_ === null) return 0; else return $this->fileType_; }
  public function setFileType($value) { $this->fileType_ = $value; }

  // optional int32 versionCode = 2;

  private $versionCode_ = null;
  public function clearVersionCode() { $this->versionCode_ = null; }
  public function hasVersionCode() { return $this->versionCode_ !== null; }
  public function getVersionCode() { if($this->versionCode_ === null) return 0; else return $this->versionCode_; }
  public function setVersionCode($value) { $this->versionCode_ = $value; }

  // optional int64 size = 3;

  private $size_ = null;
  public function clearSize() { $this->size_ = null; }
  public function hasSize() { return $this->size_ !== null; }
  public function getSize() { if($this->size_ === null) return 0; else return $this->size_; }
  public function setSize($value) { $this->size_ = $value; }

  // optional string downloadUrl = 4;

  private $downloadUrl_ = null;
  public function clearDownloadUrl() { $this->downloadUrl_ = null; }
  public function hasDownloadUrl() { return $this->downloadUrl_ !== null; }
  public function getDownloadUrl() { if($this->downloadUrl_ === null) return ""; else return $this->downloadUrl_; }
  public function setDownloadUrl($value) { $this->downloadUrl_ = $value; }

  // @@protoc_insertion_point(class_scope:AppFileMetadata)
}

// message HttpCookie
class HttpCookie {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("HttpCookie: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->name_ = $tmp;
          $limit-=$len;
          break;
        case 2:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->value_ = $tmp;
          $limit-=$len;
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->name_)) {
      fwrite($fp, "\x0a");
      Protobuf::write_varint($fp, strlen($this->name_));
      fwrite($fp, $this->name_);
    }
    if (!is_null($this->value_)) {
      fwrite($fp, "\x12");
      Protobuf::write_varint($fp, strlen($this->value_));
      fwrite($fp, $this->value_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->name_)) {
      $l = strlen($this->name_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->value_)) {
      $l = strlen($this->value_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('name_', $this->name_)
         . Protobuf::toString('value_', $this->value_);
  }

  // optional string name = 1;

  private $name_ = null;
  public function clearName() { $this->name_ = null; }
  public function hasName() { return $this->name_ !== null; }
  public function getName() { if($this->name_ === null) return ""; else return $this->name_; }
  public function setName($value) { $this->name_ = $value; }

  // optional string value = 2;

  private $value_ = null;
  public function clearValue() { $this->value_ = null; }
  public function hasValue() { return $this->value_ !== null; }
  public function getValue() { if($this->value_ === null) return ""; else return $this->value_; }
  public function setValue($value) { $this->value_ = $value; }

  // @@protoc_insertion_point(class_scope:HttpCookie)
}

// message Docid
class Docid {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("Docid: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->backendDocid_ = $tmp;
          $limit-=$len;
          break;
        case 2:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->type_ = $tmp;

          break;
        case 3:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->backend_ = $tmp;

          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->backendDocid_)) {
      fwrite($fp, "\x0a");
      Protobuf::write_varint($fp, strlen($this->backendDocid_));
      fwrite($fp, $this->backendDocid_);
    }
    if (!is_null($this->type_)) {
      fwrite($fp, "\x10");
      Protobuf::write_varint($fp, $this->type_);
    }
    if (!is_null($this->backend_)) {
      fwrite($fp, "\x18");
      Protobuf::write_varint($fp, $this->backend_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->backendDocid_)) {
      $l = strlen($this->backendDocid_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->type_)) {
      $size += 1 + Protobuf::size_varint($this->type_);
    }
    if (!is_null($this->backend_)) {
      $size += 1 + Protobuf::size_varint($this->backend_);
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('backendDocid_', $this->backendDocid_)
         . Protobuf::toString('type_', $this->type_)
         . Protobuf::toString('backend_', $this->backend_);
  }

  // optional string backendDocid = 1;

  private $backendDocid_ = null;
  public function clearBackendDocid() { $this->backendDocid_ = null; }
  public function hasBackendDocid() { return $this->backendDocid_ !== null; }
  public function getBackendDocid() { if($this->backendDocid_ === null) return ""; else return $this->backendDocid_; }
  public function setBackendDocid($value) { $this->backendDocid_ = $value; }

  // optional int32 type = 2;

  private $type_ = null;
  public function clearType() { $this->type_ = null; }
  public function hasType() { return $this->type_ !== null; }
  public function getType() { if($this->type_ === null) return 0; else return $this->type_; }
  public function setType($value) { $this->type_ = $value; }

  // optional int32 backend = 3;

  private $backend_ = null;
  public function clearBackend() { $this->backend_ = null; }
  public function hasBackend() { return $this->backend_ !== null; }
  public function getBackend() { if($this->backend_ === null) return 0; else return $this->backend_; }
  public function setBackend($value) { $this->backend_ = $value; }

  // @@protoc_insertion_point(class_scope:Docid)
}

// message Document
class Document {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("Document: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->docid_ = new Docid($fp, $len);
          ASSERT('$len == 0');
          break;
        case 2:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->fetchDocid_ = new Docid($fp, $len);
          ASSERT('$len == 0');
          break;
        case 3:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->sampleDocid_ = new Docid($fp, $len);
          ASSERT('$len == 0');
          break;
        case 4:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->title_ = $tmp;
          $limit-=$len;
          break;
        case 5:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->url_ = $tmp;
          $limit-=$len;
          break;
        case 6:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->snippet_[] = $tmp;
          $limit-=$len;
          break;
        case 10:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->image_[] = new Image($fp, $len);
          ASSERT('$len == 0');
          break;
        case 11:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->child_[] = new Document($fp, $len);
          ASSERT('$len == 0');
          break;
        case 17:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->categoryId_[] = $tmp;
          $limit-=$len;
          break;
        case 18:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->decoration_[] = new Document($fp, $len);
          ASSERT('$len == 0');
          break;
        case 19:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->parent_[] = new Document($fp, $len);
          ASSERT('$len == 0');
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->docid_)) {
      fwrite($fp, "\x0a");
      Protobuf::write_varint($fp, $this->docid_->size()); // message
      $this->docid_->write($fp);
    }
    if (!is_null($this->fetchDocid_)) {
      fwrite($fp, "\x12");
      Protobuf::write_varint($fp, $this->fetchDocid_->size()); // message
      $this->fetchDocid_->write($fp);
    }
    if (!is_null($this->sampleDocid_)) {
      fwrite($fp, "\x1a");
      Protobuf::write_varint($fp, $this->sampleDocid_->size()); // message
      $this->sampleDocid_->write($fp);
    }
    if (!is_null($this->title_)) {
      fwrite($fp, "\"");
      Protobuf::write_varint($fp, strlen($this->title_));
      fwrite($fp, $this->title_);
    }
    if (!is_null($this->url_)) {
      fwrite($fp, "*");
      Protobuf::write_varint($fp, strlen($this->url_));
      fwrite($fp, $this->url_);
    }
    if (!is_null($this->snippet_))
      foreach($this->snippet_ as $v) {
        fwrite($fp, "2");
        Protobuf::write_varint($fp, strlen($v));
        fwrite($fp, $v);
      }
    if (!is_null($this->image_))
      foreach($this->image_ as $v) {
        fwrite($fp, "R");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
    if (!is_null($this->child_))
      foreach($this->child_ as $v) {
        fwrite($fp, "Z");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
    if (!is_null($this->categoryId_))
      foreach($this->categoryId_ as $v) {
        fwrite($fp, "\x8a\x01");
        Protobuf::write_varint($fp, strlen($v));
        fwrite($fp, $v);
      }
    if (!is_null($this->decoration_))
      foreach($this->decoration_ as $v) {
        fwrite($fp, "\x92\x01");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
    if (!is_null($this->parent_))
      foreach($this->parent_ as $v) {
        fwrite($fp, "\x9a\x01");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->docid_)) {
      $l = $this->docid_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->fetchDocid_)) {
      $l = $this->fetchDocid_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->sampleDocid_)) {
      $l = $this->sampleDocid_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->title_)) {
      $l = strlen($this->title_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->url_)) {
      $l = strlen($this->url_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->snippet_))
      foreach($this->snippet_ as $v) {
        $l = strlen($v);
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->image_))
      foreach($this->image_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->child_))
      foreach($this->child_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->categoryId_))
      foreach($this->categoryId_ as $v) {
        $l = strlen($v);
        $size += 2 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->decoration_))
      foreach($this->decoration_ as $v) {
        $l = $v->size();
        $size += 2 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->parent_))
      foreach($this->parent_ as $v) {
        $l = $v->size();
        $size += 2 + Protobuf::size_varint($l) + $l;
      }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('docid_', $this->docid_)
         . Protobuf::toString('fetchDocid_', $this->fetchDocid_)
         . Protobuf::toString('sampleDocid_', $this->sampleDocid_)
         . Protobuf::toString('title_', $this->title_)
         . Protobuf::toString('url_', $this->url_)
         . Protobuf::toString('snippet_', $this->snippet_)
         . Protobuf::toString('image_', $this->image_)
         . Protobuf::toString('child_', $this->child_)
         . Protobuf::toString('categoryId_', $this->categoryId_)
         . Protobuf::toString('decoration_', $this->decoration_)
         . Protobuf::toString('parent_', $this->parent_);
  }

  // optional .Docid docid = 1;

  private $docid_ = null;
  public function clearDocid() { $this->docid_ = null; }
  public function hasDocid() { return $this->docid_ !== null; }
  public function getDocid() { if($this->docid_ === null) return null; else return $this->docid_; }
  public function setDocid(Docid $value) { $this->docid_ = $value; }

  // optional .Docid fetchDocid = 2;

  private $fetchDocid_ = null;
  public function clearFetchDocid() { $this->fetchDocid_ = null; }
  public function hasFetchDocid() { return $this->fetchDocid_ !== null; }
  public function getFetchDocid() { if($this->fetchDocid_ === null) return null; else return $this->fetchDocid_; }
  public function setFetchDocid(Docid $value) { $this->fetchDocid_ = $value; }

  // optional .Docid sampleDocid = 3;

  private $sampleDocid_ = null;
  public function clearSampleDocid() { $this->sampleDocid_ = null; }
  public function hasSampleDocid() { return $this->sampleDocid_ !== null; }
  public function getSampleDocid() { if($this->sampleDocid_ === null) return null; else return $this->sampleDocid_; }
  public function setSampleDocid(Docid $value) { $this->sampleDocid_ = $value; }

  // optional string title = 4;

  private $title_ = null;
  public function clearTitle() { $this->title_ = null; }
  public function hasTitle() { return $this->title_ !== null; }
  public function getTitle() { if($this->title_ === null) return ""; else return $this->title_; }
  public function setTitle($value) { $this->title_ = $value; }

  // optional string url = 5;

  private $url_ = null;
  public function clearUrl() { $this->url_ = null; }
  public function hasUrl() { return $this->url_ !== null; }
  public function getUrl() { if($this->url_ === null) return ""; else return $this->url_; }
  public function setUrl($value) { $this->url_ = $value; }

  // repeated string snippet = 6;

  private $snippet_ = null;
  public function clearSnippet() { $this->snippet_ = null; }
  public function getSnippetCount() { if ($this->snippet_ === null ) return 0; else return count($this->snippet_); }
  public function getSnippet($index) { return $this->snippet_[$index]; }
  public function getSnippetArray() { if ($this->snippet_ === null ) return array(); else return $this->snippet_; }
  public function setSnippet($index, $value) {$this->snippet_[$index] = $value;	}
  public function addSnippet($value) { $this->snippet_[] = $value; }
  public function addAllSnippet(array $values) { foreach($values as $value) {$this->snippet_[] = $value;} }

  // repeated .Image image = 10;

  private $image_ = null;
  public function clearImage() { $this->image_ = null; }
  public function getImageCount() { if ($this->image_ === null ) return 0; else return count($this->image_); }
  public function getImage($index) { return $this->image_[$index]; }
  public function getImageArray() { if ($this->image_ === null ) return array(); else return $this->image_; }
  public function setImage($index, $value) {$this->image_[$index] = $value;	}
  public function addImage($value) { $this->image_[] = $value; }
  public function addAllImage(array $values) { foreach($values as $value) {$this->image_[] = $value;} }

  // repeated .Document child = 11;

  private $child_ = null;
  public function clearChild() { $this->child_ = null; }
  public function getChildCount() { if ($this->child_ === null ) return 0; else return count($this->child_); }
  public function getChild($index) { return $this->child_[$index]; }
  public function getChildArray() { if ($this->child_ === null ) return array(); else return $this->child_; }
  public function setChild($index, $value) {$this->child_[$index] = $value;	}
  public function addChild($value) { $this->child_[] = $value; }
  public function addAllChild(array $values) { foreach($values as $value) {$this->child_[] = $value;} }

  // repeated string categoryId = 17;

  private $categoryId_ = null;
  public function clearCategoryId() { $this->categoryId_ = null; }
  public function getCategoryIdCount() { if ($this->categoryId_ === null ) return 0; else return count($this->categoryId_); }
  public function getCategoryId($index) { return $this->categoryId_[$index]; }
  public function getCategoryIdArray() { if ($this->categoryId_ === null ) return array(); else return $this->categoryId_; }
  public function setCategoryId($index, $value) {$this->categoryId_[$index] = $value;	}
  public function addCategoryId($value) { $this->categoryId_[] = $value; }
  public function addAllCategoryId(array $values) { foreach($values as $value) {$this->categoryId_[] = $value;} }

  // repeated .Document decoration = 18;

  private $decoration_ = null;
  public function clearDecoration() { $this->decoration_ = null; }
  public function getDecorationCount() { if ($this->decoration_ === null ) return 0; else return count($this->decoration_); }
  public function getDecoration($index) { return $this->decoration_[$index]; }
  public function getDecorationArray() { if ($this->decoration_ === null ) return array(); else return $this->decoration_; }
  public function setDecoration($index, $value) {$this->decoration_[$index] = $value;	}
  public function addDecoration($value) { $this->decoration_[] = $value; }
  public function addAllDecoration(array $values) { foreach($values as $value) {$this->decoration_[] = $value;} }

  // repeated .Document parent = 19;

  private $parent_ = null;
  public function clearParent() { $this->parent_ = null; }
  public function getParentCount() { if ($this->parent_ === null ) return 0; else return count($this->parent_); }
  public function getParent($index) { return $this->parent_[$index]; }
  public function getParentArray() { if ($this->parent_ === null ) return array(); else return $this->parent_; }
  public function setParent($index, $value) {$this->parent_[$index] = $value;	}
  public function addParent($value) { $this->parent_[] = $value; }
  public function addAllParent(array $values) { foreach($values as $value) {$this->parent_[] = $value;} }

  // @@protoc_insertion_point(class_scope:Document)
}

// message DocumentDetails
class DocumentDetails {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("DocumentDetails: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->appDetails_ = new AppDetails($fp, $len);
          ASSERT('$len == 0');
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->appDetails_)) {
      fwrite($fp, "\x0a");
      Protobuf::write_varint($fp, $this->appDetails_->size()); // message
      $this->appDetails_->write($fp);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->appDetails_)) {
      $l = $this->appDetails_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('appDetails_', $this->appDetails_);
  }

  // optional .AppDetails appDetails = 1;

  private $appDetails_ = null;
  public function clearAppDetails() { $this->appDetails_ = null; }
  public function hasAppDetails() { return $this->appDetails_ !== null; }
  public function getAppDetails() { if($this->appDetails_ === null) return null; else return $this->appDetails_; }
  public function setAppDetails(AppDetails $value) { $this->appDetails_ = $value; }

  // @@protoc_insertion_point(class_scope:DocumentDetails)
}

// message DeliveryResponse
class DeliveryResponse {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("DeliveryResponse: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->status_ = $tmp;

          break;
        case 2:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->appDeliveryData_ = new AndroidAppDeliveryData($fp, $len);
          ASSERT('$len == 0');
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->status_)) {
      fwrite($fp, "\x08");
      Protobuf::write_varint($fp, $this->status_);
    }
    if (!is_null($this->appDeliveryData_)) {
      fwrite($fp, "\x12");
      Protobuf::write_varint($fp, $this->appDeliveryData_->size()); // message
      $this->appDeliveryData_->write($fp);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->status_)) {
      $size += 1 + Protobuf::size_varint($this->status_);
    }
    if (!is_null($this->appDeliveryData_)) {
      $l = $this->appDeliveryData_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('status_', $this->status_)
         . Protobuf::toString('appDeliveryData_', $this->appDeliveryData_);
  }

  // optional int32 status = 1;

  private $status_ = null;
  public function clearStatus() { $this->status_ = null; }
  public function hasStatus() { return $this->status_ !== null; }
  public function getStatus() { if($this->status_ === null) return 0; else return $this->status_; }
  public function setStatus($value) { $this->status_ = $value; }

  // optional .AndroidAppDeliveryData appDeliveryData = 2;

  private $appDeliveryData_ = null;
  public function clearAppDeliveryData() { $this->appDeliveryData_ = null; }
  public function hasAppDeliveryData() { return $this->appDeliveryData_ !== null; }
  public function getAppDeliveryData() { if($this->appDeliveryData_ === null) return null; else return $this->appDeliveryData_; }
  public function setAppDeliveryData(AndroidAppDeliveryData $value) { $this->appDeliveryData_ = $value; }

  // @@protoc_insertion_point(class_scope:DeliveryResponse)
}

// message BulkDetailsEntry
class BulkDetailsEntry {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("BulkDetailsEntry: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->doc_ = new DocV2($fp, $len);
          ASSERT('$len == 0');
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->doc_)) {
      fwrite($fp, "\x0a");
      Protobuf::write_varint($fp, $this->doc_->size()); // message
      $this->doc_->write($fp);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->doc_)) {
      $l = $this->doc_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('doc_', $this->doc_);
  }

  // optional .DocV2 doc = 1;

  private $doc_ = null;
  public function clearDoc() { $this->doc_ = null; }
  public function hasDoc() { return $this->doc_ !== null; }
  public function getDoc() { if($this->doc_ === null) return null; else return $this->doc_; }
  public function setDoc(DocV2 $value) { $this->doc_ = $value; }

  // @@protoc_insertion_point(class_scope:BulkDetailsEntry)
}

// message BulkDetailsRequest
class BulkDetailsRequest {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("BulkDetailsRequest: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->docid_[] = $tmp;
          $limit-=$len;
          break;
        case 2:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->includeChildDocs_ = $tmp > 0 ? true : false;
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->docid_))
      foreach($this->docid_ as $v) {
        fwrite($fp, "\x0a");
        Protobuf::write_varint($fp, strlen($v));
        fwrite($fp, $v);
      }
    if (!is_null($this->includeChildDocs_)) {
      fwrite($fp, "\x10");
      Protobuf::write_varint($fp, $this->includeChildDocs_ ? 1 : 0);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->docid_))
      foreach($this->docid_ as $v) {
        $l = strlen($v);
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->includeChildDocs_)) {
      $size += 2;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('docid_', $this->docid_)
         . Protobuf::toString('includeChildDocs_', $this->includeChildDocs_);
  }

  // repeated string docid = 1;

  private $docid_ = null;
  public function clearDocid() { $this->docid_ = null; }
  public function getDocidCount() { if ($this->docid_ === null ) return 0; else return count($this->docid_); }
  public function getDocid($index) { return $this->docid_[$index]; }
  public function getDocidArray() { if ($this->docid_ === null ) return array(); else return $this->docid_; }
  public function setDocid($index, $value) {$this->docid_[$index] = $value;	}
  public function addDocid($value) { $this->docid_[] = $value; }
  public function addAllDocid(array $values) { foreach($values as $value) {$this->docid_[] = $value;} }

  // optional bool includeChildDocs = 2;

  private $includeChildDocs_ = null;
  public function clearIncludeChildDocs() { $this->includeChildDocs_ = null; }
  public function hasIncludeChildDocs() { return $this->includeChildDocs_ !== null; }
  public function getIncludeChildDocs() { if($this->includeChildDocs_ === null) return false; else return $this->includeChildDocs_; }
  public function setIncludeChildDocs($value) { $this->includeChildDocs_ = $value; }

  // @@protoc_insertion_point(class_scope:BulkDetailsRequest)
}

// message BulkDetailsResponse
class BulkDetailsResponse {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("BulkDetailsResponse: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->entry_[] = new BulkDetailsEntry($fp, $len);
          ASSERT('$len == 0');
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->entry_))
      foreach($this->entry_ as $v) {
        fwrite($fp, "\x0a");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->entry_))
      foreach($this->entry_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('entry_', $this->entry_);
  }

  // repeated .BulkDetailsEntry entry = 1;

  private $entry_ = null;
  public function clearEntry() { $this->entry_ = null; }
  public function getEntryCount() { if ($this->entry_ === null ) return 0; else return count($this->entry_); }
  public function getEntry($index) { return $this->entry_[$index]; }
  public function getEntryArray() { if ($this->entry_ === null ) return array(); else return $this->entry_; }
  public function setEntry($index, $value) {$this->entry_[$index] = $value;	}
  public function addEntry($value) { $this->entry_[] = $value; }
  public function addAllEntry(array $values) { foreach($values as $value) {$this->entry_[] = $value;} }

  // @@protoc_insertion_point(class_scope:BulkDetailsResponse)
}

// message DetailsResponse
class DetailsResponse {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("DetailsResponse: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->docV1_ = new DocV1($fp, $len);
          ASSERT('$len == 0');
          break;
        case 2:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->analyticsCookie_ = $tmp;
          $limit-=$len;
          break;
        case 4:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->docV2_ = new DocV2($fp, $len);
          ASSERT('$len == 0');
          break;
        case 5:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->footerHtml_ = $tmp;
          $limit-=$len;
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->docV1_)) {
      fwrite($fp, "\x0a");
      Protobuf::write_varint($fp, $this->docV1_->size()); // message
      $this->docV1_->write($fp);
    }
    if (!is_null($this->analyticsCookie_)) {
      fwrite($fp, "\x12");
      Protobuf::write_varint($fp, strlen($this->analyticsCookie_));
      fwrite($fp, $this->analyticsCookie_);
    }
    if (!is_null($this->docV2_)) {
      fwrite($fp, "\"");
      Protobuf::write_varint($fp, $this->docV2_->size()); // message
      $this->docV2_->write($fp);
    }
    if (!is_null($this->footerHtml_)) {
      fwrite($fp, "*");
      Protobuf::write_varint($fp, strlen($this->footerHtml_));
      fwrite($fp, $this->footerHtml_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->docV1_)) {
      $l = $this->docV1_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->analyticsCookie_)) {
      $l = strlen($this->analyticsCookie_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->docV2_)) {
      $l = $this->docV2_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->footerHtml_)) {
      $l = strlen($this->footerHtml_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('docV1_', $this->docV1_)
         . Protobuf::toString('analyticsCookie_', $this->analyticsCookie_)
         . Protobuf::toString('docV2_', $this->docV2_)
         . Protobuf::toString('footerHtml_', $this->footerHtml_);
  }

  // optional .DocV1 docV1 = 1;

  private $docV1_ = null;
  public function clearDocV1() { $this->docV1_ = null; }
  public function hasDocV1() { return $this->docV1_ !== null; }
  public function getDocV1() { if($this->docV1_ === null) return null; else return $this->docV1_; }
  public function setDocV1(DocV1 $value) { $this->docV1_ = $value; }

  // optional string analyticsCookie = 2;

  private $analyticsCookie_ = null;
  public function clearAnalyticsCookie() { $this->analyticsCookie_ = null; }
  public function hasAnalyticsCookie() { return $this->analyticsCookie_ !== null; }
  public function getAnalyticsCookie() { if($this->analyticsCookie_ === null) return ""; else return $this->analyticsCookie_; }
  public function setAnalyticsCookie($value) { $this->analyticsCookie_ = $value; }

  // optional .DocV2 docV2 = 4;

  private $docV2_ = null;
  public function clearDocV2() { $this->docV2_ = null; }
  public function hasDocV2() { return $this->docV2_ !== null; }
  public function getDocV2() { if($this->docV2_ === null) return null; else return $this->docV2_; }
  public function setDocV2(DocV2 $value) { $this->docV2_ = $value; }

  // optional string footerHtml = 5;

  private $footerHtml_ = null;
  public function clearFooterHtml() { $this->footerHtml_ = null; }
  public function hasFooterHtml() { return $this->footerHtml_ !== null; }
  public function getFooterHtml() { if($this->footerHtml_ === null) return ""; else return $this->footerHtml_; }
  public function setFooterHtml($value) { $this->footerHtml_ = $value; }

  // @@protoc_insertion_point(class_scope:DetailsResponse)
}


// group Image.Dimension
class Image_Dimension {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("Image_Dimension: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 2:
          ASSERT('$wire == 4');
          break 2;
        case 3:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->width_ = $tmp;

          break;
        case 4:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->height_ = $tmp;

          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->width_)) {
      fwrite($fp, "\x18");
      Protobuf::write_varint($fp, $this->width_);
    }
    if (!is_null($this->height_)) {
      fwrite($fp, " ");
      Protobuf::write_varint($fp, $this->height_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->width_)) {
      $size += 1 + Protobuf::size_varint($this->width_);
    }
    if (!is_null($this->height_)) {
      $size += 1 + Protobuf::size_varint($this->height_);
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('width_', $this->width_)
         . Protobuf::toString('height_', $this->height_);
  }

  // optional int32 width = 3;

  private $width_ = null;
  public function clearWidth() { $this->width_ = null; }
  public function hasWidth() { return $this->width_ !== null; }
  public function getWidth() { if($this->width_ === null) return 0; else return $this->width_; }
  public function setWidth($value) { $this->width_ = $value; }

  // optional int32 height = 4;

  private $height_ = null;
  public function clearHeight() { $this->height_ = null; }
  public function hasHeight() { return $this->height_ !== null; }
  public function getHeight() { if($this->height_ === null) return 0; else return $this->height_; }
  public function setHeight($value) { $this->height_ = $value; }

  // @@protoc_insertion_point(class_scope:Image.Dimension)
}


// group Image.Citation
class Image_Citation {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("Image_Citation: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 10:
          ASSERT('$wire == 4');
          break 2;
        case 11:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->titleLocalized_ = $tmp;
          $limit-=$len;
          break;
        case 12:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->url_ = $tmp;
          $limit-=$len;
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->titleLocalized_)) {
      fwrite($fp, "Z");
      Protobuf::write_varint($fp, strlen($this->titleLocalized_));
      fwrite($fp, $this->titleLocalized_);
    }
    if (!is_null($this->url_)) {
      fwrite($fp, "b");
      Protobuf::write_varint($fp, strlen($this->url_));
      fwrite($fp, $this->url_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->titleLocalized_)) {
      $l = strlen($this->titleLocalized_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->url_)) {
      $l = strlen($this->url_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('titleLocalized_', $this->titleLocalized_)
         . Protobuf::toString('url_', $this->url_);
  }

  // optional string titleLocalized = 11;

  private $titleLocalized_ = null;
  public function clearTitleLocalized() { $this->titleLocalized_ = null; }
  public function hasTitleLocalized() { return $this->titleLocalized_ !== null; }
  public function getTitleLocalized() { if($this->titleLocalized_ === null) return ""; else return $this->titleLocalized_; }
  public function setTitleLocalized($value) { $this->titleLocalized_ = $value; }

  // optional string url = 12;

  private $url_ = null;
  public function clearUrl() { $this->url_ = null; }
  public function hasUrl() { return $this->url_ !== null; }
  public function getUrl() { if($this->url_ === null) return ""; else return $this->url_; }
  public function setUrl($value) { $this->url_ = $value; }

  // @@protoc_insertion_point(class_scope:Image.Citation)
}

// message Image
class Image {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("Image: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->imageType_ = $tmp;

          break;
        case 2:
          ASSERT('$wire == 3');
          $this->dimension_ = new Image_Dimension($fp, $limit);
          break;
        case 5:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->imageUrl_ = $tmp;
          $limit-=$len;
          break;
        case 6:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->altTextLocalized_ = $tmp;
          $limit-=$len;
          break;
        case 7:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->secureUrl_ = $tmp;
          $limit-=$len;
          break;
        case 8:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->positionInSequence_ = $tmp;

          break;
        case 9:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->supportsFifeUrlOptions_ = $tmp > 0 ? true : false;
          break;
        case 10:
          ASSERT('$wire == 3');
          $this->citation_ = new Image_Citation($fp, $limit);
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->imageType_)) {
      fwrite($fp, "\x08");
      Protobuf::write_varint($fp, $this->imageType_);
    }
    if (!is_null($this->dimension_)) {
      fwrite($fp, "\x13");
      $this->dimension_->write($fp); // group
      fwrite($fp, "\x14");
    }
    if (!is_null($this->imageUrl_)) {
      fwrite($fp, "*");
      Protobuf::write_varint($fp, strlen($this->imageUrl_));
      fwrite($fp, $this->imageUrl_);
    }
    if (!is_null($this->altTextLocalized_)) {
      fwrite($fp, "2");
      Protobuf::write_varint($fp, strlen($this->altTextLocalized_));
      fwrite($fp, $this->altTextLocalized_);
    }
    if (!is_null($this->secureUrl_)) {
      fwrite($fp, ":");
      Protobuf::write_varint($fp, strlen($this->secureUrl_));
      fwrite($fp, $this->secureUrl_);
    }
    if (!is_null($this->positionInSequence_)) {
      fwrite($fp, "@");
      Protobuf::write_varint($fp, $this->positionInSequence_);
    }
    if (!is_null($this->supportsFifeUrlOptions_)) {
      fwrite($fp, "H");
      Protobuf::write_varint($fp, $this->supportsFifeUrlOptions_ ? 1 : 0);
    }
    if (!is_null($this->citation_)) {
      fwrite($fp, "S");
      $this->citation_->write($fp); // group
      fwrite($fp, "T");
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->imageType_)) {
      $size += 1 + Protobuf::size_varint($this->imageType_);
    }
    if (!is_null($this->dimension_)) {
      $size += 2 + $this->dimension_->size();
    }
    if (!is_null($this->imageUrl_)) {
      $l = strlen($this->imageUrl_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->altTextLocalized_)) {
      $l = strlen($this->altTextLocalized_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->secureUrl_)) {
      $l = strlen($this->secureUrl_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->positionInSequence_)) {
      $size += 1 + Protobuf::size_varint($this->positionInSequence_);
    }
    if (!is_null($this->supportsFifeUrlOptions_)) {
      $size += 2;
    }
    if (!is_null($this->citation_)) {
      $size += 2 + $this->citation_->size();
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('imageType_', $this->imageType_)
         . Protobuf::toString('dimension_', $this->dimension_)
         . Protobuf::toString('imageUrl_', $this->imageUrl_)
         . Protobuf::toString('altTextLocalized_', $this->altTextLocalized_)
         . Protobuf::toString('secureUrl_', $this->secureUrl_)
         . Protobuf::toString('positionInSequence_', $this->positionInSequence_)
         . Protobuf::toString('supportsFifeUrlOptions_', $this->supportsFifeUrlOptions_)
         . Protobuf::toString('citation_', $this->citation_);
  }

  // optional int32 imageType = 1;

  private $imageType_ = null;
  public function clearImageType() { $this->imageType_ = null; }
  public function hasImageType() { return $this->imageType_ !== null; }
  public function getImageType() { if($this->imageType_ === null) return 0; else return $this->imageType_; }
  public function setImageType($value) { $this->imageType_ = $value; }

  // optional group Dimension = 2
  private $dimension_ = null;
  public function clearDimension() { $this->dimension_ = null; }
  public function hasDimension() { return $this->dimension_ !== null; }
  public function getDimension() { if($this->dimension_ === null) return null; else return $this->dimension_; }
  public function setDimension(Image_Dimension $value) { $this->dimension_ = $value; }

  // optional string imageUrl = 5;

  private $imageUrl_ = null;
  public function clearImageUrl() { $this->imageUrl_ = null; }
  public function hasImageUrl() { return $this->imageUrl_ !== null; }
  public function getImageUrl() { if($this->imageUrl_ === null) return ""; else return $this->imageUrl_; }
  public function setImageUrl($value) { $this->imageUrl_ = $value; }

  // optional string altTextLocalized = 6;

  private $altTextLocalized_ = null;
  public function clearAltTextLocalized() { $this->altTextLocalized_ = null; }
  public function hasAltTextLocalized() { return $this->altTextLocalized_ !== null; }
  public function getAltTextLocalized() { if($this->altTextLocalized_ === null) return ""; else return $this->altTextLocalized_; }
  public function setAltTextLocalized($value) { $this->altTextLocalized_ = $value; }

  // optional string secureUrl = 7;

  private $secureUrl_ = null;
  public function clearSecureUrl() { $this->secureUrl_ = null; }
  public function hasSecureUrl() { return $this->secureUrl_ !== null; }
  public function getSecureUrl() { if($this->secureUrl_ === null) return ""; else return $this->secureUrl_; }
  public function setSecureUrl($value) { $this->secureUrl_ = $value; }

  // optional int32 positionInSequence = 8;

  private $positionInSequence_ = null;
  public function clearPositionInSequence() { $this->positionInSequence_ = null; }
  public function hasPositionInSequence() { return $this->positionInSequence_ !== null; }
  public function getPositionInSequence() { if($this->positionInSequence_ === null) return 0; else return $this->positionInSequence_; }
  public function setPositionInSequence($value) { $this->positionInSequence_ = $value; }

  // optional bool supportsFifeUrlOptions = 9;

  private $supportsFifeUrlOptions_ = null;
  public function clearSupportsFifeUrlOptions() { $this->supportsFifeUrlOptions_ = null; }
  public function hasSupportsFifeUrlOptions() { return $this->supportsFifeUrlOptions_ !== null; }
  public function getSupportsFifeUrlOptions() { if($this->supportsFifeUrlOptions_ === null) return false; else return $this->supportsFifeUrlOptions_; }
  public function setSupportsFifeUrlOptions($value) { $this->supportsFifeUrlOptions_ = $value; }

  // optional group Citation = 10
  private $citation_ = null;
  public function clearCitation() { $this->citation_ = null; }
  public function hasCitation() { return $this->citation_ !== null; }
  public function getCitation() { if($this->citation_ === null) return null; else return $this->citation_; }
  public function setCitation(Image_Citation $value) { $this->citation_ = $value; }

  // @@protoc_insertion_point(class_scope:Image)
}

// message AppDetails
class AppDetails {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("AppDetails: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->developerName_ = $tmp;
          $limit-=$len;
          break;
        case 2:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->majorVersionNumber_ = $tmp;

          break;
        case 3:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->versionCode_ = $tmp;

          break;
        case 4:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->versionString_ = $tmp;
          $limit-=$len;
          break;
        case 5:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->title_ = $tmp;
          $limit-=$len;
          break;
        case 7:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->appCategory_[] = $tmp;
          $limit-=$len;
          break;
        case 8:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->contentRating_ = $tmp;

          break;
        case 9:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->installationSize_ = $tmp;

          break;
        case 10:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->permission_[] = $tmp;
          $limit-=$len;
          break;
        case 11:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->developerEmail_ = $tmp;
          $limit-=$len;
          break;
        case 12:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->developerWebsite_ = $tmp;
          $limit-=$len;
          break;
        case 13:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->numDownloads_ = $tmp;
          $limit-=$len;
          break;
        case 14:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->packageName_ = $tmp;
          $limit-=$len;
          break;
        case 15:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->recentChangesHtml_ = $tmp;
          $limit-=$len;
          break;
        case 16:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->uploadDate_ = $tmp;
          $limit-=$len;
          break;
        case 17:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->file_[] = new AppFileMetadata($fp, $len);
          ASSERT('$len == 0');
          break;
        case 18:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->appType_ = $tmp;
          $limit-=$len;
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->developerName_)) {
      fwrite($fp, "\x0a");
      Protobuf::write_varint($fp, strlen($this->developerName_));
      fwrite($fp, $this->developerName_);
    }
    if (!is_null($this->majorVersionNumber_)) {
      fwrite($fp, "\x10");
      Protobuf::write_varint($fp, $this->majorVersionNumber_);
    }
    if (!is_null($this->versionCode_)) {
      fwrite($fp, "\x18");
      Protobuf::write_varint($fp, $this->versionCode_);
    }
    if (!is_null($this->versionString_)) {
      fwrite($fp, "\"");
      Protobuf::write_varint($fp, strlen($this->versionString_));
      fwrite($fp, $this->versionString_);
    }
    if (!is_null($this->title_)) {
      fwrite($fp, "*");
      Protobuf::write_varint($fp, strlen($this->title_));
      fwrite($fp, $this->title_);
    }
    if (!is_null($this->appCategory_))
      foreach($this->appCategory_ as $v) {
        fwrite($fp, ":");
        Protobuf::write_varint($fp, strlen($v));
        fwrite($fp, $v);
      }
    if (!is_null($this->contentRating_)) {
      fwrite($fp, "@");
      Protobuf::write_varint($fp, $this->contentRating_);
    }
    if (!is_null($this->installationSize_)) {
      fwrite($fp, "H");
      Protobuf::write_varint($fp, $this->installationSize_);
    }
    if (!is_null($this->permission_))
      foreach($this->permission_ as $v) {
        fwrite($fp, "R");
        Protobuf::write_varint($fp, strlen($v));
        fwrite($fp, $v);
      }
    if (!is_null($this->developerEmail_)) {
      fwrite($fp, "Z");
      Protobuf::write_varint($fp, strlen($this->developerEmail_));
      fwrite($fp, $this->developerEmail_);
    }
    if (!is_null($this->developerWebsite_)) {
      fwrite($fp, "b");
      Protobuf::write_varint($fp, strlen($this->developerWebsite_));
      fwrite($fp, $this->developerWebsite_);
    }
    if (!is_null($this->numDownloads_)) {
      fwrite($fp, "j");
      Protobuf::write_varint($fp, strlen($this->numDownloads_));
      fwrite($fp, $this->numDownloads_);
    }
    if (!is_null($this->packageName_)) {
      fwrite($fp, "r");
      Protobuf::write_varint($fp, strlen($this->packageName_));
      fwrite($fp, $this->packageName_);
    }
    if (!is_null($this->recentChangesHtml_)) {
      fwrite($fp, "z");
      Protobuf::write_varint($fp, strlen($this->recentChangesHtml_));
      fwrite($fp, $this->recentChangesHtml_);
    }
    if (!is_null($this->uploadDate_)) {
      fwrite($fp, "\x82\x01");
      Protobuf::write_varint($fp, strlen($this->uploadDate_));
      fwrite($fp, $this->uploadDate_);
    }
    if (!is_null($this->file_))
      foreach($this->file_ as $v) {
        fwrite($fp, "\x8a\x01");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
    if (!is_null($this->appType_)) {
      fwrite($fp, "\x92\x01");
      Protobuf::write_varint($fp, strlen($this->appType_));
      fwrite($fp, $this->appType_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->developerName_)) {
      $l = strlen($this->developerName_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->majorVersionNumber_)) {
      $size += 1 + Protobuf::size_varint($this->majorVersionNumber_);
    }
    if (!is_null($this->versionCode_)) {
      $size += 1 + Protobuf::size_varint($this->versionCode_);
    }
    if (!is_null($this->versionString_)) {
      $l = strlen($this->versionString_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->title_)) {
      $l = strlen($this->title_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->appCategory_))
      foreach($this->appCategory_ as $v) {
        $l = strlen($v);
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->contentRating_)) {
      $size += 1 + Protobuf::size_varint($this->contentRating_);
    }
    if (!is_null($this->installationSize_)) {
      $size += 1 + Protobuf::size_varint($this->installationSize_);
    }
    if (!is_null($this->permission_))
      foreach($this->permission_ as $v) {
        $l = strlen($v);
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->developerEmail_)) {
      $l = strlen($this->developerEmail_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->developerWebsite_)) {
      $l = strlen($this->developerWebsite_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->numDownloads_)) {
      $l = strlen($this->numDownloads_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->packageName_)) {
      $l = strlen($this->packageName_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->recentChangesHtml_)) {
      $l = strlen($this->recentChangesHtml_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->uploadDate_)) {
      $l = strlen($this->uploadDate_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->file_))
      foreach($this->file_ as $v) {
        $l = $v->size();
        $size += 2 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->appType_)) {
      $l = strlen($this->appType_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('developerName_', $this->developerName_)
         . Protobuf::toString('majorVersionNumber_', $this->majorVersionNumber_)
         . Protobuf::toString('versionCode_', $this->versionCode_)
         . Protobuf::toString('versionString_', $this->versionString_)
         . Protobuf::toString('title_', $this->title_)
         . Protobuf::toString('appCategory_', $this->appCategory_)
         . Protobuf::toString('contentRating_', $this->contentRating_)
         . Protobuf::toString('installationSize_', $this->installationSize_)
         . Protobuf::toString('permission_', $this->permission_)
         . Protobuf::toString('developerEmail_', $this->developerEmail_)
         . Protobuf::toString('developerWebsite_', $this->developerWebsite_)
         . Protobuf::toString('numDownloads_', $this->numDownloads_)
         . Protobuf::toString('packageName_', $this->packageName_)
         . Protobuf::toString('recentChangesHtml_', $this->recentChangesHtml_)
         . Protobuf::toString('uploadDate_', $this->uploadDate_)
         . Protobuf::toString('file_', $this->file_)
         . Protobuf::toString('appType_', $this->appType_);
  }

  // optional string developerName = 1;

  private $developerName_ = null;
  public function clearDeveloperName() { $this->developerName_ = null; }
  public function hasDeveloperName() { return $this->developerName_ !== null; }
  public function getDeveloperName() { if($this->developerName_ === null) return ""; else return $this->developerName_; }
  public function setDeveloperName($value) { $this->developerName_ = $value; }

  // optional int32 majorVersionNumber = 2;

  private $majorVersionNumber_ = null;
  public function clearMajorVersionNumber() { $this->majorVersionNumber_ = null; }
  public function hasMajorVersionNumber() { return $this->majorVersionNumber_ !== null; }
  public function getMajorVersionNumber() { if($this->majorVersionNumber_ === null) return 0; else return $this->majorVersionNumber_; }
  public function setMajorVersionNumber($value) { $this->majorVersionNumber_ = $value; }

  // optional int32 versionCode = 3;

  private $versionCode_ = null;
  public function clearVersionCode() { $this->versionCode_ = null; }
  public function hasVersionCode() { return $this->versionCode_ !== null; }
  public function getVersionCode() { if($this->versionCode_ === null) return 0; else return $this->versionCode_; }
  public function setVersionCode($value) { $this->versionCode_ = $value; }

  // optional string versionString = 4;

  private $versionString_ = null;
  public function clearVersionString() { $this->versionString_ = null; }
  public function hasVersionString() { return $this->versionString_ !== null; }
  public function getVersionString() { if($this->versionString_ === null) return ""; else return $this->versionString_; }
  public function setVersionString($value) { $this->versionString_ = $value; }

  // optional string title = 5;

  private $title_ = null;
  public function clearTitle() { $this->title_ = null; }
  public function hasTitle() { return $this->title_ !== null; }
  public function getTitle() { if($this->title_ === null) return ""; else return $this->title_; }
  public function setTitle($value) { $this->title_ = $value; }

  // repeated string appCategory = 7;

  private $appCategory_ = null;
  public function clearAppCategory() { $this->appCategory_ = null; }
  public function getAppCategoryCount() { if ($this->appCategory_ === null ) return 0; else return count($this->appCategory_); }
  public function getAppCategory($index) { return $this->appCategory_[$index]; }
  public function getAppCategoryArray() { if ($this->appCategory_ === null ) return array(); else return $this->appCategory_; }
  public function setAppCategory($index, $value) {$this->appCategory_[$index] = $value;	}
  public function addAppCategory($value) { $this->appCategory_[] = $value; }
  public function addAllAppCategory(array $values) { foreach($values as $value) {$this->appCategory_[] = $value;} }

  // optional int32 contentRating = 8;

  private $contentRating_ = null;
  public function clearContentRating() { $this->contentRating_ = null; }
  public function hasContentRating() { return $this->contentRating_ !== null; }
  public function getContentRating() { if($this->contentRating_ === null) return 0; else return $this->contentRating_; }
  public function setContentRating($value) { $this->contentRating_ = $value; }

  // optional int64 installationSize = 9;

  private $installationSize_ = null;
  public function clearInstallationSize() { $this->installationSize_ = null; }
  public function hasInstallationSize() { return $this->installationSize_ !== null; }
  public function getInstallationSize() { if($this->installationSize_ === null) return 0; else return $this->installationSize_; }
  public function setInstallationSize($value) { $this->installationSize_ = $value; }

  // repeated string permission = 10;

  private $permission_ = null;
  public function clearPermission() { $this->permission_ = null; }
  public function getPermissionCount() { if ($this->permission_ === null ) return 0; else return count($this->permission_); }
  public function getPermission($index) { return $this->permission_[$index]; }
  public function getPermissionArray() { if ($this->permission_ === null ) return array(); else return $this->permission_; }
  public function setPermission($index, $value) {$this->permission_[$index] = $value;	}
  public function addPermission($value) { $this->permission_[] = $value; }
  public function addAllPermission(array $values) { foreach($values as $value) {$this->permission_[] = $value;} }

  // optional string developerEmail = 11;

  private $developerEmail_ = null;
  public function clearDeveloperEmail() { $this->developerEmail_ = null; }
  public function hasDeveloperEmail() { return $this->developerEmail_ !== null; }
  public function getDeveloperEmail() { if($this->developerEmail_ === null) return ""; else return $this->developerEmail_; }
  public function setDeveloperEmail($value) { $this->developerEmail_ = $value; }

  // optional string developerWebsite = 12;

  private $developerWebsite_ = null;
  public function clearDeveloperWebsite() { $this->developerWebsite_ = null; }
  public function hasDeveloperWebsite() { return $this->developerWebsite_ !== null; }
  public function getDeveloperWebsite() { if($this->developerWebsite_ === null) return ""; else return $this->developerWebsite_; }
  public function setDeveloperWebsite($value) { $this->developerWebsite_ = $value; }

  // optional string numDownloads = 13;

  private $numDownloads_ = null;
  public function clearNumDownloads() { $this->numDownloads_ = null; }
  public function hasNumDownloads() { return $this->numDownloads_ !== null; }
  public function getNumDownloads() { if($this->numDownloads_ === null) return ""; else return $this->numDownloads_; }
  public function setNumDownloads($value) { $this->numDownloads_ = $value; }

  // optional string packageName = 14;

  private $packageName_ = null;
  public function clearPackageName() { $this->packageName_ = null; }
  public function hasPackageName() { return $this->packageName_ !== null; }
  public function getPackageName() { if($this->packageName_ === null) return ""; else return $this->packageName_; }
  public function setPackageName($value) { $this->packageName_ = $value; }

  // optional string recentChangesHtml = 15;

  private $recentChangesHtml_ = null;
  public function clearRecentChangesHtml() { $this->recentChangesHtml_ = null; }
  public function hasRecentChangesHtml() { return $this->recentChangesHtml_ !== null; }
  public function getRecentChangesHtml() { if($this->recentChangesHtml_ === null) return ""; else return $this->recentChangesHtml_; }
  public function setRecentChangesHtml($value) { $this->recentChangesHtml_ = $value; }

  // optional string uploadDate = 16;

  private $uploadDate_ = null;
  public function clearUploadDate() { $this->uploadDate_ = null; }
  public function hasUploadDate() { return $this->uploadDate_ !== null; }
  public function getUploadDate() { if($this->uploadDate_ === null) return ""; else return $this->uploadDate_; }
  public function setUploadDate($value) { $this->uploadDate_ = $value; }

  // repeated .AppFileMetadata file = 17;

  private $file_ = null;
  public function clearFile() { $this->file_ = null; }
  public function getFileCount() { if ($this->file_ === null ) return 0; else return count($this->file_); }
  public function getFile($index) { return $this->file_[$index]; }
  public function getFileArray() { if ($this->file_ === null ) return array(); else return $this->file_; }
  public function setFile($index, $value) {$this->file_[$index] = $value;	}
  public function addFile($value) { $this->file_[] = $value; }
  public function addAllFile(array $values) { foreach($values as $value) {$this->file_[] = $value;} }

  // optional string appType = 18;

  private $appType_ = null;
  public function clearAppType() { $this->appType_ = null; }
  public function hasAppType() { return $this->appType_ !== null; }
  public function getAppType() { if($this->appType_ === null) return ""; else return $this->appType_; }
  public function setAppType($value) { $this->appType_ = $value; }

  // @@protoc_insertion_point(class_scope:AppDetails)
}

// message Bucket
class Bucket {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("Bucket: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->document_[] = new DocV1($fp, $len);
          ASSERT('$len == 0');
          break;
        case 2:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->multiCorpus_ = $tmp > 0 ? true : false;
          break;
        case 3:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->title_ = $tmp;
          $limit-=$len;
          break;
        case 4:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->iconUrl_ = $tmp;
          $limit-=$len;
          break;
        case 5:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->fullContentsUrl_ = $tmp;
          $limit-=$len;
          break;
        case 6:
          ASSERT('$wire == 1');
          $tmp = Protobuf::read_double($fp);
          if ($tmp === false)
            throw new Exception('Protobuf::read_double returned false');
          $this->relevance_ = $tmp;
          $limit-=8;
          break;
        case 7:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->estimatedResults_ = $tmp;

          break;
        case 8:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->analyticsCookie_ = $tmp;
          $limit-=$len;
          break;
        case 9:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->fullContentsListUrl_ = $tmp;
          $limit-=$len;
          break;
        case 10:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->nextPageUrl_ = $tmp;
          $limit-=$len;
          break;
        case 11:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->ordered_ = $tmp > 0 ? true : false;
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->document_))
      foreach($this->document_ as $v) {
        fwrite($fp, "\x0a");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
    if (!is_null($this->multiCorpus_)) {
      fwrite($fp, "\x10");
      Protobuf::write_varint($fp, $this->multiCorpus_ ? 1 : 0);
    }
    if (!is_null($this->title_)) {
      fwrite($fp, "\x1a");
      Protobuf::write_varint($fp, strlen($this->title_));
      fwrite($fp, $this->title_);
    }
    if (!is_null($this->iconUrl_)) {
      fwrite($fp, "\"");
      Protobuf::write_varint($fp, strlen($this->iconUrl_));
      fwrite($fp, $this->iconUrl_);
    }
    if (!is_null($this->fullContentsUrl_)) {
      fwrite($fp, "*");
      Protobuf::write_varint($fp, strlen($this->fullContentsUrl_));
      fwrite($fp, $this->fullContentsUrl_);
    }
    if (!is_null($this->relevance_)) {
      fwrite($fp, "1");
      Protobuf::write_double($fp, $this->relevance_);
    }
    if (!is_null($this->estimatedResults_)) {
      fwrite($fp, "8");
      Protobuf::write_varint($fp, $this->estimatedResults_);
    }
    if (!is_null($this->analyticsCookie_)) {
      fwrite($fp, "B");
      Protobuf::write_varint($fp, strlen($this->analyticsCookie_));
      fwrite($fp, $this->analyticsCookie_);
    }
    if (!is_null($this->fullContentsListUrl_)) {
      fwrite($fp, "J");
      Protobuf::write_varint($fp, strlen($this->fullContentsListUrl_));
      fwrite($fp, $this->fullContentsListUrl_);
    }
    if (!is_null($this->nextPageUrl_)) {
      fwrite($fp, "R");
      Protobuf::write_varint($fp, strlen($this->nextPageUrl_));
      fwrite($fp, $this->nextPageUrl_);
    }
    if (!is_null($this->ordered_)) {
      fwrite($fp, "X");
      Protobuf::write_varint($fp, $this->ordered_ ? 1 : 0);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->document_))
      foreach($this->document_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->multiCorpus_)) {
      $size += 2;
    }
    if (!is_null($this->title_)) {
      $l = strlen($this->title_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->iconUrl_)) {
      $l = strlen($this->iconUrl_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->fullContentsUrl_)) {
      $l = strlen($this->fullContentsUrl_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->relevance_)) {
      $size += 9;
    }
    if (!is_null($this->estimatedResults_)) {
      $size += 1 + Protobuf::size_varint($this->estimatedResults_);
    }
    if (!is_null($this->analyticsCookie_)) {
      $l = strlen($this->analyticsCookie_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->fullContentsListUrl_)) {
      $l = strlen($this->fullContentsListUrl_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->nextPageUrl_)) {
      $l = strlen($this->nextPageUrl_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->ordered_)) {
      $size += 2;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('document_', $this->document_)
         . Protobuf::toString('multiCorpus_', $this->multiCorpus_)
         . Protobuf::toString('title_', $this->title_)
         . Protobuf::toString('iconUrl_', $this->iconUrl_)
         . Protobuf::toString('fullContentsUrl_', $this->fullContentsUrl_)
         . Protobuf::toString('relevance_', $this->relevance_)
         . Protobuf::toString('estimatedResults_', $this->estimatedResults_)
         . Protobuf::toString('analyticsCookie_', $this->analyticsCookie_)
         . Protobuf::toString('fullContentsListUrl_', $this->fullContentsListUrl_)
         . Protobuf::toString('nextPageUrl_', $this->nextPageUrl_)
         . Protobuf::toString('ordered_', $this->ordered_);
  }

  // repeated .DocV1 document = 1;

  private $document_ = null;
  public function clearDocument() { $this->document_ = null; }
  public function getDocumentCount() { if ($this->document_ === null ) return 0; else return count($this->document_); }
  public function getDocument($index) { return $this->document_[$index]; }
  public function getDocumentArray() { if ($this->document_ === null ) return array(); else return $this->document_; }
  public function setDocument($index, $value) {$this->document_[$index] = $value;	}
  public function addDocument($value) { $this->document_[] = $value; }
  public function addAllDocument(array $values) { foreach($values as $value) {$this->document_[] = $value;} }

  // optional bool multiCorpus = 2;

  private $multiCorpus_ = null;
  public function clearMultiCorpus() { $this->multiCorpus_ = null; }
  public function hasMultiCorpus() { return $this->multiCorpus_ !== null; }
  public function getMultiCorpus() { if($this->multiCorpus_ === null) return false; else return $this->multiCorpus_; }
  public function setMultiCorpus($value) { $this->multiCorpus_ = $value; }

  // optional string title = 3;

  private $title_ = null;
  public function clearTitle() { $this->title_ = null; }
  public function hasTitle() { return $this->title_ !== null; }
  public function getTitle() { if($this->title_ === null) return ""; else return $this->title_; }
  public function setTitle($value) { $this->title_ = $value; }

  // optional string iconUrl = 4;

  private $iconUrl_ = null;
  public function clearIconUrl() { $this->iconUrl_ = null; }
  public function hasIconUrl() { return $this->iconUrl_ !== null; }
  public function getIconUrl() { if($this->iconUrl_ === null) return ""; else return $this->iconUrl_; }
  public function setIconUrl($value) { $this->iconUrl_ = $value; }

  // optional string fullContentsUrl = 5;

  private $fullContentsUrl_ = null;
  public function clearFullContentsUrl() { $this->fullContentsUrl_ = null; }
  public function hasFullContentsUrl() { return $this->fullContentsUrl_ !== null; }
  public function getFullContentsUrl() { if($this->fullContentsUrl_ === null) return ""; else return $this->fullContentsUrl_; }
  public function setFullContentsUrl($value) { $this->fullContentsUrl_ = $value; }

  // optional double relevance = 6;

  private $relevance_ = null;
  public function clearRelevance() { $this->relevance_ = null; }
  public function hasRelevance() { return $this->relevance_ !== null; }
  public function getRelevance() { if($this->relevance_ === null) return 0; else return $this->relevance_; }
  public function setRelevance($value) { $this->relevance_ = $value; }

  // optional int64 estimatedResults = 7;

  private $estimatedResults_ = null;
  public function clearEstimatedResults() { $this->estimatedResults_ = null; }
  public function hasEstimatedResults() { return $this->estimatedResults_ !== null; }
  public function getEstimatedResults() { if($this->estimatedResults_ === null) return 0; else return $this->estimatedResults_; }
  public function setEstimatedResults($value) { $this->estimatedResults_ = $value; }

  // optional string analyticsCookie = 8;

  private $analyticsCookie_ = null;
  public function clearAnalyticsCookie() { $this->analyticsCookie_ = null; }
  public function hasAnalyticsCookie() { return $this->analyticsCookie_ !== null; }
  public function getAnalyticsCookie() { if($this->analyticsCookie_ === null) return ""; else return $this->analyticsCookie_; }
  public function setAnalyticsCookie($value) { $this->analyticsCookie_ = $value; }

  // optional string fullContentsListUrl = 9;

  private $fullContentsListUrl_ = null;
  public function clearFullContentsListUrl() { $this->fullContentsListUrl_ = null; }
  public function hasFullContentsListUrl() { return $this->fullContentsListUrl_ !== null; }
  public function getFullContentsListUrl() { if($this->fullContentsListUrl_ === null) return ""; else return $this->fullContentsListUrl_; }
  public function setFullContentsListUrl($value) { $this->fullContentsListUrl_ = $value; }

  // optional string nextPageUrl = 10;

  private $nextPageUrl_ = null;
  public function clearNextPageUrl() { $this->nextPageUrl_ = null; }
  public function hasNextPageUrl() { return $this->nextPageUrl_ !== null; }
  public function getNextPageUrl() { if($this->nextPageUrl_ === null) return ""; else return $this->nextPageUrl_; }
  public function setNextPageUrl($value) { $this->nextPageUrl_ = $value; }

  // optional bool ordered = 11;

  private $ordered_ = null;
  public function clearOrdered() { $this->ordered_ = null; }
  public function hasOrdered() { return $this->ordered_ !== null; }
  public function getOrdered() { if($this->ordered_ === null) return false; else return $this->ordered_; }
  public function setOrdered($value) { $this->ordered_ = $value; }

  // @@protoc_insertion_point(class_scope:Bucket)
}

// message ListResponse
class ListResponse {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("ListResponse: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->bucket_[] = new Bucket($fp, $len);
          ASSERT('$len == 0');
          break;
        case 2:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->doc_[] = new DocV2($fp, $len);
          ASSERT('$len == 0');
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->bucket_))
      foreach($this->bucket_ as $v) {
        fwrite($fp, "\x0a");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
    if (!is_null($this->doc_))
      foreach($this->doc_ as $v) {
        fwrite($fp, "\x12");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->bucket_))
      foreach($this->bucket_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->doc_))
      foreach($this->doc_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('bucket_', $this->bucket_)
         . Protobuf::toString('doc_', $this->doc_);
  }

  // repeated .Bucket bucket = 1;

  private $bucket_ = null;
  public function clearBucket() { $this->bucket_ = null; }
  public function getBucketCount() { if ($this->bucket_ === null ) return 0; else return count($this->bucket_); }
  public function getBucket($index) { return $this->bucket_[$index]; }
  public function getBucketArray() { if ($this->bucket_ === null ) return array(); else return $this->bucket_; }
  public function setBucket($index, $value) {$this->bucket_[$index] = $value;	}
  public function addBucket($value) { $this->bucket_[] = $value; }
  public function addAllBucket(array $values) { foreach($values as $value) {$this->bucket_[] = $value;} }

  // repeated .DocV2 doc = 2;

  private $doc_ = null;
  public function clearDoc() { $this->doc_ = null; }
  public function getDocCount() { if ($this->doc_ === null ) return 0; else return count($this->doc_); }
  public function getDoc($index) { return $this->doc_[$index]; }
  public function getDocArray() { if ($this->doc_ === null ) return array(); else return $this->doc_; }
  public function setDoc($index, $value) {$this->doc_[$index] = $value;	}
  public function addDoc($value) { $this->doc_[] = $value; }
  public function addAllDoc(array $values) { foreach($values as $value) {$this->doc_[] = $value;} }

  // @@protoc_insertion_point(class_scope:ListResponse)
}

// message DocV1
class DocV1 {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("DocV1: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->finskyDoc_ = new Document($fp, $len);
          ASSERT('$len == 0');
          break;
        case 2:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->docid_ = $tmp;
          $limit-=$len;
          break;
        case 3:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->detailsUrl_ = $tmp;
          $limit-=$len;
          break;
        case 4:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->reviewsUrl_ = $tmp;
          $limit-=$len;
          break;
        case 5:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->relatedListUrl_ = $tmp;
          $limit-=$len;
          break;
        case 6:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->moreByListUrl_ = $tmp;
          $limit-=$len;
          break;
        case 7:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->shareUrl_ = $tmp;
          $limit-=$len;
          break;
        case 8:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->creator_ = $tmp;
          $limit-=$len;
          break;
        case 9:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->details_ = new DocumentDetails($fp, $len);
          ASSERT('$len == 0');
          break;
        case 10:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->descriptionHtml_ = $tmp;
          $limit-=$len;
          break;
        case 11:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->relatedBrowseUrl_ = $tmp;
          $limit-=$len;
          break;
        case 12:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->moreByBrowseUrl_ = $tmp;
          $limit-=$len;
          break;
        case 13:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->relatedHeader_ = $tmp;
          $limit-=$len;
          break;
        case 14:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->moreByHeader_ = $tmp;
          $limit-=$len;
          break;
        case 15:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->title_ = $tmp;
          $limit-=$len;
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->finskyDoc_)) {
      fwrite($fp, "\x0a");
      Protobuf::write_varint($fp, $this->finskyDoc_->size()); // message
      $this->finskyDoc_->write($fp);
    }
    if (!is_null($this->docid_)) {
      fwrite($fp, "\x12");
      Protobuf::write_varint($fp, strlen($this->docid_));
      fwrite($fp, $this->docid_);
    }
    if (!is_null($this->detailsUrl_)) {
      fwrite($fp, "\x1a");
      Protobuf::write_varint($fp, strlen($this->detailsUrl_));
      fwrite($fp, $this->detailsUrl_);
    }
    if (!is_null($this->reviewsUrl_)) {
      fwrite($fp, "\"");
      Protobuf::write_varint($fp, strlen($this->reviewsUrl_));
      fwrite($fp, $this->reviewsUrl_);
    }
    if (!is_null($this->relatedListUrl_)) {
      fwrite($fp, "*");
      Protobuf::write_varint($fp, strlen($this->relatedListUrl_));
      fwrite($fp, $this->relatedListUrl_);
    }
    if (!is_null($this->moreByListUrl_)) {
      fwrite($fp, "2");
      Protobuf::write_varint($fp, strlen($this->moreByListUrl_));
      fwrite($fp, $this->moreByListUrl_);
    }
    if (!is_null($this->shareUrl_)) {
      fwrite($fp, ":");
      Protobuf::write_varint($fp, strlen($this->shareUrl_));
      fwrite($fp, $this->shareUrl_);
    }
    if (!is_null($this->creator_)) {
      fwrite($fp, "B");
      Protobuf::write_varint($fp, strlen($this->creator_));
      fwrite($fp, $this->creator_);
    }
    if (!is_null($this->details_)) {
      fwrite($fp, "J");
      Protobuf::write_varint($fp, $this->details_->size()); // message
      $this->details_->write($fp);
    }
    if (!is_null($this->descriptionHtml_)) {
      fwrite($fp, "R");
      Protobuf::write_varint($fp, strlen($this->descriptionHtml_));
      fwrite($fp, $this->descriptionHtml_);
    }
    if (!is_null($this->relatedBrowseUrl_)) {
      fwrite($fp, "Z");
      Protobuf::write_varint($fp, strlen($this->relatedBrowseUrl_));
      fwrite($fp, $this->relatedBrowseUrl_);
    }
    if (!is_null($this->moreByBrowseUrl_)) {
      fwrite($fp, "b");
      Protobuf::write_varint($fp, strlen($this->moreByBrowseUrl_));
      fwrite($fp, $this->moreByBrowseUrl_);
    }
    if (!is_null($this->relatedHeader_)) {
      fwrite($fp, "j");
      Protobuf::write_varint($fp, strlen($this->relatedHeader_));
      fwrite($fp, $this->relatedHeader_);
    }
    if (!is_null($this->moreByHeader_)) {
      fwrite($fp, "r");
      Protobuf::write_varint($fp, strlen($this->moreByHeader_));
      fwrite($fp, $this->moreByHeader_);
    }
    if (!is_null($this->title_)) {
      fwrite($fp, "z");
      Protobuf::write_varint($fp, strlen($this->title_));
      fwrite($fp, $this->title_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->finskyDoc_)) {
      $l = $this->finskyDoc_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->docid_)) {
      $l = strlen($this->docid_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->detailsUrl_)) {
      $l = strlen($this->detailsUrl_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->reviewsUrl_)) {
      $l = strlen($this->reviewsUrl_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->relatedListUrl_)) {
      $l = strlen($this->relatedListUrl_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->moreByListUrl_)) {
      $l = strlen($this->moreByListUrl_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->shareUrl_)) {
      $l = strlen($this->shareUrl_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->creator_)) {
      $l = strlen($this->creator_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->details_)) {
      $l = $this->details_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->descriptionHtml_)) {
      $l = strlen($this->descriptionHtml_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->relatedBrowseUrl_)) {
      $l = strlen($this->relatedBrowseUrl_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->moreByBrowseUrl_)) {
      $l = strlen($this->moreByBrowseUrl_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->relatedHeader_)) {
      $l = strlen($this->relatedHeader_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->moreByHeader_)) {
      $l = strlen($this->moreByHeader_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->title_)) {
      $l = strlen($this->title_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('finskyDoc_', $this->finskyDoc_)
         . Protobuf::toString('docid_', $this->docid_)
         . Protobuf::toString('detailsUrl_', $this->detailsUrl_)
         . Protobuf::toString('reviewsUrl_', $this->reviewsUrl_)
         . Protobuf::toString('relatedListUrl_', $this->relatedListUrl_)
         . Protobuf::toString('moreByListUrl_', $this->moreByListUrl_)
         . Protobuf::toString('shareUrl_', $this->shareUrl_)
         . Protobuf::toString('creator_', $this->creator_)
         . Protobuf::toString('details_', $this->details_)
         . Protobuf::toString('descriptionHtml_', $this->descriptionHtml_)
         . Protobuf::toString('relatedBrowseUrl_', $this->relatedBrowseUrl_)
         . Protobuf::toString('moreByBrowseUrl_', $this->moreByBrowseUrl_)
         . Protobuf::toString('relatedHeader_', $this->relatedHeader_)
         . Protobuf::toString('moreByHeader_', $this->moreByHeader_)
         . Protobuf::toString('title_', $this->title_);
  }

  // optional .Document finskyDoc = 1;

  private $finskyDoc_ = null;
  public function clearFinskyDoc() { $this->finskyDoc_ = null; }
  public function hasFinskyDoc() { return $this->finskyDoc_ !== null; }
  public function getFinskyDoc() { if($this->finskyDoc_ === null) return null; else return $this->finskyDoc_; }
  public function setFinskyDoc(Document $value) { $this->finskyDoc_ = $value; }

  // optional string docid = 2;

  private $docid_ = null;
  public function clearDocid() { $this->docid_ = null; }
  public function hasDocid() { return $this->docid_ !== null; }
  public function getDocid() { if($this->docid_ === null) return ""; else return $this->docid_; }
  public function setDocid($value) { $this->docid_ = $value; }

  // optional string detailsUrl = 3;

  private $detailsUrl_ = null;
  public function clearDetailsUrl() { $this->detailsUrl_ = null; }
  public function hasDetailsUrl() { return $this->detailsUrl_ !== null; }
  public function getDetailsUrl() { if($this->detailsUrl_ === null) return ""; else return $this->detailsUrl_; }
  public function setDetailsUrl($value) { $this->detailsUrl_ = $value; }

  // optional string reviewsUrl = 4;

  private $reviewsUrl_ = null;
  public function clearReviewsUrl() { $this->reviewsUrl_ = null; }
  public function hasReviewsUrl() { return $this->reviewsUrl_ !== null; }
  public function getReviewsUrl() { if($this->reviewsUrl_ === null) return ""; else return $this->reviewsUrl_; }
  public function setReviewsUrl($value) { $this->reviewsUrl_ = $value; }

  // optional string relatedListUrl = 5;

  private $relatedListUrl_ = null;
  public function clearRelatedListUrl() { $this->relatedListUrl_ = null; }
  public function hasRelatedListUrl() { return $this->relatedListUrl_ !== null; }
  public function getRelatedListUrl() { if($this->relatedListUrl_ === null) return ""; else return $this->relatedListUrl_; }
  public function setRelatedListUrl($value) { $this->relatedListUrl_ = $value; }

  // optional string moreByListUrl = 6;

  private $moreByListUrl_ = null;
  public function clearMoreByListUrl() { $this->moreByListUrl_ = null; }
  public function hasMoreByListUrl() { return $this->moreByListUrl_ !== null; }
  public function getMoreByListUrl() { if($this->moreByListUrl_ === null) return ""; else return $this->moreByListUrl_; }
  public function setMoreByListUrl($value) { $this->moreByListUrl_ = $value; }

  // optional string shareUrl = 7;

  private $shareUrl_ = null;
  public function clearShareUrl() { $this->shareUrl_ = null; }
  public function hasShareUrl() { return $this->shareUrl_ !== null; }
  public function getShareUrl() { if($this->shareUrl_ === null) return ""; else return $this->shareUrl_; }
  public function setShareUrl($value) { $this->shareUrl_ = $value; }

  // optional string creator = 8;

  private $creator_ = null;
  public function clearCreator() { $this->creator_ = null; }
  public function hasCreator() { return $this->creator_ !== null; }
  public function getCreator() { if($this->creator_ === null) return ""; else return $this->creator_; }
  public function setCreator($value) { $this->creator_ = $value; }

  // optional .DocumentDetails details = 9;

  private $details_ = null;
  public function clearDetails() { $this->details_ = null; }
  public function hasDetails() { return $this->details_ !== null; }
  public function getDetails() { if($this->details_ === null) return null; else return $this->details_; }
  public function setDetails(DocumentDetails $value) { $this->details_ = $value; }

  // optional string descriptionHtml = 10;

  private $descriptionHtml_ = null;
  public function clearDescriptionHtml() { $this->descriptionHtml_ = null; }
  public function hasDescriptionHtml() { return $this->descriptionHtml_ !== null; }
  public function getDescriptionHtml() { if($this->descriptionHtml_ === null) return ""; else return $this->descriptionHtml_; }
  public function setDescriptionHtml($value) { $this->descriptionHtml_ = $value; }

  // optional string relatedBrowseUrl = 11;

  private $relatedBrowseUrl_ = null;
  public function clearRelatedBrowseUrl() { $this->relatedBrowseUrl_ = null; }
  public function hasRelatedBrowseUrl() { return $this->relatedBrowseUrl_ !== null; }
  public function getRelatedBrowseUrl() { if($this->relatedBrowseUrl_ === null) return ""; else return $this->relatedBrowseUrl_; }
  public function setRelatedBrowseUrl($value) { $this->relatedBrowseUrl_ = $value; }

  // optional string moreByBrowseUrl = 12;

  private $moreByBrowseUrl_ = null;
  public function clearMoreByBrowseUrl() { $this->moreByBrowseUrl_ = null; }
  public function hasMoreByBrowseUrl() { return $this->moreByBrowseUrl_ !== null; }
  public function getMoreByBrowseUrl() { if($this->moreByBrowseUrl_ === null) return ""; else return $this->moreByBrowseUrl_; }
  public function setMoreByBrowseUrl($value) { $this->moreByBrowseUrl_ = $value; }

  // optional string relatedHeader = 13;

  private $relatedHeader_ = null;
  public function clearRelatedHeader() { $this->relatedHeader_ = null; }
  public function hasRelatedHeader() { return $this->relatedHeader_ !== null; }
  public function getRelatedHeader() { if($this->relatedHeader_ === null) return ""; else return $this->relatedHeader_; }
  public function setRelatedHeader($value) { $this->relatedHeader_ = $value; }

  // optional string moreByHeader = 14;

  private $moreByHeader_ = null;
  public function clearMoreByHeader() { $this->moreByHeader_ = null; }
  public function hasMoreByHeader() { return $this->moreByHeader_ !== null; }
  public function getMoreByHeader() { if($this->moreByHeader_ === null) return ""; else return $this->moreByHeader_; }
  public function setMoreByHeader($value) { $this->moreByHeader_ = $value; }

  // optional string title = 15;

  private $title_ = null;
  public function clearTitle() { $this->title_ = null; }
  public function hasTitle() { return $this->title_ !== null; }
  public function getTitle() { if($this->title_ === null) return ""; else return $this->title_; }
  public function setTitle($value) { $this->title_ = $value; }

  // @@protoc_insertion_point(class_scope:DocV1)
}

// message ContainerMetadata
class ContainerMetadata {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("ContainerMetadata: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->browseUrl_ = $tmp;
          $limit-=$len;
          break;
        case 2:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->nextPageUrl_ = $tmp;
          $limit-=$len;
          break;
        case 3:
          ASSERT('$wire == 1');
          $tmp = Protobuf::read_double($fp);
          if ($tmp === false)
            throw new Exception('Protobuf::read_double returned false');
          $this->relevance_ = $tmp;
          $limit-=8;
          break;
        case 4:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->estimatedResults_ = $tmp;

          break;
        case 5:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->analyticsCookie_ = $tmp;
          $limit-=$len;
          break;
        case 6:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->ordered_ = $tmp > 0 ? true : false;
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->browseUrl_)) {
      fwrite($fp, "\x0a");
      Protobuf::write_varint($fp, strlen($this->browseUrl_));
      fwrite($fp, $this->browseUrl_);
    }
    if (!is_null($this->nextPageUrl_)) {
      fwrite($fp, "\x12");
      Protobuf::write_varint($fp, strlen($this->nextPageUrl_));
      fwrite($fp, $this->nextPageUrl_);
    }
    if (!is_null($this->relevance_)) {
      fwrite($fp, "\x19");
      Protobuf::write_double($fp, $this->relevance_);
    }
    if (!is_null($this->estimatedResults_)) {
      fwrite($fp, " ");
      Protobuf::write_varint($fp, $this->estimatedResults_);
    }
    if (!is_null($this->analyticsCookie_)) {
      fwrite($fp, "*");
      Protobuf::write_varint($fp, strlen($this->analyticsCookie_));
      fwrite($fp, $this->analyticsCookie_);
    }
    if (!is_null($this->ordered_)) {
      fwrite($fp, "0");
      Protobuf::write_varint($fp, $this->ordered_ ? 1 : 0);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->browseUrl_)) {
      $l = strlen($this->browseUrl_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->nextPageUrl_)) {
      $l = strlen($this->nextPageUrl_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->relevance_)) {
      $size += 9;
    }
    if (!is_null($this->estimatedResults_)) {
      $size += 1 + Protobuf::size_varint($this->estimatedResults_);
    }
    if (!is_null($this->analyticsCookie_)) {
      $l = strlen($this->analyticsCookie_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->ordered_)) {
      $size += 2;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('browseUrl_', $this->browseUrl_)
         . Protobuf::toString('nextPageUrl_', $this->nextPageUrl_)
         . Protobuf::toString('relevance_', $this->relevance_)
         . Protobuf::toString('estimatedResults_', $this->estimatedResults_)
         . Protobuf::toString('analyticsCookie_', $this->analyticsCookie_)
         . Protobuf::toString('ordered_', $this->ordered_);
  }

  // optional string browseUrl = 1;

  private $browseUrl_ = null;
  public function clearBrowseUrl() { $this->browseUrl_ = null; }
  public function hasBrowseUrl() { return $this->browseUrl_ !== null; }
  public function getBrowseUrl() { if($this->browseUrl_ === null) return ""; else return $this->browseUrl_; }
  public function setBrowseUrl($value) { $this->browseUrl_ = $value; }

  // optional string nextPageUrl = 2;

  private $nextPageUrl_ = null;
  public function clearNextPageUrl() { $this->nextPageUrl_ = null; }
  public function hasNextPageUrl() { return $this->nextPageUrl_ !== null; }
  public function getNextPageUrl() { if($this->nextPageUrl_ === null) return ""; else return $this->nextPageUrl_; }
  public function setNextPageUrl($value) { $this->nextPageUrl_ = $value; }

  // optional double relevance = 3;

  private $relevance_ = null;
  public function clearRelevance() { $this->relevance_ = null; }
  public function hasRelevance() { return $this->relevance_ !== null; }
  public function getRelevance() { if($this->relevance_ === null) return 0; else return $this->relevance_; }
  public function setRelevance($value) { $this->relevance_ = $value; }

  // optional int64 estimatedResults = 4;

  private $estimatedResults_ = null;
  public function clearEstimatedResults() { $this->estimatedResults_ = null; }
  public function hasEstimatedResults() { return $this->estimatedResults_ !== null; }
  public function getEstimatedResults() { if($this->estimatedResults_ === null) return 0; else return $this->estimatedResults_; }
  public function setEstimatedResults($value) { $this->estimatedResults_ = $value; }

  // optional string analyticsCookie = 5;

  private $analyticsCookie_ = null;
  public function clearAnalyticsCookie() { $this->analyticsCookie_ = null; }
  public function hasAnalyticsCookie() { return $this->analyticsCookie_ !== null; }
  public function getAnalyticsCookie() { if($this->analyticsCookie_ === null) return ""; else return $this->analyticsCookie_; }
  public function setAnalyticsCookie($value) { $this->analyticsCookie_ = $value; }

  // optional bool ordered = 6;

  private $ordered_ = null;
  public function clearOrdered() { $this->ordered_ = null; }
  public function hasOrdered() { return $this->ordered_ !== null; }
  public function getOrdered() { if($this->ordered_ === null) return false; else return $this->ordered_; }
  public function setOrdered($value) { $this->ordered_ = $value; }

  // @@protoc_insertion_point(class_scope:ContainerMetadata)
}

// message DocV2
class DocV2 {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("DocV2: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->docid_ = $tmp;
          $limit-=$len;
          break;
        case 2:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->backendDocid_ = $tmp;
          $limit-=$len;
          break;
        case 3:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->docType_ = $tmp;

          break;
        case 4:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->backendId_ = $tmp;

          break;
        case 5:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->title_ = $tmp;
          $limit-=$len;
          break;
        case 6:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->creator_ = $tmp;
          $limit-=$len;
          break;
        case 7:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->descriptionHtml_ = $tmp;
          $limit-=$len;
          break;
        case 10:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->image_[] = new Image($fp, $len);
          ASSERT('$len == 0');
          break;
        case 11:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->child_[] = new DocV2($fp, $len);
          ASSERT('$len == 0');
          break;
        case 12:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->containerMetadata_ = new ContainerMetadata($fp, $len);
          ASSERT('$len == 0');
          break;
        case 13:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->details_ = new DocumentDetails($fp, $len);
          ASSERT('$len == 0');
          break;
        case 16:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->detailsUrl_ = $tmp;
          $limit-=$len;
          break;
        case 17:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->shareUrl_ = $tmp;
          $limit-=$len;
          break;
        case 18:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->reviewsUrl_ = $tmp;
          $limit-=$len;
          break;
        case 19:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->backendUrl_ = $tmp;
          $limit-=$len;
          break;
        case 20:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->purchaseDetailsUrl_ = $tmp;
          $limit-=$len;
          break;
        case 21:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->detailsReusable_ = $tmp > 0 ? true : false;
          break;
        case 22:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->subtitle_ = $tmp;
          $limit-=$len;
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->docid_)) {
      fwrite($fp, "\x0a");
      Protobuf::write_varint($fp, strlen($this->docid_));
      fwrite($fp, $this->docid_);
    }
    if (!is_null($this->backendDocid_)) {
      fwrite($fp, "\x12");
      Protobuf::write_varint($fp, strlen($this->backendDocid_));
      fwrite($fp, $this->backendDocid_);
    }
    if (!is_null($this->docType_)) {
      fwrite($fp, "\x18");
      Protobuf::write_varint($fp, $this->docType_);
    }
    if (!is_null($this->backendId_)) {
      fwrite($fp, " ");
      Protobuf::write_varint($fp, $this->backendId_);
    }
    if (!is_null($this->title_)) {
      fwrite($fp, "*");
      Protobuf::write_varint($fp, strlen($this->title_));
      fwrite($fp, $this->title_);
    }
    if (!is_null($this->creator_)) {
      fwrite($fp, "2");
      Protobuf::write_varint($fp, strlen($this->creator_));
      fwrite($fp, $this->creator_);
    }
    if (!is_null($this->descriptionHtml_)) {
      fwrite($fp, ":");
      Protobuf::write_varint($fp, strlen($this->descriptionHtml_));
      fwrite($fp, $this->descriptionHtml_);
    }
    if (!is_null($this->image_))
      foreach($this->image_ as $v) {
        fwrite($fp, "R");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
    if (!is_null($this->child_))
      foreach($this->child_ as $v) {
        fwrite($fp, "Z");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
    if (!is_null($this->containerMetadata_)) {
      fwrite($fp, "b");
      Protobuf::write_varint($fp, $this->containerMetadata_->size()); // message
      $this->containerMetadata_->write($fp);
    }
    if (!is_null($this->details_)) {
      fwrite($fp, "j");
      Protobuf::write_varint($fp, $this->details_->size()); // message
      $this->details_->write($fp);
    }
    if (!is_null($this->detailsUrl_)) {
      fwrite($fp, "\x82\x01");
      Protobuf::write_varint($fp, strlen($this->detailsUrl_));
      fwrite($fp, $this->detailsUrl_);
    }
    if (!is_null($this->shareUrl_)) {
      fwrite($fp, "\x8a\x01");
      Protobuf::write_varint($fp, strlen($this->shareUrl_));
      fwrite($fp, $this->shareUrl_);
    }
    if (!is_null($this->reviewsUrl_)) {
      fwrite($fp, "\x92\x01");
      Protobuf::write_varint($fp, strlen($this->reviewsUrl_));
      fwrite($fp, $this->reviewsUrl_);
    }
    if (!is_null($this->backendUrl_)) {
      fwrite($fp, "\x9a\x01");
      Protobuf::write_varint($fp, strlen($this->backendUrl_));
      fwrite($fp, $this->backendUrl_);
    }
    if (!is_null($this->purchaseDetailsUrl_)) {
      fwrite($fp, "\xa2\x01");
      Protobuf::write_varint($fp, strlen($this->purchaseDetailsUrl_));
      fwrite($fp, $this->purchaseDetailsUrl_);
    }
    if (!is_null($this->detailsReusable_)) {
      fwrite($fp, "\xa8\x01");
      Protobuf::write_varint($fp, $this->detailsReusable_ ? 1 : 0);
    }
    if (!is_null($this->subtitle_)) {
      fwrite($fp, "\xb2\x01");
      Protobuf::write_varint($fp, strlen($this->subtitle_));
      fwrite($fp, $this->subtitle_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->docid_)) {
      $l = strlen($this->docid_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->backendDocid_)) {
      $l = strlen($this->backendDocid_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->docType_)) {
      $size += 1 + Protobuf::size_varint($this->docType_);
    }
    if (!is_null($this->backendId_)) {
      $size += 1 + Protobuf::size_varint($this->backendId_);
    }
    if (!is_null($this->title_)) {
      $l = strlen($this->title_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->creator_)) {
      $l = strlen($this->creator_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->descriptionHtml_)) {
      $l = strlen($this->descriptionHtml_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->image_))
      foreach($this->image_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->child_))
      foreach($this->child_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->containerMetadata_)) {
      $l = $this->containerMetadata_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->details_)) {
      $l = $this->details_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->detailsUrl_)) {
      $l = strlen($this->detailsUrl_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->shareUrl_)) {
      $l = strlen($this->shareUrl_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->reviewsUrl_)) {
      $l = strlen($this->reviewsUrl_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->backendUrl_)) {
      $l = strlen($this->backendUrl_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->purchaseDetailsUrl_)) {
      $l = strlen($this->purchaseDetailsUrl_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->detailsReusable_)) {
      $size += 3;
    }
    if (!is_null($this->subtitle_)) {
      $l = strlen($this->subtitle_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('docid_', $this->docid_)
         . Protobuf::toString('backendDocid_', $this->backendDocid_)
         . Protobuf::toString('docType_', $this->docType_)
         . Protobuf::toString('backendId_', $this->backendId_)
         . Protobuf::toString('title_', $this->title_)
         . Protobuf::toString('creator_', $this->creator_)
         . Protobuf::toString('descriptionHtml_', $this->descriptionHtml_)
         . Protobuf::toString('image_', $this->image_)
         . Protobuf::toString('child_', $this->child_)
         . Protobuf::toString('containerMetadata_', $this->containerMetadata_)
         . Protobuf::toString('details_', $this->details_)
         . Protobuf::toString('detailsUrl_', $this->detailsUrl_)
         . Protobuf::toString('shareUrl_', $this->shareUrl_)
         . Protobuf::toString('reviewsUrl_', $this->reviewsUrl_)
         . Protobuf::toString('backendUrl_', $this->backendUrl_)
         . Protobuf::toString('purchaseDetailsUrl_', $this->purchaseDetailsUrl_)
         . Protobuf::toString('detailsReusable_', $this->detailsReusable_)
         . Protobuf::toString('subtitle_', $this->subtitle_);
  }

  // optional string docid = 1;

  private $docid_ = null;
  public function clearDocid() { $this->docid_ = null; }
  public function hasDocid() { return $this->docid_ !== null; }
  public function getDocid() { if($this->docid_ === null) return ""; else return $this->docid_; }
  public function setDocid($value) { $this->docid_ = $value; }

  // optional string backendDocid = 2;

  private $backendDocid_ = null;
  public function clearBackendDocid() { $this->backendDocid_ = null; }
  public function hasBackendDocid() { return $this->backendDocid_ !== null; }
  public function getBackendDocid() { if($this->backendDocid_ === null) return ""; else return $this->backendDocid_; }
  public function setBackendDocid($value) { $this->backendDocid_ = $value; }

  // optional int32 docType = 3;

  private $docType_ = null;
  public function clearDocType() { $this->docType_ = null; }
  public function hasDocType() { return $this->docType_ !== null; }
  public function getDocType() { if($this->docType_ === null) return 0; else return $this->docType_; }
  public function setDocType($value) { $this->docType_ = $value; }

  // optional int32 backendId = 4;

  private $backendId_ = null;
  public function clearBackendId() { $this->backendId_ = null; }
  public function hasBackendId() { return $this->backendId_ !== null; }
  public function getBackendId() { if($this->backendId_ === null) return 0; else return $this->backendId_; }
  public function setBackendId($value) { $this->backendId_ = $value; }

  // optional string title = 5;

  private $title_ = null;
  public function clearTitle() { $this->title_ = null; }
  public function hasTitle() { return $this->title_ !== null; }
  public function getTitle() { if($this->title_ === null) return ""; else return $this->title_; }
  public function setTitle($value) { $this->title_ = $value; }

  // optional string creator = 6;

  private $creator_ = null;
  public function clearCreator() { $this->creator_ = null; }
  public function hasCreator() { return $this->creator_ !== null; }
  public function getCreator() { if($this->creator_ === null) return ""; else return $this->creator_; }
  public function setCreator($value) { $this->creator_ = $value; }

  // optional string descriptionHtml = 7;

  private $descriptionHtml_ = null;
  public function clearDescriptionHtml() { $this->descriptionHtml_ = null; }
  public function hasDescriptionHtml() { return $this->descriptionHtml_ !== null; }
  public function getDescriptionHtml() { if($this->descriptionHtml_ === null) return ""; else return $this->descriptionHtml_; }
  public function setDescriptionHtml($value) { $this->descriptionHtml_ = $value; }

  // repeated .Image image = 10;

  private $image_ = null;
  public function clearImage() { $this->image_ = null; }
  public function getImageCount() { if ($this->image_ === null ) return 0; else return count($this->image_); }
  public function getImage($index) { return $this->image_[$index]; }
  public function getImageArray() { if ($this->image_ === null ) return array(); else return $this->image_; }
  public function setImage($index, $value) {$this->image_[$index] = $value;	}
  public function addImage($value) { $this->image_[] = $value; }
  public function addAllImage(array $values) { foreach($values as $value) {$this->image_[] = $value;} }

  // repeated .DocV2 child = 11;

  private $child_ = null;
  public function clearChild() { $this->child_ = null; }
  public function getChildCount() { if ($this->child_ === null ) return 0; else return count($this->child_); }
  public function getChild($index) { return $this->child_[$index]; }
  public function getChildArray() { if ($this->child_ === null ) return array(); else return $this->child_; }
  public function setChild($index, $value) {$this->child_[$index] = $value;	}
  public function addChild($value) { $this->child_[] = $value; }
  public function addAllChild(array $values) { foreach($values as $value) {$this->child_[] = $value;} }

  // optional .ContainerMetadata containerMetadata = 12;

  private $containerMetadata_ = null;
  public function clearContainerMetadata() { $this->containerMetadata_ = null; }
  public function hasContainerMetadata() { return $this->containerMetadata_ !== null; }
  public function getContainerMetadata() { if($this->containerMetadata_ === null) return null; else return $this->containerMetadata_; }
  public function setContainerMetadata(ContainerMetadata $value) { $this->containerMetadata_ = $value; }

  // optional .DocumentDetails details = 13;

  private $details_ = null;
  public function clearDetails() { $this->details_ = null; }
  public function hasDetails() { return $this->details_ !== null; }
  public function getDetails() { if($this->details_ === null) return null; else return $this->details_; }
  public function setDetails(DocumentDetails $value) { $this->details_ = $value; }

  // optional string detailsUrl = 16;

  private $detailsUrl_ = null;
  public function clearDetailsUrl() { $this->detailsUrl_ = null; }
  public function hasDetailsUrl() { return $this->detailsUrl_ !== null; }
  public function getDetailsUrl() { if($this->detailsUrl_ === null) return ""; else return $this->detailsUrl_; }
  public function setDetailsUrl($value) { $this->detailsUrl_ = $value; }

  // optional string shareUrl = 17;

  private $shareUrl_ = null;
  public function clearShareUrl() { $this->shareUrl_ = null; }
  public function hasShareUrl() { return $this->shareUrl_ !== null; }
  public function getShareUrl() { if($this->shareUrl_ === null) return ""; else return $this->shareUrl_; }
  public function setShareUrl($value) { $this->shareUrl_ = $value; }

  // optional string reviewsUrl = 18;

  private $reviewsUrl_ = null;
  public function clearReviewsUrl() { $this->reviewsUrl_ = null; }
  public function hasReviewsUrl() { return $this->reviewsUrl_ !== null; }
  public function getReviewsUrl() { if($this->reviewsUrl_ === null) return ""; else return $this->reviewsUrl_; }
  public function setReviewsUrl($value) { $this->reviewsUrl_ = $value; }

  // optional string backendUrl = 19;

  private $backendUrl_ = null;
  public function clearBackendUrl() { $this->backendUrl_ = null; }
  public function hasBackendUrl() { return $this->backendUrl_ !== null; }
  public function getBackendUrl() { if($this->backendUrl_ === null) return ""; else return $this->backendUrl_; }
  public function setBackendUrl($value) { $this->backendUrl_ = $value; }

  // optional string purchaseDetailsUrl = 20;

  private $purchaseDetailsUrl_ = null;
  public function clearPurchaseDetailsUrl() { $this->purchaseDetailsUrl_ = null; }
  public function hasPurchaseDetailsUrl() { return $this->purchaseDetailsUrl_ !== null; }
  public function getPurchaseDetailsUrl() { if($this->purchaseDetailsUrl_ === null) return ""; else return $this->purchaseDetailsUrl_; }
  public function setPurchaseDetailsUrl($value) { $this->purchaseDetailsUrl_ = $value; }

  // optional bool detailsReusable = 21;

  private $detailsReusable_ = null;
  public function clearDetailsReusable() { $this->detailsReusable_ = null; }
  public function hasDetailsReusable() { return $this->detailsReusable_ !== null; }
  public function getDetailsReusable() { if($this->detailsReusable_ === null) return false; else return $this->detailsReusable_; }
  public function setDetailsReusable($value) { $this->detailsReusable_ = $value; }

  // optional string subtitle = 22;

  private $subtitle_ = null;
  public function clearSubtitle() { $this->subtitle_ = null; }
  public function hasSubtitle() { return $this->subtitle_ !== null; }
  public function getSubtitle() { if($this->subtitle_ === null) return ""; else return $this->subtitle_; }
  public function setSubtitle($value) { $this->subtitle_ = $value; }

  // @@protoc_insertion_point(class_scope:DocV2)
}

// message RelatedSearch
class RelatedSearch {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("RelatedSearch: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->searchUrl_ = $tmp;
          $limit-=$len;
          break;
        case 2:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->header_ = $tmp;
          $limit-=$len;
          break;
        case 3:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->backendId_ = $tmp;

          break;
        case 4:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->docType_ = $tmp;

          break;
        case 5:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->current_ = $tmp > 0 ? true : false;
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->searchUrl_)) {
      fwrite($fp, "\x0a");
      Protobuf::write_varint($fp, strlen($this->searchUrl_));
      fwrite($fp, $this->searchUrl_);
    }
    if (!is_null($this->header_)) {
      fwrite($fp, "\x12");
      Protobuf::write_varint($fp, strlen($this->header_));
      fwrite($fp, $this->header_);
    }
    if (!is_null($this->backendId_)) {
      fwrite($fp, "\x18");
      Protobuf::write_varint($fp, $this->backendId_);
    }
    if (!is_null($this->docType_)) {
      fwrite($fp, " ");
      Protobuf::write_varint($fp, $this->docType_);
    }
    if (!is_null($this->current_)) {
      fwrite($fp, "(");
      Protobuf::write_varint($fp, $this->current_ ? 1 : 0);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->searchUrl_)) {
      $l = strlen($this->searchUrl_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->header_)) {
      $l = strlen($this->header_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->backendId_)) {
      $size += 1 + Protobuf::size_varint($this->backendId_);
    }
    if (!is_null($this->docType_)) {
      $size += 1 + Protobuf::size_varint($this->docType_);
    }
    if (!is_null($this->current_)) {
      $size += 2;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('searchUrl_', $this->searchUrl_)
         . Protobuf::toString('header_', $this->header_)
         . Protobuf::toString('backendId_', $this->backendId_)
         . Protobuf::toString('docType_', $this->docType_)
         . Protobuf::toString('current_', $this->current_);
  }

  // optional string searchUrl = 1;

  private $searchUrl_ = null;
  public function clearSearchUrl() { $this->searchUrl_ = null; }
  public function hasSearchUrl() { return $this->searchUrl_ !== null; }
  public function getSearchUrl() { if($this->searchUrl_ === null) return ""; else return $this->searchUrl_; }
  public function setSearchUrl($value) { $this->searchUrl_ = $value; }

  // optional string header = 2;

  private $header_ = null;
  public function clearHeader() { $this->header_ = null; }
  public function hasHeader() { return $this->header_ !== null; }
  public function getHeader() { if($this->header_ === null) return ""; else return $this->header_; }
  public function setHeader($value) { $this->header_ = $value; }

  // optional int32 backendId = 3;

  private $backendId_ = null;
  public function clearBackendId() { $this->backendId_ = null; }
  public function hasBackendId() { return $this->backendId_ !== null; }
  public function getBackendId() { if($this->backendId_ === null) return 0; else return $this->backendId_; }
  public function setBackendId($value) { $this->backendId_ = $value; }

  // optional int32 docType = 4;

  private $docType_ = null;
  public function clearDocType() { $this->docType_ = null; }
  public function hasDocType() { return $this->docType_ !== null; }
  public function getDocType() { if($this->docType_ === null) return 0; else return $this->docType_; }
  public function setDocType($value) { $this->docType_ = $value; }

  // optional bool current = 5;

  private $current_ = null;
  public function clearCurrent() { $this->current_ = null; }
  public function hasCurrent() { return $this->current_ !== null; }
  public function getCurrent() { if($this->current_ === null) return false; else return $this->current_; }
  public function setCurrent($value) { $this->current_ = $value; }

  // @@protoc_insertion_point(class_scope:RelatedSearch)
}

// message SearchResponse
class SearchResponse {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("SearchResponse: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->originalQuery_ = $tmp;
          $limit-=$len;
          break;
        case 2:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->suggestedQuery_ = $tmp;
          $limit-=$len;
          break;
        case 3:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->aggregateQuery_ = $tmp > 0 ? true : false;
          break;
        case 4:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->bucket_[] = new Bucket($fp, $len);
          ASSERT('$len == 0');
          break;
        case 5:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->doc_[] = new DocV2($fp, $len);
          ASSERT('$len == 0');
          break;
        case 6:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->relatedSearch_[] = new RelatedSearch($fp, $len);
          ASSERT('$len == 0');
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->originalQuery_)) {
      fwrite($fp, "\x0a");
      Protobuf::write_varint($fp, strlen($this->originalQuery_));
      fwrite($fp, $this->originalQuery_);
    }
    if (!is_null($this->suggestedQuery_)) {
      fwrite($fp, "\x12");
      Protobuf::write_varint($fp, strlen($this->suggestedQuery_));
      fwrite($fp, $this->suggestedQuery_);
    }
    if (!is_null($this->aggregateQuery_)) {
      fwrite($fp, "\x18");
      Protobuf::write_varint($fp, $this->aggregateQuery_ ? 1 : 0);
    }
    if (!is_null($this->bucket_))
      foreach($this->bucket_ as $v) {
        fwrite($fp, "\"");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
    if (!is_null($this->doc_))
      foreach($this->doc_ as $v) {
        fwrite($fp, "*");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
    if (!is_null($this->relatedSearch_))
      foreach($this->relatedSearch_ as $v) {
        fwrite($fp, "2");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->originalQuery_)) {
      $l = strlen($this->originalQuery_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->suggestedQuery_)) {
      $l = strlen($this->suggestedQuery_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->aggregateQuery_)) {
      $size += 2;
    }
    if (!is_null($this->bucket_))
      foreach($this->bucket_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->doc_))
      foreach($this->doc_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->relatedSearch_))
      foreach($this->relatedSearch_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('originalQuery_', $this->originalQuery_)
         . Protobuf::toString('suggestedQuery_', $this->suggestedQuery_)
         . Protobuf::toString('aggregateQuery_', $this->aggregateQuery_)
         . Protobuf::toString('bucket_', $this->bucket_)
         . Protobuf::toString('doc_', $this->doc_)
         . Protobuf::toString('relatedSearch_', $this->relatedSearch_);
  }

  // optional string originalQuery = 1;

  private $originalQuery_ = null;
  public function clearOriginalQuery() { $this->originalQuery_ = null; }
  public function hasOriginalQuery() { return $this->originalQuery_ !== null; }
  public function getOriginalQuery() { if($this->originalQuery_ === null) return ""; else return $this->originalQuery_; }
  public function setOriginalQuery($value) { $this->originalQuery_ = $value; }

  // optional string suggestedQuery = 2;

  private $suggestedQuery_ = null;
  public function clearSuggestedQuery() { $this->suggestedQuery_ = null; }
  public function hasSuggestedQuery() { return $this->suggestedQuery_ !== null; }
  public function getSuggestedQuery() { if($this->suggestedQuery_ === null) return ""; else return $this->suggestedQuery_; }
  public function setSuggestedQuery($value) { $this->suggestedQuery_ = $value; }

  // optional bool aggregateQuery = 3;

  private $aggregateQuery_ = null;
  public function clearAggregateQuery() { $this->aggregateQuery_ = null; }
  public function hasAggregateQuery() { return $this->aggregateQuery_ !== null; }
  public function getAggregateQuery() { if($this->aggregateQuery_ === null) return false; else return $this->aggregateQuery_; }
  public function setAggregateQuery($value) { $this->aggregateQuery_ = $value; }

  // repeated .Bucket bucket = 4;

  private $bucket_ = null;
  public function clearBucket() { $this->bucket_ = null; }
  public function getBucketCount() { if ($this->bucket_ === null ) return 0; else return count($this->bucket_); }
  public function getBucket($index) { return $this->bucket_[$index]; }
  public function getBucketArray() { if ($this->bucket_ === null ) return array(); else return $this->bucket_; }
  public function setBucket($index, $value) {$this->bucket_[$index] = $value;	}
  public function addBucket($value) { $this->bucket_[] = $value; }
  public function addAllBucket(array $values) { foreach($values as $value) {$this->bucket_[] = $value;} }

  // repeated .DocV2 doc = 5;

  private $doc_ = null;
  public function clearDoc() { $this->doc_ = null; }
  public function getDocCount() { if ($this->doc_ === null ) return 0; else return count($this->doc_); }
  public function getDoc($index) { return $this->doc_[$index]; }
  public function getDocArray() { if ($this->doc_ === null ) return array(); else return $this->doc_; }
  public function setDoc($index, $value) {$this->doc_[$index] = $value;	}
  public function addDoc($value) { $this->doc_[] = $value; }
  public function addAllDoc(array $values) { foreach($values as $value) {$this->doc_[] = $value;} }

  // repeated .RelatedSearch relatedSearch = 6;

  private $relatedSearch_ = null;
  public function clearRelatedSearch() { $this->relatedSearch_ = null; }
  public function getRelatedSearchCount() { if ($this->relatedSearch_ === null ) return 0; else return count($this->relatedSearch_); }
  public function getRelatedSearch($index) { return $this->relatedSearch_[$index]; }
  public function getRelatedSearchArray() { if ($this->relatedSearch_ === null ) return array(); else return $this->relatedSearch_; }
  public function setRelatedSearch($index, $value) {$this->relatedSearch_[$index] = $value;	}
  public function addRelatedSearch($value) { $this->relatedSearch_[] = $value; }
  public function addAllRelatedSearch(array $values) { foreach($values as $value) {$this->relatedSearch_[] = $value;} }

  // @@protoc_insertion_point(class_scope:SearchResponse)
}

// message AssetsRequest
class AssetsRequest {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("AssetsRequest: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->assetType_ = $tmp;

          break;
        case 2:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->query_ = $tmp;
          $limit-=$len;
          break;
        case 3:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->categoryId_ = $tmp;
          $limit-=$len;
          break;
        case 4:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->assetId_[] = $tmp;
          $limit-=$len;
          break;
        case 5:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->retrieveVendingHistory_ = $tmp > 0 ? true : false;
          break;
        case 6:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->retrieveExtendedInfo_ = $tmp > 0 ? true : false;
          break;
        case 7:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->sortOrder_ = $tmp;

          break;
        case 8:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->startIndex_ = $tmp;

          break;
        case 9:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->numEntries_ = $tmp;

          break;
        case 10:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->viewFilter_ = $tmp;

          break;
        case 11:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->rankingType_ = $tmp;
          $limit-=$len;
          break;
        case 12:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->retrieveCarrierChannel_ = $tmp > 0 ? true : false;
          break;
        case 13:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->pendingDownloadAssetId_[] = $tmp;
          $limit-=$len;
          break;
        case 14:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->reconstructVendingHistory_ = $tmp > 0 ? true : false;
          break;
        case 15:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->unfilteredResults_ = $tmp > 0 ? true : false;
          break;
        case 16:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->badgeId_[] = $tmp;
          $limit-=$len;
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->assetType_)) {
      fwrite($fp, "\x08");
      Protobuf::write_varint($fp, $this->assetType_);
    }
    if (!is_null($this->query_)) {
      fwrite($fp, "\x12");
      Protobuf::write_varint($fp, strlen($this->query_));
      fwrite($fp, $this->query_);
    }
    if (!is_null($this->categoryId_)) {
      fwrite($fp, "\x1a");
      Protobuf::write_varint($fp, strlen($this->categoryId_));
      fwrite($fp, $this->categoryId_);
    }
    if (!is_null($this->assetId_))
      foreach($this->assetId_ as $v) {
        fwrite($fp, "\"");
        Protobuf::write_varint($fp, strlen($v));
        fwrite($fp, $v);
      }
    if (!is_null($this->retrieveVendingHistory_)) {
      fwrite($fp, "(");
      Protobuf::write_varint($fp, $this->retrieveVendingHistory_ ? 1 : 0);
    }
    if (!is_null($this->retrieveExtendedInfo_)) {
      fwrite($fp, "0");
      Protobuf::write_varint($fp, $this->retrieveExtendedInfo_ ? 1 : 0);
    }
    if (!is_null($this->sortOrder_)) {
      fwrite($fp, "8");
      Protobuf::write_varint($fp, $this->sortOrder_);
    }
    if (!is_null($this->startIndex_)) {
      fwrite($fp, "@");
      Protobuf::write_varint($fp, $this->startIndex_);
    }
    if (!is_null($this->numEntries_)) {
      fwrite($fp, "H");
      Protobuf::write_varint($fp, $this->numEntries_);
    }
    if (!is_null($this->viewFilter_)) {
      fwrite($fp, "P");
      Protobuf::write_varint($fp, $this->viewFilter_);
    }
    if (!is_null($this->rankingType_)) {
      fwrite($fp, "Z");
      Protobuf::write_varint($fp, strlen($this->rankingType_));
      fwrite($fp, $this->rankingType_);
    }
    if (!is_null($this->retrieveCarrierChannel_)) {
      fwrite($fp, "`");
      Protobuf::write_varint($fp, $this->retrieveCarrierChannel_ ? 1 : 0);
    }
    if (!is_null($this->pendingDownloadAssetId_))
      foreach($this->pendingDownloadAssetId_ as $v) {
        fwrite($fp, "j");
        Protobuf::write_varint($fp, strlen($v));
        fwrite($fp, $v);
      }
    if (!is_null($this->reconstructVendingHistory_)) {
      fwrite($fp, "p");
      Protobuf::write_varint($fp, $this->reconstructVendingHistory_ ? 1 : 0);
    }
    if (!is_null($this->unfilteredResults_)) {
      fwrite($fp, "x");
      Protobuf::write_varint($fp, $this->unfilteredResults_ ? 1 : 0);
    }
    if (!is_null($this->badgeId_))
      foreach($this->badgeId_ as $v) {
        fwrite($fp, "\x82\x01");
        Protobuf::write_varint($fp, strlen($v));
        fwrite($fp, $v);
      }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->assetType_)) {
      $size += 1 + Protobuf::size_varint($this->assetType_);
    }
    if (!is_null($this->query_)) {
      $l = strlen($this->query_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->categoryId_)) {
      $l = strlen($this->categoryId_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->assetId_))
      foreach($this->assetId_ as $v) {
        $l = strlen($v);
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->retrieveVendingHistory_)) {
      $size += 2;
    }
    if (!is_null($this->retrieveExtendedInfo_)) {
      $size += 2;
    }
    if (!is_null($this->sortOrder_)) {
      $size += 1 + Protobuf::size_varint($this->sortOrder_);
    }
    if (!is_null($this->startIndex_)) {
      $size += 1 + Protobuf::size_varint($this->startIndex_);
    }
    if (!is_null($this->numEntries_)) {
      $size += 1 + Protobuf::size_varint($this->numEntries_);
    }
    if (!is_null($this->viewFilter_)) {
      $size += 1 + Protobuf::size_varint($this->viewFilter_);
    }
    if (!is_null($this->rankingType_)) {
      $l = strlen($this->rankingType_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->retrieveCarrierChannel_)) {
      $size += 2;
    }
    if (!is_null($this->pendingDownloadAssetId_))
      foreach($this->pendingDownloadAssetId_ as $v) {
        $l = strlen($v);
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->reconstructVendingHistory_)) {
      $size += 2;
    }
    if (!is_null($this->unfilteredResults_)) {
      $size += 2;
    }
    if (!is_null($this->badgeId_))
      foreach($this->badgeId_ as $v) {
        $l = strlen($v);
        $size += 2 + Protobuf::size_varint($l) + $l;
      }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('assetType_', $this->assetType_)
         . Protobuf::toString('query_', $this->query_)
         . Protobuf::toString('categoryId_', $this->categoryId_)
         . Protobuf::toString('assetId_', $this->assetId_)
         . Protobuf::toString('retrieveVendingHistory_', $this->retrieveVendingHistory_)
         . Protobuf::toString('retrieveExtendedInfo_', $this->retrieveExtendedInfo_)
         . Protobuf::toString('sortOrder_', $this->sortOrder_)
         . Protobuf::toString('startIndex_', $this->startIndex_)
         . Protobuf::toString('numEntries_', $this->numEntries_)
         . Protobuf::toString('viewFilter_', $this->viewFilter_)
         . Protobuf::toString('rankingType_', $this->rankingType_)
         . Protobuf::toString('retrieveCarrierChannel_', $this->retrieveCarrierChannel_)
         . Protobuf::toString('pendingDownloadAssetId_', $this->pendingDownloadAssetId_)
         . Protobuf::toString('reconstructVendingHistory_', $this->reconstructVendingHistory_)
         . Protobuf::toString('unfilteredResults_', $this->unfilteredResults_)
         . Protobuf::toString('badgeId_', $this->badgeId_);
  }

  // optional int32 assetType = 1;

  private $assetType_ = null;
  public function clearAssetType() { $this->assetType_ = null; }
  public function hasAssetType() { return $this->assetType_ !== null; }
  public function getAssetType() { if($this->assetType_ === null) return 0; else return $this->assetType_; }
  public function setAssetType($value) { $this->assetType_ = $value; }

  // optional string query = 2;

  private $query_ = null;
  public function clearQuery() { $this->query_ = null; }
  public function hasQuery() { return $this->query_ !== null; }
  public function getQuery() { if($this->query_ === null) return ""; else return $this->query_; }
  public function setQuery($value) { $this->query_ = $value; }

  // optional string categoryId = 3;

  private $categoryId_ = null;
  public function clearCategoryId() { $this->categoryId_ = null; }
  public function hasCategoryId() { return $this->categoryId_ !== null; }
  public function getCategoryId() { if($this->categoryId_ === null) return ""; else return $this->categoryId_; }
  public function setCategoryId($value) { $this->categoryId_ = $value; }

  // repeated string assetId = 4;

  private $assetId_ = null;
  public function clearAssetId() { $this->assetId_ = null; }
  public function getAssetIdCount() { if ($this->assetId_ === null ) return 0; else return count($this->assetId_); }
  public function getAssetId($index) { return $this->assetId_[$index]; }
  public function getAssetIdArray() { if ($this->assetId_ === null ) return array(); else return $this->assetId_; }
  public function setAssetId($index, $value) {$this->assetId_[$index] = $value;	}
  public function addAssetId($value) { $this->assetId_[] = $value; }
  public function addAllAssetId(array $values) { foreach($values as $value) {$this->assetId_[] = $value;} }

  // optional bool retrieveVendingHistory = 5;

  private $retrieveVendingHistory_ = null;
  public function clearRetrieveVendingHistory() { $this->retrieveVendingHistory_ = null; }
  public function hasRetrieveVendingHistory() { return $this->retrieveVendingHistory_ !== null; }
  public function getRetrieveVendingHistory() { if($this->retrieveVendingHistory_ === null) return false; else return $this->retrieveVendingHistory_; }
  public function setRetrieveVendingHistory($value) { $this->retrieveVendingHistory_ = $value; }

  // optional bool retrieveExtendedInfo = 6;

  private $retrieveExtendedInfo_ = null;
  public function clearRetrieveExtendedInfo() { $this->retrieveExtendedInfo_ = null; }
  public function hasRetrieveExtendedInfo() { return $this->retrieveExtendedInfo_ !== null; }
  public function getRetrieveExtendedInfo() { if($this->retrieveExtendedInfo_ === null) return false; else return $this->retrieveExtendedInfo_; }
  public function setRetrieveExtendedInfo($value) { $this->retrieveExtendedInfo_ = $value; }

  // optional int32 sortOrder = 7;

  private $sortOrder_ = null;
  public function clearSortOrder() { $this->sortOrder_ = null; }
  public function hasSortOrder() { return $this->sortOrder_ !== null; }
  public function getSortOrder() { if($this->sortOrder_ === null) return 0; else return $this->sortOrder_; }
  public function setSortOrder($value) { $this->sortOrder_ = $value; }

  // optional int64 startIndex = 8;

  private $startIndex_ = null;
  public function clearStartIndex() { $this->startIndex_ = null; }
  public function hasStartIndex() { return $this->startIndex_ !== null; }
  public function getStartIndex() { if($this->startIndex_ === null) return 0; else return $this->startIndex_; }
  public function setStartIndex($value) { $this->startIndex_ = $value; }

  // optional int64 numEntries = 9;

  private $numEntries_ = null;
  public function clearNumEntries() { $this->numEntries_ = null; }
  public function hasNumEntries() { return $this->numEntries_ !== null; }
  public function getNumEntries() { if($this->numEntries_ === null) return 0; else return $this->numEntries_; }
  public function setNumEntries($value) { $this->numEntries_ = $value; }

  // optional int32 viewFilter = 10;

  private $viewFilter_ = null;
  public function clearViewFilter() { $this->viewFilter_ = null; }
  public function hasViewFilter() { return $this->viewFilter_ !== null; }
  public function getViewFilter() { if($this->viewFilter_ === null) return 0; else return $this->viewFilter_; }
  public function setViewFilter($value) { $this->viewFilter_ = $value; }

  // optional string rankingType = 11;

  private $rankingType_ = null;
  public function clearRankingType() { $this->rankingType_ = null; }
  public function hasRankingType() { return $this->rankingType_ !== null; }
  public function getRankingType() { if($this->rankingType_ === null) return ""; else return $this->rankingType_; }
  public function setRankingType($value) { $this->rankingType_ = $value; }

  // optional bool retrieveCarrierChannel = 12;

  private $retrieveCarrierChannel_ = null;
  public function clearRetrieveCarrierChannel() { $this->retrieveCarrierChannel_ = null; }
  public function hasRetrieveCarrierChannel() { return $this->retrieveCarrierChannel_ !== null; }
  public function getRetrieveCarrierChannel() { if($this->retrieveCarrierChannel_ === null) return false; else return $this->retrieveCarrierChannel_; }
  public function setRetrieveCarrierChannel($value) { $this->retrieveCarrierChannel_ = $value; }

  // repeated string pendingDownloadAssetId = 13;

  private $pendingDownloadAssetId_ = null;
  public function clearPendingDownloadAssetId() { $this->pendingDownloadAssetId_ = null; }
  public function getPendingDownloadAssetIdCount() { if ($this->pendingDownloadAssetId_ === null ) return 0; else return count($this->pendingDownloadAssetId_); }
  public function getPendingDownloadAssetId($index) { return $this->pendingDownloadAssetId_[$index]; }
  public function getPendingDownloadAssetIdArray() { if ($this->pendingDownloadAssetId_ === null ) return array(); else return $this->pendingDownloadAssetId_; }
  public function setPendingDownloadAssetId($index, $value) {$this->pendingDownloadAssetId_[$index] = $value;	}
  public function addPendingDownloadAssetId($value) { $this->pendingDownloadAssetId_[] = $value; }
  public function addAllPendingDownloadAssetId(array $values) { foreach($values as $value) {$this->pendingDownloadAssetId_[] = $value;} }

  // optional bool reconstructVendingHistory = 14;

  private $reconstructVendingHistory_ = null;
  public function clearReconstructVendingHistory() { $this->reconstructVendingHistory_ = null; }
  public function hasReconstructVendingHistory() { return $this->reconstructVendingHistory_ !== null; }
  public function getReconstructVendingHistory() { if($this->reconstructVendingHistory_ === null) return false; else return $this->reconstructVendingHistory_; }
  public function setReconstructVendingHistory($value) { $this->reconstructVendingHistory_ = $value; }

  // optional bool unfilteredResults = 15;

  private $unfilteredResults_ = null;
  public function clearUnfilteredResults() { $this->unfilteredResults_ = null; }
  public function hasUnfilteredResults() { return $this->unfilteredResults_ !== null; }
  public function getUnfilteredResults() { if($this->unfilteredResults_ === null) return false; else return $this->unfilteredResults_; }
  public function setUnfilteredResults($value) { $this->unfilteredResults_ = $value; }

  // repeated string badgeId = 16;

  private $badgeId_ = null;
  public function clearBadgeId() { $this->badgeId_ = null; }
  public function getBadgeIdCount() { if ($this->badgeId_ === null ) return 0; else return count($this->badgeId_); }
  public function getBadgeId($index) { return $this->badgeId_[$index]; }
  public function getBadgeIdArray() { if ($this->badgeId_ === null ) return array(); else return $this->badgeId_; }
  public function setBadgeId($index, $value) {$this->badgeId_[$index] = $value;	}
  public function addBadgeId($value) { $this->badgeId_[] = $value; }
  public function addAllBadgeId(array $values) { foreach($values as $value) {$this->badgeId_[] = $value;} }

  // @@protoc_insertion_point(class_scope:AssetsRequest)
}

// message AssetsResponse
class AssetsResponse {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("AssetsResponse: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->asset_[] = new App($fp, $len);
          ASSERT('$len == 0');
          break;
        case 2:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->numTotalEntries_ = $tmp;

          break;
        case 3:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->correctedQuery_ = $tmp;
          $limit-=$len;
          break;
        case 4:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->altAsset_[] = new App($fp, $len);
          ASSERT('$len == 0');
          break;
        case 5:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->numCorrectedEntries_ = $tmp;

          break;
        case 6:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->header_ = $tmp;
          $limit-=$len;
          break;
        case 7:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->listType_ = $tmp;

          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->asset_))
      foreach($this->asset_ as $v) {
        fwrite($fp, "\x0a");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
    if (!is_null($this->numTotalEntries_)) {
      fwrite($fp, "\x10");
      Protobuf::write_varint($fp, $this->numTotalEntries_);
    }
    if (!is_null($this->correctedQuery_)) {
      fwrite($fp, "\x1a");
      Protobuf::write_varint($fp, strlen($this->correctedQuery_));
      fwrite($fp, $this->correctedQuery_);
    }
    if (!is_null($this->altAsset_))
      foreach($this->altAsset_ as $v) {
        fwrite($fp, "\"");
        Protobuf::write_varint($fp, $v->size()); // message
        $v->write($fp);
      }
    if (!is_null($this->numCorrectedEntries_)) {
      fwrite($fp, "(");
      Protobuf::write_varint($fp, $this->numCorrectedEntries_);
    }
    if (!is_null($this->header_)) {
      fwrite($fp, "2");
      Protobuf::write_varint($fp, strlen($this->header_));
      fwrite($fp, $this->header_);
    }
    if (!is_null($this->listType_)) {
      fwrite($fp, "8");
      Protobuf::write_varint($fp, $this->listType_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->asset_))
      foreach($this->asset_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->numTotalEntries_)) {
      $size += 1 + Protobuf::size_varint($this->numTotalEntries_);
    }
    if (!is_null($this->correctedQuery_)) {
      $l = strlen($this->correctedQuery_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->altAsset_))
      foreach($this->altAsset_ as $v) {
        $l = $v->size();
        $size += 1 + Protobuf::size_varint($l) + $l;
      }
    if (!is_null($this->numCorrectedEntries_)) {
      $size += 1 + Protobuf::size_varint($this->numCorrectedEntries_);
    }
    if (!is_null($this->header_)) {
      $l = strlen($this->header_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->listType_)) {
      $size += 1 + Protobuf::size_varint($this->listType_);
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('asset_', $this->asset_)
         . Protobuf::toString('numTotalEntries_', $this->numTotalEntries_)
         . Protobuf::toString('correctedQuery_', $this->correctedQuery_)
         . Protobuf::toString('altAsset_', $this->altAsset_)
         . Protobuf::toString('numCorrectedEntries_', $this->numCorrectedEntries_)
         . Protobuf::toString('header_', $this->header_)
         . Protobuf::toString('listType_', $this->listType_);
  }

  // repeated .App asset = 1;

  private $asset_ = null;
  public function clearAsset() { $this->asset_ = null; }
  public function getAssetCount() { if ($this->asset_ === null ) return 0; else return count($this->asset_); }
  public function getAsset($index) { return $this->asset_[$index]; }
  public function getAssetArray() { if ($this->asset_ === null ) return array(); else return $this->asset_; }
  public function setAsset($index, $value) {$this->asset_[$index] = $value;	}
  public function addAsset($value) { $this->asset_[] = $value; }
  public function addAllAsset(array $values) { foreach($values as $value) {$this->asset_[] = $value;} }

  // optional int64 numTotalEntries = 2;

  private $numTotalEntries_ = null;
  public function clearNumTotalEntries() { $this->numTotalEntries_ = null; }
  public function hasNumTotalEntries() { return $this->numTotalEntries_ !== null; }
  public function getNumTotalEntries() { if($this->numTotalEntries_ === null) return 0; else return $this->numTotalEntries_; }
  public function setNumTotalEntries($value) { $this->numTotalEntries_ = $value; }

  // optional string correctedQuery = 3;

  private $correctedQuery_ = null;
  public function clearCorrectedQuery() { $this->correctedQuery_ = null; }
  public function hasCorrectedQuery() { return $this->correctedQuery_ !== null; }
  public function getCorrectedQuery() { if($this->correctedQuery_ === null) return ""; else return $this->correctedQuery_; }
  public function setCorrectedQuery($value) { $this->correctedQuery_ = $value; }

  // repeated .App altAsset = 4;

  private $altAsset_ = null;
  public function clearAltAsset() { $this->altAsset_ = null; }
  public function getAltAssetCount() { if ($this->altAsset_ === null ) return 0; else return count($this->altAsset_); }
  public function getAltAsset($index) { return $this->altAsset_[$index]; }
  public function getAltAssetArray() { if ($this->altAsset_ === null ) return array(); else return $this->altAsset_; }
  public function setAltAsset($index, $value) {$this->altAsset_[$index] = $value;	}
  public function addAltAsset($value) { $this->altAsset_[] = $value; }
  public function addAllAltAsset(array $values) { foreach($values as $value) {$this->altAsset_[] = $value;} }

  // optional int64 numCorrectedEntries = 5;

  private $numCorrectedEntries_ = null;
  public function clearNumCorrectedEntries() { $this->numCorrectedEntries_ = null; }
  public function hasNumCorrectedEntries() { return $this->numCorrectedEntries_ !== null; }
  public function getNumCorrectedEntries() { if($this->numCorrectedEntries_ === null) return 0; else return $this->numCorrectedEntries_; }
  public function setNumCorrectedEntries($value) { $this->numCorrectedEntries_ = $value; }

  // optional string header = 6;

  private $header_ = null;
  public function clearHeader() { $this->header_ = null; }
  public function hasHeader() { return $this->header_ !== null; }
  public function getHeader() { if($this->header_ === null) return ""; else return $this->header_; }
  public function setHeader($value) { $this->header_ = $value; }

  // optional int32 listType = 7;

  private $listType_ = null;
  public function clearListType() { $this->listType_ = null; }
  public function hasListType() { return $this->listType_ !== null; }
  public function getListType() { if($this->listType_ === null) return 0; else return $this->listType_; }
  public function setListType($value) { $this->listType_ = $value; }

  // @@protoc_insertion_point(class_scope:AssetsResponse)
}


// group ResponseProto.Response
class ResponseProto_Response {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("ResponseProto_Response: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 4');
          break 2;
        case 3:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->assetsResponse_ = new AssetsResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        case 9:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->getAssetResponse_ = new GetAssetResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        case 10:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->getImageResponse_ = new GetImageResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        case 13:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->subCategoriesResponse_ = new SubCategoriesResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        case 20:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->getCategoriesResponse_ = new CategoriesResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->assetsResponse_)) {
      fwrite($fp, "\x1a");
      Protobuf::write_varint($fp, $this->assetsResponse_->size()); // message
      $this->assetsResponse_->write($fp);
    }
    if (!is_null($this->getAssetResponse_)) {
      fwrite($fp, "J");
      Protobuf::write_varint($fp, $this->getAssetResponse_->size()); // message
      $this->getAssetResponse_->write($fp);
    }
    if (!is_null($this->getImageResponse_)) {
      fwrite($fp, "R");
      Protobuf::write_varint($fp, $this->getImageResponse_->size()); // message
      $this->getImageResponse_->write($fp);
    }
    if (!is_null($this->subCategoriesResponse_)) {
      fwrite($fp, "j");
      Protobuf::write_varint($fp, $this->subCategoriesResponse_->size()); // message
      $this->subCategoriesResponse_->write($fp);
    }
    if (!is_null($this->getCategoriesResponse_)) {
      fwrite($fp, "\xa2\x01");
      Protobuf::write_varint($fp, $this->getCategoriesResponse_->size()); // message
      $this->getCategoriesResponse_->write($fp);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->assetsResponse_)) {
      $l = $this->assetsResponse_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->getAssetResponse_)) {
      $l = $this->getAssetResponse_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->getImageResponse_)) {
      $l = $this->getImageResponse_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->subCategoriesResponse_)) {
      $l = $this->subCategoriesResponse_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->getCategoriesResponse_)) {
      $l = $this->getCategoriesResponse_->size();
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('assetsResponse_', $this->assetsResponse_)
         . Protobuf::toString('getAssetResponse_', $this->getAssetResponse_)
         . Protobuf::toString('getImageResponse_', $this->getImageResponse_)
         . Protobuf::toString('subCategoriesResponse_', $this->subCategoriesResponse_)
         . Protobuf::toString('getCategoriesResponse_', $this->getCategoriesResponse_);
  }

  // optional .AssetsResponse assetsResponse = 3;

  private $assetsResponse_ = null;
  public function clearAssetsResponse() { $this->assetsResponse_ = null; }
  public function hasAssetsResponse() { return $this->assetsResponse_ !== null; }
  public function getAssetsResponse() { if($this->assetsResponse_ === null) return null; else return $this->assetsResponse_; }
  public function setAssetsResponse(AssetsResponse $value) { $this->assetsResponse_ = $value; }

  // optional .GetAssetResponse getAssetResponse = 9;

  private $getAssetResponse_ = null;
  public function clearGetAssetResponse() { $this->getAssetResponse_ = null; }
  public function hasGetAssetResponse() { return $this->getAssetResponse_ !== null; }
  public function getGetAssetResponse() { if($this->getAssetResponse_ === null) return null; else return $this->getAssetResponse_; }
  public function setGetAssetResponse(GetAssetResponse $value) { $this->getAssetResponse_ = $value; }

  // optional .GetImageResponse getImageResponse = 10;

  private $getImageResponse_ = null;
  public function clearGetImageResponse() { $this->getImageResponse_ = null; }
  public function hasGetImageResponse() { return $this->getImageResponse_ !== null; }
  public function getGetImageResponse() { if($this->getImageResponse_ === null) return null; else return $this->getImageResponse_; }
  public function setGetImageResponse(GetImageResponse $value) { $this->getImageResponse_ = $value; }

  // optional .SubCategoriesResponse subCategoriesResponse = 13;

  private $subCategoriesResponse_ = null;
  public function clearSubCategoriesResponse() { $this->subCategoriesResponse_ = null; }
  public function hasSubCategoriesResponse() { return $this->subCategoriesResponse_ !== null; }
  public function getSubCategoriesResponse() { if($this->subCategoriesResponse_ === null) return null; else return $this->subCategoriesResponse_; }
  public function setSubCategoriesResponse(SubCategoriesResponse $value) { $this->subCategoriesResponse_ = $value; }

  // optional .CategoriesResponse getCategoriesResponse = 20;

  private $getCategoriesResponse_ = null;
  public function clearGetCategoriesResponse() { $this->getCategoriesResponse_ = null; }
  public function hasGetCategoriesResponse() { return $this->getCategoriesResponse_ !== null; }
  public function getGetCategoriesResponse() { if($this->getCategoriesResponse_ === null) return null; else return $this->getCategoriesResponse_; }
  public function setGetCategoriesResponse(CategoriesResponse $value) { $this->getCategoriesResponse_ = $value; }

  // @@protoc_insertion_point(class_scope:ResponseProto.Response)
}

// message ResponseProto
class ResponseProto {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("ResponseProto: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 3');
          $this->response_[] = new ResponseProto_Response($fp, $limit);
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->response_))
      foreach($this->response_ as $v) {
        fwrite($fp, "\x0b");
        $v->write($fp); // group
        fwrite($fp, "\x0c");
      }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->response_))
      foreach($this->response_ as $v) {
        $size += 2 + $v->size();
      }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('response_', $this->response_);
  }

  // repeated group Response = 1
  private $response_ = null;
  public function clearResponse() { $this->response_ = null; }
  public function getResponseCount() { if ($this->response_ === null ) return 0; else return count($this->response_); }
  public function getResponse($index) { return $this->response_[$index]; }
  public function getResponseArray() { if ($this->response_ === null ) return array(); else return $this->response_; }
  public function setResponse($index, $value) {$this->response_[$index] = $value;	}
  public function addResponse($value) { $this->response_[] = $value; }
  public function addAllResponse(array $values) { foreach($values as $value) {$this->response_[] = $value;} }

  // @@protoc_insertion_point(class_scope:ResponseProto)
}

// message SingleRequestProto
class SingleRequestProto {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("SingleRequestProto: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 4:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->assetRequest_ = new AssetsRequest($fp, $len);
          ASSERT('$len == 0');
          break;
        case 10:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->getAssetRequest_ = new GetAssetRequest($fp, $len);
          ASSERT('$len == 0');
          break;
        case 11:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->getImageRequest_ = new GetImageRequest($fp, $len);
          ASSERT('$len == 0');
          break;
        case 14:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->subCategoriesRequest_ = new SubCategoriesRequest($fp, $len);
          ASSERT('$len == 0');
          break;
        case 21:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->getCategoriesRequest_ = new CategoriesRequest($fp, $len);
          ASSERT('$len == 0');
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->assetRequest_)) {
      fwrite($fp, "\"");
      Protobuf::write_varint($fp, $this->assetRequest_->size()); // message
      $this->assetRequest_->write($fp);
    }
    if (!is_null($this->getAssetRequest_)) {
      fwrite($fp, "R");
      Protobuf::write_varint($fp, $this->getAssetRequest_->size()); // message
      $this->getAssetRequest_->write($fp);
    }
    if (!is_null($this->getImageRequest_)) {
      fwrite($fp, "Z");
      Protobuf::write_varint($fp, $this->getImageRequest_->size()); // message
      $this->getImageRequest_->write($fp);
    }
    if (!is_null($this->subCategoriesRequest_)) {
      fwrite($fp, "r");
      Protobuf::write_varint($fp, $this->subCategoriesRequest_->size()); // message
      $this->subCategoriesRequest_->write($fp);
    }
    if (!is_null($this->getCategoriesRequest_)) {
      fwrite($fp, "\xaa\x01");
      Protobuf::write_varint($fp, $this->getCategoriesRequest_->size()); // message
      $this->getCategoriesRequest_->write($fp);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->assetRequest_)) {
      $l = $this->assetRequest_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->getAssetRequest_)) {
      $l = $this->getAssetRequest_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->getImageRequest_)) {
      $l = $this->getImageRequest_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->subCategoriesRequest_)) {
      $l = $this->subCategoriesRequest_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->getCategoriesRequest_)) {
      $l = $this->getCategoriesRequest_->size();
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('assetRequest_', $this->assetRequest_)
         . Protobuf::toString('getAssetRequest_', $this->getAssetRequest_)
         . Protobuf::toString('getImageRequest_', $this->getImageRequest_)
         . Protobuf::toString('subCategoriesRequest_', $this->subCategoriesRequest_)
         . Protobuf::toString('getCategoriesRequest_', $this->getCategoriesRequest_);
  }

  // optional .AssetsRequest assetRequest = 4;

  private $assetRequest_ = null;
  public function clearAssetRequest() { $this->assetRequest_ = null; }
  public function hasAssetRequest() { return $this->assetRequest_ !== null; }
  public function getAssetRequest() { if($this->assetRequest_ === null) return null; else return $this->assetRequest_; }
  public function setAssetRequest(AssetsRequest $value) { $this->assetRequest_ = $value; }

  // optional .GetAssetRequest getAssetRequest = 10;

  private $getAssetRequest_ = null;
  public function clearGetAssetRequest() { $this->getAssetRequest_ = null; }
  public function hasGetAssetRequest() { return $this->getAssetRequest_ !== null; }
  public function getGetAssetRequest() { if($this->getAssetRequest_ === null) return null; else return $this->getAssetRequest_; }
  public function setGetAssetRequest(GetAssetRequest $value) { $this->getAssetRequest_ = $value; }

  // optional .GetImageRequest getImageRequest = 11;

  private $getImageRequest_ = null;
  public function clearGetImageRequest() { $this->getImageRequest_ = null; }
  public function hasGetImageRequest() { return $this->getImageRequest_ !== null; }
  public function getGetImageRequest() { if($this->getImageRequest_ === null) return null; else return $this->getImageRequest_; }
  public function setGetImageRequest(GetImageRequest $value) { $this->getImageRequest_ = $value; }

  // optional .SubCategoriesRequest subCategoriesRequest = 14;

  private $subCategoriesRequest_ = null;
  public function clearSubCategoriesRequest() { $this->subCategoriesRequest_ = null; }
  public function hasSubCategoriesRequest() { return $this->subCategoriesRequest_ !== null; }
  public function getSubCategoriesRequest() { if($this->subCategoriesRequest_ === null) return null; else return $this->subCategoriesRequest_; }
  public function setSubCategoriesRequest(SubCategoriesRequest $value) { $this->subCategoriesRequest_ = $value; }

  // optional .CategoriesRequest getCategoriesRequest = 21;

  private $getCategoriesRequest_ = null;
  public function clearGetCategoriesRequest() { $this->getCategoriesRequest_ = null; }
  public function hasGetCategoriesRequest() { return $this->getCategoriesRequest_ !== null; }
  public function getGetCategoriesRequest() { if($this->getCategoriesRequest_ === null) return null; else return $this->getCategoriesRequest_; }
  public function setGetCategoriesRequest(CategoriesRequest $value) { $this->getCategoriesRequest_ = $value; }

  // @@protoc_insertion_point(class_scope:SingleRequestProto)
}

// message SingleResponseProto
class SingleResponseProto {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("SingleResponseProto: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 3:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->assetsResponse_ = new AssetsResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        case 9:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->getAssetResponse_ = new GetAssetResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        case 10:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->getImageResponse_ = new GetImageResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        case 13:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->subCategoriesResponse_ = new SubCategoriesResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        case 20:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->getCategoriesResponse_ = new CategoriesResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->assetsResponse_)) {
      fwrite($fp, "\x1a");
      Protobuf::write_varint($fp, $this->assetsResponse_->size()); // message
      $this->assetsResponse_->write($fp);
    }
    if (!is_null($this->getAssetResponse_)) {
      fwrite($fp, "J");
      Protobuf::write_varint($fp, $this->getAssetResponse_->size()); // message
      $this->getAssetResponse_->write($fp);
    }
    if (!is_null($this->getImageResponse_)) {
      fwrite($fp, "R");
      Protobuf::write_varint($fp, $this->getImageResponse_->size()); // message
      $this->getImageResponse_->write($fp);
    }
    if (!is_null($this->subCategoriesResponse_)) {
      fwrite($fp, "j");
      Protobuf::write_varint($fp, $this->subCategoriesResponse_->size()); // message
      $this->subCategoriesResponse_->write($fp);
    }
    if (!is_null($this->getCategoriesResponse_)) {
      fwrite($fp, "\xa2\x01");
      Protobuf::write_varint($fp, $this->getCategoriesResponse_->size()); // message
      $this->getCategoriesResponse_->write($fp);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->assetsResponse_)) {
      $l = $this->assetsResponse_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->getAssetResponse_)) {
      $l = $this->getAssetResponse_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->getImageResponse_)) {
      $l = $this->getImageResponse_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->subCategoriesResponse_)) {
      $l = $this->subCategoriesResponse_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->getCategoriesResponse_)) {
      $l = $this->getCategoriesResponse_->size();
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('assetsResponse_', $this->assetsResponse_)
         . Protobuf::toString('getAssetResponse_', $this->getAssetResponse_)
         . Protobuf::toString('getImageResponse_', $this->getImageResponse_)
         . Protobuf::toString('subCategoriesResponse_', $this->subCategoriesResponse_)
         . Protobuf::toString('getCategoriesResponse_', $this->getCategoriesResponse_);
  }

  // optional .AssetsResponse assetsResponse = 3;

  private $assetsResponse_ = null;
  public function clearAssetsResponse() { $this->assetsResponse_ = null; }
  public function hasAssetsResponse() { return $this->assetsResponse_ !== null; }
  public function getAssetsResponse() { if($this->assetsResponse_ === null) return null; else return $this->assetsResponse_; }
  public function setAssetsResponse(AssetsResponse $value) { $this->assetsResponse_ = $value; }

  // optional .GetAssetResponse getAssetResponse = 9;

  private $getAssetResponse_ = null;
  public function clearGetAssetResponse() { $this->getAssetResponse_ = null; }
  public function hasGetAssetResponse() { return $this->getAssetResponse_ !== null; }
  public function getGetAssetResponse() { if($this->getAssetResponse_ === null) return null; else return $this->getAssetResponse_; }
  public function setGetAssetResponse(GetAssetResponse $value) { $this->getAssetResponse_ = $value; }

  // optional .GetImageResponse getImageResponse = 10;

  private $getImageResponse_ = null;
  public function clearGetImageResponse() { $this->getImageResponse_ = null; }
  public function hasGetImageResponse() { return $this->getImageResponse_ !== null; }
  public function getGetImageResponse() { if($this->getImageResponse_ === null) return null; else return $this->getImageResponse_; }
  public function setGetImageResponse(GetImageResponse $value) { $this->getImageResponse_ = $value; }

  // optional .SubCategoriesResponse subCategoriesResponse = 13;

  private $subCategoriesResponse_ = null;
  public function clearSubCategoriesResponse() { $this->subCategoriesResponse_ = null; }
  public function hasSubCategoriesResponse() { return $this->subCategoriesResponse_ !== null; }
  public function getSubCategoriesResponse() { if($this->subCategoriesResponse_ === null) return null; else return $this->subCategoriesResponse_; }
  public function setSubCategoriesResponse(SubCategoriesResponse $value) { $this->subCategoriesResponse_ = $value; }

  // optional .CategoriesResponse getCategoriesResponse = 20;

  private $getCategoriesResponse_ = null;
  public function clearGetCategoriesResponse() { $this->getCategoriesResponse_ = null; }
  public function hasGetCategoriesResponse() { return $this->getCategoriesResponse_ !== null; }
  public function getGetCategoriesResponse() { if($this->getCategoriesResponse_ === null) return null; else return $this->getCategoriesResponse_; }
  public function setGetCategoriesResponse(CategoriesResponse $value) { $this->getCategoriesResponse_ = $value; }

  // @@protoc_insertion_point(class_scope:SingleResponseProto)
}

// message BuyResponse
class BuyResponse {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("BuyResponse: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 39:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->purchaseStatusResponse_ = new PurchaseStatusResponse($fp, $len);
          ASSERT('$len == 0');
          break;
        case 46:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->purchaseCookie_ = $tmp;
          $limit-=$len;
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->purchaseStatusResponse_)) {
      fwrite($fp, "\xba\x02");
      Protobuf::write_varint($fp, $this->purchaseStatusResponse_->size()); // message
      $this->purchaseStatusResponse_->write($fp);
    }
    if (!is_null($this->purchaseCookie_)) {
      fwrite($fp, "\xf2\x02");
      Protobuf::write_varint($fp, strlen($this->purchaseCookie_));
      fwrite($fp, $this->purchaseCookie_);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->purchaseStatusResponse_)) {
      $l = $this->purchaseStatusResponse_->size();
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->purchaseCookie_)) {
      $l = strlen($this->purchaseCookie_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('purchaseStatusResponse_', $this->purchaseStatusResponse_)
         . Protobuf::toString('purchaseCookie_', $this->purchaseCookie_);
  }

  // optional .PurchaseStatusResponse purchaseStatusResponse = 39;

  private $purchaseStatusResponse_ = null;
  public function clearPurchaseStatusResponse() { $this->purchaseStatusResponse_ = null; }
  public function hasPurchaseStatusResponse() { return $this->purchaseStatusResponse_ !== null; }
  public function getPurchaseStatusResponse() { if($this->purchaseStatusResponse_ === null) return null; else return $this->purchaseStatusResponse_; }
  public function setPurchaseStatusResponse(PurchaseStatusResponse $value) { $this->purchaseStatusResponse_ = $value; }

  // optional string purchaseCookie = 46;

  private $purchaseCookie_ = null;
  public function clearPurchaseCookie() { $this->purchaseCookie_ = null; }
  public function hasPurchaseCookie() { return $this->purchaseCookie_ !== null; }
  public function getPurchaseCookie() { if($this->purchaseCookie_ === null) return ""; else return $this->purchaseCookie_; }
  public function setPurchaseCookie($value) { $this->purchaseCookie_ = $value; }

  // @@protoc_insertion_point(class_scope:BuyResponse)
}

// message PurchaseStatusResponse
class PurchaseStatusResponse {
  private $_unknown;

  function __construct($in = NULL, &$limit = PHP_INT_MAX) {
    if($in !== NULL) {
      if (is_string($in)) {
        $fp = fopen('php://memory', 'r+b');
        fwrite($fp, $in);
        rewind($fp);
      } else if (is_resource($in)) {
        $fp = $in;
      } else {
        throw new Exception('Invalid in parameter');
      }
      $this->read($fp, $limit);
    }
  }

  function read($fp, &$limit = PHP_INT_MAX) {
    while(!feof($fp) && $limit > 0) {
      $tag = Protobuf::read_varint($fp, $limit);
      if ($tag === false) break;
      $wire  = $tag & 0x07;
      $field = $tag >> 3;
      //var_dump("PurchaseStatusResponse: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left");
      switch($field) {
        case 1:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->status_ = $tmp;

          break;
        case 2:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->statusMsg_ = $tmp;
          $limit-=$len;
          break;
        case 3:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->statusTitle_ = $tmp;
          $limit-=$len;
          break;
        case 4:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->briefMessage_ = $tmp;
          $limit-=$len;
          break;
        case 5:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          if ($len > 0)
            $tmp = fread($fp, $len);
          else
            $tmp = '';
          if ($tmp === false)
            throw new Exception("fread($len) returned false");
          $this->infoUrl_ = $tmp;
          $limit-=$len;
          break;
        case 8:
          ASSERT('$wire == 2');
          $len = Protobuf::read_varint($fp, $limit);
          if ($len === false)
            throw new Exception('Protobuf::read_varint returned false');
          $limit-=$len;
          $this->appDeliveryData_ = new AndroidAppDeliveryData($fp, $len);
          ASSERT('$len == 0');
          break;
        default:
          $this->_unknown[$field . '-' . Protobuf::get_wiretype($wire)][] = Protobuf::read_field($fp, $wire, $limit);
      }
    }
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
  }

  function write($fp) {
    if (!$this->validateRequired())
      throw new Exception('Required fields are missing');
    if (!is_null($this->status_)) {
      fwrite($fp, "\x08");
      Protobuf::write_varint($fp, $this->status_);
    }
    if (!is_null($this->statusMsg_)) {
      fwrite($fp, "\x12");
      Protobuf::write_varint($fp, strlen($this->statusMsg_));
      fwrite($fp, $this->statusMsg_);
    }
    if (!is_null($this->statusTitle_)) {
      fwrite($fp, "\x1a");
      Protobuf::write_varint($fp, strlen($this->statusTitle_));
      fwrite($fp, $this->statusTitle_);
    }
    if (!is_null($this->briefMessage_)) {
      fwrite($fp, "\"");
      Protobuf::write_varint($fp, strlen($this->briefMessage_));
      fwrite($fp, $this->briefMessage_);
    }
    if (!is_null($this->infoUrl_)) {
      fwrite($fp, "*");
      Protobuf::write_varint($fp, strlen($this->infoUrl_));
      fwrite($fp, $this->infoUrl_);
    }
    if (!is_null($this->appDeliveryData_)) {
      fwrite($fp, "B");
      Protobuf::write_varint($fp, $this->appDeliveryData_->size()); // message
      $this->appDeliveryData_->write($fp);
    }
  }

  public function size() {
    $size = 0;
    if (!is_null($this->status_)) {
      $size += 1 + Protobuf::size_varint($this->status_);
    }
    if (!is_null($this->statusMsg_)) {
      $l = strlen($this->statusMsg_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->statusTitle_)) {
      $l = strlen($this->statusTitle_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->briefMessage_)) {
      $l = strlen($this->briefMessage_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->infoUrl_)) {
      $l = strlen($this->infoUrl_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->appDeliveryData_)) {
      $l = $this->appDeliveryData_->size();
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    return $size;
  }

  public function validateRequired() {
    return true;
  }

  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('status_', $this->status_)
         . Protobuf::toString('statusMsg_', $this->statusMsg_)
         . Protobuf::toString('statusTitle_', $this->statusTitle_)
         . Protobuf::toString('briefMessage_', $this->briefMessage_)
         . Protobuf::toString('infoUrl_', $this->infoUrl_)
         . Protobuf::toString('appDeliveryData_', $this->appDeliveryData_);
  }

  // optional int32 status = 1;

  private $status_ = null;
  public function clearStatus() { $this->status_ = null; }
  public function hasStatus() { return $this->status_ !== null; }
  public function getStatus() { if($this->status_ === null) return 0; else return $this->status_; }
  public function setStatus($value) { $this->status_ = $value; }

  // optional string statusMsg = 2;

  private $statusMsg_ = null;
  public function clearStatusMsg() { $this->statusMsg_ = null; }
  public function hasStatusMsg() { return $this->statusMsg_ !== null; }
  public function getStatusMsg() { if($this->statusMsg_ === null) return ""; else return $this->statusMsg_; }
  public function setStatusMsg($value) { $this->statusMsg_ = $value; }

  // optional string statusTitle = 3;

  private $statusTitle_ = null;
  public function clearStatusTitle() { $this->statusTitle_ = null; }
  public function hasStatusTitle() { return $this->statusTitle_ !== null; }
  public function getStatusTitle() { if($this->statusTitle_ === null) return ""; else return $this->statusTitle_; }
  public function setStatusTitle($value) { $this->statusTitle_ = $value; }

  // optional string briefMessage = 4;

  private $briefMessage_ = null;
  public function clearBriefMessage() { $this->briefMessage_ = null; }
  public function hasBriefMessage() { return $this->briefMessage_ !== null; }
  public function getBriefMessage() { if($this->briefMessage_ === null) return ""; else return $this->briefMessage_; }
  public function setBriefMessage($value) { $this->briefMessage_ = $value; }

  // optional string infoUrl = 5;

  private $infoUrl_ = null;
  public function clearInfoUrl() { $this->infoUrl_ = null; }
  public function hasInfoUrl() { return $this->infoUrl_ !== null; }
  public function getInfoUrl() { if($this->infoUrl_ === null) return ""; else return $this->infoUrl_; }
  public function setInfoUrl($value) { $this->infoUrl_ = $value; }

  // optional .AndroidAppDeliveryData appDeliveryData = 8;

  private $appDeliveryData_ = null;
  public function clearAppDeliveryData() { $this->appDeliveryData_ = null; }
  public function hasAppDeliveryData() { return $this->appDeliveryData_ !== null; }
  public function getAppDeliveryData() { if($this->appDeliveryData_ === null) return null; else return $this->appDeliveryData_; }
  public function setAppDeliveryData(AndroidAppDeliveryData $value) { $this->appDeliveryData_ = $value; }

  // @@protoc_insertion_point(class_scope:PurchaseStatusResponse)
}

// enum AppType
class AppType {
  const NONE = 0;
  const APPLICATION = 1;
  const RINGTONE = 2;
  const WALLPAPER = 3;
  const GAME = 4;

  public static $_values = array(
    0 => self::NONE,
    1 => self::APPLICATION,
    2 => self::RINGTONE,
    3 => self::WALLPAPER,
    4 => self::GAME,
  );

  public static function toString($value) {
    if (is_null($value)) return null;
    if (array_key_exists($value, self::$_values))
      return self::$_values[$value];
    return 'UNKNOWN';
  }
}

