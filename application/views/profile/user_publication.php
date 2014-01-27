<div class="row">
    <div class="col-lg-12">
        <div class="well">
            <label class="checkbox-inline publication-criteria">
                <input type="checkbox" checked="check" id="journal-check"/>
                 Journal 
                <span class="text-muted">
                  (<?php echo $journal_count; ?>)
                </span>
            </label>
            <label class="checkbox-inline publication-criteria"> 
                <input type="checkbox" checked="check" id="conf-check"/>
                 Conference proceeding 
                <span class="text-muted">
                  (<?php echo $confproc_count; ?>) 
                </span>
            </label>
            <label class="checkbox-inline publication-criteria">
                <input type="checkbox" checked="check" id="chapter-check"/>
                 Book chapter 
                <span class="text-muted">
                    (<?php echo $book_chapter_count; ?>)
                </span>
            </label>
            <label class="checkbox-inline publication-criteria">
                <input type="checkbox" checked="check" id="book-check"/>
                 Book 
                <span class="text-muted">
                    (<?php echo $book_count; ?>)
                </span>
            </label>
        </div><!--well-->
        <div class="row" id="journal-listing-container">
            <div class="col-lg-12">
              <?php echo $journals;?>  
            </div><!--span-->
        </div><!--/row-->
        <div class="row" id="conf-proc-container">
            <div class="col-lg-12">
              <?php echo $confproc_list; ?>  
            </div>
        </div>
        <div class="row" id="book-chapter-container">
            <div class="col-lg-12">
                <?php echo $book_chapter_list; ?>    
            </div><!--span-->
        </div><!--/row-->
        <div class="row" id="book-container">
            <div class="col-lg-12">
                <?php echo $book_list; ?>    
            </div><!--span-->
        </div><!--/row-->
    </div><!--span-->
</div><!--/row-->