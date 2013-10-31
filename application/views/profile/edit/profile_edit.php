<?php include Kohana::find_file('views', 'header') ?>

<div class="row row-offcanvas row-offcanvas-right">
        
        <div class="col-lg-12">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
                    
          <div class="row">
            <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-10 col-md-10">
                	<h3>Edit your profile</h3>
                	<p class="text-muted">Make people see more of your work</p>
                </div><!--span-->
                <div class="col-lg-2 col-md-2">
                	<p><br></p>
                	<p><a href="<?php echo URL::site('profile') ?>"><button class="btn btn-primary btn-block">Done editing</button></a></p>
                </div><!--span-->
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <br>
                  <ul class="nav nav-tabs" id="profile-tab">
                    <li><a href="#info" data-toggle="tab">General information</a></li>
                    <li><a href="#degree" data-toggle="tab">Degree</a></li>
                    <li><a href="#position" data-toggle="tab">Position</a></li>
                    <li><a href="#journal" data-toggle="tab">Journals</a></li>
                    <li><a href="#conf-proc" data-toggle="tab">Conference Proceedings</a></li>
                    <li><a href="#chapter" data-toggle="tab">Book Chapters</a></li>
                    <li><a href="#book" data-toggle="tab">Books</a></li>
                    <li><a href="#project" data-toggle="tab">Projects</a></li>
                    <li><a href="#presentation" data-toggle="tab">Presentations</a></li>
                  </ul>
                  
                  <div class="tab-content">
                    <div class="tab-pane fade active profile-content" id="info">
                    	<div class="row">
                    	    <div class="col-lg-6">
                    	      <form role="form" id="gen-info-form">
	                    	      <div class="user-overview-content">
	                    	      	<h4>Personal Information</h4>
	                    	      	<input type="hidden" name="user_id" value="<?php echo $user['id'] ?>"/>
	                    	      	<div class="form-group">
	                    	      	  <label for="first-name">First Name</label>
	                    	      	  <input type="text" class="form-control" name="first_name" id="first-name" value="<?php echo $user['first_name'] ?>"/>
	                    	      	</div>
	                    	      	<div class="form-group">
	                    	      	  <label for="last-name">Last Name</label>
	                    	      	  <input type="text" class="form-control" name="last_name" id="last-name" value="<?php echo $user['last_name'] ?>"/>
	                    	      	</div>
	                    	      	<div class="form-group">
	                    	      	  <label for="birth-date">Date of Birth</label>
	                    	      	  <input type="text" class="form-control datepicker" name="birth_date" id="birth-date" value="<?php echo $user['birth_date'] ?>" data-date-format="dd/mm/yyyy"/>
	                    	      	</div>
	                    	      </div>
	                    	      <div class="user-overview-content">
	                    	      	<h4>Background / Research Interests</h4>
	                    	      	<textarea class="form-control" rows="5" name="background"><?php echo $user['background'] ?></textarea>
	                    	      </div>
	                     	      <div class="user-overview-content">
	                    	      	<h4>Contact Information</h4>
	                    	      	<!--div class="form-group">
	                    	      	  <label for="address">Address</label>
	                    	      	  <textarea class="form-control" rows="3" name="address"></textarea>
	                    	      	</div-->
	                    	      	<div class="form-group">
	                    	      	  <label for="tel">Tel</label>
	                    	      	  <input type="text" class="form-control" name="tel" id="tel" value="<?php echo $user['contact']['tel'] ?>"/>
	                    	      	</div>
	                    	      	<div class="form-group">
	                    	      	  <label for="fax">Fax</label>
	                    	      	  <input type="text" class="form-control" name="fax" id="fax" value="<?php echo $user['contact']['fax'] ?>"/>
	                    	      	</div>
	                    	      	<div class="form-group">
	                    	      	  <label for="email">Email</label>
	                    	      	  <input type="text" class="form-control" name="email" id="email" value="<?php echo $user['contact']['email'] ?>"/>
	                    	      	</div>
	                    	      	<div class="form-group">
	                    	      	  <label for="website">Website</label>
	                    	      	  <input type="text" class="form-control" name="website" id="website" value="<?php echo $user['contact']['website'] ?>"/>
	                    	      	</div>
	                    	      </div>
	                    	      <button type="button" class="btn btn-default" id="gen-info-save-btn">Save</button>
                    	      </form>
                    	    </div><!--span-->
                    	</div><!--/row-->
                    </div>
                    <div class="tab-pane fade profile-content" id="degree">
                      <div class="row">
                          <div class="col-lg-12">
                            <p><button class="btn btn-success">Add degree</button></p>
                            <table class="table table-striped">
                              <tbody>
                                <tr>
                                  <td>M.A., German linguistics, University of Melbourne, 1980</td>
                                  <td><span class="glyphicon glyphicon-pencil"></span></td>
                                  <td><span class="glyphicon glyphicon-trash"></span></td>
                                </tr>
                                <tr>
                                  <td>B.A., Psychology, University of Melbourne, 1975</td>
                                  <td><span class="glyphicon glyphicon-pencil"></span></td>
                                  <td><span class="glyphicon glyphicon-trash"></span></td>
                                </tr>
                              </tbody>
                            </table>
                          </div><!--span-->
                      </div><!--/row-->
                    </div>
                    <div class="tab-pane fade profile-content" id="position">
                      <div class="row">
                          <div class="col-lg-12">
                            <p><button class="btn btn-success">Add position</button></p>
                            <table class="table table-striped">
                              <tbody>
                                <tr>
                                  <td>Professor and Chairperson<br><span class="text-muted">Department of Linguistics and Modern Languages, The Chinese University of Hong Kong</span></td>
                                  <td><span class="glyphicon glyphicon-pencil"></span></td>
                                  <td><span class="glyphicon glyphicon-trash"></span></td>
                                </tr>
                              </tbody>
                            </table>
                          </div><!--span-->
                      </div><!--/row-->
                    </div>
                    <div class="tab-pane fade profile-content" id="journal">
                      <div class="row">
                          <div class="col-lg-12">
                          	<p><button class="btn btn-success">Add journal</button></p>
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
                    </div>
                    <div class="tab-pane fade profile-content" id="conf-proc">
                      <div class="row">
                          <div class="col-lg-12">
                            <p><button class="btn btn-success">Add conference proceeding</button></p>
                            <table class="table table-striped">
                             <tbody>
                                <tr>
                                  <td>Cutler, A. (1974). On saying what you mean without meaning what you say. <em>Papers from the Tenth Regional Meeting, Chicago Linguistic Society</em>, 117-127.</td>
                                  <td><span class="glyphicon glyphicon-pencil"></span></td>
                                  <td><span class="glyphicon glyphicon-trash"></span></td>
                                </tr>
                                <tr>
                                  <td>Cutler, A. (1977). The context-dependence of "intonational meanings". <em>Papers from the Thirteenth Regional Meeting, Chicago Linguistic Society</em>, 104-115.</td>
                                  <td><span class="glyphicon glyphicon-pencil"></span></td>
                                  <td><span class="glyphicon glyphicon-trash"></span></td>
                                </tr>
                             </tbody>
                           </table>
                          </div><!--span-->
                      </div><!--/row-->
                    </div>
                    <div class="tab-pane fade profile-content" id="chapter">
                      <div class="row">
                          <div class="col-lg-12">
                            <p><button class="btn btn-success">Add book chapter</button></p>
                            <table class="table table-striped">
                            <tbody>
                              <tr>
                                <td>Cutler, A. (1976). Beyond parsing and lexical look-up. In R.J. Wales &amp; E.C.T. Walker (Eds.) <em>New
                                                                            Approaches to Language Mechanisms</em>. Amsterdam: North-Holland; 133-149.</td>
								<td><span class="glyphicon glyphicon-pencil"></span></td>
								<td><span class="glyphicon glyphicon-trash"></span></td>
                              </tr>
                              <tr>
                                <td>Cutler, A. &amp; Fay, D.A. (1978). Introduction. In A. Cutler &amp; D.A. Fay (Eds.) Annotated re-issue of R.
                                Meringer and C. Mayer: <em>Versprechen und Verlesen</em>. Amsterdam: John Benjamins; ix-xl.</td>
                                <td><span class="glyphicon glyphicon-pencil"></span></td>
                                <td><span class="glyphicon glyphicon-trash"></span></td>
                              </tr>
                              <tr>
                                <td>Cutler, A. &amp; Norris, D. (1979). Monitoring sentence comprehension. In W.E. Cooper &amp; E.C.T. Walker (Eds.) <em>Sentence Processing: Psycholinguistic Studies presented to Merrill Garrett</em>. Hillsdale, N.J.: Erlbaum; 113-134.</td>
                                <td><span class="glyphicon glyphicon-pencil"></span></td>
                                <td><span class="glyphicon glyphicon-trash"></span></td>
                              </tr>
                              <tr>
                                <td>Cutler, A. &amp; Isard, S.D. (1980). The production of prosody. In B. Butterworth (Ed.) <em>Language Production</em>. London: Academic Press; 245-269.</td>
                                <td><span class="glyphicon glyphicon-pencil"></span></td>
                                <td><span class="glyphicon glyphicon-trash"></span></td>
                              </tr>
                            </tbody>
                          </table>          
                          </div><!--span-->
                      </div><!--/row-->
                    </div>
                    <div class="tab-pane fade profile-content" id="book">
                      <div class="row">
                          <div class="col-lg-12">
                            <p><button class="btn btn-success">Add book</button></p>
                            <table class="table table-striped">
                            <tbody>
                              <tr>
                                <td>Cutler, A. (1975). <em>Sentence Stress and Sentence Comprehension</em>. Ph.D. dissertation. University of Texas, 1975. (Dissertation Abstracts International, 36(10-B), 5300).</td>
                                <td><span class="glyphicon glyphicon-pencil"></span></td>
                                <td><span class="glyphicon glyphicon-trash"></span></td>
                              </tr>
                              <tr>
                                <td>Cutler, A. &amp; Fay, D.A. (Eds.) (1978). Annotated re-issue of R. Meringer and C. Mayer: <em>Versprechen und Verlesen</em> (1895). Amsterdam: John Benjamins.</td>
                                <td><span class="glyphicon glyphicon-pencil"></span></td>
                                <td><span class="glyphicon glyphicon-trash"></span></td>
                              </tr>
                            </tbody>
                          </table>
                          </div><!--span-->
                      </div><!--/row-->
                    </div>
                    <div class="tab-pane fade profile-content" id="project">
                    	<div class="row">
                    	    <div class="col-lg-12">
                    	      <p><button class="btn btn-success">Add project</button></p>
                    	      <table class="table table-striped">
                    	      	<tbody>
                    	      	  <tr>
                    	      	  	<td>
                    	      	  	  From Lexicon to Syntax in Childhood Bilingualism 2008-2011
                    	      	  	  <ul><li class="text-muted">PI: Virginia Yip (CUHK), Co-I: Stephen Matthews (HKU) and Li Ping (Pennsylvania State University)</li></ul>
                    	      	  	</td>
                    	      	  	<td><span class="glyphicon glyphicon-pencil"></span></td>
                    	      	  	<td><span class="glyphicon glyphicon-trash"></span></td>
                    	      	  </tr>
                    	      	  <tr>
                    	      	  	<td>
                    	      	  	  Rethinking Cantonese grammar: typology, processing and acquisition 2007-2010, RGC Ref. No. HKU748207H
                    	      	  	  <ul><li class="text-muted">PI: Stephen Matthews (HKU) Co-I: Virginia Yip (CUHK)</li></ul>
                    	      	  	</td>
                    	      	  	<td><span class="glyphicon glyphicon-pencil"></span></td>
                    	      	  	<td><span class="glyphicon glyphicon-trash"></span></td>
                    	      	  </tr>
                    	      	  <tr>
                    	      	  	<td>
                    	      	  	  Childhood Bilingualism and Second Language Acquisition in Hong Kong Children: 2005-2006, RGC Ref. No. CUHK4692/05H 
                    	      	  	  <ul><li class="text-muted">PI: Virginia Yip(CUHK) Co-I: Stephen Matthews(HKU), Yasuhiro Shirai(Cornell University)</li></ul>
                    	      	  	</td>
                    	      	  	<td><span class="glyphicon glyphicon-pencil"></span></td>
                    	      	  	<td><span class="glyphicon glyphicon-trash"></span></td>
                    	      	  </tr>
                    	      	  <tr>
                    	      	  	<td>
                    	      	  	  Parsing Principles and Constituent Order in Cantonese : 2004-2006, RGC Ref. No. 7258/04H 
                    	      	  	  <ul><li class="text-muted">PI: Stephen Matthews(HKU) Co-I: Elaine Francis (Purdue), Conrad Perry(HKU) and V. Yip (CUHK)</li></ul>
                    	      	  	</td>
                    	      	  	<td><span class="glyphicon glyphicon-pencil"></span></td>
                    	      	  	<td><span class="glyphicon glyphicon-trash"></span></td>
                    	      	  </tr>
                    	      	</tbody>
                    	      </table>
                    	    </div><!--span-->
                    	</div><!--/row-->
                    </div>
                    <div class="tab-pane fade active profile-content" id="presentation">
                   		<div class="row">
                   		    <div class="col-lg-12">
                   		      <p><button class="btn btn-success">Add presentation</button></p>
                   		      <table class="table table-striped">
                   		      	<tbody>
                   		      	  <tr>
                   		      	    <td>Yip, V. and S. Matthews. 2010. Cantonese as a heritage language: pedagogical implications. Invited talk given at the Heritage Language Summer Research Institute, organized by the National Heritage Resource Center, University of Hawaii, USA.</td>
                   		      	    <td><span class="glyphicon glyphicon-pencil"></span></td>
                   		      	    <td><span class="glyphicon glyphicon-trash"></span></td>
                   		      	  </tr>
                   		      	  <tr>
                   		      	    <td>Matthews, S. and V. Yip. 2010. Cantonese as a heritage language: vulnerable domains in bilingual acquisition. Invited talk given at the Heritage Language Summer Research Institute, organized by the National Heritage Resource Center, University of Hawaii, USA.</td>
                   		      	    <td><span class="glyphicon glyphicon-pencil"></span></td>
                   		      	    <td><span class="glyphicon glyphicon-trash"></span></td>
                   		      	  </tr>
                   		      	  <tr>
                   		      	    <td>Chan, A., K. Lee. and V. Yip. 2010. Assessment of Mandarin receptive vocabulary in Hong Kong children. Paper presented at the Workshop on Bilingualism and Language Acquisition, Chinese University of Hong Kong.</td>
                   		      	    <td><span class="glyphicon glyphicon-pencil"></span></td>
                   		      	    <td><span class="glyphicon glyphicon-trash"></span></td>
                   		      	  </tr>
                   		      	  <tr>
                   		      	    <td>Meng, H., P. Lee and V. Yip. 2010. Computer-aided language learning: applications for early childhood education. Paper presented at the Workshop on Bilingualism and Language Acquisition, Chinese University of Hong Kong.</td>
                   		      	    <td><span class="glyphicon glyphicon-pencil"></span></td>
                   		      	    <td><span class="glyphicon glyphicon-trash"></span></td>
                   		      	  </tr>
                   		      	  <tr>
                   		      	    <td>Yip, V. Raising bilingual children. Invited talk given at the Hong Kong Baptist University. In celebration of 50th Anniversary of Hong Kong Baptist University, Hong Kong.</td>
                   		      	    <td><span class="glyphicon glyphicon-pencil"></span></td>
                   		      	    <td><span class="glyphicon glyphicon-trash"></span></td>
                   		      	  </tr>
                   		      	  <tr>
                   		      	    <td>Yip, V. and S. Matthews. 2009. Cross-linguistic influence in bilingual and multilingual contexts. Invited paper presented at the International Symposium on Bilingualism (ISB7), University of Utrecht, The Netherlands.</td>
                   		      	    <td><span class="glyphicon glyphicon-pencil"></span></td>
                   		      	    <td><span class="glyphicon glyphicon-trash"></span></td>
                   		      	  </tr>
                   		      	  <tr>
                   		      	    <td>Yip, V, A.Chan &amp; S. Matthews. 2009. Trilingual children have a distinct linguistic profile: relative clauses in Cantonese, Mandarin and English. Paper presented at the Sixth International Conference on Third Language Acquisition and Multilingualism at the University of Bolzano, Italy.</td>
                   		      	    <td><span class="glyphicon glyphicon-pencil"></span></td>
                   		      	    <td><span class="glyphicon glyphicon-trash"></span></td>
                   		      	  </tr>
                   		      	</tbody>
                   		      </table>
                   		    </div><!--span-->
                   		</div><!--/row-->
                    </div>
                  </div>
                </div>  
              </div><!--row-->
            </div><!--/span-->            
          </div><!--/row-->
        </div><!--/span-->

      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Company 2013</p>
      </footer>

    </div><!--/.container-->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php echo HTML::script('js/jquery.js') ?>
    <?php echo HTML::script('js/bootstrap.min.js') ?>
    <?php echo HTML::script('js/offcanvas.js') ?>
    <?php echo HTML::script('js/bootstrap-datepicker.js') ?>
    <?php echo HTML::script('js/profile_edit.js') ?>
  </body>
</html>