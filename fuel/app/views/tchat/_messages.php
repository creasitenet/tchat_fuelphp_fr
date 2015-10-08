
    <!-- Messages -->
    <?php if(isset($messages)): ?>
    <?php if(!empty($messages)): ?>
    	
        <?php foreach($messages as $m): ?>
           <div id="message_<?php echo $m->id; ?>" class="message">
                <div class="gravatar"> 
                    <img src="<?php echo $m->user->gravatar(); ?>" class="img-responsive" alt="<?php echo $m->user->username; ?>" />
                </div>
                <div class"text">
                    <p class="username"><?php echo $m->user->username; ?> <span class="date">le <?php echo $m->creation_date(); ?></span></p>
                    <p class="textem"><?php echo nl2br(htmlentities($m->text)); ?></p>
                </div>
           <div class="clearfix"></div>
           </div>
        <?php endforeach; ?>                     
           
    <?php endif; ?>
    <?php endif; ?>
    <!-- //Messages -->
