 <?php //echo $header;?>
 <html>
	 <head>
		<title>Temporary category List page</title>
	 </head>
 <div class="tempcatlist">
	 <ul>
 <!--<li><a href="<?php echo base_url();?>" title="Home">Home<span><span></a> </li>-->
        <li><a href="#" title="Categories">Categories</a>
<ul>
<?php $catlist = $this->catlists->get_all_tempcategorys_menu('1','category','ASC'); 
foreach($catlist as $row=> $result)
{
					//lower case everything
					$categoryname = strtolower($result['category']);
					//make alphaunermic
					$categoryname = preg_replace("/[^a-z0-9\s-]/", "", $categoryname);
					//Clean multiple dashes or whitespaces
					$categoryname = preg_replace("/[\s-]+/", " ", $categoryname);
					//Convert whitespaces to dash
					$categoryname = preg_replace("/[\s]/", "-", $categoryname);
	
	?>
<li><a href="<?php echo site_url('businessdirectory/category/')."/".$categoryname."/".$result['id'];?>"><?php echo $result['category'];?></a></li>
<?php } ?>
</ul></li>
</ul>
</div>
<?php //echo $footer;?>
</html>
