<form method="POST" action="/photos/add" enctype="multipart/form-data">
	<h1 class="photos-header">Add Photo</h1>
	<label for="albumId">Album:</label>
	<select name="album" id="albumId">
	    <?php foreach ($this->viewBag['albums'] as $album) : ?>
	    	<option value="<?= $album['id'] ?>"> <?= $album['name']?></option>
	    <?php endforeach ?>
	</select>
	<label for="name">Photo Name:</label>
	<input type="text" name="name" id="name"/>
	<label for="fileToUpload">Choose Photo:</label>
	<input type="file" name="fileToUpload" id="fileToUpload"/>
	<input type="submit" value="Add Photo" />
</form>