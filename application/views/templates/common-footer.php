
	<? if (isset($this->page->h1)) { ?>
		<?= $this->page->h1 ?>
	<? } ?>

	<? if (isset($this->page->content)) { ?>
		<?= $this->page->content ?>
	<? } ?>

	<? if (isset($this->site->google_analytics)) { ?>
		<?= $this->site->google_analytics ?>
	<? } ?>

	</body>
</html>