<?php
/**
 * Created by PhpStorm.
 * User: Pigcell
 * Date: 20/01/2019
 * Time: 15:20
 */

namespace Utf\WikiBundle\Controller;


use Utf\CoreBundle\Controller\AbstractController;

/**
 * Class WikiController
 * @package Utf\WikiBundle\Controller
 */
class WikiController extends AbstractController {

    public function homepageAction() {
        return $this->render("@UtfWiki/wiki-homepage.html.twig");
    }
}