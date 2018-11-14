<?php
include('template_part/head.php');

$user->student_check(Config::get('csrf_token'));
$teacher = new Teacher;
$topix = new Topics;
$topic = $_GET['topic'];

if(Config::get('base.request_method') == "POST"){

  if(isset($_POST['add_question'])){
    if(isset($_POST['question'])){
      $topix->addQuestionToTopic($_POST);
    }
  }

  if(isset($_POST['add_answer'])){
    $topix->addAnswerToQuestion($_POST);
  }

  if(isset($_POST['rm_question'])){
    $topix->removeQuestionFromTopic($_POST);
  }

}


include('inc/header.php');
?>

            <main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container-fluid">
                        <h4 class="c-grey-900 mT-10 mB-30">Teacher Dashboard</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                                  <div class="pull-right">
                                    <button class="btn  btn-info" data-toggle="modal" data-target="#add-ques">Add Question</button>
                                  </div>
                                    <h4 class="c-grey-900 mB-20"><?php echo $topix->showSingle($topic, 'name'); ?>'s Question List</h4>

                                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0"
                                        width="100%">

                                        <thead>
                                            <tr>
                                                <th> ID </th>
                                                <th> The Question </th>
                                                <th> Answers </th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                              <th> ID </th>
                                              <th> The Question </th>
                                              <th> Answers </th>
                                              <th> Action </th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                          <?php
                                              $questions = $topix->GetTopicQuestions($topic);
                                              foreach($questions as $tp){
                                           ?>

                                            <tr>
                                              <td><?php echo $tp['id']; ?></td>
                                              <td><?php echo $tp['description']; ?></td>
                                              <?php if($topix->countQuestionAnswer($tp['id']) > 0){ ?>
                                                  <td><a href="view_answers.php?question=<?php echo $tp['id']; ?>&token=<?php echo Config::get('csrf_token'); ?>"><button class="btn btn-primary">View Answer</button></a></td>
                                              <?php }else{ ?>
                                                  <td><button class="btn btn-info add-ans" data-question="<?php echo $tp['id']; ?>" data-toggle="modal" data-target="#add-ans">Add Answer</button></td>
                                              <?php } ?>
                                              <td>
                                                <button class="btn btn-danger rm-btn" data-question="<?php echo $tp['id']; ?>">Revmoe</button>
                                              </td>
                                            </tr>

                                          <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
            </main>
        </div>
    </div>

    <div class="modal fade" id="add-ques" tabindex="-1" role="dialog" aria-labelledby="newMessageLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Question</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form class="email-compose-body" method="post" action="">
                              <input type="hidden" name="add_question" value="1">
                              <input id="hidden-topic" type="hidden" name="topic" value="<?php echo $topic; ?>">
                                <div class="send-header">

                                    <div class="form-group">
                                        <input type="text" name="question" class="form-control" placeholder="The Question">
                                    </div>

                                </div>

                                <div id="compose-area"></div>
                                <div class="text-right mrg-top-30">
                                    <button class="btn btn-info">Add Question</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



            <div class="modal fade" id="add-ans" tabindex="-1" role="dialog" aria-labelledby="newMessageLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Answers</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form class="email-compose-body" method="post" action="">
                                      <input type="hidden" name="add_answer" value="1">
                                      <input id="hidden-question" type="hidden" name="question" value="">
                                        <div class="send-header">



                                            <div class="row">
              																<div class="col-md-6">
              																	<div class="form-group">
              																		<label class="control-label mb-10">Answer #1</label>
              																		<input type="text" name="ans1" id="firstName" class="form-control" placeholder="The Answer..">
              																	</div>
              																</div>
              																<!--/span-->
              																<div class="col-md-6">
                                                <div class="form-group">
              																		<label class="control-label mb-10">Correct Answer</label>
                                                  <select name="correct_ans_1" class="form-control">
                                                    <option value="0">Wrong</option>
              																			<option value="1">Correct</option>
              																		</select>
              																	</div>
              																</div>
              																<!--/span-->
              															</div>

                                            <div class="row">
              																<div class="col-md-6">
              																	<div class="form-group">
              																		<label class="control-label mb-10">Answer #2</label>
              																		<input type="text" name="ans2" id="firstName" class="form-control" placeholder="The Answer..">
              																	</div>
              																</div>
              																<!--/span-->
              																<div class="col-md-6">
                                                <div class="form-group">
              																		<label class="control-label mb-10">Correct Answer</label>
                                                  <select name="correct_ans_2" class="form-control">
                                                    <option value="0">Wrong</option>
              																			<option value="1">Correct</option>
              																		</select>
              																	</div>
              																</div>
              																<!--/span-->
              															</div>

                                            <div class="row">
              																<div class="col-md-6">
              																	<div class="form-group">
              																		<label class="control-label mb-10">Answer #3</label>
              																		<input type="text" name="ans3" id="firstName" class="form-control" placeholder="The Answer..">
              																	</div>
              																</div>
              																<!--/span-->
              																<div class="col-md-6">
                                                <div class="form-group">
              																		<label class="control-label mb-10">Correct Answer</label>
                                                  <select name="correct_ans_3" class="form-control">
                                                    <option value="0">Wrong</option>
              																			<option value="1">Correct</option>
              																		</select>
              																	</div>
              																</div>
              																<!--/span-->
              															</div>

                                            <div class="row">
              																<div class="col-md-6">
              																	<div class="form-group">
              																		<label class="control-label mb-10">Answer #4</label>
              																		<input type="text" name="ans4" id="firstName" class="form-control" placeholder="The Answer..">
              																	</div>
              																</div>
              																<!--/span-->
              																<div class="col-md-6">
                                                <div class="form-group">
              																		<label class="control-label mb-10">Correct Answer</label>
              																		<select name="correct_ans_4" class="form-control">
                                                    <option value="0">Wrong</option>
              																			<option value="1">Correct</option>
              																		</select>
              																	</div>
              																</div>
              																<!--/span-->
              															</div>

                                        </div>

                                        <div id="compose-area"></div>
                                        <div class="text-right mrg-top-30">
                                            <button class="btn btn-info">Add Answers</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <form id="rm-form" method="post" action="">
                      <input type="hidden" name="rm_question" value="1">
                      <input type="hidden" id="hidden_rm_question" name="question" value="">
                    </form>






<?php
include('inc/footer.php');
?>

<script>
  $('.add-ans').click(function (){
    var question = $(this).data('question');
    $('#hidden-question').val(question);
  });

  $('.rm-btn').click(function (){
    var question = $(this).data('question');
    $('#hidden_rm_question').val(question);
    $("#rm-form").submit();
  });
</script>



</body>
</html>
