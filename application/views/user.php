<?php include Kohana::find_file('views', 'header') ?>
<div class="row row-offcanvas row-offcanvas-right">
        
        <div class="col-lg-12">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
                    
          <div class="row">
            <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-2 col-md-2"><img src="img/001.jpg" class="img-rounded"/></div><!--span-->
                <div class="col-lg-8 col-md-8">
                	<h3>Patrick Chu</h3>
                	<p><span class="text-muted">Ph.D., Psychology, University of New South Wales, 2013</span><br>
                	<span class="glyphicon glyphicon-envelope"></span> <span class="glyphicon glyphicon-globe"></span> <span class="glyphicon glyphicon-phone"></span></p>
                </div><!--span-->
                <div class="col-lg-2 col-md-2">
                	<p><br></p>
                	<p><button class="btn btn-success btn-block">Follow</button></p>
                	<p><button class="btn btn-default btn-block">Send Message</button></p>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <br>
                  <ul class="nav nav-tabs" id="profile-tab">
                    <li><a href="#info" data-toggle="tab">Overview</a></li>
                    <li><a href="#event" data-toggle="tab">Events</a></li>
                    <li><a href="#publication" data-toggle="tab">Publications (15)</a></li>
                    <li><a href="#project" data-toggle="tab">Projects (4)</a></li>
                    <li><a href="#presentation" data-toggle="tab">Presentations (28)</a></li>
                  </ul>
                  
                  <div class="tab-content">
                    
                    <div class="tab-pane fade active profile-content" id="info">
                    	<div class="row">
                    	    <div class="col-lg-12">
                    	      <div class="row">
                    	          <div class="col-lg-8 col-md-8">
                    	          	<h4>Qualifications</h4>
                    	          	<p>Ph.D., Psychology, University of New South Wales, 2013 <br>
                    	          	B.A., Linguistics, Chinese University of Hong Kong, 2006<br><br>
                    	          	</p>
                    	          	<h4>Research Interests</h4>
                    	          	<p><br><br></p>
                    	            <h4>Recent Publications</h4>
                    	            <p></p>
                    	          </div><!--span-->
                    	          <div class="col-lg-4 col-md-4">
                    	            <div class="well">
                    	              <p><strong>Contact Information</strong></p>
                    	              <p>Tel: 852-51373793 <br>
                                        Fax: <br>
                                        Email: patrick@99scholars.net<br>
                                        Website: <a href="http://patrickchu.net/" target="_blank">http://patrickchu.net/</a></p>
                    	              <br><br><br>
                    	            </div><!--well-->
                    	            <!--div class="well">
                    	            	<p><strong>Other Affiliations</strong></p>
                    	            	<p><a href="#"><strong>Harvard University</strong></a>, Computer Science, Faculty Member<br>
                    	            	  <a href="#"><strong>Harvard University</strong></a>, Harvard Kennedy School of Government, Faculty Member
                    	            	  </p>
                    	            	 
                    	            </div-->
                    	          </div><!--span-->
                    	      </div><!--/row-->        
                    	    </div><!--span-->
                    	</div><!--/row-->
                    </div>
                    <div class="tab-pane fade active profile-content" id="event">
                        <div class="row">
                            <div class="col-lg-12">
                              
                              <div class="row conf-list">
                                <div class="col-lg-12">
                                  <div class="row">
                                    <div class="col-lg-8">
                                      <p><strong><a href="<?php echo URL::site('seminar') ?>">4th Global Conference: Performance: Visual Aspects of Performance Practice</a></strong> <br/> Oxford, United Kingdom</p>
                                    </div>
                                    <!--div class="col-lg-2"><button type="button" class="btn btn-primary btn-xs">Conference</button></div-->
                                    <div class="col-lg-2">19 Sep 2013</div>
                                    <div class="col-lg-2"><a class="btn btn-info btn-block" href="#">Book</a></div>
                                  </div><!--/row-->
                                  
                                  <div class="row">
                                    <div class="col-lg-8">
                                      <p><strong><a href="<?php echo URL::site('seminar') ?>">The Best in Heritage 2013</a></strong> <br/> Dubrovnik, Croatia</p>
                                    </div>
                                    <!--div class="col-lg-2"><button type="button" class="btn btn-success btn-xs">Seminar</button></div-->
                                    <div class="col-lg-2">19 Sep 2013</div>
                                    <div class="col-lg-2"><a class="btn btn-info btn-block" href="#">Book</a></div>
                                  </div><!--/row-->
                                  
                                  <div class="row">
                                    <div class="col-lg-8">
                                      <p><strong><a href="<?php echo URL::site('seminar') ?>">2nd Global Conference: The Graphic Novel</a></strong> <br/> Oxford, United Kingdom</p>
                                    </div>
                                    <!--div class="col-lg-2"><button type="button" class="btn btn-primary btn-xs">Conference</button></div-->
                                    <div class="col-lg-2">19 Sep 2013</div>
                                    <div class="col-lg-2"><a class="btn btn-info btn-block" href="#">Book</a></div>
                                  </div><!--/row-->
                                  </div><!--span-->
                              </div><!--row-->
                            </div><!--span-->
                        </div><!--/row-->
                    </div>
                    <div class="tab-pane fade profile-content" id="publication">
                    	<div class="row">
                    	    <div class="col-lg-12">
                    	    	<div class="well">
                    	    		<label class="checkbox-inline publication-criteria">
                    	    			<input type="checkbox" checked="check" id="journal-check"/> Journal <span class="text-muted">(1)</span>
                    	    		</label>
                    	    		<label class="checkbox-inline publication-criteria"> 
                    	    			<input type="checkbox" checked="check" id="conf-check"/> Conference proceeding <span class="text-muted">(7)</span>
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
                    	    	      	  	<td>Chu, P.  Aspectual Asymmetries in the Mental Representation of Events: Role of Lexical and Grammatical Aspect. <em>Memory and Cognition</em>, 37, 5, 587-595.</td>
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
                                              <td>Chu, P. C. K. &amp; Taft, M. (2011). Are there six or nine tones in Cantonese? In <em>Proceedings of the Psycholinguistic Representation of Tone 
                                     Conference (PLRT)</em>, Hong Kong, China, pp. 58-61.</td>
                                            </tr>
                                            <tr>
                                              <td>Chu, P. C. K. &amp; Taft, M. (2011). The influence of the L1 lexical system on the processing of tones in L2. In <em>Proceedings of the 17th 
                                     International Congress of Phonetic Sciences</em>, Hong Kong, China, pp. 488-491</td>
                                            </tr>
                                            <tr>
                                              <td>Chu, P. C. K. &amp; Taft, M. (2010). Interlanguage Speech Intelligibility Benefit and the Mental Representation of Second Language Speech 
                                    Sounds. In <em>Proceedings of the 7th International Conference on Cognitive Science.</em> Anhui: University of Science and Technology of China 
                                    Press, pp. 404-405
                                              </td>
                                            </tr>
                                            <tr>
                                              <td>Yap, F. H., Kwan, S. W.-M., Yiu, E. S.-M., Chu, P. C.-K., &amp; Wong, S. F. (2006). Assessing aspectual asymmetries in human language 
                                    processing. In <em>Proceedings of International Speech and Communication Association Tutorial and Workshop on Experimental Linguistics</em>, 
                                    Athens, Greece, pp. 257-260.
                                              </td>
                                            </tr>
                                            <tr>
                                              <td>Yap, F. H., Kwan, S. W.-M., Chu, P. C.-K., Yiu, E. S.-M., Wong, S. F., Matthews, S. &amp; Shirai, Y. (2006). Aspectual asymmetries in the 
                                    mental representation of events: Significance of lexical aspect. In <em>Proceedings of the 28th Annual Conference of the Cognitive Science 
                                    Society</em>, Vancouver, Canada, pp. 2410-2415.
                                              </td>
                                            </tr>
                                            <tr>
                                              <td>Chu, P. C. K. (accepted). <em>Towards a Model of Second Language Word Production and Recognition in Mandarin.</em> Young Scholar 
                                     Award Competition for the International Conference on Chinese Language Learning and Teaching in the Digital Age.
                                              </td>
                                            </tr>
                                            <tr>
                                              <td>Chu, P. C. K. (2009). Positive and Negative Transfers in the Pronunciation Learning of Japanese Onyomi Kanji by Native Cantonese 
                                     Speakers. In <em>Proceedings of the 8th International Symposium on Japanese Language Education and Japanese Studies: Multiculturalism
                                     and Japanese Language Education/ Japanese Studies in Asia and Oceania</em>, Hong Kong, China, Vol. 1, pp. 78-86.
                                              </td>
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
                                      Interlanguage Speech Intelligibility Benefit
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      Second Language Word Production and Recognition Model
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      Accent Perception and Adaptation
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      Using L2 knowledge to investigate the mental representation of L1 speech sounds
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
                                    <td>Chu, P. C. K. (2012). Towards a Model of Second  Language Word Production and Recognition in Mandarin. Poster presented at the 
                                    International Conference on Bilingualism and Comparative Linguistics, Hong Kong, 15-16 May</td>
                                  </tr>
                                  <tr>
                                    <td>Chu, P. C. K. (2011). Towards a Model of Second Language Word Production and Recognition in Mandarin. Paper presented at the Young 
                                    Scholar Award Competition in the International Conference on Chinese Language Learning and Teaching in the Digital Age (CLTDA), Hong
                                    Kong, 25-27 November.</td>
                                  </tr>
                                  <tr>
                                    <td>Chu, P. C. K., &amp; Taft, M. (2011). The influence of the L1 lexical system on the processing of tones in L2. Paper presented at the 
                                    International Congress of Phonetic Sciences (ICPhS), Hong Kong , 17-21 August.</td>
                                  </tr>
                                  <tr>
                                    <td>Chu, P. C. K., &amp; Taft, M. (2011). How Cantonese listeners process Mandarin tones: Implications for the second-language phonological 
                                    lexicon. Paper presented at the International Symposium of Bilingualism (ISB), Oslo, 15-18 June.</td>
                                  </tr>
                                  <tr>
                                    <td>Chu, P. C. K., &amp; Taft, M. (2011). Regularity and Congruency effect in Cantonese speakers’ phonological knowledge of Mandarin words. 
                                    Paper presented at the 38th Australasian Experimental Psychology Conference (EPC), Auckland, 28-30 April.</td>
                                  </tr>
                                  <tr>
                                    <td>Chu, P. C. K., &amp; Taft, M. (2010). The Mental Representation of L2 Phonological Lexicons: Implications from the Recognition and Production 
                                    of Mandarin Words by Cantonese and Mandarin speakers. Paper presented at the Annual Research Forum of the Linguistic Society of Hong 
                                    Kong (LSHK), Hong Kong, December 4.</td>
                                  </tr>
                                  <tr>
                                    <td>Chu, P. C. K., &amp; Taft, M. (2010). Interlanguage Speech Intelligibility Benefit and the Mental Representation of Second Language Speech 
                                    Sounds. Poster presented at the 7th International Conference on Cognitive Science (ICCS), Beijing, 17-20, August.</td>
                                  </tr>
                                  <tr>
                                    <td>Chu, P. C. K., &amp; Taft, M. (2010). The role of relative word frequency in interlanguage speech intelligibility benefit. Paper presented at the 
                                    37th Australasian Experimental Psychology Conference (EPC), Melbourne, 8-10, April.</td>
                                  </tr>
                                  <tr>
                                    <td>Chu, P. C. K. (2009). Do first-language phonemic categories play a role in the perception of second-language phonemic contrasts? A look 
                                    from the perception of Cantonese by Mandarin speakers. Poster presented at the 2nd Acoustical Society of America (ASA) Special 
                                    Workshop on Speech: Cross-Language Speech Perception and Variations in Linguistic Experience, Portland, May 22-23.</td>
                                  </tr>
                                  <tr>
                                    <td>Chu, P. C. K. (2008). Positive and Negative Transfers in the Pronunciation Learning of Japanese Onyomi Kanji by Native Cantonese 
                                    Speakers. Paper presented at the 8th International Symposium on Japanese Language Education and Japanese Studies: Multiculturalism 
                                    and Japanese Language Education/ Japanese Studies in Asia and Oceania, Hong Kong, China, November 8-9.</td>
                                  </tr>
                                  <tr>
                                    <td>Chu, P. C. K. (2007). The Perception of Cantonese Codas by Native Speakers of Cantonese and Mandarin. Paper presented at the 12th 
                                    International Conference on the Processing of East Asia Related Languages (PEARL), National Cheng Kung University, Tainan, Taiwan,
                                    December 28-29.</td>
                                  </tr>
                                  <tr>
                                    <td>Chu, P. C. K. (2007). The Pronunciation Learning Strategy of the Japanese onyomi kanji words by native Cantonese speakers: a look from 
                                    the Cantonese coda. Paper presented at the 2007 Annual Research Forum of the Linguistic Society of Hong Kong (LSHK), Hong Kong, 
                                    December 8-9.</td>
                                  </tr>
                                  <tr>
                                    <td>Chu, P. C. K. (2008). The Acquisition of Cantonese Tones in Cantonese-English Bilingual Children. Paper presented at the Conference on 
                                    Bilingual Acquisition in Early Childhood, Hong Kong, China, December 11-12.</td>
                                  </tr>
                                  <tr>
                                    <td>Chu, P. C. K. (2008). Tonal Development in Cantonese-English Bilingual Children. Poster presentation at the 11th International Congress 
                                    For the Study Of Child Language (IASCL), Edinburgh, United Kingdom, July 28 – August 1.</td>
                                  </tr>
                                  <tr>
                                    <td>Chu, P. C. K. (2007). Tonal Development in a Cantonese-English bilingual child. Paper presented at the Second Postgraduate Conference 
                                    in Theoretical and Applied Linguistics, Newcastle, United Kingdom, June 25.</td>
                                  </tr>
                                  <tr>
                                    <td>Chu, P. C. K. (2006). Tonal Development in Cantonese-English bilingual children: A case study. Poster presentation at the Conference on     
                                    Language Acquisition in the Chinese Context (LACC), Hong Kong, China, December 15-16.</td>
                                  </tr>
                                  <tr>
                                    <td>Chu, P. C. K., &amp; Taft, M. (2011). Are there six or nine tones in Cantonese? Paper presented at the Psycholinguistic Representation of Tone 
                                     Conference (PLRT), Hong Kong, 22-23 August.</td>
                                  </tr>
                                  <tr>
                                    <td>Chu, P. C. K. (2008). Onset, Rhyme and Coda Corresponding Rules of the Sino-Korean Characters between Cantonese and Korean. Paper 
                                     presented at the 5th Postgraduate Research Forum on Linguistics (PRFL), Hong Kong, China, March 15–16.</td>
                                  </tr>
                                  <tr>
                                    <td>Chu, P. C. K., &amp; Wong, F. (2008). The Acquisition of Cantonese Container Classifiers by Native Cantonese Children. Poster presentation at 
                                     the 3rd International Conference on Cognitive Science, Moscow, Russia, June 20-25.</td>
                                  </tr>
                                  <tr>
                                    <td>Chu, P. C. K., &amp; Wong, F. (2007). A Semantic Study of Container Classifiers in Cantonese. Poster presentation at the 12th International 
                                     Conference on the Processing of East Asia Related Languages (PEARL), National Cheng Kung University, Tainan, Taiwan, December 28-29.</td>
                                  </tr>
                                  <tr>
                                    <td>Chu, P. C. K. (2007). Rules and Constraints of the Code-mixing patterns in Hong Kong Cantonese. Paper presented at the First 
                                     International Free Linguistics Conference, Sydney, Australia, October 6-7.</td>
                                  </tr>
                                  <tr>
                                    <td>Yap, F. H., Chu, P. C. K., Matthews, S., Li, P., &amp; Shirai, Y. (2009). Aspectual asymmetries in the human mind: A perceptual symbols 
                                     account. Paper presented at the 17th Annual Conference of the International Association of Chinese Linguistics (IACL), Paris, July 2-4. </td>
                                  </tr>
                                  <tr>
                                    <td>Yap, F. H., Yiu, E. S. M., Chu, P. C. K., Inoue, Y., Shirai, Y. &amp; Matthews, S. (2008). Interaction of Lexical and Grammatical (and 
                                     Frequency) in Verb Processing. Poster presentation at the 3rd International Conference on Cognitive Science, Moscow, Russia, June 20-25. </td>
                                  </tr>
                                  <tr>
                                    <td>Yap, F. H., Kwan, S. W.-M., Yiu, E. S.-M., Chu, P. C.-K., Wong, S. F., Shirai, Y., &amp; Matthews, S. (2006). Aspectual asymmetries in East 
                                     Asian languages. Paper presented at the 7th International Conference on Tense, Aspect, Mood and Modality (Chronos 7), Antwerp, 
                                     September 18-22.</td>
                                  </tr>
                                  <tr>
                                    <td>Yap, F. H., Kwan, Kwan, S. W.-M., Yiu, E. S.-M., Chu, P. C.-K., &amp; Wong, S. F., (2006). Assessing aspectual asymmetries in human 
                                     language processing. Poster presentation at the International Speech and Communication Association (ISCA) Tutorial and Workshop on 
                                     Experimental Linguistics, Athens, Greece, August 28-30. </td>
                                  </tr>
                                  <tr>
                                    <td>Yap, F. H., Kwan, S. W.-M., Chu, P. C.-K., Yiu, E. S.-M., Wong, S. F., Matthews, S., &amp; Shirai, Y. (2006). Aspectual asymmetries in the 
                                     mental representation of events: Significance of lexical aspect. Poster presentation at the 28th Annual Conference of the Cognitive Science 
                                     Society (CogSci), Vancouver, Canada, July 26-29.</td>
                                  </tr>
                                  <tr>
                                    <td>Yap, F. H., Kwan, S. W.-M., Chu, P. C.-K., Yiu, E. S.-M., Wong, S. F., &amp; Rhee, S. (2006). The interaction of lexical and grammatical 
                                     aspect on language processing. Paper presented at the 2006 Linguistic Society of Korea Seoul International Conference on Linguistics 
                                     (SICOL), Seoul, Korea, July 24-26.</td>
                                  </tr>
                                  <tr>
                                    <td> Yap, F. H., Chu, P., Wong, S., Yiu, E., Matthews, S., &amp; Shirai, Y. (2005). Aspectual asymmetry in Cantonese: Does inherent verb aspect 
                                     matter? Paper presented at the 11th International Conference on Processing Chinese and Other East Asian Languages (PCOEAL), 
                                     Chinese University of Hong Kong, December 9-11. </td>
                                  </tr>
                                  <tr>
                                    <td>Chu, P. C. K. (2011). Interlanguage speech intelligibility benefit: Implications for the L2 phonological representation. Talk presented at the 
                                     Language Comprehension Department lab meeting, Max Planck institute for Psycholinguistics, Nijmegen, the Netherlands, 5 July.</td>
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
        <p>&copy; 99Scholars 2013</p>
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