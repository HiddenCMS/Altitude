<?php

namespace HB\Themes\Altitude\Controllers;

use HB\HiddenCMS\Loadables\Controller;

class Admin extends Controller
{
	public function index()
	{
		$form = $this->form2()
			->rule($this->form_colorpicker('accent_color')->title($this->lang('Couleur principale'))->value($this->config->altitude_accent_color ?: '#ff9900')->required())
			->rule($this->form_colorpicker('forest_color')->title($this->lang('Couleur sombre'))->value($this->config->altitude_forest_color ?: '#244c3c')->required())
			->rule($this->form_colorpicker('text_color')->title($this->lang('Couleur du texte'))->value($this->config->altitude_text_color ?: '#26312d')->required())
			->rule($this->form_colorpicker('background_color')->title($this->lang('Couleur de fond'))->value($this->config->altitude_background_color ?: '#f4f5f1')->required())
			->rule($this->form_select('content_width')
				->title($this->lang('Largeur du contenu'))
				->data([
					'1080' => $this->lang('Compacte'),
					'1200' => $this->lang('Standard'),
					'1320' => $this->lang('Large')
				])
				->value($this->config->altitude_content_width ?: '1200')
				->required())
			->rule($this->form_select('hero_height')
				->title($this->lang('Hauteur de la couverture'))
				->data([
					'360' => $this->lang('Compacte'),
					'420' => $this->lang('Standard'),
					'520' => $this->lang('Immersive')
				])
				->value($this->config->altitude_hero_height ?: '420')
				->required())
			->rule($this->form_select('hero_position')
				->title($this->lang('Cadrage de la couverture'))
				->data([
					'left'   => $this->lang('Gauche'),
					'center' => $this->lang('Centre'),
					'right'  => $this->lang('Droite')
				])
				->value($this->config->altitude_hero_position ?: 'center')
				->required())
			->success(function($data){
				$this	->config('altitude_accent_color', $data['accent_color'])
						->config('altitude_forest_color', $data['forest_color'])
						->config('altitude_text_color', $data['text_color'])
						->config('altitude_background_color', $data['background_color'])
						->config('altitude_content_width', $data['content_width'])
						->config('altitude_hero_height', $data['hero_height'])
						->config('altitude_hero_position', $data['hero_position']);

				notify($this->lang('Apparence du theme mise a jour'));
				refresh();
			})
			->submit($this->lang('Enregistrer'))
			->panel()
			->title($this->lang('Identite visuelle'), 'fas fa-mountain');

		return $this->row($this->col($form)->size('col-12'));
	}
}
