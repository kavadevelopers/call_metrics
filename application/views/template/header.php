<!DOCTYPE html>
<html lang="en">

<head>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <title><?php if(isset($_title)){ echo $_title.' | '; } ?><?= get_setting()['name']; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Kava Developers">
    <meta name="keywords" content="Kava Developers">
    <meta name="author" content="Kava Developers">
    <!-- Favicon icon -->
    <link rel="icon" href="<?= base_url() ?>asset/images/favicon.ico" type="image/x-icon">
    <script type="text/javascript" src="<?= base_url() ?>asset/bower_components/jquery/js/jquery.min.js"></script>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/assets/icon/feather/css/feather.css">
    

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/assets/pages/data-table/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/assets/icon/feather/css/feather.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/assets/icon/icofont/css/icofont.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?= base_url() ?>asset/bower_components/bootstrap-daterangepicker/css/daterangepicker.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/bower_components/datepicker/datepicker3.css">
    <!-- PNotify -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/bower_components/pnotify/css/pnotify.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/bower_components/pnotify/css/pnotify.brighttheme.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/bower_components/pnotify/css/pnotify.buttons.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/bower_components/pnotify/css/pnotify.history.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/bower_components/pnotify/css/pnotify.mobile.css">
    
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/bower_components/sweetalert/css/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/assets/croppie/croppie.css">
    <!-- Select 2 css -->
    <link rel="stylesheet" href="<?= base_url() ?>asset/bower_components/select2/css/select2.min.css">

    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/assets/css/jquery.mCustomScrollbar.css">

    <!--forms-wizard css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/bower_components/jquery.steps/css/jquery.steps.css">
</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="ajaxLoader">
        <div class="loader animation-start">
            <span class="circle delay-1 size-2"></span>
            <span class="circle delay-2 size-4"></span>
            <span class="circle delay-3 size-6"></span>
            <span class="circle delay-4 size-7"></span>
            <span class="circle delay-5 size-7"></span>
            <span class="circle delay-6 size-6"></span>
            <span class="circle delay-7 size-4"></span>
            <span class="circle delay-8 size-2"></span>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="javascript:;">
                            <i class="feather icon-menu"></i>
                        </a>
                        <a href="<?= base_url() ?>">
                            <img class="img-fluid" src="<?= base_url() ?>asset/assets/images/logo.png" alt="Theme-Logo">
                        </a>
                        <a class="mobile-options">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <!-- <ul class="nav-left">
                            <li>
                                <a href="javascript:;" onclick="javascript:toggleFullScreen()">
                                    <i class="feather icon-maximize full-screen"></i>
                                </a>
                            </li>
                        </ul> -->
                        <ul class="nav-right">
                            <li class="header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown" id="zeroTodoCounter">
                                        <i class="feather icon-bookmark"></i>
                                        <span class="badge bg-c-pink" id="todoCounter">0</span>
                                    </div>
                                    <ul class="show-notification notification-view dropdown-menu notifyMy" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" id="todoList">
                                        <li>
                                            <h6>To-Do Notifications</h6>
                                            <label class="label label-warning" id="newTodo" style="display: none;">New</label>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown" id="zeroNotificationCounter">
                                        <i class="feather icon-bell"></i>
                                        <span class="badge bg-c-pink" id="notificationCounter">0</span>
                                    </div>
                                    <ul class="show-notification notification-view dropdown-menu notifyMy" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" id="notificationList">
                                        <li>
                                            <h6>Notifications</h6>
                                            <label class="label label-danger" id="newNotification" style="display: none;">New</label>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="<?= base_url() ?>asset/images/user/<?= get_user()['gender'] == 'Male'?'male.png':'female.png' ?>" class="img-radius" alt="User-Profile-Image">
                                        <span><?= get_user()['name']; ?></span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <?php if(get_user()['user_type'] == '0'){ ?>
                                            <li>
                                                <a href="<?= base_url('setting') ?>" class="dis-block">
                                                    <i class="feather icon-settings"></i> Settings
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <li>
                                            <a href="<?= base_url('profile') ?>" class="dis-block">
                                                <i class="feather icon-user"></i> Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('login/logout') ?>" class="dis-block">
                                                <i class="feather icon-log-out"></i> Logout
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>