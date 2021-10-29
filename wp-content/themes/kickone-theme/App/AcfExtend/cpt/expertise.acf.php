<?php

use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Text;


  register_extended_field_group([
      'title' => 'Expertise',
      'fields' => [
          Image::make('Icone','expertise--image')
              ->instructions('Icon au format SVG'),
          SimpleWysiwyg::make('Description','expertise--description')
      ],
      'location' => [
          Location::if('post_type', 'expertise'),
      ],
      'style' => 'default'
  ]);
