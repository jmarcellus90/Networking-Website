<?php
include('template_part/head.php');

$user->student_check(Config::get('csrf_token'));
$teacher = new Teacher;
$topix = new Topics;

if(Config::get('base.request_method') == "POST"){

  if(isset($_POST['add_topic'])){
    extract($_POST);
    if($topic  != ''){
      $topix->addTopic($topic, $editordata);
    }
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
                                    <button class="btn  btn-info" data-toggle="modal" data-target="#add-topic">Add Topic</button>
                                  </div>
                                    <h4 class="c-grey-900 mB-20">Topics List</h4>

                                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0"
                                        width="100%">

                                        <thead>
                                            <tr>
                                                <th> ID </th>
                                                <th> Topic Name </th>
                                                <th> Student List </th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                              <th> ID </th>
                                              <th> Topic Name </th>
                                              <th> Student List </th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                          <?php
                                              $topics = $teacher->getTopics();
                                              foreach($topics as $tp){
                                           ?>

                                            <tr>
                                              <td><?php echo $tp['id']; ?></td>
                                              <td><a href="view_topic.php?topic=<?php echo $tp['id']; ?>&token=<?php echo Config::get('csrf_token'); ?>"><?php echo $tp['name']; ?></a></td>
                                              <td><a href="topic_students.php?topic=<?php echo $tp['id']; ?>&token=<?php echo Config::get('csrf_token'); ?>"><button class="btn  btn-info view-list">View List</button></a></td>

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

    <div class="modal fade" id="add-topic" tabindex="-1" role="dialog" aria-labelledby="newMessageLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Topic</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form class="email-compose-body" method="post" action="">
                              <input type="hidden" name="add_topic" value="1">
                              <input id="hidden-topic" type="hidden" name="topic" value="">
                                <div class="send-header">
                                    <div class="form-group">
                                        <input type="text" name="topic" class="form-control" placeholder="Topic Name">
                                    </div>

                                    <div class="form-group">
                                      <textarea class="summernote" name="editordata"></textarea>
                                    </div>

                                </div>

                                <div id="compose-area"></div>
                                <div class="text-right mrg-top-30">
                                    <button class="btn btn-info">Add Topic</button>
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
  $('.summernote').summernote({
    height: 300,
  });
</script>



</body>
</html>
