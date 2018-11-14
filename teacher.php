<?php
include('template_part/head.php');

$user->student_check(Config::get('csrf_token'));
$teacher = new Teacher;
$uniqID = strtoupper(uniqid(rand(00000, 99999999)));

if(Config::get('base.request_method') == "POST"){
  if(isset($_POST['add_student'])){
    extract($_POST);
    $user->addStudent($stu_id, $f_name, $l_name, $email, $username, $password);
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
                                    <button class="btn  btn-info" data-toggle="modal" data-target="#add-user">Add Student</button>
                                  </div>
                                    <h4 class="c-grey-900 mB-20">Student Information</h4>

                                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0"
                                        width="100%">

                                        <thead>
                                            <tr>
                                                <th> ID </th>
                                                <th> Student ID </th>
                                                <th> First Name </th>
                                                <th> Last Name </th>
                                                <th> Username </th>
                                                <th> Email </th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                              <th> ID </th>
                                              <th> Student ID </th>
                                              <th> First Name </th>
                                              <th> Last Name </th>
                                              <th> Username </th>
                                              <th> Email </th>
                                              <th> Action </th>

                                            </tr>
                                        </tfoot>
                                        <tbody>

                                          <?php
                                            $students = $teacher->getStudents();
                                            foreach($students as $student){ ?>
                                            <tr>
                                              <td><?php echo $student['id']; ?></td>
                                              <td><a href="student_topics.php?student=<?php echo $student['id']; ?>&token=<?php echo Config::get('csrf_token'); ?>"><?php echo $student['student_id']; ?></a></td>
                                              <td><?php echo $student['first_name']; ?></td>
                                              <td><?php echo $student['last_name']; ?></td>
                                              <td><?php echo $student['user_name']; ?></td>
                                              <td><?php echo $student['email']; ?></td>
                                              <td><button data-student="<?php echo $student['id']; ?>" class="btn  btn-danger rm-student">Remove</button></td>


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



    <div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="newMessageLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="email-compose-body" method="post" action="">
                                              <input type="hidden" name="add_student" value="1">
                                              <input type="hidden" name="stu_id" value="<?php echo $uniqID; ?>">
                                                <h4 class="c-grey-900 mB-20">Student# <?php echo $uniqID; ?></h4>
                                                <div class="send-header">
                                                    <div class="form-group">
                                                        <input type="text" name="f_name" class="form-control" placeholder="First Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="l_name" class="form-control" placeholder="Last Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="email" class="form-control" placeholder="Email">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="username" class="form-control" placeholder="Username">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" name="password" class="form-control" placeholder="Passwrod">
                                                    </div>

                                                </div>

                                                <div id="compose-area"></div>
                                                <div class="text-right mrg-top-30">
                                                    <button class="btn btn-info">Add Student</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>



<?php
include('inc/footer.php');
?>

<script>
  $('.rm-student').click(function (){
    var student = $(this).data('student');
      $.ajax({
         url: "ajax-request.php",
         type: 'POST',
         dataType: 'json',
         data: {
           'student': student,
           'type': 'remove_student'
         }
       }).done(function(results) {
          location.reload();
       });
  });
</script>


</body>
</html>
