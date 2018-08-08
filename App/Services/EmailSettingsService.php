<?php
namespace App\Services;

use App\Response\ResponseHandler as ResponseHandler;
use App\Response\JsonHandler as JsonHandler;
use App\Response\XmlHandler as XmlHandler;

use App\Dao\EmailSettingsDAO as EmailSettingsDAO;


/**
* Class EmailSettingsService
* @package App\Services
* Service class for email template
*/
class EmailSettingsService
{
	public function getEmailSettings()
	{
		$settings=array();
		$email_settings_dao = new EmailSettingsDAO();
		$response = new ResponseHandler();
		$get_email_settings = $email_settings_dao->getEmailSettings();

		if(is_array($get_email_settings) && $get_email_settings['result'] ==1)
		{
			$email_settings = reset($get_email_settings['email_setting_detail']);

			$settings['from_name']   = $email_settings['fromName'];
			$settings['from_email']  = $email_settings['fromEmail'];
			$settings['group_email'] = $email_settings['groupEmail'];
			$settings['admin_email'] = $email_settings['adminEmail'];

			return $response->encode_response(['status' => 'success', 'settings' => $settings,'message' => '']);
		}
		else
			return $response->encode_response(['status' => 'failure', 'settings' => '','message' => 'Settings not found']);
	}
}
