<?php
/* PHP图像处理
 * 	
 一、画图（画出来的图形可以直接当做图片来用，<img src="图像文件的名称"/>）
 *		验证码， 统计图
 *
 *
	 安装GD库--- LAMP环境安装

	 （1）创建画布 --- 创建资源类型 --- 高度 宽度(创建图片资源)
		$img=imagecreate ( int x_size, int y_size )
		$img=imagecreatetruecolor ( int x_size, int y_size )	
	    **填充背景色
	    		$red=imagecolorallocate($img,255,0,0);
				imagefill($img,0,0,$red);
	 （2）绘制图像
	 	制定各种颜色	

	  	矩形， 圆， 点， 线段， 扇形， 画字（字符， 字符串， freetype）
		每一个图像对应一个函数
    	画矩形并填充：imagefilledrectangle($img, 10, 10, 80, 80, $green);
    	画矩形：imagerectangle($img,100,100,120,120,$red);
    	画线段：imageline($img,1,1,200,200,$blue);
    	画点（画单一的像素点）：imagesetpixel($img,1,1,$color);
    	画圆：imageellipse($img,100,100,100,100,$color);
    	画弧形并填充：imagefilledarc($img,50,50,-160,40,$color);
    	3d效果的圆形比例统计图
    		eg://3D效果
				for($i=60; $i>50; $i--){
					imagefilledarc($img, 50, $i,100, 50, -160, 40, $darkgray, IMG_ARC_PIE);
					imagefilledarc($img, 50, $i,100, 50, 40, 75, $darknavy, IMG_ARC_PIE);
					imagefilledarc($img, 50, $i,100, 50, 75, 200, $darkred, IMG_ARC_PIE);
				}
					imagefilledarc($img, 50, $i,100, 50, -160, 40, $gray, IMG_ARC_PIE);
					imagefilledarc($img, 50, $i,100, 50, 40, 75, $navy, IMG_ARC_PIE);
					imagefilledarc($img, 50, $i,100, 50, 75, 200, $red, IMG_ARC_PIE);
		画字符：imagechar($img,5,100,100,"A",$color);//水平画字符
		        imagecharup($img,5,100,100,"A",$color);//垂直画字符
		画字符串：imagestring($img,3,10,10,"hello",$color);也有水平和垂直
		用自己的字体库：imagettftext($img, 25, 60, 150, 150, $red, "simkai.ttf", "高洛峰"); //simkai.ttf是一个字体文件
			若字体不是utf-8则应iconv()函数进行转化，转成utf-8；
	 （3）输出图像/保存处理好的图像
	    注：header("Content-Type:image/gif");告知浏览器以什么类型解析文本
			1. 输出各种类型（gif, png, jpeg）
				imagegif();
				imagejpeg();  
				imagepng($img);   //以 PNG 格式将图像输出到浏览器或文件

	 （4）释放资源
	  		imagedestroy($img);  //销毁一个图片


 
  

 *	
 *	
 *
 */
