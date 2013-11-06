<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<title>reddit.tv</title>

<link rel="shortcut icon" href="favicon.ico" />

<!-- HTML5 Boilerplate -->


<!-- Unsemantic Grid -->
<!-- <link rel="stylesheet" href="./lib/unsemantic-grid/assets/stylesheets/demo.css" /> -->
<!--[if (gt IE 8) | (IEMobile)]><!-->
  <link rel="stylesheet" href="./css/unsemantic-grid-responsive.css" />
<!--<![endif]-->
<!--[if (lt IE 9) & (!IEMobile)]>
  <link rel="stylesheet" href="./css/ie.css" />
<![endif]-->

<link rel="stylesheet" href="css/layout.css" type="text/css" />
<link rel="stylesheet" href="css/animate.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<link rel="alternate stylesheet" href="css/theme_dark.css" type="text/css" />
<link rel="stylesheet" href="css/theme_light.css" type="text/css" id="theme" />
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic' rel='stylesheet' type='text/css'>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="js/plugins.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>

<script src="js/tv.youtube.js" type="text/javascript"></script>
<script src="js/tv.vimeo.js" type="text/javascript"></script>
<script src="js/tv.js" type="text/javascript"></script>

<script type="text/javascript">
  videoListMouse = false;
  function videoListCloseTimeout(){
    // console.log('[videoListMouse] '+videoListMouse);
    if(videoListMouse == false) {
      closeVideoList();
    }
  }
  function videoListOpenTimeout(){
    // console.log('[videoListMouse] '+videoListMouse);
    if(videoListMouse == true) {
      openVideoList();
    }
  }
  $(document).ready(function(){
    $('header').mouseenter(function(){
      // consoleLog('enter header');
      videoListMouse = true;
      setTimeout('videoListOpenTimeout();', 500);
    });
    $('#video-list').mouseenter(function(){
      // consoleLog('enter video list');
      videoListMouse = true;
      openVideoList();
    });
    $('#settings').mouseenter(function(){
      // console.log('enter settings')
      videoListMouse = false;
    });
    $('header').mouseleave(function(){
      // console.log('exit header')
      videoListMouse = false;
      setTimeout('videoListCloseTimeout()', 1000);
    });
    $('#video-list').mouseleave(function(){
      // console.log('exit video list')
      videoListMouse = false;
      setTimeout('videoListCloseTimeout()', 1000);
    });
  });
</script>

<script type="text/javascript">
  if(window.location.host.match('reddit.tv')){
    consoleLog('Loading analytics ..');
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-12131688-3']);
    _gaq.push(['_trackPageview']);

    (function() {
      consoleLog('Injecting GA ..');
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
  }else{
    consoleLog('Analytics not loaded.');
  }
</script>
</head>
<body>
  <header>
    <div id="header" class="grid-container">
      <div id="logo" class="grid-25">
        <img src="img/logo.png" />
      </div>
      <div id="now-playing-title" class="grid-50 center-align">
        /r/subreddit
      </div>

      <div id="settings">
        <div class="buttons btn-group" data-toggle="buttons">
          <label class="btn btn-default icon-next settings-auto">
            <input type="checkbox"> Auto Play/Advance
          </label>
          <label class="btn btn-default icon-shuffle settings-shuffle">
            <input type="checkbox"> Shuffle
          </label>
          <label class="btn btn-default icon-spam settings-sfw">
            <input type="checkbox"> SFW
          </label>
          <!-- TODO: Make fullscreen using HTML5 fullscreen API
          <label class="btn btn-default icon-expand settings-fill">
            <input type="checkbox"> Fill Screen
          </label> -->

          <div id="sorting" class="btn-group">
            <button type="button" class="btn btn-default icon-menu" data-toggle="dropdown">
              Sorting
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="#sort=hot">Hot</a></li>
              <li><a href="#sort=top:day">Top Today</a></li>
              <li><a href="#sort=top:week">Top Week</a></li>
              <li><a href="#sort=top:month">Top Month</a></li>
              <li><a href="#sort=top:year">Top Year</a></li>
            </ul>
          </div>
          <div id="hax" class="btn-group">
            <button type="button" class="btn btn-default" data-toggle="dropdown">
              Hax
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="https://www.youtube.com/account_playback" target="_blank">YouTube Annotations</a></li>
            </ul>
          </div>

          <button id="toggle-settings" type="button" class="btn btn-default icon-equalizer"></button>
        </div>
      </div>
    </div> <!-- /#header -->
  </header>
  <div id="video-view">
    <div id="video-list" class="animated"></div>
    <div id="main-container" class="grid-container">
      <div id="loading">
         <div class="text">loading<div class="what"></div></div>
         <div class="tv"></div>
      </div>
      <div id="video-container">
        <div id="video-embed" class="grid-100 mobile-grid-100">

        </div>
        <div id="video-meta">
          <div id="video-description" class="grid-70 mobile-grid-75">
            <span id="video-sponsored-label" class="sponsored">SPONSORED </span>
            <span id="video-title"></span> 
          </div>
          <div id="video-actions" class="grid-30 right-align">
            <a id="video-comments-link" href="" target="_blank">COMMENTS</a> | <a id="video-tweet-link" href="" target="_blank">TWEET</a> | <a id="video-share-link" href="" target="_blank">SHARE</a>
          </div>
        </div>
      </div>

      <div id="add-channel">
        <div id="video-return"></div>

        <div class="grid-50 prefix-50 text">
          <h1>Add your own channel</h1>

          <div style="float: left; width: 60%; padding-right: 20px">
            <h2>Subreddit channel</h2>
            <h1 class="or">or</h2>
            You can make your own channel from a subreddit. <i>(e.g. jazz)</i>
          </div>

          <div style="float: left; width: 40%; padding-left: 10px;">
            <h2>Site channel</h2>
            Search for all the videos from a certain domain. <i>(e.g. ted.com)</i>
          </div>

          <form>
           <input type="text" class="channel-name" placeholder="Subreddit or domain name" />
           <input type="submit" class="channel-submit" value="Add channel" />
          </form>
        </div>

        <div id="channel-recs" class="channels">
          <h2>Recommended channels</h2>

          <a class="grid-25 channel" href="#">
            <div class="thumbnail"></div>
            <span class="name">Lorem</span>
          </a>
          <a class="grid-25 channel" href="#">
            <div class="thumbnail"></div>
            <span class="name">Ipsum</span>
          </a>
          <a class="grid-25 channel" href="#">
            <div class="thumbnail"></div>
            <span class="name">Dolor</span>
          </a>
          <a class="grid-25 channel" href="#">
            <div class="thumbnail"></div>
            <span class="name">Sit</span>
          </a>
          <a class="grid-25 channel" href="#">
            <div class="thumbnail"></div>
            <span class="name">Lorem</span>
          </a>
          <a class="grid-25 channel" href="#">
            <div class="thumbnail"></div>
            <span class="name">Ipsum</span>
          </a>
          <a class="grid-25 channel" href="#">
            <div class="thumbnail"></div>
            <span class="name">Dolor</span>
          </a>
          <a class="grid-25 channel" href="#">
            <div class="thumbnail"></div>
            <span class="name">Sit</span>
          </a>
        </div>

      </div>
    </div>
  </div>
  <div id="channels" class="channels grid-container">
    <a id="add-channel-button" class="grid-25 channel" href="#add-channel">
      <div class="thumbnail"></div>
      <span class="name">Add Channel</span>
    </a>
  </div>

<div id="vid-list-tooltip"></div>
</body>
</html>