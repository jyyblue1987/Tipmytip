<?php

namespace TipmytipBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * Signup controller.
 *
 * @Route("/signup")
 */
class SignupController extends Controller
{

    public function indexAction(Request $request)
    {
        return $this->render('signup/index.html.twig', array(

        ));
    }

    /**
     * @Route("/signup/location")
     */

    public function locationAction(Request $request) {
        $sql = "SELECT * FROM country";

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        $countrylist = $stmt->fetchAll();

        $ret = array();
        $ret['countrylist'] = $countrylist;

        return $this->json($ret);
    }

    public function cityAction($country_id) {
        $sql = sprintf("SELECT * FROM location where country_id = %s", $country_id);

        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        $citylist = $stmt->fetchAll();

        $ret = array();
        $ret['citylist'] = $citylist;

        return $this->json($ret);
    }

}
