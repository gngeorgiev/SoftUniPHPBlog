<div class="blog-post">
<form action="/posts/create" method="POST">
<input type="hidden" name="requestToken" value="<?=$_SESSION['requestToken']?>">
	<input class="form-control" type="text" placeholder="Title" name="title" value="<?=htmlspecialchars($this->postTitle)?>"><br/>
	<textarea placeholder="Content" class="form-control" rows="20" name="content"><?=htmlspecialchars($this->postContent)?></textarea><br/>
	<input class="btn btn-lg btn-primary" type="submit" value="Post">
</form>
</div>