<?php if (!empty($user_activity)): ?>
<div class="altitude-user-activity">
	<?php foreach ($user_activity as $message): ?>
	<article class="altitude-user-activity-item">
		<a href="<?php echo url('forum/topic/'.$message['topic_id'].'/'.url_title($message['title'])) ?>"><?php echo $message['title'] ?></a>
		<time><?php echo icon('far fa-clock').' '.timetostr('j M Y', $message['date']) ?></time>
		<div><?php echo bbcode($message['message']) ?></div>
	</article>
	<?php endforeach ?>
</div>
<?php else: ?>
<div class="altitude-user-empty"><?php echo icon('far fa-clock') ?><span><?php echo $this->lang('No recent activity.') ?></span></div>
<?php endif ?>
