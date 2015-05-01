
<table>
	<tr>
		<th>Photo id</th>
		<th>Photo Name</th>
		<th>Photo Path</th>
		<th>Album name</th>
		<th>Category name</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>

	<?php foreach ($this->viewBag['photos'] as $photo) : ?>
	<tr>
		<td><?= $photo['id']?></td>
		<td><?= $photo['name'] ?></td>
		<td><?= $photo['path']?></td>
		<td><?= $photo['albumName']?></td>
		<td><?= $photo['categoryName']?></td>
		<td><a href="/admin/editPhoto/<?= $photo['id']?>">[Edit]</a></td>
		<td><a href="/admin/deletePhoto/<?= $photo['id']?>">[Delete]</a></td>
	</tr>
	<?php endforeach ?>
</table>