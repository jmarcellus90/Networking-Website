<?php
include('template_part/head.php');



if(Config::get('base.request_method') == "POST"){
  extract($_POST);
  $msg->sendMessage($to_user,$task_subject,$task_text,$token);
}

include('inc/header.php');

?>
        
            <main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="full-container">
                        <div class="email-app">
                            <div class="email-side-nav remain-height ov-h">
                                <div class="h-100 layers">
                                    <div class="p-20 bgc-grey-100 layer w-100">
                                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                                            data-target="#newMessage">New Message</button>
                                    </div>
                                    <div class="scrollable pos-r bdT layer w-100 fxg-1">
                                        <ul class="p-20 nav flex-column">
                                            <li class="nav-item">
                                                <a href="javascript:void(0)" class="nav-link c-grey-800 cH-blue-500 active">
                                                    <div class="peers ai-c jc-sb">
                                                        <div class="peer peer-greed" onclick="showTaskInbox()"><i class="mR-10 ti-email"></i>
                                                            <span>Inbox</span></div>
                                                        <div class="peer"><span id="id_no_of_tasks_inbox" class="badge badge-pill bgc-deep-purple-50 c-deep-purple-700"><?php echo $msg->inboxCount(); ?></span></div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="javascript:void(0)" class="nav-link c-grey-800 cH-blue-500">
                                                    <div class="peers ai-c jc-sb">
                                                        <div class="peer peer-greed" onclick="showTaskSent()"><i class="mR-10 ti-share"></i>
                                                            <span>Sent</span></div>
                                                        <div class="peer"><span class="badge badge-pill bgc-green-50 c-green-700"><?php echo $msg->sentCount(); ?></span></div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="newMessage" tabindex="-1" role="dialog" aria-labelledby="newMessageLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">New Message</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="email-compose-body" method="post" action="<?php echo Config::get('base.action'); ?>">
                                              <input type="hidden" name="token" value="<?php echo Config::get('csrf_token'); ?>"
                                                <h4 class="c-grey-900 mB-20">Send Message</h4>
                                                <div class="send-header">
                                                    <div class="form-group">
                                                        <input type="text" name="to_user" class="form-control"
                                                            placeholder="To username...">
                                                    </div>
                                                    <div class="form-group">
                                                        <input name="task_subject" class="form-control" placeholder="Message Subject">
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea name="task_text" class="form-control" placeholder="Say Hi..."
                                                            rows="10"></textarea>
                                                    </div>
                                                </div>

                                                <div id="compose-area"></div>
                                                <div class="text-right mrg-top-30">
                                                    <button class="btn btn-danger">Send</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="email-wrapper row remain-height bgc-white ov-h">
                                <div class="email-list h-100 layers">
                                    <div class="layer w-100">
                                        <div class="bgc-grey-100 peers ai-c jc-sb p-20 fxw-nw">
                                            <div class="peer">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="email-side-toggle d-n@md+ btn bgc-white bdrs-2 mR-3 cur-p"><i
                                                            class="ti-menu"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="layer w-100 fxg-1 scrollable pos-r">
                                        <div class="" id="task_inbox">
                                          <?php
                                            $messages = $msg->inboxMessages();
                                            foreach($messages as $message){

                                          ?>

                                            <div data-sub="<?php echo $message['subject']; ?>" data-sent-time="<?php $date = date_create($message['sent_date']); echo date_format($date, 'r'); ?>" data-to="<?php echo $message['to_user']; ?>" data-from="<?php echo $message['from_user']; ?>" data-ms="<?php echo $message['message']; ?>" class="email-list-item peers fxw-nw p-20 bdB bgcH-grey-100 cur-p inbox-message">
                                                <div class="peer peer-greed ov-h">
                                                    <div class="peers ai-c">
                                                        <div class="peer peer-greed">
                                                            <h6><?php echo $message['from_user']; ?></h6>
                                                        </div>
                                                        <div class="peer"><small><?php echo $message['time_passed']; ?> mins ago</small></div>
                                                    </div>
                                                    <h5 class="fsz-def tt-c c-grey-900"><?php echo $message['subject']; ?></h5>
                                                    <span class="whs-nw w-100 ov-h tov-e d-b"><?php echo $message['message']; ?></span>
                                                </div>
                                            </div>

                                          <?php } ?>

                                        </div>
                                        <div class="" id="task_sent">


                                          <?php
                                            $sent = $msg->sentMessages();
                                            foreach($sent as $se){

                                          ?>

                                            <div data-sub="<?php echo $se['subject']; ?>" data-sent-time="<?php $date = date_create($se['sent_date']); echo date_format($date, 'r'); ?>" data-to="<?php echo $se['to_user']; ?>" data-from="<?php echo $se['from_user']; ?>" data-ms="<?php echo $se['message']; ?>" class="email-list-item peers fxw-nw p-20 bdB bgcH-grey-100 cur-p inbox-message">
                                                <div class="peer peer-greed ov-h">
                                                    <div class="peers ai-c">
                                                        <div class="peer peer-greed">
                                                            <h6><?php echo $se['to_user']; ?></h6>
                                                        </div>
                                                        <div class="peer"><small><?php echo $se['time_passed']; ?> mins ago</small></div>
                                                    </div>
                                                    <h5 class="fsz-def tt-c c-grey-900"><?php echo $se['subject']; ?></h5>
                                                    <span class="whs-nw w-100 ov-h tov-e d-b"><?php echo $se['message']; ?></span>
                                                </div>
                                            </div>

                                          <?php } ?>


                                        </div>
                                    </div>
                                </div>
                                <div class="email-content h-100">
                                    <div class="h-100 scrollable pos-r">
                                        <div class="bgc-grey-100 peers ai-c jc-sb p-20 fxw-nw d-n@md+">
                                            <div class="peer">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="back-to-mailbox btn bgc-white bdrs-2 mR-3 cur-p"><i
                                                            class="ti-angle-left"></i></button>
                                                </div>
                                            </div>
                                            <div class="peer">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="fsz-xs btn bgc-white bdrs-2 mR-3 cur-p"><i
                                                            class="ti-angle-left"></i></button>
                                                    <button type="button" class="fsz-xs btn bgc-white bdrs-2 mR-3 cur-p"><i
                                                            class="ti-angle-right"></i></button>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="email-content-wrapper">
                                            <div class="peers ai-c jc-sb pX-40 pY-30">
                                                <div class="peers peer-greed">
                                                    <div class="peer"><small id="sent-time"></small>
                                                        <h5 class="c-grey-900 mB-5" id="user-from"></h5><span id="user-to"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bdT pX-40 pY-30">
                                                <h4 id="subj"></h4>
                                                <p id="mess"></p>
                                            </div>
                                        </div>




                                    </div>
                                </div>
                            </div>
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
  $('.inbox-message').click(function (){

    var subject = $(this).data('sub');
    var from = $(this).data('from');
    var to = $(this).data('to');
    var time = $(this).data('sent-time');
    var message = $(this).data('ms');

    $("#sent-time").html(time);
    $("#user-from").html("From: "+from);
    $("#user-to").html("To: "+to);
    $("#subj").html(subject);
    $("#mess").html(message);
  });


</script>

</body>
</html>
