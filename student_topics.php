<?php
include('template_part/head.php');

$user->student_check(Config::get('csrf_token'));
$teacher = new Teacher;
$topix = new Topics;

$student_id = $_GET['student'];



include('inc/header.php');
?>

            <main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container-fluid">
                        <h4 class="c-grey-900 mT-10 mB-30"><?php echo $user->studentData($student_id, 'first_name'); ?> <?php echo $user->studentData($student_id, 'last_name'); ?>'s Data</h4>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="bgc-white bd bdrs-3 p-20 mB-20">

                                    <h4 class="c-grey-900 mB-20">Grades</h4>

                                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0"
                                        width="100%">

                                        <thead>
                                            <tr>
                                                <th> Topic Name </th>
                                                <th> Topic Total Grade </th>
                                                <th> <?php echo $user->studentData($student_id, 'first_name'); ?> <?php echo $user->studentData($student_id, 'last_name'); ?>'s Grade </th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                          <tr>
                                              <th> Topic Name </th>
                                              <th> Topic Total Grade </th>
                                              <th> <?php echo $user->studentData($student_id, 'first_name'); ?> <?php echo $user->studentData($student_id, 'last_name'); ?>'s Grade </th>
                                          </tr>
                                        </tfoot>
                                        <tbody>

                                          <?php
                                             $grades = $teacher->getStudentGrades($student_id);
                                             foreach($grades as $grade){
                                          ?>

                                            <tr>
                                              <td><?php echo $grade['name']; ?></td>
                                              <td>10</td>
                                              <td><?php echo $grade['value']; ?></td>

                                            </tr>

                                          <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-md-12">
                                <div class="bgc-white bd bdrs-3 p-20 mB-20">

                                    <h4 class="c-grey-900 mB-20">Topics List</h4>

                                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0"
                                        width="100%">

                                        <thead>
                                            <tr>
                                                <th> ID </th>
                                                <th> Topic Name </th>
                                                <th> Permission </th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                          <tr>
                                              <th> ID </th>
                                              <th> Topic Name </th>
                                              <th> Permission </th>
                                          </tr>
                                        </tfoot>
                                        <tbody>

                                          <?php
                                              $topics = $teacher->getTopics();
                                              foreach($topics as $tp){
                                           ?>

                                            <tr>
                                              <td><?php echo $tp['id']; ?></td>
                                              <td><?php echo $tp['name']; ?></td>
                                              <?php if($topix->checkStudentPermission($student_id, $tp['id']) > 0){ ?>
                                                <td><button class="btn btn-danger rm-student" data-topic="<?php echo $tp['id']; ?>" data-student="<?php echo $student_id; ?>">Remove Topic</button></td>
                                              <?php }else{ ?>
                                                <td><button class="btn btn-info add-student" data-topic="<?php echo $tp['id']; ?>" data-student="<?php echo $student_id; ?>">Add Topic</button></td>
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









<?php
include('inc/footer.php');
?>

<script>
  $('.add-student').click(function (){
    var student = $(this).data('student');
    var topic = $(this).data('topic');
      $.ajax({
         url: "ajax-request.php",
         type: 'POST',
         dataType: 'json',
         data: {
           'student': student,
           'topic': topic,
           'type': 'add_student_topic_permission'
         }
       }).done(function(results) {
          location.reload();
       });
  });

  $('.rm-student').click(function (){
    var student = $(this).data('student');
    var topic = $(this).data('topic');
      $.ajax({
         url: "ajax-request.php",
         type: 'POST',
         dataType: 'json',
         data: {
           'student': student,
           'topic': topic,
           'type': 'remove_student_topic_permission'
         }
       }).done(function(results) {
          location.reload();
       });
  });
</script>



</body>
</html>
