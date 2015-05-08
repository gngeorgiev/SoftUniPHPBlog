<form action="/tags/create" method="POST">
	Create tag:
	<input type="hidden" name="requestToken" value="<?=$_SESSION['requestToken']?>">
	<input placeholder="Tag" class="form-control" type="text" name="tag" value="<?=htmlspecialchars($this->tag)?>"><br/>
	<input class="btn btn-lg btn-primary" type="submit" value="Create">
</form>