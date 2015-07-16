<?php

// src/Blogger/BlogBundle/Controller/PageController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Blogger\BlogBundle\Entity\Enquiry;
use Blogger\BlogBundle\Form\EnquiryType;


class PageController extends Controller
{
    public function indexAction()
    {
        
        
        return $this->render('BloggerBlogBundle:Page:index.html.twig');
    }
    
    public function aboutAction()
    {
        return $this->render('BloggerBlogBundle:Page:about.html.twig');
    }
    
    public function contactAction(Request $request)
    {
        // $enquiry represents the data of a contact form entry
        $enquiry = new Enquiry();
        
        
        // create form representation
        $form = $this->createForm(new EnquiryType(), $enquiry);
        
        
        
        // if form has been submitted, grab the data
        if ($request->getMethod() == 'POST'){
            $form->bind($request);
            
            // check form against validators
            if ($form->isValid()){
                // Perform some action, such as sending an email
                $message = \Swift_Message::newInstance()
                        ->setSubject('Contact enquiry from symblog')
                        ->setFrom('enquiries@symblog.co.uk')
                        ->setTo($this->container->getParameter('blogger_blog.emails.contact_email'))
                        ->setBody($this->renderView('BloggerBlogBundle:Page:contactEmail.txt.twig', array('enquiry' => $enquiry)));
                $this->get('mailer')->send($message);
                
                $this->get('session')->getFlashBag()->add('blogger-notice', 'Your contact enquiry was successfully sent. Thank you!');
                
                
                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('BloggerBlogBundle_contact'));
            }
        }
        
        
        // if we are here, the form has not been submitted, and
        // the user likely just arrived to the page so render
        // the form
        return $this->render('BloggerBlogBundle:Page:contact.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
