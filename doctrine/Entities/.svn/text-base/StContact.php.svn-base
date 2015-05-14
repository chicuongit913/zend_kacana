<?php
namespace Entities;


use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="Repositories\ContactRepository")
 */
class StContact
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
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string $content
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content;

    /**
     * @var integer $created
     *
     * @ORM\Column(name="created", type="integer", nullable=false)
     */
    private $created;
    
    /**
     * @var integer $updated
     *
     * @ORM\Column(name="updated", type="integer", nullable=false)
     */
    private $updated;
    
    /**
     * @var integer $status
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;
    
    /**
     * @var integer $priority
     *
     * @ORM\Column(name="priority", type="integer", nullable=false)
     */
    private $priority;
	/**
	 * @return the $updated
	 */
	public function getUpdated() {
		return $this->updated;
	}

	/**
	 * @return the $status
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @return the $priority
	 */
	public function getPriority() {
		return $this->priority;
	}

	/**
	 * @param number $updated
	 */
	public function setUpdated($updated) {
		$this->updated = $updated;
	}

	/**
	 * @param number $status
	 */
	public function setStatus($status) {
		$this->status = $status;
	}

	/**
	 * @param number $priority
	 */
	public function setPriority($priority) {
		$this->priority = $priority;
	}

	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @return the $content
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @return the $created
	 */
	public function getCreated() {
		return $this->created;
	}

	/**
	 * @param number $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param string $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @param string $content
	 */
	public function setContent($content) {
		$this->content = $content;
	}

	/**
	 * @param number $created
	 */
	public function setCreated($created) {
		$this->created = $created;
	}

	public function toArray()
	{
		return get_object_vars($this);
	}

}
