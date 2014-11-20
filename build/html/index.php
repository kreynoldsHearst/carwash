<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="assets/css/style.css" />
<link rel="shortcut icon" type="image/x-icon" href="/assets/images/favicon.ico" />
<title>Carwash Trader</title>
</head>

<body>

	<div class="body">
        <header>
        	<img src="assets/images/carwash-trader.png" />
        </header>
        
        <nav>
        	<ul>
            <li><a class="active" href="">Home</a></li>
            <li><a href="">Car Wash For Sale</a></li>
            <li><a href="">Car Wash Franchise</a></li>
            <li><a href="">Suppliers</a></li>
            <li><a href="">Products</a></li>
            <li><a href="">Jobs</a></li>
            <li><a href="">About Us</a></li>
            <li><a href="">Contact Us</a></li>
        </nav>
        
        <h1>Welcome to Carwash Trader</h1>
        
        <section>
        	<div class="filter">
            	<div class="header">Filter Listings</div>
                <ul>
                <li><a href="">Hand Car Wash</a></li>
                <li><a href="">Drive Through</a></li>
                <li><a href="">Mobile Valets</a></li>
                <li><a href="">Auto Detailers</a></li>
                <li><a href="">Jet Wash</a></li>
                <li><a href="">Properties</a></li>
                </ul>
            </div>
            
        	<div class="jobalerts">
            	<div class="header">Job Alerts</div>
                <ul>
                <li><a href="">Hand Car Wash</a></li>
                <li><a href="">Properties</a></li>
                </ul>
            	<div class="footer">Register to sign up for free job alerts</div>
            </div>
            
        	<div class="reviews">
            	<div class="header">Feedback</div>
                <ul>
                <li><a href="">Hand Car Wash</a></li>
                <li><a href="">Properties</a></li>
                </ul>
            	<div class="footer">Register to review car washes</div>
            </div>
            
            <div class="advert"><img src="assets/images/adspace-skyscraper.gif" /></div>
        </section>
        
        <article>
        	<div class="filterBox">Filter</div>
            
            <h2>Car Wash for Sale</h2>
            
            <?php for($i=0; $i<4; $i++) { ?>
            <div class="listing">
            	<div class="listingInner">
                    <div class="listing-photo"><img src="assets/images/listing-photo.jpg" /></div>
                    <div class="listingInfo">
                    	<h3>Jet Carwash Ltd</h3>
                        <div class="listingInfoDetailsLeft">
                            8 Crawley Road, Reading, Berkshire, RG4 7PY<br />
                           	<b>Monday - Friday</b> 8am - 8pm<br />
                            <b>Saturday</b> 8am - 4pm<br />
	                        <b>Sunday</b> 10am - 4pm
                        </div>
                        <div class="listingInfoDetailsRight">
                        	<b>Company Information</b><br />
                            Lorem ipsum dolor sit amet, consectetur adipi elit. Donec imperdiet ex quis mi eleifend 
                            luctus. Nulla facilisi. Donec sodalevolutp onec imperdiet ex quis mi elipsum donsectetu.
                        </div>
                    </div>
                </div>
                <div class="listingContact">
                	Tel: <b>0118 9077 884</b>
                </div>
            </div>
            <?php } ?>
            
            <div class="adverts">
            	<div class="advert"></div>
            	<div class="advert"></div>
            	<div class="advert"></div>
            </div>
        </article>
        
        <footer>hello</footer>
    </div>

</body>
</html>