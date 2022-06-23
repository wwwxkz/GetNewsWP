<?php
require_once(NOTICIAS_LOCAL . 'funcionalidades/noticias/noticias_shortcode.php');
require_once(NOTICIAS_LOCAL . 'funcionalidades/noticias/noticias_todas_shortcode.php');
add_shortcode('noticias', 'noticias_shortcode');
add_shortcode('noticias_todas', 'noticias_todas_shortcode');
?>