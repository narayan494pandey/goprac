
<!doctype html>
<html>
    <head>
    <link href="./styles.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
               $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
    </script>
    
    </head>
    <body>
        <div class="container">
            <div class="header">
                <div class="header__logo">
                    <a href="#" class="header__logo">
                        <img src="https://goprac.com/images/logo1.png">
                    </a>
                </div>
                <div class="header__menu">
                    <div class="dropdown">
                            <button class="dropbtn">CATEGORIES</button>
                            <div class="dropdown-content">
                                <li>
                                    <div class="sub__dropdown">
                                        <a href="#">Computer Science</a> 
                                        <ul class="sub__dropdown-content">
                                            <li><a href="#">Data Structure</a></li>
                                            <li><a href="#">Java</a></li>
                                            <li><a href="#">Database and SQL</a></li>
                                        </ul>
                                    </div>
                                   
                                </li>
                                <li>
                                    <div class="sub__dropdown">
                                        <a href="#">Hot Skills</a> 
                                        <ul class="sub__dropdown-content">
                                            <li><a href="#">Data Science</a></li>
                                            <li><a href="#">Business Analyst</a></li>
                                            <li><a href="#">Product Managment</a></li>
                                        </ul>
                                    </div>
                                    
                                </li>
                                <li>
                                    <div class="sub__dropdown">
                                        <a href="#">Programming</a> 
                                        <ul class="sub__dropdown-content">
                                            <li><a href="#">C/C++</a></li>
                                            <li><a href="#">OOPS</a></li>
                                            <li><a href="#">Software Programming</a></li>
                                        </ul>
                                    </div>
                                    
                                </li> 
                            </div>    
                    </div>
                   <div>
                        <a href="https://goprac.com/why-practice" target="_self" class="header__link">
                            <img src="https://goprac.com/images/practice.png" />
                            WHY PRACTICE</a>
                    </div>
                    <div>
                        <a href="https://goprac.com/how-it-works" target="_self" class="header__link">
                            <img src="https://goprac.com/images/how-it-works.png" />
                            HOW IT WORKS
                        </a>
                    </div>
                    <div>
                        <a href="https://goprac.com/expertlist"  target="_self" class="header__link">
                            <img src="https://goprac.com/images/expertpanel.png" /> 
                            EXPERT PANEL
                        </a>
                    </div> 
                    <div>
                        <a href="https://goprac.com/aboutus" target="_self"class="header__link">
                            <img src="https://goprac.com/images/about-us.png" />
                            ABOUT US
                        </a>
                    </div>     
                </div>
                <div class="header__profile" >
                    <img src="https://goprac.com/images/user-avatar.png" />
                    <a href="#">Login</a>
                </div>
            </div>
            <div class="section">
                <div class="form"> 
                    <form method="post" action="edit.php" class="generate">
                        <input type="text" placeholder="update value" name="code" maxlength="6">
                        <input type=hidden name=code_id value="<?php echo $row["code_id"]; ?>" >
                        <input type=submit value=update name=update >
                    </form>
                </div>
                <div class="table">
                <?php
                $hostname="localhost";
	            $username="root";
	            $password="narayan1";                                      
	            $database="coder";
	            $conn=mysqli_connect($hostname,$username,$password,$database);
	            if (!$conn) {
		            die("connection failed:".mysqli_connect_error());
	            }
	             else {  
                    mysqli_select_db($conn, 'pagination');  
                } 
              
                $results_per_page = 50;  
              
                $query = "select *from codes";  
                $result = mysqli_query($conn, $query);  
                $number_of_result = mysqli_num_rows($result);  
              
                $number_of_page = ceil ($number_of_result / $results_per_page);  
              
                if (!isset ($_GET['page']) ) {  
                    $page = 1;  
                } else {  
                    $page = $_GET['page'];  
                }  
              
               
                $page_first_result = ($page-1) * $results_per_page;  
                
                $query = "SELECT *FROM codes LIMIT " . $page_first_result . ',' . $results_per_page;  
                $result = mysqli_query($conn, $query);  
              
	            ?>
	            <?php
                if (mysqli_num_rows($result) > 0) {
                ?>  
                <div class="scrollingTable">
                    <h2>Filterable Table</h2>
                    <input id="myInput" type="text" placeholder="Search..">
                    
                    <br><br>
                  <table>
                    
                    <thead>
                      <tr>
                        <td>code_id</td>
                        <td>Code</td>
                        <td>StartDate</td>
                        <td>EndDate</td>
                        <td>Delete</td>
                        <td>Edit</td>
                        
                      </tr>
                      </thead>
                   <?php
                    while($row = mysqli_fetch_array($result)) {
                    ?>
                    <tbody id="myTable">
                    <tr>
                        <td><?php echo $row["code_id"]; ?></td>
                        <td><?php echo $row["code"]; ?></td>
                        <td><?php echo $row["startdate"]; ?></td>
                        <td><?php echo $row["enddate"]; ?></td>
                    
                        <td><form method='POST' action="delete.php">
                                <input type=hidden name=code_id value="<?php echo $row["code_id"]; ?>" >
                                <input type=submit value=Delete name=delete >
                                </form>
                        </td>
                        <td>
                            <form method='POST' action="update.php">
                                <input type=hidden name=code_id value="<?php echo $row["code_id"]; ?>" >
                                <input type=submit value=edit name=update >
                            </form>
                        </td>
                    </tr>
                    </tbody>
                    <?php
                    }
                    ?>
                </table>
                </div>
                <?php
                }
                else{
                    echo "No result found";
                }
                for($page = 1; $page<= $number_of_page; $page++) {  
                    echo '<a href = "index.php?page=' . $page . '">' . $page . ' </a>';  
                }  
                mysqli_close($conn); 
                ?>   
               </div>
    
            <div class="fCodeCodeooter">
                <div class="footer__upper">
                    <div class="footer__title">
                        <h2>GoPrac is an online practice platform</h2>
                        <p>
                            GoPrac is an online practice platform where candidates can improve their interview skills by 
                            practicing one-on-one mock interviews offered by industry professionals. 
                            This platform simulates a real-time interview experience by providing a video-based interface to a candidate. 
                            Candidates can practice mock interviews anytime from anywhere.
                        </p>
                    </div>
                    
                    <div class="footer__contact">
                       <a href="https://goprac.com/contactus">info@goprac.com</a> 
                    </div>
                </div>
                <div class="footer__low">
                    <div>
                        <p>Copyright &copy; GoPrac.com</p>
                    </div>
                    <div class="footer__term"> 
                        <div>
                            <a href="https://goprac.com/privacy">Privay Policy</a>
                        </div>
                        <div>
                            <a href="https://goprac.com/terms">Terms and Conditions</a>
                        </div>
                        
                    </div>
                </div>

                
            </div>
        </div>
