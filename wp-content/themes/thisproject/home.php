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
WordPress::enqueueScript( 'home', '/js/pages/home/home.js' );
WordPress::enqueueScript( 'home-forms', '/js/pages/home/forms.js' );

require_once __DIR__ . '/partials/header.php';

?>

<!-- Intro Section -->
<style>
	@media ( min-width: 1040px ) {
		.intro-section .heading {
			padding-top: var(--space-150);
			transform-origin: top left;
			transform: scale( 1.5 );
		}
	}
</style>
<section class="intro-section space-100-top space-200-bottom no-overflow js_section_intro" id="intro-section" data-section-title="Intro Section" data-section-slug="intro-section">
	<div class="container">
		<div class="row">
			<div class="columns small-11 medium-6 large-4 space-100-bottom">
				<div class="heading h1 strong text-dark space-50-bottom">Simplifying Education Fee Payments</div>
				<div class="h5 text-neutral-6 space-100-bottom hidden">Connecting multiple lenders to pre-qualified users through a quick & easy loan marketplace.</div>
				<a class="button fill-indigo-2 text-white text-uppercase hidden" href="/#study-now-pay-later-section">Study Now Pay Later</a>
			</div>
			<div class="columns small-12 medium-6 large-offset-2 large-6 space-100-top-bottom">
				<img src="<?= THEME_URI ?>/media/graphics/laptop-mockup-alt.png<?= $ver ?>" alt="">
			</div>
		</div>
		<div class="row text-center space-100-top">
			<!-- <a href="/#study-now-pay-later-section" class="label strong text-purple-2 text-uppercase material-icons" data-icon="arrow_downward">Learn More</a> -->
			<a href="/#study-now-pay-later-section" class="label strong text-purple-2 text-uppercase">
				<div>Learn More</div>
				<div class="material-icons" data-icon="arrow_downward" style="font-size: 3rem !important"></div>
			</a>
		</div>
	</div>
</section>
<!-- END: Intro Section -->

<div class="js_nav_menu_sticky_threshold"></div>

<!-- Study Now, Pay Later Section -->
<div class="wave-container row">
	<img class="wave-img" src="<?= THEME_URI ?>/media/backgrounds/wave-purple-1.svg<?= $ver ?>">
</div>
<section class="study-now-pay-later-section position-relative space-100-top-bottom fill-purple-1" style="--bg-top: url( '<?= THEME_URI ?>/media/backgrounds/wave-bottom-light-purple.svg<?= $ver ?>' ); --bg-bottom: url( '<?= THEME_URI ?>/media/backgrounds/wave-top-light-purple.svg<?= $ver ?>' );" id="study-now-pay-later-section" data-section-title="Study Now Pay Later Section" data-section-slug="study-now-pay-later-section">
	<div class="container">
		<div class="row">
			<div class="columns small-12 medium-8 medium-offset-2 large-6 large-offset-3 text-center">
				<div class="label text-uppercase text-purple-2 space-50-bottom hidden">Study now Pay later</div>
				<div class="h2 strong text-dark space-25-bottom">One Click, Easy Payments</div>
				<div class="h6 text-neutral-6 space-100-bottom hidden">Building Loan Marketplace for Education</div>
			</div>
		</div>
		<div class="row">
			<div class="columns small-10 small-offset-1 medium-4 medium-offset-0 text-center space-50-left-right">
				<img src="<?= THEME_URI ?>/media/graphics/graphic-snpl-1.png<?= $ver ?>" alt="" class="block radius-50">
				<div class="h6 strong text-dark space-25-top-bottom">Online Application and Approval</div>
				<div class="p text-neutral-6 space-100-bottom">Quick and Completely Digital Online Application Process.</div>
			</div>
			<div class="columns small-10 small-offset-1 medium-4 medium-offset-0 text-center space-50-left-right">
				<img src="<?= THEME_URI ?>/media/graphics/graphic-snpl-2.png<?= $ver ?>" alt="" class="block radius-50">
				<div class="h6 strong text-dark space-25-top-bottom">Compare Offers from Multiple Options</div>
				<div class="p text-neutral-6 space-100-bottom">Payment options on Bursar offer some of the greatest value.</div>
			</div>
			<div class="columns small-10 small-offset-1 medium-4 medium-offset-0 text-center space-50-left-right">
				<img src="<?= THEME_URI ?>/media/graphics/graphic-snpl-3.png<?= $ver ?>" alt="" class="block radius-50">
				<div class="h6 strong text-dark space-25-top-bottom">Fee Payment in Less than 5 Minutes</div>
				<div class="p text-neutral-6 space-100-bottom">Verifying on bursar is quick and easy.</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Study Now, Pay Later Section -->

