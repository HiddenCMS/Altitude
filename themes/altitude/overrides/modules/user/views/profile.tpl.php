<div class="altitude-user-profile">
	<div class="altitude-user-avatar"><?php echo $user->avatar() ?></div>
	<div class="altitude-user-identity">
		<h2><?php echo $user->username ?></h2>
		<?php
			$profile = $user->profile();
			$name = $profile && $profile() ? trim(privacy_profile_value($profile, 'first_name').' '.privacy_profile_value($profile, 'last_name')) : '';
		?>
		<?php if ($name): ?><p class="altitude-user-name"><?php echo $name ?></p><?php endif ?>
	</div>

	<?php if ($profile && $profile()): ?>
	<div class="altitude-user-details">
		<?php if ($quote = $profile->quote): ?><blockquote><?php echo $quote ?></blockquote><?php endif ?>
		<?php
			$sex = privacy_profile_value($profile, 'sex');
			$date_of_birth = privacy_profile_value($profile, 'date_of_birth');
			$country = privacy_profile_value($profile, 'country');
			$location = privacy_profile_value($profile, 'location');
		?>
		<?php if ($date_of_birth): ?>
		<span class="altitude-user-detail"><?php echo icon('fas fa-birthday-cake').' '.$this->lang('%d year|%d years', $age = $date_of_birth->interval('today')->y, $age) ?></span>
		<?php endif ?>
		<?php if ($sex): ?>
		<span class="altitude-user-detail"><?php echo icon($sex == 'female' ? 'fas fa-venus' : ($sex == 'male' ? 'fas fa-mars' : 'fas fa-genderless')).' '.$this->lang($sex == 'female' ? 'Female' : ($sex == 'male' ? 'Male' : 'Not specified')) ?></span>
		<?php endif ?>
		<?php if ($location || $country): ?>
		<span class="altitude-user-detail"><?php echo icon('fas fa-map-marker-alt').' '.($this->no_translate($location) ?: (get_countries()[$country] ?? '')) ?></span>
		<?php endif ?>
	</div>

	<?php
		$socials = [
			['website', 'fas fa-globe', '', 'Site web'],
			['linkedin', 'fab fa-linkedin-in', 'https://www.linkedin.com/in/', 'LinkedIn'],
			['github', 'fab fa-github', 'https://github.com/', 'GitHub'],
			['instagram', 'fab fa-instagram', 'https://www.instagram.com/', 'Instagram'],
			['twitch', 'fab fa-twitch', 'https://www.twitch.tv/', 'Twitch']
		];
	?>
	<div class="altitude-user-socials">
		<?php foreach ($socials as [$field, $icon_name, $prefix, $label]): ?>
		<?php if ($profile->{$field}): ?>
		<a href="<?php echo $prefix.$profile->{$field} ?>" target="_blank" rel="noopener noreferrer" title="<?php echo $label ?>"><?php echo icon($icon_name) ?><span class="sr-only"><?php echo $label ?></span></a>
		<?php endif ?>
		<?php endforeach ?>
	</div>
	<?php endif ?>

	<?php if ($this->user() && $this->user != $user): ?>
	<a class="altitude-user-contact" href="<?php echo url('user/messages/compose/'.$user->url()) ?>"><?php echo icon('far fa-envelope').' '.$this->lang('Contact') ?></a>
	<?php endif ?>
</div>
