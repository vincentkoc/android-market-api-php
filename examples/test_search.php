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
$ar = new AppsRequest();
$ar->setQuery($_GET["search"] ? $_GET["search"] : "froyo");
#$ar->setOrderType(AppsRequest_OrderType::NONE);
$ar->setStartIndex(0);
$ar->setEntriesCount(5);

$ar->setWithExtendedInfo(true);
#$ar->setViewType(AppsRequest_ViewType::PAID);
#$ar->setAppType(AppType::WALLPAPER);

$reqGroup = new Request_RequestGroup();
$reqGroup->setAppsRequest($ar);

//Fetch Request
try{
	$response = $session->execute($reqGroup);
}catch(Exception $e){
	echo "Exception: ".$e->getMessage();
}

//Loop And Display
$groups = $response->getResponsegroupArray();
foreach ($groups as $rg) {
	$appsResponse = $rg->getAppsResponse();
	$apps = $appsResponse->getAppArray();
	foreach ($apps as $app) {
		echo $app->getTitle()." (".$app->getId().")<br/>";
		echo $app->getExtendedInfo()->getDescription()."<br/><br/>";

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