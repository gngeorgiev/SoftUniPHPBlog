
<form method="POST" action="/admin/editCategory/<?= $this->viewBag['editCategory'][0]['id']?>">
 <h1>Edit Category:<?= $this->viewBag['editCategory'][0]['name']?></h1>
 <label for="categoryName">New Name:</label>
 <input type="text" name="categoryName" id="categoryName" value="<?= $this->viewBag['editCategory'][0]['name']?>" />
 <input type="submit" value="Edit Category"/>
</form>