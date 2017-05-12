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

二：图片处理： 缩放，裁剪， 翻转，旋转、透明、锐化等图片操作
	 *    一、1.创建图片资源（用现有的图片创建资源）
	 *    	  imagecreatetruecolor(width, height)
	 *    	  gif jpg png
	 *
	 *	  imagecreatefromgif(图片名称);
	 *	  imagecreatefrompng(图片名称);
	 *	  imagecreatefromjpeg(图片名称);
	 *
	 *        
	 *        2.画出各种图形（圆形，矩形， 线段， 文字）
	 *
	 *        3.输出格式：imagegif(,图片位置);图片位置是保存的位置
	 *        			imagepng(,);
	 *       			imagejpeg(,);
	 *
	 *        4.imagedestroy(图片资源) 销毁图片资源
	 *   二、获取图片的属性
	 *
	 *   	 imagesx(res)  获取图片的宽度，参数是图片的资源
	 *   	 imagesy(res)  获取图片的高度
	 *
	 *   	 getimagesize(图片名称);  //返回数组， 0==width 1==height 2==type
	 *
	 *   三、透明处理
	 *   	
	 *   	 png jpeg透明色都正常， 只有gif不正常
	 *
	 *   	 imagecolortransparent();
	 *   	 imagecolorstotal();
	 *   	 imagecolorsforindex();
	 *
	 *   四、图片的裁剪
	 *   	
	 *	imagecopyresized()
	 *	imagecopyresampled()
	 *
	 *  五、加水印（文字， 图片）
	 *	
	 *	imagettftext();
	 *	imagecopy();
	 *
	 *  六、图片旋转
	 *
	 *	imagerotate -- 用给定角度旋转图像
	 *
	 *  七、图片翻转
	 *   	
	 *   	沿Y轴
	 *
	 *	沿X轴
	 *
	 *八、锐化
	 *	imagecolorsforindex()
	 *	imagecolorat()	
	 
  

 *	
 *	
 *
 */

//图片缩放
	$new=imagecreatetruecolor($n_w, $n_h);

	$img=imagecreatefromjpeg($filename);

	imagecopyresized($new, $img,0, 0,0, 0,$n_w, $n_h, $width, $height);//拷贝部分图像并调整大小
//图片等比例缩放
   24分钟