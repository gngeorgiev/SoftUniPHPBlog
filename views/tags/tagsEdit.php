Tags on post: 
<?php foreach ($this->tags as $tag) : ?>
	<a href="/posts/getByTag/<?=$tag['id']?>"><?=htmlspecialchars($tag['tag'])?></a>
	<a class="btn btn-sm btn-danger" href="/posts/removeTag/<?=htmlspecialchars($this->postId)?>/<?=$tag['id']?>">X</a>
<?php endforeach; ?>