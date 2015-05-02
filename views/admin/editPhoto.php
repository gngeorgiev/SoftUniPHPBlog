
<form method="POST" action="/admin/editPhoto/<?= $this->viewBag['editPhoto'][0]['id']?>">
 <h1>Edit Photo:<?= $this->viewBag['editPhoto'][0]['name']?></h1>
 <label for="photoName">New Name:</label>
 <input type="text" name="photoName" id="photoName" value="<?= $this->viewBag['editPhoto'][0]['name']?>" />
 <input type="submit" value="Edit Photo"/>
</form>