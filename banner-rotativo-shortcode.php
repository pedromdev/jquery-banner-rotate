<?php

function banner_shortcode($atts){
	global $pluginurl;
	
	require_once('db/banner-rotativo-db.php');
	require_once('db/banner-rotativo-db-slider.php');
	
	extract(
		shortcode_atts(
			array(
				'id' => '',
				'width' => '300',
				'height' => '313',
				'count' => '5'
			),
			$atts
		)
	);

	$count = (is_numeric($count) && (intval($count) == floatval($count)))? $count : '5';
	
	$saida = '';
	$imagens = null;
	$i = 0;
	
	$saida .= '<script src="'.$pluginurl.'js/cycle.js"></script>';
	
	if($id == ''){
		$imagens = BRDB::listar_todos($count);
		
		$saida .= '<script src="'.$pluginurl.'js/fade-slider-cycle.js"></script>';
	} else {
		$imagens = BRDB::listar_todos_por_slider($id, $count);
		$slider = BRDBSLIDER::buscar_por_id($id);
		
		if($slider->efeito == 'default'){
			$saida .= '<script src="'.$pluginurl.'js/fade-slider-cycle.js"></script>';
		} else {
			$saida .= '<script src="'.$pluginurl.'js/'.$slider->efeito.'-slider-cycle.js"></script>';
		}
	}
	
	
	$saida .= '<link rel="stylesheet" href="'.$pluginurl.'css/cycle.css">';
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