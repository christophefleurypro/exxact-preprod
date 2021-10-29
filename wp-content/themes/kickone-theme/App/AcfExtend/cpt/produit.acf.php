<?php

use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Link;
use WordPlate\Acf\Fields\Gallery;
use WordPlate\Acf\Fields\Url;
use WordPlate\Acf\Fields\Tab;
use WordPlate\Acf\Fields\Group;
use WordPlate\Acf\Fields\PostObject;
use WordPlate\Acf\Fields\Taxonomy;

register_extended_field_group([
    'title' => 'Produit',
    'fields' => [
        Tab::make("Aperçu du produit")
            ->placement('left'),
            Image::make('Image de présentation','preview--image'),
            Textarea::make('Texte','preview--text')
                ->newLines('br')
                ->rows(3),
            Textarea::make('Description','preview--description')
                ->newLines('br')
                ->rows(3),
        Tab::make("Écran d'accueil"),
            Image::make('Logo', 'produit--logo'),
            Text::make('Titre','produit--titre'),
            Textarea::make('Texte descriptif','produit--text')
                ->newLines('br')
                ->rows(2),
            SimpleBtn::make('Documentation','produit--btn'),
            Taxonomy::make('Choix de la catégorie','produit--category')
                ->appearance('radio'),
            Text::make('Text de bouton actualité', 'produit--btn-2'),
            Image::make('Image de fond', 'produit--image')
                ->instructions('Taille de l\'image : 1920 × 787 pixels')
                ->returnFormat('array')
                ->previewSize('medium'),

        Tab::make("Contexte"),
            SectionMenuID::make('','context--section-menu-id'),
            Text::make('Titre','context--titre'),
            Repeater::make('Contenu','context--listing')
                ->fields([
                    Text::make('Date','--date'),
                    Text::make('Titre','--title'),
                    SimpleWysiwyg::make('Texte','--text'),
                ])
                ->min(1)
                ->layout('row'),

        Tab::make("Solutions"),
            SectionMenuID::make('','solution--section-menu-id'),
            Text::make('Titre','solution--titre'),
            Repeater::make('Contenu','solution--listing')
                ->fields([
                    Text::make('Titre','--date'),
                    SimpleWysiwyg::make('Texte','--text'),
                    Image::make('Image', '--image'),
                ])
                ->min(1)
                ->layout('row'),

        Tab::make("Partenariats"),
            SectionMenuID::make('','partners--section-menu-id'),
            Text::make('Titre','partners--titre')
                ->instructions('Bloc de gauche'),
            SimpleWysiwyg::make('Texte','partners--text'),
            Text::make('Titre','partners--titre-right')
                ->instructions('Bloc de droite'),
            SimpleWysiwyg::make('Texte','partners--text-right'),
            Repeater::make('Les partenaires','partners--listing')
                ->fields([
                    Image::make('Image', '--image'),
                    Url::make('Lien', '--url'),
                ])
                ->min(1)
                ->layout('row'),

        Tab::make("Photo"),
            SectionMenuID::make('','gallery--section-menu-id'),
            Gallery::make('Images', 'gallery-listing')
                ->instructions('Ajouter une image à la galerie.')
                ->mimeTypes(['jpg', 'jpeg', 'png'])
                ->min(1)
                ->fileSize('400 KB', 5) // MB if entered as int
                ->library('all') // all or uploadedTo
                ->returnFormat('array') // id, url or array (default)
                ->previewSize('medium'), // thumbnail, medium or large

        Tab::make("Adaptabilité"),
            SectionMenuID::make('','technologie--section-menu-id'),
            Text::make('Titre','technologie--titre'),
            Repeater::make('Contenu','technologie--listing')
                ->fields([
                    Textarea::make('Titre','--date')
                        ->rows(2)
                        ->newLines('br'),
                    Image::make('Picto', '--picto'),
                ])
                ->min(1)
                ->layout('row'),

        Tab::make("Spec. Techniques"),
            SectionMenuID::make('','spec--section-menu-id'),
            Textarea::make('Titre','spec--titre')
                ->rows(2)
                ->newLines('br'),
            Textarea::make('Texte','spec--texte')
                ->rows(2)
                ->newLines('br'),

            Group::make('Bloc de gauche','spec--left')
                ->fields([
                    Text::make('Titre','--titre'),
                    SimpleWysiwyg::make('Texte','--text')
                ]),
            Group::make('Bloc de droite','spec--right')
                ->fields([
                    Text::make('Titre','--titre'),
                    SimpleWysiwyg::make('Texte','--text')
                ]),

        Tab::make("Documentation"),
            SectionMenuID::make('','doc--section-menu-id'),
            Textarea::make('Titre','doc--titre')
                ->rows(2)
                ->newLines('br'),
            Image::make('Image de droite', 'doc--logo'),
            PostObject::make('Formulaire','doc--form')
                ->instructions('Selection du formulaire.')
                ->postTypes(['wpcf7_contact_form'])
                ->returnFormat('id') // id or object
                ->required()

        ],
    'location' => [
        Location::if('post_type', 'produit'),
    ],
    'style' => 'default'
]);
