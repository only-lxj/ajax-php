<?php
// 设置html页面的编码格式是utf-8
header("Content-Type:text/plain;charset=utf-8");
// header("Content-Type:application/json;charset=utf-8");
// header("Content-Type:text/xml;charset=utf-8");
// header("Content-Type:text/html;charset=utf-8");
// header("Content-Type:application/javascript;charset=utf-8");

//定义一个多维数组，包括员工的信息，每条员工信息为一个数组
$arr = array(
	array("name" => "Tom", "number" => "101","sex" => "男","job" => "演员"),
	array("name" => "Jack", "number" => "102","sex" => "男","job" => "经理"),
	array("name" => "Mary", "number" => "103","sex" => "女","job" => "歌手")
);

//判断如果是get请求，则进行搜索；如果是post请求，则进行新建数据
// $_SERVER是一个超全局变量，在一个脚本的全部作用域中都可用，不用使用global关键字
// $_SERVER["REQUEST_METHOD"]返回访问页面使用的请求方法
if($_SERVER["REQUEST_METHOD"] == "GET")
{
	//请求方法为GET方式，进行搜索
	search();
}
else if($_SERVER["REQUEST_METHOD"] == "POST")
{
	//请求方式为post方式，创建数据
	create();
}
// 通过员工编号搜索员工
function search(){
	/*
	检查有没有员工编号的参数
	isset检测变量是否设置；empty判断值是否为空
	超全局变量$_GET和$_POST用于收集表单数据
	*/
	if(!isset($_GET["number"]) || empty($_GET["number"]))
	{
		echo "参数错误";
		return;
	}
	/*
	函数之外声明的变量拥有global作用域，只能在函数以外进行访问
	global关键词用于访问函数内的全局变量
	*/
	global $arr;
	// 获取number参数
	$number = $_GET["number"];
	$result = "没有找到员工";
	
	// 遍历$arr多维数组，查找key值为number的员工是否存在，如果存在，则修改返回结果
	foreach($arr as $value){
		if($value["number"] == $number)
		{
			$result = "找到员工：<br/>员工编号：".$value["number"]."，员工姓名：".$value["name"]."，员工性别：".$value["sex"]."，员工职位：".$value["job"];
			break;
		}
	}
	echo $result;
}
//创建员工
function create(){
//判断信息是否填写完全
	if(!isset($_POST["name"]) || empty($_POST["name"])
		||!isset($_POST["number"]) || empty($_POST["number"])
		||!isset($_POST["sex"]) || empty($_POST["sex"])
		||!isset($_POST["job"]) || empty($_POST["job"]))
	{
		echo "参数错误，员工信息填写不全";
		return;
	}
	//TODO:获取POST表单数据并保存到数据库
	
	//提示保存成功
	echo "员工：".$_POST["name"]."信息保存成功！";
}
?>
