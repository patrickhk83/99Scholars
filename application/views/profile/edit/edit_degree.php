<div class="row">
    <div class="col-lg-12">
      <div class="row">
          <div class="col-lg-4">
            <div class="add-profile-form">
              <form role="form" id="degree-form">
                <div class="form-group">
                  <label for="degree-type">Degree Type</label>
                  <select class="form-control" id="degree-type" name="degree_type">
                    <option value="1">B.A.</option>
                    <option value="2">M.A.</option>
                    <option value="3">Ph.D.</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="major">Major</label>
                  <input type="text" class="form-control" id="major" name="major">
                </div>
                <div class="form-group">
                  <label for="graduated-university">University</label>
                  <input type="text" class="form-control" id="graduated-university" name="university">
                </div>
                <div class="form-group">
                  <label for="graduated-year">Year</label>
                  <select class="form-control" id="graduated-year" name="year">
                    <?php for($i=1970; $i<2014; $i++) { ?>
                      <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                  </select>
                </div>
                <button type="button" class="btn btn-success" id="add-degree-btn">Add degree</button>
              </form>
            </div>
          </div><!--span-->
      </div><!--/row-->
      <table class="table table-striped">
        <tbody id="degree-container">
          <?php if(isset($degrees)) { ?>
            <?php foreach ($degrees as $degree) { ?>
              <tr>
                <td><?php echo $degree['type'].', '.$degree['major'].', '.$degree['university'].', '.$degree['year'] ?></td>
                <td><span class="glyphicon glyphicon-pencil"></span></td>
                <td><span class="glyphicon glyphicon-trash"></span></td>
              </tr>
            <?php } ?>
          <?php }?> 
        </tbody>
      </table>
    </div><!--span-->
</div><!--/row-->