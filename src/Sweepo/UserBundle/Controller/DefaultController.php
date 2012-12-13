<?php

namespace Sweepo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Sweepo\UserBundle\Entity\User;

class DefaultController extends Controller
{
    /**
     * @Route("/prout")
     * @Template()
     */
    public function proutAction()
    {
        die(var_dump($this->getUser()));
    }
}
