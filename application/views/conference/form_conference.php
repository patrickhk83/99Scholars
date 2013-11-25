<div class="form-group">
  <label for="conf-name">Conference's Name</label>
  <input type="text" class="form-control required" id="conf-name" placeholder="Enter name of the conference" name="Conference[name]"/>	
</div>

<div class="form-group">
  <label>Duration</label>
  <div class="form-inline">
    <div class="form-group">
      <input type="text" class="form-control datepicker required" id="start-date" placeholder="22-09-2013" name="Conference[start_date]" data-date-format="dd/mm/yyyy"/>
    </div>
    <div class="form-group">
      to
    </div>
    <div class="form-group">
      <input type="text" class="form-control datepicker required" id="end-date" placeholder="24/09/2013" name="Conference[end_date]" data-date-format="dd/mm/yyyy"/>
    </div>
  </div>
</div>

<div class="form-group">
  <label>Description</label>
  <textarea class="form-control required" rows="4" placeholder="What your conference is about?" name="Conference[description]"></textarea>
</div>

<div class="form-group">
  <label>Registration Period</label>
  <div class="form-inline">
    <div class="form-group">
      <input type="text" class="form-control datepicker" id="regis-start" placeholder="22/09/2013" name="Registration[start_date]" data-date-format="dd/mm/yyyy"/>
    </div>
    <div class="form-group">
      to
    </div>
    <div class="form-group">
      <input type="text" class="form-control datepicker" id="regis-end" placeholder="24/09/2013" name="Registration[end_date]" data-date-format="dd/mm/yyyy"/>
    </div>
  </div>
</div>

<div class="form-group">
  <label>Organizer</label>
  <input type="text" class="form-control required" id="organizer-name" placeholder="Name of the organizer" name="Organization[name]"/>
</div>

<div class="form-group">
  <label>Website</label>
  <input type="text" class="form-control" id="website" placeholder="URL of conference's website" name="Conference[website]"/>
</div>

<div class="form-group">
  <label>Category</label>
    <div id="conf-category">
      <div id="category1">
        <div class="form-inline">
          <div class="form-group">
          	<select class="form-control category-option required" name="Category[1][category]">
          	  <option value="">Choose Conference's Category</option>
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
  <label>Deadline For Abstracts/Proposals</label>
  <input type="text" class="form-control datepicker" id="deadline" placeholder="10/09/2013" name="Conference[deadline]" data-date-format="dd/mm/yyyy"/>
</div>

<div class="form-group">
  <label>Notification of Acceptance</label>
  <input type="text" class="form-control datepicker" id="accept_notify" placeholder="10/09/2013" name="Conference[accept_notify]" data-date-format="dd/mm/yyyy"/>
</div>


<div class="form-group">
  <label>Contact Person</label>
  <input type="text" class="form-control required" id="contact-person" placeholder="Name of contact person" name="Conference[contact_person]"/>
</div>

<div class="form-group">
  <label>Contact Email</label>
  <input type="email" class="form-control required" id="contact-email" placeholder="Email for contact" name="Conference[contact_email]"/>
</div>