<?php
namespace Winestore\Models;

use Winestore\Domain\Wine;
use Winestore\Exceptions\DbException;
use Winestore\Exceptions\NotFoundException;
use PDO;

class WineModel extends AbstractModel {
	const CLASSNAME = '\Winestore\Domain\Book';
	
	public function get(int $itemId): Wine {
		$query = 'SELECT * FROM wine WHERE id = :id';
		$sth = $this->db->prepare($query);
		$sth->execute(['id' => $itemId]);
		
		$items = $sth->fetchAll(
		PDO::FETCH_CLASS, self::CLASSNAME
	);
	if (empty($items)) {
		throw new NotFoundException();
	}
	return $items[0];
	# 	a get method, that feches an object of class Wine, provided an Id;
	}
	
	public function soldToUser(int $userId): array {
		$query = <<SQL
			SELECT s.*
				FROM sold_wines sw LEFT JOIN wine w ON sw.wine_id = w.id
					WHERE sw.customer_id = :id
						SQL;
		$sth = $this->db->prepare($query);
		$sth->execute(['id' => $userId]);
		return $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);
	# returns a lits of all wine items sold to a specific user;
	}
	
	public function search(string $name, string $resource, int $vintage_year): array {
		$query = <<SQL
			SELECT * FROM wine
				WHERE name LIKE :name AND resource LIKE :resource AND vintage LIKE :vintage_year
					SQL;
		$sth = $this->db->prepare($query);
		$sth->bindValue('name', "%$name%");
		$sth->bindValue('resource', "%$resource%");
		$sth->bindValue('vintage', "%$vintage_year%");
		$sth->execute();
		return $sth->fetchAll(PDO::FETCH_CLASS, self::CLASSNAME);
	}
	# returns a result from a search by name, vintage year or a resource;
}

?>
