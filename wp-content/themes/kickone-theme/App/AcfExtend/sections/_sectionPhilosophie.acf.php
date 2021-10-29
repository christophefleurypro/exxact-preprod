<?php

use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Repeater;

class SectionPhilosophie extends \WordPlate\Acf\Fields\Group{

	public static function make(string $label, string $name = null) :\WordPlate\Acf\Fields\Field
	{

		$field = parent::make($label,$name);
		return $field->fields([
        	SectionMenuID::make('','--section-menu-id'),
        	Text::make('Titre de la section','--title'),
			Repeater::make('Colonne liste','--list')
			    ->fields([
		        	Textarea::make('Titre','--title')
		        		->newLines('br')
		        		->rows(2),
		        	SimpleWysiwyg::make('Texte','--text')
			    ])
			    ->min(2)
			    ->collapsed('name')
			    ->buttonLabel('Ajouter un block')
			    ->layout('row') // block, row or table
			    ->required()
			
		]);
	}
}

 ?>
