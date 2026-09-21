<?php

namespace HB\Themes\Altitude;

use HB\HiddenCMS\Addons\Theme;

class Altitude extends Theme
{
	protected function __info()
	{
		return [
			'title'       => 'Altitude',
			'icon'        => 'fas fa-mountain',
			'description' => $this->lang('A HiddenCMS theme for associations and outdoor activities'),
			'link'        => 'https://github.com/HiddenCMS/Altitude',
			'author'      => 'HiddenCMS <contact@hiddenblob.com>',
			'license'     => 'GPL-3.0-only',
			'version'     => '0.5.1',
			'depends'     => ['HiddenCMS' => '0.9.0'],
			// Legacy zone identifiers remain stable for saved outlines.
			'zones'       => ['Barre haute', 'Identite', 'Navigation', 'Couverture', 'Avant-contenu', 'Contenu', 'Apres-contenu', 'Pied de page', 'Slider'],
			'zone_labels' => ['Top bar', 'Identity', 'Navigation', 'Cover', 'Before content', 'Content', 'After content', 'Footer', 'Slider'],
			'regions'     => [
				'top'            => 'Barre haute',
				'header'         => 'Identite',
				'navigation'     => 'Navigation',
				'hero'           => 'Couverture',
				'slider'         => 'Slider',
				'before_content' => 'Avant-contenu',
				'content'        => 'Contenu',
				'after_content'  => 'Apres-contenu',
				'footer'         => 'Pied de page'
			]
		];
	}

	public function __init()
	{
		$this	->css('bootstrap.min')
				->css('icons/fontawesome.min')
				->css('fonts/open-sans')
				->css('fonts/titillium-web')
				->css('style')
				->js('jquery-3.2.1.min')
				->js('popper.min')
				->js('bootstrap.min')
				->js('modal')
				->js('notify')
				->js('altitude');
	}

	public function styles_row()
	{
		return $this->view('live_editor/row');
	}

	public function slider_region()
	{
		$output = (string)$this->output->region('slider');
		if ($output || !$this->output->live_editor() || !$this->user->admin) { return $output; }
		$zone = array_search('Slider', $this->info()->zones, TRUE);
		$page = '*';
		if (($module = $this->module('outlines')) && $module->is_enabled())
		{
			$id = isset($_GET['outline_id']) ? (int)$_GET['outline_id'] : $this->output->data->get('page', 'outline');
			$outline = $module->model()->get_outline($id) ?: $module->model()->get_outline();
			if (!$outline || $outline['theme'] !== 'altitude') { return ''; }
			$page = 'outline:'.(int)$outline['outline_id'];
		}
		$record = $this->db->from('dispositions')->where('theme', 'altitude')->where('page', $page)->where('zone', $zone)->row();
		if (!$record)
		{
			$record = ['theme' => 'altitude', 'page' => $page, 'zone' => $zone, 'disposition' => '[]'];
			$record['disposition_id'] = $this->db->insert('dispositions', $record);
		}
		return $this->zone()->display($record);
	}

	public function styles_widget()
	{
		return $this->view('live_editor/widget');
	}

