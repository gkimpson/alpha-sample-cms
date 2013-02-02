<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8" />

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0" />

<!-- Plugin Stylesheets first to ease overrides -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/cms/plugins/colorpicker/colorpicker.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/cms/custom-plugins/wizard/wizard.css" media="screen" />

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/cms/bootstrap/css/bootstrap.min.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/cms/css/fonts/ptsans/stylesheet.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/cms/css/fonts/icomoon/style.css" media="screen" />

<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/cms/css/mws-style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/cms/css/icons/icol16.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/cms/css/icons/icol32.css" media="screen" />

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/cms/css/demo.css" media="screen" />

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/cms/jui/css/jquery.ui.all.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/cms/jui/jquery-ui.custom.css" media="screen" />

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/cms/css/mws-theme.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/cms/css/themer.css" media="screen" />

<? if ($this->uri->segment(3) == 'edit' || $this->uri->segment(3) == 'save') { ?>
<!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/cms/plugins/cleditor/jquery.cleditor.css" media="screen" /> -->
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/cms/plugins/ibutton/jquery.ibutton.css" media="screen" />
<? } ?>

<script type="text/javascript" src="<?= base_url() ?>assets/cms/js/libs/jquery-1.8.2.min.js"></script>

<title>AWD CMS</title>

</head>

