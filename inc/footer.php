
      <script type="text/javascript" src="vendor.js"></script>
      <script type="text/javascript" src="bundle.js"></script>
      <!-- jQuery -->
  		<script src="bower_components/jquery/dist/jquery.min.js"></script>

  		<!-- Bootstrap Core JavaScript -->
  		<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  		<!-- Summernote Plugin JavaScript -->
  		<script src="bower_components/summernote/dist/summernote.min.js"></script>

      <script type="text/javascript" src="selected.js"></script>
      <script type="text/javascript" src="tasks.js"></script>


      <script>
        $('#click-seen').click(function (){
            $('#notificationAmount').html('0');
            $.ajax({
               url: "ajax-request.php",
               type: 'POST',
               dataType: 'json',
               data: {
                 'to_user': '<?php echo $_SESSION['user']['user_name']; ?>',
                 'type': 'set_seen'
               }
             }).done(function(results) {
                console.log(results);
             });
        });
      </script>
