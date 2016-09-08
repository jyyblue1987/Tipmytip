<?php

namespace TipmytipBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use TipmytipBundle\Entity\Cashin;
use TipmytipBundle\Form\CashinType;

/**
 * Cashin controller.
 *
 * @Route("/cash-in")
 */
class CashinController extends Controller
{

    /**
     * Creates a new Cashin entity.
     *
     * @Route("/new", name="cash-in_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cashin = new Cashin();
        $form = $this->createForm('TipmytipBundle\Form\CashinType', $cashin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            // Back-end datas set
            $cashin->setDate(new \DateTime('now'));
            $cashin->setCurrency('€');
            // User : to change when log set
            $user = $em->getRepository('TipmytipBundle:User')->findOneBy(array('first_name' => 'Violaine', 'last_name' => 'Baillon'));
            $cashin->setUser($user);
            
            $em->persist($cashin);
            $em->flush();

            return $this->redirectToRoute('cash-in_show', array('id' => $cashin->getId()));
        }

        return $this->render('cashin/new.html.twig', array(
            'cashin' => $cashin,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Cashin entity.
     *
     * @Route("/{id}", name="cash-in_show")
     * @Method("GET")
     */
    public function showAction(Cashin $cashin)
    {

        return $this->render('cashin/show.html.twig', array(
            'cashin' => $cashin,
        ));
    }

  
}
