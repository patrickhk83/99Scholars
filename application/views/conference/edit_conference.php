<?php include Kohana::find_file('views', 'header') ?>
	<script>
		var suggest_url = "<?php echo URL::site('conference/suggest_tag');?>";
		var add_tag_url = "<?php echo URL::site('conference/new_tag');?>";
	</script>  
	<div class="row row-offcanvas row-offcanvas-right">
		<div class="col-xs- col-sm-12 col-lg-8 col-md-8 col-lg-offset-2 col-md-offset-2">
			<p class="pull-right visible-xs">
				<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
			</p>
			<div class="row">
				<div class="col-lg-12">
					<p>
						<h3>Submit your academic event</h3>
					</p>
					<p>Enter information about your academic event</p>		
					<form name="edit-conference" id="edit-conference" role="form" action="<?php echo URL::site('conference/update_conference'); ?>" method="post">
						<div class="panel panel-default">
							<div class="panel-heading">General Information</div>
							<div class="panel-body">
								<div id="form-body">
									<div class="form-group">
  										<label for="conf-name">Conference's Name</label>
  										<input type="text" class="form-control required" id="conf-name" placeholder="Enter name of the conference" name="Conference[name]" value="<?php if(isset($conference_name) && !empty($conference_name)) echo $conference_name; ?>"/>	
									</div>

									<div class="form-group">
										<label>Duration</label>
										<div class="form-inline">
											<div class="form-group">
												<input type="text" class="form-control datepicker required" id="start-date" placeholder="22-09-2013" name="Conference[start_date]" data-date-format="dd/mm/yyyy" value="<?php if(isset($start_date) && !empty($start_date)) echo $start_date; ?>"/>
											</div>
											<div class="form-group">
												to
											</div>
											<div class="form-group">
												<input type="text" class="form-control datepicker required" id="end-date" placeholder="24/09/2013" name="Conference[end_date]" data-date-format="dd/mm/yyyy" value="<?php if(isset($end_date) && !empty($end_date)) echo $end_date; ?>"/>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label>Description</label>
										<textarea class="form-control required" rows="4" placeholder="What your conference is about?" name="Conference[description]"><?php if(isset($description) && !empty($description)) echo $description; ?></textarea>
									</div>

									<div class="form-group">
										<label>Registration Period</label>
										<div class="form-inline">
											<div class="form-group">
												<input type="text" class="form-control datepicker" id="regis-start" placeholder="22/09/2013" name="Registration[start_date]" data-date-format="dd/mm/yyyy" value="<?php if(isset($reg_start_date) && !empty($reg_start_date)) echo $reg_start_date; ?>"/>
											</div>
											<div class="form-group">
												to
											</div>
											<div class="form-group">
												<input type="text" class="form-control datepicker" id="regis-end" placeholder="24/09/2013" name="Registration[end_date]" data-date-format="dd/mm/yyyy" value="<?php if(isset($reg_end_date) && !empty($reg_end_date)) echo $reg_end_date; ?>"/>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label>Organizer</label>
										<input type="text" class="form-control required" id="organizer-name" placeholder="Name of the organizer" name="Organization[name]" value="<?php if(isset($organizer) && !empty($organizer)) echo $organizer; ?>" />
									</div>

									<div class="form-group">
										<label>Website</label>
										<input type="text" class="form-control" id="website" placeholder="URL of conference's website" name="Conference[website]" value="<?php if(isset($website) && !empty($website)) echo $website; ?>" />
									</div>

									<div class="form-group">
										<label>Category</label>
										<div id="conf-category">
											<div id="category1">
												<div class="form-inline">
													<div class="form-group">
														<select class="form-control category-option required" name="Category[1][category]">
															<option value="">Choose Seminar's Category </option>
															<option value="1" <?php if($category == 1) echo "selected"; ?>>Technology</option>
															<option value="2" <?php if($category == 2) echo "selected"; ?>>Linguistics</option>
															<option value="3" <?php if($category == 3) echo "selected"; ?>>Psychology</option>
														</select>
													</div>
													<div class="form-group">

													</div>
												</div>
											</div>
										</div>
										<div><a href="#" id="add-category-btn">Add more category</a></div>
									</div>

									<div class="form-group">
										<label>Tags</label>
										<div class="row">
											<div class="col-md-6">
												<input type="text" class="form-control" placeholder="Input Conference's Tags" id="autocomplete_tags">
												<div class="well" id="list_suggest_tag" style="overflow:auto; height:130px; padding:0;"></div>  
											</div> 
											<div class="col-md-6">
												<p class="form-control-static" style="margin-bottom: 6px;">
													<b>Selected Tags</b>
												</p>
												<div class="well" style="overflow:auto; height:130px; padding:0;">
													<ul id="list_selected_tag" class="list-group">
														<?php
															foreach($tags as $tag)
															{
																echo "<li class='list-group-item' id='li_tag".$tag['id']."'>";
																echo "<div class='row'>";
																echo "<input type='hidden' name='selectedTag[".$tag['id']."][tag_id]' value='".$tag['id']."'>";
																echo "<div class='col-lg-10'><p>".$tag['tag_name']."</p></div>";
																echo "<div class='col-lg-2'>";
																echo "<span class='glyphicon glyphicon-minus-sign del-category-btn' onclick='deleteSelectedTag(".$tag['id'].")'></span>";
																echo "</div></div></li>";
															}
														?>
													</ul>  
												</div>
											</div>   
										</div>   
									</div>  

									<div class="form-group">
										<label>Deadline For Abstracts/Proposals</label>
										<input type="text" class="form-control datepicker" id="deadline" placeholder="10/09/2013" name="Conference[deadline]" data-date-format="dd/mm/yyyy" value="<?php if(isset($deadline) && !empty($deadline)) echo $deadline; ?>"/>
									</div>

									<div class="form-group">
										<label>Notification of Acceptance</label>
										<input type="text" class="form-control datepicker" id="accept_notify" placeholder="10/09/2013" name="Conference[accept_notify]" data-date-format="dd/mm/yyyy" value="<?php if(isset($accept_notify) && !empty($accept_notify)) echo $accept_notify; ?>"/>
									</div>

									<div class="form-group">
										<label>Contact Person</label>
										<input type="text" class="form-control required" id="contact-person" placeholder="Name of contact person" name="Conference[contact_person]" value="<?php if(isset($contact_person) && !empty($contact_person)) echo $contact_person; ?>"/>
									</div>

									<div class="form-group">
										<label>Contact Email</label>
										<input type="email" class="form-control required" id="contact-email" placeholder="Email for contact" name="Conference[contact_email]"  value="<?php if(isset($contact_email) && !empty($contact_email)) echo $contact_email; ?>"/>
									</div>

								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">Venue's Address</div>
							<div class="panel-body">
								<div class="form-group">
									<label>Venue Name</label>
									<input type="text" class="form-control required" id="venue-name" placeholder="Name of the venue (e.g., University, Hotel, Convention centre) " name="Venue[name]" value="<?php if(isset($venue) && !empty($venue)) echo $venue; ?>"/>
								</div>

								<div class="form-group">
									<label>Address</label>
									<input type="text" class="form-control" id="address" placeholder="Address of the venue" name="Address[address]" value="<?php if(isset($address) && !empty($address)) echo $address; ?>"/>
								</div>

								<div class="form-group">
									<label>City</label>
									<input type="text" class="form-control required" id="city" placeholder="City" name="Address[city]"  value="<?php if(isset($city) && !empty($city)) echo $city; ?>"/>
								</div>

								<div class="form-group">
									<label>State/Province</label>
									<input type="text" class="form-control" id="state" placeholder="State/Province" name="Address[state]"  value="<?php if(isset($state) && !empty($state)) echo $state; ?>"/>
								</div>

								<div class="form-group">
									<label>Postal Code</label>
									<input type="text" class="form-control digits" id="postal-code" placeholder="Postal Code" name="Address[postal_code]" value="<?php if(isset($postal_code) && !empty($postal_code)) echo $postal_code; ?>"/>
								</div>

								<div class="form-group">
									<label>Country</label>
									<select class="form-control required" name="Address[country]">
										<option value="">Choose Country</option>
										<?php 
											foreach($countries as $short_name => $full_name){ ?>
												<option value="<?= $short_name ?>" <?php if($short_name == $country->get('code')) echo "selected"; ?>><?= $full_name; ?></option>
											<? } ?>
									</select>
								</div>
							</div>
						</div>
						<input type="hidden" name="Conference[id]" value="<? if(isset($conference_id) && !empty($conference_id)) echo $conference_id; else echo "-1"; ?>" />
						<p><button type="submit" class="btn btn-success">Save Event</button> or <a href="#">Cancel</a></p>
					</form>	
				</div>
			</div>
		</div>
	</div>
	<hr>
	<footer>
		<p>&copy; 99Scholars 2013</p>
	</footer>
</div>

<?php echo HTML::script('js/jquery.js') ?>
<?php echo HTML::script('js/jquery-ui.js') ?>
<?php echo HTML::script('js/bootstrap.min.js') ?>
<?php echo HTML::script('js/offcanvas.js') ?>
<?php echo HTML::script('js/bootstrap-datepicker.js') ?>
<?php echo HTML::script('js/jquery.validate.min.js') ?>
<?php echo HTML::script('js/edit_conference.js') ?>

</body>
</html>					