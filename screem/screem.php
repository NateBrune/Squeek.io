<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title>Screem</title>
  <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.css">

  <link rel="shortcut icon" type="image/png" href="assets/pictures/steem.png"/>

  <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
  <script src="semantic/dist/semantic.js"></script>
  <script>
  $(document).ready(function(){
      $('.menu .item').tab();
  });
  </script>

  <style>
    .last.container {
      margin-bottom: 300px !important;
    }
    h1.ui.center.header {
      margin-top: 3em;
    }
    h2.ui.center.header {
      margin: 4em 0em 2em;
    }
    h3.ui.center.header {
      margin-top: 2em;
      padding: 2em 0em;
    }
  </style>
</head>
<body>
<div class="ui pointing borderless menu">
  <div class="item">
    <img src="https://www.coingecko.com/assets/coin-250/steem-0628c82c46232bc40911d43945b6fbb5.png">
  </div>
  <div class="left menu">
    <a class="item active" data-tab="first">Feed</a>
    <a class="item" data-tab="second">Discover</a>
    <a class="item" data-tab="third">Followers</a>
  </div>

  <div class="right menu">
    <div class="item">
      <div class="ui icon transparent large input">
        <input type="text" placeholder="Search">
        <i class="search link icon"></i>
      </div>
    </div>
    <a class="item" data-tab="fourth">Sign in</a>
  </div>
</div>
<div class="ui grid">
  <div class="two wide column"></div>
  <div class="twelve wide column">
    <div class="ui tab active" data-tab="first">
      <div class="ui fluid icon input">
        <input type="text" placeholder="Tell us how you really feel">
        <i class="send icon"></i>
      </div>

      <?php
      function get_data($url) {
      	$ch = curl_init();
      	$timeout = 5;
      	curl_setopt($ch, CURLOPT_URL, $url);
      	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
      	$data = curl_exec($ch);
      	curl_close($ch);
      	return $data;
      }
      $dat = get_data("https://api.steemjs.com/getState?path=/hot/steem");
      $json = json_decode($dat, true);
      foreach($json['content'] as $short){
        //echo $short['title'].' '.$short['net_votes'].'<br />';
        echo '
        <div class="ui fluid card">
          <div class="content">
            <img class="right floated mini ui image" src="assets/pictures/default_profile.png">
            <div class="header">
            '.$short['author'].'
            </div>
            <div class="meta">
              Posted 34 seconds ago.
            </div>
            <div class="description">
        '.$short['title'].'
        </div>
        </div>
        <div class="extra content">
        <div class="basic right floated circular label"><i class="dollar icon"></i>'.$short['total_pending_payout_value'].'</div>
        <div class="ui left floated labeled button" tabindex="0">
          <div class="ui red mini button">
            <i class="heart icon"></i> Like
          </div>
          <a class="ui basic red left pointing label">
        '.$short['net_votes'].'
        </a>
      </div>
    </div>
  </div>
        ';
      }
      ?>
      <div class="ui active centered inline loader"></div>
    </div>

    <div class="ui tab" data-tab="second">
      <div class="ui fluid card">
        <div class="content">
          Second
        </div>
      </div>
    </div>

    <div class="ui tab" data-tab="third">
      <div class="ui fluid card">
        <div class="content">
          Third
        </div>
      </div>
    </div>

    <div class="ui tab" data-tab="fourth">
      <div class="ui fluid card">
        <div class="content">
          Fourth
        </div>
      </div>
    </div>
  <div class="two wide column"></div>
</div>




</body>
</html>
