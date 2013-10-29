<?php include Kohana::find_file('views', 'header') ?>

<div class="row row-offcanvas row-offcanvas-right">
        
        <div class="col-lg-12">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
                    
          <div class="row">
            <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-2 col-md-2"><img src="img/profile.png" class="img-rounded"/></div><!--span-->
                <div class="col-lg-8 col-md-8">
                    <!-- Begin user's name -->
                    <h3><?php echo $first_name." ".$last_name ?></h3>
                    <!-- End user's name -->

                    <!-- Begin latest degree -->
                    <?php if(isset($latest_degree)) { ?>
                      <p><span class="text-muted">Ph.D., Linguistics, Cornell University</span><br>
                    <?php } else { ?>
                      <p><span class="text-muted"><em><a href="#">Edit your profile</a> to show your degree here</em></span><br>
                    <?php } ?>
                    <!-- End latest degree -->

                    <!-- Begin latest position -->
                    <?php if(isset($current_position)) { ?>
                      <strong>The Chinese University of Hong Kong</strong><br>
                      Professor and Chairperson, Department of Linguistics and Modern Languages<br>
                    <?php } else { ?>
                      <span class="text-muted"><em><a href="#">Edit your profile</a> to show your position here</em></span><br>
                    <?php } ?>
                    <!-- End latest position -->
                    <span class="glyphicon glyphicon-envelope"></span> <span class="glyphicon glyphicon-globe"></span> <span class="glyphicon glyphicon-phone"></span></p>
                </div><!--span-->
                <div class="col-lg-2 col-md-2">
                    <p><br></p>
                    <?php if(isset($is_owner) && ($is_owner == TRUE)) { ?>
                      <p><button class="btn btn-primary btn-block">Edit your profile</button></p>
                      <p><button class="btn btn-default btn-block">Share your profile</button></p>
                    <?php } else { ?>
                      <p><button class="btn btn-success btn-block">Follow</button></p>
                      <p><button class="btn btn-default btn-block">Send Message</button></p>
                    <?php } ?>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <br>
                  <ul class="nav nav-tabs" id="profile-tab">
                    <li><a href="#info" data-toggle="tab" id="overview-link">Overview</a></li>
                    <li><a href="#publication" data-toggle="tab" id="publication-link">Publications (<?php echo $work_count['publication'] ?>)</a></li>
                    <li><a href="#project" data-toggle="tab" id="project-link">Projects (<?php echo $work_count['project'] ?>)</a></li>
                    <li><a href="#presentation" data-toggle="tab" id="presentation-link">Presentations (<?php echo $work_count['presentation'] ?>)</a></li>
                  </ul>
                  
                  <div class="tab-content">
                    <div class="tab-pane fade active profile-content" id="info">
                        <div class="row">
                            <div class="col-lg-12">
                              <div class="row">
                                  <div class="col-lg-8 col-md-8">
                                    <!-- Begin qualifications -->
                                    <div class="user-overview-content">
                                      <h4>Qualifications</h4>
                                      <?php if(isset($degree)) { ?>
                                        <p>Ph.D., Linguistics, Cornell University, 1984<br>
                                        M.A., German linguistics, University of Melbourne, 1980<br>
                                        B.A., Psychology, University of Melbourne, 1975<br><br></p>
                                      <?php } else { ?>
                                        <p class="text-muted"><em><a href="#">Edit your profile</a> to show all your degree here</em></p>
                                      <?php } ?>
                                    </div>
                                    <!-- End qualification -->
                                    
                                    <!-- Begin user's background -->
                                    <div class="user-overview-content">
                                      <h4>Background / Research Interests</h4>
                                      <?php if(isset($background)) { ?>
                                        <p>Language acquisition; Syntax and semantics<br><br>
                                      
                                        My interests lie in the logical problem of language acquisition and syntactic/semantic acquisition, with special reference to Mandarin-speaking and Cantonese-speaking children. My acquisition research has been related to several topics.<br><br></p>
                                      <?php } else { ?>
                                        <p class="text-muted"><em><a href="#">Edit your profile</a> to show your background or research interests here</em></p>
                                      <?php } ?>
                                    </div>
                                    <!-- End user's background -->

                                    <!-- Begin recent publications -->
                                    <div class="user-overview-content">
                                      <h4>Recent Publications</h4>
                                      <?php if(isset($recent_publications)) { ?>
                                        <p>Matthews, S. and V. Yip. 2013. The emergence of quantifier scope. <em>Linguistic Approaches to Bilingualism</em> 3.3.324-329.
                                      </p>
                                      <p>Yip, V. 2013. Simultaneous language acquisition. In F. Grosjean and L. Ping (eds).<em>The Psycholinguistics of Bilingualism</em>, Wiley-Blackwell, 119-136.
                                       </p>
                                       <p>Chan, A., S. Matthews and V. Yip. 2012. <em>The acquisition of relative clauses in Cantonese and Mandarin. In Evan Kidd (ed.) The Acquisition of Relative Clauses: Processing, Typology and Function.</em> Amsterdam: John Benjamins, pp.197-226.</p>
                                        <p><button class="btn btn-default">More publications</button></p>
                                      <?php } else { ?>
                                        <p class="text-muted"><em><a href="#">Edit your profile</a> to show your recent publications here</em></p>
                                      <?php } ?>
                                    </div>
                                    <!-- End recent publication -->
                                  </div><!--span-->
                                  <div class="col-lg-4 col-md-4">
                                    <!-- Begin contact info -->
                                    <div class="well">
                                      <p><strong>Contact Information</strong></p>
                                      <?php if(isset($contact_info)) { ?>
                                        <p>Department of Linguistics and Modern Languages<br>
                                        The Chinese University of Hong Kong<br>
                                        Shatin, New Territories, Hong Kong<br>
                                        Tel: 3943-7019<br>
                                        Fax: 2603-7755<br>
                                        Email: vcymatthews@cuhk.edu.hk</p>
                                      <?php } else { ?>
                                        <p class="text-muted"><em><a href="#">Edit your profile</a> to show your contact information here</em></p>
                                      <?php } ?>
                                    </div><!--well-->
                                    <!-- End contact info -->

                                    <!-- Begin other affiliations -->
                                    <?php if(isset($other_affiliations)) { ?>
                                      <div class="well">
                                        <p><strong>Other Affiliations</strong></p>
                                        <p><a href="#"><strong>Harvard University</strong></a>, Computer Science, Faculty Member<br>
                                          <a href="#"><strong>Harvard University</strong></a>, Harvard Kennedy School of Government, Faculty Member
                                          </p>
                                         
                                      </div><!--well-->
                                    <?php }?>
                                    <!-- End other affiliations -->
                                  </div><!--span-->
                              </div><!--/row-->        
                            </div><!--span-->
                        </div><!--/row-->
                    </div>
                    <div class="tab-pane fade profile-content" id="publication">
                        
                    </div>
                    <div class="tab-pane fade profile-content" id="project">
                        
                    </div>
                    <div class="tab-pane fade active profile-content" id="presentation">
                        
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
    <?php echo HTML::script('js/profile.js') ?>
  </body>
</html>