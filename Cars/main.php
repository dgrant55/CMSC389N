<?php
	require_once("dbUtil.php");	

	class Car {
		public $year;
		public $manufacturer;
		public $model;
		public $image;
		public $imgpath;
		public $category;
		public $size;
		public $msrp;
		public $mpg;
		public $stars;
		public $fuel;
	
		public function __construct($year, $manufacturer, $model, $image, $imgpath, $category, $size, $msrp, $mpg, $stars, $fuel) {
			$this->year = $year;
			$this->manufacturer = $manufacturer;
			$this->model = $model;
			$this->image = $image;
			$this->imgpath = $imgpath;
			$this->category = $category;
			$this->size = $size;
			$this->msrp = $msrp;
			$this->mpg = $mpg;
			$this->stars = $stars;
			$this->fuel = $fuel;
		}
	
		public function __toString() {
			return $this->year." ".$this->manufacturer." ".$this->model;		
		}
	}
?>

<!doctype html>
<html>
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <title>Car Finder</title>
        <link rel="stylesheet" href="stylesheet.css" type="text/css" /> 
        <script src="main.js"></script>
    </head>

    <body>
    	<?php
    		
    		$carlist = [];

    		if(isset($_GET["submit"])){
    			$db_connection = connectToDB($host, $user, $password, $database);

    			$query = sprintf("SELECT * FROM $table WHERE (
		    				(category IN (%s)) AND
		    				(size     IN (%s)) AND
		    				(msrp     <=  %s ) AND
		    				(mpg      >=  %s ) AND
		    				(stars    >=  %s ) AND
		    				(fuel     IN (%s))     )
		    			ORDER BY %s;",
    				implode(", ", $_GET["categories"]), 
    				implode(", ", $_GET["sizes"]), 
    				$_GET["msrp"], 
    				$_GET["mpg"], 
    				$_GET["stars"], 
    				implode(", ", $_GET["fuel"]),
    				$_GET["sortBy"]);

				$result = $db_connection->query($query);

				if ($result) {
					$numberOfRows = mysqli_num_rows($result);
					while ($recordArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				     	$year = $recordArray['year'];
						$manufacturer = $recordArray['manufacturer'];
						$model = $recordArray['model'];
						$image = $recordArray['image'];
						$imgpath = $recordArray['imgpath'];

						$category = $recordArray['category'];
						$size = $recordArray['size'];
						$msrp = $recordArray['msrp'];
						$mpg = $recordArray['mpg'];
						$stars = $recordArray['stars'];
						$fuel = $recordArray['fuel'];

						$carlist[] = new Car($year, $manufacturer, $model, $image, $imgpath, $category, $size, $msrp, $mpg, $stars, $fuel);

		     		}
					mysqli_free_result($result);
				}

				disconnectFromDB($db_connection);
    		}
    	?>

		<p class = "right">
		<?php
			session_start();
			if (isset($_SESSION['username']) && $_SESSION['username'] != "") {
				echo "Welcome, ".$_SESSION['username']."! ";
				echo "<a class=\"right\" href=\"logout.php\" alt=\"Log Out\">Log Out </a>";
			} else {
				echo "&nbsp;&nbsp;";
				echo "<a class=\"right\" href=\"signup.html\" alt=\"Sign Up\">Sign Up</a>&nbsp;";
				echo "<a class=\"right\" href=\"login.html\" alt=\"Log In\">Log In</a>";
			}
		?>
		</p>

    	<header>
    		<h1>Find a Car</h1>
    		<hr>
		</header>
	    <div id="content">
	        <div id="sidebar">
		        <form action="main.php" id="form1">
					<p>			
						<strong>Category: </strong><br />
						<select name ="categories[]" multiple="multiple">
							<option value="'convertible'">Convertible</option>
							<option value="'coupe'">Coupe</option>
							<option value="'sedan'" selected="selected">Sedan</option>
							<option value="'hatchback'">Hatchback / Wagon</option>
							<option value="'suv'">SUV</option>
							<option value="'pickup'">Pickup Truck</option>
							<option value="'van'">Van</option>
						</select>	
					</p>
					<p>			
						<strong>Size: </strong><br />
						<select name ="sizes[]" multiple="multiple">
							<option value="'compact'">Compact</option>
							<option value="'midsize'" selected="selected">Midsize</option>
							<option value="'fullsize'">Fullsize</option>
						</select>	
					</p>
					<p>			
						<strong>Maximum MSRP: </strong>
						<output id="MSRPout" for="msrp">$200000</output><br />
						<input class="range" type="range" id="msrp" name="msrp" min="0" max="200000" value="200000" oninput="updateMSRPout()">	
					</p>
					<p>			
						<strong>Minimum MPG: </strong>
						<output id="MPGout" for="mpg">0 MPG</output><br />
						<input class="range" type="range" id="mpg" name="mpg" min="0" max="50" value="0" oninput="updateMPGout()">	
					</p>
					<p>			
						<strong>Minimum Safety Rating: </strong><br />
						<span class="rating">
						    <input type="radio" class="rating-input"
						        id="rating-input-1-5" name="stars" value="5">
						    <label for="rating-input-1-5" class="rating-star"></label>
						    <input type="radio" class="rating-input"
						        id="rating-input-1-4" name="stars" value="4">
						    <label for="rating-input-1-4" class="rating-star"></label>
						    <input type="radio" class="rating-input"
						        id="rating-input-1-3" name="stars" value="3" checked="checked">
						    <label for="rating-input-1-3" class="rating-star"></label>
						    <input type="radio" class="rating-input"
						        id="rating-input-1-2" name="stars" value="2">
						    <label for="rating-input-1-2" class="rating-star"></label>
						    <input type="radio" class="rating-input"
						        id="rating-input-1-1" name="stars" value="1">
						    <label for="rating-input-1-1" class="rating-star"></label>
						</span>		
					</p>
					<p>
						<strong>Fuel: </strong><br />
						<select name ="fuel[]" multiple="multiple">
							<option value="'gas'" selected="selected">Gas</option>
							<option value="'diesel'">Diesel</option>
							<option value="'hybrid'">Hybrid</option>
							<option value="'electric'">Electric</option>
						</select>
					</p>
					<br><br>
					<p>
						<input type="reset" value="Reset Filters"/>
						<input type="submit" name="submit" value="Filter Results"/>
					</p>
				</form>
	        </div>
	        <div id="main">
	            <div id="sortByDiv">
	            	<br>
            		<strong>Sort by: </strong>
					<select id="sortBy" form="form1" name ="sortBy">
						<option id="Lowest Price" value="msrp ASC">Lowest Price</option>
						<option id="Highest Price" value="msrp DESC">Highest Price</option>
						<option id="Newest" value="year DESC">Newest</option>
						<option id="Oldest" value="year ASC">Oldest</option>
						<option id="Safest" value="stars DESC">Safest</option>
					</select>
					<br>
	        	</div>
	        	<div id="results">
	            	<ul id="resultsList">
	            		<?php
	            			foreach ($carlist as $key => $value) {
	            				?>
	            				<li>
		            				<figure onclick=<?php echo
			            				"moreInfo(".
			            				$value->year.",".
										$value->manufacturer.",".
										$value->model.",".
										$value->image.",".
										$value->imgpath.",".
										$value->category.",".
										$value->size.",".
										$value->msrp.",".
										$value->mpg.",".
										$value->stars.",".
										$value->fuel.
										")"
									?>>
									  	<img src=<?php echo $value->imgpath; ?> width="150" height="80">
									  	<figcaption><?php echo $value; ?></figcaption>
									</figure>
								</li>
								<?php
	            			}
	            		?>
	            	</ul>
	        	</div>
	        </div>
	    </div>
    </body>
</html>