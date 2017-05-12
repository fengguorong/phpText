<?php
/* 日期和时间
 *
 * 	1. 介绍UNIX时间戳 （以秒为时间单位）
 *		以32位整数表示格林威治标准时间  11230499325
 *
 *		这个UINIX时间戳整数是从1970年1月1日0时0分0秒（计算机元年）到现在的秒数
 *		作用：方便我们计算使用（参于运算）
 *
 *
 * 		1970---2038  
 *
 *
 * 	2. 在PHP中获取日期和时间 
 * 		time()  //获取当前时间的时间戳
 * 		getDate()  //获取日期时间，返回一个关联数组
 * 		gettimeofday()  //获取某一天的具体时间
 * 		date_sunrise()    //获取你所在的地区日出的时间
 * 		date_sunset()    //获取你所在的地区日落的时间
 *
 *
 * 	3. 日期和时间的格式化输出
 * 		将时间戳的格式转了 我们可以读懂的时间格式
 * 		date(string, [timestamp]);
 *
 * 	4. 将日期和时间转变成UNIX时间戳
 * 		mktime()   //若果超出时间，会自动矫正
 *
 *
 * 	5. 修改PHP的默认时区
 * 		php.ini   //php配置文件date.timezone=
 * 		
 		在程序中写 date_default_timezone_set("PRC");  //PRC中华人民共和国的缩写
 *
 *		Asia/Shanghai
 *		PRC
 *		Gtc/GET-8 
 *
 * 	6. 使用微妙计算PHP脚本执行的时间
 *
 * 		microtime();   //微秒的执行时间，时间单位为微秒,参数有两种true / false 当参数为true时返回带有浮点数的时间戳，为false时返回一个字符串（浮点数 以秒为单位的时间戳）
 *
 * 	
 *     使用 PHP 制作 日历
 *	
 *
 *
 */



class Timer {
	private $startTime;
	private $stopTime;

	function __construct(){
		$this->startTime=0;
		$this->stopTime=0;
	}

	function start(){
		$this->startTime=microtime(true);
		echo $this->startTime."<br>";
	}

	function stop(){
		$this->stopTime=microtime(true);
		echo $this->stopTime."<br>";
	}

	function spent(){
		return round(($this->stopTime-$this->startTime), 4);
	}
}

$timer=new Timer;

$timer->start();

for($i=0; $i<10000; $i++)
{
	
}	

$timer->stop();

echo $timer->spent();


