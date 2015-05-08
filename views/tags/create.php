<form action="/tags/create" method="POST">
	Create tag:
	<input type="hidden" name="requestToken" value="<?=$_SESSION['requestToken']?>">
	<input placeholder="Tag" class="form-control" type="text" name="tag" value="<?=htmlspecialchars($this->tag)?>"><br/>
	<button class="waves-effect waves-light btn" type="submit">
		<i class="mdi-content-send"></i>
	</button>
</form>