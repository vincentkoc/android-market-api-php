<?php
include("local.php");
include("../src/MarketSession.php");

$session = new MarketSession();
if ($session->login(GOOGLE_EMAIL, GOOGLE_PASSWD) == false) {
    echo "ERROR: cannot login as " . GOOGLE_EMAIL;
    exit(1);
}
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
