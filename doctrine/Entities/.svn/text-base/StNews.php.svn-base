<?php
namespace Entities;


use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="news")
 * @ORM\Entity(repositoryClass="Repositories\NewsRepository")
 */
class StNews
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
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

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
	 * @return the $id
	 */
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
     * @var StUser
     *
     * @ORM\ManyToOne(targetEntity="StUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="createdby", referencedColumnName="id")
     * })
     */
    private $createdby;
    
    /**
     * @var StUser
     *
     * @ORM\ManyToOne(targetEntity="StUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="updatedby", referencedColumnName="id")
     * })
     */
    private $updatedby;
    
	/**
	 * @return the $createdby
	 */
	public function getCreatedby() {
		return $this->createdby;
	}

	/**
	 * @return the $updatedby
	 */
	public function getUpdatedby() {
		return $this->updatedby;
	}

	/**
	 * @return the $nametr
	 */
	public function getNametr() {
		return $this->nametr;
	}

	/**
	 * @param \Entities\StUser $createdby
	 */
	public function setCreatedby($createdby) {
		$this->createdby = $createdby;
	}

	/**
	 * @param \Entities\StUser $updatedby
	 */
	public function setUpdatedby($updatedby) {
		$this->updatedby = $updatedby;
	}

	/**
	 * @param \Entities\StContent $nametr
	 */
	public function setNametr($nametr) {
		$this->nametr = $nametr;
	}

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

	public function getId() {
		return $this->id;
	}

	/**
	 * @param integer $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return the $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @return the $content
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @param string $content
	 */
	public function setContent($content) {
		$this->content = $content;
	}

	/**
	 * @return the $created
	 */
	public function getCreated() {
		return $this->created;
	}

	/**
	 * @param integer $created
	 */
	public function setCreated($created) {
		$this->created = $created;
	}
	
	public function toArray()
	{
		return get_object_vars($this);
	}
}
