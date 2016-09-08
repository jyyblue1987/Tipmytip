<?php

namespace TipmytipBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use TipmytipBundle\Entity\User;
use TipmytipBundle\Form\UserType;

/**
 * Signup controller.
 *
 * @Route("/signup")
 */
class SignupController extends Controller
{

    public function indexAction()
    {
        return $this->render('signup/index.html.twig', array(
            
        ));
    }

}
