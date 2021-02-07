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
        <legend><?php echo lang('edit_user_heading');?></legend>
        <p><?php echo lang('edit_user_subheading');?></p>

        <div id="infoMessage"><?php echo $message;?></div>

        <?php echo form_open(uri_string());?>
          <div class="row">
            <div class="col-md-2">
                <?php echo lang('edit_user_fname_label', 'first_name');?>
              </div>
              <div class="col-md-3">
                <?php echo form_input($first_name);?>
              </div>          
            </div>
            <div class="row">
              <div class="col-md-2">
                <?php echo lang('edit_user_lname_label', 'last_name');?>
              </div>
              <div class="col-md-3">
                <?php echo form_input($last_name);?>
              </div>          
            </div>
            <div class="row">
              <div class="col-md-2">
                <?php echo lang('edit_user_password_label', 'password');?>
              </div>
              <div class="col-md-3">
                    <?php echo form_input($password);?>
              </div>          
            </div>
            <div class="row">
              <div class="col-md-2">
                <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?>
              </div>
              <div class="col-md-3">
                    <?php echo form_input($password_confirm);?>
              </div>          
            </div>            
            <?php if ($this->ion_auth->is_admin()): ?>
                  <legend><?php echo lang('edit_user_groups_heading');?></legend>
                  <?php foreach ($groups as $group):?>
                      <label class="checkbox">
                      <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>" <?php echo (in_array($group, $currentGroups)) ? 'checked="checked"' : null; ?>>
                      <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
                      </label>
                  <?php endforeach?>
            <?php endif ?>

            <?php echo form_hidden('id', $user->id);?>
            <?php echo form_hidden($csrf); ?>

            <p><?php echo form_submit('submit', lang('edit_user_submit_btn'));?></p>

        <?php echo form_close();?>
  <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>