<?php
/*  PHP文件系统处理
 *	所有文件处理都是使用系统函数完成的。
 *	是基于Linux/Unix系统为模型
 *
 *一：文件系统处理的作用：
 *  		1. 所有的项目离不开文件处理
 *  		2. 可以用文件长时间保存数据
 *  		3. 建立缓存， 服务器中文件操作
 *
 *  	文件处理
 *		1. 文件类型
 *			以Linux为模型的， 在Windows只能获取file, dir或unknow 三种类型
 *			在Linux/Unix下， block, char, dir, fifo, file, link, unknown和种型
 *			block :块设置文件，磁盘分区，软驱， cd-rom等
 *			char: 字符设备，I/O 以字符为单位， 键盘，打印机等
 *			dir: 目录也是文件的一种
 *			fifo: 
 *			file:
 *			link: 
 *			unknown	
 *
 * 			filetype("目录或文件名")
 *
 * 			is_array();
 * 			is_int();
 * 			is_string();
 * 			is_null;
 * 			is_bool();
 * 			
		is_dir -- 判断给定文件名是否是一个目录
		is_executable -- 判断给定文件名是否可执行
		is_file -- 判断给定文件名是否为一个正常的文件
		is_link -- 判断给定文件名是否为一个符号连接
		is_readable -- 判断给定文件名是否可读
		is_uploaded_file -- 判断文件是否是通过 HTTP POST 上传的
		is_writable -- 判断给定的文件名是否可写
		is_writeable -- is_writable() 的别名
 *			
 *
 *		2. 文件的属性
 *			file_exists();
 *			filesize();   //读取本地文件的大小
 *			is_readable();
 *			is_writeable();
 *			filectime();
 *			filemtime();
 *			fileactime();
 *			stat();
 *
 *		3. 和文件路径相关的函数
 *			
 *			相对路径：相对于当前目录的上级和下级目录
 *				.  当前目录
 *				.. 上一级目录
 *
 *				./php/apache/index.php
 *				php/apahce/index.php
 *				login.php
 *				./login.php
 *				../images/tpl/logo.gif
 *			
 *
 *			路径分隔符号
 *				linux/Unix    "/"
 *				windows       "\"
 *
 *				DIRECTORY_SEPARATOR  为不同平台，在Windows \ Linux /
 *
 *				不管是什么操作系统PHP的目录分割符号都支技 / (Linux)
 *
 *				在PHP和Apache配置文件中如果需要指定目录，也使用/作为目录符号
 *
 *			绝对路径：
 *				/ 根路径
 *
 *				/images/index.php
 *
 *				指的操作系统的根
 *				指的是存放网站的文档根目录
 *				
 *                              分情况
 *
 *                              如果是在服务器中执行（通过PHP文件处理函数执行）路径 则 “根”指的就是操作系统的根
 *				如果程序是下载的客户端，再访问服务器中的文件时，只有通过Apache访问，“根”也就指的是文档根目录
 *
 *				http://www.xsphp.com/logo.gif
 *
 *
 *			basename(url)
 *			dirname(url)
 *			pathinfo(url)
 *		
 *
 *
 *		
 *		4. 文件的操作相关的函数（
 *
 *			创建文件 touch("文件名")
 *			删除文件 unlink("文件路径");
 *			移动文件 为文件重新命名 rename("当前文件路径"， “目录为文件路径”)
 *			复制文件 copy("当前"， “目标”);
 *			
 *			一定要有PHP执行这个文件权限， Apache, 一个用户
 *
 *
 *		和权限设计有关的函数
 *
 *
		ls -l  或 ll

		_rwxrwxrwx   777

		_ 类型 _文件  d 表示是目录  l  b   

		rwx 表这个文件的拥有者  r读 w写 x执行    
		rwx 表这个文件的拥有者所在的组  r读 w写 x执行
		rwx 其它用户对这个为文件的权限  r读 w写 x执行

		r 4
		w 2
		x 1 

		7 7 7  4+2+1  4+2+1 4+2+1
			rwx   rwx  rwx
		
		644
			4+2   4   4
			rw_  r__ r__
		754
			
		chmod u=rwx,g=rw,o=x
		chmod 777  demo.php
		chmod 644  demo.html

		chown  mysql demo.php

		chgrp  apache demo.php

chgrp -- 改变文件所属的组
chmod -- 改变文件模式
chown -- 改变文件的所有者

filegroup -- 取得文件的组
fileowner -- 取得文件的所有者


 *			
 *
 *		5. 文件的打开与关闭（读文件中的内容， 向文件中写内容）
 *			读取文件中的内容
 *				file_get_contents(); //php5以上
 *				file()  读取所有行
 *				readfile();读取直接输出
 *
 *					不足：全部读取， 不能读取部分，也不能指定的区域
 *
 *				fopen(URL, mode)   //打开的是一个资源
 *				fclose(url)    //关闭文件资源
 *			本地文件：
 *				./test.txt
 *				c:/appserv/www/index.html
 *				/usr/local/apahce/index.html
 *
 *			远程：
 *				http://www.baidu.com
 *				
 *				fopen("./test.txt", "a+")
 *
 *					fwrite fread
 *
 * 				r , 以只读模式打开文件（远程文件）
 * 				r+  读+写（文件不存在会出错）
 * 				w， （本地文件）以只写的方式打开，如果文件不存在，则创建这个文件,并写入内容，如果文件存在，并原来有内容，则会清除原文件中所有内容，再写入（打开已有的重要文件）
				w+ 除了可以写用fwrite, 还可以读fread
 * 				a   以只写的方式打开，如果文件不存在，则创建这个文件，并写放内容，如果文件存在，并原来有内容，则不清除原有文件内容，在原有文件内容的最后写入新内容，（追加）
 * 				a+ 除了可以写用fwrite, 还可以读fread
 * 				b 以二进制模式打开文件（图，电影）（rb读二进制）（wb写二进制文件）
 * 				t 以文本模式打开文件
 *					fread()  // 第一个是读取指定长度的字符
 *					fgetc()  //一次从文件中读取一个字符
 *					fgets()  //一次从文件中读取一行字符
 *					
 *
 *					feof($file); （读取远程文件的方法）如果读取文件出错，或到文件结束，则返回真
 *
 *			写入文件
 *				file_put_contents(“URL”， “内容字符串”);  //php5以上
 *					如果文件不存在，则创建，并写入内容
 *					如果文件存在，则删除文件中的内容，重新写放
 *
 *					不足： 不能以追加的方式写，也不能加锁
 *				 		
 *				fopen()
 *					fwrite() 别名 fputs
 *
 *					第一个参数是文件资源（fopen返回来的），第二个参数是写的内容
 *
 *
 *			本地文件：
 *				./test.txt
 *				c:/appserv/www/index.html
 *				/usr/local/apahce/index.html
 *
 *			远程：
 *				http://www.baidu.com
 *				http://www.163.com
 *
 * 				ftp://user@pass:www.baidu.com/index.php
 *
 *		6. 文件内部移动指针
 *			ftell($file) //返回当前文件针的位置，默认在第一个字符
 *
 *			fseek($file, 10,SEEK_CUR);  //移动文件指针第三个参数是从当前指针位置开始移动100个第三个参数还可以是SEEK_END
 *
 *			fread();
 *
 *			rewind();   //回到文件开始的位置
 *			作用：灵活取文件指定位置的数据（用文件模拟数据库时比较实用）
 *			
 *		7. 文件的锁定一些机制处理
 *	    	flock()   //文件锁定 ，读写穿不同的参数即可
 *
 * 二：目录的处理（系统函数比较少）
 *  		1. 目录的遍历
 				opendir()
 				readdir()   读取指定的目录，接收opendir打开的目录，
 				closedir()
 				rewinddir()		返回第一个目录
 *  		2. 目录的创建
 				mkdir(); //创建一个空目录
 *  		3. 目录的删除
 				rmdir();  //删除空目录
 *  		4. 目录的复制

 *			5. 统计目录大小
 			6.移动或重命名
 			    rename()  //与文件操作一样
 *
 *
 *三：文件上传和下载
 *  		1. 上传
 				 *1. 单个文件上传
 
				 * 	2. 多个文件上传
				 *
				 *	一、PHP配置文件中和上传文件有关的选项
				 *  
				 *     file_uploads = on 
				 *
				 *     upload_max_filesize= 200M  最大不要超过服务器的内存
				 *
				 *     upload_tmp_dir = c:/uploads/
				 *
				         *post_max_size = 250M   要大于文件上传的值（因为post既包括file还有text等等的数据）
				 *
				 *     二、上传表单需要的注意事项
				 *
				 *    1. 如果有文件上传操作表单的提交方法必须 HTTP post 
				 *    2. 表单上传需要使用type为file的表
				 *    3. enctype="multipart/form-data" 只有文件上传时才使用这个值 ，用来指定表单编码的数据方式， 让服务器知道，我们要传递一个文件并带有常规的表单信息。
				 *	
				 *	4. 建议添加一个 MAX_FILE_SIZE 隐藏表单， 值的单位也是字节
				 *
				 *
				 *    三、PHP处理上传的数据
				 *
				 *     
				 *      $_POST 接收非上传的数据
				 *
				 *
				 *    如果是文件上传的数据则使用 $_FILES处理上传的文件
				 注：：多个文件上传<input type="file" name="pic[]">
				 				   <input type="file" name="pic[]">
				 				   <input type="file" name="pic[]">最后以数组的形式返回

 *  		2. 下载
				header("Content-Type:image/gif");
				header('Content-Disposition: attachment; filename="logo3333.gif"');
				header('Content-Length:'.filesize("logo.gif"));
				readfile("logo.gif");
	
 *
 *
 */
	$mess="data.txt";

	if(isset($_POST["sub"])){

		$strmess=$_POST["username"].'<l>'.$_POST['tit'].'<l>'.$_POST["con"].'<l>'.time()."<n>";

		write($mess, $strmess);

		if(file_exists($mess))	{
			$con=read($mess);

			$con=rtrim($con, "<n>");

			$rows=explode("<n>", $con);

			foreach($rows as $row){
				list($username, $tit, $content, $time)=explode("<l>", $row);

				echo '<p><b>'.$username.'</b>在<font color="red">'.date("Y-m-d H:i:s", $time).'</font>说：';
				echo '<i>'.$tit.'</i> ';
				echo '<u>'.$content.'</u></p>';
			

			}

		}
		
	}


	function read($fileName){
		$file=fopen($fileName, "r");

		if(flock($file, LOCK_SH)){
			$con=fread($file, filesize($fileName));
			flock($file, LOCK_UN);
		}
		fclose($file);

		return $con;
		
	}

	function write($fileName, $mess){
		$file=fopen($fileName, "a");
		if(flock($file, LOCK_EX)){	
			fwrite($file, $mess);
			flock($file, LOCK_UN);
		}

		fclose($file);
	}

