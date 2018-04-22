
<?php include ('_inc/head.php'); ?>


	<!-- Top header -->
	<?php include ('_inc/header.php'); ?>
	<!-- /Top header -->

	<!-- Main navigation -->
	<?php include ('_inc/main-navigation.php'); ?>
	<!-- /Main navigation -->

</header>
	<div class="wrap">
		<main class="has-sidebar">

			<!-- News section -->
			<div id="vesti" class="cat blue">
				<h2>Aktuelno</h2>
			</div>
			
			<?php include('_inc/sections/news.php'); ?>
			<!-- /News section -->


			<!-- E usluge -->
			<div class="cat blue">
				<h2>e-usluge</h2>
			</div>

			<?php include('_inc/sections/e-usluge.php'); ?>
			<!-- /E usluge -->



			<!-- Dogadjaji -->
			<div class="cat green">
				<h2>Događaji</h2>
			</div>

			<?php include('_inc/sections/events.php'); ?>
			<!-- /Dogadjaji -->


			<!-- News carousel -->
			<div class="cat blue">
				<h2>Vesti</h2>
			</div>

			<?php include('_inc/sections/news-carousel.php'); ?>
			<!-- /News carousel -->


			<!-- News short -->
			<div class="cat blue">
				<h2>Vesti</h2>
			</div>
			
			<?php include('_inc/sections/news-short.php'); ?>
			<!-- /News short -->

			<!-- Dokumenti section -->
			<div id="dokumenti" class="cat blue">
				<h2>Dokumenti</h2>
			</div>
			
			<?php include('_inc/sections/documents.php'); ?>
			<!-- /Dokumenti section -->


			<!-- Galerija section -->
			<div id="galerija" class="cat blue">
				<h2>Galerija</h2>
				<p>Cras congue non elit ac facilisis. Sed ultricies rhoncus erat, non viverra diam sagittis vitae.</p>
			</div>
			
			<?php include('_inc/sections/gallery.php'); ?>
			<!-- /Galerija section -->


			<!-- News side image -->
			<div class="cat blue">
				<h2>Vesti</h2>
			</div>
			
			<?php include('_inc/sections/news-side-img.php'); ?>
			<!-- /News side image -->


			<!-- Profili lista -->
			<div class="cat blue">
				<h2>Profili</h2>
			</div>
			
			<?php include('_inc/sections/profiles-list.php'); ?>
			<!-- /Profili lista -->



			<!-- Profil single -->
			<div class="cat blue">
				<h2>Profil</h2>
			</div>
			
			<?php include('_inc/partials/profile-single.php'); ?>
			<!-- /Profil single -->



			<!-- Organi i njihove funkcije -->
			<div class="cat green">
				<h2>Organi i njihove funkcije</h2>
			</div>
			
			<?php include('_inc/sections/heading-and-text.php'); ?>
			<!-- /Organi i njihove funkcije -->



			<!-- Tabela javnih nabavki -->
			<div class="cat green">
				<h2>Tabela javnih nabavki</h2><div class="category green"><a href="" class="active">2013</a><a href="">2014</a><a href="">2015</a></div>
			</div>
			
			<?php include('_inc/sections/table.php'); ?>
			<!-- /Tabela javnih nabavki -->



			<!-- Forme -->
			<div class="cat blue">
				<h2>Forme</h2>
			</div>
			
			<?php include('_inc/partials/forms-elements.php'); ?>
			<!-- /Forme -->



			<!-- Social -->
			<div class="cat blue">
				<h2>Social</h2>
			</div>
			
			<?php include('_inc/partials/social.php'); ?>
			<!-- /Social -->
			


			<!-- Adresar -->
			<div class="cat blue">
				<h2>Adresar</h2>
			</div>
			
			<?php include('_inc/sections/adresar.php'); ?>
			<!-- /Adresar -->




			<!-- Sidebar -->
			<?php include('_inc/sidebar.php'); ?>
			<!-- /Sidebar -->


				
		</main>
	</div>

	<?php include('_inc/footer.php') ?>
</body>
</html>