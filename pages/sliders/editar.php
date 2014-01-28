<form action="admin.php?page=sliders&opcao=atualizar_slider" method="post" style="width:450px;">
	<h2>Novo Slider</h2>
	<table class="wp-list-table widefat fixed">
  <tr>
    <td>Nome do slider</td>
    <input type="hidden" name="id" value="<?php echo $slider->id ?>" />
    <td><label for="nome"></label>
      <input type="text" name="nome" id="nome" value="<?php echo $slider->nome ?>"></td>
  </tr>
  <tr>
    <td>Efeito do slider</td>
    <td>
    	<select name="efeito">
        	<option value="default">Selecionar...</option>
            <option value="fade" <?php if($slider->efeito == 'fade') echo 'selected';?>>Fade</option>
            <option value="shuffle" <?php if($slider->efeito == 'shuffle') echo 'selected';?>>Shuffle</option>
            <option value="zoom" <?php if($slider->efeito == 'zoom') echo 'selected';?>>Zoom</option>
            <option value="turnDown" <?php if($slider->efeito == 'turnDown') echo 'selected';?>>Turn Down</option>
            <option value="curtainX" <?php if($slider->efeito == 'curtainX') echo 'selected';?>>Curtain X</option>
        </select>
    </td>
  </tr>
  <tr>
    <td><input class="button-primary" type="submit" name="salvar" id="Salvar" value="Salvar"></td>
  </tr>
</table>
<br>
<a href="admin.php?page=banner-rotativo">Voltar</a>

</form>
