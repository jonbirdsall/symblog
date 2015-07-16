<?php
// src/Blogger/BlogBundle/Entity/Enquiry.php

namespace Blogger\BlogBundle\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints as Assert;

class Enquiry
{
    // name field from contact form
    protected $name;
    
    // email field from contact form
    protected $email;
    
    // subject field from contact form
    protected $subject;
    
    // body of textarea from contact form
    protected $body;
    
    // returns $name
    public function getName()
    {
        return $this->name;
    }
    
    // set $name to $name
    public function setName($name)
    {
        $this->name = $name;
    }

    // returns $email
    public function getEmail()
    {
        return $this->email;
    }
    
    // set $email to $email
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    // returns $subject
    public function getSubject()
    {
        return $this->subject;
    }
    
    // set $subject to $subject
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }
    
    // returns $body
    public function getBody()
    {
        return $this->subject;
    }
    
    // set $body to $body
    public function setBody($body)
    {
        $this->body = $body;
    }
    
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank());
        
        $metadata->addPropertyConstraint('email', new Email());
        
        $metadata->addPropertyConstraint('subject', new NotBlank());
        $metadata->addPropertyConstraint('subject', new Assert\Length(array('max' => 50)));
        
        $metadata->addPropertyConstraint('body', new Assert\Length(array('min' => 50)));
    }
    
    
}

