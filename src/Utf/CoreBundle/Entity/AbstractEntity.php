<?php
/**
 * Created by PhpStorm.
 * User: Pigcell
 * Date: 20/01/2019
 * Time: 16:10
 */

namespace Utf\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractEntity
 * @package Utf\CoreBundle\Entity
 */
class AbstractEntity {

    /**
     * AbstractEntity clone
     */
    public function __clone() {
        $this->id = null;
        $this->setDateCreated(new \DateTime());
    }


    /**
     * Identifiant autoincrémenté
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     * @var int
     */
    protected $id;

    /**
     * Date de création de l'entité
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    protected $dateCreated;

    /**
     * @return int
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated(): ?\DateTime {
        return $this->dateCreated;
    }

    /**
     * @param \DateTime $dateCreated
     */
    public function setDateCreated($dateCreated) {
        $this->dateCreated = $dateCreated;
    }
}