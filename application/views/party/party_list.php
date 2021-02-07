<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>	
	<h1>Welcome to the Legendary Kingdoms Party Tracker</h1>

	<div id="body">
		<?php if (empty($party_list)) { ?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
		  You don't appear to have any parties to use.  Click the "Add Party" button below to get started...
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<?php } ?>
		<div class="row">
			<?php
				foreach($party_list as $party_entry) {
			?>
			<div class="col-md-3">
				<div class="card" style="width: 18rem;">
				  <!--<img src="..." class="card-img-top" alt="...">-->
				  <div class="card-body">
				    <h5 class="card-title"><?php echo($party_entry['party_name']); ?></h5>
				    <div class="card-text">
				    	<?php echo ($party_entry['party_notes']); ?>
				    </div>
				    <div class="card-footer">
                        <small>Silver: <?php echo($party_entry['party_silver']);?> pieces</small>
                        <a href="<?php echo(URL."party/show_party/".$party_entry['id']); ?>" class="btn btn-secondary float-right btn-sm">Open party</a>
            		</div>				    
				  </div>
				</div>
			</div>
			<?php } ?>
			
			<!-- Div to show the add new party card. -->
			<div class="col-md-3">
				<div class="card" style="width: 18rem;">
				  <!--<img src="..." class="card-img-top" alt="...">-->
				  <div class="card-body">
				    <h5 class="card-title">Add a New Party</h5>
				    <div class="card-text">
				    	Click the button below to add a new party to your account
				    </div>
				    <div class="card-footer">
                        <a href="#" class="btn btn-info float-right btn-sm" data-toggle="modal" data-target="#add_party">Add party</a>
            		</div>				    
				  </div>
				</div>
			</div>
			<!-- End add new party card -->
		</div>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

<!-- Modal -->
<div class="modal fade" id="add_party" tabindex="-1" role="dialog" aria-labelledby="add_party" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form name="add_party_form" id="add_party_form" method="post" action="<?php echo URL; ?>party/add_party">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add a New Party</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					
					<input type="text" id="party_name" name="party_name" spellcheck="true" autocomplete="on" required="required" placeholder="Party name..." /><br />
					<input type="text" id="party_notes" name="party_notes" spellcheck="true" autocomplete="on" placeholder="Party notes (options)..." />
				</div>
			</form>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>					
				<button type="submit" class="btn btn-success" data-dismiss="modal" onClick="add_party()">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true" style="padding-right: 7px"></span>
                    Save Party
                </button>
			</div>
		</div>
	</div>
</div>