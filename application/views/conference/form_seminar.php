<script>
  var suggest_url = "<?php echo URL::site('conference/suggest_tag');?>";
  var add_tag_url = "<?php echo URL::site('conference/new_tag');?>";
</script>

<div class="form-group">
  <label for="conf-name">Title of the talk</label>
  <input type="text" class="form-control required" id="conf-name" placeholder="Enter the title of the talk" name="Conference[name]"/>	
</div>

<div class="form-group">
  <label>Date</label>
  <div class="form-inline">
    <div class="form-group">
      <input type="text" class="form-control datepicker required" id="start-date" placeholder="22/09/2013" name="Conference[start_date]" data-date-format="dd/mm/yyyy"/>
    </div>
  </div>
</div>

<div class="form-group">
  <label>Speaker</label>
  <input type="text" class="form-control required" name="Seminar[speaker]">
</div>

<div class="form-group">
  <label>Abstract</label>
  <textarea class="form-control" rows="4" name="Seminar[abstract]"></textarea>
</div>

<div class="form-group">
  <label>Description</label>
  <textarea class="form-control" rows="4" placeholder="What your seminar is about?" name="Conference[description]"></textarea>
</div>

<div class="form-group">
  <label>Organizer</label>
  <input type="text" class="form-control required" id="organizer-name" placeholder="Name of the organizer" name="Organization[name]"/>
</div>

<div class="form-group">
  <label>Website</label>
  <input type="text" class="form-control" id="website" placeholder="URL of the seminar website" name="Conference[website]"/>
</div>

<div class="form-group">
  <label>Category</label>
    <div id="conf-category">
      <div id="category1">
        <div class="form-inline">
          <div class="form-group">
          	<select class="form-control category-option required" name="Category[1][category]">
          	  <option value="">Choose Seminar's Category </option>
          	  <option value="1">Technology</option>
          	  <option value="2">Linguistics</option>
          	  <option value="3">Psychology</option>
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
      <p class="form-control-static" style="margin-bottom: 6px;"><b>Selected Tags</b></p>
      <div class="well" style="overflow:auto; height:130px; padding:0;">
        <ul id="list_selected_tag" class="list-group">
        </ul>  
      </div>
    </div>   
  </div>   
</div>  

<div class="form-group">
  <label>Contact Person</label>
  <input type="text" class="form-control required" id="contact-person" placeholder="Name of contact person" name="Conference[contact_person]"/>
</div>

<div class="form-group">
  <label>Contact Email</label>
  <input type="email" class="form-control required" id="contact-email" placeholder="Email for contact" name="Conference[contact_email]"/>
</div>