<?php
namespace App\Dao;

use App\Entities;
use App\Resources\DbResource as DbResource;

/**
* Class EmailTemplateDAO
* @package App\Dao
* Dao class for email template management
*/

class EmailTemplateDAO extends DbResource
{
	public function getEmailTemaplate($slug)
	{
		try{
			$query = $this->entityManager->createQueryBuilder()->select('e')
			->from('App\Entities\EmailTemplate', 'e')			
			->Where('e.emailSlug=:slug')->setParameter('slug', $slug)
			->andWhere('e.status=:status')->setParameter('status', 1); // Get Active Status Template
			$query = $query->getQuery();

			$template_detail = $query->getArrayResult();
			return array('result'=>1,'template_detail' => $template_detail,'errorDescription'=>'');
		}catch(Exception $e) {
			return array('result'=>0,'template_detail' => '','errorDescription'=>'Invalid Link');
		}
	}
}
