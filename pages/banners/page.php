<?php global $pluginurl ?>

<link href="<?php echo $pluginurl ?>css/banner-rotativo.css" rel="stylesheet" />
  <h1>Banners<a href="admin.php?page=banner-rotativo&opcao=novo_banner" class="adicionar-novo">Novo</a></h1>
	<table class="wp-list-table widefat fixed banners">
    	<thead>
        	<th>Imagem</th>
            <th>Data de expiração</th>
            <th>Slider</th>
            <th>Ações</th>
        </thead>
    	<tbody>
        	<?php
				
				$imagens = BRDB::listar_todos();
				
				$i = 1;
				
				if(count($imagens)){
					foreach($imagens as $imagem){ 
						$l = valida(date('Y-m-d'), $imagem->data_retirada);
						$class = ($l == true)? "" : "class='alert-msg'";
					?>
					<tr>
                    	<input name="id<?php echo $i ?>" type="hidden" value="<?php echo $imagem->id ?>" />
    					<td><img src="<?php echo $imagem->link ?>" height="40" id="link<?php echo $i ?>" name="link<?php echo $i ?>"  /></td>
						<td class="coluna-data"><label <?php echo $class ?> name="dataRetirada<?php echo $i ?>" id="dataRetirada<?php echo $i ?>" placeholder="Data da retirada"><?php echo ($imagem->data_retirada != '')? data($imagem->data_retirada) : '' ?></label></td>
                        <td>
                        	<?php
								if($imagem->slider_id != 0){
									$slider = BRDBSLIDER::buscar_por_id($imagem->slider_id);
									echo $slider->nome;
								}
							?>
                        </td>
    					<td class="crud"><a href="admin.php?page=banner-rotativo&opcao=editar_banner&id=<?php echo $imagem->id ?>" onclick="">Editar</a> - <a href="admin.php?page=banner-rotativo&opcao=excluir_banner&id=<?php echo $imagem->id ?>" onclick="if(!confirm('Tem certeza que deseja excluir este banner?')) return false;">Excluir</a></td>
  					</tr>
					<?php
                		$i++;
					}
				} else { ?>
					<tr><td style="width: 300px;">Nenhuma imagem salva</td></tr>
				<?php }
			?>
  		</tbody>
	</table>
<script type="text/javascript" src="<?php echo ABSPATH ?>/wp-content/plugins/jquery-banner-rotate/js/banner-rotativo.js"></script>