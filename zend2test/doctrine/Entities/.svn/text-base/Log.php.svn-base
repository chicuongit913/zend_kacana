<?php
namespace Entities;


use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="log")
 * @ORM\Entity(repositoryClass="Repositories\LogRepository")
 */
class Log
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
     * @var string $action
     *
     * @ORM\Column(name="action", type="string", length=100, nullable=false)
     */
    private $action;

    /**
     * @var string $updated
     *
     * @ORM\Column(name="updated", type="integer", nullable=true)
     */
    private $updated;

    /**
     * @var integer $times
     *
     * @ORM\Column(name="times", type="integer", nullable=true)
     */
    private $times;
    
	/**
	 * @return the $id
	 */
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
	 * @return the $action
	 */
	public function getAction() {
		return $this->action;
	}

	/**
	 * @param string $action
	 */
	public function setAction($action) {
		$this->action = $action;
	}

	/**
	 * @return the $updated
	 */
	public function getUpdated() {
		return $this->updated;
	}

	/**
	 * @param string $updated
	 */
	public function setUpdated($updated) {
		$this->updated = $updated;
	}

	/**
	 * @return the $times
	 */
	public function getTimes() {
		return $this->times;
	}

	/**
	 * @param integer $times
	 */
	public function setTimes($times) {
		$this->times = $times;
	}

    
    
}
