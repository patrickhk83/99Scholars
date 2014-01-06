<div class="row">
    <div class="col-lg-12">
        <div class="well">
            <label class="checkbox-inline publication-criteria">
                <input type="checkbox" checked="check" id="project-check"/> Project <span class="text-muted">(<?php echo $projectcount['count']['project'] ?>)</span>
            </label>
        </div><!--well-->
      <div class="row" id="project-container">
            <div class="col-lg-12">
              <h4>Projects</h4>
              <table class="table table-striped">
                <tbody>
                    <?php foreach($projectcount['projects'] as $project) { ?>
                    <tr>
                      <td><?php echo $project['last_name'].', '.$project['first_name'].' '.$project['year'].' '.$project['title'].' '.$project['project_name']?></td>
                    </tr>
                  <?php } ?>
                </tbody>
       <!-- <tbody>
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
        </tbody>-->
                </table>
            </div>
      </div>
    </div><!--span-->
</div><!--/row-->