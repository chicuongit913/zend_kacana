<?php
namespace Entities;


use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Repositories\UserRepository")
 */
class StUser
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
	
    /**
     * @var string $username
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;
    
    /**
     * @var string $displayname
     *
     * @ORM\Column(name="displayname", type="string", length=255, nullable=false)
     */
    private $displayname;
    
    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;
	
    /**
     * @var string $pass
     *
     * @ORM\Column(name="pass", type="string", length=255, nullable=false)
     */
    private $pass;
    
    /**
     * @var string $level
     *
     * @ORM\Column(name="level", type="string", length=255, nullable=false)
     */
    private $level;
    
    /**
     * @var integer $status
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;
    
	/**
	 * @return the $status
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @param number $status
	 */
	public function setStatus($status) {
		$this->status = $status;
	}

	/**
	 * @return the $level
	 */
	public function getLevel() {
		return $this->level;
	}

	/**
	 * @param string $level
	 */
	public function setLevel($level) {
		$this->level = $level;
	}

	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $username
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * @return the $displayname
	 */
	public function getDisplayname() {
		return $this->displayname;
	}

	/**
	 * @return the $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @return the $pass
	 */
	public function getPass() {
		return $this->pass;
	}

	/**
	 * @param number $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param string $username
	 */
	public function setUsername($username) {
		$this->username = $username;
	}

	/**
	 * @param string $displayname
	 */
	public function setDisplayname($displayname) {
		$this->displayname = $displayname;
	}

	/**
	 * @param string $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @param string $pass
	 */
	public function setPass($pass) {
		$this->pass = $pass;
	}

	public function toArray()
	{
		return get_object_vars($this);
	}

}
