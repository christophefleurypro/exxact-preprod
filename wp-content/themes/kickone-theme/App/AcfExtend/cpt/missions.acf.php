<?php

use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Textarea;


  register_extended_field_group([
      'title' => 'Mission',
      'fields' => [
          Textarea::make('Détails','mission--text'),
          SimpleWysiwyg::make('Explication','mission--explication')
      ],
      'location' => [
          Location::if('post_type', 'mission'),
      ],
      'style' => 'default'
  ]);
