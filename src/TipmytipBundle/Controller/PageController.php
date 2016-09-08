<?php

namespace TipmytipBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use TipmytipBundle\Entity\Invitation;
use TipmytipBundle\Form\InvitationType;
use TipmytipBundle\Entity\Question;
use TipmytipBundle\Form\QuestionType;

/**
 * Page controller.
 *
 */
class PageController extends Controller
{
    
    public function homeAction(Request $request)
    {
    	$question = new Question();
    	$form = $this->createForm('TipmytipBundle\Form\QuestionType', $question);
    	$form->handleRequest($request);
    	
    	if ($form->isSubmitted() && $form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($question);
    		$em->flush();
    	
    		return $this->redirectToRoute('question_show', array('id' => $question->getId()));
    	}
    	
    	return $this->render('page/home.html.twig', array(
    		'question' => $question,
    		'form' => $form->createView(),
        ));
    }
    
    public function landingpageAction(Request $request)
    {
    	$invitation = new Invitation();
    	
    	// We add extra field values
    	$date = date("Y-m-d H:i:s");
    	$invitation->setDate($date);
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
    	$invitation->setIpAddress(get_client_ip());
    	
    	$form = $this->createForm('TipmytipBundle\Form\InvitationType', $invitation);
    	 
    	$form->handleRequest($request);
    	
    	if ($form->isSubmitted() && $form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		// Verify if the email is already in the database
    		$existing_email_invitation = $em->getRepository('TipmytipBundle:Invitation')->findOneBy(array('email' => $invitation->getEmail()));
    		// Verify if not spam with the ip address (spam = more than 1000 entries with the same ip address)
    		$existing_ip_invitations = $em->getRepository('TipmytipBundle:Invitation')->findAll(array('ip_address' => $invitation->getIpAddress()));
    		$ip_count = 0;
    		foreach ($existing_ip_invitations as $ip_invitation) {
    			$ip_count++;
    		}
    		
    		// First letter uppercase
    		$invitation->setFirstName(ucfirst(strtolower($invitation->getFirstName())));
    		$invitation->setLastName(ucfirst(strtolower($invitation->getLastName())));
    		$invitation->setCity(ucfirst(strtolower($invitation->getCity())));
    		$invitation->setCountry(ucfirst(strtolower($invitation->getCountry())));
    		
    		if (!isset($existing_email_invitation) && $ip_count < 1000) {
    			$em->persist($invitation);
    			$em->flush();
    			
    			// Send email to the user
    			$message = \Swift_Message::newInstance()
    			->setSubject('Thank you for registering!')
    			->setFrom(array('gemmie@tipmytip.com' => 'Gemmie from tipmytip'))
    			->setTo($invitation->getEmail())
    			->setBody(
    					$this->renderView(
    							'email/invitation.html.twig',
    							array('first_name' => $invitation->getFirstName())
    							),
    					'text/html'
    					)
    					;
    			$this->get('mailer')->send($message);
    		}
    		
    		if ($ip_count >= 1000) {
    			// Send me an alert email
    			$message = \Swift_Message::newInstance()
    			->setSubject('Alert Spam Invitation > 1000 !')
    			->setFrom('gemmie@tipmytip.com')
    			->setTo('mathieu.lima@gmail.com')
    			->setBody(
    					$this->renderView(
    							'email/invitation.html.twig',
    							array('first_name' => $invitation->getFirstName())
    							),
    					'text/html'
    					)
    					;
    			$this->get('mailer')->send($message);
    		}
    	
    		return $this->redirectToRoute('landing_page_thank_you');
    	}
    	
    	return $this->render('page/landingpage.html.twig', array(
    		'invitation' => $invitation,
    		'form' => $form->createView(),
    	));
    }
    
    public function landingpagethankyouAction(Request $request)
    {
    	$invitation = new Invitation();
    	 
    	// We add extra field values
    	$date = date("Y-m-d H:i:s");
    	$invitation->setDate($date);
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
    	$invitation->setIpAddress(get_client_ip());
    	 
    	$form = $this->createForm('TipmytipBundle\Form\InvitationType', $invitation);
    
    	$form->handleRequest($request);
    	 
    if ($form->isSubmitted() && $form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		// Verify if the email is already in the database
    		$existing_email_invitation = $em->getRepository('TipmytipBundle:Invitation')->findOneBy(array('email' => $invitation->getEmail()));
    		// Verify if not spam with the ip address (spam = more than 1000 entries with the same ip address)
    		$existing_ip_invitations = $em->getRepository('TipmytipBundle:Invitation')->findAll(array('ip_address' => $invitation->getIpAddress()));
    		$ip_count = 0;
    		foreach ($existing_ip_invitations as $ip_invitation) {
    			$ip_count++;
    		}
    		
    		// First letter uppercase
    		$invitation->setFirstName(ucfirst(strtolower($invitation->getFirstName())));
    		$invitation->setLastName(ucfirst(strtolower($invitation->getLastName())));
    		$invitation->setCity(ucfirst(strtolower($invitation->getCity())));
    		$invitation->setCountry(ucfirst(strtolower($invitation->getCountry())));
    		
    		if (!isset($existing_email_invitation) && $ip_count < 1000) {
    			$em->persist($invitation);
    			$em->flush();
    			
    			// Send email to the user
    			$message = \Swift_Message::newInstance()
    			->setSubject('Thank you for registering!')
    			->setFrom(array('gemmie@tipmytip.com' => 'Gemmie from tipmytip'))
    			->setTo($invitation->getEmail())
    			->setBody(
    					$this->renderView(
    							'email/invitation.html.twig',
    							array('first_name' => $invitation->getFirstName())
    							),
    					'text/html'
    					)
    					;
    			$this->get('mailer')->send($message);
    		}
    		
    		if ($ip_count >= 1000) {
    			// Send me an alert email
    			$message = \Swift_Message::newInstance()
    			->setSubject('Alert Spam Invitation > 1000 !')
    			->setFrom('gemmie@tipmytip.com')
    			->setTo('mathieu.lima@gmail.com')
    			->setBody(
    					$this->renderView(
    							'email/invitation.html.twig',
    							array('first_name' => $invitation->getFirstName())
    							),
    					'text/html'
    					)
    					;
    			$this->get('mailer')->send($message);
    		}
    	
    		return $this->redirectToRoute('landing_page_thank_you');
    	}
    	 
    	return $this->render('page/landingpagethankyou.html.twig', array(
    			'invitation' => $invitation,
    			'form' => $form->createView(),
    	));
    }
    
    public function newquestionAction()
    {
    	return $this->render('page/newquestion.html.twig', array(
    
    	));
    }
    
    public function myquestionsAction()
    {
    	return $this->render('page/myquestions.html.twig', array(
    
    	));
    }
    
    public function newanswerAction()
    {
    	return $this->render('page/newanswer.html.twig', array(
    
    	));
    }
    
    public function myanswersAction()
    {
    	return $this->render('page/myanswers.html.twig', array(
    
    	));
    }
    
    public function otherstuffAction()
    {
    	return $this->render('page/otherstuff.html.twig', array(
    
    	));
    }
    
    public function myprofileAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	
    	$user = $em->getRepository('TipmytipBundle:User')->findOneBy(array('username' => 'violaine@tipmytip.com'));
    	
    	return $this->render('page/myprofile.html.twig', array(
            'user' => $user,
        ));
    }

}
