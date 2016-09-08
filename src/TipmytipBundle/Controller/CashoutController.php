<?php

namespace TipmytipBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use TipmytipBundle\Entity\Cashout;
use TipmytipBundle\Form\CashoutType;

/**
 * Cashout controller.
 *
 * @Route("/cash-out")
 */
class CashoutController extends Controller
{

    /**
     * Creates a new Cashout entity.
     *
     * @Route("/new", name="cash-out_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cashout = new Cashout();
        $form = $this->createForm('TipmytipBundle\Form\CashoutType', $cashout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            // Back-end datas set
            $cashout->setCurrency('€');
            $cashout->setFee('17');
            // User : to change when log set
            $user = $em->getRepository('TipmytipBundle:User')->findOneBy(array('first_name' => 'Violaine', 'last_name' => 'Baillon'));
            $cashout->setUser($user);
            $user = $em->getRepository('TipmytipBundle:User')->findOneBy(array('first_name' => 'Aurélien', 'last_name' => 'Baillon'));
            $cashout->setReceiver($user);
            
            $em->persist($cashout);
            $em->flush();

            return $this->redirectToRoute('cash-out_show', array('id' => $cashout->getId()));
        }

        return $this->render('cashout/new.html.twig', array(
            'cashout' => $cashout,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Cashout entity.
     *
     * @Route("/{id}", name="cash-out_show")
     * @Method("GET")
     */
    public function showAction(Cashout $cashout)
    {

        return $this->render('cashout/show.html.twig', array(
            'cashout' => $cashout,
        ));
    }

   
}
