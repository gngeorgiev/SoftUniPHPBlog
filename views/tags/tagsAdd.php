All tags: <br/>
<?php foreach ($this->tags as $tag) : ?>
	<div class="col-md-4"><a href="/posts/getByTag/<?=$tag['id']?>"><?=htmlspecialchars($tag['tag'])?></a> </div>
	<div class="col-md-8">
		<a class="btn btn-sm btn-success" href="/posts/addTag/<?=htmlspecialchars($this->postId)?>/<?=$tag['id']?>">Add to post</a>
	</div>	
	 <br/><br/>
<?php endforeach; ?>
<?php include_once("views/layouts/pagination.php");?>