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

<div id="closeBar">
    <button type="button" class="btn btn-primary" id="btnClose" ><i class="icon-remove icon-white"></i>Close Preview</button>
</div>

<!-- Header -->
<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-search"></i>Preview</h2>
      <div class="box-icon">
        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
      </div>
    </div>
    <div class="box-content" id="previewEmail">
        <div class="control-group">
            <label class="control-label" for="subject">
                <b>Subject</b>
            </label>
            <div class="controls" id="subject">
                <?php echo($this->subject); ?>
            </div>
        </div>
        <br />
        <div class="control-group">
            <label class="control-label" for="body">
                <b>Body</b>
            </label>
            <div class="controls" id="body">
                <?php echo($this->body); ?>
            </div>
        </div>
        
            
      
      
<?php pinbooster\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/email.js"); ?>