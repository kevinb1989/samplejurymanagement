<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

User::setStripeKey('sk_test_lEkhqwf5n4Fp4RiiMSbBOTVk');

Route::get('/', function()
{
	return View::make('hello');
});

Route::resource('juries','JuriesController');

Route::get('datatable', function(){
	return View::make('datatable');
});

Route::get('datatable2', function(){
	$juries = Jury::all();
	return View::make('datatable2') -> with('juries', $juries);
});

Route::post('massdelete', 'JuriesController@massDelete');

Route::get('app-search', function(){
	return View::make('app-search');
});

Route::get('android-market-api/{pname}', function($pname){
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
$ar->setQuery($pname);
#$ar->setOrderType(AppsRequest_OrderType::NONE);
$ar->setStartIndex(0);
$ar->setEntriesCount(5);

$ar->setWithExtendedInfo(true);
#$ar->setViewType(AppsRequest_ViewType::PAID);
#$ar->setAppType(AppType::WALLPAPER);

$reqGroup = new Request_RequestGroup();
$reqGroup->setAppsRequest($ar);

//Fetch Request
$response = null;
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
		echo "<p><b>App ID: </b>" . $app -> getId() . "</p>";
		echo "<p><b>Title: </b>" . $app -> getTitle() . "</p>";
		echo "<p><b>App Type: </b>" . $app -> getAppType() . "</p>";
		echo "<p><b>Creator: </b>" . $app -> getCreator() . "</p>";
		echo "<p><b>Version: </b>" . $app -> getVersion() . "</p>";
		echo "<p><b>Price: </b>" . $app -> getPrice() . "</p>";
		echo "<p><b>Version: </b>" . $app -> getVersion() . "</p>";
		echo "<p><b>Rating: </b>" . $app -> getRating() . "</p>";
		echo "<p><b>Rating counts: </b>" . $app -> getRatingsCount() . "</p>";
		echo "<p><b>Description: </b>" . $app->getExtendedInfo()->getDescription() . "</p>";
		echo "<p><b>Downloads count: </b>" . $app->getExtendedInfo()->getDownloadsCount() . "</p>";
		echo "<p><b>Package name: </b>" . $app->getExtendedInfo()->getPackageName() . "</p>";
		echo "<p><b>Install size: </b>" . $app->getExtendedInfo()->getInstallSize() . "</p>";
		echo "<p><b>Category: </b>" . $app->getExtendedInfo()->getCategory() . "</p>";
		echo "<p><b>Promo Video: </b>" . $app->getExtendedInfo()->getPromotionalVideo() . "</p>";

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
		//only the first record is needed so the escape this loop after the 1st iteration
		break;
	}
}
});

Route::get('android-market-api-icon/', function(){
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
	$appId		= "v2:com.supercell.clashofclans:1:562";
	$packageName = "com.supercell.clashofclans";
	$imageId	= 1;
	$gir = new GetImageRequest();
	$gir->setImageUsage(GetImageRequest_AppImageUsage::ICON);
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
		//echo $imageResponse -> getImageData();
		file_put_contents("apps_icons/" . $packageName . "_icon.jpg", $imageResponse->getImageData());

		echo "image downloaded and save";

		//as only one icon is needed, the loop is break after the first iteration
	}
});

