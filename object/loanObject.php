<?php

class Loan{

    private $id;
    private $bookId;
    private $userId;
    private $dateLoan;
    private $returnDate;


    public function getId()
    {
      return $this->id;
    } 

    public function setId($id){
      $this->id = $id;
    }

    public function getBookId()
    {
      return $this->bookId;
    }
    public function setBookId($var){
      $this->bookId = $var;
    }

    public function getUserId() 
    {
      return $this->userId;  
    }

    public function setUserId($var)
    {
      $this->userId = $var;
    }

    public function getDateLoan() 
    {
      return $this->dateLoan;  
    }

    public function setDateLoan($var){
      $this->dateLoan = $var;
    }

    public function getReturnDate() 
    {
      return $this->returnDate;  
    }

    public function setReturnDate($var)
    {
      $this->returnDate = $var;
    }


  }
