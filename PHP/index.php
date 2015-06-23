<!DOCTYPE html>
  <head>
    <title>Klaviermanufaktur Lorentz</title>
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
    <link rel="stylesheet" type="text/css" href="../CSS/produkte.css">
    <link rel="stylesheet" type="text/css" href="../CSS/produktInformation.css">
    <link rel="stylesheet" type="text/css" href="../CSS/kundenmeinungen.css">
	<link rel="stylesheet" type="text/css" href="../CSS/impressum.css">
  </head>

  <body>
    <div class="wrapper">
      <div class="header">
        <?php
          include('header.php');
        ?>
      </div>

      <div class="contentParent">
        <?php
          if (!isset($_GET['page'])) {
            include('home.php');
          } else {
            $page = $_GET['page'];
            switch($page) {
              case 'produkte':
                    include('produkte.php');
                    break;
              case 'kunden':
                    include('kunden.php');
                    break;
              case 'kontakt':
                    include('kontakt.php');
                    break;
              case 'impressum':
                    include('impressum.php');
                    break;
              case 'steinwayK132':
                    include('steinwayK132.php');
                    break;
              case 'fluegelP3201':
                    include('fluegelD274.php');
                    break;
              case 'spinettZenti':
                    include('spinettZenti.php');
                    break;
              case 'clavinova':
                    include('clavinova.php');
                    break;
              case 'essex':
                    include('Essex_EGP-173.php');
                    break;
              default:
                    include('home.php');
            }
          }
        ?>
      </div>
      <div class="footer">
          <!-- footer -->
      </div>
    </div>
    <script type="text/javascript" src="../JS/jquery-1.11.3.js"></script>
    <script type="text/javascript" src="../JS/autocomplete.js"></script>
  </body>
</html>
