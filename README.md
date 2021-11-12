# Router - whith autolload routes

# Install
This router does not require special installation, just copy all files to the root folder of your site.

# Description
1. The main class of this router, is described in the file vendor/core/Router.php
2. The file RouterAutoload describes methods for automatically loading all site routes in controller/method format
3. All requests from the address bar, are redirected to the public folder on the index.php
4. Do not delete or rename the routes folder, and the routes.php file
5. It is not recommended, to delete and rename the main.php file in the app/controller folder
6. In the index.php file, the main.php file is connected, and the autoloading of classes is described.
7. A prerequisite for this router is to indicate the address in the browser line with the designation of the controller name and the name of the method described in this controller
/controllername/methodname

# Example
yourdomain.com
this route will connect the controller main and call the method will display the index page of the site

yourdomain.com/test/index
this route will connect the controller test and call the index method

