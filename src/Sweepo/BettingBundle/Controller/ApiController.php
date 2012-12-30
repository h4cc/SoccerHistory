<?php

namespace Sweepo\BettingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ApiController extends Controller
{
    /**
     * @Route("/account/table/{username}", name="account_table", options={"expose"=true})
     * @Template()
     */
    public function tableAction($username)
    {
        // If the current user's username doesn't match username query
        // if ($this->getUser()->getUsername() !== $username) {

        //     throw $this->createNotFoundException("This page does not exist");
        // }

        return ['username' => $username];
    }
}
