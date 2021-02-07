<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
		<div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="nav-home-tab">
			<div class="content">
				<legend><?php echo lang('reset_password_heading');?></legend>

				<div id="infoMessage"><?php echo $message;?></div>

				<?php echo form_open('auth/reset_password/' . $code);?>

					<div class="row">
						<div class="col-md-2">
							<label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length);?></label>
						</div>
						<div class="col-md-3">
							<?php echo form_input($new_password);?>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-2">
							<?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm');?>
						</div>
						<div class="col-md-3">
						<?php echo form_input($new_password_confirm);?>
						</div>
					</div>

					<?php echo form_input($user_id);?>
					<?php echo form_hidden($csrf); ?>

					<p><?php echo form_submit('submit', lang('reset_password_submit_btn'));?></p>

				<?php echo form_close();?>
			<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>