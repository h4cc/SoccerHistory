<?php

namespace Sweepo\BettingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Sweepo\BettingBundle\Entity\Bet;

/**
 * @Route("/bets")
 */
class ApiController extends Controller
{
    /**
     * @Route("/table/{filter}", defaults={"filter": "date"}, name="bets_table", options={"expose"=true})
     * @Template()
     */
    public function tableAction($filter)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $this->getUser();

        $bets = $em->getRepository('SweepoBettingBundle:Bet')->findForTable($user,$filter);

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
