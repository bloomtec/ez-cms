<div class="products form">
	<?php echo $this -> Form -> create('Product');
	//debug($this -> data);
	?>
	<fieldset>
		<legend>
			<?php echo __('Modificar Producto'); ?>
		</legend>
		<div class="datos">
			<?php
			echo $this -> Form -> input('id');
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
			//echo $this -> Form -> hidden('image', array('label' => 'Imagen', 'id' => 'single-field', 'value' => $this -> data['Product']['image']));
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
					<?php foreach($size_ids_color_ids as $size_id => $colors) : ?>
						<tr>
							<td><?php echo $sizes[$size_id]; ?></td>
							<?php foreach($colors as $color_id => $hasInventory) : ?>
								<td>
									<?php
										if($hasInventory) {
											echo $this -> Form -> input("Matrix.$size_id-$color_id", array('label' => false, 'div' => false, 'type' => 'checkbox', 'disabled' => 'disabled', 'checked' => 'checked'));
										} else {
											echo $this -> Form -> input("Matrix.$size_id-$color_id", array('label' => false, 'div' => false, 'type' => 'checkbox'));
										}
									?>
								</td>
							<?php endforeach; ?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="inventario">
			<table id="TablaInventarios" style="max-width:400px;">
				<tbody>
					<tr>
						<th>
							Color
						</th>
						<th>
							Talla
						</th>
						<th>
							Cantidad
						</th>
						<th>Modificar</th>
						<th></th>
					</tr>
					<?php foreach($inventories as $key => $inventory) : ?>
						<?php
							$index = $inventory['Inventory']['id'];
							echo $this -> Form -> hidden("Inventory.$index.id", array('value' => $index));
						?>
					<tr>
						<td>
							<?php echo $inventory['Inventory']['color']; ?>
						</td>
						<td>
							<?php echo $inventory['Inventory']['size']; ?>
						</td>
						<td>
							<?php echo $inventory['Inventory']['quantity']; ?>
						</td>
						<td>
							<?php echo $this -> Form -> input("Inventory.$index.modify", array('label' => false, 'div' => false, 'type' => 'select', 'options' => array('add' => 'Agregar', 'substract' => 'Quitar'), 'empty' => 'Seleccione...','class'=>'operacion','rel'=>$inventory['Inventory']['color'])); ?>
						</td>
						<td>
							<?php echo $this -> Form -> input("Inventory.$index.amount_to_modify", array('label' => false, 'div' => false, 'type' => 'number', 'min' => 0, 'value' => 0, 'style' => 'text-align:center;','class'=>'cantidad','rel'=>$inventory['Inventory']['id'])); ?>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<st	
		</div>
		<style>
			table#TablaInventarios * {text-align:center;}
		</style>
	</fieldset>
	<?php echo $this -> Form -> end(__('Modificar')); ?>
</div>