//this route will obtain android app info and return it to the search app page
Route::get('search-android-app-info/{pname?}', function($pname = 'com.facebook.katana'){
	$packageName = $pname;
	try{
		$session = new MarketSession();
		$session -> login(GOOGLE_EMAIL, GOOGLE_PASSWD);
		$session -> setAndroidId(ANDROID_DEVICEID);
	}catch(Exception $e){
		Log::error($e);
	}

	//Build Request
	$ar = new AppsRequest();
	$ar->setQuery($packageName);
	$ar->setStartIndex(0);
	$ar->setEntriesCount(1);
	$ar->setWithExtendedInfo(true);

	//create a request group
	$reqGroup = new Request_RequestGroup();
	$reqGroup->setAppsRequest($ar);

	//Fetch response
	$response = null;
	try{
		$response = $session->execute($reqGroup);
	}catch(Exception $e){
		Log::error($e);
	}

	//Loop And Display
	$groups = $response->getResponsegroupArray();
	$appId = null;
	$app_info_array = array();
	foreach ($groups as $rg) {

		$appsResponse = $rg->getAppsResponse();
		$apps = $appsResponse->getAppArray();
		foreach ($apps as $app) {
			//read app info into array
			$appId = $app -> getId();
			$app_info_array = array_add($app_info_array, 'name', $app -> getTitle());
			$app_info_array = array_add($app_info_array, 'category', $app -> getExtendedInfo() -> getCategory());
			$app_info_array = array_add($app_info_array, 'description', $app -> getExtendedInfo() -> getDescription());
			$app_info_array = array_add($app_info_array, 'video', $app -> getExtendedInfo() -> getPromotionalVideo());
			//only the first record is needed so the escape this loop after the 1st iteration
			break;
		}
	}

	//RETRIEVE COVER IMAGE
	//Build Request
	$imageId	= 1;
	$gir = new GetImageRequest();
	$gir->setImageUsage(GetImageRequest_AppImageUsage::ICON);
	$gir->setAppId($appId);
	$gir->setImageId($imageId);

	//recreate the request group, this time for image download
	$reqGroup = new Request_RequestGroup();
	$reqGroup->setImageRequest($gir);

	//Fetch Request
	try{
		$response = $session->execute($reqGroup);
	}catch(Exception $e){
		Log::error($e);
	}

	//Loop And Display
	$groups = $response->getResponsegroupArray();
	#echo "<xmp>".print_r($groups, true)."</xmp>";
	foreach ($groups as $rg) {
		$imageResponse = $rg->getImageResponse();
		//this is the link to the icon
		$coverImageLink = "apps_icons/" . $packageName . "_icon.jpg"; 
		file_put_contents($coverImageLink, $imageResponse->getImageData());
		$app_info_array = array_add($app_info_array, 'cover_image', $coverImageLink);
		//as only one icon is needed, the loop is break after the first iteration
	}

	//RETRIEVE SCREENSHOTS
	$gir->setImageUsage(GetImageRequest_AppImageUsage::SCREENSHOT);
	$imageId = 0;
	$screenshots_arr = array();
	while($imageId < 3){
		$gir -> setImageId($imageId);
		//Fetch Request
		try{
			$response = $session->execute($reqGroup);
		}catch(Exception $e){
			echo "Exception: ".$e->getMessage();
		}

		//Loop And Display
		$groups = $response->getResponsegroupArray();
		foreach ($groups as $rg) {
			$imageResponse = $rg->getImageResponse();
			$screenshot_link = "apps_screenshots/" . $packageName . "_screenshot_" . $imageId . ".jpg";
			file_put_contents($screenshot_link, $imageResponse->getImageData());
			$screenshots_arr[] = $screenshot_link;
			$imageId++;
		}
	}
	$app_info_array = array_add($app_info_array, 'screenshots', $screenshots_arr);

	return json_encode($app_info_array);
});

Route::get('search-windows-phone-app-info/{app_id?}', function($app_id = "218a0ebb-1585-4c7e-a9ec-054cf4569a79"){
	//construct the url to read xml data about app from
	$url = "http://marketplaceedgeservice.windowsphone.com/v8/catalog/apps/";
	$url .= $app_id;
	$url .= "?os=8.0.10211.0&cc=AU&lang=en-US";
	$xml = simplexml_load_string(disguise_curl($url));
	//print_r($xml);

	$app_name = $xml -> children("a", true) -> title;
	$app_category = $xml -> categories -> category -> title;
	$app_description = $xml -> children("a", true) -> content;

	//extract image id
	$image_arr = explode(':', $xml -> image -> id);
	//the last element of the array is the image id
	$image_link = "http://cdn.marketplaceimages.windowsphone.com/v8/images/" . $image_arr[count($image_arr) - 1];

	//construct an array of data to send to client
	$app_info_arr = array();
	$app_info_arr = array_add($app_info_arr, 'name', $app_name);
	$app_info_arr = array_add($app_info_arr, 'category', $app_category);
	$app_info_arr = array_add($app_info_arr, 'description', $app_description);
	$app_info_arr = array_add($app_info_arr, 'cover_image', $image_link);

	// //create an array of screenshots
	$screenshots_arr = array();
	foreach ($xml -> screenshots -> screenshot as $screenshot) {
		$screenshot_arr = explode(":", $screenshot -> id);
		$screenshot_link = "http://cdn.marketplaceimages.windowsphone.com/v8/images/" . $screenshot_arr[count($screenshot_arr) - 1]; 
		$screenshots_arr[] = $screenshot_link;
	}
	//attach the array of screenshots to the array of info for this app
	$app_info_arr = array_add($app_info_arr, 'screenshots', $screenshots_arr);

	return json_encode($app_info_arr);
});

