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

        $ret = array();

        $em = $this->getDoctrine()->getManager();

        $sql = sprintf("SELECT * FROM user where email = '%s'", $input['email']);

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        $datalist = $stmt->fetchAll();

        if( $datalist )
        {
            $ret['code'] = 201;
            $ret['message'] = 'Email is duplicated';

            return $this->json($ret);
        }

        $sql = sprintf("Insert into user (email, password, first_name, last_name, birthdate, gender, nationality, country, admin_account, is_active, location_id)
                                    values ('%s', '%s', '%s', '%s','%s', '%s', '%s','%s', '%s', '%s', '%s')",
            $input['email'], $input['password'], $input['first_name'], $input['last_name'], $input['date_of_birth'], $input['gender'], $input['national_id'], $input['country_id'], 'admin', '1', $input['city_id']
        );

        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();

        $ret['code'] = 200;
        $ret['message'] = 'Account has been created successfully';

        return $this->json($ret);
    }

}
