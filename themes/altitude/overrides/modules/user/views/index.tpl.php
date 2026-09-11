<?php if ($unreads = $this->model('messages')->get_messages_unreads()): ?>
<a href="<?php echo url('user/messages') ?>" class="altitude-user-notice is-active">
	<?php echo icon('fas fa-envelope-open-text') ?>
	<span><?php echo $unreads > 1 ? $unreads.' messages non lus' : '1 message non lu' ?></span>
</a>
<?php else: ?>
<div class="altitude-user-empty"><?php echo icon('far fa-check-circle') ?><span><?php echo $this->lang('Vous êtes à jour, aucun nouveau message.') ?></span></div>
<?php endif ?>
