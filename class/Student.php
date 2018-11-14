<?php
class Student extends Db{


  public function GetStudentTopics(){
    $id = $_SESSION['user']['id'];
    $qr = $this->handeller->query("SELECT * FROM `topics` INNER JOIN `student_topic` ON topics.id = student_topic.topic  WHERE student_topic.student='$id'");
    return $qr;
  }


  public function GetTopicQuestions($topicID){
    $qr = $this->handeller->query("SELECT * FROM `questions` WHERE topic='$topicID'");
    return $qr;
  }

  public function getQuestionAnswers($questionID){
    $qr = $this->handeller->query("SELECT * FROM `questions_answers` WHERE question='$questionID'");
    return $qr;
  }




}
