<div class="pagination">


<!--<div class="row-fluid">-->
<?php 

//----FUNCTIONS---------

//function to print out range of pages between two numbers
function displayRangeOfPages($start, $end, $thisPage)
{
    for ($i = $start; $i < $end; $i++)
    { ?>
        <li <?php echo (($i == $thisPage->paging->page)?'class="active"':''); ?>><a href="<?php echo $thisPage->paging->getPageLink($i); ?>"><?php echo $i; ?></a></li>
        <?php
    }
}

//display link to previous set of pages
function displayPrevButton($thisPage)
{ 
?>
    <li><a href="<?php echo $thisPage->paging->getPrevPageLink(); ?>"> &lt; </a></li> 
    <?php
}

//display link to next set of pages
function displayNextButton($thisPage)
{
?>

     <li><a href="<?php echo $thisPage->paging->getNextPageLink(); ?>"> &gt; </a></li> 
     <?php
}



//------- END FUNCTIONS--------------



if ($this->paging->mustShow()) {
?>
  <!--<div class="span12">-->
  
  
  <?php 
    //define variables to be used on the page
    $currentPage = $this->paging->page;
    $total = $this->paging->totalPages;
    $pageSize = $this->paging->pageSize;
    $totalResults = $this->paging->totalResults;
    $firstEntry = (($currentPage-1) * $pageSize) + 1;
    if($totalResults > ($firstEntry + $pageSize - 1))
        {$lastEntry = $firstEntry + $pageSize - 1;}
    else
        {$lastEntry = $totalResults;}
  ?>
  
  
    <!--<div class="dataTables_info" id="DataTables_Table_0_info"><?php echo "Showing ".$firstEntry." to ".$lastEntry." of ".$totalResults." entries"; ?></div>-->
  <!--</div>-->
  
  <!--
  <div class="span12 center">
    <div class="dataTables_paginate paging_bootstrap pagination">
      <ul> -->
	<ul id="pagination">

      
        <?php
        //If there are 10 or less pages, show all of them the whole time
        if ($total < 11)
        {
            if ($currentPage != 1)
            {
                displayPrevButton($this);
            }
            displayRangeOfPages(1, $total+1, $this);
            if ($currentPage != $total)
            {
                displayNextButton($this);
            }
        }
        else
        {
            switch ($currentPage)
            {
            case ($currentPage < 7):
                { 
                    if ($currentPage != 1)
                    {
                        displayPrevButton($this);
                    }
                    
                    displayRangeOfPages(1, 11, $this);
                    
                    //if not at the end
                    if($currentPage != $total)
                    {
                        displayNextButton($this);
                    }
                    
                    break;
                }       
            case ( $currentPage > 6):
                { 
                    //how far from the end
                    $dif = $total - $currentPage;
                    if ($dif > 4)
                    {
                    $dif = 4;
                    }
                    
                    displayPrevButton($this);
                    displayRangeOfPages($currentPage-4, $currentPage+$dif+1, $this);
                    
                    //if not at the end
                    if($currentPage != $total)
                    {
                        displayNextButton($this);
                    }
                    break;
                }
            }
        }
        ?>
        
      </ul>
      <!--
    </div>
  </div>-->
<?php
}
?>
<!-- </div>-->
<div class="clr"></div>
</div>
