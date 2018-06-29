<?php
/**
 * @Author: hellen
 * @Date:   2017-06-04 12:04:54
 * @Last Modified by:   hellen
 * @Last Modified time: 2017-06-04 12:55:30
 */

	/*echo '访问数据库';*/
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
			/*echo mysql_tablename($tables, $row);
			echo '<br>';*/
			$row++;
		}
		else
		{
			$flag_table = true;
			break;
		}
	}
	if($row < mysql_num_rows($tables) && $flag_table == true)        //如果messages表存在
	{
		/*echo "Yes";*/
		//查询表
		$sql_search = 'select * from messages';
		$res = mysql_query($sql_search);
		//将查询得到的结果遍历一遍，并返回给客户端
		$arr = array();
		while($r = mysql_fetch_array($res)){
			/*echo "获取到数据";*/
			$str = "";
			$str = '{"usrname": "';
			$str = $str . $r['user'];
			$str = $str . '", "content" :"';
			$str = $str . $r['msg'];
			$str = $str . '"}';
			/*echo $str;*/
			array_push($arr, json_encode($str));
		}
		/*echo json_encode($str);*/
		echo json_encode($arr);
	}
?>