<?php global $pluginurl ?>

<link href="<?php echo $pluginurl ?>css/banner-rotativo.css" rel="stylesheet" />
<table class="wp-list-table widefat fixed" style="width:600px; margin-top:15px;">
  <tr>
    <td><h2>Banner Rotativo</h2></td>
  </tr>
  <tr>
    <td>Para usar o slide dos banners salvos basta usar o shortcode <span class="shortcode">[banner-rotativo]</span>
    	onde deseja que ele seja inserido. Ele também usa os parâmetros para altura e largura do slide, basta colocar os
    	valores width e height como no exemplo: <span class="shortcode">[banner-rotativo width=200]</span>. Caso as
    	imagens estejam em um slide específico basta especificar o id do slide:
    	<span class="shortcode">[banner-rotativo id=1]</span>. Se quiser mostrar imagens de qualquer slide basta não
    	especificar o id. Você também pode especificar um número máximo de slides usando
    	<span class="shortcode">[banner-rotativo count=7]</span>.
<br />
<br />
jQuery adquiridos em <a href="http://jquery.malsup.com/cycle/" target="_blank">jQuery Cycle</a>
</td>
  </tr>
  <tr>
    <td><span class="descricao"><p>Este plugin foi desenvolvido por Pedro Marcelo. Sugestões mandem e-mail para pedromarcelodesaalves@gmail.com ou mandem uma mensagem no <a href="http://www.facebook.com/pedro.marcelo.50" target="_blank">Facebook</a></p></span></td>
  </tr>
</table>

<table class="wp-list-table widefat fixed" style="width:600px; margin-top:15px;">
	<thead>
		<tr>
			<th colspan="3" style="text-align:center"><h3>Parâmetros do shortcode</h3></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><b>id (opcional)</b></td>
			<td>Contém um valor inteiro que representa o ID do slider que será mostrado</td>
			<td>Valor padrão: ''</td>
		</tr>
		<tr>
			<td><b>width (opcional)</b></td>
			<td>Largura do slider em px</td>
			<td>Valor padrão: 300px</td>
		</tr>
		<tr>
			<td><b>height (opcional)</b></td>
			<td>Altura do slider em px</td>
			<td>Valor padrão: 313px</td>
		</tr>
		<tr>
			<td><b>count (opcional)</b></td>
			<td>Número máximo de slides</td>
			<td>Valor padrão: 5</td>
		</tr>
	</tbody>
</table>