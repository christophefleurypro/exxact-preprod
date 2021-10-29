<?php
use WordPlate\Acf\Location;
use WordPlate\Acf\Fields\Layout;
use WordPlate\Acf\Fields\Wysiwyg;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\Tab;
use WordPlate\Acf\Fields\Textarea;
use WordPlate\Acf\Fields\Image;

register_extended_field_group([
    'title' => "Page d'acceuil",
    'fields' => [
    	Tab::make("Écran d'accueil")
            ->placement('left'),
        Image::make('Image', 's1--image')
            ->instructions('Taille de l\'image : 1920 × 1080 pixels')
            ->wrapper(['width' => '50']),
        Image::make('Image sur mobil', 's1--image-mobil')
            ->instructions('Taille de l\'image : 600 x 1200 pixels')
            ->wrapper(['width' => '50']),
        Textarea::make('Titre de la section', 's1--title')
            ->newLines('br')
            ->defaultValue('Présentation du thème Kickone.')
            ->rows(2),
        Textarea::make('Texte', 's1--text')
            ->newLines('br')
            ->rows(4)
            ->defaultValue('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis lectus eget arcu commodo ultricies. Morbi ac feugiat dolor, sit amet gravida enim.')
        ,
        SimpleBtn::make('La société','s1--btn'),
        SimpleBtn::make('Nous rejoindre','s1--btn-2'),
        Tab::make("L'entreprise"),
        SectionEntreprise::make('','groupe'),
        Tab::make("L'équipe"),
        SectionTeam::make('','groupe-team'),
        Tab::make("La philosophie"),
        SectionPhilosophie::make('','groupe-philosophie'),
        Tab::make("Nos missions"),
        SectionMission::make('','groupe-missions'),
        Tab::make("Nos expertises"),
        SectionExpertise::make('','groupe-expertise'),
        Tab::make("Notre région"),
        SectionRegion::make('','groupe-region'),
        Tab::make("Nos produits"),
        SectionProduct::make('','groupe-product'),
        Tab::make("Actualités"),
        SectionActu::make('','groupe-actu'),
        Tab::make("Les + "),
        SectionLesplus::make('','groupe-lesplus'),
        Tab::make("Offres d'emploi "),
        SectionOffres::make('','groupe-offres')
    ],
    'location' => [
        Location::if('page_template', 'templates/home.php'),
    ],
    'style' => 'default',
    'hide_on_screen' => array('the_content')
]);


?>
