cfBlockCountry (Plugin)

An modified version from CodeFire Technologies cfBlockCountry plugin.
This plugin installs in Joomla v3.1+ versions.


The plugin cfBlockCountry can be used to block IP address from certain countries. For example if you want to block access of the site from any IP in United States you can use this plugin.

Added feature: 
- this version ONLY checks the backend of your site. This is contrary to the original plugin.
- you now can have allowed or denied country codes. Sometimes you just want to block all countries and only allow your country access to the administration page.  

Some important points:

1.	It only blocks access to the admin interface and not to the website. Just be sure not to lock out yourself! 
2.	We use free DB from MaxMind (http://www.maxmind.com/app/geolitecountry). As per the MaxMind this DB is 99.5% accurate.
3.	There are 2 options in the plugin, if you want to use geoip database from local server, you can select the Local option after installing the plugin. But before you select local option please upload geoip folder in the plugin zip file to /libraries/ folder of joomla installation. If this operation is not performed and local option is selected this will cause error on Joomla and you may not be able to access joomla site unless plugin is disabled from DB.
4.	The benefit of choosing local option is that you can buy the latest more accurate DB from http://www.maxmind.com/ and use that DB

Configuration:

1.	Allowed Country Codes: This requires comma (,) separated list of Country codes that are allowed. For example US, IN, FR to block IP Address from United States, India and France. If this field is empty, all countries in denied country codes are blocked. If both fields are empty, all countries are allowed. If the same country is entered in both fields, the allowed country code field has precedence. Enter your country code not to lock yourself out!

2.	Denied Country Codes: This requires comma (,) separated list of Country codes that need to be blocked. For example US, IN, FR to block IP Address from United States, India and France. If this field is empty and country code are entered in the allowed country code field, all countries are blocked except those entered in the allowed field. 

3.	Verification: External (default) or Local. External will use CodeFire.in Server to validate the country. We use latest Free DB from MaxMind http://www.maxmind.com/app/geolitecountry. In case you want to use local Verification you will need to install the geoip DB on your server. Please do not enable Local without installing the DB. (Refer below for installing the DB)


4.	Message or Redirect: In case a user from blocked country accesses the site, you can display an error message or redirect them to some other site.

5.	Text Message: This is the error message that will be displayed.


6.	Site: You need to set url for the site where you want to redirect the user example http://www.CodeFire.in

Install GeoIP DB for local option.

1.	Extract the geoip folder from the plugin zip.
2.	Upload the folder geoip to libraries/ folder of Joomla installation
3.	Get the latest GeoIP.dat from http://www.maxmind.com/app/geolitecountry. and replace the existing (blank file with same name)one in /library/geoip folder
4.	Enable Local option in plugin settings.