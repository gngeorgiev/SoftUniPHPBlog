<div id="control-panel">
	<ul>
		<li><a href="/albums/create">Create Album</a></li>
	</ul>
</div>


<div id="albums" class="photo-holder">
	<h1 class="photos-header">Albums</h1>
	<ul>
	    <?php foreach ($this->viewBag['albums'] as $albums) : ?>
	    	<li><a href="/photos/album/<?=$albums['id'] ?>">
	    		<h1><?= $albums['name'] ?></h1>
	    		<h2>From Category: <?= $albums['categoryName'] ?></h2>
	    		<img src="/content/images/albums-photo.jpg"/>
	    	</a>
	    		<div><a href="/albums/like/<?= $albums['id']?>">Likes : <?=  $albums['likes'] ?></a> 
	    			 <a href="/albums/dislike/<?= $albums['id']?> ">Dislike : <?= $albums['dislikes'] ?></a> </div>
	    	</li>
	    <?php endforeach ?>
	</ul>
</div>