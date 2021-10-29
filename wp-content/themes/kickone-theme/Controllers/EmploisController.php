<?php 
/**
* Class name: ProjectsController()
*
* A controller class is composed of methods suffixed with "Action", and responsibles for the following tasks:
* - Render the correct Twig/Timber template for the current page
* - Do the business logic associated to the current page
* - Provide the datas to the Twig/Timber templates
*
*/

namespace Controllers;

use \Timber;
use \Timber\PostQuery;
use \TimberPost;

class EmploisController extends AppController
{
	/**
	 * __Constructor:
	*
	* Call AppController::__construct to inherit AppController useful methods
	*
	* @return void
	*/
	public function __construct(){
		parent::__construct();
	}


	 /**
     * Method called by Router::routing()
    *
    * SampleAction() method renders <templates/listing> and provide it some datas
    *
    * @return void
    */
    public function listingAction(){

        $types     		= (get_query_var('types')) ? get_query_var('types') : false ;
        $categorie      = (get_query_var('categorie')) ? get_query_var('categorie') : false ;

    	$args = array(
            'post_type'       => array('emplois'),
            'post_status'     => array('publish'),
            'posts_per_page'  => -1
        );

    	if ($types != false && $types != 'all') {
    		$args['tax_query'] = array(
    			'relation' => 'AND',
    			array(
					'taxonomy'         => 'types',
					'field'            => 'slug',
					'terms'            => array($types),
					'operator'         => 'IN',
				)
    		);
    	}

		if ($categorie != false && $categorie != 'all') {
			$args['tax_query'] = array(
    			array(
					'taxonomy'         => 'categorie',
					'field'            => 'slug',
					'terms'            => array($categorie),
					'operator'         => 'IN',
				)
    		);
    	}
        $listing = new Timber\PostQuery($args);

        $listing_types = get_terms( array(
		    'taxonomy' => 'types',
		    'hide_empty' => false,
		) );

		$listing_categorie = get_terms( array(
		    'taxonomy' => 'categorie',
		    'hide_empty' => false,
		) );

        $this->render('emplois/listing.twig', array(
        	'_current_types' => $types,
        	'_current_categorie' => $categorie,
        	'types' => $listing_types,
        	'categorie' => $listing_categorie,
        	'listing' => $listing,
            'post' => new TimberPost
        ));
    }


    public function archiveAction(){

        return wp_redirect(get_permalink(get_field('page-listing-job','options')), 301);

    }



	/**
	 * Method called by Router::routing()
	*
	* SingleAction() method renders <fonds/single.twig> and provide it some datas
	*
	* @return void
	*/
	public function singleAction(){

		$post = new TimberPost();

		if (get_field('page-listing-job','options')) {
			$form = get_field('s-form',get_field('page-listing-job','options') );
		}

		$_GET['title-offre'] = $post->post_title();
		$_GET['ref-offre'] 	 = get_field('emplois--ref');

		$this->render('emplois/single.twig', array(
			'post' => new TimberPost(),
			'form' => $form
		));
	}


}