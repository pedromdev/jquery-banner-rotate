<?php global $pluginurl ?>

<form action="admin.php?page=banner-rotativo&opcao=atualizar_banner" method="post" style="width:490px;" onsubmit="valida(this); return false;">
	<h2>Editar</h2>
	<table class="wp-list-table widefat fixed">
  <tr>
  	<input type="hidden" name="id" id="id" value="<?php echo $imagem->id ?>" />
    <td width="100"><label for="link">URL da imagem</label></td>
    <td>
      <input type="text" name="link" id="link" value="<?php echo $imagem->link ?>"> ou <input type="submit" class="button-primary" id="jbr_upload_image_button" value="Carregar imagem">
  </td>
  </tr>
  <tr>
    <td><label for="dataRetirada">Data da retirada</label></td>
    <td>
      <input type="text" name="dataRetirada" id="dataRetirada" value="<?php echo ($imagem->data_retirada != '')? data($imagem->data_retirada) : "" ?>"></td>
  </tr>
  <tr>
    <td>URL da página</td>
    <td><label for="pagina"></label>
      <input type="text" name="pagina" id="pagina" value="<?php echo $imagem->pagina?>"></td>
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
            		<option value="<?php echo $slider->id ?>" <?php if($imagem->slider_id == $slider->id) echo 'selected' ?>><?php echo $slider->nome ?></option>
            <?php } ?>
        </select>
    </td>
  </tr>
  <tr>
    <td>Nova aba</td>
    <td><input type="checkbox" name="nova" id="nova" value="1"<?php echo ($imagem->nova == '1')? 'checked': ''?>></td>
  </tr>
  <tr>
    <td><input class="button-primary" type="submit" name="button" id="button" value="Atualizar"></td>
  </tr>
</table>
<br/>
<a href="admin.php?page=banner-rotativo">Voltar</a>
</form>
<script type="text/javascript" src="<?php echo $pluginurl ?>js/banner-rotativo.js"></script>
<script src="<?php echo $pluginurl ?>js/mask.min.js" type="text/javascript"></script>
<script type="text/javascript">
    (function($){
        $(document).ready(function(){
            $('#dataRetirada').mask('99/99/9999');
            $('#jbr_upload_image_button').click(function() {
                var formfield = $('#link').attr('name');
                tb_show('Carregar Imagem', 'media-upload.php?referer=media_page&post_id=0&type=image&amp;TB_iframe=true', false);
                return false;
            });

            window.send_to_editor = function(html) {
                var imgurl = $('img', html).attr('src');
                $('#link').val(imgurl);
                tb_remove();
                $('#submit_button').trigger('click');
            }
        });
    })(jQuery.noConflict());
</script>