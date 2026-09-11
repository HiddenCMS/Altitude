<style>
	.altitude-row-styles {
		display: grid;
		grid-template-columns: repeat(3, minmax(0, 1fr));
		gap: 16px;
	}

	.altitude-row-style {
		display: grid !important;
		gap: 10px;
		width: 100%;
		padding: 8px !important;
		border: 2px solid #dfe6e2 !important;
		background: #fff;
		color: #30443b;
		transition: border-color .16s ease, box-shadow .16s ease, transform .16s ease;
	}

	.altitude-row-style:hover,
	.altitude-row-style:focus,
	.altitude-row-style.active {
		border-color: #159ba6 !important;
		box-shadow: 0 0 0 2px rgba(21, 155, 166, .12);
	}

	.altitude-row-style:hover,
	.altitude-row-style:focus {
		transform: translateY(-1px);
	}

	.altitude-row-style-preview {
		display: flex;
		align-items: flex-start;
		justify-content: center;
		gap: 8px;
		height: 108px;
		padding: 12px;
		border: 1px solid #dce2dc;
		border-radius: 4px;
		background: #f7f9f8;
	}

	.altitude-row-style-preview.is-center { align-items: center; }
	.altitude-row-style-preview.is-end { align-items: flex-end; }

	.altitude-row-style-preview > span {
		display: block;
		width: 24%;
		border-radius: 3px;
		background: #bfd2c8;
	}

	.altitude-row-style-preview > span:nth-child(1) { height: 42px; }
	.altitude-row-style-preview > span:nth-child(2) { height: 68px; background: #8eb2a1; }
	.altitude-row-style-preview > span:nth-child(3) { height: 52px; }

	.altitude-row-style-label {
		display: block;
		font-size: 13px;
		font-weight: 700;
		letter-spacing: 0;
		text-align: center;
	}

	@media (max-width: 767px) {
		.altitude-row-styles { grid-template-columns: 1fr; }
	}
</style>

<div class="altitude-row-styles">
	<a href="#" class="thumbnail live-editor-overview altitude-row-style" data-style="align-items-start">
		<span class="altitude-row-style-preview"><span></span><span></span><span></span></span>
		<span class="altitude-row-style-label"><?php echo $this->lang('Aligner en haut') ?></span>
	</a>
	<a href="#" class="thumbnail live-editor-overview altitude-row-style" data-style="align-items-center">
		<span class="altitude-row-style-preview is-center"><span></span><span></span><span></span></span>
		<span class="altitude-row-style-label"><?php echo $this->lang('Centrer verticalement') ?></span>
	</a>
	<a href="#" class="thumbnail live-editor-overview altitude-row-style" data-style="align-items-end">
		<span class="altitude-row-style-preview is-end"><span></span><span></span><span></span></span>
		<span class="altitude-row-style-label"><?php echo $this->lang('Aligner en bas') ?></span>
	</a>
</div>
