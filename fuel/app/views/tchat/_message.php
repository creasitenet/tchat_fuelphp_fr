
	<?php if (isset($m)): ?>
    	<div id="message_<?php echo $m->id; ?>" class="message">
        	<div class="gravatar"> 
            	<img src="<?php echo $m->user->gravatar(); ?>" class="img-responsive" alt="<?php echo $m->user->username; ?>" />
            </div>
            <div class"text">
            	<p class="username"><?php echo $m->user->username; ?> <span class="date">le <?php echo dater::date_timestamp($m->created_at); ?></span></p>
                <p class="textem"><?php echo nl2br(htmlentities($m->text)); ?></p>
            </div>
        <div class="clearfix"></div>
        </div>
        
        <!--   
        <div class="boutons">
           <a class="cliquable" data-toggle="modal" data-reveal-id="modal_delete" data-target="#modal_delete_<?php echo $e->id; ?>">
           	<i class="fa fa-trash-o delete"></i>
           </a>
        </div>
                                <div class="modal fade" id="modal_delete_<?php echo $e->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-body"> 
                                        <h4 class="modal-title text-danger" id="myModalLabel">Etes vous vraiment sûr de vouloir supprimer la tâche ?</h4>
                                        <p>Cette opération est irréverssible</p>
                                        <button type="button" class="btn btn-danger" onclick="ajax_delete('todo/ajax_delete','<?php echo $e->id; ?>','#todo_<?php echo $e->id; ?>')">
                                        SUPPRIMER
                                        </button>
                                        <button type="button" class="btn btn-info" data-dismiss="modal">ANNULER</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
       -->
                     
	<?php endif; ?>