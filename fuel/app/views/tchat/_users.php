
    <!-- Users -->
    <?php if (isset($users)): ?> 
    	<?php if(!empty($users)): ?>
			<ul class="users">
			<?php foreach ($users as $u): ?>
				<li class="username">
					 <span class="status">
					 	<?php echo $u->is_online_img(); ?>
					 </span>
					 <?php echo Inflector::friendly_title($u->username); ?>
					 <span class="date">
					 	(<?php echo Dater::elapsedtime($u->last_login); ?>)
					 	<?php //echo dater::date_timestamp($u->last_login); ?>
					 </span>
				</li>
			<?php endforeach; ?>
			</ul>
		<?php endif; ?>
    <?php endif; ?>
    <!-- //Users -->
