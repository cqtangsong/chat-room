<?php
/**
 * @Author: hellen
 * @Date:   2017-06-02 23:02:34
 * @Last Modified by:   hellen
 * @Last Modified time: 2017-06-04 10:56:45
 */
	$number = $_GET['num'];
	$pass = $_GET['pass'];

	$falg_login = false;
	//得到浏览器输入的登录帐号和密码
	
	//连接数据库
	$mysql = mysql_connect('localhost', 'root', 'hellen123');

	if(!$mysql)
	{
		die("cannot connect to database");
	}
	$con_sql = mysql_select_db('mysql');

	if(!$con_sql)
	{
		die("cannot select a valid sql");
	}
	/*echo $number;*/
	$mysql_check = "select * from register where usr = '" . $number . "'";           //去访问注册表，是否该用户已注册
	$res = mysql_query($mysql_check);

	$mysql_login = "select * from logined";           //去访问注册表，是否该用户已注册
	$res_login = mysql_query($mysql_login);

	/*echo $res;*/
	
	if($row = mysql_fetch_array($res))
	{
		if($row['pwd'] != $pass)
		{
			echo "密码错误";
		}
		else
		{
			//输出登录成功的信息;
			/*echo "登录成功";*/
			//查询登Logined表，如果表中有该用户名，就提醒用户登录不成功;
			while($row = mysql_fetch_array($res_login))
			{
				if($row['usr'] == $number)
				{
					echo '用户已登录';
					$falg_login = true;
					/*break;*/
				}
			}
			if($falg_login == false)
			{
				echo "登录成功";
			}
		}
	}
	else
	{
		echo "用户不存在,请先注册";
		/*$row = mysql_fetch_array($res);*/
	}
	/*echo $number;
	echo $pass;*/
?>