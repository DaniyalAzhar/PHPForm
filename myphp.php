<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"/>
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

<style>
.missing{
	background-color: red;
	color: red;
}
</style>
</head>
<body>

<?php
// define variables and set to empty values
$name = $email = $gender = $contacts = $address = $age = $university = $major = $gradYear = $experience = $projects = $hobby = $preference = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = test_input($_POST["name"],"name");

	$email = test_input($_POST["email"], "email");
	if(!preg_match("^[a-zA-Z0-9]+[.][a-zA-Z0-9]+@[a-zA-Z0-9]+[.][a-zA-Z0-9]+[.][a-zA-Z0-9]+$",$email)){
		print "that is not a valid email address";}

	$contacts = test_input($_POST["contact"],"contact");
	if(!preg_match("[0-9][0-9][0-9][0-9][0-9][0-9][0-9]+",$contacts)){
	print "that is not a valid number";}

	$address = test_input($_POST["address"],"address");
	$age = test_input($_POST["age"],"age");
	if(!preg_match("[0-9][0-9]+",$age)){
		print "that is not a valid age";}

	$gender = test_input($_POST["gender"],"gender");

	$university = test_input($_POST["university"],"university");

	$major = test_input($_POST["major"],"major");

	$gradYear = test_input($_POST["year"],"graduation Year");

	$experience = test_input($_POST["experience"],"experience");

	$projects = test_input($_POST["projects"],"projects");

}

function test_input($data,$field) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	if(empty($data)) {
		print "The". $field. "field cannot be empty";
		return false;
	}
	else{
		print "Hey";
		return $data;}
}
?>

<div data-role="page">
	<div data-role="header" style="background-color: #88D388;">
		<h1>Portfolio</h1>
	</div>

	<div data-role="main" class="ui-content">
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
			<fieldset data-role="collapsible">
			<legend>Personal Info!</legend>
				<label for="name">Full Name:</label>
					<input type="text" name="name" id="name" class="required">
				<label for="contact">Contact:</label>
					<input type="text" name="contact" id="contact" class="required">
				<label for="email">E-mail:</label>
				<input type="text" name="email" id="email" class="required">
				<label for="contact">Address:</label>
					<input type="text" name="address" id="address" class="required">
				<label for="contact">Age:</label>
					<input type="text" name="age" id="age" class="required">
				<label for="contact">Gender:</label>
					<input type="radio" name="gender" id="gender" value="male" class="required">Male<br>
					<input type="radio" name="gender" id="gender" value="female" class="required">Female
			</fieldset>

			<fieldset data-role="collapsible">
			<legend>Academic Info!</legend>
				<label for="university">University:</label>
					<select  name="university" class="required">
						<option value="nust">NUST</option>
						<option value="lums">LUMS</option>
						<option value="giki">GIKI</option>
						<option value="fast">FAST</option>
					</select>
				<label for="major">Major:</label>
					<select name="major" class="required">
						<option value="cs">Computer Science</option>
						<option value="ee">Electrical Engineering</option>
						<option value="se">Software Engineering</option>
						<option value="me">Mechanical Engineering</option>
					</select>
				<label for="gradYear"><b>Graduation year:</b></label>
				<label for="day">Day:</label><select name="day" id="daydropdown" class="required"></select>
				<label for="month">Month:</label><select name="month" id="monthdropdown" class="required"></select>
				<label for="year">Year:</label><select name="year" id="yeardropdown" class="required"></select>
			</fieldset>


			<fieldset data-role="collapsible">
			<legend>Experience/Projects!</legend>
				<label for="experience">Experience:</label>
Tell us about any work experience that you may have.
					<textarea  name="experience" id="experience" class="required"></textarea>

				<label for="projects">Projects:</label>
Any projects that you may have done?
					<textarea  name="projects" id="projects" class="required"></textarea>
			</fieldset>

			<p>Select hobbies:</p>
			<div data-role="controlgroup">
				<label for="gaming">Gaming</label>
					<input type="checkbox" name="hobby" id="gaming" value="gaming" class="required">
					<label for="sports">Sports</label>
					<input type="checkbox" name="hobby" id="sports" value="sports" class="required">
					<label for="music">Music</label>
					<input type="checkbox" name="hobby" id="music" value="music" class="required">
			</div>
			<p>Select preference:</p>
			<div data-role="controlgroup">
				<label for="ft">Full-time</label>
					<input type="checkbox" name="preference" id="ft" value="ft" class="required">
					<label for="pt">Part-time</label>
					<input type="checkbox" name="preference" id="pt" value="pt" class="required">
					<label for="fl">Freelance</label>
					<input type="checkbox" name="preference" id="fl" value="fl" class="required">
			</div>

			<input type="submit" data-inline="true" value="Submit" style=" background-color: green;" id="button">
		</form>
	</div>
	<div id="errormessage" style="color: red;">

	</div>
</div>


<script type="text/javascript">

var monthtext=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'];
function populatedropdown(dayfield, monthfield, yearfield){
var today=new Date()
var dayfield=document.getElementById(dayfield)
var monthfield=document.getElementById(monthfield)
var yearfield=document.getElementById(yearfield)
for (var i=0; i<31; i++)
dayfield.options[i]=new Option(i, i+1)
dayfield.options[today.getDate()]=new Option(today.getDate(), today.getDate(), true, true) //select today's day
for (var m=0; m<12; m++)
monthfield.options[m]=new Option(monthtext[m], monthtext[m])
monthfield.options[today.getMonth()]=new Option(monthtext[today.getMonth()], monthtext[today.getMonth()], true, true) //select today's month
var thisyear=today.getFullYear()
for (var y=0; y<20; y++){
yearfield.options[y]=new Option(thisyear, thisyear)
thisyear+=1
}
yearfield.options[0]=new Option(today.getFullYear(), today.getFullYear(), true, true) //select today's year
}

window.onload=function(){
document.getElementById("daydropdown").className = "";
populatedropdown("daydropdown", "monthdropdown", "yeardropdown")
}
</script>
<?php
$fp = fopen("file.txt", "w");
fwrite($fp,"Name= ".$name ." Email= ".$email ." Gender= ".$gender ." Contacts= ".$contacts ." Address= ".$address ." Age= ".$age ." University= ".$university ." Major= ".$major ." Graduation Year= ".$gradYear ." Experience= ".$experience ." Projects= ".$projects);
fclose($fp);
?>
</body>
</html>