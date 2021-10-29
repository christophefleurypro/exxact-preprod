<?php
use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Repeater;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Tab;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\PostObject;

register_extended_field_group([
    'title' => "Nos actualités",
    'fields' => [
    	Tab::make("Banner")
            ->placement('left'),
        SectionBanner::make('Les actualités','s-banner'),
    ],
    'location' => [
        Location::if('page_template', 'templates/actu.php'),
    ],
    'style' => 'default',
    'hide_on_screen' => array('the_content')
]);


?>
