<?php 
session_start();
include ("include/header-admin.php");
// include ("include/navadmin.php");
include ("../include/connect.php");
include ("../include/function.php");

if(isset($_SESSION['admin'])){

    $do = isset($_GET['do']) ? $_GET['do'] : "Manage";

    // Start Manage Page

    if($do == 'Manage'){

        include ("include/navadmin.php");
        
        // Manage Members Page 

        // Select all users Except Admib

        $stmt = $con->prepare("SELECT * FROM users ORDER BY id DESC");

        $stmt->execute();

        $rows = $stmt->fetchAll();

        if (! empty($rows)) {
    
    ?>

  <div class="wrapper">
  <div class="container">
    <div class="tables-admin">
       <!--start taple-->
       <div class="row">
      <div class="col-12">
          <div class="cardsd-taple-page overlay-scrollbar">
              <div class="cardsd-header">
                 <h3>المستخدمين</h3> 
                  <i class="fas fa-ellipsis-h"></i>
              </div>
              <div class="cardsd-content">
                  <table>
                      <thead>
                          <tr>
                              <th> ID </th>
                              <th> Username </th>
                              <th> Email </th>
                              <th> Full Name </th>
                              <th> Date Birth </th>
                              <th>Control</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php foreach($rows as $row) { ?>
                          <tr>
                              <td><?php echo $row['id'] ?></td>
                              <td><?php echo $row['name'] ?></td>
                              <td><?php echo $row['Email'] ?></td>
                              <td><?php echo $row['first_name'] ."  ". $row['last_name'] ?></td>
                              <td><?php echo $row['date_birth'] ?></td>
                              <td>
                                <a href='users.php?do=Edit&User_ID="<?php echo $row["id"] ?>"' class='btn btn-success'><i class='fa fa-edit'></i> تعديل </a>
                                <a href='users.php?do=Delete&User_ID="<?php echo $row["id"] ?>"' class='btn btn-danger confirm'><i class='fa fa-close'></i>حذف</a>
                              </td>
                          </tr>
                          <?php } ?>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
       <!--end taple-->
    </div>
  </div>
  <a href="users.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> إضافة عضو جديد </a>
</div>

        <?php } else {
         
            echo "<div class='container'>";
                echo "<div class='nice-message'>There's No users To Show</div>";
                echo '<a href="users.php?do=Add" class="btn btn-primary"><i class="fa fa-plus"></i> New Member</a>';
            echo "</div>";
         
        }?>

        <?php

     } elseif($do =='Add'){ // Add Members Page ?>

        <h1 class='text-center'> Add New Member </h1>
        <div class='container'>
            <form class='form-horizontal' action="?do=Insert" method="POST">
                <!-- Start usernameField -->
                <div class="form-group form-group-lg">
                    <label class='col-sm-2 control-label'>User Name </label>
                    <div class='col-sm-10 col-md-6'>
                        <input type='text' name="username" class='form-control' autocomplete='off' required="required" placeholder="Username To Login Into Shop"/>
                        <span class="asterisk">*</span>
                    </div>
                </div>
                <!-- End usernameField -->
                <!-- Start Password Field -->
                <div class="form-group form-group-lg">
                    <label class='col-sm-2 control-label'> Password </label>
                    <div class='col-sm-10 col-md-6'>
                        <input type='password' name="password" class='password form-control' required="required" autocomplete='new-password' required="required" placeholder="password Must Be Hard & Complex"/>
                        <span class="asterisk">*</span>
                        <i class="show-pass fa fa-eye fa-2x"></i>
                    </div>
                </div>
                <!-- End Password Field -->
                <!-- Start Email Field -->
                <div class="form-group form-group-lg">
                    <label class='col-sm-2 control-label'>Email </label>
                    <div class='col-sm-10 col-md-6'>
                        <input type='email' name="email" class='form-control' required="required" placeholder="Email Must Be Valid"/>
                        <span class="asterisk">*</span>
                    </div>
                </div>
                <!-- End Email Field -->
                <!-- Start First Name Field -->
                <div class="form-group form-group-lg">
                    <label class='col-sm-2 control-label'>First Name </label>
                    <div class='col-sm-10 col-md-6'>
                        <input type='text' name="first_name" class='form-control' required="required" placeholder="Full Name Appear In Your Profile Page "/>
                        <span class="asterisk">*</span>
                    </div>
                </div>
                <!-- End First Name Field -->
                <!-- Start Last Name Field -->
                <div class="form-group form-group-lg">
                    <label class='col-sm-2 control-label'>Last Name </label>
                    <div class='col-sm-10 col-md-6'>
                        <input type='text' name="last_name" class='form-control' required="required" placeholder="Full Name Appear In Your Profile Page "/>
                        <span class="asterisk">*</span>
                    </div>
                </div>
                <!-- End Last Name Field -->
                <!-- Start Date Birth Field -->
                <div class="form-group form-group-lg">
                    <label class='col-sm-2 control-label'>Date Birth </label>
                    <div class='col-sm-10 col-md-6'>
                        <input type='text' name="date_birth" class='form-control' required="required" placeholder="Full Name Appear In Your Profile Page "/>
                        <span class="asterisk">*</span>
                    </div>
                </div>
                <!-- End Date Birth Field -->
                <!-- Start submit Field -->
                <div class="form-group">
                    <div class='col-sm-offset-2 col-sm-10'>
                        <input type='submit' value="Add Member" class='btn btn-primary btn-lg' />
                    </div>
                </div>
                <!-- End submit Field -->
            </form>
        </div>

<?php 

    } elseif ($do == 'Insert') {

        // Insert Member Page 

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            echo "<h1 class='text-center'>Insert Member</h1>";
            echo "<div class='container'>";

            // Get Variables From The Form 

            $user   = $_POST['username'];
            $pass   = $_POST['password'];
            $email  = $_POST['email'];
            $first_name = $_POST['first_name'];
            $last_name  = $_POST['last_name'];
            $date_birth = $_POST['date_birth'];

            $hashPass =sha1($_POST['password']);

            // Validate The Form

            $formErrors = array();

            if(strlen($user) < 4 ){
                $formErrors[] = 'Username Cant Be Less than <strong>4 characters</strong>';
            }

            if(strlen($user) > 20 ){
                $formErrors[] = 'Username Cant Be more than <strong> 20 characters</strong>';
            }

            if(empty($user)){
                $formErrors[] = 'Username Cant Be <strong> Empty</strong>';
            }

            if(empty($pass)){
                $formErrors[] = 'password Cant Be <strong> Empty</strong>';
            }

            if(empty($email)){
                $formErrors[] = 'Email Cant Be <strong>Empty</strong>';
            }

            if(empty($first_name)){
                $formErrors[] = 'First Name Cant Be <strong> Empty</strong>';
            }

            if(empty($last_name)){
                $formErrors[] = 'Last Name Cant Be <strong> Empty</strong>';
            }

            if(empty($date_birth)){
                $formErrors[] = 'Date Birth Cant Be <strong>Empty</strong>';
            }
            // Loop Into Errors Array And It

            foreach($formErrors as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>' ;
            }

            // Check if There's No Error Proceed The Update Opration

            if(empty($formErrors)) {

                // Check if User Exist in Database

                $check = checkItem("name", "users", $user);

                if($check == 1) {

                    $theMsg = '<div class="alert alert-danger">Sorry This User is Exist</div>';

                    redirectHome( $theMsg,'back');

                } else {

                    // Insert userinfo In Database

                    $stmt = $con->prepare("INSERT INTO 
                                            users(name , password , Email , first_name , last_name , date_birth)
                                            VALUES(:zuser, :zpass, :zemail, :zfirst_name, :zlast_name, :zdate_birth ");
                    $stmt->execute(array(

                        'zuser' => $user,
                        'zpass' => $hashPass,
                        'zemail' => $email,
                        'zfirst_name' => $first_name,
                        'zlast_name'  => $last_name,
                        'zdate_birth' => $date_birth
                    ));

                    // Echo Success Message 

                    $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Insert</div>';

                    redirectHome($theMsg,'back');

               }
            
        }

        } else {

            echo "<div class='container'>";

            $theMsg = '<div class="alert alert-danger">Sorry You Cant Browse This Page Directly</div>';

            redirectHome($theMsg);

            echo "</div>";
            
        }

        echo '</div>';        

    } elseif($do == 'Edit'){ // Edit Page 

            // Check if Get Request userID is Numeric & Get The Integer Value of It

            $userid = isset($_GET['User_ID']) && is_numeric($_GET['User_ID']) ? intval($_GET['User_ID']) : 0 ;
            
            //Select All Data Depend On This ID

            $stmt = $con->prepare('SELECT * FROM users WHERE id = ? LIMIT 1 ');

            $stmt->execute(array($userid));
    
            $row = $stmt->fetch();
            
            $count =$stmt->rowCount();

            // If There's Such ID Show The Form

            if($count > 0){ ?>

                <h1 class='text-center'> Edit Member </h1>
                <div class='container'>
                    <form class='form-horizontal' action="?do=Update" method="POST">
                        <input type="hidden" name='userid' value="<?php echo $userid ?>" />
                        <!-- Start usernameField -->
                        <div class="form-group form-group-lg">
                            <label class='col-sm-2 control-label'>User Name </label>
                            <div class='col-sm-10 col-md-6'>
                                <input type='text' name="username" class='form-control' value='<?php echo $row['name'] ?>' autocomplete='off' required="required"/>
                                <span class="asterisk">*</span>
                            </div>
                        </div>
                        <!-- End usernameField -->
                        <!-- Start Password Field -->
                        <div class="form-group form-group-lg">
                            <label class='col-sm-2 control-label'> Password </label>
                            <div class='col-sm-10 col-md-6'>
                                <input type='hidden' name="oldpassword" value= "<?php echo $row['password'] ?>" />
                                <input type='password' name="newpassword" class='form-control' autocomplete='new-password' placeholder="Leave Blank If You Dont Want To Change"/>
                            </div>
                        </div>
                        <!-- End Password Field -->
                        <!-- Start Email Field -->
                        <div class="form-group form-group-lg">
                            <label class='col-sm-2 control-label'>Email </label>
                            <div class='col-sm-10 col-md-6'>
                                <input type='email' name="email" value='<?php echo $row['Email'] ?>' class='form-control' required="required"/>
                                <span class="asterisk">*</span>
                            </div>
                        </div>
                        <!-- End Email Field -->
                        <!-- Start Full Name Field -->
                        <div class="form-group form-group-lg">
                            <label class='col-sm-2 control-label'> First Name </label>
                            <div class='col-sm-10 col-md-6'>
                                <input type='text' name="first_name" value='<?php echo $row['first_name'] ?>' class='form-control' required="required"/>
                                <span class="asterisk">*</span>
                            </div>
                        </div>
                        <div class="form-group form-group-lg">
                            <label class='col-sm-2 control-label'> Last Name </label>
                            <div class='col-sm-10 col-md-6'>
                                <input type='text' name="last_name" value='<?php echo $row['last_name'] ?>' class='form-control' required="required"/>
                                <span class="asterisk">*</span>
                            </div>
                        </div>
                        <div class="form-group form-group-lg">
                            <label class='col-sm-2 control-label'> Date Birth </label>
                            <div class='col-sm-10 col-md-6'>
                                <input type='text' name="date_birth" value='<?php echo $row['date_birth'] ?>' class='form-control' required="required"/>
                                <span class="asterisk">*</span>
                            </div>
                        </div>
                        <!-- End Full Name Field -->
                        <!-- Start submit Field -->
                        <div class="form-group">
                            <div class='col-sm-offset-2 col-sm-10'>
                                <input type='submit' value="SAVE" class='btn btn-primary btn-lg' />
                            </div>
                        </div>
                        <!-- End submit Field -->
                    </form>
                </div>

   <?php 
   
          // if There's No such ID Show Error Message
                
            } else {

                echo "<div class='container'>";

                $theMsg = "<div class='alert alert-danger'>Theres No Such ID</div>";

                redirectHome($theMsg);

                echo "</div>";
            }

   } elseif($do == 'Update') {// Update Page 

        echo "<h1 class='text-center'>Update Member</h1>";
        echo "<div class='container'>";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Get Variables From The Form 

            $id     = $_POST['userid'];
            $user   = $_POST['username'];
            $email  = $_POST['email'];
            $first_name  = $_POST['first_name'];
            $last_name   = $_POST['last_name'];
            $date_birth  = $_POST['date_birth'];

            // Password Trick

            $pass= empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

            // Validate The Form

            $formErrors = array();

            if(strlen($user) < 4 ){
                $formErrors[] = 'Username Cant Be Less than <strong>4 characters</strong>';
            }

            if(strlen($user) > 20 ){
                $formErrors[] = 'Username Cant Be more than <strong> 20 characters</strong>';
            }

            if(empty($user)){
                $formErrors[] = 'Username Cant Be <strong> Empty</strong>';
            }

            if(empty($email)){
                $formErrors[] = 'Email Cant Be <strong>Empty</strong>';
            }
            
            if(empty($first_name)){
                $formErrors[] = 'First Name Cant Be <strong> Empty</strong>';
            }

            if(empty($last_name)){
                $formErrors[] = 'Last Name Cant Be <strong> Empty</strong>';
            }

            if(empty($date_birth)){
                $formErrors[] = 'Date Birth Cant Be <strong> Empty</strong>';
            }
            // Loop Into Errors Array And It

            foreach($formErrors as $error) {
                echo '<div class="alert alert-danger">' . $error . '</div>' ;
            }

            // Check if There's No Error Proceed The Update Opration

            if(empty($formErrors)) {

                $stmt2 = $con->prepare("SELECT 
                                            * 
                                        FROM 
                                            users 
                                        WHERE 
                                            name = ? 
                                        AND 
                                            id != ?");
                $stmt2->execute(array($user,$id));

                $count = $stmt2->rowCount();

                if ($count == 1) {

                    echo '<div class="alert alert-danger">Sorry This User Is Exist</div>';

                    redirectHome($theMsg,"back");

                } else {

                    // Update The Database With This Info

                    $stmt = $con->prepare("UPDATE users SET name = ?, Email = ?, first_name = ? , last_name = ? , password = ? WHERE id = ? ");
                    $stmt->execute(array($user,$email,$first_name,$last_name,$pass,$id));

                    // Echo Success Message 

                    $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';

                    redirectHome($theMsg,'back');
                }

            }

        } else {

            $theMsg = '<div class="alert alert-danger">Sorry You Cant Browse This Page Directly</div>';

            redirectHome($theMsg);
            
        }

         echo '</div>';

    } elseif($do == 'Delete'){ // Delete Member Page 

            echo "<h1 class='text-center'>Delete Page</h1>";
            echo "<div class='container'>";

            // Check if Get Request userID is Numeric & Get The Integer Value of It

            $userid = isset($_GET['User_ID']) && is_numeric($_GET['User_ID']) ? intval($_GET['User_ID']) : 0 ;
                
            //Select All Data Depend On This ID

            $check = checkItem('id', "users", $userid);

            // If There's Such ID Show The Form
            
            if($check > 0){ 
            
                $stmt = $con->prepare("DELETE FROM users  WHERE id = :zuser");

                $stmt->bindParam(":zuser",$userid);

                $stmt->execute();

                $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted</div>';

                redirectHome($theMsg);
        
            } else {

                $theMsg = '<div class="alert alert-danger">This Id is not Exist</div>';

                redirectHome($theMsg);

            }

        echo "</div>";

    }

} else {

    header('Location: index-admin.php');

    exit();
}
?>