<?php

namespace HB\Themes\Altitude\Controllers;

use HB\HiddenCMS\Loadables\Controller;

class Admin extends Controller
{
	public function index()
	{
		$this->css('admin');

		$identity = $this->form2()
			->rule($this->form_colorpicker('accent_color')->title($this->lang('Primary color'))->value($this->value('accent_color', '#ff9900'))->required())
			->rule($this->form_colorpicker('accent_dark_color')->title($this->lang('Primary hover color'))->value($this->value('accent_dark_color', '#d97f00'))->required())
			->rule($this->form_colorpicker('forest_color')->title($this->lang('Dark color'))->value($this->value('forest_color', '#244c3c'))->required())
			->rule($this->form_colorpicker('forest_deep_color')->title($this->lang('Deep dark color'))->value($this->value('forest_deep_color', '#18352a'))->required())
			->rule($this->form_colorpicker('text_color')->title($this->lang('Text color'))->value($this->value('text_color', '#26312d'))->required())
			->rule($this->form_colorpicker('muted_color')->title($this->lang('Muted text color'))->value($this->value('muted_color', '#68736e'))->required())
			->rule($this->form_colorpicker('background_color')->title($this->lang('Background color'))->value($this->value('background_color', '#f4f5f1'))->required())
			->rule($this->form_colorpicker('surface_color')->title($this->lang('Surface color'))->value($this->value('surface_color', '#ffffff'))->required())
			->rule($this->form_colorpicker('border_color')->title($this->lang('Border color'))->value($this->value('border_color', '#dce2dc'))->required())
			->success(function($data){
				$this->save_values($data, ['accent_color', 'accent_dark_color', 'forest_color', 'forest_deep_color', 'text_color', 'muted_color', 'background_color', 'surface_color', 'border_color']);
				$this->saved('identity');
			})
			->submit($this->lang('Save'))->panel();

		$header = $this->form2()
			->rule($this->form_colorpicker('topbar_background')->title($this->lang('Top bar background'))->value($this->value('topbar_background', '#18352a'))->required())
			->rule($this->form_colorpicker('topbar_text')->title($this->lang('Top bar text'))->value($this->value('topbar_text', '#ffffff'))->required())
			->rule($this->form_colorpicker('identity_background')->title($this->lang('Identity background'))->value($this->value('identity_background', '#ffffff'))->required())
			->rule($this->form_colorpicker('navigation_background')->title($this->lang('Navigation background'))->value($this->value('navigation_background', '#ff9900'))->required())
			->rule($this->form_colorpicker('navigation_text')->title($this->lang('Navigation text'))->value($this->value('navigation_text', '#ffffff'))->required())
			->rule($this->form_colorpicker('navigation_active_background')->title($this->lang('Active item background'))->value($this->value('navigation_active_background', '#ffffff'))->required())
			->rule($this->form_colorpicker('navigation_active_text')->title($this->lang('Active item text'))->value($this->value('navigation_active_text', '#666666'))->required())
			->rule($this->form_select('logo_width')->title($this->lang('Maximum logo width'))->data([
				'180' => '180 px',
				'240' => '240 px',
				'290' => '290 px',
				'360' => '360 px'
			])->value($this->value('logo_width', '290'))->required())
			->success(function($data){
				$this->save_values($data, ['topbar_background', 'topbar_text', 'identity_background', 'navigation_background', 'navigation_text', 'navigation_active_background', 'navigation_active_text', 'logo_width']);
				$this->saved('header');
			})
			->submit($this->lang('Save'))->panel();

		$hero = $this->form2()
			->rule($this->form_info($this->module('files')->picker_field('hero_image', (int)$this->value('hero_image', 0), $this->lang('Cover image'), 'image', $this->lang('Default theme image'))))
			->rule($this->form_select('hero_height')->title($this->lang('Cover height'))->data([
				'300' => '300 px', '360' => '360 px', '420' => '420 px', '520' => '520 px', '640' => '640 px'
			])->value($this->value('hero_height', '420'))->required())
			->rule($this->form_select('hero_position_x')->title($this->lang('Horizontal framing'))->data([
				'left' => $this->lang('Left'), 'center' => $this->lang('Center'), 'right' => $this->lang('Right')
			])->value($this->value('hero_position_x', $this->value('hero_position', 'center')))->required())
			->rule($this->form_select('hero_position_y')->title($this->lang('Vertical framing'))->data([
				'top' => $this->lang('Top'), 'center' => $this->lang('Center'), 'bottom' => $this->lang('Bottom')
			])->value($this->value('hero_position_y', 'center'))->required())
			->rule($this->form_select('hero_size')->title($this->lang('Image fit'))->data([
				'cover' => $this->lang('Cover'), 'contain' => $this->lang('Contain'), 'auto' => $this->lang('Original size')
			])->value($this->value('hero_size', 'cover'))->required())
			->rule($this->form_select('hero_repeat')->title($this->lang('Image repeat'))->data([
				'no-repeat' => $this->lang('No repeat'), 'repeat-x' => $this->lang('Horizontal'), 'repeat-y' => $this->lang('Vertical'), 'repeat' => $this->lang('Both directions')
			])->value($this->value('hero_repeat', 'no-repeat'))->required())
			->rule($this->form_select('hero_attachment')->title($this->lang('Scrolling behavior'))->data([
				'scroll' => $this->lang('Scroll with page'), 'fixed' => $this->lang('Fixed background')
			])->value($this->value('hero_attachment', 'scroll'))->required())
			->rule($this->form_select('hero_align')->title($this->lang('Content vertical alignment'))->data([
				'flex-start' => $this->lang('Top'), 'center' => $this->lang('Center'), 'flex-end' => $this->lang('Bottom')
			])->value($this->value('hero_align', 'flex-end'))->required())
			->rule($this->form_colorpicker('hero_overlay_color')->title($this->lang('Overlay color'))->value($this->value('hero_overlay_color', '#101f1a'))->required())
			->rule($this->form_select('hero_overlay_opacity')->title($this->lang('Overlay opacity'))->data([
				'0' => '0%', '20' => '20%', '35' => '35%', '48' => '48%', '60' => '60%', '75' => '75%'
			])->value($this->value('hero_overlay_opacity', '48'))->required())
			->success(function($data){
				$data['hero_image'] = $this->image_id(post('hero_image'));
				$this->save_values($data, ['hero_image', 'hero_height', 'hero_position_x', 'hero_position_y', 'hero_size', 'hero_repeat', 'hero_attachment', 'hero_align', 'hero_overlay_color', 'hero_overlay_opacity']);
				$this->saved('cover');
			})
			->submit($this->lang('Save'))->panel();

		$layout = $this->form2()
			->rule($this->form_select('content_width')->title($this->lang('Content width'))->data([
				'960' => '960 px', '1080' => '1080 px', '1200' => '1200 px', '1320' => '1320 px', '1440' => '1440 px'
			])->value($this->value('content_width', '1200'))->required())
			->rule($this->form_select('content_spacing')->title($this->lang('Content spacing'))->data([
				'32' => $this->lang('Compact'), '56' => $this->lang('Standard'), '72' => $this->lang('Spacious')
			])->value($this->value('content_spacing', '56'))->required())
			->rule($this->form_select('radius')->title($this->lang('Corner radius'))->data([
				'0' => $this->lang('Square'), '4' => $this->lang('Subtle'), '8' => $this->lang('Rounded')
			])->value($this->value('radius', '4'))->required())
			->rule($this->form_select('shadow')->title($this->lang('Card shadow'))->data([
				'none' => $this->lang('None'), 'soft' => $this->lang('Soft'), 'strong' => $this->lang('Strong')
			])->value($this->value('shadow', 'soft'))->required())
			->success(function($data){
				$this->save_values($data, ['content_width', 'content_spacing', 'radius', 'shadow']);
				$this->saved('layout');
			})
			->submit($this->lang('Save'))->panel();

		$typography = $this->form2()
			->rule($this->form_select('body_font')->title($this->lang('Body font'))->data([
				'open-sans' => 'Open Sans', 'system' => $this->lang('System font'), 'serif' => $this->lang('Serif')
			])->value($this->value('body_font', 'open-sans'))->required())
			->rule($this->form_select('heading_font')->title($this->lang('Heading font'))->data([
				'titillium' => 'Titillium Web', 'open-sans' => 'Open Sans', 'system' => $this->lang('System font'), 'serif' => $this->lang('Serif')
			])->value($this->value('heading_font', 'titillium'))->required())
			->rule($this->form_select('font_size')->title($this->lang('Base font size'))->data([
				'15' => '15 px', '16' => '16 px', '17' => '17 px', '18' => '18 px'
			])->value($this->value('font_size', '16'))->required())
			->rule($this->form_select('heading_weight')->title($this->lang('Heading weight'))->data([
				'600' => $this->lang('Semi-bold'), '700' => $this->lang('Bold')
			])->value($this->value('heading_weight', '700'))->required())
			->success(function($data){
				$this->save_values($data, ['body_font', 'heading_font', 'font_size', 'heading_weight']);
				$this->saved('typography');
			})
			->submit($this->lang('Save'))->panel();

		$footer = $this->form2()
			->rule($this->form_colorpicker('footer_background')->title($this->lang('Footer background'))->value($this->value('footer_background', '#18352a'))->required())
			->rule($this->form_colorpicker('footer_text')->title($this->lang('Footer text'))->value($this->value('footer_text', '#ffffff'))->required())
			->rule($this->form_colorpicker('footer_accent')->title($this->lang('Footer accent'))->value($this->value('footer_accent', '#ff9900'))->required())
			->success(function($data){
				$this->save_values($data, ['footer_background', 'footer_text', 'footer_accent']);
				$this->saved('footer');
			})
			->submit($this->lang('Save'))->panel();

		return $this->view('admin/index', [
			'theme' => $this->theme('altitude')->info(),
			'forms' => [
				'identity' => $identity,
				'header' => $header,
				'cover' => $hero,
				'layout' => $layout,
				'typography' => $typography,
				'footer' => $footer
			]
		]);
	}

	private function value($key, $fallback = '')
	{
		$value = $this->config->{'altitude_'.$key};
		return $value === NULL || $value === '' || $value === FALSE ? $fallback : $value;
	}

	private function save_values(array $data, array $keys)
	{
		foreach ($keys as $key)
		{
			$this->config('altitude_'.$key, isset($data[$key]) ? $data[$key] : '');
		}
	}

	private function image_id($value)
	{
		$id = (int)$value;
		if (!$id) { return 0; }

		$path = $this->db->select('path')->from('file')->where('id', $id)->row();
		return $path && in_array(strtolower(extension($path)), ['avif', 'gif', 'jpeg', 'jpg', 'png', 'svg', 'webp'], TRUE) ? $id : 0;
	}

	private function saved($section)
	{
		notify($this->lang('Theme appearance updated'));
		redirect($this->url->request.'#'.$section);
	}
}
