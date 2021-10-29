<?php

use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\FlexibleContent;
use WordPlate\Acf\Fields\Tab;
use WordPlate\Acf\Fields\Layout;
use WordPlate\Acf\Fields\Wysiwyg;


register_extended_field_group([
    'title' => 'Actualité',
    'fields' => [
        Tab::make("Aperçu de l'actualité")
            ->placement('left'),
            Image::make('Image de présentation','preview--image'),
        Tab::make("Contenu"),
            Image::make('Image de présentation','article--image'),
            Wysiwyg::make('Texte','article--text')
                ->required(),
            FlexibleContent::make('Contenu','article--contenu')
                ->buttonLabel('Ajouter une section')
                ->layouts([
                    Layout::make('Texte')
                        ->layout('block')
                        ->fields([
                            Text::make('Titre','--title'),
                            Wysiwyg::make('Texte','--text'),
                        ]),
                    Layout::make('Image')
                        ->layout('block')
                        ->fields([
                            Image::make('Image', '--image')
                        ])
                ])
        ],
    'location' => [
        Location::if('post_type', 'post'),
    ],
    'style' => 'default',
    'hide_on_screen' => array('the_content')
]);
