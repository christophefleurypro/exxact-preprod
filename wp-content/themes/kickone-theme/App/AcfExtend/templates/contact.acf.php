<?php
use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Url;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Tab;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\PostObject;

register_extended_field_group([
    'title' => "Page de contact",
    'fields' => [
    	Tab::make("Banner")
            ->placement('left'),
        SectionBanner::make('Nous contacter','s-banner'),
        Tab::make("Contenu"),
        Text::make('Titre','sc-2-title')
            ->defaultValue('Exxact Robotics'),
        Text::make('Adresse','sc-2-adresse'),
        Url::make('Adresse google map','sc-2-adresse-link'),
        Text::make('Téléphone','sc-2-phone'),
        Tab::make("Formulaire"),
        PostObject::make('Formulaire','sc-3-form')
            ->instructions('Selection du formulaire.')
            ->postTypes(['wpcf7_contact_form'])
            ->returnFormat('id') // id or object
            ->required()
    ],
    'location' => [
        Location::if('page_template', 'templates/contact.php'),
    ],
    'style' => 'default',
    'hide_on_screen' => array('the_content')
]);


?>
