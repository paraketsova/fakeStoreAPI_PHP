<?php include "App.php" ?>
<!DOCTYPE html>
<html lang="en">
​
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./styles.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <title>FakeStoreApi</title>
</head>
​
<body class="container">
  <div class="header shadow-sm p-3 mt-3 mb-3 rounded">
    <h1 id='title'>FAKESTORE</h1>
  </div>
  <div class="row">
    <?php App::main(); ?>
  </div>

  <div class="mt-5 pt-5 pb-5 footer rounded">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-xs-12 about-company">
          <h2 id="titleFooter">FAKESTORE</h2>
        </div>
        <div class="col-lg-3 col-xs-12 links">
          <h4 class="mt-lg-0 mt-sm-3">Links</h4>
            <div class="m-0 p-0">
              <a href="#">Etiam vitae.com 🧩</a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-12 location">
          <h4 class="mt-lg-0 mt-sm-4">Location</h4>
          <p>22, Lorem ipsum dolor, Consectetur 1234</p>
          <p class="mb-0"><i class="fa fa-phone mr-3"></i>✆ (541) 754-3010</p>
          <p><i class="fa fa-envelope-o mr-3"></i>info@hsdf.com</p>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col" id="copyright">
          <p class="copyright_text"><small class="text-50">© 2021. All Rights Reserved.</small></p>
        </div>
      </div>
    </div>
  </div>
</body>
​
</html>
​