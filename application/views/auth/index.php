<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<nav>
		<div class="nav nav-pills nav-fill" id="nav-tab" role="tablist">
			<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#users" role="tab" aria-controls="nav-home" aria-selected="true">Users</a>
			<a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#groups" role="tab" aria-controls="nav-home" aria-selected="true">Groups</a>
		</div>			
	</nav>

	<div id="infoMessage"><?php echo $message;?></div>

	<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
		<div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="nav-home-tab">
			<div class="content">
				<legend>User List</legend>
				<a href="<?php echo URL;?>auth/create_user" class="btn btn-info btn-sm">Add user</a><br />
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead class="thead-dark">
							<tr>
								<th scope="col"><?php echo lang('index_fname_th');?></th>
								<th scope="col"><?php echo lang('index_lname_th');?></th>
								<th scope="col"><?php echo lang('index_email_th');?></th>
								<th scope="col"><?php echo lang('index_groups_th');?></th>
								<th scope="col"><?php echo lang('index_status_th');?></th>
								<th scope="col"><?php echo lang('index_action_th');?></th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($users as $user):?>
							<tr>
					            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
					            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
					            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
								<td>
									<?php foreach ($user->groups as $group):?>
										<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
					                <?php endforeach?>
								</td>
								<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
								<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
							</tr>
						<?php endforeach;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="tab-pane fade show" id="groups" role="tabpanel" aria-labelledby="nav-home-tab">
			<div class="content">
				<legend>Group List</legend>
				<a href="<?php echo URL;?>auth/create_group" class="btn btn-info btn-sm">Add group</a><br />
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead class="thead-dark">
							<tr>
								<th scope="col"><?php echo lang('index_fname_th');?></th>
								<th scope="col"><?php echo lang('index_lname_th');?></th>
								<th scope="col"><?php echo lang('index_email_th');?></th>
								<th scope="col"><?php echo lang('index_groups_th');?></th>
								<th scope="col"><?php echo lang('index_status_th');?></th>
								<th scope="col"><?php echo lang('index_action_th');?></th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($users as $user):?>
							<tr>
					            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
					            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
					            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
								<td>
									<?php foreach ($user->groups as $group):?>
										<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
					                <?php endforeach?>
								</td>
								<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
								<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
							</tr>
						<?php endforeach;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>