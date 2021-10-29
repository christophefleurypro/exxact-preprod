<?php


use WordPlate\Acf\Fields\Relationship;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Text;


class SectionActu extends \WordPlate\Acf\Fields\Group{

	public static function make(string $label, string $name = null) :\WordPlate\Acf\Fields\Field
	{

		$field = parent::make($label,$name);
		return $field->fields([
        	SectionMenuID::make('','--section-menu-id'),
      		Text::make('Titre','--title'),
        	SimpleBtn::make('Lien','--btn'),
			Relationship::make('Nos Actualités','--relation')
				->instructions('Sélection des actu à afficher.')
	            ->postTypes(['post'])
	            ->max(3)
	            ->returnFormat('object') // id or object
		]);
	}
}

 ?>
