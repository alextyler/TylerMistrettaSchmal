<?php
require_once("../../private/initialize.php");
require_login();
$page_title = "Update Contract";
$current = "contract";
include(SHARED_PATH . '/public_header.php');

//get the persons id - id
$contractid = $_GET['contractid'] ?? false;

// find the user info based on passed id
$contract = Contract::find_by_id($contractid);

// set new variables to
$paymentDate = $contract->paymentDate;
$paymentAmt = $contract->paymentAmt;
$contractLength = $contract->contractLength;
$blogid = $contract->blogid;

if(is_post_request()) {
    // get post variables
    $contractid = $_POST['contractid'];
    $blogid = $_POST['blogid'];
    $paymentDate = $_POST['paymentDate'];
    $paymentAmt = $_POST['paymentAmt'];
    $contractLength = $_POST['contractLength'];

    //create an array called args to be used with __construct
    $args = [];
    $args['contractid'] = $contractid;
    $args['paymentDate'] = $paymentDate;
    $args['paymentAmt'] = $paymentAmt;
    $args['contractLength'] = $contractLength;
    $args['blogid'] = $blogid;

    //instantiate a new object and use the merge attributes and save to update.
    $contract = new Contract;
    $contract->merge_attributes($args);
    $contract->update($contractid);

    //after saving redirect back to home page
    header("Location: index.php?blogid=$blogid");

  }
  ?>

  <section id="boxes">
       <div class="container">
           <form action="update.php" method="post">
             <fieldset>
               <legend>Update Contract Information</legend>
               <input name="contractid" type="hidden" value="<?php echo $contractid;?>">
               <input name="blogid" type="hidden" value="<?php echo $blogid;?>">
               <p>Contract Date: <input type="date" name="paymentDate" value="<?php echo $paymentDate; ?>"></p>
               <p>Payment Amount: <input type="text" name="paymentAmt" value="<?php echo $paymentAmt; ?>"></p>
               <p>Contract Length in Months: <input type="number" name="contractLength" min="1" max="36" value="<?php echo $contractLength; ?>"></p>
               <button type="submit" value="Submit">Submit</button>
               <button type="button" onclick="location='index.php?blogid=<?php echo $blogid; ?>'">Cancel</button>
             </fieldset>
           </form>

       </div>
    </section>
