<?php

class Book {

    private $id;
    private $title;
    private $author;
    private $isbn;


    public function getId()
    {
      return $this->id;
    } 

    public function setId($id){
      $this->id = $id;
    }

    public function getTitle()
    {
      return $this->title;
    } 

    public function setTitle($var){
      $this->title = $var;
    }

    public function getAuthor()
    {
      return $this->author;
    } 

    public function setAuthor($var)
    {
      $this->author = $var;  
    }

    public function getIsbn() 
    {
    return $this->isbn;  
    }

    public function setIsbn($isbn) 
    {
      $this->isbn = $isbn;
    }

    public function displayInfo() 
    {
        return "ID: " . $this->getId() . " - Title: " . $this->getTitle() . " - Author: " . $this->getAuthor() . " - ISBN: " . $this->getIsbn();
    }
}
    

class Gender extends Book {
  private $romance;
  private $mystery;
  private $fantasy;
  private $scienceFiction;
  private $suspense;
  private $terror;

  public function __construct($id) 
  {
      $this->setId($id);
  }

  public function getRomance() 
  {
      return $this->romance;
  }

  public function setRomance($romance) 
  {
      $this->romance = $romance; 
  }

  public function getMystery() 
  {
      return $this->mystery;
  }

  public function setMystery($mystery) 
  {
      $this->mystery = $mystery;
  }

  public function getFantasy() 
  {
      return $this->fantasy; 
  }

  public function setFantasy($fantasy) 
  {
      $this->fantasy = $fantasy;
  }

  public function getScienceFiction() 
  {
      return $this->scienceFiction;
  }

  public function setScienceFiction($scienceFiction) 
  {
      $this->scienceFiction = $scienceFiction;
  }

  public function getSuspense() 
  {
      return $this->suspense;
  }

  public function setSuspense($suspense) 
  {
      $this->suspense = $suspense;
  }

  public function getTerror() 
  {
      return $this->terror;
  }

  public function setTerror($terror) 
  {
      $this->terror = $terror;
  }

  public function displayInfo() 
  {
      return parent::displayInfo() . " - Genre: " . $this->getRomance() . ", " . $this->getMystery() . ", " . $this->getFantasy() . ", " . $this->getScienceFiction() . ", " . $this->getSuspense() . ", " . $this->getTerror();
  }
}
