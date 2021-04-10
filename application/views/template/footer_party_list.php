	</body>	
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<!-- Load SweetAlert 2 libraries -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert/dist/sweetalert.min.js"></script>
	<!-- Include a polyfill for ES6 Promises for IE11 -->
	<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
	<script>
		window.onload = function() {
		    var $recaptcha = document.querySelector('#g-recaptcha-response');
		
		    if($recaptcha) {
		        $recaptcha.setAttribute("required", "required");
		    }
		};
		
		function add_party()
		{
		// Form submission code from: https://www.mkyong.com/jquery/jquery-ajax-submit-a-multipart-form/
			// Stop automatic handling, we will post it manually.
			event.preventDefault();
		
			// Check the document type has been selectedIndex
			var e = document.getElementById("party_name");
			var party_name = e.value;
			
			if (party_name == false) {
				swal("No Party Name Entered", "You must enter a party name before saving.", "error");
				return;
			}
			
			// Get form
			var form = $('#add_party_form')[0];

			// Create an FormData object 
			var data = new FormData(form);
			
			// disabled the submit button
			$("#btnSubmit").prop("disabled", true);
				
			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: "<?php echo URL; ?>party/add_party",
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (data) {
					if (data.length > 0) {
						swal("Error saving", "There was an error saving the new party\nPlease try again.", "error");
						
						// Re-enable the upload button
						$("#btnSubmit").prop("disabled", false);
					} else {
						// Re-enable the upload button
						$("#btnSubmit").prop("disabled", false);
						
						// Reload the current page
						location.reload();
					}	
				},
				error: function (e) {
					swal("Error saving", "There was an error saving the new party.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
					$("#btnSubmit").prop("disabled", false);
				}
			});
		}

		function add_code()
		{
			event.preventDefault();
		
			// Check the document type has been selectedIndex
			var e = document.getElementById("party_code");
			var party_code = e.value;

			if (party_code == false) {
				swal("No Party Code Entered", "You must enter a party code before saving.", "error");
				return;
			}

			// Get form
			var form = $('#add_code_form')[0];

			// Create an FormData object 
			var data = new FormData(form);
			
			// disabled the submit button
			$("#btnSubmit").prop("disabled", true);

			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: "<?php echo URL; ?>party/add_code",
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (data) {
					if (data.length > 0) {
						swal("Error saving", "There was an error saving the code\nPlease try again.", "error");
						
						// Re-enable the upload button
						$("#btnSubmit").prop("disabled", false);
					} else {
						// Re-enable the upload button
						$("#btnSubmit").prop("disabled", false);
						
						// Reload the current page
						location.reload();
					}	
				},
				error: function (e) {
					swal("Error saving", "There was an error saving the code.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
					$("#btnSubmit").prop("disabled", false);
				}
			});
		}

		function update_party(auto_save = false)
		{
			event.preventDefault();
		
			// Check the document type has been selectedIndex
			var e = document.getElementById("party_name");
			var party_name = e.value;

			if (party_name == false) {
				swal("No Party Name Entered", "You must enter a party name before saving.", "error");
				return;
			}

			// Get form
			var form = $('#update_party_form')[0];

			// Create an FormData object 
			var data = new FormData(form);
			
			// disabled the submit button
			$("#btnSubmit").prop("disabled", true);

			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: "<?php echo URL; ?>party/update_party",
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (data) {
					if (data.length > 0) {
						swal("Error saving", "There was an error saving the changes\nPlease try again.", "error");
						
						// Re-enable the upload button
						$("#btnSubmit").prop("disabled", false);
					} else {
						// Re-enable the upload button
						$("#btnSubmit").prop("disabled", false);
						
						// If this was an auto-save, let the user know it was OK
						if (auto_save) {
							swal("Changes Saved", "Your changes have been saved", "success");
						} else {
							// Reload the current page
							location.reload();
						}
					}	
				},
				error: function (e) {
					swal("Error saving", "There was an error saving the changes.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
					$("#btnSubmit").prop("disabled", false);
				}
			});
		}

		function save_character(character_id = 0)
		{
			event.preventDefault();
		
			// Check the document type has been selectedIndex
			var e = document.getElementById("party_name");
			var party_name = e.value;

			if (party_name == false) {
				swal("No Party Name Entered", "You must enter a party name before saving.", "error");
				return;
			}

			// Get form
			var form = $('#character_form_' + character_id)[0];

			// Create an FormData object 
			var data = new FormData(form);
			
			// disabled the submit button
			$("#btnSubmit").prop("disabled", true);

			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: "<?php echo URL; ?>character/update_character",
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (data) {
					if (data.length > 0) {
						swal("Error saving", "There was an error saving the changes\nPlease try again.", "error");
						
						// Re-enable the upload button
						$("#btnSubmit").prop("disabled", false);
					} else {
						// Re-enable the upload button
						$("#btnSubmit").prop("disabled", false);
						

						swal("Changes Saved", "Your changes have been saved", "success");
					}	
				},
				error: function (e) {
					swal("Error saving", "There was an error saving the changes.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
					$("#btnSubmit").prop("disabled", false);
				}
			});
		}

		function delete_character(character_id = 0)
		{
			var $modal = $('#delete_character');

			$modal.modal({
				keyboard: true,
				show: true
			});

			$modal.on('click', '#confirm_char_delete', function(e) {
				$modal.modal('hide');
				$modal.on('hidden.bs.modal', function() {
					// Get form
					var form = $('#character_form_' + character_id)[0];

					// Create an FormData object 
					var data = new FormData(form);
					
					// disabled the submit button
					$("#btnSubmit").prop("disabled", true);

					$.ajax({
						type: "POST",
						enctype: 'multipart/form-data',
						url: "<?php echo URL; ?>character/delete_character",
						data: data,
						processData: false,
						contentType: false,
						cache: false,
						timeout: 600000,
						success: function (data) {
							if (data.length > 0) {
								swal("Error saving", "There was an error saving the changes\nPlease try again.", "error");
								
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);
							} else {
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);
								
								location.reload();
							}	
						},
						error: function (e) {
							swal("Error saving", "There was an error saving the changes.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
							$("#btnSubmit").prop("disabled", false);
						}
					});
				});
			});
		}

		function add_character()
		{
			event.preventDefault();
		
			// Check the document type has been selectedIndex
			var e = document.getElementById("new_character_name");
			var new_character_name = e.value;

			if (new_character_name == false) {
				swal("No Name Entered", "You must enter a character name before saving.", "error");
				return;
			}

			// Get form
			var form = $('#add_character_form')[0];

			// Create an FormData object 
			var data = new FormData(form);
			
			// disabled the submit button
			$("#btnSubmit").prop("disabled", true);

			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: "<?php echo URL; ?>character/add_character",
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (data) {
					if (data.length > 0) {
						swal("Error saving", "There was an error saving the code\nPlease try again.", "error");
						
						// Re-enable the upload button
						$("#btnSubmit").prop("disabled", false);
					} else {
						// Re-enable the upload button
						$("#btnSubmit").prop("disabled", false);
						
						// Reload the current page
						location.reload();
					}	
				},
				error: function (e) {
					swal("Error saving", "There was an error saving the code.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
					$("#btnSubmit").prop("disabled", false);
				}
			});
		}

		function add_log_entry()
		{
			event.preventDefault();
		
			// Check the document type has been selectedIndex
			var e = document.getElementById("new_log_comments");
			var new_character_name = e.value;

			if (new_character_name == false) {
				swal("No Comments Entered", "You must enter a comment before saving.", "error");
				return;
			}

			// Get form
			var form = $('#add_log_form')[0];

			// Create an FormData object 
			var data = new FormData(form);
			
			// disabled the submit button
			$("#btnSubmit").prop("disabled", true);

			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: "<?php echo URL; ?>log/add_log",
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (data) {
					if (data.length > 0) {
						swal("Error saving", "There was an error saving the code\nPlease try again.", "error");
						
						// Re-enable the upload button
						$("#btnSubmit").prop("disabled", false);
					} else {
						// Re-enable the upload button
						$("#btnSubmit").prop("disabled", false);
						
						// Reload the current page
						location.reload();
					}	
				},
				error: function (e) {
					swal("Error saving", "There was an error saving the code.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
					$("#btnSubmit").prop("disabled", false);
				}
			});
		}

		function edit_log_entry(log_id = 0)
		{
			var $modal = $('#edit_log');

			var comment_src = document.getElementById("log_comment_" + log_id);
			var location_src = document.getElementById("log_location_" + log_id);
			var complete_src = document.getElementById("completed_" + log_id);

			var comment_dest = document.getElementById("edit_log_comments");
			var location_dest = document.getElementById("edit_log_location");
			var complete_dest = document.getElementById("edit_log_completed");
			var log_id_dest = document.getElementById("edit_log_id");

			comment_dest.value = comment_src.innerText;
			location_dest.value = location_src.innerText;
			complete_dest.checked = complete_src.checked;
			log_id_dest.value = log_id;

			$modal.modal({
				keyboard: true,
				show: true
			});

			$modal.on('click', '#confirm_log_edit', function(e) {
				$modal.modal('hide');
				$modal.on('hidden.bs.modal', function() {
					// Get form
					var form = $('#edit_log_form')[0];

					// Create an FormData object 
					var data = new FormData(form);
					
					// disabled the submit button
					$("#btnSubmit").prop("disabled", true);

					$.ajax({
						type: "POST",
						enctype: 'multipart/form-data',
						url: "<?php echo URL; ?>log/update_log",
						data: data,
						processData: false,
						contentType: false,
						cache: false,
						timeout: 600000,
						success: function (data) {
							if (data.length > 0) {
								swal("Error saving", "There was an error saving the changes\nPlease try again.", "error");
								
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);
							} else {
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);
								
								location.reload();
							}	
						},
						error: function (e) {
							swal("Error saving", "There was an error saving the changes.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
							$("#btnSubmit").prop("disabled", false);
						}
					});
				});
			});
		}

		function delete_log_entry(log_id = 0)
		{
			var $modal = $('#delete_log');

			var log_id_dest = document.getElementById("delete_log_id");

			log_id_dest.value = log_id;

			$modal.modal({
				keyboard: true,
				show: true
			});

			$modal.on('click', '#confirm_log_delete', function(e) {
				$modal.modal('hide');
				$modal.on('hidden.bs.modal', function() {
					// Get form
					var form = $('#delete_log_form')[0];

					// Create an FormData object 
					var data = new FormData(form);
					
					// disabled the submit button
					$("#btnSubmit").prop("disabled", true);

					$.ajax({
						type: "POST",
						enctype: 'multipart/form-data',
						url: "<?php echo URL; ?>log/delete_log",
						data: data,
						processData: false,
						contentType: false,
						cache: false,
						timeout: 600000,
						success: function (data) {
							if (data.length > 0) {
								swal("Error saving", "There was an error saving the changes\nPlease try again.", "error");
								
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);
							} else {
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);
								
								location.reload();
							}	
						},
						error: function (e) {
							swal("Error saving", "There was an error saving the changes.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
							$("#btnSubmit").prop("disabled", false);
						}
					});
				});
			});
		}

		function add_equipment()
		{
			event.preventDefault();
		
			// Check the document type has been selectedIndex
			var e = document.getElementById("new_item_name");
			var new_item_name = e.value;

			if (new_item_name == false) {
				swal("No Name Entered", "You must enter an item name before saving.", "error");
				return;
			}

			// Get form
			var form = $('#add_item_form')[0];

			// Create an FormData object 
			var data = new FormData(form);
			
			// disabled the submit button
			$("#btnSubmit").prop("disabled", true);

			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: "<?php echo URL; ?>equipment/add_equipment",
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (data) {
					if (data.length > 0) {
						swal("Error saving", "There was an error saving the item\nPlease try again.", "error");
						
						// Re-enable the upload button
						$("#btnSubmit").prop("disabled", false);
					} else {
						// Re-enable the upload button
						$("#btnSubmit").prop("disabled", false);
						
						// Reload the current page
						location.reload();
					}	
				},
				error: function (e) {
					swal("Error saving", "There was an error saving the item.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
					$("#btnSubmit").prop("disabled", false);
				}
			});
		}

		function add_character_equipment(character_id = 0)
		{
			// Items assigned to users do not have a party ID
			$('#new_item_party_id').val( '');
			$('#new_item_character_id').val(character_id);

			// Once the correct ID's have been assigned, show the form for input
			$('#add_item').modal({
				keyboard: true,
				show: true
			});
		}

		function return_item(item_id = 0)
		{
			var $modal = $('#return_equipment');

			$('#return_item_id').val(item_id);

			$modal.modal({
				keyboard: true,
				show: true
			});

			$modal.on('click', '#confirm_item_return', function(e) {
				$modal.modal('hide');
				$modal.on('hidden.bs.modal', function() {
					// Get form
					var form = $('#return_equipment_form')[0];

					// Create an FormData object 
					var data = new FormData(form);
					
					// disabled the submit button
					$("#btnSubmit").prop("disabled", true);

					$.ajax({
						type: "POST",
						enctype: 'multipart/form-data',
						url: "<?php echo URL; ?>equipment/return_to_valut",
						data: data,
						processData: false,
						contentType: false,
						cache: false,
						timeout: 600000,
						success: function (data) {
							if (data.length > 0) {
								swal("Error saving", "There was an error saving the changes\nPlease try again.", "error");
								
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);
							} else {
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);
								
								location.reload();
							}	
						},
						error: function (e) {
							swal("Error saving", "There was an error saving the changes.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
							$("#btnSubmit").prop("disabled", false);
						}
					});
				});
			});
		}

		function drop_item(item_id = 0)
		{
			var $modal = $('#drop_equipment');

			$('#drop_item_id').val(item_id);

			$modal.modal({
				keyboard: true,
				show: true
			});

			$modal.on('click', '#confirm_item_drop', function(e) {
				$modal.modal('hide');
				$modal.on('hidden.bs.modal', function() {
					// Get form
					var form = $('#drop_equipment_form')[0];

					// Create an FormData object 
					var data = new FormData(form);
					
					// disabled the submit button
					$("#btnSubmit").prop("disabled", true);

					$.ajax({
						type: "POST",
						enctype: 'multipart/form-data',
						url: "<?php echo URL; ?>equipment/drop_equipment",
						data: data,
						processData: false,
						contentType: false,
						cache: false,
						timeout: 600000,
						success: function (data) {
							if (data.length > 0) {
								swal("Error saving", "There was an error saving the changes\nPlease try again.", "error");
								
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);
							} else {
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);
								
								location.reload();
							}	
						},
						error: function (e) {
							swal("Error saving", "There was an error saving the changes.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
							$("#btnSubmit").prop("disabled", false);
						}
					});
				});
			});
		}

		function assign_item(item_id = 0)
		{
			var $modal = $('#assign_item');

			$('#assign_item_id').val(item_id);

			$modal.modal({
				keyboard: true,
				show: true
			});

			$modal.on('click', '#confirm_item_assign', function(e) {
				$modal.modal('hide');
				$modal.on('hidden.bs.modal', function() {
					// Get form
					var form = $('#assign_item_form')[0];

					// Create an FormData object 
					var data = new FormData(form);
					
					// disabled the submit button
					$("#btnSubmit").prop("disabled", true);

					$.ajax({
						type: "POST",
						enctype: 'multipart/form-data',
						url: "<?php echo URL; ?>equipment/assign_equipment",
						data: data,
						processData: false,
						contentType: false,
						cache: false,
						timeout: 600000,
						success: function (data) {
							if (data.length > 0) {
								swal("Error saving", "There was an error saving the changes\nPlease try again.", "error");
								
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);
							} else {
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);
								
								location.reload();
							}	
						},
						error: function (e) {
							swal("Error saving", "There was an error saving the changes.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
							$("#btnSubmit").prop("disabled", false);
						}
					});
				});
			});
		}

		function add_army()
		{
			event.preventDefault();
		
			// Check the document type has been selectedIndex
			var e = document.getElementById("new_army_unit");
			var f = document.getElementById("new_army_location");

			var new_army_unit = e.value;
			var new_army_location = f.value;

			if (new_army_unit == false) {
				swal("No Unit Name Entered", "You must enter a unit name before saving.", "error");
				return;
			}

			if (new_army_location == false) {
				swal("No Unit Location Entered", "You must enter the location where the unit was recruited before saving.", "error");
				return;
			}

			// Get form
			var form = $('#add_army_form')[0];

			// Create an FormData object 
			var data = new FormData(form);
			
			// disabled the submit button
			$("#btnSubmit").prop("disabled", true);

			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: "<?php echo URL; ?>armies/add_army",
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (data) {
					if (data.length > 0) {
						swal("Error saving", "There was an error saving the unit\nPlease try again.", "error");
						
						// Re-enable the upload button
						$("#btnSubmit").prop("disabled", false);
					} else {
						// Re-enable the upload button
						$("#btnSubmit").prop("disabled", false);
						
						// Reload the current page
						location.reload();
					}	
				},
				error: function (e) {
					swal("Error saving", "There was an error saving the unit.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
					$("#btnSubmit").prop("disabled", false);
				}
			});
		}

		function save_army(army_id = 0)
		{
			event.preventDefault();
		
			// Get form
			var form = $('#army_form_' + army_id)[0];

			// Create an FormData object 
			var data = new FormData(form);
			
			// disabled the submit button
			$("#btnSubmit").prop("disabled", true);

			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: "<?php echo URL; ?>armies/update_army",
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (data) {
					if (data.length > 0) {
						swal("Error saving", "There was an error saving the changes\nPlease try again.", "error");
						
						// Re-enable the upload button
						$("#btnSubmit").prop("disabled", false);
					} else {
						// Re-enable the upload button
						$("#btnSubmit").prop("disabled", false);
						

						swal("Changes Saved", "Your changes have been saved", "success");
					}	
				},
				error: function (e) {
					swal("Error saving", "There was an error saving the changes.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
					$("#btnSubmit").prop("disabled", false);
				}
			});
		}

		function delete_army(army_id = 0)
		{
			var $modal = $('#delete_army');

			$modal.modal({
				keyboard: true,
				show: true
			});
			
			$modal.on('click', '#confirm_army_delete', function(e) {
				$modal.modal('hide');
				$modal.on('hidden.bs.modal', function() {
					// Get form
					var form = $('#army_form_' + army_id)[0];

					// Create an FormData object 
					var data = new FormData(form);
					
					// disabled the submit button
					$("#btnSubmit").prop("disabled", true);

					$.ajax({
						type: "POST",
						enctype: 'multipart/form-data',
						url: "<?php echo URL; ?>armies/delete_army",
						data: data,
						processData: false,
						contentType: false,
						cache: false,
						timeout: 600000,
						success: function (data) {
							if (data.length > 0) {
								swal("Error saving", "There was an error saving the changes\nPlease try again.", "error");
								
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);
							} else {
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);
								
								location.reload();
							}	
						},
						error: function (e) {
							swal("Error saving", "There was an error saving the changes.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
							$("#btnSubmit").prop("disabled", false);
						}
					});
				});
			});
		}

		function add_ship()
		{
			event.preventDefault();
		
			// Check the document type has been selectedIndex
			var e = document.getElementById("new_ship_name");
			var f = document.getElementById("new_ship_location");
			var g = document.getElementById("new_ship_fight");
			var h = document.getElementById("new_ship_health");

			var new_ship_name = e.value;
			var new_ship_location = f.value;
			var new_ship_fight = g.value;
			var new_ship_health = h.value;

			if (new_ship_name == false) {
				swal("No Ship Name Entered", "You must enter a ship name before saving.", "error");
				return;
			}

			if (new_ship_location == false) {
				swal("No Ship Location Entered", "You must enter the location where the ship is docked before saving.", "error");
				return;
			}

			if (new_ship_fight == false) {
				swal("No Fight Value Entered", "You must enter the fight value before saving.", "error");
				return;
			}

			if (new_ship_health == false) {
				swal("No Health Value Entered", "You must enter the health value before saving.", "error");
				return;
			}

			// Get form
			var form = $('#add_ship_form')[0];

			// Create an FormData object 
			var data = new FormData(form);
			
			// disabled the submit button
			$("#btnSubmit").prop("disabled", true);

			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: "<?php echo URL; ?>fleet/add_ship",
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (data) {
					if (data.length > 0) {
						swal("Error saving", "There was an error saving the ship\nPlease try again.", "error");
						
						// Re-enable the upload button
						$("#btnSubmit").prop("disabled", false);
					} else {
						// Re-enable the upload button
						$("#btnSubmit").prop("disabled", false);
						
						// Reload the current page
						location.reload();
					}	
				},
				error: function (e) {
					swal("Error saving", "There was an error saving the ship.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
					$("#btnSubmit").prop("disabled", false);
				}
			});
		}

		function save_ship(ship_id = 0)
		{
			event.preventDefault();
		
			// Get form
			var form = $('#ship_form_' + ship_id)[0];

			// Create an FormData object 
			var data = new FormData(form);
			
			// disabled the submit button
			$("#btnSubmit").prop("disabled", true);

			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: "<?php echo URL; ?>fleet/update_ship",
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (data) {
					if (data.length > 0) {
						swal("Error saving", "There was an error saving the changes\nPlease try again.", "error");
						
						// Re-enable the upload button
						$("#btnSubmit").prop("disabled", false);
					} else {
						// Re-enable the upload button
						$("#btnSubmit").prop("disabled", false);
						

						swal("Changes Saved", "Your changes have been saved", "success");
					}	
				},
				error: function (e) {
					swal("Error saving", "There was an error saving the changes.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
					$("#btnSubmit").prop("disabled", false);
				}
			});
		}

		function delete_ship(ship_id = 0)
		{
			var $modal = $('#delete_ship');

			$modal.modal({
				keyboard: true,
				show: true
			});
			
			$modal.on('click', '#confirm_ship_delete', function(e) {
				$modal.modal('hide');
				$modal.on('hidden.bs.modal', function() {
					// Get form
					var form = $('#ship_form_' + ship_id)[0];

					// Create an FormData object 
					var data = new FormData(form);
					
					// disabled the submit button
					$("#btnSubmit").prop("disabled", true);

					$.ajax({
						type: "POST",
						enctype: 'multipart/form-data',
						url: "<?php echo URL; ?>fleet/delete_ship",
						data: data,
						processData: false,
						contentType: false,
						cache: false,
						timeout: 600000,
						success: function (data) {
							if (data.length > 0) {
								swal("Error saving", "There was an error saving the changes\nPlease try again.", "error");
								
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);
							} else {
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);
								
								location.reload();
							}	
						},
						error: function (e) {
							swal("Error saving", "There was an error saving the changes.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
							$("#btnSubmit").prop("disabled", false);
						}
					});
				});
			});
		}

		function init_battlefield(party_id = 0)
		{
			var $modal = $('#init_battlefield');

			$modal.modal({
				keyboard: true,
				show: true
			});

			$modal.on('click', '#confirm_battlefield_init', function(e) {
				$modal.modal('hide');
				$modal.on('hidden.bs.modal', function() {
					$.ajax({
						type: "POST",
						enctype: 'multipart/form-data',
						url: "<?php echo URL; ?>battlefield/initialise_battlefield/" + party_id,
						processData: false,
						contentType: false,
						cache: false,
						timeout: 600000,
						success: function (data) {
							if (data.length > 0) {
								swal("Error preparing", "There was an error preparing the battlefield\nPlease try again.", "error");
							} else {
								location.reload();
							}	
						},
						error: function (e) {
							swal("Error preparing", "There was an error preparing the battlefield.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
						}
					});
				});
			});
		}

		function update_battlefield(type = "")
		{
			event.preventDefault();
		
			// Get form
			var form = $('#battlefield_form_' + type)[0];

			// Create an FormData object 
			var data = new FormData(form);

			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: "<?php echo URL; ?>battlefield/update_battlefield",
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (data) {
					if (data.length > 0) {
						swal("Error saving", "There was an error saving the changes\nPlease try again.", "error");
					} else {					
						swal("Changes Saved", "Your changes have been saved", "success");
					}	
				},
				error: function (e) {
					swal("Error saving", "There was an error saving the changes.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
				}
			});
		}
		
		function add_character_spell(character_id = 0)
		{
			var $modal = $('#add_spell');
			$('#new_spell_character_id').val(character_id);
			
			$modal.modal({
				keyboard: true,
				show: true
			});
			
			$modal.on('click', '#confirm_add_spell', function(e) {
				$modal.modal('hide');
				$modal.on('hidden.bs.modal', function() {
					// Get form
					var form = $('#add_spell_form')[0];
		
					// Create an FormData object 
					var data = new FormData(form);
					
					// disabled the submit button
					$("#btnSubmit").prop("disabled", true);
					
					$.ajax({
						type: "POST",
						enctype: 'multipart/form-data',
						url: "<?php echo URL; ?>spells/add_spell",
						data: data,
						processData: false,
						contentType: false,
						cache: false,
						timeout: 600000,
						success: function (data) {
							if (data.length > 0) {
								swal("Error saving", "There was an error saving the spell\nPlease try again.", "error");
								
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);
							} else {
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);
								
								// Reload the current page
								location.reload();
							}	
						},
						error: function (e) {
							swal("Error saving", "There was an error saving the spell.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
							$("#btnSubmit").prop("disabled", false);
						}
					});
				});
			});
		}
	
		function use_spell(spell_id = 0)
		{
			var $modal = $('#use_spell');
			$('#spell_id').val(spell_id);
			
			$modal.modal({
				keyboard: true,
				show: true
			});
			
			$modal.on('click', '#confirm_use_spell', function(e) {
				$modal.modal('hide');
				$modal.on('hidden.bs.modal', function() {
					// Get form
					var form = $('#use_spell_form')[0];
		
					// Create an FormData object 
					var data = new FormData(form);
					
					// disabled the submit button
					$("#btnSubmit").prop("disabled", true);
					
					$.ajax({
						type: "POST",
						enctype: 'multipart/form-data',
						url: "<?php echo URL; ?>spells/use_spell",
						data: data,
						processData: false,
						contentType: false,
						cache: false,
						timeout: 600000,
						success: function (data) {
							if (data.length > 0) {
								swal("Error saving", "There was an error saving the spell\nPlease try again.", "error");
								
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);
							} else {
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);

								// Reload the current page
								location.reload();
							}	
						},
						error: function (e) {
							swal("Error saving", "There was an error saving the spell.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
							$("#btnSubmit").prop("disabled", false);
						}
					});
				});
			});
		}
		
		function forget_spell(spell_id = 0)
		{
			var $modal = $('#forget_spell');

			$('#forget_spell_id').val(spell_id);

			$modal.modal({
				keyboard: true,
				show: true
			});

			$modal.on('click', '#confirm_forget_spell', function(e) {
				$modal.modal('hide');
				$modal.on('hidden.bs.modal', function() {
					// Get form
					var form = $('#forget_spell_form')[0];

					// Create an FormData object 
					var data = new FormData(form);
					
					// disabled the submit button
					$("#btnSubmit").prop("disabled", true);

					$.ajax({
						type: "POST",
						enctype: 'multipart/form-data',
						url: "<?php echo URL; ?>spells/delete_spell",
						data: data,
						processData: false,
						contentType: false,
						cache: false,
						timeout: 600000,
						success: function (data) {
							if (data.length > 0) {
								swal("Error saving", "There was an error forgetting the spell\nPlease try again.", "error");
								
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);
							} else {
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);
								
								location.reload();
							}	
						},
						error: function (e) {
							swal("Error saving", "There was an error forgetting the spell.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
							$("#btnSubmit").prop("disabled", false);
						}
					});
				});
			});
		}
		
		function recharge_spell(spell_id = 0)
		{
			var $modal = $('#recharge_spell');
			$('#recharge_spell_id').val(spell_id);
			
			$modal.modal({
				keyboard: true,
				show: true
			});
			
			$modal.on('click', '#confirm_recharge_spell', function(e) {
				$modal.modal('hide');
				$modal.on('hidden.bs.modal', function() {
					// Get form
					var form = $('#recharge_spell_form')[0];
		
					// Create an FormData object 
					var data = new FormData(form);
					
					// disabled the submit button
					$("#btnSubmit").prop("disabled", true);
					
					$.ajax({
						type: "POST",
						enctype: 'multipart/form-data',
						url: "<?php echo URL; ?>spells/recharge_spell",
						data: data,
						processData: false,
						contentType: false,
						cache: false,
						timeout: 600000,
						success: function (data) {
							if (data.length > 0) {
								swal("Error saving", "There was an error saving the spell\nPlease try again.", "error");
								
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);
							} else {
								// Re-enable the upload button
								$("#btnSubmit").prop("disabled", false);

								// Reload the current page
								location.reload();
							}	
						},
						error: function (e) {
							swal("Error saving", "There was an error saving the spell.  The error was:\n" + e.responseText + "\nPlease try again.", "error");
							$("#btnSubmit").prop("disabled", false);
						}
					});
				});
			});
		}
	</script>
</html>
