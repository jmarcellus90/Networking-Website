<?php
include('template_part/head.php');


$user->admin_check(Config::get('csrf_token'));
$qiz = new Quiz;
$topix = new Topics;
$student = new Student;


if(Config::get('base.request_method') == "POST"){

  if(isset($_POST['quiz_form'])){
    $qiz->answeredQuiz($_POST);
  }

}

include('inc/header.php');

?>

            <main class="main-content bgc-grey-100">
               <div id="mainContent">
                  <div class="row gap-20 masonry pos-r" style="position: relative; height: 1124.2px;">
                     <div class="masonry-sizer col-md-6"></div>
                     <div class="masonry-item col-md-6" style="position: absolute; left: 0%; top: 0px;">
                        <div class="bgc-white p-20 bd">
                           <h2 class="c-grey-900">Your grades so far</h2>
                           <div class="mT-30">
                              <form>
                                 <div class="form-group">

                                   <?php
                                      $grades = $qiz->studentGrades();
                                      foreach($grades as $grade){
                                   ?>

                                    <div class="row">
                                       <div class="col-md-10" >
                                          <h4><?php echo $grade['name']."'s quiz grade : ".$grade['value'] ?></h4>
                                       </div>
                                    </div>

                                  <?php } ?>

                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>

                     <?php
                       $topics = $student->GetStudentTopics();
                       $count = 0;
                       foreach($topics as $topic){
                     ?>

                     <div class="masonry-item col-md-6" style="position: absolute; left: 0%; top: 0px;">
                        <div class="bgc-white p-20 bd ml-auto mr-auto">
                           <h2 class="c-grey-900"><?php echo $topic['name']; ?></h2>
                           <div class="row">
                              <?php echo $topic['content']; ?>
                           </div>
                           <div class="mT-30">
                              <button type="submit" class="btn btn-primary col-md-12" data-toggle="modal" data-target="#quizPop<?php echo $count; ?>">Start the quiz!</button>
                           </div>
                        </div>
                     </div>



                   <!--  Topic model -->

                   <div class="modal fade" id="quizPop<?php echo $count; ?>" tabindex="-1" role="dialog" aria-labelledby="newMessageLabel" aria-hidden="true">
                            <div class="modal-dialog"role="document" >
                               <div class="modal-content" style="width:500px">
                                  <div class="modal-header" >
                                     <h5 class="modal-title"><?php echo $topic['name']; ?></h5>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  </div>
                                  <div class="modal-body">
                                     <form class="email-compose-body" method="post" action="">
                                       <input type="hidden" name="quiz_form" value="1">
                                       <input type="hidden" name="topicID" value="<?php echo $topic['topic']; ?>">

                                       <div class="send-header">


                                         <h4 class="c-grey-900 mB-20">Select the correct answer(s):</h4>

                                        <?php
                                          $questions = $student->GetTopicQuestions($topic['topic']);
                                          $qn = 0;
                                          foreach($questions as $qs){
                                        ?>
                                        <h4><?php echo $qs['description']; ?>?</h4>

                                        <?php
                                          $answers = $student->getQuestionAnswers($qs['id']);
                                          foreach($answers as $as){
                                        ?>
                                         <div class="form-group">
                                           <label class="form-check-label" style="padding-left: 20px">
  										                       <input name="question_<?php echo $qn; ?>_answers[]" value="<?php echo $as['id']; ?>" class="form-check-input" type="checkbox">
                                             <?php echo $as['description']; ?>
                                           </label>
                                         </div>
                                         <?php } ?>

                                         <hr class="light-grey-hr">
                                       <?php $qn++; } ?>

                                       <div class="form-group">
                                         <div class="text-right mrg-top-30">
                                           <button class="btn btn-primary">Submit Quiz</button>
                                         </div>
                                       </div>

                                        </div>
                                     </form>
                                  </div>
                               </div>
                            </div>
                         </div>





                         <?php $count++; } ?>

                   <!--  Topic model -->

                  </div>
               </div>




            </main>
         </div>
      </div>
<?php
include('inc/footer.php');
?>

</body>
</html>
