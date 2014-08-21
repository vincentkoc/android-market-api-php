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

$cr = new CategoriesRequest();
$reqGroup = new Request_RequestGroup();
$reqGroup->setCategoriesRequest($cr);

//Fetch Request
try{
	$response = $session->execute($reqGroup);
}catch(Exception $e){
	echo "Exception: ".$e->getMessage();
}

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