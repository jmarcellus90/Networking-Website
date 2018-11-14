<?php
include('template_part/head.php');

$user->student_check(Config::get('csrf_token'));
$teacher = new Teacher;
$topix = new Topics;
$question_id = $_GET['question'];

if(Config::get('base.request_method') == "POST"){



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
                                  </div>
                                    <h4 class="c-grey-900 mB-20">Answer List</h4>

                                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0"
                                        width="100%">

                                        <thead>
                                            <tr>
                                                <th> ID </th>
                                                <th> The Answer </th>
                                                <th> Correct </th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                              <th> ID </th>
                                              <th> The Answer </th>
                                              <th> Correct </th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                          <?php
                                              $questions = $topix->getQuestionAnswers($question_id);
                                              foreach($questions as $tp){
                                           ?>

                                            <tr>
                                              <td><?php echo $tp['id']; ?></td>
                                              <td><?php echo $tp['description']; ?></td>
                                              <?php if($tp['correct'] == 1){ ?>
                                                  <td><span class="label label-success">Correct Answer</span></td>
                                              <?php }else{ ?>
                                                  <td><span class="label label-danger">Wrong Answer</span></td>
                                              <?php } ?>

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
