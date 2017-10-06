<?php
if (!defined('APPPATH'))
	exit('No direct script access allowed');
/**
 * views/template.php
 *
 * Pass in $pagetitle (which will in turn be passed along)
 * and $pagebody, the name of the content view.
 *
 * Yes, this is using an old version of Bootstrap. too bad.
 *
 * ------------------------------------------------------------------------
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>{pagetitle}</title>
    <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css"/>
    <link rel="icon" href="assets/images/xwing-favicon-32x32.png"/>
</head>
<body>
<div class="container">
    <div class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="brand" href="/"><img id="logo" src="/assets/images/xwing.png"/></a>
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse" id="navbar-main">
                {menubar}
            </div>
        </div>
    </div>
    <div id="content">
        <h1>{pagetitle}</h1>
        {content}
    </div>
    <div id="footer" class="span12">
        <div class="panel panel-default">
            <div class="panel-body">
                Copyright &copy; 2017 - WackyDNBC - xwing
            </div>
        </div>
    </div>
    <script src="/assets/js/jquery-1.11.1.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
</div>
</body>
</html>
