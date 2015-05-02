<div id="control-panel">
	<ul>
		<li><a href="/photos/add">Add Photo</a></li>
	</ul>
</div>


<div id="photo" class="photo-holder">
	<h1 class="photos-header">Photo</h1>
	<ul>
	    <?php foreach ($this->viewBag['photo'] as $photo) : ?>
	    	<li><a>
	    		<h1><?= $photo['name'] ?></h1>
	    		<h2>From Category: <?= $photo['categoryName'] ?></h2>
	    		<h2>From Album: <?= $photo['albumName'] ?></h2>
	    		<img src="/<?= $photo['path']?>"/>
	    		<div class="comments-holder">
	    			<?php foreach ($this->viewBag['photoComments'] as $comment) : ?>
	    				<div class="comment">
	    					<div class="comment-username"><?= $comment['username'] ?></div>
	    					<div class="comment-text"><?= $comment['text'] ?></div>
	    				</div>
	    			<?php endforeach ?>
	    		</div>
	    		<form method="POST" action="/comments/add/<?= $photo['id'] ?>">
    				<input type="text" name="comment-text"/>
    				<input type="submit" value="Add comment" />
	    		</form>
	    	</a>
	    	</li>
	    <?php endforeach ?>
	</ul>
</div>


<script type="text/javascript">
	var lastComment = document.querySelector('.comments-holder > .comment:last-child');
	lastComment.scrollIntoView();
</script>