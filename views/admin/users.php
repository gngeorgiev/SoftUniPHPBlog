
<table>
	<tr>
		<th>User id</th>
		<th>Username</th>
		<th>Is Admin</th>
		<th>Edit</th>
		<th>Delete</th>
		<th>Make Admin</th>
		<th>Remove Admin</th>
	</tr>

	<?php foreach ($this->viewBag['users'] as $user) : ?>
	<tr>
		<td><?= $user['id']?></td>
		<td><?= $user['username'] ?></td>
		<td>
        <?php 
        	if($user['is_admin'] == '1') {
        		echo 'yes';
        	} else {
        		echo 'no';
        	}
        ?>
		</td>
		<td><a href="/admin/editUser/<?= $user['id']?>">[Edit]</a></td>
		<td><a href="/admin/deleteUser/<?= $user['id']?>">[Delete]</a></td>
		<td><a href="/admin/makeAdmin/<?= $user['id']?>">[Make Admin]</a></td>
		<td><a href="/admin/removeAdmin/<?= $user['id']?>">[Remove Admin]</a></td>
	</tr>
	<?php endforeach ?>
</table>