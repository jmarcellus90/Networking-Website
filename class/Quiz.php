<?php
class Quiz extends Db{

  public function studentGrades(){
    $student = $_SESSION['user']['id'];
    $qr = $this->handeller->query("SELECT * FROM grades INNER JOIN topics ON grades.topic = topics.id WHERE grades.student='$student'");
    return $qr;
  }

  public function answeredQuiz(array $data){
    extract($data);
    $student = $_SESSION['user']['id'];
    $qsn_count_qr = $this->handeller->query("SELECT * FROM `questions` WHERE topic='$topicID'");
    $total_question = $qsn_count_qr->rowCount();
    $grade = 0;

    for($i = 0; $i < $total_question; $i++){
      $wrongAnswers = 0;
		  $correctAnswer = 0;


      $ans_prefix = 'question_'.$i.'_answers';
      $ans_count = @count($data[$ans_prefix]);

      for($j = 0; $j < $ans_count; $j++){
        $answerID = $data[$ans_prefix][$j];
        $corrent_ans_qr = $this->handeller->query("SELECT * FROM `questions_answers` WHERE id='$answerID'");
        $row = $corrent_ans_qr->fetch(PDO::FETCH_ASSOC);
        if($row['correct'] == '1'){
          $correctAnswer = 1;
        }elseif($row['correct'] == '0'){
           $wrongAnswers++;
        }
      }

      if($correctAnswer == 1 && $wrongAnswers == 0) {
  			$grade++;
  		}


    }

    $grade = ($grade * 10) / $total_question;

    $qr = $this->handeller->query("SELECT * FROM `grades` WHERE student = '$student' AND topic = '$topicID'");
    $g_count = $qr->rowCount();

    if($g_count > 0){
      $qr_update = $this->handeller->query("UPDATE `grades` SET value='$grade' WHERE student = '$student' AND topic = '$topicID'");
    }else{
      $qr_add = $this->handeller->query("INSERT INTO `grades` (`student`, `topic`, `value`) VALUES ('$student', '$topicID', '$grade')");
    }

  }











}
