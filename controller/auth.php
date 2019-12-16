<?php
  if (isset($_POST['submit'])) {
      if(empty($_POST['email']) || empty($_POST['pass'])){
        header('login.php?error=Email atau Password tidak boleh kosong');exit;
      }
      $email = $_POST['email'];
      $pass = md5($_POST['pass']);
      $url = 'http://sims.imersa.co.id/api/presensi?login&email='.$email.'&pass='.$pass;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_URL, $url);
      $result = curl_exec($ch);
      curl_close($ch);
      $result = json_decode($result);
      if(@$result->status == 'failed'){
        session_start();
        $_SESSION['failed_login'] = ['msg' => $result->messages];
        header('location:login.php?error='.$result->messages);
      }else{
        session_start();
        $_SESSION['token'] = @$result->token;
        $_SESSION['nama'] = @$result->nama;
        $_SESSION['email'] = @$result->email;
        $_SESSION['success_login'] = true;
        header('location:index.php');exit;
      }
  }
?>