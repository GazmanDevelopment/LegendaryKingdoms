# LegendaryKingdoms
This is a quick and dirty multi-user portal to let polayers of the Legendary Kingdoms 'choose your own adventure' games from Spidermind Games keep track of their party details.

Source: https://spidermindgames.co.uk/legendary-kingdoms/

# Requirements
This system uses CodeIgniter v3 which I have included in this repository.  Obviously you should review their own licensing and check for an updated version if you are going to be palcing this on a publicly accessible server.
This respository does not include the database.php file in the application/config directory.  You will need to set this up with your own database details.

## System Requirements
PHP v7+  
Bootstrap v4  
CodeIgniter v3  
Database (I used MariaDB)  
ion_auth (Run the scripts to setup the dummy data and make sure you disable / change the default admin user!)  
Google reCaptcha (You can disable this by removing the divs, otherwise configure your own)

# Shout Outs / Libraries Used
CodeIgniter v3 - https://www.codeigniter.com/  
ion_auth by Ben Edmonds - http://benedmunds.com/ion_auth/  
Bootstrap v4 - https://getbootstrap.com/docs/4.0/getting-started/introduction/
