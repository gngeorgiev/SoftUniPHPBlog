<form method="POST" action="/photos/add">
	<h1 class="photos-header">Add Photo</h1>
	<label for="albumId">Album:</label>
	<select name="album" id="albumId">
	    <?php foreach ($this->viewBag['categories'] as $category) : ?>
	    	<option value="<?= $category['id'] ?>"> <?= $category['name']?></option>
	    <?php endforeach ?>
	</select>
	<label for="name">Album Name:</label>
	<input type="text" name="name" id="name"/>
	<input type="submit" value="Add Album" />
</form>