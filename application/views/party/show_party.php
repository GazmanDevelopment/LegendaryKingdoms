<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>	
	<nav>
		<div class="nav nav-pills nav-fill" id="nav-tab" role="tablist">
			<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#party_details" role="tab" aria-controls="nav-home" aria-selected="true">Party Details</a>
			<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#characters" role="tab" aria-controls="nav-profile" aria-selected="false">Characters</a>
			<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#party_log" role="tab" aria-controls="nav-contact" aria-selected="false">Log</a>
			<a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#party_vault" role="tab" aria-controls="nav-about" aria-selected="false">Vault</a>
			<a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#armies" role="tab" aria-controls="nav-about" aria-selected="false">Armies</a>
			<a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#fleets" role="tab" aria-controls="nav-about" aria-selected="false">Fleets</a>
			<a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#battlefield" role="tab" aria-controls="nav-about" aria-selected="false">Battlefield</a>
		</div>
	</nav>
	
	<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
		<div class="tab-pane fade show active" id="party_details" role="tabpanel" aria-labelledby="nav-home-tab">
			<div class="content">
				<legend>Basic Details</legend>
				<form name="update_party_form" id="update_party_form" method="post" action="<?php echo URL; ?>party/update_party">
					<input type="hidden" id="party_id_view" name="party_id_view" value="<?php echo $party_info[0]['id'];?>" />
					<a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#save_changes">Save Changes</a><br /><br />
					<div class="row">
						<div class="col-md-4">
							<label for="party_name">
								Party Name
							</label><br />
							<input type="text" id="party_name" name="party_name" value="<?php echo $party_info[0]['party_name']; ?>" />
						</div>
						<div class="col-md-4">
							<label for="current_location">
								Current Location
							</label><br />
							<input type="number" id="current_location" name="current_location" value="<?php echo $party_info[0]['current_location']; ?>" onChange="update_party(true)" />
						</div>
						<div class="col-md-4">
							<label for="silver">
								Party Silver
							</label><br />
							<input type="number" id="silver" name="silver" value="<?php echo $party_info[0]['party_silver']; ?>" onChange="update_party(true)" />
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-md-12">
							<label for="party_notes">
								Party Notes
							</label><br />
							<textarea id="party_notes" name="party_notes" rows="5" cols="75">
								<?php echo trim(preg_replace('/\s+/S', " ",  $party_info[0]['party_notes'])); ?>
							</textarea>
						</div>
					</div>
				</div>
			</form>
			<br />
			<legend>Codes</legend>
			<a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_code">Add / Remove Code</a><br /><br />
			<div class="row">
				<?php foreach($party_codes as $code) { ?>
				<div class="col-md-1">					
						<?php echo $code['code']; ?>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="tab-pane fade" id="characters" role="tabpanel" aria-labelledby="nav-profile-tab">
			<legend>Party Characters</legend>
			<a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_character">Add character</a><br/>
			<?php if (empty($party_characters)) { ?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
			  You don't appear to have any characters to use.  Click the "Add character" button to get started...
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php } ?>
			<div class="row">
				<div class="card-group">
					<?php
						foreach($party_characters as $character_entry) {
					?>
					<div class="col-md-3">
						<form name="character_form_<?php echo($character_entry['info']['id']); ?>" id="character_form_<?php echo($character_entry['info']['id']); ?>" method="post" action="<?php echo URL; ?>party/update_party">
							<input type="hidden" id="character_id" name="character_id" value="<?php echo($character_entry['info']['id']); ?>" />
							<div class="card border-secondary"><!-- style="width: 35rem;"-->
							  <!--<img src="..." class="card-img-top" alt="...">-->
							  <div class="card-header">
							  	<h4 class="card-title"><?php echo($character_entry['info']['name']); ?></h4>
							  	<a href="#" title="Save changes to character..." onClick="save_character(<?php echo($character_entry['info']['id']); ?>)">
							    	<i class="material-icons" style="padding-right: 4px;">save</i>
							    </a>
							    <a href="#" title="Remove character from party..." onClick="delete_character(<?php echo($character_entry['info']['id']); ?>)">
							    	<i class="material-icons" style="padding-right: 4px;">cancel</i>
							    </a>
							  </div>
							  <div class="card-body">
							    <div class="card-text">						    	
								  	<legend>Stats</legend>
							    	<strong>
							    	<div class="row">
							    		<div class="col-md-4">
							    			Stat
							    		</div>
							    		<div class="col-md-3">
							    			Max Value
							    		</div>
							    		<div class="col-md-3">
							    			Current Value
							    		</div>
							    	</div>
							    	</strong>
							    	<div class="row"><!-- Health  -->
							    		<div class="col-md-4">
							    			Health <br /> 					    			
							    		</div>
							    		<div class="col-md-3">
							    			<input name="health_max" id="health_current" type="number" value="<?php echo ($character_entry['info']['health_max']); ?>" min="0" max="99" maxlength = "2" size="1" />
							    		</div>
							    		<div class="col-md-3">
							    			<input name="health_current" id="health_current" type="number" value="<?php echo ($character_entry['info']['health_current']); ?>" min="0" max="99" maxlength = "2" size="1" />
							    		</div>
							    	</div><!-- Health  -->
							    	<div class="row"><!-- Armour  -->
							    		<div class="col-md-4">
							    			Armour <br /> 
							    		</div>
							    		<div class="col-md-3">
							    			<input name="armour" id="armour" type="number" value="<?php echo ($character_entry['info']['armour_current']); ?>" min="0" max="99" maxlength = "2" size="1" />
							    		</div>
							    	</div><!-- Armour  -->
							    	<div class="row"><!-- Fighting strength -->
							    		<div class="col-md-4">
							    			Fighting					    			
							    		</div>
							    		<div class="col-md-3">
							    			<input name="fight_max" id="fight_max" type="number" value="<?php echo ($character_entry['info']['fight_max']); ?>" min="0" max="99" maxlength = "2" size="1" />
							    		</div>
							    		<div class="col-md-2">
							    			<input name="fight_current" id="fight_current" type="number" value="<?php echo ($character_entry['info']['fight_current']); ?>" min="0" max="99" maxlength = "2" size="1" />
							    		</div>
							    	</div><!-- Fighting strength -->
							    	<div class="row"><!-- Stealth  -->
							    		<div class="col-md-4">
							    			Stealth <br /> 
							    		</div>
							    		<div class="col-md-3">
							    			<input name="stealth_max" id="stealth_max" type="number" value="<?php echo ($character_entry['info']['stealth_max']); ?>" min="0" max="99" maxlength = "2" size="1" />
							    		</div>
							    		<div class="col-md-3">
							    			<input name="stealth_current" id="stealth_current" type="number" value="<?php echo ($character_entry['info']['stealth_current']); ?>" min="0" max="99" maxlength = "2" size="1" />
							    		</div>
							    	</div><!-- Stealth  -->
							    	<div class="row"><!-- Lore  -->
							    		<div class="col-md-4">
							    			Lore <br />
							    		</div>
							    		<div class="col-md-3">
							    			<input name="lore_max" id="lore_max" type="number" value="<?php echo ($character_entry['info']['lore_max']); ?>" min="0" max="99" maxlength = "2" size="1" />
							    		</div>
							    		<div class="col-md-3">
							    			<input name="lore_current" id="lore_current" type="number" value="<?php echo ($character_entry['info']['lore_current']); ?>" min="0" max="99" maxlength = "2" size="1" />
							    		</div>
							    	</div><!-- Lore  -->
							    	<div class="row"><!-- Survival  -->
							    		<div class="col-md-4">
							    			Survival <br />
							    		</div>
							    		<div class="col-md-3">
							    			<input name="survival_max" id="survival_max" type="number" value="<?php echo ($character_entry['info']['survive_max']); ?>" min="0" max="99" maxlength = "2" size="1" />
							    		</div>
							    		<div class="col-md-3">
							    			<input name="survival_current" id="survival_current" type="number" value="<?php echo ($character_entry['info']['survive_current']); ?>" min="0" max="99" maxlength = "2" size="1" />
							    		</div>
							    	</div><!-- Survival  -->
							    	<div class="row"><!-- Charisma  -->
							    		<div class="col-md-4">
							    			Charisma<br />
							    		</div>
							    		<div class="col-md-3">
							    			<input name="charisma_max" id="charisma_max" type="number" value="<?php echo ($character_entry['info']['charisma_max']); ?>" min="0" max="99" maxlength = "2" size="1" />
							    		</div>
							    		<div class="col-md-3">
							    			<input name="charisma_current" id="charisma_current" type="number" value="<?php echo ($character_entry['info']['charisma_current']); ?>" min="0" max="99" maxlength = "2" size="1" />
							    		</div>
							    	</div><!-- Charisma  -->
							    </div>
							    <hr />
						    	<legend>Equipment</legend>
						    	<div class="table-responsive">
							    	<table class="table table-bordered">
							    		<thead>
											<tr>
												<th scope="col">Item</th>
												<th scope="col">Skill Mod.</th>
												<th scope="col">Mod Value</th>
												<th scope="col">Notes</th>
												<th scope="col">Actions <a href="#" title="Add equipment item to character..." onClick="add_character_equipment(<?php echo($character_entry['info']['id']); ?>)"><i class="material-icons" style="padding-right: 4px;">add_circle</i></a><br /></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($character_entry['equipment'] as $equipment_item) { ?>
					                        	<tr>
						                        	<td><?php echo $equipment_item['equip_name']; ?></td>
						                        	<td><?php echo $equipment_item['skill_mod']; ?></td>
						                        	<td><?php echo $equipment_item['mod_value']; ?></td>
						                        	<td><?php echo $equipment_item['notes']; ?></td>
						                        	<td>
						                        		<a href="#" title="Return item to vault..." onClick="return_item(<?php echo $equipment_item['id']; ?>)"><i class="material-icons" style="padding-right: 4px;">inventory</i></a><br />
						                        		<a href="#" title="Drop item..." onClick="drop_item(<?php echo $equipment_item['id']; ?>)"><i class="material-icons" style="padding-right: 4px;">delete_forever</i></a>
						                        	</td>
						                        </tr>
					                        <?php } ?>
										</tbody>
									</table>	                        
			                    </div>
			                    <hr />
						    	<legend>Spells</legend>
						    	<div class="table-responsive">
							    	<table class="table table-bordered">
							    		<thead>
											<tr>
												<th scope="col">Spell</th>
												<th scope="col">Description</th>
												<th scope="col">Recharge</th>
												<th scope="col">Used</th>
												<th scope="col">Actions <a href="#" title="Learn spell..." onClick="add_character_spell(<?php echo($character_entry['info']['id']); ?>)"><i class="material-icons" style="padding-right: 4px;">add_circle</i></a><br /></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($character_entry['spells'] as $spell) { ?>
					                        	<tr>
						                        	<td><?php echo $spell['name']; ?></td>
						                        	<td><?php echo $spell['description']; ?></td>
						                        	<td><?php echo $spell['recharge']; ?></td>
						                        	<td><?php echo $spell['used']; ?></td>
						                        	<td>
						                        		<a href="#" title="Forget spell..." onClick="forget_spell(<?php echo $spell['id']; ?>)"><i class="material-icons" style="padding-right: 4px;">Forget spell</i></a>
						                        	</td>
						                        </tr>
					                        <?php } ?>
										</tbody>
									</table>	                        
			                    </div>
			                    <hr />
							  	<legend>Character Notes</legend>
					    		<textarea id="character_notes" name="character_notes"><?php echo ($character_entry['info']['notes']); ?></textarea>
							  </div>						  	
							</div>
						</form>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="party_log" role="tabpanel" aria-labelledby="nav-contact-tab">
			<div class="content">
				<legend>Party Logs</legend>
				<a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_log">Add Log Entry</a><br />
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Log Date</th>
								<th scope="col">Comments</th>
								<th scope="col">Location</th>
								<th scope="col">Completed</th>
								<th scope="col">Actions</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($party_log as $log_entry) { ?>
							<tr>
								<td><?php echo date("Y-m-d", strtotime($log_entry['log_date'])); ?></td>
								<td id="log_comment_<?php echo $log_entry['id']; ?>"><?php echo $log_entry['comments']; ?></td>
								<td id="log_location_<?php echo $log_entry['id']; ?>"><?php echo $log_entry['location']; ?></td>
								<td><input id="completed_<?php echo $log_entry['id']; ?>" name="completed_<?php echo $log_entry['id']; ?>" type="checkbox" <?php echo $log_entry['completed'] ? 'checked' : ''; ?> /></td>
								<td>
									<a href="#" data-toggle="modal" onClick="edit_log_entry(<?php echo $log_entry['id']; ?>)"><i class="material-icons" style="padding-right: 4px">mode_edit</i>Edit Log Item</a>
									<?php if(! $log_entry['completed']) { ?> 
									<br />
									<a href="#" data-toggle="modal" onClick="delete_log_entry(<?php echo $log_entry['id']; ?>)"><i class="material-icons" style="padding-right: 4px">delete</i>Delete Log Item</a>
									<?php } ?>							
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="party_vault" role="tabpanel" aria-labelledby="nav-about-tab">
			<legend>Party Vault</legend>
			<a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_item">Add item</a><br/>
			<?php if (empty($party_characters)) { ?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
			  You don't appear to have any equipment / items.  Click the "Add item" button to get started...
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php } ?>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Name</th>
							<th scope="col">Skill Modified</th>
							<th scope="col">Modifier</th>
							<th scope="col">Notes</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($party_equipment as $equipment) { ?>
					<tr>
						<td><?php echo $equipment['equip_name']; ?></td>
						<td><?php echo $equipment['skill_mod']; ?></td>
						<td><?php echo $equipment['mod_value']; ?></td>
						<td><?php echo $equipment['notes']; ?></td>
						<td>
							<a href="#" data-toggle="modal" onClick="drop_item(<?php echo $equipment['id']; ?>)"><i class="material-icons" style="padding-right: 4px;">delete_forever</i>Drop Item...</a><br />
							<a href="#" data-toggle="modal" onClick="assign_item(<?php echo $equipment['id']; ?>)"><i class="material-icons" style="padding-right: 4px">assignment_ind</i>Assign to Character...</a><br />
						</td>
					</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="tab-pane fade" id="armies" role="tabpanel" aria-labelledby="nav-about-tab">
			<legend>Party Armies</legend>
			<a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_army">Add army</a><br/>
			<?php if (empty($armies)) { ?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
			  You don't appear to have any armies.  Click the "Add army" button to get started...
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php } ?>
			<div class="card-group">
				<?php
					foreach($armies as $army) {
				?>
				<form name="army_form_<?php echo($army['id']); ?>" id="army_form_<?php echo($army['id']); ?>" method="post" action="<?php echo URL; ?>army/update_army">
					<input type="hidden" id="army_id" name="army_id" value="<?php echo($army['id']); ?>" />
					<div class="card border-secondary"><!-- style="width: 35rem;"-->
						<div class="card-header">
						  	<h4 class="card-title"><?php echo($army['unit']); ?></h4><em><?php echo $army['garrison'];?></em>
						  	<a href="#" title="Save changes to army..." onClick="save_army(<?php echo($army['id']); ?>)">
						    	<i class="material-icons" style="padding-right: 4px;">save</i>
						    </a>
						    <a href="#" title="Remove army from party..." onClick="delete_army(<?php echo($army['id']); ?>)">
						    	<i class="material-icons" style="padding-right: 4px;">cancel</i>
						    </a>
						</div>
						<div class="card-body">
							<legend>Stats</legend>
						    <strong>
						    	<div class="row">
						    		<div class="col-md-4">
						    			Stat
						    		</div>
						    		<div class="col-md-4">
						    			Initial Value
						    		</div>
						    		<div class="col-md-4">
						    			Current Value
						    		</div>
						    	</div>
						    </strong>
						    <div class="row">
					    		<div class="col-md-4">
					    			Strength <br /> 					    			
					    		</div>
					    		<div class="col-md-4">
					    			<?php echo ($army['initial_strength']); ?>
					    		</div>
					    		<div class="col-md-4">
					    			<input name="strength_current" id="strength_current" type="number" value="<?php echo ($army['current_strength']); ?>" min="0" max="99" maxlength = "2" size="1" />
					    		</div>
						    </div>
						    <div class="row">
					    		<div class="col-md-4">
					    			Morale <br /> 					    			
					    		</div>
					    		<div class="col-md-4">
					    			<?php echo ($army['initial_morale']); ?>
					    		</div>
					    		<div class="col-md-4">
					    			<input name="morale_current" id="morale_current" type="number" value="<?php echo ($army['current_morale']); ?>" min="0" max="99" maxlength = "2" size="1" />
					    		</div>
						    </div>
						    <div class="row">
					    		<div class="col-md-4">
					    			Location <br /> 					    			
					    		</div>
					    		<div class="col-md-4">
					    			<?php echo ($army['found_location']); ?>
					    		</div>
					    		<div class="col-md-4">
					    			<input name="location_current" id="location_current" type="number" value="<?php echo ($army['current_location']); ?>" min="0" max="99" maxlength = "2" size="1" />
					    		</div>
						    </div>
						    <hr />
						  	<legend>Unit Notes</legend>
				    		<textarea id="army_notes" name="army_notes"><?php echo ($army['notes']); ?></textarea>
						</div>
					</div>
				</form>
				<?php 
					}
				?>
			</div>
		</div>
		<div class="tab-pane fade" id="fleets" role="tabpanel" aria-labelledby="nav-about-tab">
			<legend>Party Fleets</legend>
			<a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_ship">Add ship to fleet</a><br/>
			<?php if (empty($fleet)) { ?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
			  You don't appear to have any ships.  Click the "Add ship to fleet" button to get started...
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php } ?>
			<div class="card-group">
				<?php
					foreach($fleet as $ship) {
				?>
				<form name="ship_form_<?php echo($ship['id']); ?>" id="ship_form_<?php echo($ship['id']); ?>" method="post" action="<?php echo URL; ?>fleet/update_ship">
					<input type="hidden" id="ship_id" name="ship_id" value="<?php echo($ship['id']); ?>" />
					<div class="card border-secondary"><!-- style="width: 35rem;"-->
						<div class="card-header">
						  	<h4 class="card-title"><?php echo($ship['ship_name']); ?></h4>
						  	<a href="#" title="Save changes to ship..." onClick="save_ship(<?php echo($ship['id']); ?>)">
						    	<i class="material-icons" style="padding-right: 4px;">save</i>
						    </a>
						    <a href="#" title="Remove ship from party..." onClick="delete_ship(<?php echo($ship['id']); ?>)">
						    	<i class="material-icons" style="padding-right: 4px;">cancel</i>
						    </a>
						</div>
						<div class="card-body">
							<legend>Stats</legend>
						    <strong>
						    	<div class="row">
						    		<div class="col-md-6">
						    			Stat
						    		</div>
						    		<div class="col-md-6">
						    			Current Value
						    		</div>
						    	</div>
						    </strong>
						    <div class="row">
					    		<div class="col-md-6">
					    			Fight <br /> 					    			
					    		</div>
					    		<div class="col-md-6">
					    			<input name="fight_current" id="fight_current" type="number" value="<?php echo ($ship['fight_current']); ?>" min="0" max="99" maxlength = "2" size="1" />
					    		</div>
						    </div>
						    <div class="row">
					    		<div class="col-md-6">
					    			Health <br /> 					    			
					    		</div>
					    		<div class="col-md-6">
					    			<input name="health_current" id="health_current" type="number" value="<?php echo ($ship['health_current']); ?>" min="0" max="99" maxlength = "2" size="1" />
					    		</div>
						    </div>
						    <div class="row">
					    		<div class="col-md-6">
					    			Location <br /> 					    			
					    		</div>
					    		<div class="col-md-6">
					    			<input name="location" id="location" type="number" value="<?php echo ($ship['location']); ?>" min="0" max="99" maxlength = "2" size="1" />
					    		</div>
						    </div>
						    <hr />
						    <legend>Cargo</legend>
						    <strong>
						    <div class="row">
						    	<div class="col-md-8">
						    		Cargo
						    	</div>
						    	<div class="col-md-4">
						    		Cargo Units
						    	</div>
						    </div>
							</strong>
						    <div class="row">
						    	<div class="col-md-8">
						    		<input name="cargo" id="cargo" type="text" value="<?php echo $ship['cargo'];?>" />
						    	</div>
						    	<div class="col-md-4">
						    		<input name="cargo_units" id="cargo_units" type="number" value="<?php echo ($ship['cargo_units']); ?>" min="0" max="99" maxlength = "2" size="1" />
						    	</div>
						    </div>
						    <hr />
						  	<legend>Ships Log</legend>
				    		<textarea id="ship_notes" name="ship_notes"><?php echo ($ship['notes']); ?></textarea>
						</div>
					</div>
				</form>
				<?php 
					}
				?>
			</div>
		</div>
		<div class="tab-pane fade" id="battlefield" role="tabpanel" aria-labelledby="nav-about-tab">
			<legend>Battlefield</legend>
			<a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#init_battlefield" onClick="init_battlefield(<?php echo $party_info[0]['id'];?>)">Prepare battlefield...</a><br/>
			<?php if (empty($bf_enemy)) { ?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
			  Click the "Prepare battlefield" button to get started...
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php } ?>
			<div class="card-group">
				<?php
					if ($bf_party) {
				?>
				<form name="battlefield_form_party" id="battlefield_form_party" method="post" action="<?php echo URL; ?>battlefield/update_battlefield">
					<input type="hidden" id="bf_party_id" name="bf_party_id" value="<?php echo $party_info[0]['id'];?>" />
					<input type="hidden" id="bf_type" name="bf_type" value="<?php echo BATTLEFIELD_PARTY; ?>" />
					<div class="card border-secondary"><!-- style="width: 35rem;"-->
						<div class="card-header">
						  	<h4 class="card-title">Party Forces</h4>
						  	<a href="#" title="Save changes to ship..." onClick="update_battlefield('<?php echo BATTLEFIELD_PARTY; ?>')">
						    	<i class="material-icons" style="padding-right: 4px;">save</i>
						    </a>
						</div>
						<div class="card-body">
							<legend>Support</legend>
						    <strong>
						    	<div class="row">
						    		<div class="col-md-4">
						    			Left
						    		</div>
						    		<div class="col-md-4">
						    			Centre
						    		</div>
						    		<div class="col-md-4">
						    			Right
						    		</div>
						    	</div>
						    </strong>
						    <div class="row">
					    		<div class="col-md-4">
					    			<input id="lf_support" name="lf_support" type="number" value="<?php echo $bf_party['lf_support']; ?>" min="0" max="99" maxlength="2" size="1" />    			
					    		</div>
					    		<div class="col-md-4">
					    			<input id="c_support" name="c_support" type="number" value="<?php echo $bf_party['c_support']; ?>" min="0" max="99" maxlength="2" size="1" />
					    		</div>
					    		<div class="col-md-4">
					    			<input id="rf_support" name="rf_support" type="number" value="<?php echo $bf_party['rf_support']; ?>" min="0" max="99" maxlength="2" size="1" />
					    		</div>
						    </div>
						    <hr />
						    <legend>Front</legend>
						    <strong>
						    	<div class="row">
						    		<div class="col-md-4">
						    			Left
						    		</div>
						    		<div class="col-md-4">
						    			Centre
						    		</div>
						    		<div class="col-md-4">
						    			Right
						    		</div>
						    	</div>
						    </strong>
						    <div class="row">
					    		<div class="col-md-4">
					    			<input id="lf_front" name="lf_front" type="number" value="<?php echo $bf_party['lf_front']; ?>" min="0" max="99" maxlength="2" size="1" />    			
					    		</div>
					    		<div class="col-md-4">
					    			<input id="c_front" name="c_front" type="number" value="<?php echo $bf_party['c_front']; ?>" min="0" max="99" maxlength="2" size="1" />
					    		</div>
					    		<div class="col-md-4">
					    			<input id="rf_front" name="rf_front" type="number" value="<?php echo $bf_party['rf_front']; ?>" min="0" max="99" maxlength="2" size="1" />
					    		</div>
						    </div>
						</div>
					</div>
				</form>
				<?php 
					}

					// Enemy Battlefield Start
					if ($bf_enemy) {
				?>
				<form name="battlefield_form_enemy" id="battlefield_form_enemy" method="post" action="<?php echo URL; ?>battlefield/update_battlefield">
					<input type="hidden" id="bf_party_id" name="bf_party_id" value="<?php echo $party_info[0]['id'];?>" />
					<input type="hidden" id="bf_type" name="bf_type" value="<?php echo BATTLEFIELD_ENEMY; ?>" />
					<div class="card border-secondary"><!-- style="width: 35rem;"-->
						<div class="card-header">
						  	<h4 class="card-title">Enemy Forces</h4>
						  	<a href="#" title="Save changes to ship..." onClick="update_battlefield('<?php echo BATTLEFIELD_ENEMY; ?>')">
						    	<i class="material-icons" style="padding-right: 4px;">save</i>
						    </a>
						</div>
						<div class="card-body">
							<legend>Support</legend>
						    <strong>
						    	<div class="row">
						    		<div class="col-md-4">
						    			Left
						    		</div>
						    		<div class="col-md-4">
						    			Centre
						    		</div>
						    		<div class="col-md-4">
						    			Right
						    		</div>
						    	</div>
						    </strong>
						    <div class="row">
					    		<div class="col-md-4">
					    			<input id="lf_support" name="lf_support" type="number" value="<?php echo $bf_enemy['lf_support']; ?>" min="0" max="99" maxlength="2" size="1" />    			
					    		</div>
					    		<div class="col-md-4">
					    			<input id="c_support" name="c_support" type="number" value="<?php echo $bf_enemy['c_support']; ?>" min="0" max="99" maxlength="2" size="1" />
					    		</div>
					    		<div class="col-md-4">
					    			<input id="rf_support" name="rf_support" type="number" value="<?php echo $bf_enemy['rf_support']; ?>" min="0" max="99" maxlength="2" size="1" />
					    		</div>
						    </div>
						    <hr />
						    <legend>Front</legend>
						    <strong>
						    	<div class="row">
						    		<div class="col-md-4">
						    			Left
						    		</div>
						    		<div class="col-md-4">
						    			Centre
						    		</div>
						    		<div class="col-md-4">
						    			Right
						    		</div>
						    	</div>
						    </strong>
						    <div class="row">
					    		<div class="col-md-4">
					    			<input id="lf_front" name="lf_front" type="number" value="<?php echo $bf_enemy['lf_front']; ?>" min="0" max="99" maxlength="2" size="1" />    			
					    		</div>
					    		<div class="col-md-4">
					    			<input id="c_front" name="c_front" type="number" value="<?php echo $bf_enemy['c_front']; ?>" min="0" max="99" maxlength="2" size="1" />
					    		</div>
					    		<div class="col-md-4">
					    			<input id="rf_front" name="rf_front" type="number" value="<?php echo $bf_enemy['rf_front']; ?>" min="0" max="99" maxlength="2" size="1" />
					    		</div>
						    </div>
						</div>
					</div>
				</form>
				<?php 
					}
				?>
			</div>
		</div>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

<!-- Modal Dialog Boxes -->
<!-- Add Code -->
<div class="modal fade" id="add_code" tabindex="-1" role="dialog" aria-labelledby="add_code" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form name="add_code_form" id="add_code_form" method="post" action="<?php echo URL; ?>party/add_code">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add / Remove a Party Code</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="party_id" name="party_id" value="<?php echo $party_info[0]['id'];?>" />
					<input type="text" id="party_code" name="party_code" spellcheck="true" autocomplete="on" required="required" placeholder="Enter Code..." /><br /><br />
					<label for="remove">
						Remove Code
					</label>
					<input type="checkbox" id="remove" name="remove" value="remove" />
				</div>
			</form>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>					
				<button type="submit" class="btn btn-success" data-dismiss="modal" onClick="add_code()">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true" style="padding-right: 7px"></span>
                    Add / Remove Code
                </button>
			</div>
		</div>
	</div>
</div>

<!-- Save changes to party -->
<div class="modal fade" id="save_changes" tabindex="-1" role="dialog" aria-labelledby="save_changes" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Confirm Party Save</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Confirm you want to save the changes to the party
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>					
				<button type="submit" class="btn btn-success" data-dismiss="modal" onClick="update_party()">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true" style="padding-right: 7px"></span>
                    Confirm
                </button>
			</div>
		</div>
	</div>
</div>

<!-- Delete a character -->
<div class="modal fade" id="delete_character" tabindex="-1" role="dialog" aria-labelledby="delete_character" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Confirm Character Delete</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				There is no way to recover characters once they are deleted. <br />
				<strong>If you click "Confirm", your character will be permanently deleted.</strong>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>					
				<button id="confirm_char_delete" type="submit" class="btn btn-danger" data-dismiss="modal">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true" style="padding-right: 7px"></span>
                    Confirm
                </button>
			</div>
		</div>
	</div>
</div>

<!-- Add a character -->
<div class="modal fade" id="add_character" tabindex="-1" role="dialog" aria-labelledby="add_character" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add New Party Character</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="add_character_form" id="add_character_form" method="post" action="<?php echo URL; ?>character/add_character">
					<input type="hidden" id="party_id" name="party_id" value="<?php echo $party_info[0]['id'];?>" />
					<strong>
						<div class="row">
							<div class="col-md-4">
								<label for="new_character_name">
									Character Name:
								</label>
							</div>
							<div class="col-md-8">
								<input type="text" name="new_character_name" id="new_character_name" />
							</div>
						</div>				
				    	<div class="row">
				    		<div class="col-md-4">
				    			Stat
				    		</div>
				    		<div class="col-md-3">
				    			Max
				    		</div>
				    		<div class="col-md-3">
				    			Current
				    		</div>
				    	</div>
				    </strong>
			    	<div class="row"><!-- Health  -->
			    		<div class="col-md-4">
			    			Health <br /> 					    			
			    		</div>
			    		<div class="col-md-3">
			    			<input name="health_max" id="health_current" type="number" min="0" max="99" maxlength = "2" size="1" />
			    		</div>
			    		<div class="col-md-3">
			    			<input name="health_current" id="health_current" type="number" min="0" max="99" maxlength = "2" size="1" />
			    		</div>
			    	</div><!-- Health  -->
			    	<div class="row"><!-- Armour  -->
			    		<div class="col-md-4">
			    			Armour <br /> 
			    		</div>
			    		<div class="col-md-3">
			    			<input name="armour" id="armour" type="number" min="0" max="99" maxlength = "2" size="1" />
			    		</div>
			    	</div><!-- Armour  -->
			    	<div class="row"><!-- Fighting strength -->
			    		<div class="col-md-4">
			    			Fighting					    			
			    		</div>
			    		<div class="col-md-3">
			    			<input name="fight_max" id="fight_max" type="number" min="0" max="99" maxlength = "2" size="1" />
			    		</div>
			    		<div class="col-md-2">
			    			<input name="fight_current" id="fight_current" type="number" min="0" max="99" maxlength = "2" size="1" />
			    		</div>
			    	</div><!-- Fighting strength -->
			    	<div class="row"><!-- Stealth  -->
			    		<div class="col-md-4">
			    			Stealth <br /> 
			    		</div>
			    		<div class="col-md-3">
			    			<input name="stealth_max" id="stealth_max" type="number" min="0" max="99" maxlength = "2" size="1" />
			    		</div>
			    		<div class="col-md-3">
			    			<input name="stealth_current" id="stealth_current" type="number" min="0" max="99" maxlength = "2" size="1" />
			    		</div>
			    	</div><!-- Stealth  -->
			    	<div class="row"><!-- Lore  -->
			    		<div class="col-md-4">
			    			Lore <br />
			    		</div>
			    		<div class="col-md-3">
			    			<input name="lore_max" id="lore_max" type="number" min="0" max="99" maxlength = "2" size="1" />
			    		</div>
			    		<div class="col-md-3">
			    			<input name="lore_current" id="lore_current" type="number" min="0" max="99" maxlength = "2" size="1" />
			    		</div>
			    	</div><!-- Lore  -->
			    	<div class="row"><!-- Survival  -->
			    		<div class="col-md-4">
			    			Survival <br />
			    		</div>
			    		<div class="col-md-3">
			    			<input name="survival_max" id="survival_max" type="number" min="0" max="99" maxlength = "2" size="1" />
			    		</div>
			    		<div class="col-md-3">
			    			<input name="survival_current" id="survival_current" type="number" min="0" max="99" maxlength = "2" size="1" />
			    		</div>
			    	</div><!-- Survival  -->
			    	<div class="row"><!-- Charisma  -->
			    		<div class="col-md-4">
			    			Charisma<br />
			    		</div>
			    		<div class="col-md-3">
			    			<input name="charisma_max" id="charisma_max" type="number" min="0" max="99" maxlength = "2" size="1" />
			    		</div>
			    		<div class="col-md-3">
			    			<input name="charisma_current" id="charisma_current" type="number" min="0" max="99" maxlength = "2" size="1" />
			    		</div>
			    	</div><!-- Charisma  -->
			    	<div class="row">
			    		<div class="col-md-4">
			    			<strong>Character Notes</strong>
			    		</div>
					</div>
					<div class="row">
			    		<div class="col-md-3">
			    			<textarea id="character_notes" name="character_notes"></textarea>
			    		</div>
			    	</div>
			    </form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>					
				<button id="confirm_char_delete" type="submit" class="btn btn-success" data-dismiss="modal" onclick="add_character()">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true" style="padding-right: 7px"></span>
                    Confirm
                </button>
			</div>
		</div>
	</div>
</div>

<!-- Add a log -->
<div class="modal fade" id="add_log" tabindex="-1" role="dialog" aria-labelledby="add_log" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Log Entry</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="add_log_form" id="add_log_form" method="post" action="<?php echo URL; ?>character/add_character">
					<input type="hidden" id="party_id" name="party_id" value="<?php echo $party_info[0]['id'];?>" />
					<div class="row">
						<div class="col-md-4">
							<label for="new_log_comments">
								Comments
							</label>
						</div>
						<div class="col-md-8">
							<textarea name="new_log_comments" id="new_log_comments" spellcheck="true" rows="5" cols="35"></textarea>
						</div>
					</div>				
			    	<div class="row">
			    		<div class="col-md-4">
			    			<label for="new_log_location">
			    				Location
			    			</label>
			    		</div>
			    		<div class="col-md-8">
			    			<input type="number" id="new_log_location" name="new_log_location" minlength="0" maxlength="9999" />
			    		</div>
			    	</div>
			    	<div class="row">
			    		<div class="col-md-4">
			    			<label for="new_log_completed">
			    				Completed
			    			</label>					    			
			    		</div>
			    		<div class="col-md-8">
			    			<input name="new_log_completed" id="new_log_completed" type="checkbox" value="1" />
			    		</div>
			    	</div>
			    </form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>					
				<button id="confirm_char_delete" type="submit" class="btn btn-success" data-dismiss="modal" onclick="add_log_entry()">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true" style="padding-right: 7px"></span>
                    Confirm
                </button>
			</div>
		</div>
	</div>
</div>

<!-- Edit a log -->
<div class="modal fade" id="edit_log" tabindex="-1" role="dialog" aria-labelledby="edit_log" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Log Entry</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="edit_log_form" id="edit_log_form" method="post" action="<?php echo URL; ?>character/add_character">
					<input type="hidden" id="edit_log_id" name="edit_log_id" />
					<div class="row">
						<div class="col-md-4">
							<label for="edit_log_comments">
								Comments
							</label>
						</div>
						<div class="col-md-8">
							<textarea name="edit_log_comments" id="edit_log_comments" spellcheck="true" rows="5" cols="35"></textarea>
						</div>
					</div>				
			    	<div class="row">
			    		<div class="col-md-4">
			    			<label for="edit_log_location">
			    				Location
			    			</label>
			    		</div>
			    		<div class="col-md-8">
			    			<input type="number" id="edit_log_location" name="edit_log_location" minlength="0" maxlength="9999" />
			    		</div>
			    	</div>
			    	<div class="row">
			    		<div class="col-md-4">
			    			<label for="edit_log_completed">
			    				Completed
			    			</label>					    			
			    		</div>
			    		<div class="col-md-8">
			    			<input name="edit_log_completed" id="edit_log_completed" type="checkbox" value="1" />
			    		</div>
			    	</div>
			    </form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>					
				<button id="confirm_log_edit" type="submit" class="btn btn-success" data-dismiss="modal" onclick="edit_log_entry()">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true" style="padding-right: 7px"></span>
                    Confirm
                </button>
			</div>
		</div>
	</div>
</div>

<!-- Delete a log entry -->
<div class="modal fade" id="delete_log" tabindex="-1" role="dialog" aria-labelledby="delete_log" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Confirm Log Entry Delete</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="delete_log_form" name="delete_log_form" method="POST" action="<?php echo URL; ?>log/delete_log">
					<input type="hidden" id="delete_log_id" name="delete_log_id" />
				</form>
				There is no way to recover log entries once they are deleted. <br />
				<strong>If you click "Confirm", your log entry will be permanently deleted.</strong>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>					
				<button id="confirm_log_delete" type="submit" class="btn btn-danger" data-dismiss="modal">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true" style="padding-right: 7px"></span>
                    Confirm
                </button>
			</div>
		</div>
	</div>
</div>

<!-- Add equipment -->
<div class="modal fade" id="add_item" tabindex="-1" role="dialog" aria-labelledby="add_item" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Equipment Item</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="add_item_form" id="add_item_form" method="post" action="<?php echo URL; ?>character/add_character">
					<input type="hidden" id="new_item_party_id" name="new_item_party_id" value="<?php echo $party_info[0]['id'];?>" />
					<input type="hidden" id="new_item_character_id" name="new_item_character_id" value="" />
					<div class="row">
						<div class="col-md-6">
							<label for="new_item_name">
								Item
							</label><br />
							<input type="text" name="new_item_name" id="new_item_name" spellcheck="true" required />
						</div>
						<div class="col-md-6">
			    			<label for="new_item_notes">
			    				Notes
			    			</label><br />
			    			<textarea name="new_item_notes" id="new_item_notes" spellcheck="true" rows="3" ></textarea>
			    		</div>
					</div>				
			    	<div class="row">
			    		<div class="col-md-6">
			    			<label for="new_item_skill_mod">
			    				Skill Modified
			    			</label><br />
			    			<input type="test" id="new_item_skill_mod" name="new_item_skill_mod" />
			    		</div>
			    		<div class="col-md-6">
			    			<label for="new_item_mod_value">
			    				Mod Value
			    			</label><br />
			    			<input type="number" id="new_item_mod_value" name="new_item_mod_value" value="0"  required />
			    		</div>
			    	</div>
			    </form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>					
				<button id="confirm_char_delete" type="submit" class="btn btn-success" data-dismiss="modal" onclick="add_equipment()">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true" style="padding-right: 7px"></span>
                    Confirm
                </button>
			</div>
		</div>
	</div>
</div>

<!-- Return equipment to vault -->
<div class="modal fade" id="return_equipment" tabindex="-1" role="dialog" aria-labelledby="return_equipment" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Return Item to Value</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="return_equipment_form" name="return_equipment_form" method="POST" action="<?php echo URL; ?>log/delete_log">
					<input type="hidden" id="return_item_id" name="return_item_id" />
					<input type="hidden" id="return_item_party_id" name="return_item_party_id" value="<?php echo $party_info[0]['id'];?>" />
				</form>
				Once the item is returned, don't forget to adjust the relevant skill value.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>					
				<button id="confirm_item_return" type="submit" class="btn btn-danger" data-dismiss="modal">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true" style="padding-right: 7px"></span>
                    Confirm
                </button>
			</div>
		</div>
	</div>
</div>

<!-- Drop Equipment -->
<div class="modal fade" id="drop_equipment" tabindex="-1" role="dialog" aria-labelledby="drop_equipment" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Drop Item</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="drop_equipment_form" name="drop_equipment_form" method="POST" action="<?php echo URL; ?>log/delete_log">
					<input type="hidden" id="drop_item_id" name="drop_item_id" />
					<input type="hidden" id="drop_item_party_id" name="drop_item_party_id" value="<?php echo $party_info[0]['id'];?>" />
				</form>
				Once the item is dropped, it will be permanently removed from the party and cannot be recovered.<br />
				If the item is assigned to a character, don't forget to adjust the associated stat.
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>					
				<button id="confirm_item_drop" type="submit" class="btn btn-danger" data-dismiss="modal">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true" style="padding-right: 7px"></span>
                    Confirm
                </button>
			</div>
		</div>
	</div>
</div>

<!-- Assign equipment -->
<div class="modal fade" id="assign_item" tabindex="-1" role="dialog" aria-labelledby="assign_item" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Assign Item to Character</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="assign_item_form" id="assign_item_form" method="post" action="<?php echo URL; ?>equipment/assign_equipment">				
					<input type="hidden" id="assign_item_id" name="assign_item_id" value="" />
					<div class="row">
						Once equipment is assigned, don't forget to adjust the associated stat value.
					</div>
					<div class="row">
						<div class="col-md-6">
							<label for="new_item_name">
								Character
							</label><br />
							<select id="assign_item_character" name="assign_item_character">
								<?php
									foreach($party_characters as $character_entry) {
								?>
									<option value="<?php echo $character_entry['info']['id']; ?>"><?php echo $character_entry['info']['name'];?></option>
								<?php
									}
								?>
							</select>
						</div>
					</div>				
			    </form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>					
				<button id="confirm_item_assign" type="submit" class="btn btn-success" data-dismiss="modal">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true" style="padding-right: 7px"></span>
                    Confirm
                </button>
			</div>
		</div>
	</div>
</div>

<!-- Add army -->
<div class="modal fade" id="add_army" tabindex="-1" role="dialog" aria-labelledby="add_army" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add New Army Unit</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="add_army_form" id="add_army_form" method="post" action="<?php echo URL; ?>army/add_army">
					<input type="hidden" id="new_army_party_id" name="new_army_party_id" value="<?php echo $party_info[0]['id'];?>" />
						<div class="row">
							<div class="col-md-4">
								<label for="new_army_name">
									Unit Name:
								</label>
							</div>
							<div class="col-md-8">
								<input type="text" name="new_army_unit" id="new_army_unit" required />
							</div>
						</div>	
						<div class="row">
							<div class="col-md-4">
								<label for="new_army_name">
									Garrison:
								</label>
							</div>
							<div class="col-md-8">
								<input type="text" name="new_army_garrison" id="new_army_garrison" />
							</div>
						</div>
						<strong>			
				    	<div class="row">
				    		<div class="col-md-4">
				    			Stat
							</div>
				    		<div class="col-md-3">
				    			Current
				    		</div>
				    	</div>
				    </strong>
			    	<div class="row">
			    		<div class="col-md-4">
			    			Strength <br /> 					    			
			    		</div>
			    		<div class="col-md-3">
			    			<input name="new_army_strength" id="new_army_strength" type="number" min="0" max="99" maxlength = "2" size="1" value="0" />
			    		</div>
			    	</div>
			    	<div class="row">
			    		<div class="col-md-4">
			    			Morale <br /> 
			    		</div>
			    		<div class="col-md-3">
			    			<input name="new_army_morale" id="new_army_morale" type="number" min="0" max="99" maxlength = "2" size="1" value="0" />
			    		</div>
			    	</div>
			    	<div class="row">
			    		<div class="col-md-4">
			    			Location <br /> 
			    		</div>
			    		<div class="col-md-3">
			    			<input name="new_army_location" id="new_army_location" type="number" min="0" max="99" maxlength = "2" size="1" required />
			    		</div>
			    	</div>
			    	<div class="row">
			    		<div class="col-md-4">
			    			<strong>Unit Notes</strong>
			    		</div>
					</div>
					<div class="row">
			    		<div class="col-md-3">
			    			<textarea id="new_army_notes" name="new_army_notes"><?php echo ($character_entry['info']['notes']); ?></textarea>
			    		</div>
			    	</div>
			    </form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>					
				<button id="confirm_char_delete" type="submit" class="btn btn-success" data-dismiss="modal" onclick="add_army()">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true" style="padding-right: 7px"></span>
                    Confirm
                </button>
			</div>
		</div>
	</div>
</div>

<!-- Delete army -->
<div class="modal fade" id="delete_army" tabindex="-1" role="dialog" aria-labelledby="delete_army" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Confirm Army Unit Delete</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				There is no way to recover units once they are deleted. <br />
				<strong>If you click "Confirm", your unit will be permanently deleted.</strong>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>					
				<button id="confirm_army_delete" type="submit" class="btn btn-danger" data-dismiss="modal">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true" style="padding-right: 7px"></span>
                    Confirm
                </button>
			</div>
		</div>
	</div>
</div>

<!-- Add ship -->
<div class="modal fade" id="add_ship" tabindex="-1" role="dialog" aria-labelledby="add_ship" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add New Navy Ship</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form name="add_ship_form" id="add_ship_form" method="post" action="<?php echo URL; ?>fleet/add_ship">
					<input type="hidden" id="new_ship_party_id" name="new_ship_party_id" value="<?php echo $party_info[0]['id'];?>" />
						<div class="row">
							<div class="col-md-4">
								<label for="new_ship_name">
									Ship Name:
								</label>
							</div>
							<div class="col-md-8">
								<input type="text" name="new_ship_name" id="new_ship_name" required />
							</div>
						</div><br />	
						<strong>			
				    	<div class="row">
				    		<div class="col-md-4">
				    			Stat
							</div>
				    		<div class="col-md-3">
				    			Current
				    		</div>
				    	</div>
				    </strong>
			    	<div class="row">
			    		<div class="col-md-4">
			    			Fight <br /> 					    			
			    		</div>
			    		<div class="col-md-3">
			    			<input name="new_ship_fight" id="new_ship_fight" type="number" min="0" max="99" maxlength = "2" size="1" value="0" required/>
			    		</div>
			    	</div>
			    	<div class="row">
			    		<div class="col-md-4">
			    			Health <br /> 
			    		</div>
			    		<div class="col-md-3">
			    			<input name="new_ship_health" id="new_ship_health" type="number" min="0" max="99" maxlength = "2" size="1" value="0" required />
			    		</div>
			    	</div>
			    	<div class="row">
			    		<div class="col-md-4">
			    			Location <br /> 
			    		</div>
			    		<div class="col-md-3">
			    			<input name="new_ship_location" id="new_ship_location" type="number" min="0" max="99" maxlength = "2" size="1" required />
			    		</div>
			    	</div><br />
			    	<strong>
			    	<div class="row">
			    		<div class="col-md-4">
			    			Cargo
						</div>
			    		<div class="col-md-3">
			    			Cargo Units
			    		</div>
			    	</div>
			    	</strong>
			    	<div class="row">
			    		<div class="col-md-4">
			    			<input name="new_ship_cargo" id="new_ship_cargo" type="text" size="15" />
			    		</div>
			    		<div class="col-md-3">
			    			<input name="new_ship_cargo_units" id="new_ship_cargo_units" type="number" min="0" max="999" maxlength="3" size="1" />			    			
			    		</div>
			    	</div><br />
			    	<div class="row">
			    		<div class="col-md-4">
			    			<strong>Ships Log</strong>
			    		</div>
					</div>
					<div class="row">
			    		<div class="col-md-12">
			    			<textarea id="new_ship_notes" name="new_ship_notes"></textarea>
			    		</div>
			    	</div>
			    </form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>					
				<button id="confirm_char_delete" type="submit" class="btn btn-success" data-dismiss="modal" onclick="add_ship()">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true" style="padding-right: 7px"></span>
                    Confirm
                </button>
			</div>
		</div>
	</div>
</div>

<!-- Delete ship -->
<div class="modal fade" id="delete_ship" tabindex="-1" role="dialog" aria-labelledby="delete_ship" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Confirm Ship Delete</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				There is no way to recover ships once they are deleted. <br />
				<strong>If you click "Confirm", your ship will be permanently deleted.</strong>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>					
				<button id="confirm_ship_delete" type="submit" class="btn btn-danger" data-dismiss="modal">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true" style="padding-right: 7px"></span>
                    Confirm
                </button>
			</div>
		</div>
	</div>
</div>

<!-- Delete ship -->
<div class="modal fade" id="init_battlefield" tabindex="-1" role="dialog" aria-labelledby="init_battlefield" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Confirm Battlefield Preparation</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				This will overwrite any current battlefield status.  This status cannot be retrieved. <br />
				<strong>If you click "Confirm", your battelfield status will be reset.</strong>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>					
				<button id="confirm_battlefield_init" type="submit" class="btn btn-danger" data-dismiss="modal">
                    <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true" style="padding-right: 7px"></span>
                    Confirm
                </button>
			</div>
		</div>
	</div>
</div>