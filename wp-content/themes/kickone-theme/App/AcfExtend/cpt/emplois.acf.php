<?php

use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Tab;


register_extended_field_group([
    'title' => 'Emplois',
    'fields' => [
        Tab::make("Informations")
            ->placement('left'),
        Text::make('Référence :','emplois--ref'),
        Text::make('Déplacement :','emplois--deplacement'),
        Text::make('Démarrage :','emplois--demarrage'),
        Text::make('Salaire :','emplois--salaire'),
        Text::make('Expérience requise:','emplois--experiences'),
        Text::make('Niveaux d\'études :','emplois--etudes'),
        Tab::make("Image de fond"),
        Image::make('Image de fond', '--image')
            ->instructions('Taille de l\'image : 1920 × 787 pixels')
            ->returnFormat('array')
            ->previewSize('medium'),
        Tab::make("Contenu"),
        Repeater::make('Contenu','emplois--contenu')
            ->fields([
                Text::make('Titre','--title'),
                SimpleWysiwyg::make('Texte','--text'),
            ])
            ->layout('row')
        ],
    'location' => [
        Location::if('post_type', 'emplois'),
    ],
    'style' => 'default'
]);
