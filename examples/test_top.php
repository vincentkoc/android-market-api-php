<?php
include("local.php");
include("../proto/protocolbuffers.inc.php");
include("../proto/market.proto.php");
include("../Market/MarketSession.php");

$session = new MarketSession();
$session->login(GOOGLE_EMAIL, GOOGLE_PASSWD);
$session->setAndroidId(ANDROID_DEVICEID);

$ar = new AppsRequest();
$ar->setOrderType(AppsRequest_OrderType::POPULAR);
$ar->setStartIndex(0);
$ar->setEntriesCount(5);
$ar->setViewType(AppsRequest_ViewType::PAID);
$ar->setCategoryId("ARCADE");

$reqGroup = new Request_RequestGroup();
$reqGroup->setAppsRequest($ar);

$response = $session->execute($reqGroup);

$groups = $response->getResponsegroupArray();
foreach ($groups as $rg) {
	$appsResponse = $rg->getAppsResponse();
	$apps = $appsResponse->getAppArray();
	foreach ($apps as $app) {
		echo $app->getTitle()." (".$app->getId().")<br/>";

		//Get comments
		echo "<div style=\"padding-left:20px\">";
		$cr = new CommentsRequest();
		$cr->setAppId($app->getId());
		$cr->setEntriesCount(3);

		$reqGroup = new Request_RequestGroup();
		$reqGroup->setCommentsRequest($cr);

		$response = $session->execute($reqGroup);
		$groups	= $response->getResponsegroupArray();
		foreach ($groups as $rg) {
			$commentsResponse = $rg->getCommentsResponse();

			$comments = $commentsResponse->getCommentsArray();
			foreach ($comments as $comment) {
				echo "<strong>".$comment->getAuthorName()."</strong> [".str_repeat("*", $comment->getRating())."]<br/>";
				echo $comment->getText()."<br/><br/>";
			}
		}

		echo "</div>";
	}
}