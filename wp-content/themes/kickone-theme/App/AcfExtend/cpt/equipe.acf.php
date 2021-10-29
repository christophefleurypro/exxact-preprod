<?php

use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Text;


  register_extended_field_group([
      'title' => 'Equipe',
      'fields' => [
          Image::make('Image de profil','team--image')
            ->instructions('Taille de l\'image : 280 x 280 pixels'),
          Text::make('Fonction','team--function')
      ],
      'location' => [
          Location::if('post_type', 'equipe'),
      ],
      'style' => 'default'
  ]);
