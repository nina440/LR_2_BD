# Sample website for editing tables in MySQL

The website allows you to display a selection from the table. An example is shown in the figure:

![image](https://user-images.githubusercontent.com/10297748/229463790-6ac1b1bf-215c-432a-818a-b0458ec71112.png)

Can be used for water metering, as in this case. However, this is one of the many other uses for this website and all these scripts. The website can work in conjunction with the [ExLzFmySQL](https://github.com/alex1543/ExLzFmySQL) program to facilitate the entry of readings. The green button is for adding entries, which you can try out for yourself. The three buttons at the end of each line are for editing, adding files, and deleting a line. A separate page has been developed for printing, which displays values in reverse order and does not have extra styling. It is supposed that further the page through the menu will be sent to the printer. It is possible to adjust the size of the columns through the "print.php" file in the source directory.

![image](https://user-images.githubusercontent.com/10297748/154269392-8ca88f3c-ff9d-4682-9d28-5f50919af1d2.png)

Any row in the table can be edited from the pop-up modal window by clicking on the cell:

![image](https://user-images.githubusercontent.com/10297748/229464035-d160e96d-f68b-4bd0-b9d6-f5b5af017d7d.png)

The first database will be created by itself, but if this does not happen, then you need to run the [test.sql](https://github.com/alex1543/practUpdate/files/8085998/test.sql.txt)
import file from the source directory.
It is possible to add and remove files through the download manager:

![image](https://user-images.githubusercontent.com/10297748/154267977-77d80ea0-ca9c-4319-98d9-9aa95de461d7.png)

Eventually. This is a very handy set of scripts that is a website that is very handy for editing MySQL database tables. The website is convenient for different purposes, it can work together with [ExLzFmySQL](https://github.com/alex1543/ExLzFmySQL). This project uses only the Lazarus development environment, and the following technologies are used for the website: PHP, JavaScript. Both projects demonstrate that the same problem can be solved in different ways, using different development technologies. The program is guaranteed to work with PHP 7.3.6, MariaDB 10.3.16 and XAMPP Control Panel v3.2.4 under Windows 10.
