<?php session_start(); include("include/mysqlcon.php"); ?>
<?php
if(!isset($_SESSION['username']))
{
if(empty($_GET['page']) OR $_GET['page'] == "login" OR $_GET['page'] == "lostpw" OR $_GET['page'] == "regist")
			  {	
if(empty($_GET['page'])) {$pa = 'login'; }else{ $pa = $_GET['page']; }	 
 include($pa.'.php');
}
}else{
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Ts3-Verleih Interface</title>
	
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="js/hideshow.js" type="text/javascript"></script>
	<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

</head>


<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="index.html">Ts3Verleih</a></h1>
			<h2 class="section_title"><?php if(is_admin()){ echo "Admin Interface"; }else{ echo "User Interface"; }?></h2><div class="btn_view_site"></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p><?php echo $_SESSION['username']; ?> <span style="color: #666666; font-size: 10px; float: right; padding-right: 10px;">( Letzer Login <?php echo date('d.n.Y', $_SESSION['lastlogin']).' um '.date('H:i:s', $_SESSION['lastlogin']);  ?> )</span></p>
			<a class="logout_user" href="index.php?page=logout" title="Logout">Logout</a>
		</div>
		<div class="breadcrumbs_container">
<marquee>Willkommen i Ts3Verleih Interface. Momentan ist es noch im Coding Status</marquee>
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
	  <hr/>
		<h3>Server</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="index.php?page=leih">Server leihen</a></li>
			<li class="icn_edit_article"><a href="index.php?page=verlaengern">Server verl&auml;ngern</a></li>
			<li class="icn_categories"><a href="index.php?page=backup">Backup erstellen</a></li>
			<li class="icn_tags"><a href="index.php?page=backup_enter">Backup einspielen</a></li>
			<li class="icn_folder"><a href="index.php?page=newtoken">Neuen Token</a></li>

		</ul>
		<h3>Users</h3>
		<ul class="toggle">
			<?php if(is_admin())
{
?><li class="icn_add_user"><a href="index.php?page=user#add">Add New User</a></li>
			<li class="icn_view_users"><a href="index.php?page=user#view">View Users</a></li>
<?php
}
?>
			<li class="icn_profile"><a href="index.php?page=profile_edit">Your Profile</a></li>
			<li class="icn_folder"><a href="index.php?page=feedback">Feedback</a></li>
			<li class="icn_jump_back"><a href="index.php?page=kontakt">Kontakt</a></li>

		</ul>
		<?php if(is_admin())
{
?><h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_settings"><a href="index.php?page=configedit">Main Config</a></li>
			<li class="icn_security"><a href="index.php?page=mailedit">Mail Config</a></li>
			<li class="icn_profile"><a href="index.php?page=userdata">User Daten</a></li>
			<li class="icn_folder"><a href="index.php?page=verliehen_admin">Verliehene Server</a></li>

			<li class="icn_categories"><a href="index.php?page=backup_admin">Backups</a></li>
			<li class="icn_folder"><a href="index.php?page=feedback_admin">Feedback</a></li>
			<li class="icn_jump_back"><a href="index.php?page=kontakt_admin">Kontakt</a></li>



		</ul>
		<?php
}
?>
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2012 <a href="http://mave1993.de">Mave1993.de</a></strong></p>
			<p>Theme by <a href="http://www.medialoot.com">MediaLoot</a></p>
		</footer>
	</aside><!-- end of sidebar -->
	
	<section id="main" class="column">
<!-- Inhalt Begiiin -->	
<?php
              if(empty($_GET['page']))
			  {		 
 include('leih.php');


			  }else{
				  if(file_exists($_GET['page'].'.php'))
				  {
					  include($_GET['page'].'.php');
				  }else{
					  include('leih.php');
				  }
			  }
?>
<div class="spacer"></div>
	</section>


</body>

</html>
<?php
}
?>