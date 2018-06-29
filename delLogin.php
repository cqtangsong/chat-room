<?php
/**
 * @Author: hellen
 * @Date:   2017-06-04 11:09:57
 * @Last Modified by:   hellen
 * @Last Modified time: 2017-06-04 11:51:18
 */

//得到客户端发来的用户名信息
	$usr = $_POST['usrname'];
	/*echo $usr;*/
	//连接数据库
	//选择要连接的数据库名

	$mysql = mysql_connect('localhost', 'root', 'hellen123');

	if(!$mysql)
	{
		die("cannot connect to the database！");
	}

	$con_sql = mysql_select_db('mysql');

	if(!$con_sql)
	{
		die("cannot select a valid sql");
	}

	//查询数据库中是否有Logined table
	$tables = mysql_list_tables('mysql');
	$i = 0;
	$flag_login = false;
	while($i < mysql_num_rows($tables))
	{
		/*echo mysql_tablename( $tables, $i);
		echo '<br>';
		$i++;*/
		if( 'logined' != mysql_tablename($tables, $i))
		{
			$i++;
		}
		else //Logined表已存在
		{
			$flag_login = true;
			$i++;
		}
	}
	if($flag_login == true)   //Logined表存在
	{
		//把用户名从Logined表中删除掉
		$sql_del = "delete from logined where usr= '$usr'";
		mysql_query($sql_del);
		echo "删除成功";
	}
?>