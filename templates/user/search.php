<div>
  <ul class="breadcrumb">
    <li>
      <a href="/">Home</a> <span class="divider">/</span>
    </li>
    <li>
      <a href="/user/">Management</a> <span class="divider">/</span>
    </li>
    <li>
      Search for <strong><?php echo $this->searchFor; ?></strong> on <strong><?php echo $this->searchType; ?></strong>
    </li>
  </ul>
</div>
<div class="row-fluid sortable">                
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-search"></i> Users </h2>
      <div class="box-icon">
        <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
      </div>
    </div>
    <div class="box-content">
      <div>
        <span id="userActionStatus" />
      </div>
      <table class="table table-striped table-bordered bootstrap-datatable datatable">
        <thead>
          <tr>
            <th>Username</th>          
            <th>Email</th>
			<th>Big Board</th>
			<th>Last Offer Price</th>
			<th>Last Offer Date</th>
            <th>Followers</th>            
            <th>Gender</th>
            <th>Location</th>
            <th>Health</th>			
            <th>Notes</th>
            <th>Actions</th>
          </tr>
        </thead>   
        <tbody>
        <?php
        foreach ($this->users as $user) { 
        ?>
            <tr>
              <td>
                <a target="_blank" href="http://www.pinterest.com/<?php echo $user->username; ?>"><?php echo $user->username; ?></a>
              </td>
              <td><?php echo $user->email; ?></td>              
              <td><a href="<?php echo $user->bigBoardUrl; ?>"><?php echo $user->bigBoardName; ?></a></td>
              <td nowrap>$<?php echo $user->lastOfferPrice; ?></td>                            
              <td nowrap><a href="javascript:alert('Cmapaign: <?php echo $user->campaignName; ?>');"><?php echo $user->lastOfferDate; ?></a></td>                            
              <td><?php echo $user->followers; ?></td>               
              <td><?php echo $user->gender; ?></td>                            
              <td><?php echo $user->location; ?></td>                            
              <td><?php if ($user->role =='pinner') {
              echo $user->healthPct . "%"; 
              echo "<img src='/images/" . $user->healthImg . "' heigth='10' width='10'>";
              }?></td>
              <td><?php 
                  if ($user->commentsCount > 0) { 
					 echo "<span class='tip' onmouseover='tooltip(" . $user->id . ");' onmouseout='bye();'><img src='/images/comments.png' height='25' width='25' border='0'></span>";
                  }
				   if ($user->flagged == '1'){
                    echo "<img src='/images/flag.png' height='20' width='20' title='Flagged as Underage'>";
                  }          
				   if ($user->isBlackListed == '1'){
                    echo "<b>BL</b>";
                  }                  
                  ?>              
              </td>                                          
              <td nowrap>
              	<?php if ($this->authoritationManager->hasUserAuthorityFor($_SESSION['userid'], 'VIEW_USER_PROFILE')) { ?>
                <a href="/user/view?id=<?php echo $user->id; ?>" class="btn btn-success" title="View user details">
                    <i class="icon-eye-open icon-white"></i>View
                </a> 
                <?php } ?> 
                <?php if ($user->role == "pinner") { ?>
                    <?php if ($this->authoritationManager->hasUserAuthorityFor($_SESSION['userid'], 'LIST_USER_PINS')) { ?>
                    <a href="/user/pins/listpins?userid=<?php echo $user->id; ?>" class="btn btn-info" title="View user pins">
                      <i class="icon-list-alt icon-white"></i>Pins
                    </a>
                    <?php } ?> 
                    <?php if ($this->authoritationManager->hasUserAuthorityFor($_SESSION['userid'], 'LIST_USER_OFFERS')) { ?>  
                    <a href="/user/pins/listl88offers?userid=<?php echo $user->id; ?>" class="btn btn-danger" title="View user offers" target="_blank">
                      <i class="icon-list-alt icon-white"></i>Offers 
                    </a> 
                    <?php } ?>  
                <?php } ?>
                
              </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
      </table>            
      <?php echo $this->renderSubModule('generic/paging');?>
    </div>
  </div><!--/span-->
</div><!--/row-->
<style type="text/css">

#tooltip {
padding: 4px;
background-color: #eee;
border: 1px solid #000;
text-align: center;
font-size: 13px;
z-index:999}


</style>
<SCRIPT LANGUAGE="JavaScript">
<!--

var x=0;
var y=0;
var xx = 12;
var yy = 10;
var the	 = 0;
var t;

function e(i){ 
var d = document.createElement('div'); 
d.id = i; 
d.style.display = 'none';
d.style.position = 'absolute';
d.innerHTML = ""; 
document.body.appendChild(d);}

function wherecursor(e){
t = document.getElementById('tooltip');
if (!e) var e = window.event;
if (e.pageX){x = e.pageX;y = e.pageY;}
else if (e.clientX){x = e.clientX + document.body.scrollLeft;y = e.clientY + document.body.scrollTop;}
t.style.left = (x+xx) + 'px';
t.style.top = (y+yy) + 'px';}

function tooltip(thetooltip){
if(!document.getElementById('tooltip')) e('tooltip');
t = document.getElementById('tooltip');
Ajax(thetooltip);
t.style.display = 'block';
t.style.left = '-1999px';
document.onmousemove = wherecursor;}

function Ajax(thetooltip){
var tm = new Date().getTime();
if (window.XMLHttpRequest){ // code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}else{ // code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
xmlhttp.onreadystatechange=function(){
if (xmlhttp.readyState==4 && xmlhttp.status==200){
t.innerHTML=xmlhttp.responseText;}}
xmlhttp.open("GET","/user/comment/view?search="+thetooltip,true);
xmlhttp.send();}

function bye(){document.getElementById('tooltip').style.display = 'none';}

// -->
</script>
<?php pinbooster\fwk\Fwk_JsEnqueuer::getInstance()->enqueue(JS_FILE, "/js/usermagmnt.js"); ?>