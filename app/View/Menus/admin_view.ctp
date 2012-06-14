<div class="menus view">
	<h2><?php  echo __('Menú'); ?></h2>
	<dl>
		<dt>
			<?php echo __('Nombre'); ?>
		</dt>
		<dd>
			<?php echo h($menu['Menu']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<!--<li><?php echo $this->Html->link(__('Edit Menu'), array('action' => 'edit', $menu['Menu']['id'])); ?> </li>-->
		<!--<li><?php echo $this->Form->postLink(__('Delete Menu'), array('action' => 'delete', $menu['Menu']['id']), null, __('Are you sure you want to delete # %s?', $menu['Menu']['id'])); ?> </li>-->
		<li>
			<?php echo $this -> Html -> link(__('Ver Menús'), array('action' => 'index')); ?>
		</li>
		<!--<li><?php echo $this->Html->link(__('New Menu'), array('action' => 'add')); ?> </li>-->
		<li>
			<?php echo $this -> Html -> link(__('Ver Ítems De Menú'), array('controller' => 'menu_items', 'action' => 'index')); ?>
		</li>
		<li>
			<?php echo $this -> Html -> link(__('Crear Ítem De Menú'), array('controller' => 'menu_items', 'action' => 'add')); ?>
		</li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Ítems De Menú Relacionados'); ?></h3>
	<?php if (!empty($menu['MenuItem'])): ?>
	<table id="sortable" cellpadding="0" cellspacing="0" controller="menu_items">
		<tbody>
			<tr class="ui-state-disabled">
				<th><?php echo __('Posición'); ?></th>
				<th><?php echo __('Nombre'); ?></th>
				<th><?php echo __('Enlace'); ?></th>
				<th><?php echo __('Creado'); ?></th>
				<th><?php echo __('Modificado'); ?></th>
				<th class="actions"><?php echo __('Acciones'); ?></th>
			</tr>
			<?php $i = 0; foreach ($menu['MenuItem'] as $menuItem):	?>
			<tr id="<?php echo $menuItem['id']?>" class="ui-state-default">
				<td class="position"><?php echo $menuItem['position']; ?></td>
				<td><?php echo $menuItem['name']; ?></td>
				<td>
					<?php
						if(is_numeric($menuItem['link'])) {
							echo 'Página ' . $pages[$menuItem['link']];
						} else {
							echo $menuItem['link'];
						}
					?>
				</td>
				<td><?php echo $menuItem['created']; ?></td>
				<td><?php echo $menuItem['updated']; ?></td>
				<td class="actions">
					<?php echo $this -> Html -> link(__('Ver'), array('controller' => 'menu_items', 'action' => 'view', $menuItem['id'])); ?>
					<?php
						if($menuItem['id'] >= 20) {
							echo $this -> Html -> link(__('Modificar'), array('controller' => 'menu_items', 'action' => 'edit', $menuItem['id']));
							echo $this -> Form -> postLink(__('Eliminar'), array('controller' => 'menu_items', 'action' => 'delete', $menuItem['id']), null, __('¿Seguro desea eliminar %s?', $menuItem['name']));
						}						
					?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php endif; ?>

	<div class="actions">
		<ul>
			<li>
				<?php echo $this -> Html -> link(__('Crear Ítem De Menú'), array('controller' => 'menu_items', 'action' => 'add')); ?>
			</li>
		</ul>
	</div>
</div>
<?php echo $this -> Html -> script('jquery-ui.custom.min'); ?>
<script type="text/javascript">
	$(function() {// Order and reorder
		var sendData = function(order, controller) {
			var data = {};
			for( i = 0; i < order.length; i += 1) {
				data["data[MenuItem][" + order[i] + "]"] = (i + 1);
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