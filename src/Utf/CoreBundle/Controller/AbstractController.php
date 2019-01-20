<?php
/**
 * Created by PhpStorm.
 * User: Pigcell
 * Date: 20/01/2019
 * Time: 14:32
 */

namespace Utf\CoreBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AbstractController extends Controller {

    /**
     * @var array
     */
    protected $additionnalParameters = array();

    /**
     * Overwrite de la méthode render
     * @param string $view
     * @param array $parameters
     * @param Response|null $response
     * @return string|Response
     */
    public function render($view, array $parameters = array(), Response $response = null) {

        // Merge des paramètres
        $this->addCustomParameters();
        $parameters = array_merge($parameters, $this->additionnalParameters);

        return parent::render($view, $parameters, $response);
    }

    /**
     * Ajout des paramètres custom à la vue
     */
    protected function addCustomParameters() {
        //$this->additionnalParameters['download'] = $download;
    }


}