<div id="control-panel">
	<ul>
		
	</ul>
</div>

<div id="categories"> 
	<ul >
	    <?php foreach ($this->viewBag['categories'] as $category) : ?>
	    	<li><a href="/albums/category/<?=$category['id'] ?>"><?= $category['name']?></a></li>
	    <?php endforeach ?>
	</ul>
</div>
