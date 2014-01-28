<?php

class BRDBSLIDER{
	static function criar_tabela_sliders(){
		global $wpdb;
		$tabela = $wpdb->base_prefix.'banner_sliders';
		$sql = '
CREATE TABLE '.$tabela.' (
  id int NOT NULL AUTO_INCREMENT,
  nome varchar(50)not null,
  efeito varchar(25) null,
  PRIMARY KEY(id)
);
';
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}
	
	static function salvar($nome, $efeito){
		global $wpdb;
		
		$tabela = $wpdb->base_prefix.'banner_sliders';
		
		$values['nome'] = trim($nome);
		$values['efeito'] = $efeito;
		
		$wpdb->insert($tabela,$values);
	}
	
	static function atualizar($id, $nome, $efeito){
		global $wpdb;
		
		$tabela = $wpdb->base_prefix.'banner_sliders';
		
		$values['nome'] = trim($nome);
		$values['efeito'] = $efeito;
		
		$wpdb->update($tabela,$values,array('id'=>$id));
	}
	
	static function buscar_por_id($id){
		global $wpdb;
		$tabela = $wpdb->base_prefix.'banner_sliders';
		$sql = $wpdb->prepare("SELECT id, nome, efeito FROM $tabela WHERE id = %d",$id);
		$slider = $wpdb->get_row($sql);
		return $slider;
	}
	
	static function excluir($id){
		global $wpdb;
		$tabela = $wpdb->base_prefix.'banner_sliders';
		
		$sql = $wpdb->prepare("DELETE FROM $tabela WHERE id = %d",$id);
		$wpdb->query($sql);
		
		$sql = $wpdb->prepare("UPDATE wp_banners SET slider_id = 0 WHERE slider_id = %d",$id);
		$wpdb->query($sql);
	}
	
	static function listar_todos(){
		global $wpdb;
		$tabela = $wpdb->base_prefix.'banner_sliders';
		$sliders = $wpdb->get_results( "SELECT id, nome FROM $tabela");
		return $sliders;
	}
}

?>