<?php

namespace Utf\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UtfCoreBundle:Default:index.html.twig');
    }
}
