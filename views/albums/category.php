
<ul id="albums">
    <?php foreach ($this->viewBag['categoryAlbums'] as $albums) : ?>
    	<li><a href="/photos/album/<?=$albums['id'] ?>">
    		<h1><?= $albums['name'] ?></h1>
    		<img src="/content/images/albums-photo.jpg"/>
    	</a>
    		<div><a href="/albums/like/<?= $albums['id']?>/<?= $this->viewBag['lastCategoryId'] ?>">Likes</a> : <?=  $albums['likes'] ?> 
    			 <a href="/albums/dislike/<?= $albums['id']?>/<?= $this->viewBag['lastCategoryId'] ?>">Dislike</a>  : <?= $albums['dislikes'] ?></div>
    	</li>
    <?php endforeach ?>
</ul>