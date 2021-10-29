<?php

use WordPlate\Acf\Fields\Relationship;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Image;

class SectionMission extends \WordPlate\Acf\Fields\Group{

	public static function make(string $label, string $name = null) :\WordPlate\Acf\Fields\Field
	{

		$field = parent::make($label,$name);
		return $field->fields([
        	SectionMenuID::make('','--section-menu-id'),
        	Text::make('Titre','--title'),
			Relationship::make('Nos missions','--relation')
				->instructions('Sélection des missions à afficher.')
	            ->postTypes(['mission'])
	            ->returnFormat('object') // id or object
		]);
	}
}

 ?>
