<html>

<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<script src="<?php echo base_url();?>/assets/js/jquery-3.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<style>
		.blur{
			display: none
		}
	</style>
</head>

<body>

<div class="container"><br>
<center><h3 id="tablehedding">Student Details</h3></center><br>
<div class="row col-md-12">
<div class="col-md-4">
	<input class="form-control" placeholder="search by first name" id="sfname"><button class="btn btn-primary" onClick="sfname();"><i class="fa fa-search" aria-hidden="true"></i></button></div>
<div class="col-md-4">
	<input class="form-control" placeholder="search by last name"id="slname"><button class="btn btn-primary" onClick="slname();"><i class="fa fa-search" aria-hidden="true"></i></button>
</div>
<div class="col-md-4">
	<input class="form-control" placeholder="search by telephone" id="stel"><button class="btn btn-primary" onClick="stel();"><i class="fa fa-search" aria-hidden="true"></i></button>
</div>
</div>
	<table class="table table-hover" id="studentsdetails">
	<thead>
		<tr>
			<th>Index Nubmer</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Telephone Number</th>
		</tr>
	</thead>
	<tbody>
	<tr>
		<td><input id="index" class="form-control" disabled></td>
		<td><input id="fname"  class="form-control"></td>
		<td><input id="lname"  class="form-control"></td>
		<td><input id="tp"  class="form-control"></td>
		<td><button class="btn btn-success col-md-10 btn-sm" style="width:100%;" id="addbtn"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add</button></td>
	</tr>
	<?php
		foreach($students as $student){
		echo"<tr><td>".$student['IndexNo']."</td><td class=\"clickMe\"><span class=\"label label-default \">".$student['Fname']."</span>
        <input id=\"textBox1\" class=\"blur\"></td><td class=\"clickMe\"><span class=\"label label-default \">".$student['Lname']."</span>
        <input id=\"textBox1\" class=\"blur\"></td><td class=\"clickMe\"><span class=\"label label-default \">".$student['Tel']."</span>
        <input id=\"textBox1\" class=\"blur\"></td><td><button class=\"btn btn-warning btn-sm updatebtn\"><i class=\"fa fa-pencil-square\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Update</button>&nbsp;&nbsp;<button class=\"btn btn-danger btn-sm Delete\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i>&nbsp;&nbsp;Delete</button></td></tr>";
		
		}
		?>
		
	</tbody>
		
	</table>
</div>

</body>
<script>
$('.clickMe').click(function () {
    "use strict";
    this.firstChild.style.display = "none";
	
    $(this).children().last()
                    .val(this.firstChild.textContent)
                    .toggleClass("form-control")
                    .show()
                    .focus();
});

$('.blur').blur(function () {
    "use strict";
    $(this)
        .hide()
        .toggleClass("form-control");
    var myid = (this).id;
    this.parentNode.firstChild.style.display = "inline";
	 this.parentNode.firstChild.textContent= $(this).val();
       
        
});
$('#addbtn').click(function(){
	
	$.ajax({
		type:"post",
		url:'<?php echo base_url('Managestudent/newstudent')?>',
		data:{fname:$('#fname').val(),lname:$('#lname').val(),tel:$('#tp').val()},
		success:function(data){
			if($('#alert')!=null){
							$('#alert').remove();
						}
						if(data=="success"){
							$("<div id=\"alert\" class=\"alert alert-success col-md-10 col-md-offset-1\"><strong>Success!</strong>New Student Successfully added to the system</div>").insertAfter('#tablehedding');
							
							$('#fname').val("");
							
							$('#lname').val("");
							$('#tp').val("");
							window.scrollTo(0,0);
							
						}
						else{
						$("<div id=\"alert\" class=\"alert alert-danger col-md-10 col-md-offset-1\"><strong>Error!</strong>"+data+"</div>").insertAfter('#tablehedding');
							window.scrollTo(0,0);
						}
		
	}
		
	});
	
}) ;   
$('.Delete').click(function(){
	var index=this.parentNode.parentNode.firstChild.innerHTML;
	
	$.ajax({
		type:"post",
		url:"<?php echo base_url('Managestudent/deletestudent')?>",
		data:{index:index}
		
	});
	
});
$('.updatebtn').click(function(){
	var index=this.parentNode.parentNode.firstChild.innerHTML;
	var fname=this.parentNode.parentNode.firstChild.nextSibling.firstChild.innerHTML;
	var lname=this.parentNode.parentNode.firstChild.nextSibling.nextSibling.firstChild.innerHTML;
	var tel=this.parentNode.parentNode.firstChild.nextSibling.nextSibling.nextSibling.firstChild.innerHTML;
	$.ajax({
		type:"post",
		url:"<?php echo base_url('Managestudent/updatestudent')?>",
		data:{index:index,fname:fname,lname:lname,tel:tel},
		success:function(data){
			if($('#alert')!=null){
							$('#alert').remove();
						}
						if(data=="success"){
							$("<div id=\"alert\" class=\"alert alert-success col-md-10 col-md-offset-1\"><strong>Success!</strong>Student Successfully updated</div>").insertAfter('#tablehedding');
							window.scrollTo(0,0);
							
						}
						else{
						$("<div id=\"alert\" class=\"alert alert-danger col-md-10 col-md-offset-1\"><strong>Error!</strong>"+data+"</div>").insertAfter('#tablehedding');
							window.scrollTo(0,0);
						}
		
	}
		
	});
	
});	
function sfname(){
	var rowarray=document.getElementById('studentsdetails').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
	var fname=$('#sfname').val();
	var rows=rowarray.length;
	for(var i=1;i<rows;i++){
		if(rowarray[i].getElementsByTagName('td')[1].getElementsByTagName('span')[0].innerHTML != fname){
			rowarray[i].style.visibility="hidden";
		}
	}
	
}	
</script>
</html>