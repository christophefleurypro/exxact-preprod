<?php

use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Image;

class SectionLesplus extends \WordPlate\Acf\Fields\Group{

	public static function make(string $label, string $name = null) :\WordPlate\Acf\Fields\Field
	{

		$field = parent::make($label,$name);
		return $field->fields([
        	SectionMenuID::make('','--section-menu-id'),
      		Textarea::make('Titre', '--title')
      			->newLines('br')
        		->rows(2),
      		Textarea::make('Texte','--text')
        		->newLines('br')
        		->rows(3),
        	Image::make('Image', '--image')
      			->returnFormat('array')
            	->instructions('Taille de l\'image : 1000 x 500  pixels')
    			->previewSize('medium'),
    		Textarea::make('Sous Titre','--subtitle')
        		->newLines('br')
        		->rows(3),
			Repeater::make('Block de contenu','--block')
			    ->fields([
              		Text::make('Titre', '--title'),
		        	Textarea::make('Texte','--text')
		        		->newLines('br')
		        		->rows(3),
			    ])
			    ->collapsed('name')
			    ->layout('row') // block, row or table
			
		]);
	}
}

 ?>
