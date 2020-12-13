
<!doctype html>
<html>
    <head>
    <link href="./styles.css" rel="stylesheet">
     <script type="text/javascript">
        function makeTableScroll() {
            var maxRows = 10;
            var table = document.getElementById('myTable');
            var wrapper = table.parentNode;
            var rowsInTable = table.rows.length;
            var height = 0;
            if (rowsInTable > maxRows) {
                for (var i = 0; i < maxRows; i++) {
                    height += table.rows[i].clientHeight;
                }
                wrapper.style.height = height + "px";
            }
        }
    </script>
    </head>
    <body onload="makeTableScroll();">
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
	            ?>
	            <?php
                $result = mysqli_query($conn,"SELECT * FROM codes");
                if (mysqli_num_rows($result) > 0) {
                ?>  
                <div class="scrollingTable">
                  <table id="myTable">
                  
                      <tr>
                        <td>code_id</td>
                        <td>Code</td>
                        <td>StartDate</td>
                        <td>EndDate</td>
                        <td>Action</td>
                      </tr>
                   <?php
                    $i=0;
                    while($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row["code_id"]; ?></td>
                        <td><?php echo $row["code"]; ?></td>
                        <td><?php echo $row["startdate"]; ?></td>
                        <td><?php echo $row["enddate"]; ?></td>
                        <td class="action"> <span>edit</span><span>delete</span></td>
                    </tr>
                    <?php
                    $i++;
                    }
                    ?>
                </table>
                </div>
                <?php
                }
                else{
                    echo "No result found";
                }
                mysqli_close($conn); 
                ?>   
               </div>
    
            <div class="footer">
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

