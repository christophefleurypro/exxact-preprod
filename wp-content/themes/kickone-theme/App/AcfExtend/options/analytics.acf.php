<?php
use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Textarea;



// In this example we use the title as the question.
register_extended_field_group([
		'title' => 'Analytics',
		'fields' => [
				Textarea::make('Script Google Tag Manager','scripts_analytics')
		],
		'location' => [
				Location::if('options_page', 'acf-options-analytics'),
		],
		'style' => 'default'

]);
