<?php

namespace TipmytipBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\Query\ResultSetMapping;
use TipmytipBundle\Entity\User;

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

    public function createAction(Request $request) {
        $input = json_decode($request->getContent(), true);

        $user = new User();

        $user->setEmail($input['email']);
        $user->setPassword($input['password']);
        $user->setFirstName($input['first_name']);
        $user->setLastName($input['last_name']);
        $user->setBirthdate($input['date_of_birth']);
        $user->setGender($input['gender']);
        $user->setNationality($input['national_id']);
        $user->setCountry($input['country_id']);
//        $user->setLocation(1);

        $em = $this->getDoctrine()->getManager();

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($user);

        // actually executes the queries (i.e. the INSERT query)
        $em->flush();

        return $this->json($user);
    }

}
