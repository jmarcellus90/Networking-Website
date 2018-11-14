<?php
include('template_part/head.php');

$user->student_check(Config::get('csrf_token'));
$teacher = new Teacher;
$topix = new Topics;

$topic = $_GET['topic'];



include('inc/header.php');
?>

            <main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container-fluid">
                        <h4 class="c-grey-900 mT-10 mB-30">Teacher Dashboard</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                                    <h4 class="c-grey-900 mB-20">User List</h4>

                                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0"
                                        width="100%">

                                        <thead>
                                            <tr>
                                                <th> ID </th>
                                                <th> Username </th>
                                                <th> Email </th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                              <th> ID </th>
                                              <th> Username </th>
                                              <th> Email </th>
                                              <th> Action </th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                          <?php
                                              $list = $topix->studentList($topic);
                                              foreach($list as $l){
                                           ?>

                                            <tr>
                                              <td><?php echo $l['id']; ?></td>
                                              <td><?php echo $l['user_name']; ?></td>
                                              <td><?php echo $l['email']; ?></td>
                                              <td><button class="btn  btn-danger rm-student" data-topic="<?php echo $topic; ?>" data-student="<?php echo $l['id']; ?>">Remove</button></td>
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
           'type': 'remove_student_topic'
         }
       }).done(function(results) {
          location.reload();
       });
  });
</script>



</body>
</html>
