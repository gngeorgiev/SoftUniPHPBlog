
<table>
	<tr>
		<th>Comments Id</th>
		<th>Comments Text</th>
		<th>Comments Username</th>
		<th>Photo name</th>
		<th>Album name</th>
		<th>Category name</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>

	<?php foreach ($this->viewBag['comments'] as $comment) : ?>
	<tr>
		<td><?= $comment['id']?></td>
		<td><?= $comment['text'] ?></td>
		<td><?= $comment['username']?></td>
		<td><?= $comment['photoName']?></td>
		<td><?= $comment['albumName']?></td>
		<td><?= $comment['categoryName']?></td>
		<td><a href="/admin/editComment/<?= $comment['id']?>">[Edit]</a></td>
		<td><a href="/admin/deleteComment/<?= $comment['id']?>">[Delete]</a></td>
	</tr>
	<?php endforeach ?>
</table>