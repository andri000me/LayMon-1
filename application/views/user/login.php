<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel='dns-prefetch' href='<?=base_url()?>'>
<link href='https://fonts.gstatic.com' rel='preconnect'>
<link href='https://www.gstatic.com' rel='preconnect'>
<link href='https://fonts.googleapis.com' rel='preconnect'>
<link href='https://ajax.googleapis.com' rel='preconnect'>
<link href='https://fonts.googleapis.com' rel='preconnect'>
<link href='https://www.googletagmanager.com' rel='preconnect'>
<link rel="preconnect" href="https://code.ionicframework.com/">
<link rel="shortcut icon" href="<?=base_url('assets/favicon.ico')?>">
<meta name="robots" content="index, follow" />
<meta name="author" content="<?=$this->config->item('laymon_author')?>">
<meta name="description" content="<?=$this->config->item('laymon_deskripsi')?>"/>
<meta name="keywords" content="<?=$this->config->item('laymon_katakunci')?>" />
<link rel="alternate" href="<?=base_url()?>" hreflang="x-default"/>
<link rel="canonical" href="<?=base_url()?>" />
<meta property="og:title" content="<?=$this->config->item('laymon_judul').' - '.$this->config->item('laymon_slogan')?>">
<meta property="og:description" content="<?=$this->config->item('laymon_deskripsi')?>">
<meta property="og:image" content="<?=base_url('assets/dist/img/photo4.jpg')?>">
<meta property="og:url" content="<?=base_url()?>">
<!-- Meta Crawl -->
<meta name="alexaVerifyID" content="<?=$this->config->item('laymon_alexa')?>"/>
<meta name="google-site-verification" content="<?=$this->config->item('laymon_google')?>"/>
<!-- Meta Facebook -->
<meta property="fb:pages" content="<?=$this->config->item('laymon_fbpagesid')?>"/>
<!-- Meta Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="<?=$this->config->item('laymon_twtid')?>">
<meta name="twitter:creator" content="<?=$this->config->item('laymon_twtid')?>">
<meta name="twitter:title" content="<?=$this->config->item('laymon_judul').' - '.$this->config->item('laymon_slogan')?>">
<meta name="twitter:image" content="<?=base_url('assets/dist/img/photo4.jpg')?>">
<meta name="twitter:site:id" content="<?=$this->config->item('laymon_twtsid')?>" />
<meta name="twitter:domain" content="<?=base_url()?>">
  <title><?=$this->config->item('laymon_judul').' - '.$this->config->item('laymon_slogan')?></title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets/dist/css/adminlte.min.css')?>">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="<?=base_url('assets/dist/css/custom.css')?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?=base_url()?>"><span class="fas fa-box-open"></span> <?=$this->config->item('laymon_judul')?></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <?php if (validation_errors()) : ?>
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= validation_errors() ?>
        </div>
      </div>
    <?php endif; ?>
    <?php if (isset($error)) : ?>
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $error ?>
        </div>
      </div>
    <?php endif; ?>
      <?=form_open('login')?>
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" maxlength="20">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" minlength="8">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      <?=form_close()?>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?=base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/dist/js/adminlte.min.js')?>"></script>
</body>
</html>