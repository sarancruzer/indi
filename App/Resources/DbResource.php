<?php
namespace App\Resources;

//db constants
//require __DIR__ . '/../../common/config/config.php';

define("STATUS_ACTIVE",1);
define("STATUS_ZERO",0);
define("EMAIL_PARTICIPANT",1);
define("DB_DRIVER",'pdo_mysql');
define("DB_HOST",'localhost');
define("DB_NAME",'indigenous_tour');
define("DB_USERNAME",'root');
define("DB_PASSWORD",'');
//define("DB_NAME",'dev7_ indigenous_tour');
//define("DB_USERNAME",'dev7_indi_tour');
//define("DB_PASSWORD",'wtxET2gIfCRd8tzP');
defined('SITE_URL') || define('SITE_URL',"http://projects.enoahprojects.com/indigenous_tour/portal"); //site url for differnt servers

//random digit length
define("RANDOM_DIGIT_COUNT",6);
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
/**
* Class DbResource
* @package App
* Abstract Class used by all other classes
*/
abstract class DbResource{
	/**
	* @var \Doctrine\ORM\EntityManager
	*/
	protected $entityManager = null;
	/**
	*  @param 
	*  @constructor to initialization of objects
	*/
	public function __construct(){
		$entitypath = [
		'../Entities'
		];
		// DB User Name, Password
		$db_config = array('driver' => DB_DRIVER,'host'=> DB_HOST,'dbname'=>DB_NAME,'user'=> DB_USERNAME,'password' => DB_PASSWORD);
		$setup = new Setup();
		$config = $setup->createAnnotationMetadataConfiguration($entitypath, false, null, null, false);
		$entityManager = $this->getConnection($db_config, $config);
		$this->entityManager = $entityManager;
	}
	
	
	/**
	*  @param db_config,config
	*  @DB connection created
	*/
	private static function getConnection($db_config, $config){
	
		try{
			// DB connection created
			return \Doctrine\ORM\EntityManager::create($db_config, $config);
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}

}
