<?php

use WordPlate\Acf\ConditionalLogic;
use WordPlate\Acf\Fields\TrueFalse;
use WordPlate\Acf\Fields\Text;

class SectionMenuID extends \WordPlate\Acf\Fields\Group{

  	public static function make(string $label, string $name = null ) :\WordPlate\Acf\Fields\Field
  	{

      	$field = parent::make($label,$name);
      	$field->layout('block');
		$field->wrapper(['class'=>'acf-group-section']);
      	return $field->fields([
      		TrueFalse::make('Cacher la section', 'hide-section')
				->instructions("En sélectionnant oui.")
			    ->defaultValue(false)
			    ->stylisedUi() // optinal on and off text labels
                ->wrapper(['width' => '30']),
			Text::make('Titre unique de la section correspondant au menu principal','--text')
				->instructions('Laisser vide pour ne pas afficher la section dans le menu principal.')
                ->wrapper(['width' => '70'])
				->ConditionalLogic([
					ConditionalLogic::if('hide-section')->equals(false)
				])
		]);
	}

}

 ?>
