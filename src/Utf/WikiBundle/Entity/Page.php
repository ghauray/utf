<?php
/**
 * Created by PhpStorm.
 * User: Pigcell
 * Date: 20/01/2019
 * Time: 16:12
 */

namespace Utf\WikiBundle\Entity;

use Utf\CoreBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Page
 * @package Utf\WikiBundle\Entity
 * @ORM\Entity(repositoryClass="Utf\WikiBundle\Repository\PageRepository")
 * @ORM\Table(name="page")
 */
class Page extends AbstractEntity {

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $content;

    /**
     * @return string
     */
    public function getTitle(): ?string {
        return $this->title;
    }
    /**
     * @param string $title
     */
    public function setTitle($title): void {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent(): ?string {
        return $this->content;
    }
    /**
     * @param string $content
     */
    public function setContent($content): void {
        $this->content = $content;
    }
}