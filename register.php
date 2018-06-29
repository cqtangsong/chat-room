<?php
/**
 * @Author: hellen
 * @Date:   2017-06-02 23:04:01
 * @Last Modified by:   hellen
 * @Last Modified time: 2017-06-02 23:04:26
 */
	$usr = $_POST['usrname'];
	$pwd = $_POST['password'];
/*	echo $usr;
	echo $pwd;*/ 
	//将帐号和密码存入数据库的register表中;
	//首先要判断数据库中是否有register表，若没有，创建；
	//之后将帐号和密码存入到表中即可
	

	//连接服务器数据库
	$sql_con = mysql_connect('localhost', 'root', 'hellen123');

	if(!$sql_con)
	{
		die("Can not connect to localhost database");
	}
	/*echo $sql_con;*/
	//选择要连接的数据库
	$con_mysql = mysql_select_db('mysql');

	/*echo $con_mysql;*/
	if(!$con_mysql)
	{
		die("Can not connect to the database selected");
	}

	//连接上数据库之后，将用户名和密码存入数据库中的Register表；若Register表存在，直接将数据插入即可；若Register表不存在，先创建表Register，再插入数据
	$res = mysql_list_tables("mysql");
	$i = 0;
	while($i < mysql_num_rows($res))
	{
		/*echo mysql_tablename($res, $i);              //输出所有的表名;
 		$i++;*/
 		if('register' != mysql_tablename($res, $i))
 		{
 			$i++;
 		}
 		else
 		{
 			echo "数据库表存在";
 			//表Register已经存在，所以将数据插入表Register就行
 			//先判断表中是否存在usr，如果存在，就提示用户名已经存在，若不存在，就将该用户名和密码插入到表中
 			$mysql1 = "select * from register where usr = '" . "$usr'";
 			$res = mysql_query($mysql1);
 			/*$flag = 0;*/
 			while($row = mysql_fetch_array($res))
 			{
 				
 				if($row['usr'] == $usr)
 				{
 					die('用户名已经存在');
 					/*$flag = 1;
 					break;*/
 				}
 				
 			}
 			break;
 		}
	}
	if($i >= mysql_num_rows($res))
	{
		//创建Register表
		$sql_table = "CREATE TABLE Register
		(
			usr varchar(15),
			pwd varchar(15)
		)";
		mysql_query($sql_table);
		$mysql2 = "insert into register (usr, pwd)
 		values ('$usr', '$pwd')";
 		mysql_query($mysql2);
		/*mysql_query('create tables "Register"');*/
	}
	else
	{
		$mysql3 = "insert into register (usr, pwd)
 		values ('$usr', '$pwd')";
 		mysql_query($mysql3);
	}
?>
