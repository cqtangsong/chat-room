<?php
/**
 * @Author: hellen
 * @Date:   2017-06-03 20:27:32
 * @Last Modified by:   hellen
 * @Last Modified time: 2017-06-03 23:24:49
 */
	//得到客户端发来的用户名信息
	$usr = $_POST['usrname'];
	//连接数据库
	//选择要连接的数据库名
	
	//
	/*echo "登上聊天界面了";*/

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
	while($i < mysql_num_rows($tables))
	{
		/*echo mysql_tablename( $tables, $i);
		echo '<br>';
		$i++;*/
		if( 'Logined' != mysql_tablename($tables, $i))
		{
			$i++;
		}
		else //Logined表已存在
		{
			echo "Logined Table 已存在";
			break;
		}
	}
	if($i >= mysql_num_rows($tables)) 
	{
		//Logined Table不存在,创建table ‘Logined’
		$sql_table = "CREATE TABLE Logined
		(
			usr varchar(15)
		)";
		mysql_query($sql_table);
	}
	//把本次登录的用户名存到Logined表格里面
	if($usr)
	{
		$sql_insert = "insert into logined (usr)
 		values ('$usr')";
	}
 	mysql_query($sql_insert);
 	//然后将Table中每一项取出来
 	$sql_Usr = "select * from logined";
 	$Usr_res = mysql_query($sql_Usr);  //把表中所有项存到结果中
 	
 	$count = 0;
 	$arr = array();
 	while($row = mysql_fetch_array($Usr_res))
 	{
 		array_push( $arr, $row['usr']);
 	}
 	echo json_encode($arr);
?>