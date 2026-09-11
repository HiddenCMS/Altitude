<?php
$color = function($name, $fallback){
	$value = (string)$this->config->{'altitude_'.$name};
	return preg_match('/^#[0-9a-f]{3}(?:[0-9a-f]{3})?$/i', $value) ? $value : $fallback;
};
$content_width = in_array((string)$this->config->altitude_content_width, ['1080', '1200', '1320'], TRUE) ? (string)$this->config->altitude_content_width : '1200';
$hero_height = in_array((string)$this->config->altitude_hero_height, ['360', '420', '520'], TRUE) ? (string)$this->config->altitude_hero_height : '420';
$hero_position = in_array((string)$this->config->altitude_hero_position, ['left', 'center', 'right'], TRUE) ? (string)$this->config->altitude_hero_position : 'center';
?>
<div class="altitude-site" style="--altitude-accent: <?php echo $color('accent_color', '#ff9900') ?>; --altitude-forest: <?php echo $color('forest_color', '#244c3c') ?>; --altitude-text: <?php echo $color('text_color', '#26312d') ?>; --altitude-background: <?php echo $color('background_color', '#f4f5f1') ?>; --altitude-container: <?php echo $content_width ?>px; --altitude-hero-height: <?php echo $hero_height ?>px; --altitude-hero-position: <?php echo $hero_position ?>;">
	<a class="altitude-skip-link" href="#altitude-main"><?php echo $this->lang('Aller au contenu') ?></a>

	<header class="altitude-header">
		<?php if ($zone = (string)$this->output->region('top')): ?>
		<div class="altitude-topbar"><div class="altitude-container"><?php echo $zone ?></div></div>
		<?php endif ?>

		<?php if ($zone = (string)$this->output->region('header')): ?>
		<div class="altitude-identity"><div class="altitude-container altitude-identity-inner"><?php echo $zone ?></div></div>
		<?php endif ?>

		<?php if ($zone = (string)$this->output->region('navigation')): ?>
		<nav class="altitude-navigation" aria-label="<?php echo $this->lang('Navigation principale') ?>">
			<div class="altitude-container altitude-navigation-inner">
				<button class="altitude-navigation-toggle" type="button" aria-expanded="false" aria-controls="altitude-navigation-content">
					<?php echo icon('fas fa-bars') ?><span><?php echo $this->lang('Menu') ?></span>
				</button>
				<div class="altitude-navigation-content" id="altitude-navigation-content"><?php echo $zone ?></div>
			</div>
		</nav>
		<button class="altitude-navigation-backdrop" type="button" aria-label="<?php echo $this->lang('Fermer le menu') ?>"></button>
		<?php endif ?>
	</header>

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
	$zone = (string)$this->output->region('footer');
	$privacy = function_exists('privacy_notice') ? privacy_notice() : '';
	$privacy_button = function_exists('privacy_preferences_link')
		? '<button type="button" class="altitude-cookie-button" data-privacy-open title="'.$this->lang('Gérer mes cookies').'" aria-label="'.$this->lang('Gérer mes cookies').'">'.icon('fas fa-cookie-bite').'</button>'
		: '';
	?>
	<?php if ($zone || $privacy || $privacy_button): ?>
	<footer class="altitude-footer">
		<div class="altitude-container">
			<?php if ($zone): ?><div class="altitude-footer-widgets"><?php echo $zone ?></div><?php endif ?>
			<?php echo $privacy ?>
			<?php echo $privacy_button ?>
		</div>
	</footer>
	<?php endif ?>

	<button class="altitude-back-to-top" type="button" aria-label="<?php echo $this->lang('Haut de page') ?>"><?php echo icon('fas fa-chevron-up') ?></button>
</div>
