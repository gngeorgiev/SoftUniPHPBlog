
<ul>
    <?php foreach ($this->viewBag['categoryAlbums'] as $albums) : ?>
    	<li><a href="/photos/album/<?=$albums['id'] ?>">
    		<h1><?= $albums['name'] ?></h1>
    		<img src="/content/images/albums-photo.jpg"/>
    	</a>
    		<div>Likes : <?=  $albums['likes'] ?> Dislike: <?= $albums['dislikes'] ?></div>
    	</li>
    <?php endforeach ?>
</ul>