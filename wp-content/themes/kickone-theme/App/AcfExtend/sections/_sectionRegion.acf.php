<?php

use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Wysiwyg;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Image;

class SectionRegion extends \WordPlate\Acf\Fields\Group{

	public static function make(string $label, string $name = null) :\WordPlate\Acf\Fields\Field
	{

		$field = parent::make($label,$name);
		return $field->fields([
        	SectionMenuID::make('','--section-menu-id'),
      		Text::make('Titre', '--title'),
			Image::make('Image', '--image'),
			Wysiwyg::make('Liste','--text'),
        	SimpleBtn::make('Lien','--btn')
		]);
	}
}

 ?>