</body>
</html>

<!doctype html>
<html>
    <head>
    <link href="./styles.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
               $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
    </script>
    
    </head>
    <body>
        <div class="container">
            <div class="header">
                <div class="header__logo">
                    <a href="#" class="header__logo">
                        <img src="https://goprac.com/images/logo1.png">
                    </a>
                </div>
                <div class="header__menu">
                    <div class="dropdown">
                            <button class="dropbtn">CATEGORIES</button>
                            <div class="dropdown-content">
                                <li>
                                    <div class="sub__dropdown">
                                        <a href="#">Computer Science</a> 
                                        <ul class="sub__dropdown-content">
                                            <li><a href="#">Data Structure</a></li>
                                            <li><a href="#">Java</a></li>
                                            <li><a href="#">Database and SQL</a></li>
                                        </ul>
                                    </div>
                                   
                                </li>
                                <li>
                                    <div class="sub__dropdown">
                                        <a href="#">Hot Skills</a> 
                                        <ul class="sub__dropdown-content">
                                            <li><a href="#">Data Science</a></li>
                                            <li><a href="#">Business Analyst</a></li>
                                            <li><a href="#">Product Managment</a></li>
                                        </ul>
                                    </div>
                                    
                                </li>
                                <li>
                                    <div class="sub__dropdown">
                                        <a href="#">Programming</a> 
                                        <ul class="sub__dropdown-content">
                                            <li><a href="#">C/C++</a></li>
                                            <li><a href="#">OOPS</a></li>
                                            <li><a href="#">Software Programming</a></li>
                                        </ul>
                                    </div>
                                    
                                </li> 
                            </div>    
                    </div>
                   <div>
                        <a href="https://goprac.com/why-practice" target="_self" class="header__link">
                            <img src="https://goprac.com/images/practice.png" />
                            WHY PRACTICE</a>
                    </div>
                    <div>
                        <a href="https://goprac.com/how-it-works" target="_self" class="header__link">
                            <img src="https://goprac.com/images/how-it-works.png" />
                            HOW IT WORKS
                        </a>
                    </div>
                    <div>
                        <a href="https://goprac.com/expertlist"  target="_self" class="header__link">
                            <img src="https://goprac.com/images/expertpanel.png" /> 
                            EXPERT PANEL
                        </a>
                    </div> 
                    <div>
                        <a href="https://goprac.com/aboutus" target="_self"class="header__link">
                            <img src="https://goprac.com/images/about-us.png" />
                            ABOUT US
                        </a>
                    </div>     
                </div>
                <div class="header__profile" >
                    <img src="https://goprac.com/images/user-avatar.png" />
                    <a href="#">Login</a>
                </div>
            </div>
            <div class="section">
                <div class="form"> 
                    <form method="post" action="goprac.php" class="generate">
                       
                        <div class="button">
                            <button type="submit">Generate Code</button>
                        </div>
                    </form>
                </div>
                <div class="table">
                <?php
                $hostname="localhost";
	            $username="root";
	            $password="narayan1";                                      
	            $database="coder";
	            $conn=mysqli_connect($hostname,$username,$password,$database);
	            if (!$conn) {
		            die("connection failed:".mysqli_connect_error());
	            }
	             else {  
                    mysqli_select_db($conn, 'pagination');  
                } 
              
                $results_per_page = 50;  
              
                $query = "select *from codes";  
                $result = mysqli_query($conn, $query);  
                $number_of_result = mysqli_num_rows($result);  
              
                $number_of_page = ceil ($number_of_result / $results_per_page);  
              
                if (!isset ($_GET['page']) ) {  
                    $page = 1;  
                } else {  
                    $page = $_GET['page'];  
                }  
              
               
                $page_first_result = ($page-1) * $results_per_page;  
                
                $query = "SELECT *FROM codes LIMIT " . $page_first_result . ',' . $results_per_page;  
                $result = mysqli_query($conn, $query);  
              
	            ?>
	            <?php
                if (mysqli_num_rows($result) > 0) {
                ?>  
                <div class="scrollingTable">
                    <h2>Filterable Table</h2>
                    <input id="myInput" type="text" placeholder="Search..">
                    <br><br>
                  <table>
                    
                    <thead>
                      <tr>
                        <td>code_id</td>
                        <td>Code</td>
                        <td>StartDate</td>
                        <td>EndDate</td>
                        <td>Delete</td>
                        <td>Edit</td>
                        
                      </tr>
                      </thead>
                   <?php
                    while($row = mysqli_fetch_array($result)) {
                    ?>
                    <tbody id="myTable">
                    <tr>
                        <td><?php echo $row["code_id"]; ?></td>
                        <td><?php echo $row["code"]; ?></td>
                        <td><?php echo $row["startdate"]; ?></td>
                        <td><?php echo $row["enddate"]; ?></td>
                    
                        <td><form method='POST' action="delete.php">
                                <input type=hidden name=code_id value="<?php echo $row["code_id"]; ?>" >
                                <input type=submit value=Delete name=delete >
                                </form>
                        </td>
                        <td>
                            <form method='POST' action="update.php">
                                 <input type="text" placeholder="update value" name=code maxlength="6">
                                <input type=hidden name=code_id value="<?php echo $row["code_id"]; ?>" >
                                <input type=submit value=edit name=update >
                            </form>
                        </td>
                    </tr>
                    </tbody>
                    <?php
                    }
                    ?>
                </table>
                </div>
                <?php
                }
                else{
                    echo "No result found";
                }
                for($page = 1; $page<= $number_of_page; $page++) {  
                    echo '<a href = "index.php?page=' . $page . '">' . $page . ' </a>';  
                }  
                mysqli_close($conn); 
                ?>   
               </div>
    
            <div class="fCodeCodeooter">
                <div class="footer__upper">
                    <div class="footer__title">
                        <h2>GoPrac is an online practice platform</h2>
                        <p>
                            GoPrac is an online practice platform where candidates can improve their interview skills by 
                            practicing one-on-one mock interviews offered by industry professionals. 
                            This platform simulates a real-time interview experience by providing a video-based interface to a candidate. 
                            Candidates can practice mock interviews anytime from anywhere.
                        </p>
                    </div>
                    
                    <div class="footer__contact">
                       <a href="https://goprac.com/contactus">info@goprac.com</a> 
                    </div>
                </div>
                <div class="footer__low">
                    <div>
                        <p>Copyright &copy; GoPrac.com</p>
                    </div>
                    <div class="footer__term"> 
                        <div>
                            <a href="https://goprac.com/privacy">Privay Policy</a>
                        </div>
                        <div>
                            <a href="https://goprac.com/terms">Terms and Conditions</a>
                        </div>
                        
                    </div>
                </div>

                
            </div>
        </div>
</body>
</html>

