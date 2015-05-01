<form method="POST" action="/albums/create">
	<h1 class="photos-header">Craete Album</h1>
	<label for="categoryId">Category:</label>
	<select name="category" id="categoryId">
	    <?php foreach ($this->viewBag['categories'] as $category) : ?>
	    	<option value="<?= $category['id'] ?>"> <?= $category['name']?></option>
	    <?php endforeach ?>
	</select>
	<label for="name">Album Name:</label>
	<input type="text" name="name" id="name"/>
	<input type="submit" value="Add Album" />
</form>