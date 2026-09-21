<?php
$color = function($name, $fallback){
	$value = (string)$this->config->{'altitude_'.$name};
	return preg_match('/^#[0-9a-f]{3}(?:[0-9a-f]{3})?$/i', $value) ? $value : $fallback;
};
$choice = function($name, array $allowed, $fallback){
	$value = (string)$this->config->{'altitude_'.$name};
	return in_array($value, $allowed, TRUE) ? $value : $fallback;
};
$fonts = [
	'open-sans' => '"Open Sans", Arial, sans-serif',
	'titillium' => '"Titillium Web", Arial, sans-serif',
	'system' => '-apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif',
	'serif' => 'Georgia, "Times New Roman", serif'
];
$shadows = [
	'none' => 'none',
	'soft' => '0 8px 24px rgba(30, 52, 42, .06)',
	'strong' => '0 14px 34px rgba(30, 52, 42, .16)'
];
$body_font = $choice('body_font', ['open-sans', 'system', 'serif'], 'open-sans');
$heading_font = $choice('heading_font', ['titillium', 'open-sans', 'system', 'serif'], 'titillium');
$shadow = $choice('shadow', ['none', 'soft', 'strong'], 'soft');
$hero_image = image('hero-default.png', $this->theme('altitude'));
if (($hero_image_id = (int)$this->config->altitude_hero_image) && ($file = HB()->model2('file', $hero_image_id)) && $file() && $file->path())
{
	$hero_image = $file->path();
}
$hero_position_x = $choice('hero_position_x', ['left', 'center', 'right'], $choice('hero_position', ['left', 'center', 'right'], 'center'));
$variables = [
	'--altitude-accent' => $color('accent_color', '#ff9900'),
	'--altitude-accent-dark' => $color('accent_dark_color', '#d97f00'),
	'--altitude-forest' => $color('forest_color', '#244c3c'),
	'--altitude-forest-deep' => $color('forest_deep_color', '#18352a'),
	'--altitude-text' => $color('text_color', '#26312d'),
	'--altitude-muted' => $color('muted_color', '#68736e'),
	'--altitude-background' => $color('background_color', '#f4f5f1'),
	'--altitude-surface' => $color('surface_color', '#ffffff'),
	'--altitude-border' => $color('border_color', '#dce2dc'),
	'--altitude-topbar-background' => $color('topbar_background', '#18352a'),
	'--altitude-topbar-text' => $color('topbar_text', '#ffffff'),
	'--altitude-identity-background' => $color('identity_background', '#ffffff'),
	'--altitude-navigation-background' => $color('navigation_background', '#ff9900'),
	'--altitude-navigation-text' => $color('navigation_text', '#ffffff'),
	'--altitude-navigation-active-background' => $color('navigation_active_background', '#ffffff'),
	'--altitude-navigation-active-text' => $color('navigation_active_text', '#666666'),
	'--altitude-logo-width' => $choice('logo_width', ['180', '240', '290', '360'], '290').'px',
	'--altitude-container' => $choice('content_width', ['960', '1080', '1200', '1320', '1440'], '1200').'px',
	'--altitude-hero-height' => $choice('hero_height', ['300', '360', '420', '520', '640'], '420').'px',
	'--altitude-hero-image' => 'url("'.str_replace(['"', "\n", "\r"], ['%22', '', ''], $hero_image).'")',
	'--altitude-hero-position-x' => $hero_position_x,
	'--altitude-hero-position-y' => $choice('hero_position_y', ['top', 'center', 'bottom'], 'center'),
	'--altitude-hero-size' => $choice('hero_size', ['cover', 'contain', 'auto'], 'cover'),
	'--altitude-hero-repeat' => $choice('hero_repeat', ['no-repeat', 'repeat-x', 'repeat-y', 'repeat'], 'no-repeat'),
	'--altitude-hero-attachment' => $choice('hero_attachment', ['scroll', 'fixed'], 'scroll'),
	'--altitude-hero-align' => $choice('hero_align', ['flex-start', 'center', 'flex-end'], 'flex-end'),
	'--altitude-hero-overlay-color' => $color('hero_overlay_color', '#101f1a'),
	'--altitude-hero-overlay-opacity' => ((int)$choice('hero_overlay_opacity', ['0', '20', '35', '48', '60', '75'], '48') / 100),
	'--altitude-content-spacing' => $choice('content_spacing', ['32', '56', '72'], '56').'px',
	'--altitude-radius' => $choice('radius', ['0', '4', '8'], '4').'px',
	'--altitude-card-shadow' => $shadows[$shadow],
	'--altitude-body-font' => $fonts[$body_font],
	'--altitude-heading-font' => $fonts[$heading_font],
	'--altitude-font-size' => $choice('font_size', ['15', '16', '17', '18'], '16').'px',
	'--altitude-heading-weight' => $choice('heading_weight', ['600', '700'], '700'),
	'--altitude-footer-background' => $color('footer_background', '#18352a'),
	'--altitude-footer-text' => $color('footer_text', '#ffffff'),
	'--altitude-footer-accent' => $color('footer_accent', '#ff9900')
];
$style = [];
foreach ($variables as $name => $value) { $style[] = $name.': '.$value; }
?>
<div class="altitude-site" style="<?php echo utf8_htmlentities(implode('; ', $style), ENT_QUOTES) ?>">
	<a class="altitude-skip-link" href="#altitude-main"><?php echo $this->lang('Skip to content') ?></a>

	<header class="altitude-header">
		<?php if ($zone = (string)$this->output->region('top')): ?>
		<div class="altitude-topbar"><div class="altitude-container"><?php echo $zone ?></div></div>
		<?php endif ?>

		<?php if ($zone = (string)$this->output->region('header')): ?>
		<div class="altitude-identity"><div class="altitude-container altitude-identity-inner"><?php echo $zone ?></div></div>
		<?php endif ?>

		<?php if ($zone = (string)$this->output->region('navigation')): ?>
		<nav class="altitude-navigation" aria-label="<?php echo $this->lang('Main navigation') ?>">
			<div class="altitude-container altitude-navigation-inner">
				<button class="altitude-navigation-toggle" type="button" aria-expanded="false" aria-controls="altitude-navigation-content">
					<?php echo icon('fas fa-bars') ?><span><?php echo $this->lang('Menu') ?></span>
				</button>
				<div class="altitude-navigation-content" id="altitude-navigation-content"><?php echo $zone ?></div>
			</div>
		</nav>
		<button class="altitude-navigation-backdrop" type="button" aria-label="<?php echo $this->lang('Close menu') ?>"></button>
		<?php endif ?>
	</header>

	<?php if ($zone = (string)$this->theme('altitude')->slider_region()): ?>
	<div class="altitude-slider-zone"><?php echo $zone ?></div>
	<?php endif ?>

	<?php if ($zone = (string)$this->output->region('hero')): ?>
	<section class="altitude-hero"><div class="altitude-hero-shade"></div><div class="altitude-container altitude-hero-inner"><?php echo $zone ?></div></section>
	<?php endif ?>

	<?php if (!empty($this->url->request) && $this->output->breadcrumb_enabled() && ($breadcrumb = $this->widget('breadcrumb'))): ?>
	<div class="altitude-breadcrumb"><div class="altitude-container"><?php echo $breadcrumb->output() ?></div></div>
	<?php endif ?>

	<?php if ($zone = (string)$this->output->region('before_content')): ?>
	<section class="altitude-before-content"><div class="altitude-container"><?php echo $zone ?></div></section>
	<?php endif ?>

	<?php if (($zone = (string)$this->output->error()) || ($zone = (string)$this->output->region('content'))): ?>
	<main class="altitude-content" id="altitude-main"><div class="altitude-container"><?php echo $zone ?></div></main>
	<?php endif ?>

	<?php if ($zone = (string)$this->output->region('after_content')): ?>
	<section class="altitude-after-content"><div class="altitude-container"><?php echo $zone ?></div></section>
	<?php endif ?>

	<?php
	$privacy = function_exists('privacy_notice') ? privacy_notice() : '';
	$privacy_button = function_exists('privacy_preferences_link')
		? '<button type="button" class="altitude-cookie-button" data-privacy-open data-privacy-launcher title="'.$this->lang('Manage cookies').'" aria-label="'.$this->lang('Manage cookies').'">'.icon('fas fa-cookie-bite').'</button>'
		: '';
	?>
	<?php if ($zone = (string)$this->output->region('footer')): ?>
	<footer class="altitude-footer">
		<div class="altitude-container">
			<div class="altitude-footer-widgets"><?php echo $zone ?></div>
		</div>
	</footer>
	<?php endif ?>
	<?php if ($privacy || $privacy_button): ?>
		<?php echo $privacy ?>
		<?php echo $privacy_button ?>
	<?php endif ?>

	<button class="altitude-back-to-top" type="button" aria-label="<?php echo $this->lang('Back to top') ?>"><?php echo icon('fas fa-chevron-up') ?></button>
</div>
