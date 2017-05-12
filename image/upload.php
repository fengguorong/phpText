<?php
	include "FileUpload.class.php";
	include "image.class.php";

	$up=new FileUpload(array("filepath"=>"./images/", "allowtype"=>array("gif", "jpg", "png")));

	if($up->uploadFile("pic")){
		$filename=$up->getNewFileName();

		$img=new Image("./images/");

		$th_filename=$img->thumb($filename, 300, 300, "th_");

		$img->waterMark($th_filename, "gaolf.gif", 5, "wa_");
		$img->waterMark($filename, "gaolf.gif", 0, "");
	}else{
		echo $up->getErrorMsg();
	}
