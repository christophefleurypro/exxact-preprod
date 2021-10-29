<?php

use WordPlate\Acf\Fields\Relationship;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Image;

class SectionTeam extends \WordPlate\Acf\Fields\Group{

	public static function make(string $label, string $name = null) :\WordPlate\Acf\Fields\Field
	{

		$field = parent::make($label,$name);
		return $field->fields([
        	SectionMenuID::make('','--section-menu-id'),
        	Text::make('Titre','--title'),
        	Textarea::make('Texte','--text')
        		->newLines('br')
        		->rows(5),
        	Image::make('Image de fond','--image')
            	->instructions('Taille de l\'image : 1920 × 1080 pixels'),
			Relationship::make('Notre équipe','--relation')
				->instructions('Sélection des membres à afficher.')
	            ->postTypes(['equipe'])
	            ->returnFormat('object') // id or object
		]);
	}
}

 ?>
