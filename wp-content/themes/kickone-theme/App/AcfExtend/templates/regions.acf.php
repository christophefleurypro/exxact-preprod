<?php
use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Layout;
use WordPlate\Acf\Fields\Wysiwyg;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Tab;
use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Image;

register_extended_field_group([
    'title' => "Page - Notre région",
    'fields' => [
        Tab::make("Région")
            ->placement('left'),
        Text::make('Titre', '--title'),
        Repeater::make('Block de contenu','--block')
            ->fields([
                Image::make('Image', '--image')
                    ->returnFormat('array')
                    ->instructions('Taille de l\'image : 1274 x 1080 pixels')
                    ->previewSize('medium'),
                Wysiwyg::make('Liste','--text'),
            ])
            ->collapsed('name')
            ->layout('row') // block, row or table
    ],
    'location' => [
        Location::if('page_template', 'templates/region.php'),
    ],
    'style' => 'default',
    'hide_on_screen' => array('the_content')
]);


?>
