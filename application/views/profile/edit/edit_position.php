<div class="row">
    <div class="col-lg-12">
      <div class="row">
          <div class="col-lg-4">
            <div class="add-profile-form">
              <form role="form" id="position-form">
                <div class="form-group">
                  <label for="position-title">Title</label>
                  <input type="text" class="form-control" id="position-title" name="title">
                </div>
                <div class="form-group">
                    <label for="position-department">Department</label>
                    <input type="text" class="form-control" id="position-department" name="department">
                </div>
                <div class="form-group">
                    <label for="position-institute">Institute</label>
                    <input type="text" class="form-control" id="position-institute" name="institute">
                </div>
                <div class="form-group">
                    <label for="position-from">From</label>
                    <select class="form-control" id="position-from" name="from">
                      <?php for($i=1970; $i<2014; $i++) { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="position-to">To</label>
                    <select class="form-control" id="position-to" name="to">
                      <?php for($i=1970; $i<2014; $i++) { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                    </select>
                </div>
                <button type="button" class="btn btn-success" id="add-position-btn">Add position</button>
              </form>
            </div>
          </div><!--span-->
      </div><!--/row-->
      <table class="table table-striped">
        <tbody id="position-container">
          <tr>
            <td>Professor and Chairperson<br><span class="text-muted">Department of Linguistics and Modern Languages, The Chinese University of Hong Kong</span></td>
            <td><span class="glyphicon glyphicon-pencil"></span></td>
            <td><span class="glyphicon glyphicon-trash"></span></td>
          </tr>
        </tbody>
      </table>
    </div><!--span-->
</div><!--/row-->