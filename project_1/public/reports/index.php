<?php
require_once("../../private/initialize.php");
require_login();
$page_title = "Reports Page";
$current = "report";
include(SHARED_PATH . '/public_header.php');
?>

<section id="boxes">
  <div class="container">


      <br>
      <h2>Report Page</h2>
<?php
$month = date(m);
$sql = "SELECT sum(paymentAmt) as paymentAmt FROM contract WHERE month(paymentDate) = 03;";
    $amount = Contract::find_by_sql($sql);

    foreach ($amount as $amt)
      {$gcsu = $amt->pmtAmount;
          $gcsu += $bobcats;
      }

    echo "<p>1. How much $$$ did the company spend on Blog Advertising this month? ". $gcsu . "</p>";


$sql = "SELECT blogName
        FROM blog
        WHERE blogid NOT IN (SELECT blogid FROM contract)
        ORDER BY qualityScore DESC
            LIMIT 1";

            $quality = Blog::find_by_sql($sql);

            foreach($quality as $qual);
      echo "<p>2. Who is the biggest blogger without a contract? " . $qual->blogName . "</p>";


 ?>
    </div>
</section>


<?php
include(SHARED_PATH . '/public_footer.php');
?>
