Tags: 
<?php foreach ($this->tags as $tag) : ?>
	<a href="/posts/getByTag/<?=$tag['id']?>"><?=htmlspecialchars($tag['tag'])?></a>
<?php endforeach; ?>
