<form action="/tags/edit/<?=$this->tag['id']?>" method="POST">
	Edit tag:
	<input type="hidden" name="requestToken" value="<?=$_SESSION['requestToken']?>">
	<input class="form-control" placeholder="Tag" type="text" name="tag" value="<?=htmlspecialchars($this->tag['tag'])?>"><br/>
	<input class="btn btn-lg btn-warning" type="submit" value="Edit">
</form>