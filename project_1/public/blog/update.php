<?php
require_once("../../private/initialize.php");
require_login();
$page_title = "Update Blog Page";
include(SHARED_PATH . '/public_header.php');

//get the persons id - id
$blogid = $_GET['blogid'] ?? false;

// find the user info based on passed id
$blog = Blog::find_by_id($blogid);

// set new variables to
$blogName = $blog->blogName;
$url = $blog->url;
$email = $blog->email;
$contactFName = $blog->contactFName;
$contactLName = $blog->contactLName;
$mozDA = $blog->mozDA;
$sponsors = $blog->sponsors;
$fqshop = $blog->fqshop;
$gfairy = $blog->gfairy;
$mstar = $blog->mstar;
$qualityScore = $blog->qualityScore;

if($fqshop == 0){
  $fq = "unchecked";
} else {
  $fq="checked";
}

// set the currated to checked or unchecked
if($gfairy == 0){
  $gf = "unchecked";
} else {
  $gf="checked";
}

// set the currated to checked or unchecked
if($mstar == 0){
  $ms = "unchecked";
} else {
  $ms="checked";
}

if(is_post_request()) {
    // get post variables
    $blogid = $_POST['blogid'];
    $blogName = $_POST['blogName'];
    $url = $_POST['url'];
    $email = $_POST['email'];
    $contactFName = $_POST['contactFName'];
    $contactLName = $_POST['contactLName'];
    $mozDA = $_POST['mozDA'];
    $sponsors = $_POST['sponsors'];
    $fqshop = $_POST['fqshop'];
    $gfairy = $_POST['gfairy'];
    $mstar = $_POST['mstar'];

    $qualityScore = Blog::qualityScore($mozDA, $sponsors, $fqshop, $gfairy, $mstar);

    //create an array called args to be used with __construct
    $args = [];
    $args['blogid'] = $blogid;
    $args['blogName'] = $blogName;
    $args['url'] = $url;
    $args['email'] = $email;
    $args['qualityScore'] = $qualityScore;
    $args['contactFName'] = $contactFName;
    $args['contactLName'] = $contactLName;
    $args['mozDA'] = $mozDA;
    $args['sponsors'] = $sponsors;
    $args['fqshop'] = $fqshop;
    $args['gfairy'] = $gfairy;
    $args['mstar'] = $mstar;


    //instantiate a new object and use the merge attributes and save to update.
    $blog = new Blog($args);
    $blog->merge_attributes($args);
    $blog->update($blogid);


    header('Location: index.php');
//<p>Quality Score: <input type="number" name="qualScore" value="<?php echo $qualScore;"></p>
}
?>

<section id="boxes">
     <div class="container">
         <form action="update.php" method="post">
           <fieldset>
             <legend>Update Blog Information</legend>
             <input name="blogid" type="hidden" value="<?php echo $blogid;?>">
             <p>Blog Name: <input type="text" name="blogName" size="40" value="<?php echo $blogName; ?>"></p>
             <p>URL: <input type="text" name="url" size="40" value="<?php echo $url; ?>"></p>
             <p>Email: <input type="text" name="email" size="40" value="<?php echo $email; ?>"></p>
             <p>Contact First Name: <input type="text" name="contactFName" size="40" value="<?php echo $contactFName; ?>"></p>
             <p>Contact Last Name: <input type="text" name="contactLName" size="40" value="<?php echo $contactLName; ?>"></p>

             <p>Quality Score: <input readonly type="number" name="qualityScore" value="<?php echo $qualityScore; ?>"></p>

             <p>Moz Domain Authority: <input type="text" name="mozDA" value="<?php echo $mozDA; ?>"></p>

             <p># of Sponsors: <input type="text" name="sponsors" value="<?php echo $sponsors; ?>"></p>

            <input type="hidden" name="fqshop" value=0>
            <p>Fat Quarter Shop: <input type="checkbox" name="fqshop" value="1" <?php echo "$fq"?>></p>

            <input type="hidden" name="gfairy" value=0>
            <p>Green Fairy: <input type="checkbox" name="gfairy" value="1" <?php echo "$gf"?>></p>

            <input type="hidden" name="mstar" value=0>
            <p>Missouri Star: <input type="checkbox" name="mstar" value="1" <?php echo "$ms"?>></p>

             <button type="submit" value="Submit">Update</button>
             <button type="button" onclick="location='index.php'">Cancel Update</button>
           </fieldset>
         </form>


      </div>
   </section>
<?php


include(SHARED_PATH . '/public_footer.php');
?>