//this function is to read xml data from market place edge service
function disguise_curl($url)
{
  $curl = curl_init();
  $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
  $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
  $header[] = "Cache-Control: max-age=0";
  $header[] = "Connection: keep-alive";
  $header[] = "Keep-Alive: 300";
  $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
  $header[] = "Accept-Language: en-us,en;q=0.5";
  $header[] = "Pragma: "; // browsers keep this blank.

  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_USERAGENT, 'Googlebot/2.1 (+http://www.google.com/bot.html)');
  curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
  curl_setopt($curl, CURLOPT_REFERER, 'http://www.google.com');
  curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
  curl_setopt($curl, CURLOPT_AUTOREFERER, true);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_TIMEOUT, 10);

  $html = curl_exec($curl);
  curl_close($curl);

  return $html;
}

Route::get('subscribe', function(){
	return View::make('subscribe');
});

Route::get('subscribe-success', function(){
	return View::make('subscribe-success');
});

Route::get('subscribe-failure', function(){
	return View::make('subscribe-failure');
});

Route::post('tan-sponsored-pro-subscribe', function(){
	$token = Input::get('stripeToken');

	Auth::user() -> subscription('TANSponsoredPro') -> create($token);

	return Redirect::to('subscribe-success');
});

Route::post('one-day-test-plan-subscribe', function(){
	$token = Input::get('stripeToken');

	try{
		Auth::user() -> subscription('OneDayTestPlan') -> create($token);
	}catch(Exception $e){
		$errMsg = $e -> getMessage();
		Redirect::to('subscribe-failure')->with('error', $errMsg);
	}
	

	return Redirect::to('subscribe-success');
});

Route::get('test-hassing/{init_string?}',function($init_string = '12345678'){
	return Hash::make($init_string);
});

Route::get('login', function(){
	return View::make('login');
});

Route::post('login', function(){
	$email = Input::get('email');
	$password = Input::get('password');
	if(Auth::attempt(array('email' => $email, 'password' => $password))){
		return Redirect::to('account-settings');
	}else{
		return Redirect::to('login') -> with("error", "incorrect combination of username and password");
	}
});

Route::get('logout', function(){
	Auth::logout();
	return Redirect::to('login');
});

//manage users
Route::resource('users','UsersController');

//account settings
Route::get('account-settings', function(){
	$user = Auth::user();
	if($user -> subscribed()){
		$invoices = $user -> invoices();
		//retrieve the last invoice
		$lastInvoice = end($invoices);
		//last billing date
		$lastBillingDate = $lastInvoice -> dateString();
		//add 1 month or 1 day to the last billing date to make the upcoming billing date
		if($user -> onPlan('TANSponsoredPro')){
			$upcomingBillingDate = date(DateTime::COOKIE, strtotime("+1 month", strtotime($lastBillingDate)));
		}else if($user -> onPlan('OneDayTestPlan')){
			$upcomingBillingDate = date(DateTime::COOKIE, strtotime("+1 day", strtotime($lastBillingDate)));
		}
		
		return View::make('account-settings') -> with('user', $user)
			-> with('upcomingBillingDate', $upcomingBillingDate);
	}else{
		return View::make('account-settings') -> with('user', $user);
	}
	
});

//download the invoice
Route::get('download-invoice', function(){
	$user = Auth::user();
	$invoices = $user -> invoices();

	if(($invoiceCount=count($invoices))>0){
		return $user -> downloadInvoice($invoices[$invoiceCount-1] -> id, [
				'vendor' => 'Square Media',
				'product' => 'Top App Ninja Sponsored Pro'
			]);
	}else{
		return 'No invoice found';
	}
});

Route::get('cancel-subscription', function(){
	$user = Auth::user();
	$user -> subscription() -> cancel();
	return View::make('account-settings') -> with('user', $user);
});

Route::get('resume-subscription', function(){
	$user = Auth::user();
	$user -> subscription('TANSponsoredPro') -> resume();
	return View::make('account-settings') -> with('user', $user);
});

//handle failed payments
Route::post('webhook', 'MyWebhookController@handleWebhook');