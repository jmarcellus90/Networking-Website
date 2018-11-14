<?php
	class User extends Db{


	public function login($un,$pw){
			$pw = md5($pw);
			$this->query = $this->handeller->query("SELECT * FROM `users` WHERE (user_name = '$un' AND password = '$pw')");
			$row = $this->query->rowCount();
			$token = $this->secure_token($this->user_session_id());

				if($row > 0){
					$this->query2 = $this->handeller->query("UPDATE `users` SET user_token = '$token' WHERE (user_name = '$un' AND password = '$pw')");

					$this->query3 = $this->handeller->query("SELECT * FROM `users` WHERE (user_name = '$un' AND password = '$pw')");
					$row = $this->query3->fetch(PDO::FETCH_ASSOC);
					$_SESSION['user'] = $row;
					Toast::set_toast('success','Login Success!','Welcome! '.$row['first_name'].' '.$row['last_name']);
					if($row['access_level'] == 0){
						$this->url_return(array('index.php',$token));
					}elseif($row['access_level'] == 1){
						$this->url_return(array('teacher.php',$token));
					}

					}else{
						Toast::set_toast('error','Invalid Access!','Please check your email or password');
						$this->url_return(array('signin.php'));
						}
			}


			public function login_check(){
				if(!isset($_SESSION['user'])){
					Toast::set_toast('error','Permission Denied!','Please Login to continue!!');
					return $this->url_return(array('signin.php'));
					}
				}

		public function student_check($token){
			if($_SESSION['user']['access_level'] == 0){
				return $this->url_return(array('index.php',$token));
				}
			}

			public function admin_check($token){
				if($_SESSION['user']['access_level'] == 1){
					return $this->url_return(array('teacher.php',$token));
					}
				}



		public function check_token($tkn){
			if($tkn != md5($_COOKIE["PHPSESSID"])){
				session_destroy();
				session_unset();
				Toast::set_toast('error','Access Denied!','Invalid Admin token!!');
				return $this->url_return(array('signin.php'));
				}
			}


		public function logOut(){
			if((isset($_GET['logout'])) && ($_GET['logout'] == 'true') && ($_GET['token'] == $this->secure_token($_COOKIE['PHPSESSID']))){
				session_destroy();
				session_unset();
				Toast::set_toast('error','Loged Out','Invalid Admin token!!');
				return $this->url_return(array('signin.php'));
				}
		}

		public function user_data($data){
			$this->data = $_SESSION['user'];
			return $this->data[$data];
			}

		public function addStudent($stu_id, $f_name, $l_name, $email, $username, $pass){
			$from = $_SESSION['user']['email'];
			$password = md5($pass);
	    $qr = $this->handeller->query("INSERT INTO `users` (`student_id`, `user_name`, `last_name`, `first_name`, `email`, `password`, `access_level`, `user_token`) VALUES ('$stu_id', '$username', '$l_name', '$f_name', '$email', '$password', '0', '0')");
			$mail = new Email($email, "Welcome to Quiz System!", "Here is your access, \n Username : $username \n Password : $pass",$from);
			$mail->send();
			return true;
	  }


		public function removeStudent($student){
	    $qr = $this->handeller->query("DELETE FROM users WHERE id='$student'");
			return true;
	  }

		public function studentData($student, $arg){
	    $qr = $this->handeller->query("SELECT * FROM users WHERE id='$student'");
			$row = $qr->fetch(PDO::FETCH_ASSOC);
			return $row[$arg];
	  }




	}

	?>
