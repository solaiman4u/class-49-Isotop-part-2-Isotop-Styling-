<?php

//isotop ShortCode
function industry_isotop_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array(
        'title' => ''
        
    ), $atts));
    
    $isotop_categories = get_terms('isotop_cat');
    
    $industry_isotop_markup = '
        <div class="row">
            <div class="col-md-12">
                <ul class="isotop-filter">
                    <li>All Work</li>';
    
    if (!empty($isotop_categories) && !is_wp_error($isotop_categories)) {
        foreach ($isotop_categories as $isotop_category) {
            
            $industry_isotop_markup .= '<li>' . $isotop_category->name . '</li>';
        }
    }
    
    
    $industry_isotop_markup .= ' 

        </ul>
        </div>
        <div class="col-md-12">
        <div class="row">';

        $isotop_query = new WP_Query(array(
            'post_type' => 'industry-isotop',
            'posts_per_page' => -1));

        while ($isotop_query->have_posts()):
        $isotop_query->the_post();
        $post_id = get_the_ID();     

         $industry_isotop_markup .= ' 
         <div class="col-md-4">         
            <a href="'.get_permalink().'" class="isotop-box">
               <div style="background-image:url('.get_the_post_thumbnail_url(get_the_ID(),'large').')" class="isotop-box-bg"><i class="fa fa-plus" aria-hidden="true"></i></div>
                <p>'.get_the_title().'</p>
            </a>            
        </div>';

        endwhile;
        wp_reset_query();

        $industry_isotop_markup .= '
                 </div>
            </div>
        </div>';
    
    return $industry_isotop_markup;
    
}
add_shortcode('industry_isotop', 'industry_isotop_shortcode');
