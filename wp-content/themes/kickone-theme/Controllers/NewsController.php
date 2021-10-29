<?php 
/**
* Class name: NewsController()
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

class NewsController extends AppController
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
    * ArchiveAction() method renders <news/archive.twig> and provide it some datas
    *
    * @return void
    */
    public function archiveAction(){
        $paged = $this->getPagedArgument();
        $types          = (get_query_var('type')) ? get_query_var('type') : false ;

        $args = array(
            'post_type'       => array('post'),
            'post_status'     => array('publish'),
            'posts_per_page'  => get_option( 'posts_per_page' ),
            'paged'           => $paged
        );

        if ($types != false && $types != 'all') {
            $tmp = get_category_by_slug($types);
            if ($tmp) {
                $args['category__in'] = array( $tmp->term_id );
            }
        }

        $listing = new Timber\PostQuery($args);

        $listing_types = get_categories( array(
            'hide_empty' => false,
        ) );

        $this->render('news/archive.twig', array(
            '_current_types' => $types,
            'types' => $listing_types,
            'categorie' => $listing_categorie,
            'listing' => $listing,
            'post' => new TimberPost
        ));
    }


    /**
     * Method called by Router::routing()
    *
    * SingleAction() method renders <news/single.twig> and provide it some datas
    *
    * @return void
    */
    public function singleAction(){
        $this->render('news/single.twig', array(
            'post' => new TimberPost()
        ));
    }


    /**
     * Method called by Router::routing()
    *
    * CategoryAction() method renders <news/category.twig> and provide it some datas
    *
    * @return void
    */
    public function categoryAction(){
        $post = get_queried_object();
        $blog = get_option( 'page_for_posts' );
        $url = add_query_arg( 'type', $post->slug , get_the_permalink( $blog ));


        // redirection sur la page en question
        //$term = get_queried_object();
        // $url = get_field('options_'. $post->post_type ,'options');
        header('Location: '. $url);
        exit();


    }
  

    /**
     * Method called by Router::routing()
    *
    * tagAction() method renders <news/tag.twig> and provide it some datas
    *
    * @return void
    */
    public function tagAction(){
        $this->render('news/tag.twig', array(
            'posts' => Timber::get_posts(),
            'title' => single_tag_title('', false)
        ));
    }


    /**
     * Method called by Router::routing()
    *
    * findAllAjax() method renders all posts
    *
    * @return void
    */
    public function findAllAjax(){
        $this->ajaxRender('news/render/news-list.twig', array(
                'posts' => new Timber\PostQuery(array( 
                'post_type' => 'post' 
            ))
        ));
    }


    /**
     * Method called by Router::routing()
    *
    * findOneAjax() method renders one post
    *
    * @param int  $id   Post ID
    *
    * @return void
    */
    public function findOneAjax($id){
        $this->ajaxRender('news/render/news-list.twig', array(
                'posts' => new Timber\PostQuery(array( 
                'post_type' => 'post',
                'p' => $id
            ))
        ));
    }
  

    /**
     * Method called by Router::routing()
    *
    * findByCategoryAjax() method renders list of posts of a specific category
    *
    * @param string  $category   Category slug
    *
    * @return void
    */
    public function findByCategoryAjax($category){
        $this->ajaxRender('news/render/news-list.twig', array(
                'posts' => new Timber\PostQuery(array(
                'post_type' => 'post',
                'category_name' => $category
            ))
        ));
    }


    /**
     * Method called by Router::routing()
    *
    * loadMorePostsAjax() method renders more posts from offset
    *
    * @param string  $offset   Actual number of posts
    *
    * @return void
    */
    public function loadMorePostsAjax($offset){

        $args = array(
            'offset' => $offset,
            'posts_per_page' => 9 
        );

        $argsLimit = array(
            'offset' => $offset + 9 + 1,
            'posts_per_page' => 1, 
        );

        $this->ajaxRender('news/render/news-list.twig', array(
            'posts' => new Timber\PostQuery($args),
            'limit' => new Timber\PostQuery($argsLimit)
        ));
    }
}