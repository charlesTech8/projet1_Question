<!-- Formulaire des questions -->
<?php
if(!isset( $_SESSION['id_user'] ) || empty( $_SESSION['id_user'] )){
    errorRedirect('connexion','','');
    exit;
}
?>
<div class="jumbotron jumbotron-fluid">
  <div class="container">
        <?=$_SESSION['id_user']; ?>
  </div>
</div>













<!-- <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->

<!-- <div class="btn-toolbar">
  <div class="btn-group">
      <button class="btn" data-original-title="Bold - Ctrl+B"><i class="icon-bold"></i></button>
      <button class="btn" data-original-title="Italic - Ctrl+I"><i class="icon-italic"></i></button>
      <button class="btn" data-original-title="List"><i class="icon-list"></i></button>
      <button class="btn" data-original-title="Img"><i class="icon-picture"></i></button>
      <button class="btn" data-original-title="URL"><i class="icon-arrow-right"></i></button>
  </div>
  <div class="btn-group">
      <button class="btn" data-original-title="Align Right"><i class="icon-align-right"></i></button>
      <button class="btn" data-original-title="Align Center"><i class="icon-align-center"></i></button>
      <button class="btn" data-original-title="Align Left"><i class="icon-align-left"></i></button>
  </div>
  <div class="btn-group">
      <button class="btn" data-original-title="Preview"><i class="icon-eye-open"></i></button>
      <button class="btn" data-original-title="Save"><i class="icon-ok"></i></button>
      <button class="btn" data-original-title="Cancel"><i class="icon-trash"></i></button>
  </div>
</div> -->