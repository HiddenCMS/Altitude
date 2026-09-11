<style>
	.altitude-widget-styles {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(155px, 1fr));
		gap: 16px;
	}

	.altitude-widget-style {
		display: grid !important;
		gap: 10px;
		width: 100%;
		padding: 8px !important;
		border: 2px solid #dfe6e2 !important;
		background: #fff;
		color: #30443b;
		text-align: left;
		transition: border-color .16s ease, box-shadow .16s ease, transform .16s ease;
	}

	.altitude-widget-style:hover,
	.altitude-widget-style:focus {
		border-color: #8aa99b !important;
		box-shadow: 0 6px 18px rgba(36, 76, 60, .1);
		transform: translateY(-1px);
	}

	.altitude-widget-style.active,
	.altitude-widget-style.active:hover {
		border-color: #159ba6 !important;
		box-shadow: 0 0 0 2px rgba(21, 155, 166, .12);
	}

	.altitude-widget-style-preview {
		display: grid;
		min-height: 94px;
		grid-template-rows: 30px 1fr;
		overflow: hidden;
		border: 1px solid #dce2dc;
		border-radius: 4px;
		background: #fff;
		box-shadow: 0 5px 14px rgba(30, 52, 42, .08);
	}

	.altitude-widget-style-preview::before {
		border-bottom: 1px solid #dce2dc;
		background: #fff;
		content: '';
	}

	.altitude-widget-style-preview::after {
		width: 62%;
		height: 8px;
		align-self: start;
		margin: 18px 14px;
		border-radius: 2px;
		background: #dfe5e1;
		box-shadow: 0 15px 0 #edf0ee;
		content: '';
	}

	.altitude-widget-style-preview.is-bordered { border-top: 4px solid #f28c00; }
	.altitude-widget-style-preview.is-title-bordered::before { border-top: 4px solid #f28c00; }
	.altitude-widget-style-preview.is-accent { border-color: #f28c00; background: #fff4e5; }
	.altitude-widget-style-preview.is-accent::before { border-color: rgba(217, 127, 0, .24); background: rgba(255, 255, 255, .45); }
	.altitude-widget-style-preview.is-dark { border-color: #244c3c; background: #244c3c; }
	.altitude-widget-style-preview.is-dark::before { border-color: rgba(255, 255, 255, .14); background: #18352a; }
	.altitude-widget-style-preview.is-dark::after { background: rgba(255, 255, 255, .82); box-shadow: 0 15px 0 rgba(255, 255, 255, .25); }
	.altitude-widget-style-preview.is-transparent { border-color: transparent; background: transparent; box-shadow: none; }
	.altitude-widget-style-preview.is-transparent::before { border-color: #dce2dc; background: transparent; }

	.altitude-widget-style-label {
		display: block;
		font-size: 13px;
		font-weight: 700;
		letter-spacing: 0;
		text-align: center;
	}

	.altitude-widget-header-option {
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 20px;
		margin-top: 20px;
		padding: 16px 18px;
		border: 1px solid #dfe6e2;
		border-radius: 4px;
		background: #f7f9f8;
	}

	.altitude-widget-header-option strong,
	.altitude-widget-header-option small { display: block; }
	.altitude-widget-header-option small { margin-top: 3px; color: #708078; }
</style>

<div class="altitude-widget-styles">
	<a href="#" class="thumbnail live-editor-overview altitude-widget-style" data-style="">
		<span class="altitude-widget-style-preview"></span>
		<span class="altitude-widget-style-label"><?php echo $this->lang('Standard') ?></span>
	</a>
	<a href="#" class="thumbnail live-editor-overview altitude-widget-style" data-style="altitude-card">
		<span class="altitude-widget-style-preview is-bordered"></span>
		<span class="altitude-widget-style-label"><?php echo $this->lang('Liseré toujours') ?></span>
	</a>
	<a href="#" class="thumbnail live-editor-overview altitude-widget-style" data-style="altitude-card-title">
		<span class="altitude-widget-style-preview is-title-bordered"></span>
		<span class="altitude-widget-style-label"><?php echo $this->lang('Liseré si titre') ?></span>
	</a>
	<a href="#" class="thumbnail live-editor-overview altitude-widget-style" data-style="altitude-card-accent">
		<span class="altitude-widget-style-preview is-accent"></span>
		<span class="altitude-widget-style-label"><?php echo $this->lang('Accent doux') ?></span>
	</a>
	<a href="#" class="thumbnail live-editor-overview altitude-widget-style" data-style="altitude-card-forest">
		<span class="altitude-widget-style-preview is-dark"></span>
		<span class="altitude-widget-style-label"><?php echo $this->lang('Forêt sombre') ?></span>
	</a>
	<a href="#" class="thumbnail live-editor-overview altitude-widget-style" data-style="altitude-transparent">
		<span class="altitude-widget-style-preview is-transparent"></span>
		<span class="altitude-widget-style-label"><?php echo $this->lang('Transparent') ?></span>
	</a>
</div>

<div class="altitude-widget-header-option">
	<div>
		<strong><?php echo $this->lang('En-tête de carte') ?></strong>
		<small><?php echo $this->lang('Affiche le titre du widget dans un en-tête distinct.') ?></small>
	</div>
	<div class="ui toggle checkbox">
		<input type="checkbox" data-style-modifier="altitude-without-header" data-style-modifier-inverted="true">
		<label><?php echo $this->lang('Afficher') ?></label>
	</div>
</div>
