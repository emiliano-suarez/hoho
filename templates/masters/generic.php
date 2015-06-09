<!DOCTYPE html>
<html lang="en">
<head>
  <?php echo $this->renderSubModule('generic/htmlhead'); ?>
</head>
<body>
<div class="wrapper">
  <?php echo $this->renderSubModule('generic/topbar'); ?>
  <!-- content starts -->
  <?php echo $this->renderSubModule($this->childModule); ?>
  <!-- content ends -->
  <?php echo $this->renderSubModule('generic/footer'); ?>
  <!-- external javascript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->

</div>


<script type="text/javascript" src="/js/smk-accordion.js"></script>
<script type="text/javascript" src="/js/smk-accordion2.js"></script>
	  
<!-- ACCORDINO JS  -->      

<script src="/js/index.js"></script>
<script src="/js/jquery.ba-resize.js"></script>
<script src="/js/jquery.tabs+accordion.js"></script>
<script>
$('.accordion, .tabs')
	.TabsAccordion({
		hashWatch: true,
		pauseMedia: true,
		responsiveSwitch: 'tablist',
		saveState: sessionStorage,
	});
</script>


  <?php hoho\fwk\Fwk_JsEnqueuer::getInstance()->flushAll(); ?>
</body>
</html>