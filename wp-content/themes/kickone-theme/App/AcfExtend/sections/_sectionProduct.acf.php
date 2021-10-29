<?php

use WordPlate\Acf\Fields\Relationship;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Text;

class SectionProduct extends \WordPlate\Acf\Fields\Group{

	public static function make(string $label, string $name = null) :\WordPlate\Acf\Fields\Field
	{

		$field = parent::make($label,$name);
		return $field->fields([
        	SectionMenuID::make('','--section-menu-id'),
      		Text::make('Titre','--title'),
			Relationship::make('Nos produits','--relation')
				->instructions('Sélection des produits à afficher.')
	            ->postTypes(['produit'])
	            ->returnFormat('object') // id or object
		]);
	}
}

 ?>
