<?php
use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Image;


class SectionBanner extends \WordPlate\Acf\Fields\Group{

	public static function make(string $label, string $name = null) :\WordPlate\Acf\Fields\Field
	{

		$field = parent::make($label,$name);
		return $field->fields([
			Image::make('Image', '--image')
	        	->instructions('Taille de l\'image : 1920 × 787 pixels'),
	        Textarea::make('Titre', '--title')
	            ->defaultValue($label)
	            ->newLines('br')
	            ->rows(2),
	        Textarea::make('Texte', '--text')
	            ->defaultValue('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
		]);
	}
}

 ?>
