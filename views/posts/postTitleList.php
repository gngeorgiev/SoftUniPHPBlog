<?php foreach ($this->posts as $post) : ?>
    <a href="/posts/view/<?=$post['id']?>"><?= htmlspecialchars($post['title']) ?></a><br/>
<?php endforeach ?>
