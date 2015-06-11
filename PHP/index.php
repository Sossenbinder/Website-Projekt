<!DOCTYPE html>
  <head>
    <title>Klaviermanufaktur Lorentz</title>
    <link rel="stylesheet" type="text/css" href="../CSS/general.css">
    <link rel="stylesheet" type="text/css" href="../CSS/produkte.css">
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
                    include('fluegelP3201.php');
                    break;
              case 'spinettZenti':
                    include('spinettZenti.php');
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
  </body>
</html>
