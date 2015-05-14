<?php
namespace Entities;


use Doctrine\ORM\Mapping as ORM;

/**
 * Pages
 *
 * @ORM\Table(name="page")
 * @ORM\Entity(repositoryClass="Repositories\PageRepository")
 */
class StPage
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
     * @var StContent
     *
     * @ORM\ManyToOne(targetEntity="StContent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="title", referencedColumnName="id")
     * })
     */
    private $title;
    
    /**
     * @var StContent
     *
     * @ORM\ManyToOne(targetEntity="StContent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="desc", referencedColumnName="id")
     * })
     */
    private $desc;
    
    /**
     * @var StContent
     *
     * @ORM\ManyToOne(targetEntity="StContent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="keyword", referencedColumnName="id")
     * })
     */
    private $keyword;
    
    /**
     * @var StContent
     *
     * @ORM\ManyToOne(targetEntity="StContent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="metakey", referencedColumnName="id")
     * })
     */
    private $metakey;
    
    /**
     * @var StContent
     *
     * @ORM\ManyToOne(targetEntity="StContent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="metadesc", referencedColumnName="id")
     * })
     */
    private $metadesc;

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
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @return the $desc
	 */
	public function getDesc() {
		return $this->desc;
	}

	/**
	 * @return the $keyword
	 */
	public function getKeyword() {
		return $this->keyword;
	}

	/**
	 * @return the $metakey
	 */
	public function getMetakey() {
		return $this->metakey;
	}

	/**
	 * @return the $metadesc
	 */
	public function getMetadesc() {
		return $this->metadesc;
	}

	/**
	 * @return the $created
	 */
	public function getCreated() {
		return $this->created;
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
	 * @param number $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param \Entities\StContent $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @param \Entities\StContent $desc
	 */
	public function setDesc($desc) {
		$this->desc = $desc;
	}

	/**
	 * @param \Entities\StContent $keyword
	 */
	public function setKeyword($keyword) {
		$this->keyword = $keyword;
	}

	/**
	 * @param \Entities\StContent $metakey
	 */
	public function setMetakey($metakey) {
		$this->metakey = $metakey;
	}

	/**
	 * @param \Entities\StContent $metadesc
	 */
	public function setMetadesc($metadesc) {
		$this->metadesc = $metadesc;
	}

	/**
	 * @param number $created
	 */
	public function setCreated($created) {
		$this->created = $created;
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

	public function toArray()
    {
    	return get_object_vars($this);
    }
    
}
