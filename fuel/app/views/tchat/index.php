<h2>Tchat - FuelPHP 1.7.3</h2>

<div class="col-sm-8">
    <br />
    
	<!-- Messages -->
    <div id="tchatmessages">
       <div id="tchat_messages">
		    <?php if(isset($messages)): ?>
		    	<?php if(!empty($messages)): ?>
		        	<?php include_once('_messages.php'); ?>
		    	<?php endif; ?>
		    <?php endif; ?>
       </div>
    </div>
    
	<?php if($user): ?>
    <div id="newmessage">
    	<form action="#">
    		<div class="input-group"> 
           	<input type="text" class="form-control add" id="texte" name="text" placeholder="" autofocus autocomplete="off" />
           	<span class="input-group-btn">
    	        <button type="button" class="btn btn-primary" onclick="ajax_add('tchat/postAjaxAdd',$('#texte').val(),'#texte')">ENVOYER</button>
           	</span>
           	</div>
        </form>
    </div>
	<?php endif; ?>
	<?php if(!$user): ?>
		<?php include_once('_login.php'); ?>
	<?php endif; ?>
	<div class="clearfix"></div>
	<br />
	
</div>

<div class="col-sm-4">
	
	<!-- User -->
	<div id="tchatusers">
		<div id="tchat_users">
				<?php if(isset($users)): ?>
				    <?php if(!empty($users)): ?>
				        <?php include_once('_users.php'); ?>
				      <?php endif; ?>
				<?php endif; ?>
		</div>
	</div>
	<div id="test">
	</div>
	<?php if($user): ?>
		<br />
		<a href="user/logout" class="btn btn-primary btn-sm btn-block">SE DECONNECTER</a>
	<?php endif; ?>
	
</div>