<?php
/**
* Class name: TimberService()
*
* This class contains methods provided to timber templates
*
*/

namespace Services;
use Timber;

class TimberService
{
    /**
    * svg() allows to get code from an SVG file  
    *
    * @param bool  $url  SVG file url
    *
    * @return string  SVG code 
    */

    /**
    *
    * Création du menu ancre
    */
    public static function set_color_menu(){

        if (is_page_template( 'templates/emplois.php' ) || is_singular( "emplois" ) || is_home() || is_singular( "produit" ) || is_page_template( 'templates/actu.php' )) {
            $menus = 'header-white';
        }

        return $menus;
    }





    /**
    *
    * Création du menu ancre
    */
    public static function get_section_product($post_id){

        $sections = array(
            get_field('context--section-menu-id',$post_id),
            get_field('solution--section-menu-id',$post_id),
            get_field('partners--section-menu-id',$post_id),
            get_field('gallery--section-menu-id',$post_id),
            get_field('technologie--section-menu-id',$post_id),
            get_field('spec--section-menu-id',$post_id),
            get_field('doc--section-menu-id',$post_id),
        );


        foreach ($sections as $key => $value) {
            if ($value['hide-section'] == false && !empty($value['--text']) ) {
                $tmp = array(
                    'link' => $url .'#' . sanitize_title($value['--text']),
                    'slug' => '#' . sanitize_title($value['--text']),
                    'title' => $value['--text'],
                    'classes' => 'menu-item',
                    'scroll' => $classScroll
                );
                $menus[] = $tmp;
            }
        }
        return $menus;
    }


    /**
    *
    * Création du menu ancre
    */
    public static function get_section_home_page($post_id){

        if (is_front_page()) {
            $classScroll = 'scroll-section';
            $url = '';
        }else{
            $url = get_permalink( $post_id );
            $classScroll = '';

        }
        $sections = array(
            get_field('groupe',$post_id)["--section-menu-id"],
            get_field('groupe-team',$post_id)["--section-menu-id"],
            get_field('groupe-philosophie',$post_id)["--section-menu-id"],
            get_field('groupe-missions',$post_id)["--section-menu-id"],
            get_field('groupe-expertise',$post_id)["--section-menu-id"],
            get_field('groupe-region',$post_id)["--section-menu-id"],
            get_field('groupe-lesplus',$post_id)["--section-menu-id"],
            get_field('groupe-offres',$post_id)["--section-menu-id"],
        );

        $menus = array();

        foreach ($sections as $key => $value) {
            if ($value['hide-section'] == false && !empty($value['--text']) ) {
                $tmp = array(
                    'link' => $url .'#' . sanitize_title($value['--text']),
                    'slug' => '#' . sanitize_title($value['--text']),
                    'title' => $value['--text'],
                    'classes' => 'menu-item',
                    'scroll' => $classScroll
                );
                $menus[] = $tmp;
            }
        }
        return $menus;
    }

    public static function get_types_product($id){

        $term = get_term($id,'types_produit');
        $args = array(
            'post_type'       => array('produit'),
            'post_status'     => array('publish'),
            'posts_per_page'  => -1,
            'tax_query'       => array(
                'relation' => 'AND',
                array(
                    'taxonomy'         => 'types_produit',
                    'field'            => 'slug',
                    'terms'            => array( $term->slug ),
                    'include_children' => true,
                    'operator'         => 'IN',
                )
            )
        );

        $detail = array(
            'image' => get_field('image', $term),
            'name' => $term->name,
        );
        $posts = new Timber\PostQuery($args);

        return array('products'=> $posts, 'detail' => $detail);
    }


    public static function get_posts($cpt = 'post' , $number = 3 ){
        $args = array(
            'post_type'       => array($cpt),
            'post_status'     => array('publish'),
            'posts_per_page'  => $number,
        );
        $posts = new Timber\PostQuery($args);
        
        return $posts;
    }
    
    public static function svg($url){
        $baseUrl = dirname(dirname(ROOT));
        $toReplace = get_site_url() . '/wp-content';
        $finalUrl = str_replace($toReplace, $baseUrl, $url);
        return file_get_contents($finalUrl, false);
    }

    public static function getVimeoVideoIdFromUrl($url) {
        $regs = array();
        $id = '';
        if (preg_match('%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $url, $regs)) {
            $id = $regs[3];
        }
        return $id;
    }


    public static function getYoutubeVideoIdFromUrl($url) {
        $regs = array();
        $id = '';
        if (preg_match('%^https?:\/\/(?:www\.|player\.)?youtube.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $url, $regs)) {
            $id = $regs[3];
        }
        return $id;
    }
}

