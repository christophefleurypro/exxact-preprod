<?php

use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Wysiwyg;
use WordPlate\Acf\Fields\Text;


register_extended_field_group([
    'title' => 'Bandeau de Cookie',
    'fields' => [
			Wysiwyg::make('Description','opt-cookie-texte')
			 	->defaultValue('Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sollicitudin nunc vel lobortis aliquam. Cras molestie imperdiet dictum. Aliquam eros lacus, mattis eget consequat ac, feugiat a elit. Phasellus porta pharetra erat nec ullamcorper.'),
    ],
    'location' => [
			Location::if('options_page', 'acf-options-cookie'),
    ],
    'style' => 'default'
]);


?>