// <!-- 读取目录大小的函数 -->
	function dirsize($dirname) {
		$dirsize=0;

		$dir=opendir($dirname);

		while($filename=readdir($dir)){
			$file=$dirname."/".$filename;
			if($filename!="." && $filename!=".."){
				if(is_dir($file)){
					$dirsize+=dirsize($file); //递归完成	
				}else{
					$dirsize+=filesize($file);
				}
			}
		}
		closedir($dir);

		return $dirsize;

	}
//删除含有文件的目录
	function deldir($dirname){
		if(file_exists($dirname)) {
			$dir=opendir($dirname);
			while($filename=readdir($dir)){
				if($filename!="." && $filename!=".."){
					$file=$dirname."/".$filename;

					if(is_dir($file)){
					
						deldir($file); //使用递归删除子目录	
					}else{
						echo '删除文件<b>'.$file.'</b>成功<br>';
						unlink($file);
					}
				}
			}
			closedir($dir);
			echo '删除目录<b>'.$dirname.'</b>成功<br>';
			rmdir($dirname);
		}
	}
//复制目录的函数
	function copydir($dirsrc, $dirto){  //第一个参数原目录在哪，第二个参数是复制到哪里
		if(is_file($dirto)){
			echo "目标不是目录不能创建";
			return;
		}

		if(!file_exists($dirto)){
			mkdir($dirto); 
		//	echo "创建目录".$dirto."成功！<br>";
		}//目录存在就直接使用，不存在创建

		$dir=opendir($dirsrc);

		while($filename=readdir($dir)){
			if($filename!="." && $filename!=".."){
				$file1=$dirsrc."/".$filename;
				$file2=$dirto."/".$filename;

				if(is_dir($file1)){
					copydir($file1, $file2); //递归处理
				}else{
			
					copy($file1, $file2);
				}
			}
		}
		closedir($dir);
	}


?>

<form action="one.php" method="post">
	username: <input type="text" name="username"> <br>
	title: <input type="text" name="tit"><br>
	body: <textarea name="con"></textarea><br>
	<input type="submit" name="sub" value="message">
</form>


