
<table>
	<tr>
		<th>Album id</th>
		<th>Album Name</th>
		<th>Album Likes</th>
		<th>Album Dislikes</th>
		<th>Category name</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>

	<?php foreach ($this->viewBag['albums'] as $album) : ?>
	<tr>
		<td><?= $album['id']?></td>
		<td><?= $album['name'] ?></td>
		<td><?= $album['likes']?></td>
		<td><?= $album['dislikes']?></td>
		<td><?= $album['categoryName']?></td>
		<td><a href="/admin/editAlbum/<?= $album['id']?>">[Edit]</a></td>
		<td><a href="/admin/deleteAlbum/<?= $album['id']?>">[Delete]</a></td>
	</tr>
	<?php endforeach ?>
</table>