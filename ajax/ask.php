<?php
	session_start();
	chdir('..');
	require_once('api/Simpla.php');
	
	$simpla = new Simpla();
	if(isset($_POST['email']) && isset($_POST['mesg']) && is_numeric($_POST['id'])) 
	{           $email = $_POST['email'];
                $text = $_POST['mesg'];
                $tovname = stripcslashes($_POST['product']);
                $name = stripcslashes($_POST['uname']);
                $date = date("Y-m-d H:i:s");
                $query = $simpla->db->placehold("INSERT INTO __ask SET mail = ?, id_tovar = ?, msg = ? , name=? , product = ?, date = ?", $email, $_POST['id'], $text, $name, $tovname, $date);
                $simpla->db->query($query);
                $mail = "fxbyden@gmail.com";
                $headers = "From: Shopchik.com \n"; 
                $headers .= "To: \"".$email."\n";  
                $headers .= "MIME-Version: 1.0\n"; 
                $headers .= "Content-Type: text/HTML; charset=UTF-8\n";
                $text .= $date."\n ".$name."\n".$text;
                mail($mail, "Ответ:", $text, $headers);
                return true;         
	}
	else echo -1;