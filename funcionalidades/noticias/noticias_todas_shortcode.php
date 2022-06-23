<?php

function noticias_todas_shortcode()
{
    $retorno = '';
    $id = 1;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $retorno .= '<div class="noticias">';
    $args = array( 'posts_per_page' => 20, 'category_id' => $id,
    'paged' => $paged,'post_type' => 'post' );
        $postslist = new WP_Query( $args );
        if ( $postslist->have_posts() ) :
            while ( $postslist->have_posts() ) : $postslist->the_post(); 
                $shortlink = wp_get_shortlink( get_the_ID() );
                echo "<div class='noticia-grupo'><a href=\"" . esc_url($shortlink)  . "\">";
                the_title(); 
                echo "</a><p>";
                the_time('j F, Y');
                echo ' - ';
                the_category(' ', ' ');
                echo "<p>";
                echo "</div>";
             endwhile;
                echo '<br><br>'; 
                previous_posts_link( '&laquo; Últimas Notícias' );
                echo ' - '; 
                next_posts_link( 'Notícias anteriores &raquo;', $postslist->max_num_pages );
            $retorno .= '</div>';
            wp_reset_postdata();
        endif;
    $retorno .= '</div>';

    $retorno .= '
    <style>
        .noticia-grupo > a {
            font-size: var(--wp--preset--font-size--medium);
        }
        .noticia-grupo > p {
            font-size: var(--wp--preset--font-size--small);
            color: #1768b1;
        }
    </style>
    ';

    return $retorno;
}
