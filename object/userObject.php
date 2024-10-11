<?php

class User {

    private $id;
    private $name;
    private $age;    
    private $document;


    public function getId()
    {
      return $this->id;
    } 

    public function setId($id){
      $this->id = $id;
    }

    public function getName()
    {
      return $this->name;
    } 

    public function setName($var){
      $this->name = $var;
    }

    public function getAge()
    {
      return $this->age;
    }
    public function setAge($var){
      $this->age = $var;
    }

    public function getDocument() 
    {
      return $this->document;  
    }

    public function setDocument($var){
      $this->document = $var;
    }

    public function displayInfo() 
    {
        return "USER #" . $this->getId() . " - Name: " . $this->getName() . " - Age: " . $this->getAge();
    }


}

 
