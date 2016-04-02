<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Test Blog</title>
    <meta name="generator" content="Test" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="/css/styles.css" rel="stylesheet">
</head>
<body>
<header class="navbar navbar-default navbar-fixed-top" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand">Home</a>
        </div>
        <nav class="collapse navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li>
                    <a href="/post/list">Posts</a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<div id="header">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1><a href="/">Blog</a></h1>
                <p class="lead">Mühlemann & Popp AG</p>
            </div>
        </div>
    </div><!-- /cont -->
</div>

<div class="container content-block">
    <div class="row">

        <?php  echo $content; ?>

    </div>
</div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <ul class="list-inline">
                    <li><i class="icon-facebook icon-2x"></i></li>
                    <li><i class="icon-twitter icon-2x"></i></li>
                    <li><i class="icon-google-plus icon-2x"></i></li>
                    <li><i class="icon-pinterest icon-2x"></i></li>
                </ul>

            </div>
            <div class="col-sm-6">
                <p class="pull-right">Test application for <a class="btn-link" href="http://www.bootply.com">Ciklum</a></p>
            </div>
        </div>
    </div>
</footer>
<!-- script references -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>

