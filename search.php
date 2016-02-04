<?php
require 'src/indeed_query.php';
require 'src/archive_search.php';
require 'src/convert_JSON_CSV.php';

if(isset($_POST['submit'])) {

  $jobQuery = new JobQuery();

  //params - query, location, limit, start, fromage
  $jobQuery->postJobQuery($_POST['query'], $_POST['location'], 0, $_POST['fromage']);

}

if (isset($_POST['archive'])){

  $archiveFile = new ArchiveFile();
  $archiveFile->archiveFile();

}

if (isset($_POST['convertCSV'])){
  $conversion = new ConvertScripts();
  $conversion->convertJSONtoCSV('data/search.json');

}


?>


<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Indeed Search</title>
</head>

 <div id="container">
          <form name="form1" method="post" action="">
            <p>
              <label for="Query">Query: </label>
              <input type="text" name="query" id="query" placeholder="Query">
            </p>
            <p>
              <label for="location">Location: </label>
              <input type="location" name="location" id="location">
              </p>

              <p>
              <label for="fromage">Days Old: </label>
              <input type="fromage" name="fromage" id="fromage">
              </p>     



            <p>
              <input type="submit" name="submit" id="submit" value="Submit">
            </p>

            <p>
                  <input type="submit" name="archive" id="archive" value="Archive Files">
            </p>
            <p>
            <input type="submit" name="convertCSV" id="convertCSV" value="Convert to CSV">
            </p>

          </form>
        </div>

<p><a href="index.html"> View Search Results</a></p>




</body>
</html>

