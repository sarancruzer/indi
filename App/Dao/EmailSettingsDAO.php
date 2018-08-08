<?php
namespace App\Dao;

use App\Entities;
use App\Resources\DbResource as DbResource;

/**
* Class EmailSettingsDAO
* @package App\Dao
* Dao class for email template management
*/

class EmailSettingsDAO extends DbResource
{
	public function getEmailSettings()
	{
		try{
			$query = $this->entityManager->createQueryBuilder()->select('e')
			->from('App\Entities\EmailSettings', 'e');
			$query = $query->getQuery();

			$email_setting_detail = $query->getArrayResult();
			return array('result'=>1,'email_setting_detail' => $email_setting_detail,'errorDescription'=>'');
		}catch(Exception $e) {
			return array('result'=>0,'email_setting_detail' => '','errorDescription'=> $e->getMessage());
		}
	}
}
