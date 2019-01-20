<?php

namespace Utf\WikiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UtfWikiBundle:Default:index.html.twig');
    }
}
