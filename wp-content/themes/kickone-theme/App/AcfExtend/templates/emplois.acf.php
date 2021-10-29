<?php
use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Tab;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\PostObject;

register_extended_field_group([
    'title' => "Nos emplois",
    'fields' => [
    	Tab::make("Banner")
            ->placement('left'),
        SectionBanner::make('Nos emplois','s-banner'),
        Tab::make("Formulaire"),
        PostObject::make('Formulaire','s-form')
            ->instructions('Selection du formulaire.')
            ->postTypes(['wpcf7_contact_form'])
            ->returnFormat('id') // id or object
            ->required(),
        Tab::make("Offres d'emploi "),
        SectionOffres::make('','groupe-offres')
        
    ],
    'location' => [
        Location::if('page_template', 'templates/emplois.php'),
    ],
    'style' => 'default',
    'hide_on_screen' => array('the_content')
]);


?>
