# Android Marketplace API (PHP)

## Overview

This is a PHP implementation of the [Java Android Market API](http://code.google.com/p/android-market-api/). Used to connect to the Android Marketplace using PHP.

#### Setting Up your Account
We have seen numerous blocks from Google this is where you get a return for a 403/400 error. The best way to deal with this is to sleep between requests. Where we have seen library working on localhost then on a server not connecting is due to Google showing captcha. Please enable two-factor authentication for your Google Account (or use an other Google Account) then create an application password. Use the application password in the local.php file for connecting to Google. If your still getting blocks please use the captcha overide by using the following url logged in on the same Google Account on your Desktop [Google Unlock Captcha](https://accounts.google.com/DisplayUnlockCaptcha) 

#### Examples
* Category Search
* Pulling App Detailed Data (Screenshot)
* Normal Search (Keyword)
* Top Apps Search

For examples please read the examples avalible on the [wiki](https://github.com/splitfeed/android-market-api-php/wiki)

#### Issues
For Issues please use the Github Issues [page](https://github.com/splitfeed/android-market-api-php/issues). Alternativley you can also talk to other developers on the Google Groups [page](https://groups.google.com/forum/#!forum/android-market-api-php)

## Credits & Licence

#### Credits
[JAVA Android Marketplace API](https://code.google.com/p/android-market-api/)
[Protoc Gen PHP](https://github.com/bramp/protoc-gen-php)

#### Licence
GNU GPL v2.0
