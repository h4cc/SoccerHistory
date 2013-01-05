<?php

namespace Sweepo\BettingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;

use Sweepo\BettingBundle\Entity\Bet;

/**
 * @Route("/bets")
 */
class ApiController extends Controller
{
    /**
     * @Route("/table", name="bets_table", options={"expose"=true})
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

    /**
     * @Route("/get/{id}", name="bets_get", options={"expose"=true})
     * @ParamConverter("bet", class="Sweepo\BettingBundle\Entity\Bet")
     * @Template()
     */
    public function getBetAction(Bet $bet)
    {
        return $this->get('sweepo_core.apiresponse')->jsonSerializerResponse($bet);
    }
}
