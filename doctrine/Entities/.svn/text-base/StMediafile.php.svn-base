<?php
namespace Entities;


use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="mediafile")
 * @ORM\Entity(repositoryClass="Repositories\MediafileRepository")
 */
class StMediafile
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var StMediafolder
     *
     * @ORM\ManyToOne(targetEntity="StMediafolder")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="folderid", referencedColumnName="id")
     * })
     */
    private $folderid;
    
    /**
     * @var string $type
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;
    
	/**
	 * @return the $type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param string $type
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return the $folderid
	 */
	public function getFolderid() {
		return $this->folderid;
	}

	/**
	 * @param number $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param \Entities\StMediafolder $folderid
	 */
	public function setFolderid($folderid) {
		$this->folderid = $folderid;
	}

	public function toArray()
	{
		return get_object_vars($this);
	}
}
