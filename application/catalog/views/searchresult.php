<?php echo $header;?>
<script type="text/javascript">
	$(document).ready(function(){
		$( ".stars" ).each(function() { 
			// Get the value
			var val = $(this).data("rating");
			// Make sure that the value is in 0 - 5 range, multiply to get width
			var size = Math.max(0, (Math.min(5, val))) * 23;
			// Create stars holder
			var $span = $('<span/>').width(size);
			// Replace the numerical value with stars
			$(this).html($span);
		});
	});
</script>
<style type="text/css">
	span.stars, span.stars span {
		display: block;
		background: url(/images/YGR_star_span.png) 0 -22px repeat-x;
		width: 115px;
		height: 22px;
	}

	span.stars span {
		background-position: 0 0;
	}
	#result_spinx ul, #result_spinx ul li{ list-style:none;}
</style>

<?php
require '/home/mxiind/www/sphinxql/vendor/autoload.php';
use Foolz\SphinxQL\Connection;
use Foolz\SphinxQL\SphinxQL;
use Foolz\SphinxQL\Expression;

$conn = new Connection();
$conn->setParams(array('host' => '127.0.0.1', 'port' => 9334));

#common.php
define ( "FREQ_THRESHOLD", 40 );
define ( "SUGGEST_DEBUG", 0);
define ( "LENGTH_THRESHOLD", 2 );
define ( "LEVENSHTEIN_THRESHOLD", 2 );
define ( "TOP_COUNT", 1 );
define ("SPHINX_20",false);

//database PDO
$ln = new PDO( 'mysql:host=127.0.0.1;dbname=mxiind_yougotrated;charset=utf8', 'mxiind_hitesh', 'vS^T+ymX)~)P' );
//Sphinx PDO
$ln_sph = new PDO( 'mysql:host=127.0.0.1;port=9334' );

#common.php
# functions.php

function BuildTrigrams($keyword) 
{
	$t = "__" . $keyword . "__";
	$trigrams = "";
	for ($i = 0; $i < strlen($t) - 2; $i++)
		$trigrams .= substr($t, $i, 3) . " ";
	return $trigrams;
}

