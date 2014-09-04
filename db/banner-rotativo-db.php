<?php
	
class BRDB{
	
	static function criar_tabela_imagens(){
		global $wpdb;
		$tabela = $wpdb->base_prefix.'banners';
		$sql = '
CREATE TABLE '.$tabela.' (
  id int NOT NULL AUTO_INCREMENT,
  link varchar(250) null,
  data_insercao date not null,
  data_retirada varchar(10) null,
  pagina varchar(250) null,
  nova char null,
  slider_id int null,
  PRIMARY KEY(id)
);
';
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}
	
	static function salvar($link, $data, $pagina, $slider, $nova){
		global $wpdb;
		$tabela = $wpdb->base_prefix.'banners';
		$values['link'] = trim($link);
		$values['data_insercao'] = date('Y-m-d');
		$values['data_retirada'] = $data;
		$values['pagina'] = trim($pagina);
		$values['slider_id'] = $slider;
		$values['nova'] = $nova;
		
		$wpdb->insert($tabela,$values);
	}
	
	static function atualizar($id, $link, $data, $pagina, $slider, $nova){
		global $wpdb;
		$tabela = $wpdb->base_prefix.'banners';
		$values['link'] = trim($link);
		$values['data_retirada'] = $data;
		$values['pagina'] = trim($pagina);
		$values['slider_id'] = $slider;
		$values['nova'] = $nova;
		
		$wpdb->update($tabela,$values,array('id'=>$id));
	}
	
	static function excluir($id){
		global $wpdb;
		$tabela = $wpdb->base_prefix.'banners';
		
		$sql = $wpdb->prepare("DELETE FROM $tabela WHERE id = %d",$id);
		$wpdb->query($sql);
	}
	
	static function buscar_por_id($id){
		global $wpdb;
		$tabela = $wpdb->base_prefix.'banners';
		$sql = $wpdb->prepare("SELECT id, link, data_retirada, slider_id, pagina, nova FROM $tabela WHERE id = %d",$id);
		$imagem = $wpdb->get_row($sql);
		return $imagem;
	}
	
	static function listar_todos($limit = '5'){
		global $wpdb;
		$tabela = $wpdb->base_prefix.'banners';
		$imagens = $wpdb->get_results("SELECT id, link, data_retirada, slider_id, pagina, nova FROM $tabela ORDER BY data_insercao DESC LIMIT $limit");
		return $imagens;
	}
	
	static function listar_todos_por_slider($id, $limit = '5'){
		global $wpdb;
		$tabela = $wpdb->base_prefix.'banners';
		$imagens = $wpdb->get_results( "SELECT id, link, data_retirada, pagina, nova FROM $tabela WHERE slider_id = $id ORDER BY data_insercao DESC LIMIT $limit");
		return $imagens;
	}
	
	static function listar_todos_cinco(){
		global $wpdb;
		$tabela = $wpdb->base_prefix.'banners';
		$imagens = $wpdb->get_results( "SELECT id, link, data_retirada, pagina, nova FROM $tabela ORDER BY data_insercao DESC LIMIT 5");
		return $imagens;
	}
}
	
?>