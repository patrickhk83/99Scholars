<div class="row">
    <div class="col-lg-12">
        <div class="well">
            <label class="checkbox-inline publication-criteria">
                <input type="checkbox" checked="check" id="journal-check"/> Journal <span class="text-muted">(<?php echo $publications['count']['journal'] ?>)</span>
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
              <?php if(isset($publications['journals'])) { ?>
              <h4>Journals</h4>
              <table class="table table-striped">
                <tbody>
                  <?php foreach($publications['journals'] as $journal) { ?>
                  <tr>
                    <td><?php echo $journal ?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
              <?php } ?>
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