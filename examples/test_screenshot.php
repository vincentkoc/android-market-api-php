<?php
//Do Includes
include("local.php");
include("../src/MarketSession.php");

//Try to Login
//For Issues Please See Readme.md
try{
	$session = new MarketSession();
	$session->login(GOOGLE_EMAIL, GOOGLE_PASSWD);
	$session->setAndroidId(ANDROID_DEVICEID);
	sleep(1);#Reduce Throttling
}catch(Exception $e){
	echo "Exception: ".$e->getMessage()."\n";
	echo "ERROR: cannot login as " . GOOGLE_EMAIL;
	exit(1);
}

//Build Request
$appId		= "7059973813889603239";
$imageId	= 1;
$gir = new GetImageRequest();
$gir->setImageUsage(GetImageRequest_AppImageUsage::SCREENSHOT);
$gir->setAppId($appId);
$gir->setImageId($imageId);

$reqGroup = new Request_RequestGroup();
$reqGroup->setImageRequest($gir);

//Fetch Request
try{
	$response = $session->execute($reqGroup);
}catch(Exception $e){
	echo "Exception: ".$e->getMessage();
}

//Loop And Display
$groups = $response->getResponsegroupArray();
#echo "<xmp>".print_r($groups, true)."</xmp>";
foreach ($groups as $rg) {
	$imageResponse = $rg->getImageResponse();
	file_put_contents("../".$appId."_".$imageId.".png", $imageResponse->getImageData());

	?><img src="../<?php echo $appId."_".$imageId.".png"; ?>"><?php
}
