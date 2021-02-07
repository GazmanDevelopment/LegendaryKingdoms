<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<nav>
		<div class="nav nav-pills nav-fill" id="nav-tab" role="tablist">
			<a class="nav-item nav-link active" id="nav-home-tab" href="<?php echo URL;?>auth" aria-controls="nav-home" aria-selected="true">Users</a>
			<a class="nav-item nav-link disabled" id="nav-home-tab" data-toggle="tab" href="#groups" role="tab" aria-controls="nav-home" aria-selected="true">Groups</a>
		</div>			
	</nav>

	<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
		<div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="nav-home-tab">
			<div class="content">
				<legend><?php echo lang('deactivate_heading');?></legend>
				<p><?php echo sprintf(lang('deactivate_subheading'), $user->{$identity}); ?></p>

				<?php echo form_open("auth/deactivate/".$user->id);?>

				  <p>
				  	<?php echo lang('deactivate_confirm_y_label', 'confirm');?>
				    <input type="radio" name="confirm" value="yes" checked="checked" />
				    <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
				    <input type="radio" name="confirm" value="no" />
				  </p>

				  <?php echo form_hidden($csrf); ?>
				  <?php echo form_hidden(['id' => $user->id]); ?>

				  <p><?php echo form_submit('submit', lang('deactivate_submit_btn'));?></p>

				<?php echo form_close();?>
			<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>