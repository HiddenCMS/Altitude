<div class="altitude-user-stats">
	<div class="altitude-user-stat">
		<span class="altitude-user-stat-icon"><?php echo icon('far fa-calendar-alt') ?></span>
		<div><small><?php echo $this->lang('Member since') ?></small><strong><?php echo $user->registration_date ?></strong></div>
	</div>
	<div class="altitude-user-stat">
		<span class="altitude-user-stat-icon"><?php echo icon('fas fa-signal') ?></span>
		<div><small><?php echo $this->lang('Last activity') ?></small><strong><?php echo $user->last_activity_date ?></strong></div>
	</div>
	<div class="altitude-user-stat">
		<span class="altitude-user-stat-icon"><?php echo icon('fas fa-users') ?></span>
		<div><small><?php echo $this->lang('Groups') ?></small><strong><?php echo $user->groups() ?></strong></div>
	</div>
</div>
