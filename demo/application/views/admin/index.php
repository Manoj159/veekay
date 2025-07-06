<?php 

	$login_Type = $this->session->userdata("login_type");

	$username = $this->session->userdata("name");

	$userimage = $this->session->userdata("image");

	$admin_id = $this->session->userdata("admin_id");

	$headerColor = $this->db->get_where("settings", array("type"=>"header-background"))->row()->description;

	$menubarColor = $this->db->get_where("settings", array("type"=>"menubar-background"))->row()->description;

	$footer = "Website is Developed by Banno Tech.";

?>

<?php include "css.php"; ?>


   <?php include "header.php"; ?>


       <?php include "right-sidebar.php"; ?>

   
       <?php include $login_Type."/menubar.php"; ?>


  	   <?php include  $login_Type."/page_info.php"; ?>


   <?php include  $login_Type."/".$page_name.".php"; ?>


<?php include "footer.php"; ?>

<?php include "js.php"; ?>