<?php

namespace App\Entities;

class Contact extends AbstractEntity{
    public string $email;
    public string $subject;
    public string $message;
    public int $DateOfCreation;
    public int $DateOfLastUpdate;
        public function __construct($email, $subject, $message){
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;}

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }   

    public function getSubject(){
        return $this->subject;
    }

    public function setSubject($subject){
        $this->subject = $subject;
    }

    public function getMessage(){
        return $this->message;
    }

    public function setMessage($message){    
        $this->message = $message;
    }

    public function getDateOfCreation(){
        return $this->DateOfCreation;
    }   

    public function setDateOfCreation($DateOfCreation){
        $this->DateOfCreation = $DateOfCreation;
    }

    public function getDateOfLastUpdate(){
        return $this->DateOfLastUpdate;
    }

    public function setDateOfLastUpdate($DateOfLastUpdate){
        $this->DateOfLastUpdate = $DateOfLastUpdate;
    }

}