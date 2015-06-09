<div>
  <ul class="breadcrumb">
    <li>
      <a href="/">Home</a> <span class="divider">/</span>
    </li>
    <li>
      Email
    </li>
  </ul>
</div>

<div id="navButtons">
    <button type="button" class="btn btn-primary" id="btnCreateLink" name="btnCreateLink" ><i class="icon-plus icon-white"></i> Create new template</button>
    <button type="button" class="btn btn-primary" id="btnEditLink" name="btnEditLink" ><i class="icon-pencil icon-white"></i> Edit existing template</button>
  </div>

<!-- Header -->
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-edit"></i>Delete Email Template</h2>
      <div class="box-icon">
        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
      </div>
    </div>
    <div class="box-content" id="createEmail">
        <form class="form-horizontal" enctype="multipart/form-data" id="deleteForm" name="deleteForm">
            <?php foreach ($this->tags as $tag) { ?>
                <span>
                    <input type="checkbox" id="checkbox<?php echo($tag);?>" name="checkbox<?php echo($tag);?>" ><?php echo($tag);?></input><br>
                </span>
            <?php } ?>
        </form>
        <button type="button" class="btn btn-primary" id="btnDelete" name="btnDelete" ><i class="icon-trash icon-white"></i> Delete</button>
    </div>
  </div>
</div>


<?php pinbooster\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/email.js"); ?>