<div class="col-md-3 contact-right">	
	<style>
	.nav-side-menu {
  overflow: auto;
  font-family: verdana;
  font-size: 12px;
  font-weight: 200;
  background-color: #2e353d;
  width: 100%;
  height: 100%;
  color: #e1ffff;
}
.nav-side-menu .brand {
  background-color: #23282e;
  line-height: 50px;
  display: block;
  text-align: center;
  font-size: 14px;
}
.nav-side-menu .toggle-btn {
  display: none;
}
.nav-side-menu ul,
.nav-side-menu li {
  list-style: none;
  padding: 0px;
  margin: 0px;
  line-height: 35px;
  cursor: pointer;
  /*    
    .collapsed{
       .arrow:before{
                 font-family: FontAwesome;
                 content: "\f053";
                 display: inline-block;
                 padding-left:10px;
                 padding-right: 10px;
                 vertical-align: middle;
                 float:right;
            }
     }
*/
}
.nav-side-menu ul :not(collapsed) .arrow:before,
.nav-side-menu li :not(collapsed) .arrow:before {
  font-family: FontAwesome;
  content: "\f078";
  display: inline-block;
  padding-left: 10px;
  padding-right: 10px;
  vertical-align: middle;
  float: right;
}
.nav-side-menu ul .active,
.nav-side-menu li .active {
  border-left: 3px solid #d19b3d;
  background-color: #4f5b69;
}
.nav-side-menu ul .sub-menu li.active,
.nav-side-menu li .sub-menu li.active {
  color: #d19b3d;
}
.nav-side-menu ul .sub-menu li.active a,
.nav-side-menu li .sub-menu li.active a {
  color: #d19b3d;
}
.nav-side-menu ul .sub-menu li,
.nav-side-menu li .sub-menu li {
  background-color: #181c20;
  border: none;
  line-height: 28px;
  border-bottom: 1px solid #23282e;
  margin-left: 0px;
}
.nav-side-menu ul .sub-menu li:hover,
.nav-side-menu li .sub-menu li:hover {
  background-color: #020203;
}
.nav-side-menu ul .sub-menu li:before,
.nav-side-menu li .sub-menu li:before {
  font-family: FontAwesome;
  content: "\f105";
  display: inline-block;
  padding-left: 10px;
  padding-right: 10px;
  vertical-align: middle;
}
.nav-side-menu li {
  padding-left: 0px;
  border-left: 3px solid #2e353d;
  border-bottom: 1px solid #23282e;
}
.nav-side-menu li a {
  text-decoration: none;
  color: #e1ffff;
}
.nav-side-menu li a i {
  padding-left: 10px;
  width: 20px;
  padding-right: 20px;
}
.nav-side-menu li:hover {
  border-left: 3px solid #d19b3d;
  background-color: #4f5b69;
  -webkit-transition: all 1s ease;
  -moz-transition: all 1s ease;
  -o-transition: all 1s ease;
  -ms-transition: all 1s ease;
  transition: all 1s ease;
}
@media (max-width: 767px) {
  .nav-side-menu {
    position: relative;
    width: 100%;
    margin-bottom: 10px;
  }
  .nav-side-menu .toggle-btn {
    display: block;
    cursor: pointer;
    position: absolute;
    right: 10px;
    top: 10px;
    z-index: 10 !important;
    padding: 3px;
    background-color: #ffffff;
    color: #000;
    width: 40px;
    text-align: center;
  }
  .brand {
    text-align: left !important;
    font-size: 22px;
    padding-left: 20px;
    line-height: 50px !important;
  }
}
@media (min-width: 767px) {
  .nav-side-menu .menu-list .menu-content {
    display: block;
  }
}

	</style>
	<?php
	if(isset($_SESSION[employeeid]))
	{
	?>
<div class="nav-side-menu">			
    <div class="brand">Employee Menu</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse out">

                <li>
                  <a href="dashboard.php">
                  <i class="fa fa-dashboard fa-lg"></i> Dashboard
                  </a>
                </li>
<?php
if($_SESSION["employeetype"] == "Admin")
{
?>
                <li  data-toggle="collapse" data-target="#Category" class="collapsed ">
                  <a href="#" onclick="return false;"><i class="fa fa-gift fa-lg"></i> Category <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="Category">
                    <li><a href="category.php">Add Category</a></li>
                    <li><a href="viewcategory.php">View Category</a></li>
                </ul>
                <li data-toggle="collapse" data-target="#city" class="collapsed">
                  <a href="#" onclick="return false;"><i class="fa fa-globe fa-lg"></i> city <span class="arrow"></span></a>
                </li>  
                <ul class="sub-menu collapse" id="city">
                  <li><a href="city.php">Add city</a></li>
                    <li><a href="viewcity.php">View city</a></li>
                </ul> 

                <li data-toggle="collapse" data-target="#item" class="collapsed">
                  <a href="#" onclick="return false;"><i class="fa fa-globe fa-lg"></i> item <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="item">
                   <li><a href="item.php">Add item</a></li>
                    <li><a href="viewitem.php">View item</a></li>
                </ul>
				
                <li data-toggle="collapse" data-target="#location" class="collapseed">
                  <a href="#" onclick="return false;"><i class="fa fa-globe fa-lg"></i> location <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="location">
                   <li><a href="location.php">Add location</a></li>
                    <li><a href="viewlocation.php">View location</a></li>
                </ul>

                 <li data-toggle="collapse" data-target="#employee" class="collapsed">
                  <a href="#" onclick="return false;"><i class="fa fa-globe fa-lg"></i> employee <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="employee">
                   <li><a href="employee.php">Add employee</a></li>
                    <li><a href="viewemployee.phpm">View employee</a></li>
                </ul>
				
                 <li data-toggle="collapse" data-target="#offer" class="collapsed">
                  <a href="#" onclick="return false;"><i class="fa fa-globe fa-lg"></i> offer <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="offer">
                   <li><a href="offer.php">Add offer</a></li>
                    <li><a href="viewoffer.php">View offer</a></li>
                </ul>
<?php
}
?>
                <li data-toggle="collapse" data-target="#Restaurant" class="collapsed ">
                  <a href="#" onclick="return false;" ><i class="fa fa-globe fa-lg"></i> Restaurant <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu 
				<?php
				if(basename($_SERVER['PHP_SELF']) == "restaurant.php" || basename($_SERVER['PHP_SELF']) == "viewrestaurant.php")
				{
					echo "";
				}
				else
				{
					echo "collapse";
				}
				?>" id="Restaurant">
					<li><a href="restaurant.php" >Add Restaurant</a></li>
                    <li><a href="viewrestaurant.php">View Restaurant</a></li>
                </ul>

<?php
if($_SESSION["employeetype"] == "Admin")
{
?>
                <li data-toggle="collapse" data-target="#Report" class="collapsed">
                  <a href="#" onclick="return false;"><i class="fa fa-globe fa-lg"></i> Report <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="Report">
                    <li><a href="viewpayment.php">Food Order Payment Report</a></li>
                    <li><a href="viewfoodorders.php">Standard Food Order Report</a></li>
                    <li><a href="viewdailyfoodorders.php">Daily Food Order Report</a></li>
					<li><a href="viewcustomer.php">customer report</a></li>
                    <li><a href="loginreport.php">Login report</a></li>
                </ul>	
<?php
}
else
{
?>
                <li>
                  <a href="viewpayment.php?deltype=Pending">
                  <i class="fa fa-dashboard fa-cutlery"></i> Pending Food Delivery Report
                  </a>
                </li>
				
				<li>
                  <a href="viewdelivertedpayment.php?deltype=Delivered">
                  <i class="fa fa-dashboard fa-cutlery"></i> Completed Delivery Report
                  </a>
                </li>
				
<?php
}
?>			
            </ul>
     </div>
</div>
	<?php
	}
	?>
	<?php
	if(isset($_SESSION[restaurantid]))
	{
	?>
<div class="nav-side-menu">			
    <div class="brand">Restaurant Menu</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse out">

			<?php
			if(isset($_SESSION[restaurantid]))
			{
			?>
				
				<li>
                  <a href="restaurantaccount.php">
                  <i class="fa fa-dashboard fa-lg"></i> Main
                  </a>
                </li>
				
				<li data-toggle="collapse" data-target="#profile" class="collapsed">
                  <a href="#" onclick="return false;"><i class="fa fa-globe fa-lg"></i> profile <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="profile">
                    <li><a href="restaurantprofile.php">Profile</a></li>
					<li><a href="restchangepassword.php">Change password</a></li>
                </ul>
				  
				<li data-toggle="collapse" data-target="#itema" class="collapsed">
                  <a href="#" onclick="return false;"><i class="fa fa-globe fa-lg"></i> item <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="itema">
                   <li><a href="item.php">Add item</a></li>
                    <li><a href="viewitem.php">View item</a></li>
                </ul>
				
				
                 <li>
                  <a href="viewfoodorders.php">
                  <i class="fa fa-users fa-lg"></i> Food order
                  </a>
                </li>                 

                 <li>
                  <a href="viewdailyfoodorders.php">
                  <i class="fa fa-users fa-lg"></i> Daily orders
                  </a>
                </li>
				
				
				<li>
                  <a href="viewrestaurantpayment.php">
                  <i class="fa fa-users fa-lg"></i> view Income Report
                  </a>
                </li>
				
	
				
				<li>
                  <a href="logout.php">
                  <i class="fa fa-users fa-lg"></i> logout
                  </a>
                </li>
			<?php
			}
			?>
				
				
            </ul>
     </div>
</div>
	<?php
	}
	?>
</div>