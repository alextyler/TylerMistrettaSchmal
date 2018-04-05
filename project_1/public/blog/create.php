<?php
require_once("../../private/initialize.php");
//require_login();
$page_title = "Create Blog Page";
include(SHARED_PATH . '/public_header.php');


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


    //instantiate a new object
    $blog = new Blog ($args);
    $blog->create();

    header('Location: index.php');

}

?>

<section id="boxes">
     <div class="container">
         <form action="create.php" method="post">
           <fieldset>
             <legend>Add a Blog</legend>

             <p>Blog Name: <input type="text" name="blogName" value="<?php echo $blogName; ?>"></p>
             <p>URL: <input type="text" name="url" value="<?php echo $url; ?>"></p>
             <p>Email: <input type="text" name="email" value="<?php echo $email; ?>"></p>
             <p>Contact First Name: <input type="text" name="contactFName" value="<?php echo $contactFName; ?>"></p>
             <p>Contact Last Name: <input type="text" name="contactLName" value="<?php echo $contactLName; ?>"></p>
             <br><br><strong>Quality Score Calculation</strong>
             <p>MOZ Domain Authority: <input type="number" name="mozDA" min="1" max="100"> (max = 100)</p>
             <p>Number of Sponsors: <input type="number" name="sponsors" min="1" max="25"> (max = 25)</p>
             <p>Fat Quarter Shop: <input type="checkbox" name="fqshop" value=1></p>
             <p>Green Fairy Shop: <input type="checkbox" name="gfairy" value=1></p>
             <p>Missouri Star Shop: <input type="checkbox" name="mstar" value=1></p>
             <button type="submit" value="Submit">Submit</button>
             <button type="button" onclick="location='index.php'">Cancel Update</button>
           </fieldset>
         </form>

     </div>
  </section>
<?php


include(SHARED_PATH . '/public_footer.php');



?>
