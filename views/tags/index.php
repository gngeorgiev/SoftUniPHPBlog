<div class="row">
All tags:<br/><br/>
	<?php foreach ($this->tags as $tag) : ?>
		<div class="col-md-4"><?= htmlspecialchars($tag['tag']) ?> </div>
		<div class="col-md-8">
			<a class="btn btn-sm btn-warning" href="/tags/edit/<?=$tag['id']?>">Edit</a>
			<form class="delete-form" action="/tags/delete" method="POST">
				<input type="hidden" name="requestToken" value="<?=$_SESSION['requestToken']?>">
				<input type="hidden" name="id" value="<?=$tag['id']?>">
				<a class="delete btn btn-sm btn-danger">Delete</a>
			</form>
		</div>
		<br/><br/>
	<?php endforeach ?>
</div>
<?php include_once("views/layouts/pagination.php");?>