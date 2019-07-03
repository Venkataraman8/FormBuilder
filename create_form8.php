<?php
session_start();

if(!($_SESSION["user_name"]))
{
header("Location:index.php");
exit();
}
require "database_connection.php";

$user_name=trim($_SESSION["user_name"]);
 $form_name=trim($_REQUEST['title']);
 $_SESSION['form_name']=$form_name;

$description=trim(preg_replace("/[\r\n]+/","</p><p>",$_REQUEST["description"]));

$insert=$mysqli->prepare("INSERT INTO forms(user_name,form_name,form_description) VALUES(?,?,?)");
$insert->bind_param("sss",$user_name,$form_name,$description);
$insert->execute();
$insert->close();



?>
<html>
<head>
<script>
var type;
var req='Not Req';
var i=0;
function br()
{
	linebreak = document.createElement("br");
	document.getElementById('form').appendChild(linebreak);
}

function nextChar(c) {
    return String.fromCharCode(c.charCodeAt(0) + 1);
}



function update_questions(x)
{
	document.getElementById('questions').value=x;
}

function update_types(y)
{
	document.getElementById('types').value+=' '+y;
}

function change()
{
	
		if(req=='Not Req')
		{
		this.setAttribute("style","background-color:red");
		this.innerHTML='Req';
		req='Req';
		}
		else if(req=='Req')
		{
		this.setAttribute("style","background-color:green");
		this.innerHTML='Not Req';
		req='Not Req'
		}
		
	if(document.getElementById("reqtxt"+this.name))
	document.getElementById("reqtxt"+this.name).value=req;
}


function Text()
{
	br();br();

	i++;

	var label=document.createElement("label");
	label.innerHTML="Question"+i+' (text)';
	label.setAttribute('for','question'+i);
	document.getElementById('form').appendChild(label);
	
	var question=document.createElement("input");
	question.id='question'+i;
	question.type='text';
	question.name='question'+i;
	question.size=30;
	document.getElementById('form').appendChild(question);
	
	type='text';
	
	var reqbtn=document.createElement("button");
	reqbtn.setAttribute("type","button");
	reqbtn.id='reqbtn'+i;
	reqbtn.name=i;
	reqbtn.value='Not Req';
	reqbtn.setAttribute("style","background-color:green");
	reqbtn.innerHTML='Not Req';
	document.getElementById('form').appendChild(reqbtn);
	document.getElementById('reqbtn'+i).onclick=change;
	
	var reqtxt=document.createElement("input");
	reqtxt.type='hidden';
	reqtxt.id='reqtxt'+i;
	reqtxt.value='Not Req';
	reqtxt.name='reqtxt'+i;
	document.getElementById('form').appendChild(reqtxt);

	update_questions(i);
	update_types(type);

	
}

