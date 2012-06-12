<div class="productSizes index">
	<h2><?php echo __('Tallas'); //debug($productSizes); ?></h2>
	<table id="sortable" cellpadding="0" cellspacing="0" controller="product_sizes">
		<tr class="ui-state-disabled">
			<!--<th><?php echo $this -> Paginator -> sort('id'); ?></th>-->
			<th><?php echo $this -> Paginator -> sort('order', 'Posición'); ?></th>
			<th><?php echo $this -> Paginator -> sort('name', 'Talla'); ?></th>
			<th><?php echo $this -> Paginator -> sort('created', 'Creada'); ?></th>
			<th><?php echo $this -> Paginator -> sort('updated', 'Modificada'); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
		</tr>
		<?php
			foreach ($productSizes as $productSize):
		?>
		<tr id="<?php echo $productSize['ProductSize']['id']?>" class="ui-state-default">
			<!--<td><?php echo h($productSize['ProductSize']['id']); ?>&nbsp;</td>-->
			<td class="position"><?php echo h($productSize['ProductSize']['order']); ?>&nbsp;</td>
			<td><?php echo h($productSize['ProductSize']['name']); ?>&nbsp;</td>
			<td><?php echo h($productSize['ProductSize']['created']); ?>&nbsp;</td>
			<td><?php echo h($productSize['ProductSize']['updated']); ?>&nbsp;</td> 
			<td class="actions">
				<?php //echo $this -> Html -> link(__('View'), array('action' => 'view', $productSize['ProductSize']['id'])); ?>
				<?php echo $this -> Html -> link(__('Modificar'), array('action' => 'edit', $productSize['ProductSize']['id'])); ?>
				<?php //echo $this -> Form -> postLink(__('Delete'), array('action' => 'delete', $productSize['ProductSize']['id']), null, __('Are you sure you want to delete # %s?', $productSize['ProductSize']['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página %page% de %pages%, mostrando %current% registros de un total de %count%, desde el %start%, hasta el %end%')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->first('<< ', array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->prev('< ' . __('anterior '), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__(' siguiente') . ' >', array(), null, array('class' => 'next disabled'));
		echo $this->Paginator->last(' >>', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li>
			<?php echo $this -> Html -> link(__('Agregar Talla'), array('action' => 'add')); ?>
		</li>
	</ul>
</div>
<?php echo $this -> Html -> script('jquery-ui.custom.min'); ?>
<script type="text/javascript">
	$(function() {// Order and reorder
		var sendData = function(order, controller) {
			var data = {};
			for( i = 0; i < order.length; i += 1) {
				data["data[ProductSize][" + order[i] + "]"] = (i + 1);
			}
			$.post("/" + controller + "/reOrder", data, function(response) {
				if(response == "yes") {
					for( i = 0; i < order.length; i += 1) {
						$("tr#" + order[i]).children(".position").text(i + 1);
					}
				}
			});
		}
		$("#sortable tbody").sortable({
			revert : true,
			items : "tr:not(.ui-state-disabled)",
			update : function(event, ui) {
				sendData($(this).sortable("toArray"), $("table").attr("controller"));
			}
		});

		$("#sortable tbody > tr").disableSelection();
	}); 
</script>