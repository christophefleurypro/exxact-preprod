<?php

use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Image;

class SectionEntreprise extends \WordPlate\Acf\Fields\Group{

	public static function make(string $label, string $name = null) :\WordPlate\Acf\Fields\Field
	{

		$field = parent::make($label,$name);
		return $field->fields([
        	SectionMenuID::make('','--section-menu-id'),
			Repeater::make('Block de contenu','--block')
			    ->fields([
		        	Textarea::make('Sous Titre','--subtitle')
		        		->newLines('br')
		        		->rows(2),
              		Repeater::make('Listes de date', '--list-date')
			    	->fields([
			    		Text::make('Date','--date')
			    	])
			    		->layout('row') // block, row or table
			    	,
					SimpleWysiwyg::make('Liste','--text'),
					Image::make('Image', '--image')
            			->instructions('Taille de l\'image : max 600 pixels de largeur')
		      			->returnFormat('array')
		    			->previewSize('medium'),
			    ])
			    ->collapsed('name')
			    ->layout('row') // block, row or table
			
		]);
	}
}

 ?>
