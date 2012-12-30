<?php

namespace Sweepo\BettingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/account/{username}")
     * @Template()
     */
    public function accountAction($username)
    {
        // If the current user's username doesn't match username query
        if ($this->getUser()->getUsername() !== $username) {

            throw $this->createNotFoundException("This page does not exist");
        }

        return array('username' => $username);
    }
}
