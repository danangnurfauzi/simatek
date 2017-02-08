<div id="wrapper"><!--BEGIN SIDEBAR MENU-->
        <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;" data-position="right" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse menu-scroll">
                <ul id="side-menu" class="nav">
                    <li class="user-panel">
                        <div class="thumb"><img src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/128.jpg" alt="" class="img-circle"/></div>
                        <div class="info"><p>John Doe</p>
                            <ul class="list-inline list-unstyled">
                                <li><a href="extra-profile.html" data-hover="tooltip" title="Profile"><i class="fa fa-user"></i></a></li>
                                <li><a href="email-inbox.html" data-hover="tooltip" title="Mail"><i class="fa fa-envelope"></i></a></li>
                                <li><a href="#" data-hover="tooltip" title="Setting" data-toggle="modal" data-target="#modal-config"><i class="fa fa-cog"></i></a></li>
                                <li><a href="extra-signin.html" data-hover="tooltip" title="Logout"><i class="fa fa-sign-out"></i></a></li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </li>

                    <?php switch ($_SESSION['roleId']) {
                        case '1': //superadmin
                     ?>

                     <li class="<?php echo ($this->uri->segment(2) == 'dashboard') ? 'active' : '' ?>"><a href="<?php echo site_url('home/dashboard') ?>"><i class="fa fa-tachometer fa-fw">
                        <div class="icon-bg bg-orange"></div>
                    </i><span class="menu-title">Dashboard</span></a></li>
                    <li><a href="#"><i class="fa fa-user">
                        <div class="icon-bg bg-pink"></div>
                    </i><span class="menu-title">Manajemen User</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo site_url('user/userList') ?>"><i class="fa fa-angle-right"></i><span class="submenu-title">Daftar User</span></a></li>
                            <li><a href="<?php echo site_url('produk/barang') ?>"><i class="fa fa-angle-right"></i><span class="submenu-title">Reset Password</span></a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-money">
                        <div class="icon-bg bg-red"></div>
                    </i><span class="menu-title">Manajemen Anggaran</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo site_url('anggaran/rancangan/jenis') ?>"><i class="fa fa-angle-right"></i><span class="submenu-title">Jenis Anggaran</span></a></li>
                            <li><a href="<?php echo site_url('anggaran/rancangan/set') ?>"><i class="fa fa-angle-right"></i><span class="submenu-title">Set Anggaran</span></a></li>
                            <li><a href="<?php echo site_url('anggaran/rancangan/relasi') ?>"><i class="fa fa-angle-right"></i><span class="submenu-title">Relasi Anggaran</span></a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-pencil-square-o">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Manajemen Proposal</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo site_url('proposal/pengajuan/daftar') ?>"><i class="fa fa-angle-right"></i><span class="submenu-title">Daftar Proposal</span></a></li>
                            <li><a href="<?php echo site_url('proposal/pengajuan/waiting') ?>"><i class="fa fa-angle-right"></i><span class="submenu-title">Proposal Masuk</span></a></li>
                            <li><a href="<?php echo site_url('proposal/pengajuan/accepted') ?>"><i class="fa fa-angle-right"></i><span class="submenu-title">Proposal Diterima</span></a></li>
                            <li><a href="<?php echo site_url('proposal/pengajuan/blocked') ?>"><i class="fa fa-angle-right"></i><span class="submenu-title">Proposal Ditolak</span></a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-file-text-o">
                        <div class="icon-bg bg-violet"></div>
                    </i><span class="menu-title">Manajemen LPJ</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo site_url('proposal/laporan/daftar') ?>"><i class="fa fa-angle-right"></i><span class="submenu-title">Daftar</span></a></li>
                            <!--li><a href="<?php echo site_url('invoice/paid') ?>"><i class="fa fa-angle-right"></i><span class="submenu-title">Paid</span></a></li>
                            </a></li-->
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-print">
                        <div class="icon-bg bg-red"></div>
                    </i><span class="menu-title">Manajemen Laporan</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo site_url('invoice/unpaid') ?>"><i class="fa fa-angle-right"></i><span class="submenu-title">Unpaid</span></a></li>
                            <li><a href="<?php echo site_url('invoice/paid') ?>"><i class="fa fa-angle-right"></i><span class="submenu-title">Paid</span></a></li>
                            </a></li>
                        </ul>
                    </li>

                     <?php       
                            break;
                        
                        case '2': //lkm

                    ?>

                    <li class="<?php echo ($this->uri->segment(2) == 'dashboard') ? 'active' : '' ?>"><a href="<?php echo site_url('home/dashboard') ?>"><i class="fa fa-tachometer fa-fw">
                        <div class="icon-bg bg-orange"></div>
                        </i><span class="menu-title">Dashboard</span></a>
                    </li>
                    <li><a href="#"><i class="fa fa-pencil-square-o">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Manajemen Proposal</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo site_url('proposal/pengajuan/daftar') ?>"><i class="fa fa-angle-right"></i><span class="submenu-title">Daftar Proposal</span></a></li>
                        </ul>
                    </li>

                    <?php

                            break;

                        case '3': //wadek 1
                    ?>

                    <li class="<?php echo ($this->uri->segment(2) == 'dashboard') ? 'active' : '' ?>"><a href="<?php echo site_url('home/dashboard') ?>"><i class="fa fa-tachometer fa-fw">
                        <div class="icon-bg bg-orange"></div>
                        </i><span class="menu-title">Dashboard</span></a>
                    </li>
                    <li><a href="#"><i class="fa fa-pencil-square-o">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Manajemen Proposal</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo site_url('proposal/pengajuan/daftar') ?>"><i class="fa fa-angle-right"></i><span class="submenu-title">Daftar Proposal</span></a></li>
                        </ul>
                    </li>

                    <?php
                            break;

                        case '4': //wadek 2
                    ?>

                    <li class="<?php echo ($this->uri->segment(2) == 'dashboard') ? 'active' : '' ?>"><a href="<?php echo site_url('home/dashboard') ?>"><i class="fa fa-tachometer fa-fw">
                        <div class="icon-bg bg-orange"></div>
                        </i><span class="menu-title">Dashboard</span></a>
                    </li>
                    <li><a href="#"><i class="fa fa-pencil-square-o">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Manajemen Proposal</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo site_url('proposal/pengajuan/daftar') ?>"><i class="fa fa-angle-right"></i><span class="submenu-title">Daftar Proposal</span></a></li>
                        </ul>
                    </li>

                    <?php
                            break;

                        case '5': //prodi
                    ?>

                    <li class="<?php echo ($this->uri->segment(2) == 'dashboard') ? 'active' : '' ?>"><a href="<?php echo site_url('home/dashboard') ?>"><i class="fa fa-tachometer fa-fw">
                        <div class="icon-bg bg-orange"></div>
                        </i><span class="menu-title">Dashboard</span></a>
                    </li>
                    <li><a href="#"><i class="fa fa-pencil-square-o">
                        <div class="icon-bg bg-green"></div>
                    </i><span class="menu-title">Manajemen Proposal</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo site_url('proposal/pengajuan/daftar') ?>"><i class="fa fa-angle-right"></i><span class="submenu-title">Daftar Proposal</span></a></li>
                        </ul>
                    </li>
                    
                    <?php
                            break;
                    }
                    ?>
                    
                </ul>
            </div>
        </nav>
        <!--END SIDEBAR MENU--><!--BEGIN CHAT FORM-->
        <div id="chat-form" class="fixed">
            <div class="chat-inner"><h2 class="chat-header"><a href="javascript:;" class="chat-form-close pull-right"><i class="glyphicon glyphicon-remove"></i></a><i class="fa fa-user"></i>&nbsp;
                Chat
                &nbsp;<span class="badge badge-info">3</span></h2>

                <div id="group-1" class="chat-group"><strong>Favorites</strong><a href="#"><span class="user-status is-online"></span>
                    <small>Verna Morton</small>
                    <span class="badge badge-info">2</span></a><a href="#"><span class="user-status is-online"></span>
                    <small>Delores Blake</small>
                    <span class="badge badge-info is-hidden">0</span></a><a href="#"><span class="user-status is-busy"></span>
                    <small>Nathaniel Morris</small>
                    <span class="badge badge-info is-hidden">0</span></a><a href="#"><span class="user-status is-idle"></span>
                    <small>Boyd Bridges</small>
                    <span class="badge badge-info is-hidden">0</span></a><a href="#"><span class="user-status is-offline"></span>
                    <small>Meredith Houston</small>
                    <span class="badge badge-info is-hidden">0</span></a></div>
                <div id="group-2" class="chat-group"><strong>Office</strong><a href="#"><span class="user-status is-busy"></span>
                    <small>Ann Scott</small>
                    <span class="badge badge-info is-hidden">0</span></a><a href="#"><span class="user-status is-offline"></span>
                    <small>Sherman Stokes</small>
                    <span class="badge badge-info is-hidden">0</span></a><a href="#"><span class="user-status is-offline"></span>
                    <small>Florence Pierce</small>
                    <span class="badge badge-info">1</span></a></div>
                <div id="group-3" class="chat-group"><strong>Friends</strong><a href="#"><span class="user-status is-online"></span>
                    <small>Willard Mckenzie</small>
                    <span class="badge badge-info is-hidden">0</span></a><a href="#"><span class="user-status is-busy"></span>
                    <small>Jenny Frazier</small>
                    <span class="badge badge-info is-hidden">0</span></a><a href="#"><span class="user-status is-offline"></span>
                    <small>Chris Stewart</small>
                    <span class="badge badge-info is-hidden">0</span></a><a href="#"><span class="user-status is-offline"></span>
                    <small>Olivia Green</small>
                    <span class="badge badge-info is-hidden">0</span></a></div>
            </div>
            <div id="chat-box" style="top:400px">
                <div class="chat-box-header"><a href="#" class="chat-box-close pull-right"><i class="glyphicon glyphicon-remove"></i></a><span class="user-status is-online"></span><span class="display-name">Willard Mckenzie</span>
                    <small>Online</small>
                </div>
                <div class="chat-content">
                    <ul class="chat-box-body">
                        <li><p><img src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/128.jpg" class="avt"/><span class="user">John Doe</span><span class="time">09:33</span></p>

                            <p>Hi Swlabs, we have some comments for you.</p></li>
                        <li class="odd"><p><img src="https://s3.amazonaws.com/uifaces/faces/twitter/alagoon/48.jpg" class="avt"/><span class="user">Swlabs</span><span class="time">09:33</span></p>

                            <p>Hi, we're listening you...</p></li>
                    </ul>
                </div>
                <div class="chat-textarea"><input placeholder="Type your message" class="form-control"/></div>
            </div>
        </div>
        <!--END CHAT FORM-->