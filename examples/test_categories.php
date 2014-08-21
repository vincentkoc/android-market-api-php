<?php
include("local.php");
include("../src/MarketSession.php");

$session = new MarketSession();
$session->login(GOOGLE_EMAIL, GOOGLE_PASSWD);
$session->setAndroidId(ANDROID_DEVICEID);

$cr = new CategoriesRequest();

$reqGroup = new Request_RequestGroup();
$reqGroup->setCategoriesRequest($cr);
$response = $session->execute($reqGroup);

$groups = $response->getResponsegroupArray();
foreach ($groups as $rg) {
	$categoriesResponse = $rg->getCategoriesResponse();
	$categories = $categoriesResponse->getCategoriesArray();
	foreach ($categories as $category) {
		echo $category->getTitle()."<br/>";

		$subcategories = $category->getSubCategoriesArray();
		foreach ($subcategories as $subcategory) {
			echo "- ".$subcategory->getTitle()."<br/>";
		}
	}
}