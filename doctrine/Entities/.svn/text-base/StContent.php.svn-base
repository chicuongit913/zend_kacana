<?php
namespace Entities;


use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="Content")
 * @ORM\Entity(repositoryClass="Repositories\ContentRepository")
 */
class StContent
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
     * @var string $en
     *
     * @ORM\Column(name="en", type="text", nullable=false)
     */
    private $en;
    
    /**
     * @var string $vi
     *
     * @ORM\Column(name="vi", type="text", nullable=false)
     */
    private $vi;
    
    /**
     * @var string $fr
     *
     * @ORM\Column(name="fr", type="text", nullable=false)
     */
    private $fr;
    
    /**
     * @var string $ja
     *
     * @ORM\Column(name="ja", type="text", nullable=false)
     */
    private $ja;
    
    /**
     * @var string $de
     *
     * @ORM\Column(name="de", type="text", nullable=false)
     */
    private $de;

   
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $en
	 */
	public function getEn() {
		return $this->en;
	}

	/**
	 * @return the $vi
	 */
	public function getVi() {
		return $this->vi;
	}

	/**
	 * @return the $fr
	 */
	public function getFr() {
		return $this->fr;
	}

	/**
	 * @return the $ja
	 */
	public function getJa() {
		return $this->ja;
	}

	/**
	 * @return the $de
	 */
	public function getDe() {
		return $this->de;
	}

	/**
	 * @param number $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param string $en
	 */
	public function setEn($en) {
		$this->en = $en;
	}

	/**
	 * @param string $vi
	 */
	public function setVi($vi) {
		$this->vi = $vi;
	}

	/**
	 * @param string $fr
	 */
	public function setFr($fr) {
		$this->fr = $fr;
	}

	/**
	 * @param string $ja
	 */
	public function setJa($ja) {
		$this->ja = $ja;
	}

	/**
	 * @param string $de
	 */
	public function setDe($de) {
		$this->de = $de;
	}

	public function toArray()
	{
		return get_object_vars($this);
	}
}
