<?php global $pluginurl ?>

<link href="<?php echo $pluginurl ?>css/banner-rotativo.css" rel="stylesheet" />
	<h1>Sliders<a href="admin.php?page=sliders&opcao=novo_slider" class="adicionar-novo">Novo</a></h1>
	<table class="wp-list-table widefat fixed banners">
		<thead>
			<th>ID</th>
			<th>Slider</th>
			<th>Ações</th>
		</thead>
        <?php
			
			$sliders = BRDBSLIDER::listar_todos();
			
			if(count($sliders)){ 
				foreach($sliders as $slider) {?>
				<tr>
					<td><?php echo $slider->id ?></td>
					<td class="coluna-data"><?php echo $slider->nome ?></td>
					<td class="crud"><a href="admin.php?page=sliders&opcao=editar_slider&id=<?php echo $slider->id ?>" onclick="">Editar</a> - <a href="admin.php?page=sliders&opcao=excluir_slider&id=<?php echo $slider->id ?>" onclick="if(!confirm('Tem certeza que deseja excluir este slider?')) return false;">Excluir</a></td>
				</tr>
			<?php 
				}
			} else { ?>
				<tr><td>Nenhum slider salvo</td></tr>
			<?php }
			
		?>
		<tbody>
		</tbody>
	</table>