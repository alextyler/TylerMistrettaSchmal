<?php
// DO NOT CHANGE THIS PAGE!!!

require_once("../../private/initialize.php");
require_login();
$page_title = "Delete Page";
include(SHARED_PATH . '/public_header.php');

// if form has been submitted get variables and calculate numbers then
// set them to the array.
$contractid = $_GET['contractid'];
echo $results;

// find the user info based on passed id
$contract = Contract::find_by_id($contractid);

// set new variables to
$blogid = $contract->blogid;

if(is_post_request()) {

    $contractid = $_POST['contractid'];
    $blogid = $_POST['blogid'];


    $args = [];
    $args['contractid'] = $contractid;

    //instantiate and call delete function.
    $contract = new Contract($args);
    $contract->delete($contractid);
    
    header("Location: index.php?blogid=$blogid");

}

?>

 <section id="boxes">
      <div class="container">
          <form action="delete.php" method="post">
            <fieldset>
              <legend>Are you sure you want to delete <?php echo $contractid; ?>'s account?</legend>
              <input name="contractid" type="hidden" value="<?php echo $contractid;?>">
              <input name="blogid" type="hidden" value="<?php echo $blogid;?>">
              <button type="submit" value="Submit">Yes, Please Delete</button>
              <button type="button" onclick="location='index.php'">No, Don't Delete</button>
            </fieldset>
          </form>

         <br>
      </div>
   </section>


<?php include(SHARED_PATH . '/public_footer.php'); ?>
