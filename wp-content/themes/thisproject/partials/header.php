<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 */

// Get utility functions
// require_once __ROOT__ . '/lib/utils.php';
// require_once __ROOT__ . '/lib/views.php';
// require_once __ROOT__ . '/lib/providers/wordpress.php';

// use BFS\CMS\WordPress;
// use BFS\Router;



/*
 * A class name for temporarily disabling sections or features or content parts while in development
 */
$hide = 'hidden';
$showMedium = 'show-for-medium';
$bodyClasses = esc_attr( implode( ' ', get_body_class() ) );


// $languageAttributes = WordPress::$isEnabled ? get_language_attributes() : 'lang="en" xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns# fb: http://www.facebook.com/2008/fbml"';

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1" /> -->
	<?php wp_head(); ?>
	<?php require_once __DIR__ . '/../style.php'; ?>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<?php //require_once __DIR__ . '/partials/head.php'; ?>
</head>

<body class="<?= $bodyClasses ?>" id="body">

<?php wp_body_open(); ?>

<!--  ★  MARKUP GOES HERE  ★  -->

<div id="page-wrapper"><!-- Page Wrapper -->

	<div id="page-content"><!-- Page Content -->

		<!-- Header Section -->
		<section class="header-section" id="header-section" data-section-title="Header Section" data-section-slug="header-section">
			<div class="container">
				<div class="row space-100-top-bottom">
					<div class="columns small-6 medium-3 large-2">
						<div class="logo h1 strong text-dark">bursar</div>
					</div>
					<div class="columns small-offset-5 small-1 medium-offset-0 medium-9 large-offset-4 large-6">
						<nav>
							<div class="space-25-top"><button class="fill-purple-2 material-icons" data-icon="menu"></button></div>
							<ul class="strong text-dark space-25-top">
								<li class="inline-middle space-25"><a href="/">Home</a></li>
								<li class="inline-middle space-25"><a href="/#study-now-pay-later-section">Home</a></li>
								<li class="inline-middle space-25"><a href="/#why-us-section">Why Us</a></li>
								<li class="inline-middle space-25"><a href="/#lenders-section">Lenders</a></li>
								<li class="inline-middle space-25"><a href="/#institutes-section">Institutes</a></li>
								<li class="inline-middle space-25"><a href="/#about-us-section">Team</a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</section>
		<!-- END: Header Section -->
