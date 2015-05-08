<script src="/content/js/attachDeleteHandler.js"></script>
<?php foreach ($this->comments as $comment) : ?>
	<div class="comment">
		<span><?= htmlspecialchars($comment['content']) ?></span> <br/>
        <p class="blog-post-meta">
        <b><?= htmlspecialchars($comment['username']) ?>
		<?php if($comment["type"] == 0) :?>
        	(guest)
    	<?php endif;?>
        </b>
        <?= htmlspecialchars($comment['date_created']) ?>
        </p>
        <?php if($this->isAdmin()):?>
        	<?php if($comment["type"] == 1) :?>
	            <a class="btn btn-sm btn-warning" href="/comments/editUserComment/<?=$comment['id']?>">Edit Comment</a>
                <form class="delete-form" action="/comments/deleteUserComment" method="POST">
                    <input type="hidden" name="requestToken" value="<?=$_SESSION['requestToken']?>">
                    <input type="hidden" name="id" value="<?=$comment['id']?>">
                    <input type="hidden" name="returnUrl" value="<?=$this->returnUrl?>">
                    <a class="delete btn-sm btn btn-sm btn-danger">Delete Comment</a>
                </form>
        	<?php endif;?>
        	<?php if($comment["type"] == 0) :?>
	            <a class="btn btn-sm btn-warning" href="/comments/editGuestComment/<?=$comment['id']?>">Edit Comment</a>
                <form class="delete-form" action="/comments/deleteGuestComment" method="POST">
                    <input type="hidden" name="requestToken" value="<?=$_SESSION['requestToken']?>">
                    <input type="hidden" name="id" value="<?=$comment['id']?>">                    
                    <input type="hidden" name="returnUrl" value="<?=$this->returnUrl?>">
                    <a class="delete btn-sm btn btn-sm btn-danger">Delete Comment</a>
                </form>
        	<?php endif;?>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<?php include_once("views/layouts/pagination.php");