<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?=$ENV["scriptName"]?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="<?=$ENV["relativeRoot"]?>/resources/css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=$ENV["relativeRoot"]?>/resources/css/bootswatch.min.css">
    <link rel="stylesheet" href="<?=$ENV["relativeRoot"]?>/resources/css/custom.css">
</head>
<body>

<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="../" class="navbar-brand"><?=$ENV["scriptName"]?></a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="" target="_blank">Github</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container main-container">

    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-6">
                <h1><?=$PAGE["title"]?></h1>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-6">
            </div>
        </div>
    </div>
