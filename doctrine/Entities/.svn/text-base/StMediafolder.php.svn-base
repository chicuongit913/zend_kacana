<?php
namespace Entities;


use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="mediafolder")
 * @ORM\Entity(repositoryClass="Repositories\MediafolderRepository")
 */
class StMediafolder
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
     * @ORM\Column(name="`name`", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var integer $parent
     *
     * @ORM\Column(name="parent", type="integer", nullable=false)
     */
    private $parent;
	
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
	 * @return the $parent
	 */
	public function getParent() {
		return $this->parent;
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
	 * @param number $parent
	 */
	public function setParent($parent) {
		$this->parent = $parent;
	}

	public function toArray()
	{
		return get_object_vars($this);
	}
}
