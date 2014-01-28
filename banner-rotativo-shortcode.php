<?php

function banner_shortcode($atts){
	require_once('db/banner-rotativo-db.php');
	require_once('db/banner-rotativo-db-slider.php');
	
	extract(shortcode_atts(array('id' => '',
								 'width' => '300',
								 'height' => '313'), $atts));
	
	$saida = '';
	$imagens = null;
	$i = 0;
	$url = get_option('siteurl').'/wp-content/plugins/jquery-banner-rotate';
	
	$saida .= '<script src="'.$url.'/js/cycle.js"></script>';
	
	if($id == ''){
		$imagens = BRDB::listar_todos_cinco();
		
		$saida .= '<script src="'.$url.'/js/fade-slider-cycle.js"></script>';
	} else {
		$imagens = BRDB::listar_todos_por_slider($id);
		$slider = BRDBSLIDER::buscar_por_id($id);
		
		if($slider->efeito == 'default'){
			$saida .= '<script src="'.$url.'/js/fade-slider-cycle.js"></script>';
		} else {
			$saida .= '<script src="'.$url.'/js/'.$slider->efeito.'-slider-cycle.js"></script>';
		}
	}
	
	
	$saida .= '<link rel="stylesheet" href="'.$url.'/css/cycle.css">';
	$saida .= '<div id="banners" style="width: '.$width.'px; height: '.$height.'px;">';
	foreach($imagens as $imagem){
		$gera = valida(date('Y-m-d'),$imagem->data_retirada);
		if($gera == true){
			$blank = ($imagem->nova == '1')? 'target="_blank"' : '';
			$saida .= '<a href="'.$imagem->pagina.'" '.$blank.'>';
			$saida .= '<img src="'.$imagem->link.'">';
			$saida .= '</a>';
		}
	}
		
	$saida .= '</div>';
	
	return $saida;
}

add_shortcode('banner-rotativo', 'banner_shortcode');
?>