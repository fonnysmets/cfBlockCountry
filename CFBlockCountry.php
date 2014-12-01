<?php
/**
* @version		cfBlockCountry.php  1.0.2
* @package		Joomla
* @copyright	Copyright (C) 2014
* The code has been written by www.CodeFire.in in case of any questions please contact joomla@codefire.in
* Modified to work with Joomla v3+ by fonny
* @license		GNU/GPL, see LICENSE.php
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

/**
 * @package		Joomla
 * @subpackage	System
 */
class  plgSystemCFBlockCountry extends JPlugin
{
	protected $autoloadLanguage = true;
	
	function onAfterDispatch() {

        if ( !JFactory::getApplication()->isAdmin() ) return false;

        $plugin = JPluginHelper::getPlugin( 'system', 'CFBlockCountry' );

        $blockedCountryCodes    = $this->params->get( 'countrydeny', '' );
        $allowedCountryCodes    = $this->params->get( 'countryallow', '' );
        $textMsgForBlocked      = $this->params->get( 'blockedText', 	'' );
        $option                 = $this->params->get( 'show_msg', 0 );
        $site                   = $this->params->get( 'site', 	'' );
        $external               = $this->params->get( 'external', 	1 );
        $country = '';
        if(!$external){        
            $country = $this->getCountryCodeByIP();
        }
        else{
            $country = $this->externalCall();
        }
  
        if (strpos($allowedCountryCodes,$country) !== false) return true;
		
		if ($allowedCountryCodes !== '' && $blockedCountryCodes == '' || $country == $blockedCountryCodes) {
			if($option == 0)
			{
				echo $textMsgForBlocked;
				exit;
			}else{
				if(isset($site) && $site != '')
					header("Location: $site");
				exit;
			}		
		}		
	} 

    
    function getCountryCodeByIP(){
        require(dirname(__FILE__).'/geoip/geoip.inc');
        $gi = geoip_open(dirname(__FILE__)."/geoip/GeoIP.dat",GEOIP_STANDARD);
        $country = array();
        //bug fixed 30 June 2010
        //$country['code'] = geoip_country_code_by_addr($gi, $_SERVER['REMOTE_ADDR']);
        //$country['name'] =geoip_country_name_by_addr($gi, $_SERVER['REMOTE_ADDR']);
        $country = geoip_country_code_by_addr($gi, $_SERVER['REMOTE_ADDR']);
        geoip_close($gi);
        return  $country;

    }

    function externalCall(){
        define('POSTURL', 'http://joomla.codefiretechnologies.com/apps/geoip/index.php');
        define('POSTVARS', 'ip=');  
        $ip =  $_SERVER['REMOTE_ADDR'];
        $ch = curl_init(POSTURL);
        curl_setopt($ch, CURLOPT_POST ,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS    ,POSTVARS.$ip);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,0);
        curl_setopt($ch, CURLOPT_HEADER      ,0);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);  
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;

    }

}
