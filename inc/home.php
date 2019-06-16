<main>
    <div class="container">
        <div class="registration-banner">
            <div class="row">
                <?php if(isset($isAdmin)){
                    if($isAdmin==false){ echo '<div class="col-md-7">';
                        echo '<h2 class="text-center">Welcome to our application</h2>';}
                    else{
                        $firstName = User::getFirstName($_SESSION["user"]);
                        echo '<div class="col-md-12">';
                        echo '<h2 class="text-center">Welcome back to our application '.$firstName.'!</h2>';}
                    }
                    else{ echo '<div class="col-md-7">'; 
                   echo '<h2 class="text-center">Welcome to our application</h2>';}?>
                   <img class="home-background-image" src="res/img/background.png" alt="Background image">
                </div>
                
                <?php //if user or non-user show reg-area
                if(!isset($isAdmin) || (isset($isAdmin) && $isAdmin==false)){?>
                
                <div class="col-md-5">
                    <div class="registration-area">
                        <?php
                        if (isset($isAdmin)) {
                            $firstName = User::getFirstName($_SESSION["user"]);
                            $lastName = User::getLastName($_SESSION["user"]);
                            echo "<h4>Welcome back " . $firstName . " " . $lastName . "</h4>";
                            if($isAdmin ==false){
                                  echo "<br>
                                  <a href='?page=feed' class=\"btn btn-secondary btn-block\">Check new posts</a>
                                  <a href='?page=manager' class=\"btn btn-secondary btn-block\">Manage your images</a>
                                  <a href='?page=userdata' class=\"btn btn-secondary btn-block\">Change your personal information</a>";}           
                        } else {
                            echo "<h4>Create new account</h4>
                                <form id=\"reg_form\" class=\"form\" role=\"form\" action=\"\" method=\"POST\">
                                    <div class=\"form-group item\">
                                        <input id=\"registrate_vorname\" placeholder=\"First Name\"
                                               class=\"form-control form-control-sm\"
                                               type=\"text\" name=\"register_vorname\">
                                    </div>
                                    <div class=\"form-group item\">
                                        <input id=\"registrate_nachname\" placeholder=\"Surname\"
                                               class=\"form-control form-control-sm\" type=\"text\" name=\"register_nachname\">
                                    </div>
                                    <div class=\"form-group item\">
                                        <input id=\"registrate_username\" placeholder=\"Username\"
                                               class=\"form-control form-control-sm\"
                                               type=\"text\" name=\"register_username\">
                                    </div>
                                    <div class=\"form-group item\">
                                        <input id=\"registrate_mail\" placeholder=\"name@example.com\"
                                               class=\"form-control form-control-sm\" type=\"email\" name=\"register_mail\">
                                    </div>
                                    <div class=\"form-group item\">
                                        <input id=\"registrate_password1\" placeholder=\"Password\"
                                               class=\"form-control form-control-sm\" type=\"password\" name=\"register_password1\">
                                    </div>
                                    <div class=\"form-group item\">
                                        <input id=\"registrate_password2\" placeholder=\"Password nochmal eingeben\"
                                               class=\"form-control form-control-sm\" type=\"password\" name=\"register_password2\">
                                    </div>
        
                                    <div class=\"form-group item\">
                                        <button type=\"submit\" value=\"continue\" name=\"register_submit\"
                                                class=\"btn btn-secondary btn-block\">Join the club
                                        </button>
                                    </div>
                                </form>
                                <div id=\"alertRegistration\"></div>";
                        }}
                        ?>
                    </div>
                </div>
            </div>
        </div>
		<div>
			<div class="row">
				<div class="col-md-8">
					<img src="res/img/test2.png" class="rounded float-right img-fluid" alt="">
				</div>
				<div class="col-md-4 p-5">
					<div class="text-center">
					<h3>Piece of cake</h3>
					</div>
					<div class="registration-area">
					<h4>Best Edit</h4>
					<hr>
					<p class="registration-area">
					There are many ways to customize pictures, but with this awesome site, you are able to do magnificant edits on your most favourite pictures.
					</p>
					</div>
					<div class="registration-area mt-5">
					<h4>Let everyone know</h4>
					<hr>
					<p class="registration-area">
					With just one click, you can upload your most favourite pictures and let everyone know where you have been with our awesome map tools.
					</p>
					</div>
				</div>
			</div>
		</div>
        <div class="about-us">
            <h3>About Us</h3>
            <div class="row">
                <div class="col-md-4">
                    <img src="res/img/leo.png" class="rounded float-right" alt="">
                    <h4 class="text-center">Leo Gruber</h4>
					<p>
					Nothing stops him from gaining as much knowledge as possible from every source. Undefeated in Halo Reach. Founder of MilHochGrub GmbH.
					</p>
                </div>
                <div class="col-md-4">
                    <img src="res/img/marius.png" class="rounded float-right" alt="">
                    <h4 class="text-center">Marius Hochwald</h4>
					<p>
					Even in his love/hate relationship with javascript and php, he is still eager enough to achieve everything.
					</p>
                </div>
                <div class="col-md-4">
                    <img src="res/img/stefan.png" class="rounded" alt="">
                    <h4 class="text-center">Stefan Miljevic</h4>
					<p>
					Stefan is a specialist regarding Javascript/HTML/Bootstrap/JQuery/php. He works parttime for a company and lives in vienna since one and a half year.
					</p>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="./js/actions/UserRegistration.js"></script>
<script src="./js/actions/UserLogin.js"></script>
<script src="./js/tooltip_activate.js"></script>
<script src="./js/actions/update_userdata.js"></script>
<script src="./js/actions/update_userpassword.js"></script>