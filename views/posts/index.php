<script src="/content/js/getPostsTags.js"></script>

<?php foreach ($this->posts as $post) : ?>
	<div class="post blog-post">
        <input type="hidden" class="postId" value="<?=$post['id']?>">
        <a href="/posts/view/<?=$post['id']?>"><h3 class="blog-post-title"><?= htmlspecialchars($post['title']) ?></h3></a>
        <p class="blog-post-meta"><?= htmlspecialchars($post['date_created']) ?> by <b><?= htmlspecialchars($post['username']) ?></b></p>
        <div>
        	<?= nl2br(htmlspecialchars($post['preview'])) . "..." ?>
            <a href="/posts/view/<?=$post['id']?>">Continue reading</a>
        </div>
        <div id="tags_<?=$post['id']?>"></div>
        Visits: <?= htmlspecialchars($post['visits_count']) ?><br/>
        <?php if($this->isAdmin()) :?>
            <a class="btn btn-sm btn-warning" href="/posts/edit/<?=$post['id']?>">Edit Post</a>
            <form class="delete-form" action="/posts/delete" method="POST">
                <input type="hidden" name="requestToken" value="<?=$_SESSION['requestToken']?>">
                <input type="hidden" name="id" value="<?=$post['id']?>">
                <a class="delete btn btn-sm btn-danger">Delete Post</a>
            </form>
        <?php endif;?>
    </div>
<?php endforeach ?>

<?php include_once("views/layouts/pagination.php");?>

