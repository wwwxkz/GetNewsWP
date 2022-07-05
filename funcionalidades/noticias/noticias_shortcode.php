<?php

function noticias_shortcode()
{
    $retorno = '';
    $id = 45;
    $args = array('category' => $id, 'numberposts' => 13);
    $categories = get_posts($args);
    $retorno .= '<div class="noticias">';
        $retorno .= '<div class="noticia">';
            $retorno .= '<a href="' . get_permalink($categories[0]->ID) . '">' . $categories[0]->post_excerpt . '</a>';
            $data = new IntlDateFormatter('pt_BR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
            $data = $data->format(strtotime($categories[0]->post_date));        
            $retorno .= '<a>' . $data . ' - ' . get_the_category($categories[0]->ID)[0]->name . '</a>';
        $retorno .= '</div>';
        $retorno .= '<div class="noticias-grupo">';
        foreach($categories as $i=>$category) {
			if($i >= 1){
				$retorno .= '<ul class="noticia-grupo">';
					$retorno .= '<li><a href="' . get_permalink($category->ID) . '">' . $category->post_excerpt . '</a></li>';
					$data = new IntlDateFormatter('pt_BR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
					$data = $data->format(strtotime($category->post_date));            
					$retorno .= '<p>' . $data . ' - ' . get_the_category($category->ID)[0]->name . '</p>';
				$retorno .= '</ul>';
			}
        }    
        $retorno .= '</div>';
    $retorno .= '</div>';

    $retorno .= '
    <style>
        .noticias {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }
		@media (min-width: 800px) {
		    .noticias > div:first-child {
				margin-bottom: 0px;
				width: 40%;
			}
			.noticia-grupo {
				flex: none !important;
				width: 46% !important;
			}
		}
		.noticias > div:first-child {
			margin-bottom: 20px;
		}
        .noticia {
            display: flex;
            flex-direction: column;
			margin-right: 20px;
        }
        .noticia > a:first-child {
            font-size: var(--wp--preset--font-size--medium);
        }
        .noticia > a:last-child {
            font-size: var(--wp--preset--font-size--medium);
            color: #1768b1;
        }
		@media (min-width: 800px) {
			.noticia > a:first-child {
				font-size: var(--wp--preset--font-size--large);
			}
			.noticia-grupo:nth-last-of-type(-n+2) {
				border-bottom: none;
			}
		}
        .noticias-grupo {
            display: flex;
            flex-direction: row;
			flex: 1;
            flex-wrap: wrap;
			min-width: 250px;
			justify-content: space-around;
        }
        .noticia-grupo {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-width: 200px;
			border-bottom: solid #e5e5e5 1px;
			margin-bottom: 10px;
			list-style-type: disc;
        }
		.noticia-grupo:last-child { 
			border-bottom: none;
		}

	
        .noticia-grupo > a {
            font-size: var(--wp--preset--font-size--small);
        }
        .noticia-grupo > p {
            font-size: var(--wp--preset--font-size--small);
            color: #1768b1;
        }
    </style>
    ';

    return $retorno;
}
