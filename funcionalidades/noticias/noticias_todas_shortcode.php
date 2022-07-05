<?php

function noticias_todas_shortcode()
{
	// Noticias 45
	// Sem categoria 1
    $id = 45;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    echo '<div class="noticias">';
    echo '<h2 class="categorias-header titulo">Notícias</h2><br>';
    $args = array( 'posts_per_page' => 20, 'cat' => $id,
    'paged' => $paged,'post_type' => 'post' );
        $postslist = new WP_Query( $args );
        if ( $postslist->have_posts() ) :
            while ( $postslist->have_posts() ) : $postslist->the_post(); 
                $shortlink = wp_get_shortlink( get_the_ID() );
                echo "<ul class='noticia-grupo'><li><a href=\"" . esc_url($shortlink)  . "\">";
                the_title(); 
                echo "</a></li><p>";
                the_time('j F, Y');
                echo ' - ';
                the_category(' ', ' ');
                echo "<p>";
                echo "</ul>";
             endwhile;
                echo '<br><br>'; 
                previous_posts_link( '&laquo; Últimas Notícias' );
                echo ' - '; 
                next_posts_link( 'Notícias anteriores &raquo;', $postslist->max_num_pages );
            echo '</div>';
            wp_reset_postdata();
        endif;
    echo '</div>';

    echo '
    <style>
        .noticia-grupo > li > a {
            font-size: var(--wp--preset--font-size--medium);
        }
        .noticia-grupo > p {
            font-size: var(--wp--preset--font-size--small);
            color: #1768b1;
        }
		.noticia-grupo {
			border-bottom: solid #e5e5e5 1px;
			margin-bottom: 15px;
		}
    </style>
    ';
}
