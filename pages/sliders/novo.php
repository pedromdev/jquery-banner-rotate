<form action="admin.php?page=sliders&opcao=salvar_slider" method="post" style="width:450px;">
	<h2>Novo Slider</h2>
	<table class="wp-list-table widefat fixed">
  <tr>
    <td>Nome do slider</td>
    <td><label for="nome"></label>
      <input type="text" name="nome" id="nome"></td>
  </tr>
  <tr>
    <td>Efeito do slider</td>
    <td>
    	<select name="efeito">
        	<option value="default">Selecionar...</option>
            <option value="fade">Fade</option>
            <option value="shuffle">Shuffle</option>
            <option value="zoom">Zoom</option>
            <option value="turnDown">Turn Down</option>
            <option value="curtainX">Curtain X</option>
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
