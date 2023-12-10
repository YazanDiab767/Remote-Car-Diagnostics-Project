<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

    class UserController
    {

        public function settings()
        {
            view::load("user/edit");
        }
        public function login()
        {
            if ($_SERVER['REQUEST_METHOD'] == "POST")
            {
                $user = new User();
                $username = $_POST['username'];
                $password = $_POST['password'];
                $data = array(
                    "username" => $username,
                    "password" => $password
                );
                $result = $user->login($data);
                if (count($result) > 0)
                {
                    $_SESSION['user'] = $result[0]; 
                    echo 1;
                }
                else
                {
                    echo 0;
                }
            }
            

        }

        public function checkLogin()
        {
            $url = url("index");
            if (!isset($_SESSION['user']))
                header("location: $url");
        }

        public function updateName()
        {
            if ($_SERVER['REQUEST_METHOD'] == "POST")
            {
                $input_username = $_POST['input_username'];
                $input_password = $_POST['input_password'];

                if ($input_password == $_SESSION['user']["password"])
                {
                    $data = array(
                        "type" => "username",
                        "cols" => array(
                            "username" => $input_username
                        ),
                        "user_id" => $_SESSION['user']["user_id"]
                    );
                    $user = new User();
                    if ($user->edit($data))
                        echo 1;
                    else
                        echo "There Error IN Update, Please Try Again";
                }
                else
                {
                    echo "The old password is incorrect";
                }

            }
        }

        public function updatePass()
        {
            if ($_SERVER['REQUEST_METHOD'] == "POST")
            {
                $old_password = $_POST['old_password'];
                $new_password = $_POST['new_password'];

                if ($old_password == $_SESSION["user"]["password"])
                {
                    $data = array(
                        "type" => "password",
                        "cols" => array(
                            "password" => $new_password
                        ),
                        "user_id" => $_SESSION['user']["user_id"]
                    );
                    $user = new User();
                    if ($user->edit($data))
                        echo 1;
                    else
                        echo "There Error IN Update, Please Try Again";
                }
                else
                {
                    echo "The old password is incorrect";
                }

            }
        }

        public function logout()
        {
            session_destroy();
            $url = url("index");
            header("location: $url");
        }

    }

?>