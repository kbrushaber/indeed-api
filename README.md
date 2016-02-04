# indeed-api
Indeed API calls using Angular, PHP and JSON

This code was created to be able to access the Indeed API and return the results on a webpage built in Angular. You can then archive the files off if you want to clear out the results.  You can also convert the current list of results to a CSV file. 

To use it you will need an API key from Indeed - http://www.indeed.com/publisher which you will update in the indeed_query.php file via the indeedpubkey variable. 

I chose a selection of parameters that I was interested in.  Indeed has several more parameters if you choose to include them. 

I do have a slight bug in my do/while state in the indeed_query.php file. I used a break to get out of the loop but the while statement should have worked. So if you have logging turned up you may see a php notice. However the query will still complete. 

Indeed has a limit of only returning the first 1025 results.   So if your query has more results than that you may want to reduce your scope of your search.  Although this script will try to return up to 2500 results before it bails out. 

The Angular page will filter out duplicates for display but the CSV file will still include duplicates if there are any.
