<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>İnstagram Fotoğraf Yükleme</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin"><!--Logo Değiştirilecek-->
								</a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Kullanıcı Adı</label>
                                    <input class="au-input au-input--full" type="text" name="username" placeholder="Kullanıcı Adı">
                                </div>
                                <div class="form-group">
                                    <label>Şifre</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Şifre">
                                </div>
								<div class="form-group">
                                    <label>Şifre</label>
                                    <input class="au-input au-input--full" type="file" name="resim" >
                                </div>
                                <div class="form-group">
                                    <label>Yorum</label>
                                    <input class="au-input au-input--full" type="text" name="yorum" placeholder="Lütfen Fotoğraf Altına Girilecek Bilgileri Giriniz Hashtaglerde Dahil..">
                                </div>
								<input class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="yukle" value="Resim Yükle"/>
                                
                            </form>
							<?php
							require __DIR__ . '/vendor/autoload.php';

\InstagramAPI\Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;
// debug açık ise detayları görürsünüz, tercih size kalmış.
$debug = false;
$truncatedDebug =false;
// kullanacağımız sınıfı başlatıyoruz
$ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);


							if(@$_POST["yukle"])
{
	$username = $_POST["username"];
	$password = $_POST["password"];
	$yorum = $_POST["yorum"];
	$dosya = $_FILES["resim"];
	$tip = $dosya["type"];
	$isim = $dosya["name"];
	$boyut = $dosya["size"];
	$tmp = $dosya["tmp_name"];
	
	$dizin = "yuklenendosyalar";
	
	$yeni = time()."-".rand(0,999);
	$format = substr($isim, -4);
	$yeni_isim = $yeni.$format;
	
	if($tip != "image/png" and $tip != "image/jpeg" and $tip != "image/jpg" and $tip != "image/gif")
	{
		echo "Bu Dosya Bir Resim Değil";
	}else{
		if(!file_exists($dizin)){mkdir($dizin);}
		$yukle = move_uploaded_file($tmp,$dizin."/".$yeni_isim);
		if($yukle)
		{
			try {
			$ig->login($username, $password);
			} catch (\Exception $e) {
			die('Bir hata oluştu: ' . $e->getMessage());
			}

			$photo = __DIR__ ."/".$dizin."/".$yeni_isim;
			$metadata = 
			[
				'caption' => $yorum
			];

			$photo = new \InstagramAPI\Media\Photo\InstagramPhoto($photo);
			$ig->timeline->uploadPhoto($photo->getFile(), $metadata);
			echo "İşlem Başarılı.<br>";
			unlink($dizin."/".$yeni.$format);
		}
	}
	
}
?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->