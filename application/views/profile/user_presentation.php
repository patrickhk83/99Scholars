<div class="row">
    <div class="col-lg-12">
        <div class="well">
            <label class="checkbox-inline publication-criteria">
                <input type="checkbox" checked="check" id="presentation-check"/> Presentation <span class="text-muted">(<?php echo $presentationcount['count']['presentation'] ?>)</span>
            </label>
        </div><!--well-->
      <div class="row" id="presentation-container">
            <div class="col-lg-12">
              <h4>Presentations</h4>
              <table class="table table-striped">
                <tbody>
                    <?php foreach($presentationcount['presentations'] as $presentation) { ?>
                    <tr>
                      <td><?php echo $presentation['last_name'].', '.$presentation['first_name'].' '.$presentation['year'].' '.$presentation['title'].' '.$presentation['presentation_name']?></td>
                    </tr>
                  <?php } ?>
                </tbody>
                    <!--<tbody>
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
                    </tbody>-->
                </table>
            </div>
      </div>
    </div><!--span-->
</div><!--/row-->