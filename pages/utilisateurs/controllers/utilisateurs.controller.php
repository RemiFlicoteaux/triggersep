<?php
	
	function is_centre($centre_id,$table='centre')
	{
		$valid_centre = ORM::for_table($table)
			->where('centre_id',$centre_id)
			->count();
		$valid_centre = $valid_centre==1 ? true : false;
		return $valid_centre;
	}

	if(isset($_POST['crea_user']))
	{
		var_dump($_POST);
		$error_info='';
		$valid_info=''; 
		$alert_ino='';
		if(
			isset($_POST['username']) && !empty($_POST['username']) 
			&& isset($_POST['userpass']) && !empty($_POST['userpass']) 
			&& isset($_POST['conf_userpass']) && !empty($_POST['conf_userpass']) 
			&& isset($_POST['user_mail']) && !empty($_POST['user_mail']) 
			&& isset($_POST['user_grp']) && !empty($_POST['user_grp']) 
			&& isset($_POST['user_centre']) && !empty($_POST['user_centre'])
		)
		{
			$username = $_POST['username'];
			$username_not_free = ORM::for_table($b_table_utilisateur)
				->where('username',$username)
				->count();
			if($username_not_free==0)
			{
				$userpass = $_POST['userpass'];
				$conf_userpass = $_POST['conf_userpass'];
				$conf_userpass_ok = $userpass === $conf_userpass ? true : false;
				if($conf_userpass_ok)
				{
					$userpass_hash=md5($userpass);
					$user_mail = $_POST['user_mail'];
					$valid_email = filter_var($user_mail, FILTER_VALIDATE_EMAIL);
					if($valid_email)
					{
						if(is_in_table($user_mail,'email',$b_table_utilisateur))
						{
							$alert_info = $lang['MSG_ERROR_NOT_FREE_MAIL']; 
						}
						
						$user_centre = $_POST['user_centre'];
						$valid_centre = is_centre($user_centre);
						if ($valid_centre)
						{
							$user_grp = isset($_POST['user_grp']) ? $_POST['user_grp'] : '';
							$user_nom = isset($_POST['user_nom']) ? $_POST['user_nom'] : '';
							$user_prm = isset($_POST['user_prm']) ? $_POST['user_prm'] : '';
							$user_tel = isset($_POST['user_tel']) ? $_POST['user_tel'] : '';
							$user_fax = isset($_POST['user_fax']) ? $_POST['user_fax'] : '';
							
							/*$insert_query = "INSERT INTO utilisateur ";
							$champs = "(username,password,centre_id,groupe,email,tel,fax,nom,prenom)";
							$values = "('".$username."','".$userpass."','".$user_centre."','".$user_grp."','".$user_mail."','".$user_tel."','".$user_fax."','".$user_nom."','".$user_prm."')";
							
							$insert_query.=$champs.' VALUES '.$values;
							var_dump($insert_query);
							$insert_ok = ORM::raw_execute($insert_query);*/
							$insert_ok = ORM::for_table($b_table_utilisateur)
								->create()
								->set('username',$username)
								->set('password',$userpass_hash)
								->set('centre_id',$user_centre)
								->set('groupe',$user_grp)
								->set('email',$user_mail)
								->set('tel',$user_tel)
								->set('fax',$user_fax)
								->set('nom',$user_nom)
								->set('prenom',$user_prm)
								->save();
							$to = $user_mail;
							$subject = $username.' - '.$lang['MAIL_SUBJ_CONF_CREA_USER'];
							$msg = $lang['MAIL_MSG_CONF_CREA_USER'].''.$username;
							$header = '';
							$mail = new Mail($to,$subject,$msg,$header);
							$mail_ok = $mail->send();
							if(!$mail_ok)
							{
								$error_info = $mail->getErreur();
							}
							if($insert_ok)
							{
								$valid_info = $lang['MSG_VALID_CREA_USER']." : ".$username." - ".$_POST['user_grp'];
							}
							else
							{
								if(!empty($error_info))
								{
									$error_info .= "</br>";
								}
								$error_info .= $lang['MSG_ERROR_INSERT'];
							}
							if($mail_ok)
							{
								if(!empty($valid_info))
								{
									$valid_info.= "</br>";
								}
								$valid_info .= $lang['MSG_VALID_SEND_MAIL_CONF_TO']."".$user_mail;
							}
							else
							{
								if(!empty($error_info))
								{
									$error_info .= "</br>";
								}
								$error_info .= $lang['MSG_ERROR_SEND_MAIL_CONF_TO']."".$user_mail;
							}
						}
						else
							{
								$error_info = $lang['MSG_ERROR_BAD_CENTRE'];
							}
						
					}
					else
					{
						$error_info = $lang['MSG_ERROR_BAD_MAIL'];
					}
				}
				else
				{
					$error_info = $lang['MSG_ERROR_BAD_CONF_MDP'];
				}
			}
			else
			{
				$error_info = $lang['MSG_ERROR_NOT_FREE_USERNAME'];
			}
		}
		else
		{
			$error_info = $lang['MSG_ERROR_MISS_FIELD'];
		}
	}
	$li_centre = ORM::for_table($b_table_centre)
		->select_many(['id_db' => 'centre_id','code'=>'centre_code','nom'=>'centre'])
		->find_array();
	$li_grp = ORM::for_table($b_table_user_groupe)
		->find_array();
?>
