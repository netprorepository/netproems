<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="NetPro EMS">
  <meta name="author" content="NetPro Int'l">

 <link rel="icon" href="/img/logo-icon.png" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $this->Html->meta('logo-icon.png') ?>
        <title>NETPRO EMS  </title>

  <!-- Custom fonts for this template-->
  <?=
        $this->Html->css(['all.min', 'sb-admin-2.min'])
        ?>
        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
     <?= $this->Flash->render() ?>

<?= $this->fetch('content') ?>

  </div>

  <!-- Bootstrap core JavaScript-->
   <?=
        $this->Html->script(['jquery.min', 'bootstrap.bundle.min', 'jquery.easing.min', 'sb-admin-2.min'])
        ?>

<?= $this->fetch('script') ?>

</body>

</html>
