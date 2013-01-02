<?php

namespace Sweepo\BettingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ApiController extends Controller
{
    /**
     * @Route("/table", name="table", options={"expose"=true})
     * @Template()
     */
    public function tableAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $this->getUser();

        $bets = $em->getRepository('SweepoBettingBundle:Bet')->findBy(['user' => $user]);

        return [
            'user' => $user,
            'bets' => $bets,
        ];
    }
}
