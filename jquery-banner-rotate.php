<?php
/*
Plugin Name: jQuery Banner Rotate
Plugin URI: https://www.facebook.com/pedro.marcelo.50
Description: Cria banners rotativos usando jQuery Cycle usando controle por datas de expiração.
Version: 2.1
Author: Pedro Marcelo
Author URI: https://www.facebook.com/pedro.marcelo.50
License: GPL3
*/

	$request = false;
	$pluginurl = plugin_dir_url( __FILE__ );
	
	require_once('db/banner-rotativo-db.php');
	require_once('db/banner-rotativo-db-slider.php');
	include_once('banner-rotativo-shortcode.php');
	
	add_action('admin_menu', 'menu');
	register_activation_hook(__FILE__,'tabelas');
	
	function menu(){
		add_menu_page('Todos os banners','Banner Rotativo','upload_files','banner-rotativo', 'banner_rotativo_page');
		//banner_rotativo_resource_url('images/banner.png')
		add_submenu_page('banner-rotativo', 'Todos os Sliders', 'Todos os Sliders', 'upload_files', 'sliders', 'banner_rotativo_page');
		add_submenu_page('banner-rotativo', 'Novo Banner', 'Novo Banner', 'upload_files', 'banner-rotativo&opcao=novo_banner', 'novo_banner');
		add_submenu_page('banner-rotativo', 'Novo Slider', 'Novo Slider', 'upload_files', 'sliders&opcao=novo_slider', 'novo_slider');
		add_submenu_page('banner-rotativo', 'Sobre', 'Sobre', 'upload_files', 'banner-rotativo-sobre', 'sobre');
	}
	
	function tabelas(){
		BRDB::criar_tabela_imagens();
		BRDBSLIDER::criar_tabela_sliders();
	}
	
	function banner_rotativo_page(){
		global $request;
		
		if(isset($_REQUEST['page']) && $_REQUEST['page'] == 'banner-rotativo'){
			if(isset($_REQUEST['opcao'])){
				switch ($_REQUEST['opcao']){
					/* BANNER */
					case 'novo_banner':
						novo_banner();
						break;
					case 'salvar_banner':
						salvar_banner();
						break;
					case 'excluir_banner':
						excluir_banner();
						break;
					case 'atualizar_banner':
						atualizar_banner();
						break;
					case 'editar_banner':
						editar_banner();
						break;
					default:
						break;
				}
			} else {
				include('pages/banners/page.php');
				if($request == true)
					$request = false;
			}
		} else if(isset($_REQUEST['page']) && $_REQUEST['page'] == 'sliders'){
			if(isset($_REQUEST['opcao'])){
				switch($_REQUEST['opcao']){
					/* SLIDER */
					case 'novo_slider':
						novo_slider();
						break;
					case 'salvar_slider':
						salvar_slider();
						break;
					case 'excluir_slider':
						excluir_slider();
						break;
					case 'atualizar_slider':
						atualizar_slider();
						break;
					case 'editar_slider':
						editar_slider();
						break;
					default:
						break;
				} 
			} else {
				include('pages/sliders/page.php');
				if($request == true)
					$request = false;
			}
		}
	}

	function sobre(){
		include('banner-rotativo-sobre.php');
	}

	/* BANNER */
	
	function novo_banner(){
		include('pages/banners/novo.php');
	}
	
	function editar_banner(){
		$imagem = null;
		if(isset($_REQUEST['id'])){
			$imagem = BRDB::buscar_por_id($_REQUEST['id']);
			include('pages/banners/editar.php');
		}
	}
	
	function salvar_banner(){
		global $request;
		if($request == false){
			BRDB::salvar($_POST['link'], data_mysql($_POST['dataRetirada']), $_POST['pagina'], $_POST['slider'], $_POST['nova']);
			echo '<h2>Imagem salva com sucesso</h2>';
        	echo '<a href="admin.php?page=banner-rotativo">Voltar</a>';
		}
        
    	$request = true;
	}
	
	function excluir_banner(){
		global $request;
		if(isset($_REQUEST['id']) && $request == false){
			BRDB::excluir($_REQUEST['id']);
			echo '<h2>Imagem excluída com sucesso</h2>';
        	echo '<a href="admin.php?page=banner-rotativo">Voltar</a>';
		}
        
    	$request = true;
	}
	
	function atualizar_banner(){
		global $request;
		if($request == false){
			BRDB::atualizar($_POST['id'], $_POST['link'], data_mysql($_POST['dataRetirada']), $_POST['pagina'], $_POST['slider'], $_POST['nova']);
			echo '<h2>Imagem atualizada com sucesso</h2>';
        	echo '<a href="admin.php?page=banner-rotativo">Voltar</a>';
		}
        
    	$request = true;
	}
	
	/* SLIDER */
	
	function novo_slider(){
		include('pages/sliders/novo.php');
	}
	
	function editar_slider(){
		$slider = null;
		if(isset($_REQUEST['id'])){
			$slider = BRDBSLIDER::buscar_por_id($_REQUEST['id']);
			include('pages/sliders/editar.php');
		}
	}
	
	function salvar_slider(){
		global $request;
		if($request == false){
			BRDBSLIDER::salvar($_POST['nome'], $_POST['efeito']);
			echo '<h2>Slider salvo com sucesso</h2>';
        	echo '<a href="admin.php?page=sliders">Voltar</a>';
		}
        
    	$request = true;
	}
	
	function excluir_slider(){
		global $request;
		if(isset($_REQUEST['id']) && $request == false){
			BRDBSLIDER::excluir($_REQUEST['id']);
			echo '<h2>Slider excluído com sucesso</h2>';
        	echo '<a href="admin.php?page=sliders">Voltar</a>';
		}
        
    	$request = true;
	}
	
	function atualizar_slider(){
		global $request;
		if($request == false){
			BRDBSLIDER::atualizar($_POST['id'], $_POST['nome'], $_POST['efeito']);
			echo '<h2>Slider atualizado com sucesso</h2>';
        	echo '<a href="admin.php?page=sliders">Voltar</a>';
		}
        
    	$request = true;
	}
	
	/* OUTRAS FUNCIONALIDES */
	
	function data_mysql($_date = null) {
		$format = '/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/';
		if ($_date != null && preg_match($format, $_date, $partes)) {
			return $partes[3].'-'.$partes[2].'-'.$partes[1];
		}
		return '';
	}
	
	function data($data){
		return date('d/m/Y', strtotime($data));;
	}
	
	function valida($data_atual, $data_expira){
		if($data_expira == '' || $data_expira == '0000-00-00')
			return true;
		
		list($aa, $ma, $da) = split('-', $data_atual);
		list($ae, $me, $de) = split('-', $data_expira);
		
		if(intval($aa) > intval($ae)){
			return false;
		} else if(intval($aa) == intval($ae)){
			if(intval($ma) > intval($me)){
				return false;
			} else if(intval($ma) == intval($me)){	
				if(intval($da) > intval($de)){
					return false;
				} else {
					return true;
				}
			} else {
				return true;
			}
		} else {
			return true;
		}
		
		return true;
	}
	
	function banner_rotativo_resource_url($relativePath){
		return plugins_url($relativePath, plugin_basename(__FILE__));
	}

?>