	public function install($dispositions = [])
	{
		$this	->config('altitude_accent_color', '#ff9900')
				->config('altitude_accent_dark_color', '#d97f00')
				->config('altitude_forest_color', '#244c3c')
				->config('altitude_forest_deep_color', '#18352a')
				->config('altitude_text_color', '#26312d')
				->config('altitude_muted_color', '#68736e')
				->config('altitude_background_color', '#f4f5f1')
				->config('altitude_surface_color', '#ffffff')
				->config('altitude_border_color', '#dce2dc')
				->config('altitude_topbar_background', '#18352a')
				->config('altitude_topbar_text', '#ffffff')
				->config('altitude_identity_background', '#ffffff')
				->config('altitude_navigation_background', '#ff9900')
				->config('altitude_navigation_text', '#ffffff')
				->config('altitude_navigation_active_background', '#ffffff')
				->config('altitude_navigation_active_text', '#666666')
				->config('altitude_logo_width', '290')
				->config('altitude_hero_image', '0')
				->config('altitude_content_width', '1200')
				->config('altitude_hero_height', '420')
				->config('altitude_hero_position', 'center')
				->config('altitude_hero_position_x', 'center')
				->config('altitude_hero_position_y', 'center')
				->config('altitude_hero_size', 'cover')
				->config('altitude_hero_repeat', 'no-repeat')
				->config('altitude_hero_attachment', 'scroll')
				->config('altitude_hero_align', 'flex-end')
				->config('altitude_hero_overlay_color', '#101f1a')
				->config('altitude_hero_overlay_opacity', '48')
				->config('altitude_content_spacing', '56')
				->config('altitude_radius', '4')
				->config('altitude_shadow', 'soft')
				->config('altitude_body_font', 'open-sans')
				->config('altitude_heading_font', 'titillium')
				->config('altitude_font_size', '16')
				->config('altitude_heading_weight', '700')
				->config('altitude_footer_background', '#18352a')
				->config('altitude_footer_text', '#ffffff')
				->config('altitude_footer_accent', '#ff9900');

		$dispositions = $this->array();

		$dispositions->set('*', 'Barre haute', $this->array([
			$this->row(
				$this->col($this->widget($this->db->insert('widgets', [
					'widget' => 'user',
					'type'   => 'index_mini'
				])))->size('col-12')
			)->style('altitude-transparent')
		]));

		$dispositions->set('*', 'Identite', $this->array([
			$this->row(
				$this->col($this->widget($this->db->insert('widgets', [
					'widget'   => 'header',
					'type'     => 'index',
					'settings' => $this->storage->encode([
						'display'           => 'logo',
						'align'             => 'text-center',
						'title'             => '',
						'description'       => '',
						'color_title'       => '',
						'color_description' => ''
					])
				])))->size('col-12')
			)->style('altitude-transparent')
		]));

		$dispositions->set('*', 'Navigation', $this->array([
			$this->row(
				$this->col($this->widget($this->db->insert('widgets', [
					'widget'   => 'navigation',
					'type'     => 'index',
					'settings' => $this->storage->encode([
						'links' => [[
							'title' => utf8_htmlentities($this->lang('Home')),
							'url'   => ''
						]]
					])
				])))->size('col-12')
			)->style('altitude-transparent')
		]));

		$dispositions->set('*', 'Couverture', $this->array([
			$this->row(
				$this->col($this->widget($this->db->insert('widgets', [
					'widget'   => 'header',
					'type'     => 'index',
					'settings' => $this->storage->encode([
						'display'           => 'title',
						'align'             => 'text-left',
						'title'             => '',
						'description'       => '',
						'color_title'       => '#ffffff',
						'color_description' => '#ffffff'
					])
				])))->size('col-12')
			)->style('altitude-transparent')
		]));

		$dispositions->set('*', 'Contenu', $this->array([
			$this->row(
				$this->col($this->widget($this->db->insert('widgets', [
					'widget' => 'module',
					'type'   => 'index'
				])))->size('col-12')
			)
		]));

		$dispositions->set('*', 'Pied de page', $this->array());

		if ($outline_id = $this->db->select('outline_id')->from('outlines')->where('base', TRUE)->row())
		{
			foreach ($this->info()->zones as $zone)
			{
				$dispositions->set('outline:'.(int)$outline_id, $zone, $dispositions->get('*', $zone));
			}
		}

		return parent::install($dispositions);
	}

	public function uninstall($remove = TRUE)
	{
		foreach ([
			'accent_color', 'accent_dark_color', 'forest_color', 'forest_deep_color', 'text_color', 'muted_color',
			'background_color', 'surface_color', 'border_color', 'topbar_background', 'topbar_text', 'identity_background',
			'navigation_background', 'navigation_text', 'navigation_active_background', 'navigation_active_text', 'logo_width',
			'hero_image', 'hero_height', 'hero_position', 'hero_position_x', 'hero_position_y', 'hero_size', 'hero_repeat',
			'hero_attachment', 'hero_align', 'hero_overlay_color', 'hero_overlay_opacity', 'content_width', 'content_spacing',
			'radius', 'shadow', 'body_font', 'heading_font', 'font_size', 'heading_weight', 'footer_background',
			'footer_text', 'footer_accent'
		] as $key)
		{
			$this->config->unset('altitude_'.$key);
		}

		return parent::uninstall($remove);
	}
}
