<?php
/* 
一：错误处理
	 *	1. 语法错误
	 *
	 *	2. 运行时的错误
	 *
	 *	3. 逻辑错误
	 *
	 * 	
	 * 	错误报告：
	 *
	 * 		错误 E_ERROR    （程序会立即终止执行）
	 *
	 * 		警告 E_WARNING  （）
	 *
	 * 		注意 E_NOTICE   （不会影响程序的运行）
	 *   
	 *	开发阶段：开发时输出所有的错误报告，有利于我们进行程序调试
	 *	运行阶段：不要让程序输出任何一种错误报告（不能让用户看到（懂技术， 不懂技术））
	 *
	 *	将错误报告写入日志中（步骤：一二三）
	 *		一、指定错误报告 error_reporting = E_LL
	 			error_reporting(E_ALL & ~E_NOTICE & ~E_WARNIING)在文件中指定错误的输出级别
	 			*设置配置文件的内容
	 			///	ini_set("error_reporting", "E_ALL");
	 			///	ini_set("display_errors", "off");
				//	ini_set("error_log", "syslog");
				//	ini_set("MAX_FILEUPLOAD", 200000000);
				*得到配置文件的信息
				//	echo ini_get("upload_max_filesize");
	 *		二、关闭错误输出 display_errors = Off
	 *		三、开启错误日志功能 log_errors = On   （将错误报告写出到日志中）
			 *		1. 默认如果不指定错误日志位置，则默认写WEB服务器的日志中
			 *		2. 为error_log选项指定 一个文件名（可写）
			 *		3. 写入到操作系统日志中error_log=syslog
	 *		//	error_log("this is a error message!!!!");输出的错误会写入到指定错误文件中
二：异常处理: 意外，是在程序运行过程中发生的意料这外的事，使用异常改变脚本正常流程
	 *
	 *	if(){
	 *
	 *	}else{
	 *
	 *	}
	 *
	 *	try {
	 *
	 *	}catch(异常对象){
	 *
	 *	}
	 * 	
	 * 		1. 如果try中代码没有问题，则将try中代码执行完后就到catch后执行
	 * 		2. 如果try中代码有异常发生，则抛出一个异常对象(使用throw)，抛出给了catch中的参数, 则在try中代码就不会再继续执行下去
	 *			直接跳转到catch中去执行， catch中执行完成， 再继续向下执行
	 *
	 *
	 *		注意： 提示发生了什么异常，这不是主要我们要做事，需要在catch中解决这个异常， 如果解决不了，则出去给用户
	 *
	 *	二、自己定义一个异常类
	 *
	 *		作用：就是写一个或多个方法解决当发生这个异常时的处理方式
	 *
	 *		1. 自己定义异常类，必须是Exception(内置类)的子类,
	 *		2. Exception类中的只有构造方法和toString()可以重写， 其它都final
	 *
	 *	三、处理多个异常
	 *
	 *	
	 *	自己定义功能类时如果在方法中抛出异常
 *
 */
	


//异常的示例代码
	class OpenFileException extends Exception {

		function __construct($message = null, $code = 0){
			parent::__construct($message, $code);

			echo "wwwwwwwwwwwwwww<br>";
		}
		function open(){
			touch("tmp.txt");

			$file=fopen("tmp.txt", "r");

			return $file;
		}
	}


	class DemoException extends Exception {
		function pro(){
			echo "处理demo发生的异常<br>";
		}
	}

	class TestException extends Exception {
		function pro(){
			echo "这里处理test发生的异常<br>";
		}
	}

	class HelloException extends Exception {

	}

	class MyClass {
		function openfile(){
			$file=@fopen("tmp.txt", "r");

			if(!$file)
				throw new OpenFileException("文件打开失败");
		}

		function demo($num=0){
			if($num==1)
				throw new DemoException("演示出异常");
		}

		function test($num=0){
			if($num==1)
				throw new TestException("测试出错");
		}

		function fun($num=0){
			if($num==1)
				throw new HelloException("###########");
		}
	}

	try{
		echo "11111111111111<br>";

		$my=new MyClass();

		$my->openfile();
		$my->demo(0);
		$my->test(0);
		$my->fun(1);
		echo "22222222222222222<br>";
	}catch(OpenFileException $e){  //$e =new Exception();
		
		echo $e->getMessage()."<br>";

		$file=$e->open();


	}catch(DemoException $e){
		echo $e->getMessage()."<br>";    //得到的异常信息就是throw new DemoException("演示出异常");当中输入的内容
		$e->pro();
	}catch(TestException $e){
		echo $e->getMessage()."<br>";
		$e->pro();
	}catch(Exception $e){
		echo $e->getMessage()."<br>";
	}

		var_dump($file);
		echo "444444444444444444444<br>";


