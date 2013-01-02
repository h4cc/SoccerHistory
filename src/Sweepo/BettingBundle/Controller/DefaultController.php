<?php

namespace Sweepo\BettingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Sweepo\BettingBundle\Entity\Bet;
use Sweepo\BettingBundle\Form\BetType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $user = $this->getUser();
        $bet = new Bet();

        $form = $this->createForm(new BetType($this->get('translator')), $bet);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {

                $data = $form->getData();
                die(var_dump($data));
            }
        }

        return [
            'user' => $user,
            'form' => $form->createView(),
        ];
    }
}
