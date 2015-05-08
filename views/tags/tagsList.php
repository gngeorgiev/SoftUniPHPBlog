<div>
	<?php foreach ($this->tags as $tag) : ?>
	    <a href="/posts/getbytag/<?=$tag['id']?>"><?= htmlspecialchars($tag['tag'] . " (" . $tag['count'] . ")") ?></a><br/>
	<?php endforeach ?>
</div>