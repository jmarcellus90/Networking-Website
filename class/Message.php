<?php
class Message extends Db{

  public function inboxCount(){
    $username = $_SESSION['user']['user_name'];
    $qr = $this->handeller->query("SELECT * FROM `messages` WHERE to_user='$username'");
    $count = $qr->rowCount();
    return $count;
  }

  public function sentCount(){
    $username = $_SESSION['user']['user_name'];
    $qr = $this->handeller->query("SELECT * FROM `messages` WHERE from_user='$username'");
    $count = $qr->rowCount();
    return $count;
  }

  public function inboxMessages(){
    $username = $_SESSION['user']['user_name'];
    $qr = $this->handeller->query("SELECT from_user, to_user, subject, message, (-1 * TIMESTAMPDIFF(MINUTE, CURRENT_TIMESTAMP, sent_date)) as 'time_passed', seen, sent_date FROM `messages` WHERE `to_user`='$username' order by sent_date desc");
    return $qr;
  }

  public function sentMessages(){
    $username = $_SESSION['user']['user_name'];
    $qr = $this->handeller->query("SELECT from_user, to_user, subject, message, (-1 * TIMESTAMPDIFF(MINUTE, CURRENT_TIMESTAMP, sent_date)) as 'time_passed', seen, sent_date FROM `messages` WHERE `from_user`='$username' order by sent_date desc");
    return $qr;
  }

  public function sendMessage($to,$sub,$msg,$token){
    $from = $_SESSION['user']['user_name'];
    $qr = $this->handeller->query("INSERT INTO `messages` (`from_user`, `to_user`, `sent_date`, `seen`, `deleted`, `message`, `subject`) VALUES ('$from', '$to', CURRENT_TIMESTAMP, '0', '0', '$msg', '$sub')");
    if($qr){
      $qr2 = $this->handeller->query("SELECT * FROM users WHERE user_name='$to'");
      $row = $qr2->fetch(PDO::FETCH_ASSOC);
      $email = $row['email'];
      $from_email = $_SESSION['user']['email'];
      $mail = new Email($email, $sub, $msg, $from);
			$mail->send();
      return $this->url_return(array('email.php',$token));
    }
  }

  public function unSeenMessages(){
    $username = $_SESSION['user']['user_name'];
    $qr = $this->handeller->query("SELECT from_user, to_user, subject, message, (-1 * TIMESTAMPDIFF(MINUTE, CURRENT_TIMESTAMP, sent_date)) as 'time_passed', seen, sent_date FROM `messages` WHERE `to_user`='$username' AND seen='0' order by sent_date desc");
    return $qr;
  }

  public function unSeenMessagesCount(){
    $username = $_SESSION['user']['user_name'];
    $qr = $this->handeller->query("SELECT from_user, to_user, subject, message, (-1 * TIMESTAMPDIFF(MINUTE, CURRENT_TIMESTAMP, sent_date)) as 'time_passed', seen, sent_date FROM `messages` WHERE `to_user`='$username' AND seen='0' order by sent_date desc");
    return $qr->rowCount();
  }

  public function setSeen($to_user){
    $qr = $this->handeller->query("UPDATE messages SET seen='1' WHERE to_user='$to_user'");
    return $qr;
  }














}
