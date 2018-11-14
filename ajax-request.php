<?php
require_once('core/init.php');
$user = new User;
$msg = new Message;
$topix = new Topics;

if(Config::get('base.request_method') == 'POST') {

  if($_POST['type'] == 'set_seen') {
    $to_user = $_POST['to_user'];
    $msg->setSeen($to_user);
    echo('{"status": "Success"}');
  }

  if($_POST['type'] == 'remove_student') {
    $student = $_POST['student'];
    $user->removeStudent($student);
    echo('{"status": "Success"}');
  }

  if($_POST['type'] == 'remove_student_topic') {
    $student = $_POST['student'];
    $topic = $_POST['topic'];
    $topix->removeStudent($student, $topic);
    echo('{"status": "Success"}');
  }

  if($_POST['type'] == 'add_student_topic_permission') {
    $student = $_POST['student'];
    $topic = $_POST['topic'];
    $topix->add_student_topic_permission($student, $topic);
    echo('{"status": "Success"}');
  }

  if($_POST['type'] == 'remove_student_topic_permission') {
    $student = $_POST['student'];
    $topic = $_POST['topic'];
    $topix->remove_student_topic_permission($student, $topic);
    echo('{"status": "Success"}');
  }









}else{
  die('{"status": "Bad Request!!"}');
}
