<div class="products form">
	<?php echo $this -> Form -> create('Product'); ?>
	<fieldset>
		<legend>
			<?php echo __('Crear Producto'); ?>
		</legend>
		<div class="datos">
		<?php
		echo $this -> Form -> input('category_id', array('label' => 'Categoría', 'empty' => 'Selecione...'));
		echo $this -> Form -> input('name', array('label' => 'Nombre'));
		echo $this -> Form -> input('reference', array('label' => 'Referencia'));
		echo $this -> Form -> input('price', array('label' => 'Precio (I.V.A. Incluído)'));
		echo $this -> Form -> input('tax_base', array('label' => 'Base I.V.A. (X%)', 'value' => '16'));
		//echo $this -> Form -> input('tax_value', array('label' => 'Valor I.V.A.'));
		echo $this -> Form -> input('description', array('label' => 'Descripción'));
		//echo $this -> Form -> input('order', array('label' => ''));
		echo $this -> Form -> input('is_active', array('label' => 'Activo', 'checked' => 'checked'));
		echo $this -> Form -> input('is_promoted', array('label' => 'Promocionado'));
		echo $this -> Form -> input('is_novelty', array('label' => 'Novedad'));
		echo $this -> Form -> input('is_top_seller', array('label' => 'Más Vendido'));
		//echo $this -> Form -> hidden('image', array('label' => 'Imagen', 'id' => 'single-field'));
		?>
		</div>
		<div class="tallas">
			<table id="ColorsSizesMatrix">
				<caption>Inicializar Inventarios (se inicia su cantidad en 0 las combinaciones seleccionadas)</caption>
				<tbody>
					<tr>
						<td>Tallas/Colores</td>
						<?php foreach($colors as $color_id => $color_name) : ?>
						<td><?php echo $color_name; ?></td>
						<?php endforeach; ?>
					</tr>
					<?php foreach($sizes as $size_id => $size_name) : ?>
						<tr>
							<td><?php echo $size_name; ?></td>
							<?php foreach($colors as $color_id => $color_name) : ?>
								<td><?php echo $this -> Form -> input("Matrix.$size_id-$color_id", array('label' => false, 'div' => false, 'type' => 'checkbox')); ?></td>
							<?php endforeach; ?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</fieldset>
	<?php echo $this -> Form -> end(__('Crear')); ?>
</div>