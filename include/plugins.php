<?php
if( isset($level_deep) ) { $ld = getLevelDeep($level_deep); } else { $ld = ""; }
?>

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<link rel="shortcut icon" href="<?php echo $ld ?>imgs/logo-favicon.jpg" />


<?php if($_SERVER['HTTP_HOST'] == "nvyta.com") { ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo $ld; ?>js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/paper/bootstrap.min.css" />

  <?php
  if($page_name == "index") { ?>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.2/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.2/js/bootstrap-switch.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.5/clipboard.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
  <?php } elseif($page_name == "signin") { ?>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.2/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.2/js/bootstrap-switch.min.js"></script>
  <?php } else { } ?>
<?php } else { ?>
  <script type="text/javascript" src="<?php echo $ld; ?>js/jquery v1.11.3-min.js"></script>
  <script type="text/javascript" src="<?php echo $ld; ?>js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo $ld; ?>css/bootstrap.css" />

  <?php
  if($page_name == "index") { ?>
      <link href="<?php echo $ld; ?>css/bootstrap-switch.css" rel="stylesheet">
      <script src="<?php echo $ld; ?>js/bootstrap-switch.min.js"></script>
      <script type="text/javascript" src="<?php echo $ld; ?>js/clipboard.min.js"></script>
      <link rel="stylesheet" type="text/css" href="<?php echo $ld; ?>css/font-awesome.min.css" />
  <?php } elseif($page_name == "signin") { ?>
      <link href="<?php echo $ld; ?>css/bootstrap-switch.css" rel="stylesheet">
      <script src="<?php echo $ld; ?>js/bootstrap-switch.min.js"></script>
  <?php } else { } ?>
<?php } ?>


<link rel="stylesheet" type="text/css" href="<?php echo $ld; ?>css/main.css" />
<?php
// Browser Compatibility
 if(stripos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $ld; ?>css/main-opera.css" />
<?php } ?>