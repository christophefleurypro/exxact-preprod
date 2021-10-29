<?php

use WordPlate\Acf\Fields\Relationship;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Image;

class SectionExpertise extends \WordPlate\Acf\Fields\Group{

	public static function make(string $label, string $name = null) :\WordPlate\Acf\Fields\Field
	{

		$field = parent::make($label,$name);
		return $field->fields([
        	SectionMenuID::make('','--section-menu-id'),
        	Text::make('Titre','--title'),
        	Textarea::make('Texte','--text')
        		->newLines('br')
        		->rows(2),
			Relationship::make('Nos expertises','--relation')
				->instructions('Sélection des expertises à afficher.')
	            ->postTypes(['expertise'])
	            ->returnFormat('object') // id or object
		]);
	}
}

 ?>
