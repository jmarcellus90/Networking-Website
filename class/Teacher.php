<?php
class Teacher extends Db{


  public function getTopics(){
    $qr =  $this->handeller->query("SELECT * FROM topics ORDER BY id ASC");
    return $qr;
  }

  public function getTopics2(){
    $qr =  $this->handeller->query("SELECT * FROM topics ORDER BY id ASC");
    return $qr;
  }

  public function getTopics3(){
    $qr =  $this->handeller->query("SELECT * FROM topics ORDER BY id ASC");
    return $qr;
  }

  public function getStudents(){
    $qr =  $this->handeller->query("SELECT * FROM users WHERE access_level='0'");
    return $qr;
  }

  public function getStudentGrades($student){
    $qr = $this->handeller->query("SELECT * FROM grades INNER JOIN topics ON grades.topic = topics.id WHERE grades.student='$student'");
    return $qr;
  }








}
