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
			'description' => 'Theme associatif et outdoor pour HiddenCMS',
			'link'        => 'https://github.com/HiddenCMS/Altitude',
			'author'      => 'HiddenCMS <contact@hiddenblob.com>',
			'license'     => 'GPL-3.0-only',
			'version'     => '0.3.3',
			'depends'     => ['HiddenCMS' => '0.4.0'],
			'zones'       => ['Barre haute', 'Identite', 'Navigation', 'Couverture', 'Avant-contenu', 'Contenu', 'Apres-contenu', 'Pied de page', 'Slider'],
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
				->config('altitude_forest_color', '#244c3c')
				->config('altitude_text_color', '#26312d')
				->config('altitude_background_color', '#f4f5f1')
				->config('altitude_content_width', '1200')
				->config('altitude_hero_height', '420')
				->config('altitude_hero_position', 'center');

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
							'title' => utf8_htmlentities($this->lang('Accueil')),
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
		foreach (['accent_color', 'forest_color', 'text_color', 'background_color', 'content_width', 'hero_height', 'hero_position'] as $key)
		{
			$this->config->unset('altitude_'.$key);
		}

		return parent::uninstall($remove);
	}
}
