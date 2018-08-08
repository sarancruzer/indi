<?php

namespace App\Components;

use App\Dao\EmailTemplateDAO as EmailTemplateDAO;
use \App\Services\EmailSettingsService as EmailSettingsService;
use App\Response\ResponseHandler as ResponseHandler;
use \PHPMailer\PHPMailer\PHPMailer;


class MailComponent
{ 
	/* FETCING EMAIL CONFIGURATION DATA FROM DB AND SENDING EMAIL */
	public function sendEmail($slug,$to=false,$subject_replace=false,$message_replace=false,$attachment=false)
	{											  						
		$mail_config=$this->getEmailConfig($slug,'namuthukrishnan@enoahisolution.com',$subject_replace,$message_replace);
		//echo "<pre>";print_r($mail_config);
		if(!empty($mail_config) && isset($mail_config['to']) && !empty($mail_config['to']))
		{	
			$to_email = explode(',',trim($mail_config['to']));	
			$cc_email = explode(',',trim($mail_config['cc']));	
			$bcc_email = explode(',',trim($mail_config['bcc']));

			$mail = new PHPMailer();			
			$mail->IsMAIL();
			$mail->SMTPDebug  = 1;
			$mail->From = 'webmaster@enoahprojects.com';
			$mail->FromName = 'Indigenous Tours';
			
			$mail->addAddress($mail_config['to']);

			
			$mail->isHTML(true);

			$mail->Subject = $mail_config['subject'];
			$mail->Body = $mail_config['message'];
			if(!$mail->send()) 
			{
			echo "Mailer Error: " . $mail->ErrorInfo;
			} 
			else 
			{
			//echo "Message has been sent successfully";
			}																						

		}
	}
	
		/* FETCING EMAIL CONFIGURATION DATA FROM DB */

	public function getEmailConfig($slug,$to,$subject_replace,$message_replace)
	{
		$from_name = $from_email = $to_email = $cc_email = $bcc_email = $subject = $message = '';
		$email_template_dao = new EmailTemplateDAO();
		$email_settigs_service = new EmailSettingsService();
		$response_handler     = new ResponseHandler();
		$email_template = $email_template_dao->getEmailTemaplate($slug);

		if(is_array($email_template) && $email_template['result'] == 1 && is_array($email_template['template_detail']))
		{
			$template_detail = reset($email_template['template_detail']);
			$to_email	= $template_detail['toEmail'];
			$cc_email	= $template_detail['ccEmail'];
			$bcc_email	= $template_detail['bccEmail'];
			$subject	= $template_detail['emailSubject'];

			// To replace subject content
			if($subject_replace)
			{
				$search = array();
				$replace = array();
				foreach($subject_replace as $k => $v) {
					$search[] = '{{' . $k . '}}';
					$replace[] = $v;
				}
				$subject = str_replace($search, $replace, $subject);
			}

			$message=$template_detail['emailMessage'];
			if($message_replace){
				$search = array();
				$replace = array();
				foreach($message_replace as $k => $v) {
					$search[] = '{{' . $k . '}}';
					$replace[] = $v;
				}
				$message = str_replace($search, $replace, $message);
			}

			if($to)
			{
				$to_email=$to;
			}
		}
		$email_settigs = $email_settigs_service->getEmailSettings();
		$email_settigs_response = $response_handler->decode_response($email_settigs);

		if(is_array($email_settigs_response) && $email_settigs_response['status'] == '' ){ //is_array($email_settings)
			$email_settings = $email_settigs_response['settings'];
			$from_name = 'Indigenous Tours';			
		 	$from_email = 'webmaster@enoahprojects.com';
		}

		$config=array('from_name'=>$from_name,'from_email'=>$from_email,'to'=>$to_email,'cc'=>$cc_email,'bcc'=>$bcc_email,'subject'=>$subject,'message'=>$message);
		return $config;
	}
}
?>
