<?php

use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Image;

class SectionOffres extends \WordPlate\Acf\Fields\Group{

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
        	Image::make('Image de fond', '--image')
            ->instructions('Taille de l\'image : 960 x 750 pixels')
      			->returnFormat('array')
    			->previewSize('medium'),
        	SimpleBtn::make('Les offres','--btn-1'),
        	SimpleBtn::make('Candidatture spontanée','--btn-2'),
			
			
		]);
	}
}

 ?>
