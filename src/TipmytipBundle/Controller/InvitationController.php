<?php

namespace TipmytipBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use TipmytipBundle\Entity\Invitation;
use TipmytipBundle\Form\InvitationType;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Invitation controller.
 *
 * @Route("/gemmie/invitation")
 */
class InvitationController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $invitations = $em->getRepository('TipmytipBundle:Invitation')->findBy(array(), array('id' => 'desc'), 50);

        return $this->render('invitation/index.html.twig', array(
            'invitations' => $invitations,
        ));
    }
    
    public function exportAction()
    {
	    $response = new StreamedResponse();
	    $response->setCallback(function() {
	        $handle = fopen('php://output', 'w+');
	
	        // Add the header of the CSV file
	        fputcsv($handle, array('Id', 'Date', 'First Name', 'Last Name', 'Email', 'Country'),';');
	        // Query data from database
	        $em = $this->getDoctrine()->getManager();        
	        $results = $em->getRepository('TipmytipBundle:Invitation')->findBy(array(), array('id' => 'desc'));
	        // Add the data queried from database
	        foreach($results as $result) {
	            fputcsv(
	                $handle, // The file pointer
	                array($result->getId(), $result->getDate(), $result->getFirstName(), $result->getLastName(), $result->getEmail(), $result->getCountry()), // The fields
	                ';' // The delimiter
	            );	
	        }
	
	        fclose($handle);
	    });
	
	    $response->setStatusCode(200);
	    $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
	    $response->headers->set('Content-Disposition', 'attachment; filename="export.csv"');
	
	    return $response;
    }
}
