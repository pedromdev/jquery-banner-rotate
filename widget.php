<?php

class JBRWidget extends WP_Widget
{
	function __construct() {
		parent::WP_Widget(false, 'jQuery Banner Rotate', array('description' => 'Banners rotativos'));
	}

	function widget($args, $instance)
	{
		$id = ($instance['jbr_slider'] > 0)? ' id="' . $instance['jbr_slider'] . '"' : '';
		$width = (isset($instance['jbr_width']) && trim($instance['jbr_width']) != '' &&
			(intval($instance['jbr_width']) == floatval($instance['jbr_width'])))?
			' width="' . $instance['jbr_width'] . '"' : '';
		$height = (isset($instance['jbr_height']) && trim($instance['jbr_height']) != '' &&
			(intval($instance['jbr_height']) == floatval($instance['jbr_height'])))?
			' height="' . $instance['jbr_height'] . '"' : '';

		echo $args['before_widget'];
		echo do_shortcode("[banner-rotativo{$id}{$width}{$height}]");
		echo $args['after_widget'];
	}

	function form($instance)
	{
		$s = $instance['jbr_slider'];
		$width = $instance['jbr_width'];
		$height = $instance['jbr_height'];
		$sliders = BRDBSLIDER::listar_todos();
		?>
		<p>
			<label for="<?= $this->get_field_id('jbr_slider'); ?>">
				<b><?= __('Slider') ?></b>
				<select id="<?= $this->get_field_id('jbr_slider'); ?>" name="<?= $this->get_field_name('jbr_slider'); ?>">
					<option value="0">Selecionar...</option>
					<?php if ($sliders) : foreach ($sliders as $slider) : ?>
						<option value="<?= $slider->id ?>" <?= ($s == $slider->id)? 'selected' : ''?>>
							<?= $slider->nome ?>
						</option>
					<?php endforeach; endif; ?>
				</select>
			</label>
		</p>
		<p>
			<label for="<?= $this->get_field_id('jbr_width'); ?>">
				<b><?= __('Width') ?></b><br>
				<input type="text" id="<?= $this->get_field_id('jbr_width'); ?>"
					name="<?= $this->get_field_name('jbr_width'); ?>" value="<?= $width ?>">
			</label>
		</p>
		<p>
			<label for="<?= $this->get_field_id('jbr_height'); ?>">
				<b><?= __('Height') ?></b><br>
				<input type="text" id="<?= $this->get_field_id('jbr_height'); ?>"
					name="<?= $this->get_field_name('jbr_height'); ?>" value="<?= $height ?>">
			</label>
		</p>
	<?php }

	function update($new_instance, $old_instance)
	{
		return array_merge($old_instance, $new_instance);
	}
}

add_action('widgets_init', create_function('', 'return register_widget("JBRWidget");'));