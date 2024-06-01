             <div class="dashboard_content_main">
                        <div id="userAddFormContainer">
                        <form action="database/add.php" method="POST" class="appForm" id="userAddForm">
                            <div class="appFormInputContainer">
                                <label for="first_name">First Name</label>
                                <input type="text" class="appFormInput" id="first_name" name="first_name"/>
                            </div>
                            <div class="appFormInputContainer">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="appFormInput" id="last_name" name="last_name"/>
                            </div>
                            <div class="appFormInputContainer">
                                <label for="email">Email</label>
                                <input type="text" class="appFormInput" id="email" name="email"/>
                            </div>
                            <div class="appFormInputContainer">
                                <label for="password">Password</label>
                                <input type="password" class="appFormInput" id="password" name="password"/>
                            </div>
                            
                            <button type="submit" class="appBtn"><i class="fa fa-plus"></i> Add User</button>
                        </form>
                        <?php 
                            if(isset($_SESSION['response'])){ 
                                $response_message=$_SESSION['response']['message'];
                                $is_success=$_SESSION['response']['success'];
                                ?>
                                   <div class="responseMessage">
                                    <p class="<?=$is_success ? 'responseMessage__success':'responseMessage__error' ?>">
                                    <?=$response_message ?>
                                    </p>
                                   </div>
                            <?php unset($_SESSION['response']); }?>

                    
        </div>