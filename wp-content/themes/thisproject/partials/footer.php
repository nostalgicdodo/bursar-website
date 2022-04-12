<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Braun E. Fridge
 *
 */

global $ver;

?>

		<!-- Footer Section -->
		<section class="footer-section fill-neutral-6 text-white" id="footer-section" data-section-title="Footer Section" data-section-slug="footer-section">
		</section>
		<!-- END: Footer Section -->

	</div> <!-- END : Page Content -->


	<?php //require_once __ROOT__ . '/pages/snippets/signature.php'; ?>


</div><!-- END : Page Wrapper -->

<?php //require_once __ROOT__ . '/pages/snippets/modals.php' ?>

<!--  ☠  MARKUP ENDS HERE  ☠  -->

<?php //if ( ! THIS_ENV_PRODUCTION ) : ?>
	<?php //require_once __ROOT__ . '/pages/snippets/disclaimer.php'; ?>
<?php //endif; ?>





<!-- JS Modules -->
<!-- <script type="text/javascript" src="<?= THEME_URI ?>/plugins/base64/base64.js__v3.7.2.min.js<?= $ver ?>"></script> -->
<!-- <script type="text/javascript" src="<?= THEME_URI ?>/plugins/js-cookie/js-cookie__v3.0.1.min.js<?= $ver ?>"></script> -->
<script type="text/javascript" src="<?= THEME_URI ?>/js/modules/utils.js<?= $ver ?>"></script>
<script type="text/javascript" src="<?= THEME_URI ?>/js/modules/http.js<?= $ver ?>"></script>
<script type="text/javascript" src="<?= THEME_URI ?>/js/modules/forms.js<?= $ver ?>"></script>
<script type="text/javascript" src="<?= THEME_URI ?>/js/modules/form-utils.js<?= $ver ?>"></script>
<?php //if ( ! THIS_ENV_PRODUCTION ) : ?>
	<!-- <script type="text/javascript" src="<?= THEME_URI ?>/js/modules/disclaimer.js<?= $ver ?>"></script> -->
<?php //endif; ?>
<script type="text/javascript" src="<?= THEME_URI ?>/js/modules/navigation.js<?= $ver ?>"></script>
<!-- <script type="text/javascript" src="<?= THEME_URI ?>/js/modules/device-charge.js<?= $ver ?>"></script> -->
<!-- <script type="text/javascript" src="<?= THEME_URI ?>/js/modules/video_embed.js<?= $ver ?>"></script> -->
<script type="text/javascript" src="<?= THEME_URI ?>/js/modules/modal_box.js<?= $ver ?>"></script>
<!-- <script type="text/javascript" src="<?= THEME_URI ?>/js/modules/carousel.js<?= $ver ?>"></script> -->
<!-- <script type="text/javascript" src="<?= THEME_URI ?>/js/modules/phone-country-code.js<?= $ver ?>"></script> -->

<?php wp_footer() ?>

</body>

</html>
