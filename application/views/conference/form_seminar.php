<div class="form-group">
  <label for="conf-name">Seminar's Name</label>
  <input type="text" class="form-control required" id="conf-name" placeholder="Enter name of the conference" name="name"/>	
</div>

<div class="form-group">
  <label>Date</label>
  <div class="form-inline">
    <div class="form-group">
      <input type="text" class="form-control datepicker required" id="start-date" placeholder="22/09/2013" name="start_date" data-date-format="dd/mm/yyyy"/>
    </div>
  </div>
</div>

<div class="form-group">
  <label>Speaker</label>
  <input type="text" class="form-control required" name="speaker">
</div>

<div class="form-group">
  <label>Abstract</label>
  <textarea class="form-control required" rows="4" name="abstract"></textarea>
</div>

<div class="form-group">
  <label>Description</label>
  <textarea class="form-control required" rows="4" placeholder="What your seminar is about?" name="description"></textarea>
</div>

<!--div class="form-group">
  <label>Registration Period</label>
  <div class="form-inline">
    <div class="form-group">
      <input type="text" class="form-control datepicker" id="regis-start" placeholder="22/09/2013" name="regis_start" data-date-format="dd/mm/yyyy"/>
    </div>
    <div class="form-group">
      to
    </div>
    <div class="form-group">
      <input type="text" class="form-control datepicker" id="regis-end" placeholder="24/09/2013" name="regis_end" data-date-format="dd/mm/yyyy"/>
    </div>
  </div>
</div-->

<div class="form-group">
  <label>Organizer</label>
  <input type="text" class="form-control required" id="organizer-name" placeholder="Name of the organizer" name="organizer"/>
</div>

<div class="form-group">
  <label>Website</label>
  <input type="text" class="form-control required" id="website" placeholder="URL of conference's website" name="website"/>
</div>

<div class="form-group">
  <label>Category</label>
    <div id="conf-category">
      <div id="category1">
        <div class="form-inline">
          <div class="form-group">
          	<select class="form-control category-option required" name="category[option1]">
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
  <label>Contact Person</label>
  <input type="text" class="form-control required" id="contact-person" placeholder="Name of contact person" name="contact_person"/>
</div>

<div class="form-group">
  <label>Contact Email</label>
  <input type="email" class="form-control required" id="contact-email" placeholder="Email for contact" name="contact_email"/>
</div>