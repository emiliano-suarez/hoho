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
    <button type="button" class="btn btn-primary" id="btnDeleteLink" name="btnDeleteLink" ><i class="icon-trash icon-white"></i> Delete existing template</button>
  </div>
<!-- Header -->
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-edit"></i>Edit Email Template</h2>
      <div class="box-icon">
        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
      </div>
    </div>
    
<!-- Email editing area -->
    <div class="box-content" id="editEmail">
        <form class="form-horizontal" enctype="multipart/form-data" id="emailEditForm" name="emailEditForm" action="/email/preview" type="POST" target="blank">
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="tag">Select email template to edit: </label>  
                    <div class = "controls">
                        <select name="tagDropdown" id="tagDropdown">
                        <option selected disabled hidden value=''></option>
                        <?php foreach ($this->tags as $tag) {echo('<option value="' . $tag . '">' . $tag . '</option>');} ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="emailSubject">Subject: </label>
                    <div class="controls">
                        <input type="text" name="emailSubject" id="emailSubject" style="width:70%" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="emailBody">Email:</label>
                    <div class="controls">
                        <textarea name="emailBody" id="emailBody" style="width:70%" rows="15" ></textarea>
                    </div>
                </div>                
            </fieldset>
            <span id="messageText"></span>
            <div id="buttonDiv" style="width:75%">
                <button type="button" id="btnSave" name ="btnSave" class="btn btn-primary" ><i class="icon-ok icon-white"></i> Save</button>
                <button type="submit" id="btnPreview" name ="btnPreview" class="btn btn-primary" ><i class="icon-search icon-white"></i> Preview</button>
                <button type="button" id="btnCancel" name ="btnSave" class="btn btn-primary"><i class="icon-remove icon-white"></i> Cancel</button>
            </div>
        </form>
    </div>
  </div>
</div>



<?php pinbooster\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/email.js"); ?>
