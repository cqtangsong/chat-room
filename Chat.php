<?php
/**
 * @Author: hellen
 * @Date:   2017-06-04 10:19:06
 * @Last Modified by:   hellen
 * @Last Modified time: 2017-06-04 12:39:01
 */
	//得到客户端发来的数据
	$usr = $_POST['usrname'];
	$mess = $_POST['content'];

	//把该条信息存到数据库messages表中
	//连接数据库;
	//选择要连接的数据库名
	$mysql = mysql_connect('localhost', 'root', 'hellen123');
	if(!$mysql)
	{
		die("mySql connect failed");
	}

	$con_sql = mysql_select_db('mysql');
	if(!$con_sql)
	{
		die("not a valid database");
	}

	//查表messages,是否存在?
	$tables = mysql_list_tables('mysql');            //获得数据库中所有的表

	$row = 0;
	$flag_table = false;
	while( $row < mysql_num_rows($tables))
	{
		if( 'messages' != mysql_tablename($tables, $row))
		{
			$row++;
		}
		else
		{
			$falg_table = true;
			$row++;
		}
	}
	if($flag_table == false)        //如果messages表不存在
	{
		//创建表messages
		$sql_create = "CREATE TABLE messages
		(
			user varchar(15),
			msg  TEXT
		)";

		mysql_query($sql_create);            //创建messages表
	}

	//将用户名和消息存到该表中

	$sql_insert = "insert into messages (user, msg)
		values ('$usr', '$mess')";
	mysql_query($sql_insert);

	echo '{"usrname": "' . $usr . '", "content" :"' . $mess. '"}';
?>