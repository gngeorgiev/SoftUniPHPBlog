
<form method="POST" action="/admin/editAlbum/<?= $this->viewBag['editAlbum'][0]['id']?>">
 <h1>Edit Album:<?= $this->viewBag['editAlbum'][0]['name']?></h1>
 <label for="albumName">New Name:</label>
 <input type="text" name="albumName" id="albumName" value="<?= $this->viewBag['editAlbum'][0]['name']?>" />
 <label for="likes">Likes:</label>
 <input type="number" name="likes" id="likes" value="<?= $this->viewBag['editAlbum'][0]['likes']?>" />
 <label for="dislikes">Dislikes:</label>
 <input type="number" name="dislikes" id="dislikes" value="<?= $this->viewBag['editAlbum'][0]['dislikes']?>"/>
 <input type="submit" value="Edit Album"/>
</form>