# Android Marketplace API (PHP)

## Overview

This is a PHP implementation of the [Java Android Market API](http://code.google.com/p/android-market-api/). Used to connect to the Android Marketplace (Google Play Store) using PHP. This is an un-official API as an official API currently dose not exist. 

***

#### Connection Settings & Connection Issues
How to edit the local.php file for Google Account and Device ID, please read the following points below.
###### Google Account
We have seen numerous blocks from Google this is where you get a return for a 403/400 error. The best way to deal with this is to sleep between requests. Where we have seen library working on localhost then on a server not connecting is due to Google showing captcha.

###### Captcha
Please [enable two-factor authentication](https://www.google.com/landing/2step/) for your Google Account (or use an other Google Account) then create an application password. Use the application password in the local.php file for connecting to Google. If your still getting blocks please use the captcha overide by using the following url logged in on the same Google Account on your Desktop [Google Unlock Captcha](https://accounts.google.com/DisplayUnlockCaptcha)

###### Android Device ID
The android device ID can easily be found using thrid-party applications like [Device ID - Google Play Store](https://play.google.com/store/apps/details?id=com.evozi.deviceid&hl=en)

***

#### Examples Provided
* Category Search
* Pulling App Detailed Data (Screenshot)
* Normal Search (Keyword)
* Top Apps Search

For examples please read the examples avalible on the [wiki](https://github.com/splitfeed/android-market-api-php/wiki)

#### Issues & Bug's
For Issues please use the [Github Issues Page](https://github.com/splitfeed/android-market-api-php/issues).

Alternativley you can also talk to other developers on the [Google Groups Page](https://groups.google.com/forum/#!forum/android-market-api-php)

***

## Credits & Licence

#### Credits
[JAVA Android Marketplace API](https://code.google.com/p/android-market-api/)

[Protoc Gen PHP](https://github.com/bramp/protoc-gen-php)

#### Licence
GNU GPL v2.0
