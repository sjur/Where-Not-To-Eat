<?php

function debug($debug_content) {

echo "<pre>";
var_dump($debug_content);
echo "</pre>";
	
	
}


function println ($string_message) {
    $_SERVER['SERVER_PROTOCOL'] ? print "$string_message<br />" : print "$string_message\n";
}

function newline () {
    $_SERVER['SERVER_PROTOCOL'] ? print "<br />" : print "\n";
}

function dbconnect() {
	
$dbhost = 'localhost';
$dbuser = 'sjurscom_xml';
$dbpass = 'XMLisking2010';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die  ('Error connecting to mysql');


$dbname = 'sjurscom_cms';
mysql_select_db($dbname);

mysql_query("SET NAMES UTF8"); //to make sure that the results are coded in utf-8
	
	
	
}


function getCurrentDir() {
						$fullPath = explode('/', getcwd()); /*gets the working directory, i.e. /home/lh/cabins/cabin-gedde 
									and splits the directory path into an array using the '/' */

						$page = $fullPath[sizeof($fullPath)-1]; //sets page to the last directory-object in the array, i.e. cabin-gedde
						
						return($page);
}

function getParentDir() {
						
						$fullPath = explode('/', getcwd()); /*gets the working directory, i.e. /home/lh/cabins/cabin-gedde 
									and splits the directory path into an array using the '/' */

						$parent = $fullPath[sizeof($fullPath)-2]; //sets page to the last directory-object in the array, i.e. cabin-gedde
						
						return($parent);
	
}

function js_hideAddressBar () { ?>
		<script type="application/x-javascript">
    
    	addEventListener("load", function()
    	{
        setTimeout(updateLayout, 0);
    	}, false);

    		var currentWidth = 0;
    
   	function updateLayout()
    	{
        if (window.innerWidth != currentWidth)
        {
            currentWidth = window.innerWidth;

            var orient = currentWidth == 320 ? "profile" : "landscape";
            document.body.setAttribute("orient", orient);
            setTimeout(function()
            {
                window.scrollTo(0, 1);
            }, 100);            
        }
    }

    setInterval(updateLayout, 400);
    
</script>
<?php
} 

function js_iScroll($scroller, $xpos, $ypos) { ?>

<script type="text/javascript" src="http://sjurs.com/src/iscroll-min.js"></script>
<script type="text/javascript">
function loaded() {
	document.addEventListener('touchmove', function(e){ e.preventDefault(); });
	myScroll = new iScroll('<?php echo "$scroller";?>');
	myScroll.scrollTo(<?php echo "$xpos"; ?>,<?php echo "$ypos"; ?>);
	
	
	
}
document.addEventListener('DOMContentLoaded', loaded);
</script>
<?php
} 

function js_slideInMenu() { ?>

<script type="text/javascript" src="http://sjurs.com/src/slideinmenu.js"></script>

<script type="text/javascript">
function loaded() {
	slidemenu = new slideInMenu('slidedownmenu', false);
	
	
	
}
document.addEventListener('DOMContentLoaded', loaded);
</script>


<?php
} //end js_slideInMenu()

	
/* ADMIN FUNCTIONS */


function listprojects() {
	
	$result_set = array();
	$result_set_published = array();
	$result_set_unpublished = array();
	
	$xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].'/cms/lhadmin/lhprojects.xml');



	$result = $xml->xpath('/projects/category/project');



	foreach($result as $a) {
		
		if(("$a->published") == 0) {
			$result_set_unpublished["$a->projectnumber"] = "$a->name";
		}
		else {
			
			$result_set_published["$a->projectnumber"] = "$a->name";
			
		}
	
	}
	
	$result_set[0] = $result_set_published;
	$result_set[1] = $result_set_unpublished;
	
	return($result_set);
	
}

function listcategories() {
	
dbconnect();

}

function getproject($projectnumber) {
	
	
		$xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].'/cms/lhadmin/lhprojects.xml');
		
		$result = $xml->xpath("/projects/category/project[projectnumber = $projectnumber]");
		
		
		
		return($result);
	
	
	
}

function getcategories() {
	
	$xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].'/cms/lhadmin/lhcategories.xml');
		
	$result = $xml->xpath("/categories");
	
	return($result);


}

function newcategory($name) {
	
	$handle = fopen("new_category.xml", "w");
	
	fwrite($handle, "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n
		   			<categories>
						<category>
							<name>$name</name>
						</category>
					</categories>");
	
	fclose($handle);
	
	
}

function renamecategory($oldname, $newname) {

	$handle = fopen("rename_category.xml", "w");
	
	$xml = simplexml_load_file('lhcategories.xml');
	
	$result = $xml->xpath("/categories/category[name = \"$oldname\"]");
	
	var_dump($result);
	
	
	fwrite($handle, "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n
		   			<categories>
						<category>
							<id>".$result[0]->id."</id>
							<name>$newname</name>
						</category>
					</categories>");
	
	fclose($handle);
	
}

function deletecategory($id) {
	
		//må sjekke om kategorien er tom
		
		$xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].'/cms/lhadmin/lhprojects.xml');
		
		$result = $xml->xpath("/projects/category/project[category = \"$id\"]");
		
		//finner navnet til kategorien
		
		$xmlcat = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].'/cms/lhadmin/lhcategories.xml');
		$resultcat = $xmlcat->xpath("/categories/category[id = \"$id\"]"); 
		
		$name = $resultcat[0]->name;
		
		
		if((count($result) > 0)) {
			
			
			
			foreach($result as $a) {
			
			
			$projects.= $a->name."<br/>";
				
			}
			newline();
			$prosjekt = "prosjekt"; $detdisse = "<b>$projects</b> er flyttet til en annen kategori";
			if((count($result)) > 1) { $prosjekt.="er"; $detdisse = "prosjektene er flyttet til andre kategorier";}
			
			
			newline();
			return("Kategorien <b>$name</b> har ".(count($result))." $prosjekt,<br/><b>
														 					$projects</b>
																		  du kan ikke slette <b>$name</b> f&oslash;r $detdisse.");
	
	
	
		}
		
}

function get_city_state($zip) {
	
	$xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].'/dev/zipcodes.xml');
	
	$result = $xml->xpath("/zipcodes/zipcode[zip = \"$zip\"]");
	
	return $result;
	
	
}


?>