function MakeSuggestion($keyword,$ln) 
{
	$trigrams = BuildTrigrams($keyword);
	//echo $keyword.= $keyword;
	$search_query = "\"$trigrams\"/1";
	$len = strlen($keyword);

	$delta = LENGTH_THRESHOLD;
	$weight = 'weight()';
	if(SPHINX_20 == true) {
	    $weight ='@weight';
	}
	$stmt = $ln->prepare("SELECT keyword, $weight as w, w+:delta-ABS(len-:len) as myrank FROM suggest WHERE MATCH(:match) AND len BETWEEN :lowlen AND :highlen
			ORDER BY myrank DESC, freq DESC
			LIMIT 0,:topcount OPTION ranker=wordcount");

	$stmt->bindValue(':match', $search_query, PDO::PARAM_STR);
	$stmt->bindValue(':len', $len, PDO::PARAM_INT);
	$stmt->bindValue(':delta', $delta, PDO::PARAM_INT);
	$stmt->bindValue(':lowlen', $len - $delta, PDO::PARAM_INT);
	$stmt->bindValue(':highlen', $len + $delta, PDO::PARAM_INT);
	$stmt->bindValue(':topcount',TOP_COUNT, PDO::PARAM_INT);
	$stmt->execute();


	if (!$rows = $stmt->fetchAll())
		return false;
	// further restrict trigram matches with a sane Levenshtein distance limit
	//echo "<pre>";
	///print_r($rows);
	foreach ($rows as $match) {
		//print_r($match);
		$suggested = $match["keyword"];
		if (levenshtein($keyword, $suggested) <= LEVENSHTEIN_THRESHOLD)
			return $suggested;
	}

	return $keyword;
}

function MakePhaseSuggestion($words,$company,$ln_sph) 
{
	
	$suggested = array();
	$llimf = 0;
	$i = 1;
	$mis=array();
	//print_r($words);
	foreach ($words  as $key => $word) {
		if ($word['docs'] != 0)
			$llimf +=$word['docs'];$i++;
	}
	$llimf = $llimf / ($i * $i);
	foreach ($words  as $key => $word) {
		if ($word['docs'] == 0 | $word['docs'] < $llimf) {
			$mis[] = $word['keyword'];
		}
	}
	if (count($mis) > 0) {
		foreach ($mis as $m) {
			$re = MakeSuggestion($m, $ln_sph);
			if ($re) {
				if($m!=$re)
					$suggested[$m] = $re;
			}
		}
		if(count($words) ==1 && empty($suggested)) {
			return false;
		}
		$phrase = explode(' ', $company);
		foreach ($phrase as $k => $word) {
			if (isset($suggested[strtolower($word)]))
				$phrase[$k] = $suggested[strtolower($word)];
		}
		$phrase = implode(' ', $phrase);
		return $phrase;
	} else {
		return false;
	}
}
# functions.php


$docs = array();
$offset =10;
$current = 1;
$url =  base_url().'sp/ajax_suggest.php';
$mis = array();
$suggest = false;
# get user IP
$user_ip= $_SERVER['REMOTE_ADDR'];
$details = json_decode(file_get_contents("http://ipinfo.io/{$user_ip}"));
$user_city=$details->city; 
//echo $user_city."asf";



$ip = $_SERVER['REMOTE_ADDR']; 
$ipquery = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
//print_r($ipquery);
if($ipquery && $ipquery['status'] == 'success') {
	//echo 'My IP: '.$ipquery['query'].', '.$ipquery['isp'].', '.$ipquery['org'].', '.$ipquery ['country'].', '.$ipquery['regionName'].', '.$ipquery['city'].'!';
} else {
	//echo 'Unable to get location';
}

# get user IP

$order="DESC";
if (isset($_GET['query']) && trim($_GET['query']) != '' ||
	isset($_GET['city']) && trim($_GET['city']) != '' ||
	isset($_GET['state']) && trim($_GET['state']) != '') {
	$company = $_GET['query'];
//	$city = trim($_GET['city']);
//	$state = trim($_GET['state']);
	//echo $company;
	//echo $city;
	//echo $state;
	 if(isset($ipquery['city'])) {
	$city = $ipquery['city'];
	}
	if(isset($ipquery['region'])) {
	$state = $ipquery['region'];
	} 
	if(isset($_GET['start'])) {
		$start = trim($_GET['start']);
	}
	else {
		$start =0;
	}
	//$city = 'Toronto';
	//$state = 'ON';	
	$indexes = 'simplecompletefull';
	if(isset($_GET['start'])) {
	    $start = $_GET['start'];
	    $current = $start/$offset+1;
	}
	#first Query starts
		$query = SphinxQL::create($conn)
		->select('*')
		->from($indexes)
		->match('company', SphinxQL::expr($company))
		->limit(0,800);

		$query->where('city', '=', $city);
		$query->where('state', '=', $state);
		
		$result = $query->execute();

	#first query ends
	
	#second Query starts
		$query_1 = SphinxQL::create($conn)
		->select('*')
		->from($indexes)
		->match('company', SphinxQL::expr($company))
		->limit(0,800);

		$query_1->where('city', '!=', $city);
		$query_1->where('state', '=', $state);
		$result_1 = $query_1->execute();
	
	#second query ends
	
	#third Query starts
		$query_2= SphinxQL::create($conn)
		->select('*')
		->from($indexes)
		->match('company', SphinxQL::expr($company))
		->limit(0,800);

		$query_2->where('city', '!=', $city);
		$query_2->where('state', '!=', $state);
		$result_2= $query_2->execute();
	
	#third query ends
	
	$combined_result=array_merge($result,$result_1,$result_2);
	# For Autosuggest
	$stmt = $ln_sph->prepare("SELECT * FROM $indexes WHERE MATCH(:match)  LIMIT $start,$offset OPTION ranker=sph04,field_weights=(title=100,content=1)");
	$stmt->bindValue(':match', $company,PDO::PARAM_STR);
	$stmt->execute();
	$rows = $stmt->fetchAll();
	
	$meta = $ln_sph->query("SHOW META")->fetchAll();
	//print_r($meta);
	foreach($meta as $m) {
	    $meta_map[$m['Variable_name']] = $m['Value'];
	}
	
	# For Autosuggest
	$ids = array();
	$tmpdocs = array();
	
	if (count($combined_result)> 0) {
		
		foreach ($combined_result as  $v) {
			$ids[] = $v['id'];
		}
		
		$current_ids=array_slice($ids,$start,$offset);
		$q = "SELECT id,company,streetaddress,city,country,email,siteurl,phone,state,zip,seoslug FROM youg_company  WHERE id IN  (" . implode(',', $current_ids) . ")";
		$res=$ln->query($q);
	
		foreach ($res as $row) {
			$tmpdocs[$row['id']] = array(
					'id' => $row['id'],
					'title' => $row['company'],
					'address' => $row['streetaddress'],
					'city' => $row['city'],
					'country' => $row['country'],
					'email' => $row['email'],
					'siteurl' => $row['siteurl'],
					'phone' => $row['phone'],
					'state' => $row['state'],
					'zip' => $row['zip'],	
					'seoslug' => $row['seoslug']		
					);			
		}
		
		foreach ($ids as $id) {
			if (array_key_exists($id, $tmpdocs)) {
				$docs[] = $tmpdocs[$id];
			}
		}
	} else {
		$words = array();
		foreach($meta_map as $k=>$v) {
			if(preg_match('/keyword\[\d+]/', $k)) {
				preg_match('/\d+/', $k,$key);
				$key = $key[0];
				$words[$key]['keyword'] = $v;
			}
			if(preg_match('/docs\[\d+]/', $k)) {
				preg_match('/\d+/', $k,$key);
				$key = $key[0];
				$words[$key]['docs'] = $v;
			}
		} 
		//print_r($words);
		//print_r($ln_sph);
		$suggest = MakePhaseSuggestion($words, $company, $ln_sph);
	}
	$total_found = count($ids);
	$total = count($ids);
	
}

?>
<style>
.serch_result h1 {
    width: auto !important;
}
.add-busi-dir a{
	font-size:20px;
}
</style>

<section class="container">
  <section class="main_contentarea serch_result" style="padding-top:7.5em;">
    <h1 class="bannertext btxt">
		<span class="bannertextregular">YOUR SEARCH </span>RESULTS</h1>
    </h1>
    <div class="srch_rslt_wrp">
		<div style='text-align:center' class="add-business">
      If the business you are looking for isnt here, add it!
	  </div>
	  	<div class="add-busi-dir"> <a href="<?php echo site_url('businessdirectory/add');?>">Add Business to Directory</a></div>		
	<div class="row" style="margin-top: 5em;">
		<div class="span9">
			<div class="well form-search">
				<form method="GET" action="" id="search_form">
					<div class="main_bd_srchwrp">
						<div class="bdsrch_wrp">
						<h2>Search</h2>
						<div class="bd_srchwrp">
							<input type="text" placeholder="ENTER CITY OR COMPANY NAME HERE" class="input-large bdsrch_txtbx" name="query" id="suggest" autocomplete="off" value="<?=isset($_GET['query'])?htmlentities($_GET['query']):''?>"> 
							<!-- <input type="text" class="input-large" name="city" id="city"  value="<?=isset($_GET['city'])?htmlentities($_GET['city']):''?>"> 
							<input type="text" class="input-large" name="state" id="state"  value="<?=isset($_GET['state'])?htmlentities($_GET['state']):''?>"> -->
							<input type="submit" class="btn btn-primary bdsrch_btn" id="send" name="send" value="" >
						</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php if ($suggest): ?>
	<div class="row">
		<div class="span9" style="margin: 0px auto; width: 400px;">
			<p style="margin:0px auto !important;  padding: 25px 0 0;font-size: 18px;text-align:center;">
				Did you mean <i><a href="<?php echo current_url();?>?query=<?php echo $suggest; ?>&city=<?php echo $city;?>&state=<?php echo $state;?>"><?php echo $suggest; ?> </a>
				</i> ?
			</p>
			<?php $url=current_url()."?query=".$suggest."&city=".$city."&state=".$state; 
			//header("Refresh:3; url=".$url);?>
			<div id="result_spinxs" style="margin:0px auto !important;font-size: 18px;text-align:left;"></div>
		</div>
	</div>
	
	<script>
		
		$(document).ready(function()
		{
		
		$.ajax({
					url: "<?php echo base_url(); ?>search/autocompletes", //Controller where search is performed
					type: 'GET',
					data : {query :'<?php echo $suggest; ?>'},
					success : function(data){ $("#test").html(data);}
				});
			
			
		});
	</script>
	
	<?php endif; ?>
	
	<div id="test"></div>
	<div class="lead" style="margin:0px auto !important;  padding: 25px 0;display:none;">
	<!--	Total found:<?php echo $total_found?> -->&nbsp;	
	</div>
	<div><div class="span" style="display: none;"></div>
	<?php if (count($docs) > 0): ?>
        <div class="span9"><?php include 'paginator.php';?></div>
        <br/>
		<?php foreach ($docs as $doc): ?>
		<?php 
		    $avgstar = $this->common->get_avg_ratings_bycmid($doc['id']);
			$itemproaverage = $avgstar;
			$avgstar = round($avgstar);
			$elitemem_status = $this->common->get_eliteship_bycompanyid($doc['id']);
		?>
		<div class="span9">
			<div style="float:left; width:75%">
				<!-- left- info starts -->
					<div class="container" style="border-bottom:2px solid #ccc; padding-top:15px;">
					<div id="top_info">
					<div style="float:left;">
						<div class="verified_wrp srch_rslt_vrfy vfy_rvw">
						<?php if(count($elitemem_status)==0){?>
						<div class="vry_logo"> <a href="<?php echo $doc['seoslug']; ?>" title="view company Detail" ><img src="images/notverified.png" class = "searchlogos" alt="<?php echo ucfirst(stripslashes($doc['title'])); ?> Notverified Seal" /></a> </div>
						<?php }else{
						?>
						<div class="vry_logo"> <a href="<?php echo $doc['seoslug']; ?>" title="view company Detail"><img src="images/verifiedlogo.jpg" class = "searchlogoss" alt="<?php echo ucfirst(stripslashes($doc['title'])); ?> Verified Seal" /></a> </div>    
						<?php
						} ?>
						</div>

					</div>
					<div style="float:left">
						<h2 style="padding:0px;margin:0px;"><a href="<?php echo $doc['seoslug']; ?>" title="view company Detail" > <?php echo $doc['title']; ?></a></h2> 
						<div class="vry_rating">
						<span class="stars" data-rating="<?php echo $itemproaverage; ?>"></span>
						</div>
						
					<div class="vry_btn bmoves">
					<a href="review/add/<?php echo $doc['id'];?>" title="Write review">WRITE REVIEW</a> 
					<a href="<?php echo site_url('complaint/add/'.$doc['id']);?>" title="File Complaint"> FILE COMPLAINT</a>
					</div>

					</div>
					<div style="clear:both"></div>
					</div>
					<div class="contct_dtl cntdll">
					<ul>
					<li><span>ADDRESS</span> <a> <?php echo $doc['address']; ?></a></li>
                                        <li><span>City</span> <a title=""> <?php echo $doc['city']; ?></a></li>
                                        <li><span>State</span> <a title=""> <?php echo $doc['state']; ?></a></li>
					<li><span>PHONE</span> <a title="call us" href="tel:<?php echo $doc['phone']; ?>"><?php echo $doc['phone']; ?></a></li>
					<?php if($doc['siteurl'] != '')  { ?><li><span>WEBSITE</span> <a title="company website" href="<?php echo $doc['siteurl']; ?>"><?php echo $doc['siteurl']; ?></a></li><?php } ?>
					<?php if($doc['email'] != '')  { ?><li><span>E-MAIL</span> <a title="mail us" href="mailto:<?php echo $doc['email']; ?>"> <?php echo $doc['email']; ?></a></li> <?php } ?>
					</ul>
					</div>
					</div>
				<!-- left info ends -->
			</div>
			<div style="float:right; width:20%;">
			<!-- left view map starts -->
			<?php 
			$mapaddress = stripslashes($doc['address'].','.$doc['city'].','.$doc['state'].','.$doc['country'].','.$doc['zip']);
			$string = str_replace(' ', '-', $mapaddress); // Replaces all spaces with hyphens.

			$mapaddress = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
			?>
            <div class="Flexible-container" style="float:right;">         
                <script>
					function PopupCenter(pageURL, title,w,h)
					{
						var left = (screen.width/2)-(w/2);
						var top = (screen.height/2)-(h/2);
						var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
					}
					</script><a style="cursor: pointer;" onclick="PopupCenter('businessdirectory/map/<?php echo $mapaddress; ?>','','800','500');" target="_blank" title="View Map">View Map</a>
			</div>
			<!-- left view map ends -->
			</div>
			<div style="clear:both"></div>
		<?php endforeach; ?>
		<br/>
		<div class="span9"><?php //include 'paginator.php';?></div>
		<?php elseif (isset($_GET['query']) && $_GET['query'] != ''): ?>
		<!--<p class="lead no-result" style="margin:0px auto !important;  padding: 25px 0;">No results found, please try your search again.</p>-->
		<?php endif; ?>
	</div>
	</div>
	</div>
</section>
</section>
<?php echo $footer;?>
