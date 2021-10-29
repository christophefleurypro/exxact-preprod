<?php
use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Wysiwyg;
use WordPlate\Acf\Fields\Repeater;



register_extended_field_group([
    'title' => 'Gestion du bas de page',
    'fields' => [
    	Repeater::make('Lien dan le footer','opt-footer-list')
		    ->fields([
		        SimpleBtn::make('Lien','btn')
		    ])
		    ->layout('table') // block, row or table
    ],
    'location' => [
			Location::if('options_page', 'acf-options-footer'),
    ],
    'style' => 'default'
]);
?>
