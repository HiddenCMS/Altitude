<div class="altitude-user-stats">
	<div class="altitude-user-stat">
		<span class="altitude-user-stat-icon"><?php echo icon('far fa-calendar-alt') ?></span>
		<div><small><?php echo $this->lang('Membre depuis') ?></small><strong><?php echo $user->registration_date ?></strong></div>
	</div>
	<div class="altitude-user-stat">
		<span class="altitude-user-stat-icon"><?php echo icon('fas fa-signal') ?></span>
		<div><small><?php echo $this->lang('Dernière activité') ?></small><strong><?php echo $user->last_activity_date ?></strong></div>
	</div>
	<div class="altitude-user-stat">
		<span class="altitude-user-stat-icon"><?php echo icon('fas fa-users') ?></span>
		<div><small><?php echo $this->lang('Groupes') ?></small><strong><?php echo $user->groups() ?></strong></div>
	</div>
</div>
