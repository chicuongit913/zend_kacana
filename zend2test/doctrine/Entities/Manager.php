<?php
namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pages
 *
 * @ORM\Table(name="manager")
 * @ORM\Entity(repositoryClass="Repositories\ManagerRepository")
 */
class Manager
{
	/**
	 * @var integer $username
	 *
	 * @ORM\Column(name="username", type="string", length= 200, nullable=false)
	 * @ORM\Id
	 */
	private $username;

	/**
	 * @var string $password
	 *
	 * @ORM\Column(name="password", type="string", length = 200, nullable=false)
	 */
	private $password;
	/**
	 * @return the $username
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * @param integer $username
	 */
	public function setUsername($username) {
		$this->username = $username;
	}

	/**
	 * @return the $password
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @param string $password
	 */
	public function setPassword($password) {
		$this->password = $password;
	}

	
}