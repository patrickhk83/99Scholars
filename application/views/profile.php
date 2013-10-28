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
                    <li><a href="#info" data-toggle="tab">Overview</a></li>
                    <li><a href="#publication" data-toggle="tab">Publications (<?php echo $work_count['publication'] ?>)</a></li>
                    <li><a href="#project" data-toggle="tab">Projects (<?php echo $work_count['project'] ?>)</a></li>
                    <li><a href="#presentation" data-toggle="tab">Presentations (<?php echo $work_count['presentation'] ?>)</a></li>
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
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="well">
                                    <label class="checkbox-inline publication-criteria">
                                        <input type="checkbox" checked="check" id="journal-check"/> Journal <span class="text-muted">(12)</span>
                                    </label>
                                    <label class="checkbox-inline publication-criteria"> 
                                        <input type="checkbox" checked="check" id="conf-check"/> Conference proceeding <span class="text-muted">(2)</span>
                                    </label>
                                    <label class="checkbox-inline publication-criteria">
                                        <input type="checkbox" checked="check" id="chapter-check"/> Book chapter <span class="text-muted">(4)</span>
                                    </label>
                                    <label class="checkbox-inline publication-criteria">
                                        <input type="checkbox" checked="check" id="book-check"/> Book <span class="text-muted">(2)</span>
                                    </label>
                                </div><!--well-->
                                <div class="row" id="journal-listing-container">
                                    <div class="col-lg-12">
                                      <h4>Journals</h4>
                                      <table class="table table-striped">
                                        <tbody>
                                          <tr>
                                            <td>Cutler, A. (1976). Phoneme-monitoring reaction time as a function of preceding intonation contour.
                                            <em>Perception &amp; Psychophysics</em>, 20, 55-60.</td>
                                          </tr>
                                          <tr>
                                            <td>Cutler, A. &amp; Foss, D.J. (1977). On the role of sentence stress in sentence processing. <em>Language and Speech</em>, 20, 1-10.</td>
                                          </tr>
                                          <tr>
                                            <td>Fay, D. &amp; Cutler, A. (1977). Malapropisms and the structure of the mental lexicon. <em>Linguistic Inquiry, 8</em>,
                                            505-520.</td>
                                          </tr>
                                          <tr>
                                            <td>Cutler, A. &amp; Cooper, W.E. (1978). Phoneme-monitoring in the context of different phonetic sequences.
                                            <em>Journal of Phonetics</em>, 6, 221-225.</td>
                                          </tr>
                                          <tr>
                                            <td>Swinney, D.A. &amp; Cutler, A. (1979). The access and processing of idiomatic expressions. <em>Journal of Verbal Learning and Verbal Behavior, 18</em>, 523-534.</td>
                                          </tr>
                                          <tr>
                                            <td>Cutler, A. &amp; Fodor, J.A. (1979). Semantic focus and sentence comprehension. <em>Cognition, 7</em>, 49-59.</td>
                                          </tr>
                                          <tr>
                                            <td>Cutler, A. (1976). Phoneme-monitoring reaction time as a function of preceding intonation contour.
                                            <em>Perception &amp; Psychophysics</em>, 20, 55-60.</td>
                                          </tr>
                                          <tr>
                                            <td>Cutler, A. &amp; Foss, D.J. (1977). On the role of sentence stress in sentence processing. <em>Language and Speech</em>, 20, 1-10.</td>
                                          </tr>
                                          <tr>
                                            <td>Fay, D. &amp; Cutler, A. (1977). Malapropisms and the structure of the mental lexicon. <em>Linguistic Inquiry, 8</em>,
                                            505-520.</td>
                                          </tr>
                                          <tr>
                                            <td>Cutler, A. &amp; Cooper, W.E. (1978). Phoneme-monitoring in the context of different phonetic sequences.
                                            <em>Journal of Phonetics</em>, 6, 221-225.</td>
                                          </tr>
                                          <tr>
                                            <td>Swinney, D.A. &amp; Cutler, A. (1979). The access and processing of idiomatic expressions. <em>Journal of Verbal Learning and Verbal Behavior, 18</em>, 523-534.</td>
                                          </tr>
                                          <tr>
                                            <td>Cutler, A. &amp; Fodor, J.A. (1979). Semantic focus and sentence comprehension. <em>Cognition, 7</em>, 49-59.</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div><!--span-->
                                </div><!--/row-->
                                <div class="row" id="conf-proc-container">
                                    <div class="col-lg-12">
                                       <h4>Conference proceedings</h4>
                                       <table class="table table-striped">
                                         <tbody>
                                            <tr>
                                              <td>Cutler, A. (1974). On saying what you mean without meaning what you say. <em>Papers from the Tenth Regional Meeting, Chicago Linguistic Society</em>, 117-127.</td>
                                            </tr>
                                            <tr>
                                              <td>Cutler, A. (1977). The context-dependence of "intonational meanings". <em>Papers from the Thirteenth Regional Meeting, Chicago Linguistic Society</em>, 104-115.</td>
                                            </tr>
                                         </tbody>
                                       </table>
                                    </div><!--span-->
                                </div><!--/row-->
                                <div class="row" id="book-chapter-container">
                                    <div class="col-lg-12">
                                      <h4>Book chapters</h4>
                                      <table class="table table-striped">
                                        <tbody>
                                          <tr>
                                            <td>Cutler, A. (1976). Beyond parsing and lexical look-up. In R.J. Wales &amp; E.C.T. Walker (Eds.) <em>New
                                                                                        Approaches to Language Mechanisms</em>. Amsterdam: North-Holland; 133-149.</td>
                                          </tr>
                                          <tr>
                                            <td>Cutler, A. &amp; Fay, D.A. (1978). Introduction. In A. Cutler &amp; D.A. Fay (Eds.) Annotated re-issue of R.
                                            Meringer and C. Mayer: <em>Versprechen und Verlesen</em>. Amsterdam: John Benjamins; ix-xl.</td>
                                          </tr>
                                          <tr>
                                            <td>Cutler, A. &amp; Norris, D. (1979). Monitoring sentence comprehension. In W.E. Cooper &amp; E.C.T. Walker (Eds.) <em>Sentence Processing: Psycholinguistic Studies presented to Merrill Garrett</em>. Hillsdale, N.J.: Erlbaum; 113-134.</td>
                                          </tr>
                                          <tr>
                                            <td>Cutler, A. &amp; Isard, S.D. (1980). The production of prosody. In B. Butterworth (Ed.) <em>Language Production</em>. London: Academic Press; 245-269.</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div><!--span-->
                                </div><!--/row-->
                                <div class="row" id="book-container">
                                    <div class="col-lg-12">
                                      <h4>Books</h4>
                                      <table class="table table-striped">
                                        <tbody>
                                          <tr>
                                            <td>Cutler, A. (1975). <em>Sentence Stress and Sentence Comprehension</em>. Ph.D. dissertation. University of Texas, 1975. (Dissertation Abstracts International, 36(10-B), 5300).</td>
                                          </tr>
                                          <tr>
                                            <td>Cutler, A. &amp; Fay, D.A. (Eds.) (1978). Annotated re-issue of R. Meringer and C. Mayer: <em>Versprechen und Verlesen</em> (1895). Amsterdam: John Benjamins.</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div><!--span-->
                                </div><!--/row-->
                            </div><!--span-->
                        </div><!--/row-->
                        
                    </div>
                    <div class="tab-pane fade profile-content" id="project">
                        <div class="row">
                            <div class="col-lg-12">
                              <table class="table table-striped">
                                <tbody>
                                  <tr>
                                    <td>
                                      From Lexicon to Syntax in Childhood Bilingualism 2008-2011
                                      <ul><li class="text-muted">PI: Virginia Yip (CUHK), Co-I: Stephen Matthews (HKU) and Li Ping (Pennsylvania State University)</li></ul>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      Rethinking Cantonese grammar: typology, processing and acquisition 2007-2010, RGC Ref. No. HKU748207H
                                      <ul><li class="text-muted">PI: Stephen Matthews (HKU) Co-I: Virginia Yip (CUHK)</li></ul>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      Childhood Bilingualism and Second Language Acquisition in Hong Kong Children: 2005-2006, RGC Ref. No. CUHK4692/05H 
                                      <ul><li class="text-muted">PI: Virginia Yip(CUHK) Co-I: Stephen Matthews(HKU), Yasuhiro Shirai(Cornell University)</li></ul>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      Parsing Principles and Constituent Order in Cantonese : 2004-2006, RGC Ref. No. 7258/04H 
                                      <ul><li class="text-muted">PI: Stephen Matthews(HKU) Co-I: Elaine Francis (Purdue), Conrad Perry(HKU) and V. Yip (CUHK)</li></ul>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div><!--span-->
                        </div><!--/row-->
                    </div>
                    <div class="tab-pane fade active profile-content" id="presentation">
                        <div class="row">
                            <div class="col-lg-12">
                              <table class="table table-striped">
                                <tbody>
                                  <tr>
                                    <td>Yip, V. and S. Matthews. 2010. Cantonese as a heritage language: pedagogical implications. Invited talk given at the Heritage Language Summer Research Institute, organized by the National Heritage Resource Center, University of Hawaii, USA.</td>
                                  </tr>
                                  <tr>
                                    <td>Matthews, S. and V. Yip. 2010. Cantonese as a heritage language: vulnerable domains in bilingual acquisition. Invited talk given at the Heritage Language Summer Research Institute, organized by the National Heritage Resource Center, University of Hawaii, USA.</td>
                                  </tr>
                                  <tr>
                                    <td>Chan, A., K. Lee. and V. Yip. 2010. Assessment of Mandarin receptive vocabulary in Hong Kong children. Paper presented at the Workshop on Bilingualism and Language Acquisition, Chinese University of Hong Kong.</td>
                                  </tr>
                                  <tr>
                                    <td>Meng, H., P. Lee and V. Yip. 2010. Computer-aided language learning: applications for early childhood education. Paper presented at the Workshop on Bilingualism and Language Acquisition, Chinese University of Hong Kong.</td>
                                  </tr>
                                  <tr>
                                    <td>Yip, V. Raising bilingual children. Invited talk given at the Hong Kong Baptist University. In celebration of 50th Anniversary of Hong Kong Baptist University, Hong Kong.</td>
                                  </tr>
                                  <tr>
                                    <td>Yip, V. and S. Matthews. 2009. Cross-linguistic influence in bilingual and multilingual contexts. Invited paper presented at the International Symposium on Bilingualism (ISB7), University of Utrecht, The Netherlands.</td>
                                  </tr>
                                  <tr>
                                    <td>Yip, V, A.Chan &amp; S. Matthews. 2009. Trilingual children have a distinct linguistic profile: relative clauses in Cantonese, Mandarin and English. Paper presented at the Sixth International Conference on Third Language Acquisition and Multilingualism at the University of Bolzano, Italy.</td>
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
    <?php echo HTML::script('js/profile.js') ?>
  </body>
</html>