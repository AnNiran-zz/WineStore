<?php
	
namespace Winestore\Models;

use Winestore\Domain\Customer;
use Winestore\Domain\Customer\CustomerFactory;
use Winestore\Exceptions\NotFoundExcetion;

class CustomerModel extends AbstractModel {
	public function get(int $userId): Customer {
		$query = 'SELECT * FROM customer WHERE customer_id = :user';
		$sth = $this->db->prepare($query);
		$sth->execute(['user' => $userId]);
		
		$row = $sth->fetch();
		
		if (empty($row)) {
			throw new NotFoundException();
		}
		return CustomerFactory::factory(
		$row['type'],
		$row['id'],
		$row['firstname'],
		$row['surname'],
		$row['email']
	);
	}
	# returns a customer instance, providing ID;

	public function getByEmail(string $email): Customer {
		$query = 'SELECT * FROM customer WHERE email = :user';
		$sth = $this->db->prepare($query);
		$sth->execute(['user' => $email]);
		# prepare the statement with the given query and fetch the result;
		$row = $sth->fetch();
		if (empty($row)) {
			throw new NotFoundException();
		}
		return CustomerFactory::factory(
		$row['type'],
		$row['id'],
		$row['firstname'],
		$row['surname'],
		$row['email']
	);
    }
}
# returns a customer instance, providing e-mail;

?>
