<html>
   <head>
      <title>YHA Syndication - Sample fixtures</title>
      <style>
         body {
            font-family: Arial, sans-serif;
         }
         pre {
            color: #00b;
         }
         form {
            border: 1px solid #ccc;
            padding: 20px;
         }
         form .row {
            margin-bottom: 20px;
         }
         form .row label {
            display: inline-block;
            width: 100px;
         }
         form .row span {
            display: block;
            margin-top: 5px;
            margin-left: 105px;
         }
      </style>
</head>
<body>
   <h1>YHA Syndication - Sample fixtures</h1>
<?php
   $clubId = 0;
   $year = date("Y");
   if (!empty($_GET)) {
      $clubId = $_GET["clubid"];
      $year = $_GET["year"];
      $debug = isset($_GET["debug"]);
   }

   echo "
      <h2>Select club</h2>
      <p>Enter a club ID to show fixtures for that club (see <a href='yha_leagueManagerSyndication.php'>YHA League Manager Syndication</a> for futher details).</p>
      <form method='get'>
         <div class='row'>
            <label for='clubid'>Club ID</label>
            <input type='text' name='clubid' id='clubid' value='$clubId'>
            <span>Invalid club IDs will show an error message</span>
         </div>
         <div class='row'>
            <label for='year'>Year</label>
            <input type='text' name='year' id='year' value='$year'>
            <span>Fixtures for the season begining with this year are shown, starting from 1st September</span>
         </div>
         <div class='row'>
            <input type='submit' value='Show fixtures'>
         </div>
      </form>";

   if ($clubId) {
      echo "
         <h2>Sample PHP code</h2>
         <p>The following code is used to generate the fixtures shown below.</p>
         <pre>
      	require_once('leagueManagerSyndication.php');
      	\$options = array(
      		'includeScores' => true,
      		'startDate'     => mktime(0,0,0,9,01,$year),
      		'daysAhead'     => 365,
      		'dateFormat'    => 'D, d M Y'
      	);
      	\$fixtures = new LeagueManagerFixtures(\$clubId);
      	echo \"&lt;style>table{width:100%;}th,td{padding:5px;border:1px solid #aaa;}tr.date{background-color:#ddd;}&lt;/style>\"; // Some very basic CSS
      	echo \$fixtures->getHTML(\$options);
      </pre>
      <h2>Fixtures</h2>";

   	require_once('leagueManagerSyndication.php');
   	$options = array(
   		'includeScores' => true,
   		'startDate'     => mktime(0,0,0,9,01,$year),
   		'daysAhead'     => 365,
   		'dateFormat'    => 'D, d M Y'
   	);
   	$fixtures = new LeagueManagerFixtures($clubId);
   	if ($debug) {
         error_reporting(E_ALL);
         ini_set('display_errors', 1);
         $fixtures->enableDebug();
   	}
   	echo "<style>table{width:100%;}th,td{padding:5px;border:1px solid #aaa;}tr.date{background-color:#ddd;}</style>"; // Some very basic CSS
   	echo $fixtures->getHTML($options);
   }
?>
</body>
</html>