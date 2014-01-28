<?php global $pluginurl ?>

<form action="admin.php?page=banner-rotativo&opcao=salvar_banner" method="post" style="width:450px;" onsubmit="valida(this); return false;">
  <h2>Novo Banner</h2>
	<table class="wp-list-table widefat fixed">
  <tr>
    <td><label for="link">URL da imagem</label></td>
    <td>
      <input type="text" name="link" id="link"></td>
  </tr>
  <tr>
    <td><label for="dataRetirada">Data da retirada</label></td>
    <td>
      <input type="text" name="dataRetirada" id="dataRetirada" onKeyPress="formatar(this);"></td>
  </tr>
  <tr>
    <td>URL da página</td>
    <td><label for="pagina"></label>
      <input type="text" name="pagina" id="pagina"></td>
  </tr>
  <tr>
    <td>Slider</td>
    <td>
    	<select name="slider">
        	<option value="0">Selecionar...</option>
            <?php
	  			$sliders = BRDBSLIDER::listar_todos();
				
				foreach($sliders as $slider){
	  		?>
            		<option value="<?php echo $slider->id ?>"><?php echo $slider->nome ?></option>
            <?php } ?>
        </select>
    </td>
  </tr>
  <tr>
    <td>Nova aba</td>
    <td><input type="checkbox" name="nova" id="nova" value="1"></td>
  </tr>
  <tr>
    <td><input class="button-primary" type="submit" name="button" id="button" value="Salvar"></td>
  </tr>
  </table>
<br/>
<a href="admin.php?page=banner-rotativo">Voltar</a>
</form>
<script type="text/javascript" src="<?php echo $pluginurl ?>js/banner-rotativo.js"></script>