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
    if (!is_null($this->app_))
      foreach($this->app_ as $v) {
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
    if (!is_null($this->app_))
      foreach($this->app_ as $v) {
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
         . Protobuf::toString('app_', $this->app_)
         . Protobuf::toString('entriesCount_', $this->entriesCount_);
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
  
  // optional int32 entriesCount = 2;

  private $entriesCount_ = null;
  public function clearEntriesCount() { $this->entriesCount_ = null; }
  public function hasEntriesCount() { return $this->entriesCount_ !== null; }
  public function getEntriesCount() { if($this->entriesCount_ === null) return 0; else return $this->entriesCount_; }
  public function setEntriesCount($value) { $this->entriesCount_ = $value; }
  
  // @@protoc_insertion_point(class_scope:AppsResponse)
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
    if (!is_null($this->title_)) {
      fwrite($fp, "\"");
      Protobuf::write_varint($fp, strlen($this->title_));
      fwrite($fp, $this->title_);
    }
    if (!is_null($this->categoryId_)) {
      fwrite($fp, "\x1a");
      Protobuf::write_varint($fp, strlen($this->categoryId_));
      fwrite($fp, $this->categoryId_);
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
    if (!is_null($this->title_)) {
      $l = strlen($this->title_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->categoryId_)) {
      $l = strlen($this->categoryId_);
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
         . Protobuf::toString('title_', $this->title_)
         . Protobuf::toString('categoryId_', $this->categoryId_)
         . Protobuf::toString('subtitle_', $this->subtitle_)
         . Protobuf::toString('subCategories_', $this->subCategories_);
  }
  
  // optional int32 appType = 2;

  private $appType_ = null;
  public function clearAppType() { $this->appType_ = null; }
  public function hasAppType() { return $this->appType_ !== null; }
  public function getAppType() { if($this->appType_ === null) return 0; else return $this->appType_; }
  public function setAppType($value) { $this->appType_ = $value; }
  
  // optional string title = 4;

  private $title_ = null;
  public function clearTitle() { $this->title_ = null; }
  public function hasTitle() { return $this->title_ !== null; }
  public function getTitle() { if($this->title_ === null) return ""; else return $this->title_; }
  public function setTitle($value) { $this->title_ = $value; }
  
  // optional string categoryId = 3;

  private $categoryId_ = null;
  public function clearCategoryId() { $this->categoryId_ = null; }
  public function hasCategoryId() { return $this->categoryId_ !== null; }
  public function getCategoryId() { if($this->categoryId_ === null) return ""; else return $this->categoryId_; }
  public function setCategoryId($value) { $this->categoryId_ = $value; }
  
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
          $this->maturity_ = $tmp;
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
          $this->promotionalVideo_ = $tmp;
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
    if (!is_null($this->recentChanges_)) {
      fwrite($fp, "\xb2\x02");
      Protobuf::write_varint($fp, strlen($this->recentChanges_));
      fwrite($fp, $this->recentChanges_);
    }
    if (!is_null($this->promotionalVideo_)) {
      fwrite($fp, "\xda\x02");
      Protobuf::write_varint($fp, strlen($this->promotionalVideo_));
      fwrite($fp, $this->promotionalVideo_);
    }
	if (!is_null($this->maturity_)) {
      fwrite($fp, "\xfa\x01");
      Protobuf::write_varint($fp, strlen($this->maturity_));
      fwrite($fp, $this->maturity_);
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
    if (!is_null($this->recentChanges_)) {
      $l = strlen($this->recentChanges_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->promotionalVideo_)) {
      $l = strlen($this->promotionalVideo_);
      $size += 2 + Protobuf::size_varint($l) + $l;
    }
	if (!is_null($this->maturity_)) {
      $l = strlen($this->maturity_);
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
		 . Protobuf::toString('maturity_', $this->maturity_)
         . Protobuf::toString('recentChanges_', $this->recentChanges_)
         . Protobuf::toString('promotionalVideo_', $this->promotionalVideo_);
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
  
  // optional string maturity = 37;

  private $maturity_ = null;
  public function clearMaturity() { $this->maturity_ = null; }
  public function hasMaturity() { return $this->maturity_ !== null; }
  public function getMaturity() { if($this->maturity_ === null) return ""; else return $this->maturity_; }
  public function setMaturity($value) { $this->maturity_ = $value; }
  
  // optional string recentChanges = 38;

  private $recentChanges_ = null;
  public function clearRecentChanges() { $this->recentChanges_ = null; }
  public function hasRecentChanges() { return $this->recentChanges_ !== null; }
  public function getRecentChanges() { if($this->recentChanges_ === null) return ""; else return $this->recentChanges_; }
  public function setRecentChanges($value) { $this->recentChanges_ = $value; }
  
  // optional string promotionalVideo = 43;

  private $promotionalVideo_ = null;
  public function clearPromotionalVideo() { $this->promotionalVideo_ = null; }
  public function hasPromotionalVideo() { return $this->promotionalVideo_ !== null; }
  public function getPromotionalVideo() { if($this->promotionalVideo_ === null) return ""; else return $this->promotionalVideo_; }
  public function setPromotionalVideo($value) { $this->promotionalVideo_ = $value; }
  
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
		case 40:
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
          $this->originalPrice_ = $tmp;
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
	if (!is_null($this->originalPrice_)) {
      fwrite($fp, "2");
      Protobuf::write_varint($fp, strlen($this->originalPrice_));
      fwrite($fp, $this->originalPrice_);
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
	if (!is_null($this->originalPrice_)) {
      $size += 2 + Protobuf::size_varint($this->originalPrice_);
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
         . Protobuf::toString('priceMicros_', $this->priceMicros_)
		 . Protobuf::toString('originalPrice_', $this->originalPrice_);
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
  
  // optional string originalPrice = 40;

  private $originalPrice_ = null;
  public function clearoriginalPrice() { $this->originalPrice_ = null; }
  public function hasoriginalPrice() { return $this->originalPrice_ !== null; }
  public function getoriginalPrice() { if($this->originalPrice_ === null) return ""; else return $this->originalPrice_; }
  public function setoriginalPrice($value) { $this->originalPrice_ = $value; }
  
  // @@protoc_insertion_point(class_scope:App)
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
          $this->unknown1_ = $tmp;
          
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
    if (!is_null($this->unknown1_)) {
      fwrite($fp, "\x10");
      Protobuf::write_varint($fp, $this->unknown1_);
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
    if (!is_null($this->unknown1_)) {
      $size += 1 + Protobuf::size_varint($this->unknown1_);
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
    if ($this->unknown1_ === null) return false;
    if ($this->version_ === null) return false;
    if ($this->androidId_ === null) return false;
    return true;
  }
  
  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('authSubToken_', $this->authSubToken_)
         . Protobuf::toString('unknown1_', $this->unknown1_)
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
  
  // required int32 unknown1 = 2;

  private $unknown1_ = null;
  public function clearUnknown1() { $this->unknown1_ = null; }
  public function hasUnknown1() { return $this->unknown1_ !== null; }
  public function getUnknown1() { if($this->unknown1_ === null) return 0; else return $this->unknown1_; }
  public function setUnknown1($value) { $this->unknown1_ = $value; }
  
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
         . Protobuf::toString('imageId_', $this->imageId_);
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
      //var_dump("GetImageResponse: Found $field type " . Protobuf::get_wiretype($wire) . " $limit bytes left<br />");
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
          $this->imageWidth_ = $tmp;
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
  }
  
  public function size() {
    $size = 0;
    if (!is_null($this->imageData_)) {
      $l = strlen($this->imageData_);
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
         . Protobuf::toString('imageData_', $this->imageData_);
  }
  
  // optional bytes imageData = 1;

  private $imageData_ = null;
  public function clearImageData() { $this->imageData_ = null; }
  public function hasImageData() { return $this->imageData_ !== null; }
  public function getImageData() { if($this->imageData_ === null) return ""; else return $this->imageData_; }
  public function setImageData($value) { $this->imageData_ = $value; }
  
  private $imageWidth_ = null;
  public function clearImageWidth() { $this->imageWidth_ = null; }
  public function hasImageWidth() { return $this->imageWidth_ !== null; }
  public function getImageWidth() { if($this->imageWidth_ === null) return ""; else return $this->imageWidth_; }
  public function setImageWidth($value) { $this->imageWidth_ = $value; }
  
  // @@protoc_insertion_point(class_scope:GetImageResponse)
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
          $this->unknown1_ = $tmp;
          
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
          $this->unknown2_ = $tmp;
          $limit-=$len;
          break;
        case 4:
          ASSERT('$wire == 0');
          $tmp = Protobuf::read_varint($fp, $limit);
          if ($tmp === false)
            throw new Exception('Protobuf::read_varint returned false');
          $this->unknown3_ = $tmp;
          
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
    if (!is_null($this->unknown1_)) {
      fwrite($fp, "\x10");
      Protobuf::write_varint($fp, $this->unknown1_);
    }
    if (!is_null($this->unknown2_)) {
      fwrite($fp, "\x1a");
      Protobuf::write_varint($fp, strlen($this->unknown2_));
      fwrite($fp, $this->unknown2_);
    }
    if (!is_null($this->unknown3_)) {
      fwrite($fp, " ");
      Protobuf::write_varint($fp, $this->unknown3_);
    }
  }
  
  public function size() {
    $size = 0;
    if (!is_null($this->result_)) {
      $size += 1 + Protobuf::size_varint($this->result_);
    }
    if (!is_null($this->unknown1_)) {
      $size += 1 + Protobuf::size_varint($this->unknown1_);
    }
    if (!is_null($this->unknown2_)) {
      $l = strlen($this->unknown2_);
      $size += 1 + Protobuf::size_varint($l) + $l;
    }
    if (!is_null($this->unknown3_)) {
      $size += 1 + Protobuf::size_varint($this->unknown3_);
    }
    return $size;
  }
  
  public function validateRequired() {
    return true;
  }
  
  public function __toString() {
    return ''
         . Protobuf::toString('unknown', $this->_unknown)
         . Protobuf::toString('result_', $this->result_)
         . Protobuf::toString('unknown1_', $this->unknown1_)
         . Protobuf::toString('unknown2_', $this->unknown2_)
         . Protobuf::toString('unknown3_', $this->unknown3_);
  }
  
  // optional int32 result = 1;

  private $result_ = null;
  public function clearResult() { $this->result_ = null; }
  public function hasResult() { return $this->result_ !== null; }
  public function getResult() { if($this->result_ === null) return 0; else return $this->result_; }
  public function setResult($value) { $this->result_ = $value; }
  
  // optional int32 unknown1 = 2;

  private $unknown1_ = null;
  public function clearUnknown1() { $this->unknown1_ = null; }
  public function hasUnknown1() { return $this->unknown1_ !== null; }
  public function getUnknown1() { if($this->unknown1_ === null) return 0; else return $this->unknown1_; }
  public function setUnknown1($value) { $this->unknown1_ = $value; }
  
  // optional string unknown2 = 3;

  private $unknown2_ = null;
  public function clearUnknown2() { $this->unknown2_ = null; }
  public function hasUnknown2() { return $this->unknown2_ !== null; }
  public function getUnknown2() { if($this->unknown2_ === null) return ""; else return $this->unknown2_; }
  public function setUnknown2($value) { $this->unknown2_ = $value; }
  
  // optional int32 unknown3 = 4;

  private $unknown3_ = null;
  public function clearUnknown3() { $this->unknown3_ = null; }
  public function hasUnknown3() { return $this->unknown3_ !== null; }
  public function getUnknown3() { if($this->unknown3_ === null) return 0; else return $this->unknown3_; }
  public function setUnknown3($value) { $this->unknown3_ = $value; }
  
  // @@protoc_insertion_point(class_scope:ResponseContext)
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

