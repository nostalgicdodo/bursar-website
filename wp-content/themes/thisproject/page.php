<?php
/**
 *
 *  Home Page
 *
 */

use ThisProject\CMS\WordPress;
use ThisProject\CMS\WordPress\Frontend;

Frontend\removeDefaults();

WordPress::enqueueScript( 'jquery' );

require_once __DIR__ . '/partials/header.php';

?>

<div class="js_nav_menu_sticky_threshold"></div>

<!-- Main Content Section -->
<section class="main-section space-100-top" id="main-content-section" data-section-title="Main Content Section" data-section-slug="main-content-section">
	<div class="container">
		<div class="row wp-generated-content text-neutral-6 space-200-bottom">
			<h1 class="space-50-bottom"><?= the_title() ?></h1>
			<hr class="fill-purple-1" style="margin-bottom: var(--space-150)">
			<?= the_content() ?>
		</div>
	</div>
</section>
<!-- END: Main Content Section -->

<?php require_once __DIR__ . '/sections/about-us.php'; ?>





<?php require_once __DIR__ . '/partials/footer.php'; ?>
