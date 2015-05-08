<script src="/content/js/getEditedPostTags.js"></script>
<div class="blog-post">
<form action="/posts/edit/<?=$this->post['id']?>" method="POST">
<input type="hidden" name="requestToken" value="<?=$_SESSION['requestToken']?>">
	<input type="hidden" id="postId" value="<?=$this->post['id']?>">    
    <input type="hidden" id="page" value="<?=$this->page?>">
	<input placeholder="Title" class="form-control" type="text" name="title" value="<?=htmlspecialchars($this->post['title'])?>"><br/>
	<textarea placeholder="Content" class="form-control" rows="20"  name="content"><?=htmlspecialchars($this->post['content'])?></textarea><br/>
	<input class="btn btn-lg btn-warning" type="submit" value="Edit">
	<div id="postTagsEdit"></div>
	<div id="postTagsAdd"></div>
</form>
</div>
