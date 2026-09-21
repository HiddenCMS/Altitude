<?php
$sections = [
	'dashboard'  => ['fas fa-info-circle', $this->lang('Overview')],
	'identity'   => ['fas fa-palette', $this->lang('Visual identity')],
	'header'     => ['fas fa-bars', $this->lang('Header and navigation')],
	'cover'      => ['far fa-image', $this->lang('Cover')],
	'layout'     => ['fas fa-columns', $this->lang('Layout')],
	'typography' => ['fas fa-font', $this->lang('Typography')],
	'footer'     => ['fas fa-align-justify', $this->lang('Footer')]
];
?>
<div class="altitude-customizer">
	<nav class="altitude-customizer-nav" aria-label="<?php echo $this->lang('Customization sections') ?>">
		<div class="altitude-customizer-nav-title"><?php echo icon('fas fa-sliders-h').' '.$this->lang('Sections') ?></div>
		<?php foreach ($sections as $key => $section): ?>
		<a class="altitude-customizer-tab" href="#<?php echo $key ?>">
			<?php echo icon($section[0]) ?><span><?php echo $section[1] ?></span>
		</a>
		<?php endforeach ?>
	</nav>

	<div class="altitude-customizer-content">
		<section class="altitude-customizer-pane" id="dashboard">
			<header class="altitude-customizer-heading"><?php echo icon('fas fa-info-circle') ?><div><h2><?php echo $this->lang('Overview') ?></h2><p><?php echo $this->lang('Shape the theme without editing code. Each section can be saved independently.') ?></p></div></header>
			<div class="altitude-overview">
				<figure class="altitude-preview"><img src="<?php echo url($this->__caller->__path('', 'thumbnail.png')) ?>" alt="<?php echo utf8_htmlentities($theme->title) ?>" /></figure>
				<dl class="altitude-metadata">
					<div><dt><?php echo $this->lang('Theme name') ?></dt><dd><?php echo utf8_htmlentities($theme->title) ?></dd></div>
					<div><dt><?php echo $this->lang('Description') ?></dt><dd><?php echo utf8_htmlentities($theme->description) ?></dd></div>
					<div><dt><?php echo $this->lang('Version') ?></dt><dd><code><?php echo utf8_htmlentities($theme->version) ?></code></dd></div>
					<div><dt><?php echo $this->lang('Author') ?></dt><dd><?php echo utf8_htmlentities($theme->author) ?></dd></div>
					<div><dt><?php echo $this->lang('License') ?></dt><dd><?php echo utf8_htmlentities($theme->license) ?></dd></div>
				</dl>
			</div>
		</section>

		<?php foreach ($forms as $key => $form): ?>
		<section class="altitude-customizer-pane" id="<?php echo $key ?>">
			<header class="altitude-customizer-heading"><?php echo icon($sections[$key][0]) ?><div><h2><?php echo $sections[$key][1] ?></h2></div></header>
			<div class="altitude-customizer-form"><?php echo $form ?></div>
		</section>
		<?php endforeach ?>
	</div>
</div>
