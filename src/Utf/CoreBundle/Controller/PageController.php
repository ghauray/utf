<?php
/**
 * Created by PhpStorm.
 * User: Pigcell
 * Date: 20/01/2019
 * Time: 15:07
 */

namespace Utf\CoreBundle\Controller;


/**
 * Class PageController
 * @package Utf\CoreBundle\Controller
 */
class PageController extends AbstractController {

    /**
     *
     */
    public function homepageAction() {


        return $this->render("@UtfCore/Page/Homepage/homepage.html.twig");
    }
}