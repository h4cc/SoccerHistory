<?php

namespace Sweepo\BettingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

use Sweepo\BettingBundle\Entity\Bet;
use Sweepo\BettingBundle\Form\BetType;

class DefaultController extends Controller
{
    /**
     * @Route("/bets", name="bets")
     * @Template()
     */
    public function betsAction(Request $request)
    {
        return [
            'stock' => $this->getUser()->getStock(),
        ];
    }

    /**
     * @Route("/bets/add", name="bets_add")
     * @Template()
     */
    public function betsAddAction(Request $request)
    {
        $bet = new Bet();

        $form = $this->createForm(new BetType($this->get('translator')), $bet);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {

                $data = $form->getData();
                $em = $this->getDoctrine()->getEntityManager();
                $bet->setUser($this->getUser());

                if (null !== $bet->getResult()) {
                    $gainLoss = $this->get('sweepo_betting.operations')->gainLoss($bet, $this->getUser()->getStock());
                    $bet->setGainLoss($gainLoss);

                    $profit = $this->get('sweepo_betting.operations')->profit($bet, $this->getUser()->getStock());
                    $bet->setProfit($profit);

                    $this->getUser()->setStock($this->getUser()->getStock() + $gainLoss);
                    $em->persist($this->getUser());
                }

                $em->persist($bet);
                $em->flush();

                return $this->redirect($this->generateUrl('bets'));
            }
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/bets/edit/{id}", name="bets_edit", options={"expose"=true})
     * @ParamConverter("bet", class="Sweepo\BettingBundle\Entity\Bet")
     * @Template()
     */
    public function betsEditAction(Request $request, Bet $bet)
    {
        $form = $this->createForm(new BetType($this->get('translator')), $bet);

        if ($request->isMethod('POST')) {

            $this->getUser()->setStock($this->getUser()->getStock() - $bet->getGainLoss());

            $form->bind($request);

            if ($form->isValid()) {

                $data = $form->getData();
                $em = $this->getDoctrine()->getEntityManager();
                $bet->setUser($this->getUser());

                if (null !== $bet->getResult()) {

                    $gainLoss = $this->get('sweepo_betting.operations')->gainLoss($bet, $this->getUser()->getStock());
                    $bet->setGainLoss($gainLoss);

                    $profit = $this->get('sweepo_betting.operations')->profit($bet, $this->getUser()->getStock());
                    $bet->setProfit($profit);

                    $this->getUser()->setStock($this->getUser()->getStock() + $gainLoss);
                    $em->persist($this->getUser());
                }

                $em->persist($bet);
                $em->flush();

                return $this->redirect($this->generateUrl('bets'));
            }
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/timeline", name="timeline")
     * @Template()
     */
    public function timelineAction(Request $request)
    {
        return ['ok' => 'ok'];
    }
}
