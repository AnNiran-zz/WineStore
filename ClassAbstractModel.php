<?php
namespace Winestore\Models;
use PDO;
abstract class AbstractModel {
	private $db;
	
	public function __construct(PDO $db) {
		$this->db = $db;
	}
}
# all models extend from this class;
?>
