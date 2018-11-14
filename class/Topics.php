<?php
class Topics extends Db{

  public function showSingle($topic, $arg){
    $qr = $this->handeller->query("SELECT * FROM `topics` WHERE id='$topic'");
    $row = $qr->fetch(PDO::FETCH_ASSOC);
    return $row[$arg];
  }

  public function studentTopic($username, $topic){
    $qr = $this->handeller->query("SELECT * FROM `users` WHERE user_name='$username'");
    $row = $qr->fetch(PDO::FETCH_ASSOC);
    $id = $row['id'];

    $qr2 = $this->handeller->query("SELECT * FROM `student_topic` WHERE topic='$topic' AND student='$id'");
    $count = $qr2->rowCount();
    if($count == 0){
      $qr3 =  $this->handeller->query("INSERT INTO `student_topic` (`topic`, `student`) VALUES ('$topic', '$id')");
    }
  }

  public function studentList($topic){
    $qr = $this->handeller->query("SELECT * FROM `student_topic` INNER JOIN `users` ON student_topic.student=users.id WHERE student_topic.topic='$topic'");
    return $qr;
  }

  public function removeStudent($student, $topic){
    $qr = $this->handeller->query("DELETE FROM student_topic WHERE student='$student' AND topic='$topic'");
    return true;
  }

  public function checkStudentQuiz($topic){
    $id = $_SESSION['user']['id'];
    $qr2 = $this->handeller->query("SELECT * FROM `student_topic` WHERE topic='$topic' AND student='$id'");
    $count = $qr2->rowCount();
    return $count;
  }


  public function checkStudentPermission($student, $topic){
    $qr2 = $this->handeller->query("SELECT * FROM `student_topic` WHERE topic='$topic' AND student='$student'");
    $count = $qr2->rowCount();
    return $count;
  }

  public function add_student_topic_permission($student, $topic){
    $qr2 = $this->handeller->query("SELECT * FROM `student_topic` WHERE topic='$topic' AND student='$student'");
    $count = $qr2->rowCount();
    if($count == 0){
      $qr3 =  $this->handeller->query("INSERT INTO `student_topic` (`topic`, `student`) VALUES ('$topic', '$student')");
    }
  }

  public function remove_student_topic_permission($student, $topic){
    $qr = $this->handeller->query("DELETE FROM student_topic WHERE student='$student' AND topic='$topic'");
    return true;
  }

  public function addTopic($topicName, $content){
    $qr = $this->handeller->query("INSERT INTO `topics` (`name`, `content`) VALUES ('$topicName', '$content')");
    return true;
  }

  public function GetTopicQuestions($topicID){
    $qr = $this->handeller->query("SELECT * FROM `questions` WHERE topic='$topicID'");
    return $qr;
  }

  public function getQuestionAnswers($question){
    $qr = $this->handeller->query("SELECT * FROM `questions_answers` WHERE question='$question'");
    return $qr;
  }



  public function addQuestionToTopic(array $data){
    extract($data);
    $qr = $this->handeller->query("INSERT INTO `questions` (`description`, `topic`, `points`) VALUES ('$question', '$topic', '0')");
    return true;
  }

  public function removeQuestionFromTopic(array $data){
    extract($data);
    $qr = $this->handeller->query("DELETE FROM `questions` WHERE id='$question'");
    $qr2 = $this->handeller->query("DELETE FROM `questions_answers` WHERE question='$question'");
    return true;
  }

  public function addAnswerToQuestion(array $data){
    extract($data);
    $ans1_qr = $this->handeller->query("INSERT INTO `questions_answers` (`description`, `question`, `correct`) VALUES ('$ans1', '$question', '$correct_ans_1')");
    $ans2_qr = $this->handeller->query("INSERT INTO `questions_answers` (`description`, `question`, `correct`) VALUES ('$ans2', '$question', '$correct_ans_2')");
    $ans3_qr = $this->handeller->query("INSERT INTO `questions_answers` (`description`, `question`, `correct`) VALUES ('$ans3', '$question', '$correct_ans_3')");
    $ans3_qr = $this->handeller->query("INSERT INTO `questions_answers` (`description`, `question`, `correct`) VALUES ('$ans4', '$question', '$correct_ans_4')");
    return true;
  }

  public function countQuestionAnswer($question){
    $qr = $this->handeller->query("SELECT * FROM `questions_answers` WHERE question='$question'");
    $count = $qr->rowCount();
    return $count;
  }



















}
