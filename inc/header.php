<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>Dashboard</title>
    <style>
        #loader {
         transition: all .3s ease-in-out;
         opacity: 1;
         visibility: visible;
         position: fixed;
         height: 100vh;
         width: 100%;
         background: #fff;
         z-index: 90000
         }
         #loader.fadeOut {
         opacity: 0;
         visibility: hidden
         }
         .spinner {
         width: 40px;
         height: 40px;
         position: absolute;
         top: calc(50% - 20px);
         left: calc(50% - 20px);
         background-color: #333;
         border-radius: 100%;
         -webkit-animation: sk-scaleout 1s infinite ease-in-out;
         animation: sk-scaleout 1s infinite ease-in-out
         }
         @-webkit-keyframes sk-scaleout {
         0% {
         -webkit-transform: scale(0)
         }
         100% {
         -webkit-transform: scale(1);
         opacity: 0
         }
         }
         @keyframes sk-scaleout {
         0% {
         -webkit-transform: scale(0);
         transform: scale(0)
         }
         100% {
         -webkit-transform: scale(1);
         transform: scale(1);
         opacity: 0
         }
         }
      </style>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="style.css">
    <!-- Summernote css -->
		<link rel="stylesheet" href="bower_components/summernote/dist/summernote.css" />




</head>

<body class="app">
    <div id="loader">
        <div class="spinner"></div>
    </div>
    <script>
        window.addEventListener('load', () => {
            const loader = document.getElementById('loader');
            setTimeout(() => {
                loader.classList.add('fadeOut');
            }, 300);
        });
    </script>
    <div>
        <div class="sidebar">
            <div class="sidebar-inner">
                <div class="sidebar-logo">
                    <div class="peers ai-c fxw-nw">
                        <div class="peer peer-greed">
                            <a class="sidebar-link td-n" href="index.php">
                                <div class="peers ai-c fxw-nw">
                                    <div class="peer">
                                        <div class="logo"><img src="./images/logo.png" alt=""></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="peer">
                            <div class="mobile-toggle sidebar-toggle"><a href="" class="td-n"><i class="ti-arrow-circle-left"></i></a></div>
                        </div>
                    </div>
                </div>
                <ul class="sidebar-menu scrollable pos-r">
                    <li class="nav-item mT-30 active"><a class="sidebar-link" href="index.php?token=<?php echo Config::get('csrf_token'); ?>"><span class="icon-holder"><i
                                    class="c-blue-500 ti-home"></i> </span><span class="title">Dashboard</span></a></li>
                    <li class="nav-item"><a class="sidebar-link" href="email.php?token=<?php echo Config::get('csrf_token'); ?>"><span class="icon-holder"><i class="c-brown-500 ti-email"></i>
                            </span><span class="title">Messages</span></a></li>

                    <?php if($_SESSION['user']['access_level'] == 1){ ?>
                      <li class="nav-item"><a class="sidebar-link" href="topics.php?token=<?php echo Config::get('csrf_token'); ?>"><span class="icon-holder"><i class="c-brown-500 ti-menu-alt"></i>
                      </span><span class="title">Topics</span></a></li>
                    <?php } ?>

                </ul>
            </div>
        </div>

        <div class="page-container">
            <div class="header navbar">
                <div class="header-container">
                    <ul class="nav-left">
                        <li><a id="sidebar-toggle" class="sidebar-toggle" href="javascript:void(0);"><i class="ti-menu"></i></a></li>
                    </ul>
                    <ul class="nav-right">
                        <li id="click-seen" class="notifications dropdown">
                            <span id="notificationAmount" class="counter bgc-blue"><?php echo $msg->unSeenMessagesCount(); ?></span> <a href="" class="dropdown-toggle no-after"
                                data-toggle="dropdown"><i class="ti-email"></i></a>
                            <ul class="dropdown-menu">
                                <li class="pX-20 pY-15 bdB"><i class="ti-email pR-10"></i> <span class="fsz-sm fw-600 c-grey-900">Messages</span></li>
                                <li>
                                    <ul class="ovY-a pos-r scrollable lis-n p-0 m-0 fsz-sm">

                                      <?php
                                        $unseens = $msg->unSeenMessages();
                                        foreach($unseens as $un){
                                      ?>

                                      <li>
                                          <a href="email.php?token=<?php echo Config::get('csrf_token'); ?>" class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100">
                                              <div class="peer peer-greed">
                                                  <div>
                                                      <div class="peers jc-sb fxw-nw mB-5">
                                                          <div class="peer">
                                                              <p class="fw-500 mB-0"><?php echo $un['from_user']; ?></p>
                                                          </div>
                                                          <div class="peer"><small class="fsz-xs"><?php echo $un['time_passed']; ?> mins ago</small></div>
                                                      </div><span class="c-grey-600 fsz-sm"><?php echo $un['subject']; ?></span></div>
                                              </div>
                                          </a>
                                      </li>

                                    <?php } ?>

                                    </ul>
                                </li>
                                <li class="pX-20 pY-15 ta-c bdT"><span><a href="/messages" class="c-grey-600 cH-blue fsz-sm td-n">View
                                            All Messages <i class="fs-xs ti-angle-right mL-10"></i></a></span></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown">
                                <div class="peer"><span class="fsz-sm c-grey-900"><?php echo $_SESSION['user']['user_name']; ?></span></div>
                            </a>
                            <ul class="dropdown-menu fsz-sm">
                                <li><a href="<?php echo Config::get('base.action'); ?>?logout=true" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-power-off mR-10"></i>
                                        <span>Logout</span></a></li>
                            </ul>
                        </li>
                        </li>
                    </ul>
                </div>
            </div>
