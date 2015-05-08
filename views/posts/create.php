<div class="blog-post">
<form action="/posts/create" method="POST">
<input type="hidden" name="requestToken" value="<?=$_SESSION['requestToken']?>">
	<input class="form-control" type="text" placeholder="Title" name="title" value="<?=htmlspecialchars($this->postTitle)?>"><br/>
	<textarea placeholder="Content" class="form-control" rows="20" name="content"><?=htmlspecialchars($this->postContent)?></textarea><br/>
	<button class="waves-effect waves-light btn" type="submit">
		<i class="mdi-content-send"></i>
	</button>
</form>
</div>