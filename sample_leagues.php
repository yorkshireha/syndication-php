<html>
   <head>
      <title>YHA Syndication - Sample leagues</title>
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
   <h1>YHA Syndication - Sample leagues</h1>
<?php
   $league = 0;
   $divisions = "";
   if (!empty($_GET)) {
      $league = $_GET["league"];
      $divisions = $_GET["divisions"];
   }

   echo "
      <h2>Select league</h2>
      <p>Enter a league number and, optionally, division number(s) to show tables for the selected league/table(s) (see <a href='yha_leagueManagerSyndication.php'>YHA League Manager Syndication</a> for futher details).</p>
      <form method='get'>
         <div class='row'>
            <label for='league'>League</label>
            <input type='text' name='league' id='league' value='$league'>
            <span>Invalid league numbers will show an error message</span>
         </div>
         <div class='row'>
            <label for='divisions'>Divisions</label>
            <input type='text' name='divisions' id='divisions' value='$divisions'>
            <span>Comma separated list of division numbers, otherwise leave blank</span>
         </div>
         <div class='row'>
            <input type='submit' value='Show leagues'>
         </div>
      </form>";

   if ($league) {
      echo "
         <h2>Sample PHP code</h2>
         <p>The following code is used to generate the league tables shown below.</p>
         <pre>
      	require_once('leagueManagerSyndication.php');
      	\$myleagues = array(
            '$league' => array($divisions)
      	);
      	\$tables = new LeagueManagerTables(\$myleagues);
      	echo \"&lt;style>table{width:100%;}th,td{padding:5px;border:1px solid #aaa;}&lt;/style>\"; // Some very basic CSS
      	echo \$tables->getHTML();
      </pre>
      <h2>Fixtures</h2>";

   	require_once('leagueManagerSyndication.php');
   	$divisionsArray = strlen($divisions) ? array($divisions) : array();
   	$myleagues = array(
   		$league => $divisionsArray
   	);
   	$tables = new LeagueManagerTables($myleagues);
   	echo "<style>table{width:100%;}th,td{padding:5px;border:1px solid #aaa;}</style>"; // Some very basic CSS
   	echo $tables->getHTML();
   }
?>