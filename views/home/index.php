<div id="control-panel">
	<ul>
		<li><a href="/categories/create">Create Category</a></li>
	</ul>
</div>


<div id="categories" class="photo-holder">
	<h1 class="photos-header">Categories</h1>
	<ul>
	    <?php foreach ($this->viewBag['categories'] as $category) : ?>
	    	<li><a href="/albums/category/<?=$category['id'] ?>">
	    		<h1><?= $category['name'] ?></h1>
	    		<img src="/content/images/photo-category.png"/>
	    	</a>
	    	</li>
	    <?php endforeach ?>
	</ul>
</div>

