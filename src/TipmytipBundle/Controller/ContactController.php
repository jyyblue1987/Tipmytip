<?php

namespace TipmytipBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use TipmytipBundle\Entity\Contact;
use TipmytipBundle\Form\ContactType;
use TipmytipBundle\Entity\Question;
use TipmytipBundle\Form\QuestionType;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Contact controller.
 *
 * @Route("/contact-us")
 */
class ContactController extends Controller
{

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $contact = new Contact();
        
        // We add extra field values
        $date = date("Y-m-d H:i:s");
        $contact->setDate($date);
        // Function to get the client IP address
        function get_client_ip() {
        	$ipaddress = '';
        	if (isset($_SERVER['HTTP_CLIENT_IP']))
        		$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        			else if(isset($_SERVER['HTTP_X_FORWARDED']))
        				$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        				else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        					$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        					else if(isset($_SERVER['HTTP_FORWARDED']))
        						$ipaddress = $_SERVER['HTTP_FORWARDED'];
        						else if(isset($_SERVER['REMOTE_ADDR']))
        							$ipaddress = $_SERVER['REMOTE_ADDR'];
        			    else
        			    	$ipaddress = 'UNKNOWN';
        			    	return $ipaddress;
        }
        $contact->setIpAddress(get_client_ip());
        
        $contact_form = $this->createForm('TipmytipBundle\Form\ContactType', $contact);
        $contact_form->handleRequest($request);
        
        if ($contact_form->isSubmitted() && $contact_form->isValid()) {
        	$em = $this->getDoctrine()->getManager();
        	// Verify if not spam with the ip address (spam = more than 1000 entries with the same ip address)
        	$existing_ip_contacts = $em->getRepository('TipmytipBundle:Contact')->findAll(array('ip_address' => $contact->getIpAddress()));
        	$ip_count = 0;
        	foreach ($existing_ip_contacts as $ip_contact) {
        		$ip_count++;
        	}
        	
        	// First letter uppercase
        	$contact->setFirstName(ucfirst(strtolower($contact->getFirstName())));
        	$contact->setLastName(ucfirst(strtolower($contact->getLastName())));
        	$contact->setSubject(ucfirst($contact->getSubject()));
        	$contact->setMessage(ucfirst($contact->getMessage()));
        	
       		if ($ip_count < 1000) {
    			$em->persist($contact);
    			$em->flush();
    			
    			// Send email to the Gemmie
    			$message = \Swift_Message::newInstance()
    			->setSubject('🔹 Tipmytip - New Message from ' .  $contact->getFirstName())
    			->setFrom(array($contact->getEmail() => $contact->getFirstName() . ' ' . $contact->getLastName()))
    			->setTo('gemmie@tipmytip.com')
    			->setBody(
    					$this->renderView(
    							'contact/email.html.twig',
    							array('first_name' => $contact->getFirstName(),
    								  'last_name' => $contact->getLastName(),
    								  'email' => $contact->getEmail(),
    								  'subject' => $contact->getSubject(),
    							      'message' => $contact->getMessage())
    							),
    					'text/html'
    					)
    					;
    			$this->get('mailer')->send($message);
    		}
        
        	return $this->redirectToRoute('contact_us_thank_you');
        }
        
        $question = new Question();
        $question_form = $this->createForm('TipmytipBundle\Form\QuestionType', $question);
        $question_form->handleRequest($request);
         
        if ($question_form->isSubmitted() && $question_form->isValid()) {
        	$em = $this->getDoctrine()->getManager();
        	$em->persist($question);
        	$em->flush();
        	 
        	return $this->redirectToRoute('question_show', array('id' => $question->getId()));
        }
        
        return $this->render('contact/index.html.twig', array(
        		'contact' => $contact,
        		'contact_form' => $contact_form->createView(),
        		'question' => $question,
        		'question_form' => $question_form->createView(),
        ));
    }
    
    public function gemmieindexAction()
    {
    	$em = $this->getDoctrine()->getManager();
    
    	$contacts = $em->getRepository('TipmytipBundle:Contact')->findBy(array(), array('id' => 'desc'), 50);
    
    	return $this->render('contact/gemmie_index.html.twig', array(
    			'contacts' => $contacts,
    	));
    }
    
    public function exportAction()
    {
    	$response = new StreamedResponse();
    	$response->setCallback(function() {
    		$handle = fopen('php://output', 'w+');
    
    		// Add the header of the CSV file
    		fputcsv($handle, array('Id', 'Date', 'First Name', 'Last Name', 'Email', 'Subject', 'Message'),';');
    		// Query data from database
    		$em = $this->getDoctrine()->getManager();
    		$results = $em->getRepository('TipmytipBundle:Contact')->findBy(array(), array('id' => 'desc'));
    		// Add the data queried from database
    		foreach($results as $result) {
    			fputcsv(
    					$handle, // The file pointer
    					array($result->getId(), $result->getDate(), $result->getFirstName(), $result->getLastName(), $result->getEmail(), $result->getSubject(), $result->getMessage()), // The fields
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
    
    public function thankyouAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
        
        $question = new Question();
        $question_form = $this->createForm('TipmytipBundle\Form\QuestionType', $question);
        $question_form->handleRequest($request);
         
        if ($question_form->isSubmitted() && $question_form->isValid()) {
        	$em = $this->getDoctrine()->getManager();
        	$em->persist($question);
        	$em->flush();
        	 
        	return $this->redirectToRoute('question_show', array('id' => $question->getId()));
        }
        
        return $this->render('contact/thankyou.html.twig', array(
        		'question' => $question,
        		'question_form' => $question_form->createView(),
        ));
    }

}
