
                                                                    WELCOME TO NFSH-ECOMM v0.01 by NFORSHIFU234 Dev CODES

ABOUT NFSH-ECOMM v0.01

    NFSH-ECOMM is an E-Commerce website package application for small startups. which they can easily just run the installation and go on with thier sales without having to worry about simple issues. Regarding performances, data update across servers, etc.

TOOLS USED TO BUILD NFSH-ECOMM v0.01

    Bootstrap ~ This frontend framework was used to generate the underlaying responsive User Interface of the whole application
    Native CSS ~ This frontend framework
    Vanilla PHP ~ The core language and tool powering the whole backend and data transmition. This app will run on all PHP versions.
    JQuery v3.6.3 ~ To Use along side Bootstrap
    Vanilla JS ~ For Basic Events, like AJAX request, login validation messeges, etc
    Fonts Awesome v6.2.1 ~ For the icons.
    MySQL ~ For storing data in the database
    FEATURES OF NFSH-ECOMM v0.01
    NFSH-ECOMM v0.01 features are listed below:

User Features

    Home Page to display Recent Products
    The sidebar which shows random products and categories to view products from.
    About Us Page
    Contact Us Page
    Privacy Policy Page
    Terms and Conditions Page
    Shop Page to display all products in stock
    Search Page to search for products
    Category Page to view all products under a specific category
    Single Product View Page to view the detils of a product
        <
            ------ Features ------
            ->	Changes the hero image to any of the product images on click
            ->	Edit Product Button if admin is logged in
            -----------------------
        >
    Login
    Logout

All Admin Features

    Create Product
    Create Categories
    Create Users
    View Product
    View Categories
    View Users
    View Site Information
    Edit Site Information status
    Login
    Logout

PART I - INSTALLATION

    How To Install NFSH-ECOMM

        - Extract the file from the .rar file to your preffered location in your htdocs folder or www folder
        - Open your browser and navigate to the folder (Example: If I extracted it to my htdocs folder on XAMPP Apache Server, then I will navigate to "localhost/bolu-site")
        - Follow The Installaton Process and provide the neccessary information asked.
        - After the installation is successful, click on the user icon at the right of the screen and it should take you to the login page
        - Fill in your database admin username and password you entered at the intallation phase.
        - Once the Login is successful, you will be redirected to the admin dashboard
        - By default, the visibility status of the site is set to the "COMING SOON" status. To change that see "Part II"
        - If you wish to add products see "Part III" for more information, if you wish to add categories, see "PART IV", if you wish to add users, see "PART V"

PART II - VISIBILITY STATUS

    There are 4 VISIBILITY STATUS which are Active, Coming Soon, Maintainance and Offline.

        ACTIVE
            The ACTIVE visibility status is the state where the site is opened to the users to view the products in stock and do their shopping.

        COMING SOON
            The COMING SOON visibility status is the state where the site is opened to the users but the site has not been fully opened for buisness.

        MAINTAINACE
            The MAINTAINACE visibility status is the state where the site is under maintainance. For example updating the codes of the site or the hardware infrastructures, etc

        OFFLINE
            The OFFLINE visibility status is the state where the site services to the users are restricted and the pages are not displayed.

    How to change your site VISIBILITY STATUS
        To change the visibility status of your site, follow the steps below

            - Login into your Super Admin account
            - Navigate to "SITE INFORMATION" page. You can find the link on the side navigation or the first option of your dashboard page.
            - Click the edit icon (pen icon) and click the dropdown to change your status

PART III - CREATE NEW PRODUCTS

    Now lets look at how to create new products.

        - Login into your Super Admin account
        - Navigate to "CREATE NEW PRODUCT" page. You can find the link on the side navigation or the seventh (7) option of your dashboard page.
        - Fill in the detils requested then click the "Add New Product Button"
        - NOTE: The maximum amount of upload file is 15. Meaning you can only upload a maximu of 15 images during creation of Products.

PART IV - CREATE NEW CATEGORIES
    Now lets look at how to create new categories.

        - Login into your Super Admin account
        - Navigate to "CREATE NEW CATEGORY" page. You can find the link on the side navigation or the eighth (8) option of your dashboard page.
        - Fill in the detils requested then click the "Add New Category" Button