function Number()
{
	br();br();
	i++;

	var label=document.createElement("label");
	label.innerHTML="Question"+i+' (number)';
	label.setAttribute('for','question'+i);
	document.getElementById('form').appendChild(label);
	
	var question=document.createElement("input");
	question.id='question'+i;
	question.type='text';
	question.name='question'+i;
	question.size=30;
	document.getElementById('form').appendChild(question);
	
	type='number';
	var reqbtn=document.createElement("button");
	reqbtn.setAttribute("type","button");
	reqbtn.id='reqbtn'+i;
	reqbtn.name=i;
	reqbtn.value='Not Req';
	reqbtn.setAttribute("style","background-color:green");
	reqbtn.innerHTML='Not Req';
	document.getElementById('form').appendChild(reqbtn);
	document.getElementById('reqbtn'+i).onclick=change;
	
	var reqtxt=document.createElement("input");
	reqtxt.type='hidden';
	reqtxt.id='reqtxt'+i;
	reqtxt.value='Not Req';
	reqtxt.name='reqtxt'+i;
	document.getElementById('form').appendChild(reqtxt);
	
	update_questions(i);
	update_types(type);
	
}
function Mcq()
{
	br();br();
	i++;

	
	var label=document.createElement("label");
	label.innerHTML="Question"+i+' (mcq)';
	label.setAttribute('for','question'+i);
	document.getElementById('form').appendChild(label);
	
	var question=document.createElement("input");
	question.id='question'+i;
	question.type='text';
	question.name='question'+i;
	question.size=30;
	document.getElementById('form').appendChild(question);
	
		type='mcq';
	
		var reqbtn=document.createElement("button");
	reqbtn.setAttribute("type","button");
	reqbtn.id='reqbtn'+i;
	reqbtn.name=i;
	reqbtn.value='Not Req';
	reqbtn.setAttribute("style","background-color:green");
	reqbtn.innerHTML='Not Req';
	document.getElementById('form').appendChild(reqbtn);
	document.getElementById('reqbtn'+i).onclick=change;
	
	var reqtxt=document.createElement("input");
	reqtxt.type='hidden';
	reqtxt.id='reqtxt'+i;
	reqtxt.value='Not Req';
	reqtxt.name='reqtxt'+i;
	document.getElementById('form').appendChild(reqtxt);
	

	update_questions(i);
	update_types(type);
	
	
	br();
	for(var j='a';j<='d';j=nextChar(j))
	{
			
			var label=document.createElement("label");
			label.innerHTML='Option '+j;
			label.setAttribute('for','option_'+j+i);
			document.getElementById('form').appendChild(label);
			
			var option=document.createElement("input");
			option.id='option_'+j+i;
			option.type='text';
			option.name='option_'+j+i;
			option.size=10;
			document.getElementById('form').appendChild(option);
	}
	

	
}
function Maq()
{
	br();br();
	i++;

	
	var label=document.createElement("label");
	label.innerHTML="Question"+i+' (maq)';
	label.setAttribute('for','question'+i);
	document.getElementById('form').appendChild(label);
	
	var question=document.createElement("input");
	question.id='question'+i;
	question.type='text';
	question.name='question'+i;
	question.size=30;
	document.getElementById('form').appendChild(question);

	
	type='maq';	
	
		var reqbtn=document.createElement("button");
	reqbtn.setAttribute("type","button");
	reqbtn.id='reqbtn'+i;
	reqbtn.name=i;
	reqbtn.value='Not Req';
	reqbtn.setAttribute("style","background-color:green");
	reqbtn.innerHTML='Not Req';
	document.getElementById('form').appendChild(reqbtn);
	document.getElementById('reqbtn'+i).onclick=change;
	
	var reqtxt=document.createElement("input");
	reqtxt.type='hidden';
	reqtxt.id='reqtxt'+i;
	reqtxt.value='Not Req';
	reqtxt.name='reqtxt'+i;
	document.getElementById('form').appendChild(reqtxt);
	

	update_questions(i);
	update_types(type);
		br();
	for(var j='a';j<='d';j=nextChar(j))
	{
			var label=document.createElement("label");
			label.innerHTML='Option '+j;
			label.setAttribute('for','option_'+j+i);
			document.getElementById('form').appendChild(label);
			
			var option=document.createElement("input");
			option.id='option_'+j+i;
			option.type='text';
			option.name='option_'+j+i;
			option.size=10;
			document.getElementById('form').appendChild(option);
	}
	


	
}
function Image()
{
	br();br();
	i++;

	
	var label=document.createElement("label");
	label.innerHTML="Question"+i+' (image)';
	label.setAttribute('for','question'+i);
	document.getElementById('form').appendChild(label);
	
	var question=document.createElement("input");
	question.id='question'+i;
	question.type='text';
	question.name='question'+i;
	question.size=30;
	document.getElementById('form').appendChild(question);
	
	type='image';

	var reqbtn=document.createElement("button");
	reqbtn.setAttribute("type","button");
	reqbtn.id='reqbtn'+i;
	reqbtn.name=i;
	reqbtn.value='Not Req';
	reqbtn.setAttribute("style","background-color:green");
	reqbtn.innerHTML='Not Req';
	document.getElementById('form').appendChild(reqbtn);
	document.getElementById('reqbtn'+i).onclick=change;
	
	var reqtxt=document.createElement("input");
	reqtxt.type='hidden';
	reqtxt.id='reqtxt'+i;
	reqtxt.value='Not Req';
	reqtxt.name='reqtxt'+i;
	document.getElementById('form').appendChild(reqtxt);
	

	update_questions(i);
	update_types(type);
	
}
function File()
{
	br();br();
	i++;


	var label=document.createElement("label");
	label.innerHTML="Question"+i+' (file)';
	label.setAttribute('for','question'+i);
	document.getElementById('form').appendChild(label);
	
	var question=document.createElement("input");
	question.id='question'+i;
	question.type='text';
	question.name='question'+i;
	question.size=30;
	document.getElementById('form').appendChild(question);
	
	type='file';
	
		var reqbtn=document.createElement("button");
	reqbtn.setAttribute("type","button");
	reqbtn.id='reqbtn'+i;
	reqbtn.name=i;
	reqbtn.value='Not Req';
	reqbtn.setAttribute("style","background-color:green");
	reqbtn.innerHTML='Not Req';
	document.getElementById('form').appendChild(reqbtn);
	document.getElementById('reqbtn'+i).onclick=change;
	
	var reqtxt=document.createElement("input");
	reqtxt.type='hidden';
	reqtxt.id='reqtxt'+i;
	reqtxt.value='Not Req';
	reqtxt.name='reqtxt'+i;
	document.getElementById('form').appendChild(reqtxt);
	

	update_questions(i);
	update_types(type);
	
}
</script>
</head>


<body >
<button id='text' onclick='Text()' style=>Text </button>
<button id='number' onclick='Number()'>Number</button>
<button id='mcq' onclick='Mcq()'>MCQ</button>
<button id='maq' onclick='Maq()'>MAQ</button>
<button id='image' onclick='Image()'>Image</button>
<button id='file' onclick='File()'>File</button>

<h2><center><?php echo "Create form".$form_name;?></center></h2>
<form id='form' action='create_form2.php' Method='POST'>
<input type='hidden' id='questions' name='questions' >
<input type='hidden' id='types' name='types' >
<br/><br/>
<center><input type='submit' value='Create'/></center>
</form>
</body>
</html>
