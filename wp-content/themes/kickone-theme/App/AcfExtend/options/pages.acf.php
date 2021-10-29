<?php
use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Wysiwyg;
use WordPlate\Acf\Fields\PostObject;



register_extended_field_group([
    'title' => 'Gestion des pages',
    'fields' => [
    	PostObject::make('Page des offres d\'emplois','page-listing-job')
            ->postTypes(['page'])
            ->returnFormat('id') // id or object
            ->required(),
    ],
    'location' => [
			Location::if('options_page', 'acf-options-pages'),
    ],
    'style' => 'default'
]);
?>