PART V - CREATE USERS
    Now lets look at how to create new users to run the site.

        - Login into your Super Admin account
        - Navigate to "CREATE NEW USER" page. You can find the link on the side navigation or the nineth (9) option of your dashboard page.
        - Fill in the detils requested then click the "Create Profile" Button

PART VI - VIEW ALL PRODUCTS
    Now lets look at where to view all our products.

        - Login into your Super Admin account
        - Navigate to "VIEW ALL PRODUCTS" page. You can find the link on the side navigation or the third (3) option of your dashboard page.

PART VII - VIEW ALL CATEGORIES
    Now lets look at where to view all our products.

        - Login into your Super Admin account
        - Navigate to "VIEW ALL CATEGORIES" page. You can find the link on the side navigation or the fourth (4) option of your dashboard page.

PART XIII - CHANGE SITE INFORMATION
    Now lets look at where and how to view all our SITE INFORMATION

        - Login into your Super Admin account
        - Navigate to "SITE INFORMATION" page. You can find the link on the side navigation or the first (1) option of your dashboard page.
        - The only editable informations are the "SITE VISIBILITY" status and the "SITE NAME"

        To do this, all you have to do is to click the edit(pen) button and it will take to the dit page and then you edit and click the "Update Button"

PART IX - VIEW ALL USERS
    Now lets look at where to view all our products.

    - Login into your Super Admin account
    - Navigate to "VIEW ALL USERS" page. You can find the link on the side navigation or the fifth (4) option of your dashboard page.
    - NOTE: By default you already have one SUPER ADMIN USER with the username of "NFSFU-SA" and password of "NFSFU-Pass123"

PART X - USER ACCOUNTS
    To view Your profile, All you need to do is to navigate to "ACCOUNT" page. You can find the link on the side navigation or the second (2) option of your dashboard page.

    Currently, there are only 4 type of ADMINS which are listed below:

        User
            This type of users can only view all products that are public.

        Admin
            This type of users can only create new users, view & edit all users and view all products that are public.

        Product Manager
            This type of users can only create new products, create new categories, view all products that are both public and private, view all categories, edit products and edit categories.

        SUPER ADMIN
            This type of users can do all the activities that the other admins do. The distinguishing feature about this types of admins is that they :

                - Can change the name of the store
                - Can change the visibility status of the store/site
                - Can view the time when a change was made last in the whole Store and who changed it

PART XI - Edit Pages
    If you want to edit a page, you cannot possibly do that. But there are some pages which you can edit. View the table below to view which pages can be edited.

    |-------|-----------------------------------------------|-------------------------------------------------------|---------------------------------------------------------------------------------------------------------------|
    |   #	|               SITE NAME	                    |               SITE PATH	                            |                                                               SITE DESCRIPTION                                |
    |-------|-----------------------------------------------|-------------------------------------------------------|---------------------------------------------------------------------------------------------------------------|
    |       |           ABOUT US PAGE	                    |      assets\pages\about.php	                        |   This is the page where customers will be able to contact your brand using forms, etc.                       |
    |       |           CONTACT US PAGE	                    |      assets\pages\contact-us.php	                    |   This is the page where customers will be able to about your brand, the vison and a whole lot more.          |
    |       |       TERMS AND CONDITIONS PAGE	            |      assets\pages\terms-and-conditions.php	        |   This is the page where customers will be able to see the Terms and Conditions while using your site.        |
    |       |           PRIVACY POLICY PAGE	                |      assets\pages\contact-us.php	                    |   This is the page where customers will be able to see the Privacy Policy that your site is using.            |
    |_______|_______________________________________________|_______________________________________________________|_______________________________________________________________________________________________________________|

PART XII - How To Edit Pages

    To to edit the pages above, you can just replace evverything in that file with all the contents that are supposed to be in the body tag of your HTML page.

                                                                                    NFSH-ECOMM v0.01 by NFORSHIFU234Dev CODES

                                                                                    THANK YOU FOR USING NFORSHIFU234Dev CODES
                                                                                                FOLLOW ME:
                                                                                            Twitter: @NFORSHIFU234DEV
                                                                                            Instagram: @NFORSHIFU234_DEV
                                                                                            E-Mail: @nforshifu234.dev@gmai.com
