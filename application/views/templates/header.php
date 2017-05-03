<!DOCTYPE html>
<html lang="en">
<head><title><?php echo (isset($title)) ? $title : 'LKM - UMY'; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/icons/logoUmy.png">
    <link rel="apple-touch-icon" href="i<?php echo base_url() ?>assets/mages/icons/flogoUmy.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url() ?>assets/images/icons/logoUmy.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url() ?>assets/images/icons/logoUmy.png">
    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/bootstrap/css/bootstrap.min.css">
    <!--LOADING STYLESHEET FOR PAGE-->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/intro.js/introjs.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/calendar/zabuto_calendar.min.css">
    <!--Loading style vendors-->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/DataTables/DataTables-1.10.13/css/jquery.dataTables.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/DataTables/TableTools-2.2.4/css/dataTables.tableTools.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/bootstrap-datepicker/css/datepicker.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/animate.css/animate.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/jquery-pace/pace.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/iCheck/skins/all.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/jquery-news-ticker/jquery.news-ticker.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!--Loading style-->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/css/themes/style1/pink-violet.css" id="theme-change" class="style-change color-change">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/css/style-responsive.css">
</head>
<body class="sidebar-colors">
<div><!--BEGIN THEME SETTING-->
    <!--div id="theme-setting"><a href="#" data-toggle="dropdown" data-step="1" data-intro="&lt;b&gt;Many styles&lt;/b&gt; and &lt;b&gt;colors&lt;/b&gt; be created for you. Let choose one and enjoy it!" data-position="left" class="btn-theme-setting"><i class="fa fa-cog"></i></a>

        <div class="content-theme-setting"><h4 class="mtn">Theme Styles</h4><select id="list-style" class="form-control">
            <option value="style1">Flat Squared style</option>
            <option value="style2">Flat Rounded style</option>
            <option value="style3" selected="selected">Flat Border style</option>
        </select><br/><h4 class="mtn">Theme Colors</h4>
            <ul id="list-color" class="list-unstyled list-inline">
                <li data-color="green-dark" data-hover="tooltip" title="Green - Dark" class="green-dark"></li>
                <li data-color="red-dark" data-hover="tooltip" title="Red - Dark" class="red-dark"></li>
                <li data-color="pink-dark" data-hover="tooltip" title="Pink - Dark" class="pink-dark"></li>
                <li data-color="blue-dark" data-hover="tooltip" title="Blue - Dark" class="blue-dark"></li>
                <li data-color="yellow-dark" data-hover="tooltip" title="Yellow - Dark" class="yellow-dark"></li>
                <li data-color="green-grey" data-hover="tooltip" title="Green - Grey" class="green-grey"></li>
                <li data-color="red-grey" data-hover="tooltip" title="Red - Grey" class="red-grey"></li>
                <li data-color="pink-grey" data-hover="tooltip" title="Pink - Grey" class="pink-grey"></li>
                <li data-color="blue-grey" data-hover="tooltip" title="Blue - Grey" class="blue-grey"></li>
                <li data-color="yellow-grey" data-hover="tooltip" title="Yellow - Grey" class="yellow-grey"></li>
                <li data-color="yellow-green" data-hover="tooltip" title="Yellow - Green" class="yellow-green"></li>
                <li data-color="orange-grey" data-hover="tooltip" title="Orange - Grey" class="orange-grey"></li>
                <li data-color="pink-blue" data-hover="tooltip" title="Pink - Blue" class="pink-blue"></li>
                <li data-color="pink-violet" data-hover="tooltip" title="Pink - Violet" class="pink-violet active"></li>
                <li data-color="orange-violet" data-hover="tooltip" title="Orange - Violet" class="orange-violet"></li>
                <li data-color="pink-green" data-hover="tooltip" title="Pink - Green" class="pink-green"></li>
                <li data-color="pink-brown" data-hover="tooltip" title="Pink - Brown" class="pink-brown"></li>
                <li data-color="orange-blue" data-hover="tooltip" title="Orange - Blue" class="orange-blue"></li>
                <li data-color="yellow-blue" data-hover="tooltip" title="Yellow - Blue" class="yellow-blue"></li>
                <li data-color="green-blue" data-hover="tooltip" title="Green - Blue" class="green-blue"></li>
            </ul>
        </div>
    </div-->
    <!--END THEME SETTING--><!--BEGIN BACK TO TOP--><a id="totop" href="#"><i class="fa fa-angle-up"></i></a><!--END BACK TO TOP-->