<body>

    <!-- Themer (Remove if not needed) -->
    <div id="mws-themer">
        <div id="mws-themer-content">
            <div id="mws-themer-ribbon"></div>
            <div id="mws-themer-toggle">
                <i class="icon-bended-arrow-left"></i>
                <i class="icon-bended-arrow-right"></i>
            </div>
            <div id="mws-theme-presets-container" class="mws-themer-section">
                <label for="mws-theme-presets">Color Presets</label>
            </div>
            <div class="mws-themer-separator"></div>
            <div id="mws-theme-pattern-container" class="mws-themer-section">
                <label for="mws-theme-patterns">Background</label>
            </div>
            <div class="mws-themer-separator"></div>
            <div class="mws-themer-section">
                <ul>
                    <li class="clearfix"><span>Base Color</span> <div id="mws-base-cp" class="mws-cp-trigger"></div></li>
                    <li class="clearfix"><span>Highlight Color</span> <div id="mws-highlight-cp" class="mws-cp-trigger"></div></li>
                    <li class="clearfix"><span>Text Color</span> <div id="mws-text-cp" class="mws-cp-trigger"></div></li>
                    <li class="clearfix"><span>Text Glow Color</span> <div id="mws-textglow-cp" class="mws-cp-trigger"></div></li>
                    <li class="clearfix"><span>Text Glow Opacity</span> <div id="mws-textglow-op"></div></li>
                </ul>
            </div>
            <div class="mws-themer-separator"></div>
            <div class="mws-themer-section">
                <button class="btn btn-danger small" id="mws-themer-getcss">Get CSS</button>
            </div>
        </div>
        <div id="mws-themer-css-dialog">
            <form class="mws-form">
                <div class="mws-form-row">
                    <div class="mws-form-item">
                        <textarea cols="auto" rows="auto" readonly="readonly"></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Themer End -->

    <!-- Header -->
    <div id="mws-header" class="clearfix">

        <!-- Logo Container -->
        <div id="mws-logo-container">

            <!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
            <div id="mws-logo-wrap">
                <? /* <img src="<?= base_url() ?>assets/cms/images/mws-logo.png" alt="mws admin" /> */ ?>
            </div>
        </div>

        <!-- User Tools (notifications, logout, profile, change password) -->
        <div id="mws-user-tools" class="clearfix">

            <? /*
            <!-- Notifications -->
            <div id="mws-user-notif" class="mws-dropdown-menu">
                <a href="<?= base_url() ?>assets/cms/#" data-toggle="dropdown" class="mws-dropdown-trigger"><i class="icon-exclamation-sign"></i></a>

                <!-- Unread notification count -->
                <span class="mws-dropdown-notif">35</span>

                <!-- Notifications dropdown -->
                <div class="mws-dropdown-box">
                    <div class="mws-dropdown-content">
                        <ul class="mws-notifications">
                            <li class="read">
                                <a href="<?= base_url() ?>assets/cms/#">
                                    <span class="message">
                                        Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                                </a>
                            </li>
                            <li class="read">
                                <a href="<?= base_url() ?>assets/cms/#">
                                    <span class="message">
                                        Lorem ipsum dolor sit amet
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                                </a>
                            </li>
                            <li class="unread">
                                <a href="<?= base_url() ?>assets/cms/#">
                                    <span class="message">
                                        Lorem ipsum dolor sit amet
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                                </a>
                            </li>
                            <li class="unread">
                                <a href="<?= base_url() ?>assets/cms/#">
                                    <span class="message">
                                        Lorem ipsum dolor sit amet
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="mws-dropdown-viewall">
                            <a href="<?= base_url() ?>assets/cms/#">View All Notifications</a>
                        </div>
                    </div>
                </div>
            </div>
            */ ?>

            <!-- Messages -->
            <div id="mws-user-message" class="mws-dropdown-menu">
                <a href="<?= base_url() ?>assets/cms/#" data-toggle="dropdown" class="mws-dropdown-trigger"><i class="icon-envelope"></i></a>

                <!-- Unred messages count -->
                <span class="mws-dropdown-notif">35</span>

                <!-- Messages dropdown -->
                <div class="mws-dropdown-box">
                    <div class="mws-dropdown-content">
                        <ul class="mws-messages">
                            <li class="read">
                                <a href="<?= base_url() ?>assets/cms/#">
                                    <span class="sender">John Doe</span>
                                    <span class="message">
                                        Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                                </a>
                            </li>
                            <li class="read">
                                <a href="<?= base_url() ?>assets/cms/#">
                                    <span class="sender">John Doe</span>
                                    <span class="message">
                                        Lorem ipsum dolor sit amet
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                                </a>
                            </li>
                            <li class="unread">
                                <a href="<?= base_url() ?>assets/cms/#">
                                    <span class="sender">John Doe</span>
                                    <span class="message">
                                        Lorem ipsum dolor sit amet
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                                </a>
                            </li>
                            <li class="unread">
                                <a href="<?= base_url() ?>assets/cms/#">
                                    <span class="sender">John Doe</span>
                                    <span class="message">
                                        Lorem ipsum dolor sit amet
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="mws-dropdown-viewall">
                            <a href="<?= base_url() ?>assets/cms/#">View All Messages</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Information and functions section -->
            <div id="mws-user-info" class="mws-inset">

                <!-- User Photo -->
                <div id="mws-user-photo">
                    <img src="<?= base_url() ?>assets/cms/example/profile.jpg" alt="User Photo" />
                </div>

                <!-- Username and Functions -->
                <div id="mws-user-functions">
                    <? if ($this->ion_auth->logged_in()) { ?>
                    <div id="mws-username">
                        Hello, <?= $this->ion_auth->user()->row()->first_name ?> <?= $this->ion_auth->user()->row() ->last_name ?>;
                    </div>
                    <ul>
                        <li><a href="<?= base_url() ?>assets/admin/auth/#">Profile</a></li>
                        <li><a href="<?= base_url() ?>assets/cms/#">Change Password</a></li>
                        <li><a href="<?= base_url() ?>admin/auth/logout">Logout</a></li>
                    </ul>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Main Wrapper -->
    <div id="mws-wrapper">

        <!-- Necessary markup, do not remove -->
        <div id="mws-sidebar-stitch"></div>
        <div id="mws-sidebar-bg"></div>

        <!-- Sidebar Wrapper -->
        <div id="mws-sidebar">

            <!-- Hidden Nav Collapse Button -->
            <div id="mws-nav-collapse">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <!-- Searchbox -->
            <div id="mws-searchbox" class="mws-inset">
                <form action="typography.html">
                    <input type="text" class="mws-search-input" placeholder="Search..." />
                    <button type="submit" class="mws-search-submit"><i class="icon-search"></i></button>
                </form>
            </div>

            <!-- Main Navigation -->
            <div id="mws-navigation">
                <ul>
                    <? /* <li class="active"><a href="<?= base_url() ?>assets/cms/dashboard.html"><i class="icon-home"></i> Dashboard</a></li> */ ?>
                    <li><a href="<?= base_url() ?>admin/pages/"><i class="icon-home"></i> Pages</a></li>
                    <li><a href="<?= base_url() ?>admin/products/"><i class="icon-list"></i> Products</a></li>
                    <li><a href="<?= base_url() ?>admin/categories/"><i class="icon-cogs"></i> Categories</a></li>

                    <? /*
                    <li><a href="<?= base_url() ?>assets/cms/charts.html"><i class="icon-graph"></i> Charts</a></li>
                    <li><a href="<?= base_url() ?>assets/cms/calendar.html"><i class="icon-calendar"></i> Calendar</a></li>
                    <li><a href="<?= base_url() ?>assets/cms/files.html"><i class="icon-folder-closed"></i> File Manager</a></li>
                    <li><a href="<?= base_url() ?>assets/cms/table.html"><i class="icon-table"></i> Table</a></li>
                    <li>
                        <a href="<?= base_url() ?>assets/cms/#"><i class="icon-list"></i> Forms</a>
                        <ul>
                            <li><a href="<?= base_url() ?>assets/cms/form_layouts.html">Layouts</a></li>
                            <li><a href="<?= base_url() ?>assets/cms/form_elements.html">Elements</a></li>
                            <li><a href="<?= base_url() ?>assets/cms/form_wizard.html">Wizard</a></li>
                        </ul>
                    </li>
                    <li><a href="<?= base_url() ?>assets/cms/widgets.html"><i class="icon-cogs"></i> Widgets</a></li>
                    <li><a href="<?= base_url() ?>assets/cms/typography.html"><i class="icon-font"></i> Typography</a></li>
                    <li><a href="<?= base_url() ?>assets/cms/grids.html"><i class="icon-th"></i> Grids &amp; Panels</a></li>
                    <li><a href="<?= base_url() ?>assets/cms/gallery.html"><i class="icon-pictures"></i> Gallery</a></li>
                    <li><a href="<?= base_url() ?>assets/cms/error.html"><i class="icon-warning-sign"></i> Error Page</a></li>
                    */ ?>
                    <li>
                        <? /*
                        <a href="<?= base_url() ?>assets/cms/icons.html">
                            <i class="icon-pacman"></i>
                            Icons <span class="mws-nav-tooltip">2000+</span>
                        </a>
                        */ ?>
                    </li>
                </ul>
            </div>
        </div>


        <!-- Main Container Start -->
        <div id="mws-container" class="clearfix">


            <!-- Inner Container Start -->
            <div class="container">

                <!-- Flashdata message -->
                <? if ($this->session->flashdata('message')) { ?>
                <div style="clear: both; height: 20px;" class="mws-form-message success">
                    <?= $this->session->flashdata('message') ?>
                </div>
                <? } ?>