<!-- Why Us Section -->
<section class="why-us-section fill-purple-1 space-100-top-bottom" id="why-us-section" data-section-title="Why Us Section" data-section-slug="why-us-section">
	<div class="container">

		<div class="row space-100-bottom">
			<div class="columns small-12 medium-6 large-5 text-dark">
				<div class="label text-uppercase text-purple-2 space-50-bottom">Why Us</div>
				<div class="h3 strong space-25-bottom">Our core vision is for users to experience easy and instant payments.</div>
				<div class="p space-200-bottom">We partner with Banks and Financial Institutions to provide the best payment options to our users that support their academic goals.</div>

				<div class="h2 strong space-25-bottom">Marketplace</div>
				<div class="h6 strong space-75-bottom">Compare Offers</div>
				<ol class="p">
					<li class="space-50-bottom">By integrating with any institute’s ERP system, users can get direct access from the dashboard to the marketplace.</li>
					<li class="space-50-bottom">Comparing offers between payment options is intuitive and effortless.</li>
					<li>Providing verified transactions to institutes is a quick and easy process.</li>
				</ol>
			</div>

			<div class="columns small-12 medium-6 large-offset-1">
				<img src="<?= THEME_URI ?>/media/graphics/phone-payment-flow.png<?= $ver ?>" alt="" class="block">
			</div>
		</div>

		<div class="row row-2 clearfix hidden">
			<div class="columns small-12 medium-6 large-5 large-offset-1 text-dark">
				<div class="h2 strong space-25-bottom">Loan Disbursement</div>
				<div class="h6 strong space-75-bottom">Digital Lending</div>
				<ol class="p">
					<li class="space-50-bottom">Bursar checks creditworthiness of each user by going through simple and non-invasive KYC verification steps.</li>
					<li class="space-50-bottom">Bursar then shares the real-time KYC details of qualified user with the Digital Lenders.</li>
					<li class="space-50-bottom">User will be directed to the Digital Lender's portal to complete the assessment and loan application process.</li>
					<li class="space-50-bottom">Lender will provide confirmation on Loan approval or rejection to the user.</li>
					<li class="space-50-bottom">Upon approval lender will transfer the loan amount directly to the Institute.</li>
					<li class="space-50-bottom">Lender will redirect the user to Bursar for process completion and provide confirmation of Loan disbursement to Bursar.</li>
				</ol>
			</div>
			<div class="columns small-12 medium-6">
				<img src="<?= THEME_URI ?>/media/graphics/phone-disbursement.png<?= $ver ?>" alt="" class="block">
			</div>
		</div>

	</div>

</section>
<div class="wave-container row hidden">
	<img class="wave-img" src="<?= THEME_URI ?>/media/backgrounds/wave-purple-1.svg<?= $ver ?>" style="--invert: -1">
</div>
<!-- END: Why Us Section -->

<!-- Lenders Section -->
<section class="lenders-section space-100-top-bottom hidden" id="lenders-section" data-section-title="Lenders Section" data-section-slug="lenders-section">
	<div class="container">
		<div class="row text-center">
			<div class="columns small-12 medium-8 large-5 text-center">
				<div class="label text-uppercase text-purple-2 space-50-bottom">Lenders</div>
				<div class="h2 strong text-dark space-25-bottom hidden">Pre-verified <br>Hypergrowth</div>
				<div class="h6 text-neutral-6 space-100-bottom">Partner with Bursar and Grow through Accelerated Customer Acquisition</div>
			</div>
		</div>
		<div class="row">
			<div class="columns small-10 small-offset-1 medium-4 medium-offset-0 text-center space-50-left-right">
				<img src="<?= THEME_URI ?>/media/graphics/graphic-lender-1.png<?= $ver ?>" alt="" class="block radius-50">
				<div class="h6 strong text-dark space-25-top space-100-bottom">Access to captive set of Pre-verified Borrowers</div>
			</div>
			<div class="columns small-10 small-offset-1 medium-4 medium-offset-0 text-center space-50-left-right">
				<img src="<?= THEME_URI ?>/media/graphics/graphic-lender-2.png<?= $ver ?>" alt="" class="block radius-50">
				<div class="h6 strong text-dark space-25-top space-100-bottom">Benefits of Established Academic Connects</div>
			</div>
			<div class="columns small-10 small-offset-1 medium-4 medium-offset-0 text-center space-50-left-right">
				<img src="<?= THEME_URI ?>/media/graphics/graphic-lender-3.png<?= $ver ?>" alt="" class="block radius-50">
				<div class="h6 strong text-dark space-25-top space-100-bottom">Single-point of Interaction for a wide set of leads</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Lenders Section -->

