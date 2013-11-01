<div class="row">
  <div class="col-lg-12">
  	<div class="row">
	    <div class="col-lg-4">
	      <div class="add-profile-form">
	      	<form role="form" id="journal-form">
	      		<input type="hidden" name="has_coauthor" value="0">
	      	  	<div class="form-group">
				    <label for="journal-title">Title</label>
				    <input type="text" class="form-control" id="journal-title" name="title">
				</div>
				<div class="form-group">
				    <label for="journal">Journal</label>
				    <input type="text" class="form-control" id="journal" name="journal">
				</div>
				<div class="form-group">
				    <label for="journal-status">Journal Status</label>
				    <select class="form-control" id="journal-status" name="status">
				    	<option value="p">Published</option>
				    	<option value="s">Submitted</option>
				    	<option value="r">Revising</option>
				    	<option value="a">Accepted</option>
				    	<option value="t">To Appear</option>
				    </select>
				</div>
				<div class="form-group">
				    <label for="journal-year">Year</label>
				    <select class="form-control" id="journal-year" name="year">
                      <?php for($i=1970; $i<2014; $i++) { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                    </select>
				</div>
				<div class="form-group">
				    <label for="journal-volume">Volume</label>
				    <input type="text" class="form-control" id="journal-volume" name="volume">
				</div>
				<div class="form-group">
				    <label for="journal-issue">Issue</label>
				    <input type="text" class="form-control" id="journal-issue" name="issue">
				</div>
				<div class="form-group">
				    <label for="journal-start">Start Page</label>
				    <input type="text" class="form-control" id="journal-start" name="start">
				</div>
				<div class="form-group">
				    <label for="journal-end">End Page</label>
				    <input type="text" class="form-control" id="journal-end" name="end">
				</div>
				<div class="form-group">
				    <label for="journal-link">Link</label>
				    <input type="text" class="form-control" id="journal-link" name="link">
				</div>
				<button type="button" class="btn btn-success" id="add-journal-btn">Add journal</button>
	      	</form>
	      </div>
	    </div><!--span-->
	</div><!--/row-->
  	<table class="table table-striped">
            <tbody>
              <tr>
                <td>Cutler, A. (1976). Phoneme-monitoring reaction time as a function of preceding intonation contour.
                <em>Perception &amp; Psychophysics</em>, 20, 55-60.</td>
                <td><span class="glyphicon glyphicon-pencil"></span></td>
                <td><span class="glyphicon glyphicon-trash"></span></td>
              </tr>
              <tr>
                <td>Cutler, A. &amp; Foss, D.J. (1977). On the role of sentence stress in sentence processing. <em>Language and Speech</em>, 20, 1-10.</td>
                <td><span class="glyphicon glyphicon-pencil"></span></td>
                <td><span class="glyphicon glyphicon-trash"></span></td>
              </tr>
              <tr>
                <td>Fay, D. &amp; Cutler, A. (1977). Malapropisms and the structure of the mental lexicon. <em>Linguistic Inquiry, 8</em>,
                505-520.</td>
                <td><span class="glyphicon glyphicon-pencil"></span></td>
                <td><span class="glyphicon glyphicon-trash"></span></td>
              </tr>
              <tr>
                <td>Cutler, A. &amp; Cooper, W.E. (1978). Phoneme-monitoring in the context of different phonetic sequences.
                <em>Journal of Phonetics</em>, 6, 221-225.</td>
                <td><span class="glyphicon glyphicon-pencil"></span></td>
                <td><span class="glyphicon glyphicon-trash"></span></td>
              </tr>
              <tr>
                <td>Swinney, D.A. &amp; Cutler, A. (1979). The access and processing of idiomatic expressions. <em>Journal of Verbal Learning and Verbal Behavior, 18</em>, 523-534.</td>
                <td><span class="glyphicon glyphicon-pencil"></span></td>
                <td><span class="glyphicon glyphicon-trash"></span></td>
              </tr>
              <tr>
                <td>Cutler, A. &amp; Fodor, J.A. (1979). Semantic focus and sentence comprehension. <em>Cognition, 7</em>, 49-59.</td>
                <td><span class="glyphicon glyphicon-pencil"></span></td>
                <td><span class="glyphicon glyphicon-trash"></span></td>
              </tr>
              <tr>
                <td>Cutler, A. (1976). Phoneme-monitoring reaction time as a function of preceding intonation contour.
                <em>Perception &amp; Psychophysics</em>, 20, 55-60.</td>
                <td><span class="glyphicon glyphicon-pencil"></span></td>
                <td><span class="glyphicon glyphicon-trash"></span></td>
              </tr>
              <tr>
                <td>Cutler, A. &amp; Foss, D.J. (1977). On the role of sentence stress in sentence processing. <em>Language and Speech</em>, 20, 1-10.</td>
                <td><span class="glyphicon glyphicon-pencil"></span></td>
                <td><span class="glyphicon glyphicon-trash"></span></td>
              </tr>
              <tr>
                <td>Fay, D. &amp; Cutler, A. (1977). Malapropisms and the structure of the mental lexicon. <em>Linguistic Inquiry, 8</em>,
                505-520.</td>
                <td><span class="glyphicon glyphicon-pencil"></span></td>
                <td><span class="glyphicon glyphicon-trash"></span></td>
              </tr>
              <tr>
                <td>Cutler, A. &amp; Cooper, W.E. (1978). Phoneme-monitoring in the context of different phonetic sequences.
                <em>Journal of Phonetics</em>, 6, 221-225.</td>
                <td><span class="glyphicon glyphicon-pencil"></span></td>
                <td><span class="glyphicon glyphicon-trash"></span></td>
              </tr>
              <tr>
                <td>Swinney, D.A. &amp; Cutler, A. (1979). The access and processing of idiomatic expressions. <em>Journal of Verbal Learning and Verbal Behavior, 18</em>, 523-534.</td>
                <td><span class="glyphicon glyphicon-pencil"></span></td>
                <td><span class="glyphicon glyphicon-trash"></span></td>
              </tr>
              <tr>
                <td>Cutler, A. &amp; Fodor, J.A. (1979). Semantic focus and sentence comprehension. <em>Cognition, 7</em>, 49-59.</td>
                <td><span class="glyphicon glyphicon-pencil"></span></td>
                <td><span class="glyphicon glyphicon-trash"></span></td>
              </tr>
            </tbody>
          </table>
  </div><!--span-->
</div><!--/row-->