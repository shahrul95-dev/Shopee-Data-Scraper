# Shopee Data Scraper

Scraping seller information and products available from Shopee platform

# System details

- When scraping is running, this system will scrape data from Shopee every 0.5 seconds. You can modify this at run_prod.php and run_shopid.php under setInterval function.
- Running on Pure PHP Programming langguage
- Storing data into MySql database

# Instructions

- Install database provided 'scraper_database.sql' file into your MYSQL Server
- Please specify your database information at core/connect/database.php before running the system
- To start scraping, run the files below:
1. www.your-url/run_shopid.php?a=1  //Random IDs from 1000000 - 9999999
2. www.your-url/run_shopid.php?a=2  //Random IDs from 10000000 - 99999999
3. www.your-url/run_shopid.php?a=3  //Random IDs from 100000000 - 999999999

- Updating your seller's product after 24 hours (You can modify this at core/init.php):
5. www.your-url/run_prod.php?a=1 //All sellers are divide into 2 and store into two array. This is array number 1 
6. www.your-url/run_prod.php?a=2 //This is array number 2

