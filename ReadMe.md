# NFSH-ECOMM
![PHP Badge](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![](https://img.shields.io/badge/MySQL-4479A1.svg?style=for-the-badge&logo=MySQL&logoColor=white)
![](https://img.shields.io/badge/HTML5-E34F26.svg?style=for-the-badge&logo=HTML5&logoColor=white)
![](https://img.shields.io/badge/CSS3-1572B6.svg?style=for-the-badge&logo=CSS3&logoColor=white)
![](https://img.shields.io/badge/JavaScript-F7DF1E.svg?style=for-the-badge&logo=JavaScript&logoColor=black)
![](https://img.shields.io/badge/JSON-000000.svg?style=for-the-badge&logo=JSON&logoColor=white)
![NFSFU-ECOMM Banner](assets/origin/preview/NFSFU-ECOMM-BANNER.png)


NFSH-ECOMM is an E-Commerce website package application for small startups. which they can easily just run the installation and go on with thier sales without having to worry about simple issues. Regarding performances, data update across servers, etc.

This project is just an idea to test my skills in Web Development. At this point this is just for learning sake an time goes by I intend to work with people hopefully on this project.

## <h1 id="features">FEATURES OF NFSH-ECOMM v1.0.4-alpha </h1>

<p>

<h2>What's New?</h2>

<ul>

<li>

<h3>Installation Error Clearance</h3>

<p>
	The error of Access Denied of some files during the installation process has been fixed in this version.
</p>

</li>


<li>

<h3>Updated the logo parent logo for the site.</h3>

<p>
The logo for NFORSHIFU234 Dev have been updated.
</p>

</li>

<li>

<h3>Updated Error Message shown on Home page when no products is visible or when no product under a category is visible.</h3>

<p>
In this version, I have added an error to show on the Home Page(index.php) when the admins have not uploaded a product or made a product visible or when a category has no visible product under its category.
</p>

</li>

<li>

<h3>Accomodation for additional CSS and JS contents</h3>

<p>

In this version, I have added 2 files <b>custom.css</b> and <b>custom.js</b>. These files will be used to handle additional styling for the website. For example pages like (contact.php, about-us.php, terms-and-conditions.php, privacy-policy.php) will require additional CSS or JS functionality, so these files aid with that.

</p>

<p>
<b>custom.css</b> is located at "assets\css\custom.css". <br>
<b>custom.js</b> is located at "assets\js\custom.js".
</p>

</li>

<li>

<h3>Errors are only displayed to login users.</h3>
<p>

</p>
In this version, Errors that occur in the site are only visible to users that are logged in. If a user is not logged in and an error occurs, then the user sees a blank section or page depending on the situation.
</li>

<li>

<h3>Updated some few code lines on some admin pages.</h3>
<p>
Updated some few lines of the dashboard.php, and other admin pages. Nothing major.
</p>

</li>




</ul>

</p>

## <h1 id="features">FEATURES OF NFSH-ECOMM v1.0.0-alpha </h1>

<p>
NFSH-ECOMM v1.0.0-alpha features are listed below: 
</p>

<ul>

<ul>

<h2>
<b>User Features</b>
</h2>

<li>
	Home Page to display Recent Products
</li>

<li>
	The sidebar which shows random products and categories to view products from.
</li>

<li>
	About Us Page 
</li>
	
<li>
	Contact Us Page
</li>

<li>
	Privacy Policy Page
</li>

<li>
Terms and Conditions Page
</li>
	
<li>
	Shop Page to display all products in stock
</li>

<li>
	Search Page to search for products
</li>

<li>
	Category Page to view all products under a specific category
</li>

<li>
	Single Product View Page to view the detils of a product
	
	<
		------ Features ------
		->	Changes the hero image to any of the product images on click
		->	Edit Product Button if admin is logged in
		-----------------------
	>

</li>

<li>
	Login
</li>

<li>
	Logout
</li>

<h2>
<b>All Admin Features</b>
</h2>

<li>
	Create Product
</li>

<li>
	Create Categories

</li>

<li>
	Create Users

</li>

<li>
	View Product
</li>

<li>
	View Categories

</li>

<li>
	View Users

</li>

<li>
	View Site Information
</li>

<li>
	Edit Site Information status
</li>

<li>
	Login
</li>

<li>
	Logout
</li>

</ul>

</ul>

## <h1 id="partI">PART I - INSTALLATION</h1>
## <h2>How To Install NFSH-ECOMM</h2>

<ol>

<li>
Firstly, you will need to have an Apache Server installed on your local machine or you have an Apache hosting platform on the web. If you don't have this. Then you download XAMPP Apache Server. You can download it from <a href="https://www.wikihow.com/Install-XAMPP-for-Windows/" target="_blank" >here</a>
</li>

<li>
After you must have done that, you can now download NFSFU-ECOMM v1.0.0-alpha .zip file or .tar.gz file.
</li>

<li>
Once your download is complete, extract the file from the .zip file or .tar.gz file to your preferred location in your htdocs folder or www folder.
</li>

<li>
Open your browser and navigate to the folder (Example: If I extracted it to my htdocs folder on XAMPP Apache Server, then I will navigate to 
	"localhost/NFSFU-ECOMM/")

![NFSFU-ECOMM_browser_url](assets/origin/preview/NFSFU-ECOMM_browser_url.png)

</li>

<li>
Follow The Installaton Process and provide the neccessary information asked.
</li>

<li>
After the installation is successful, you will be redirected to the dashboard page. 
</li>

<li>
By default, the visibility status of the site is set to the "COMING SOON" status. To change that see "<a href="#partII">Part II</a>"
</li>

<li>
 If you wish to add products see "<a href="#partIII">Part III</a>" for more information, if you wish to add categories, see "<a hre="#partIV">PART IV</a>", if you wish to add users, see "<a href="#partV">PART V</a>"
</li>


</li>

</ol>


## <h1 id="partII">PART II - VISIBILITY STATUS</h1>
<ul>

<li>

 <h2>There are 4 VISIBILITY STATUS which are Active, Coming Soon, Maintainance and Offline. </h2>

 <ul>

<li>
	<h3>ACTIVE</h3>

![Coming Soon Preview](assets/origin/preview/NFSFU-ECOMM_homepage.png)

<p>
		The ACTIVE visibility status is the state where the site is opened to the users to view the products in stock and do their shopping.
	</p>
</li>

<li>
<h3>COMING SOON</h3>

![Coming Soon Preview](assets/origin/preview/NFSFU-ECOMM_coming-soon.png)

<p>
		The COMING SOON visibility status is the state where the site is opened to the users but the site has not been fully opened for buisness. 
	</p>
</li>

<li>
	<h3>MAINTAINACE</h3>

![Coming Soon Preview](assets/origin/preview/NFSFU-ECOMM_maintainance.png)

<p>
		The MAINTAINACE visibility status is the state where the site is under maintainance. For example updating the codes of the site or the hardware infrastructures, etc
	</p>
</li>

<li>
	<h3>OFFLINE</h3>

![Coming Soon Preview](assets/origin/preview/NFSFU-ECOMM_offline.png)

<p>
		The OFFLINE visibility status is the state where the site services to the users are restricted and the pages are not displayed.
	</p>
</li>

 </ul>

</li>

<li>

<h2>How to change your site VISIBILITY STATUS</h2>

<ol>

<p>
To change the visibility status of your site, follow the steps below
<p>

<li>
Login into your Super Admin account
</li>

<li>

![Header](assets/origin/preview/NFSFU-ECOMM_dashboard.png)

Navigate to "SITE INFORMATION" page. You can find the link on the side navigation or the third option of your dashboard page.
</li>

<li>
Click the edit icon (pen icon) and click the dropdown to change your staus

![Header](assets/origin/preview/NFSFU-ECOMM_site-details.png)
![Header](assets/origin/preview/NFSFU-ECOMM_site-detail-edit.png)

</li>

</ol>

</li>



</ul>
		
## <h1 id="partIII">PART III - CREATE NEW PRODUCTS</h1>
<div>
<p>
Now lets look at how to create new products.
</p>

<ul>

<li>
Login into your Super Admin or Product Manager account
</li>

<li>
Navigate to "CREATE NEW PRODUCT" page. You can find the link on the side navigation or the eighth (8) option of your dashboard page.

![Header](assets/origin/preview/NFSFU-ECOMM_dashboard.png)

</li>

<li>
Fill in the detils requested then click the "Add New Product Button"

![Header](assets/origin/preview/NFSFU-ECOMM_add-product.png)

</li>

<li>
<mark><b>NOTE:</b></mark> The maximum amount of upload file is 15. Meaning you can only upload a maximu of 15 images during creation of Products.
</li>

</ul>

</div>

## <h1 id="partIV">PART IV - CREATE NEW CATEGORIES</h1>
<div>
<p>
Now lets look at how to create new categories.
</p>

<ul>

<li>
Login into your Super Admin or Product Manager account
</li>

<li>
Navigate to "CREATE NEW CATEGORY" page. You can find the link on the side navigation or the nineth (9) option of your dashboard page.

![Header](assets/origin/preview/NFSFU-ECOMM_dashboard.png)

</li>

<li>
Fill in the detils requested then click the "Add New Category" Button

![Header](assets/origin/preview/NFSFU-ECOMM_add-category.png)

</li>


</ul>
</div>


## <h1 id="partV">PART V - CREATE USERS</h1>
<div>
<p>
Now lets look at how to create new users to run the site.
</p>

<ul>

<li>
Login into your Super Admin or Admin account
</li>

<li>
Navigate to "CREATE NEW USER" page. You can find the link on the side navigation or the tenth (10) option of your dashboard page.

![Header](assets/origin/preview/NFSFU-ECOMM_dashboard.png)

</li>

<li>
Fill in the detils requested then click the "Create Profile" Button

![Header](assets/origin/preview/NFSFU-ECOMM_profile-create.png)


</li>


</ul>
</div>
		
## <h1 id="partVI">PART VI - VIEW ALL PRODUCTS</h1>
<div>
<p>
Now lets look at where to view all our products.

</p>

<ul>

<li>
Login into your any type of account
</li>

<li>
Navigate to "VIEW ALL PRODUCTS" page. You can find the link on the side navigation or the fourth (3) option of your dashboard page.

![Header](assets/origin/preview/NFSFU-ECOMM_dashboard.png)

![Header](assets/origin/preview/NFSFU-ECOMM_view-products.png)

</li>


</ul>
</div>

## <h1 id="partVII">PART VII - VIEW ALL  CATEGORIES</h1>
<div>
<p>
Now lets look at where to view all our products.


</p>

<ul>

<li>
Login into your Super Admin or Product Manager account
</li>

<li>
Navigate to "VIEW ALL CATEGORIES" page. You can find the link on the side navigation or the fifth (5) option of your dashboard page.

![Header](assets/origin/preview/NFSFU-ECOMM_dashboard.png)

![Header](assets/origin/preview/NFSFU-ECOMM_view-category.png)

</li>


</ul>
</div>


## <h1 id="partXIII">PART XIII - CHANGE SITE INFORMATION</h1>

<div>
<p>
Now lets look at where  and how to view all our SITE INFORMATION
</p>

<ul>

<li>
Login into your Super Admin account
</li>

<li>
Navigate to "SITE INFORMATION" page. You can find the link on the side navigation or the third (3) option of your dashboard page.

![Header](assets/origin/preview/NFSFU-ECOMM_dashboard.png)

</li>

<li>
<p>
The only editable informations are the "SITE VISIBILITY" status and the "SITE NAME"

![Header](assets/origin/preview/NFSFU-ECOMM_site-details.png)

</p>

</li>
<ul>

<li>
	To do this, all you have to do is to click the edit(pen) button and it will take to the edit page and then you edit and click the "Update Button:

![Header](assets/origin/preview/NFSFU-ECOMM_site-detail-edit.png)


</li>

</ul>

</li>


</ul>
</div>

## <h1 id="partIX">PART IX - VIEW ALL USERS</h1>
<div>
<p>
Now lets look at where to view all our products.
</p>

<ul>

<li>
Login into your Super Admin or Admin account
</li>

<li>
Navigate to "VIEW ALL USERS" page. You can find the link on the side navigation or the sixth (6) option of your dashboard page.

![Header](assets/origin/preview/NFSFU-ECOMM_dashboard.png)

![Header](assets/origin/preview/NFSFU-ECOMM_view-users.png)

</li>

<p>
<mark>NOTE:</mark> By default you already have one <b>SUPER ADMIN USER</b> with the username of "<b>NFSFU-SA</b>", email of <b>super-admin@nforshifu234.dev</b> and password of "<b>NSFU-Pass123</b>"
</p>

</ul>
</div>

## <h1 id="partX">PART X - USER ACCOUNTS</h1>

<p>
To view Your profile, All you need to do is to navigate to "ACCOUNT" page. You can find the link on the side navigation or the second (2) option of your dashboard page.
<p>

<p>

Currently, there are only <b>4</b> type of ADMINS which are listed below:

<ul>

<li>

<h3>


<b>User</b>


</h3>

<p>
This type of users can only view all products that are public. 


</p>

![User Dashboard Image](assets/origin/preview/NFSFU-ECOMM_user_dashboard.png)

</li>

<li>

<h3>
	


<b>Admin</b>
</h3>

<p>
This type of users can only create new users, view & edit all users and view all products that are public. 
</p>

![Admin Dashboard Image](assets/origin/preview/NFSFU-ECOMM_admin-dashboard.php.png)

</li>

<li>

<h3>


<b>Product Manager</b>


</h3>

<p>
This type of users can only create new products, create new categories, view all products that are both public and private, view all categories, edit products and edit categories. 
</p>

![Product Manager Dashboard Image](assets/origin/preview/NFSFU-ECOMM_product-manager_dashboard.png)

</li>

<li>

<h3>


<b>SUPER ADMIN</b>
	

</h3>

<p>
This type of users can do all the activities that the other admins do. The distinguishing feature about this types of admins is that they :

<ul>

<li>
	Can change the name of the store
</li>

<li>
	Can change the visibility status of the store/site
</li>

<li>
	Can view the time when a change was made last in the whole Store and who changed it
</li>

</ul>

</p>

![SUPER ADMIN Dashboard Image](assets/origin/preview/NFSFU-ECOMM_super-admin-dashboard.png)

</li>

</ul>

</p>

## <h1 id="partXI">PART XI - Edit Pages</h1>
<p>
If you want to edit a page, you cannot possibly do that. But there are some pages which you can edit. View the table below to view which pages can be edited. 
</p>

<table>

<thead>

<tr style="border:solid 2px">

<th style="border-right: solid 1px;" >
	#
</th >
	
<th style="border-right: solid 1px;">
SITE NAME
</th>

<th style="border-right: solid 1px;">
	SITE PATH
</th>

<th style="border-right: solid 1px;">
SITE DESCRIPTION
</th>

</tr>

</thead>

<tbody style="border: solid 1px;" >

<tr >

<td scope="row" style="border: solid 1px;" >

</td>

<td scope="row" style="border: solid 1px;" >
ABOUT US PAGE
</td>

<td scope="row" style="border: solid 1px;" >
assets\pages\about.php
</td>

<td scope="row" style="border: solid 1px;" >
This is the page where customers will be able to know about your brand.
</td>


</tr>

<tr >

<td scope="row" style="border: solid 1px;" >

</td>

<td scope="row" style="border: solid 1px;" >
CONTACT US PAGE
</td>

<td scope="row" style="border: solid 1px;" >
assets\pages\contact-us.php
</td>

<td scope="row" style="border: solid 1px;" >
This is the page where customers will be able to contact you and get other information on support information.
</td>


</tr>

<tr >

<td scope="row" style="border: solid 1px;" >

</td>

<td scope="row" style="border: solid 1px;" >
TERMS AND CONDITIONS PAGE
</td>

<td scope="row" style="border: solid 1px;" >
assets\pages\terms-and-conditions.php
</td>

<td scope="row" style="border: solid 1px;" >
This is the page where customers will be able to see the Terms and Conditions while using your site.
</td>


</tr>

<tr >

<td scope="row" style="border: solid 1px;" >

</td>

<td scope="row" style="border: solid 1px;" >
PRIVACY POLICY PAGE
</td>

<td scope="row" style="border: solid 1px;" >
assets\pages\privacy-policy.php
</td>

<td scope="row" style="border: solid 1px;" >
This is the page where customers will be able to see the Privacy Policy that your site is using.
</td>


</tr>

</tbody>

</table>

## <h2 id="partXII">PART XII . 1 - How To Edit Pages</h2>
<p>

To to edit the pages above, you can just replace everything in that file with all the contents that are supposed to be in the body tag of your HTML page.

</p>

<hr>


<hr>

## <h1 align="center" style="padding-top:1em;padding-bottom:1em;" >THANK YOU FOR USING <a target="_blank" href="https://www.instagram.com/nforshifu234dev/" style="color:lightblue;" >NFORSHIFU234 Dev</a>
</h1>


 
<div align="center" > 
<h1> FOLLOW ME: </h1>
<ul style="list-style-type: none;" >


<li>
	<h2 style="display:inline-block;" >Twitter:</h2> <a target="_blank" href="https://www.twitter.com/nforshifu234dev/" style="color:lightblue;" >@NFORSHIFU234DEV</a>
</li>

<li>
	<h2 style="display:inline-block;" >Instagram:</h2> <a target="_blank" href="https://www.instagram.com/nforshifu234dev/" style="color:lightblue;" >@NFORSHIFU234DEV</a>
</li>


<li>
	<h2 style="display:inline-block;" >E-Mail:</h2> <a target="_blank" href="mailto:nforshifu234.dev@gmail.com" style="color:lightblue;" >@NFORSHIFU234.dev@gmail.com</a>
</li>


</ul>
<hr>
<div>

</p>
