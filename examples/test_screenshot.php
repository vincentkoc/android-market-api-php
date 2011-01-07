<?php
include("local.php");
include("../proto/protocolbuffers.inc.php");
include("../proto/market.proto.php");
include("../Market/MarketSession.php");

$session = new MarketSession();
$session->login(GOOGLE_EMAIL, GOOGLE_PASSWD);
$session->setAndroidId(ANDROID_DEVICEID);

$appId		= "7059973813889603239";
$imageId	= 1;

$gir = new GetImageRequest();
$gir->setImageUsage(GetImageRequest_AppImageUsage::SCREENSHOT);
$gir->setAppId($appId);
$gir->setImageId($imageId);


$reqGroup = new Request_RequestGroup();
$reqGroup->setImageRequest($gir);
$response = $session->execute($reqGroup);

$groups = $response->getResponsegroupArray();
#echo "<xmp>".print_r($groups, true)."</xmp>";
foreach ($groups as $rg) {
	$imageResponse = $rg->getImageResponse();
	file_put_contents("../".$appId."_".$imageId.".png", $imageResponse->getImageData());

	?><img src="../<?php echo $appId."_".$imageId.".png"; ?>"><?php
}
