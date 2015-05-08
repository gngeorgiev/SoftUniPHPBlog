<div>
	<?php
		$search = "";
		if(!is_null($this->searchTerm)) {
			$search = "&searchTerm=" . $this->searchTerm;
		}
	?>

	<ul class="pagination">
		<?php if($this->page>1):?>
			<li><a href="<?=htmlspecialchars($this->requestUrl)?>?page=1<?=$search?>">&lt;&lt;</a></li>
			<li><a href="<?=htmlspecialchars($this->requestUrl)?>?page=<?=$this->page-1?><?=$search?>">&lt;</a></li>
		<?php else : ?>
			<li class="disabled"><a>&lt;&lt;</a></li>
			<li class="disabled"><a>&lt;</a></li>
		<?php endif;?>

		<?php for($i = 1; $i <= $this->pagesCount; $i++): ?>
			
			<?php if($this->page==$i):?>
				<li class="active">
			<?php else : ?>
				<li>
			<?php endif;?>
				<a href="<?=htmlspecialchars($this->requestUrl)?>?page=<?=$i?><?=$search?>">
						<?=$i?>
					</a>
			</li>
		<?php endfor;?>

		<?php if($this->page==$this->pagesCount):?>
			<li class="disabled"><a>&gt;&gt;</a></li>
			<li class="disabled"><a>&gt;</a></li>
		<?php else : ?>
			<li><a href="<?=htmlspecialchars($this->requestUrl)?>?page=<?=$this->page+1?><?=$search?>">&gt;</a></li>
			<li><a href="<?=htmlspecialchars($this->requestUrl)?>?page=<?=$this->pagesCount?><?=$search?>">&gt;&gt;</a></li>
		<?php endif;?>		
	</ul>
</div>