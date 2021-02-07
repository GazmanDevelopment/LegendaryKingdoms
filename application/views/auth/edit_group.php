<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<nav>
		<div class="nav nav-pills nav-fill" id="nav-tab" role="tablist">
			<a class="nav-item nav-link disabled" id="nav-home-tab" href="<?php echo URL;?>auth" aria-controls="nav-home" aria-selected="true">Users</a>
			<a class="nav-item nav-link active" id="nav-home-tab" href="<?php echo URL;?>auth" aria-controls="nav-home" aria-selected="true">Groups</a>
		</div>			
	</nav>

	<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
		<div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="nav-home-tab">
			<div class="content">
				<legend><?php echo lang('edit_group_heading');?></legend>
				<p><?php echo lang('edit_group_subheading');?></p>

				<div id="infoMessage"><?php echo $message;?></div>

				<?php echo form_open(current_url());?>
					<div class="row">
						<div class="col-md-2">
				            <?php echo lang('edit_group_name_label', 'group_name');?>
						</div>
						<div class="col-md-3">
				            <?php echo form_input($group_name);?>
				      	</div>
				    </div>
				    <div class="row">
						<div class="col-md-2">
				            <?php echo lang('edit_group_desc_label', 'description');?>
						</div>
						<div class="col-md-3">
				            <?php echo form_input($group_description);?>
				    	</div>
				    </div>
				    <p><?php echo form_submit('submit', lang('edit_group_submit_btn'));?></p>
				<?php echo form_close();?>
			<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>