
<?php echo Form::open(array("action" => 'user/login', "class"=>"form")); ?>
			
    <div class="col-sm-4">
    	<div class="form-group <?php echo ($val->error('username')) ? 'has-error' : ''; ?>">
		    <div class="input-group">
	           	<?php echo Form::input('username', Input::post('username'), array('class'=>'form-control','placeholder'=>'Pseudo', 'required')); ?>
                <span class="help-block">
        	        <?php if ($val->error('username')): ?>
            	        <?php echo $val->error('username')->get_message(); ?>
                    <?php endif; ?>
                </span>
			</div>
	    </div>
	</div>
	    
	<div class="col-sm-4">  
	   	<div class="form-group <?php echo ($val->error('email')) ? 'has-error' : ''; ?>">
		    <div class="input-group">
	           	<?php echo Form::input('email', Input::post('email'), array('class'=>'form-control','placeholder'=>'Adresse email', 'required')); ?>
                <span class="help-block">
        	        <?php if ($val->error('email')): ?>
            	        <?php echo $val->error('email')->get_message(); ?>
                    <?php endif; ?>
                </span>
			</div>
	     </div>
	</div>
	    
	<div class="col-sm-4">  	          
	   	<input type="submit" class="btn btn-primary btn-sm btn-block" value="S'IDENTIFIER" />
	</div>

<?php echo Form::close();?>
      