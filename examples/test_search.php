<?
include("../proto/protocolbuffers.inc.php");
include("../proto/market.proto.php");
include("../Market/MarketSession.php");

$session = new MarketSession();
$session->login("xxx@gmail.com", "xxx");

$ar = new AppsRequest();
$ar->setQuery("froyo");
#$ar->setOrderType(AppsRequest_OrderType::NONE);
$ar->setStartIndex(0);
$ar->setEntriesCount(5);
#$ar->setWithExtendedInfo(true);
#$ar->setViewType(AppsRequest_ViewType::PAID);
#$ar->setAppType(AppType::WALLPAPER);

$reqGroup = new Request_RequestGroup();
$reqGroup->setAppsRequest($ar);

$response = $session->execute($reqGroup);

$groups = $response->getResponsegroupArray();
foreach ($groups as $rg) {
	$appsResponse = $rg->getAppsResponse();
	$apps = $appsResponse->getAppArray();
	foreach ($apps as $app) {
		echo $app->getTitle()."<br/>";
	}
}