<!-- Partner With Us Section -->
<section class="partner-with-us-section space-100-top hidden" id="partner-with-us-section" data-section-title="Partner With Us Section" data-section-slug="partner-with-us-section">
	<div class="container">
		<div class="row">
			<div class="label text-uppercase text-purple-2 space-50-bottom">Partner With Us</div>
			<div class="columns small-12 medium-6 space-200-bottom">
				<div class="h3 strong text-dark space-50-bottom">Here’s what Bursar is offering</div>
				<ol class="p space-100-right">
					<li class="space-50-bottom">Access to all the pre-verified users on the marketplace and the early joining advantage.</li>
					<li class="space-50-bottom">All the expenses of KYC verifications and credit report checks are absorbed by the platform.</li>
					<li class="space-50-bottom">Understand how well your loan products are performing on the marketplace through a suite of analytics.</li>
					<li class="space-50-bottom">Direct disbursement to the beneficiary institute.</li>
				</ol>
				<div class="h3 strong text-dark space-200-top space-50-bottom">In return, here’s what we require from a digital lending partner.</div>
				<ol class="p">
					<li class="space-50-bottom">
						<div>
							<span class="h6">Offer competitive Education Loan rates</span>
							<br>
							<span class="label">with multiple tenure options.</span>
						</div>
					</li>
					<li class="space-50-bottom">
						<div>
							<span class="h6">Offer instant loan disbursement</span>
							<br>
							<span class="label">directly to the institure.</span>
						</div>
					</li>
					<li class="space-50-bottom">
						<div>
							<span class="h6">Enable API Integration</span>
							<br>
							<span class="label">that is secure and stable.</span>
						</div>
					</li>
				</ol>
			</div>
			<div class="columns small-12 medium-6 large-4 large-offset-1 space-200-bottom">
				<form class="contact-form fill-purple-3 radius-50 space-100 js_contact_form">
					<div class="p text-uppercase strong text-purple-1 space-50-bottom">Get in Touch</div>
					<label for="form-contact-1" class="block text-white space-25-bottom well-designed">Bio</label>
					<input type="text" name="alphabet" id="form-contact-1" class="block well-designed">
					<label for="form-contact-2" class="block text-white space-25-bottom">Company</label>
					<input type="text" name="company" id="form-contact-2" class="block">
					<label for="form-contact-3" class="block text-white space-25-bottom">Name</label>
					<input type="text" name="name" id="form-contact-3" class="block">
					<label for="form-contact-4" class="block text-white space-25-bottom">Email address</label>
					<input type="text" name="email-address" id="form-contact-4" class="block">
					<label for="form-contact-5" class="block text-white space-25-bottom">Phone number</label>
					<input type="text" name="phone-number" id="form-contact-5" class="block">
					<button type="submit" class="block text-uppercase strong fill-purple-2 text-white">Register Now</button>
				</form>
			</div>
		</div>
	</div>
</section>
<!-- END: Partner With Us Section -->

<!-- Institutes Section -->
<div class="wave-container row fill-purple-1">
	<img class="wave-img" src="<?= THEME_URI ?>/media/backgrounds/wave-purple-3.svg<?= $ver ?>">
</div>
<section class="space-100-top-bottom fill-purple-3" id="institutes-section" data-section-title="Institutes Section" data-section-slug="institutes-section">
	<div class="container">
		<div class="label text-uppercase text-purple-1 text-center space-50-bottom">Institutes</div>
		<div class="row text-center">
			<div class="columns small-12 medium-10 large-7 space-25-bottom">
				<div class="h3 strong text-white">End-to-end Education Fee Payment Solution with High Success Rate</div>
			</div>
		</div>
		<div class="row text-center">
			<div class="columns small-10 medium-8 large-5 space-200-bottom">
				<div class="p text-white">Modernise your Infrastructure with Bursar’s Digital Payment Solutions.</div>
			</div>
		</div>
		<div class="row">
			<div class="columns small-10 small-offset-1 medium-4 medium-offset-0 text-center space-50-left-right">
				<img src="<?= THEME_URI ?>/media/graphics/graphic-institute-1.png<?= $ver ?>" alt="" class="block radius-50">
				<div class="h6 strong text-white space-25-top space-100-bottom">Easy Integration + Suite of Fee Payment Analytics </div>
			</div>
			<div class="columns small-10 small-offset-1 medium-4 medium-offset-0 text-center space-50-left-right">
				<img src="<?= THEME_URI ?>/media/graphics/graphic-institute-2.png<?= $ver ?>" alt="" class="block radius-50">
				<div class="h6 strong text-white space-25-top space-100-bottom">Better tracking on all Fee Payments.</div>
			</div>
			<div class="columns small-10 small-offset-1 medium-4 medium-offset-0 text-center space-50-left-right">
				<img src="<?= THEME_URI ?>/media/graphics/graphic-institute-3.png<?= $ver ?>" alt="" class="block radius-50">
				<div class="h6 strong text-white space-25-top space-100-bottom">Student Fees Paid in Less than 5 minutes</div>
			</div>
		</div>
	</div>
</section>
<div class="wave-container row">
	<img class="wave-img" src="<?= THEME_URI ?>/media/backgrounds/wave-purple-3.svg<?= $ver ?>" style="--invert: -1">
</div>
<!-- END: Institutes Section -->

<?php require_once __DIR__ . '/sections/about-us.php'; ?>





<?php require_once __DIR__ . '/partials/footer.php'; ?>
