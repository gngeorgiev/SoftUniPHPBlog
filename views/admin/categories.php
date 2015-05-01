
<table>
	<tr>
		<th>Category Id</th>
		<th>Category Name</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>

	<?php foreach ($this->viewBag['categories'] as $category) : ?>
	<tr>
		<td><?= $category['id']?></td>
		<td><?= $category['name'] ?></td>
		<td><a href="/admin/editCategory/<?= $category['id']?>">[Edit]</a></td>
		<td><a href="/admin/deleteCategory/<?= $category['id']?>">[Delete]</a></td>
	</tr>
	<?php endforeach ?>
</table>