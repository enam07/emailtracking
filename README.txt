This set of example files should make email open tracking straightforward and easy to both implement, and adjust.

To load it up and give it a shot, simply place these files in your web root, and open (in my case as I use MAMP):

http://localhost:8888/email-open-tracker/send.php

And send a message!

A few things to note...

1.  These scripts use configuration variables specified as constants in "config.inc.php".  Please adjust as necessary.
2.  These scripts use the mysqli database class, which is included in this package ("class.db.php"), and found here: http://www.phpdevtips.com/2013/06/updated-mysqli-database-class/
3.  The database schema used for these example files is provided in "database-table.sql"
4.  To work properly, ensure that if the file "blank.gif" is not located in the same directory as the "record.php" script, adjustments are made to provide the actual location.

Full article for this script is located at: http://www.phpdevtips.com/2013/06/email-open-tracking-with-php-and-mysql