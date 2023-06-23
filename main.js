const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const signInContinue = document.getElementById('signInContinue');
const container = document.getElementById('container');
let uppass = [];
let inpass = [];
var order = [1,3,5,7,6,4,2,0]

signUpButton.addEventListener('click', () => {
    container.classList.add('right-panel-active');
});



signInButton.addEventListener('click', () => {
    container.classList.remove('right-panel-active');
});
// adding and removing border
function upimg(element) {
    var Image = element.querySelector('img');
    if (Image) {
        if (Image.classList.contains('clicked')) {
            Image.classList.remove('clicked');
            uppass.splice(uppass.indexOf(element.id), 1);
            // console.log(element.id);
            // console.log(uppass);
        }
        else {
            Image.classList.add('clicked');
            uppass.push(element.id);
            // console.log(element.id);
            // console.log(uppass);
        }
    }
}

function inimg(element) {
    var Image = element.querySelector('img');
    if (Image) {
        if (Image.classList.contains('clicked')) {
            Image.classList.remove('clicked');
            inpass.splice(inpass.indexOf(element.id), 1);
            // console.log(element.id);
            // console.log(inpass);
        }
        else {
            Image.classList.add('clicked');
            inpass.push(element.id);
            // console.log(element.id);
            // console.log(inpass);
        }
    }
}
// element image recognition
function signup() {
    console.log("Success");
    sessionStorage.setItem("upname", document.getElementById('upmail').value);
    sessionStorage.setItem("uppass", uppass);
    var myText = "Account Created Succesfully";
    console.log("Success2");
    pass_signup = "";
    uppass.forEach(element => {
        pass_signup = pass_signup+element;
    });
    console.log(pass_signup);
    document.cookie = "upmail = " + document.getElementById('upmail').value;
    document.cookie = "upname = " + document.getElementById('upname').value;
    document.cookie = "uppass = " + pass_signup;

    $.ajax({
        url: 'signup.php',
        type: 'post',
        success: function(response){
            console.log(typeof(response));
            if(response == "Invalid email: "){
                alert("Invalid Details");
            }
            else{
                console.log("sucessfully logged in");
                window.location.href = "page2.php";
            }
        },
        error: function(response){
            alert("error!!");
        }
    });

}
// image pattern authentication
var v2 = new Boolean(false);
function convertToHex(rgb) {
    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
  
    function hexCode(i) {
        return ("0" + parseInt(i).toString(16)).slice(-2);
    }
    return "#" + hexCode(rgb[1]) + hexCode(rgb[2])
            + hexCode(rgb[3]);
}
function signin() {
    //let str = document.getElementById('inmail').value;
    //let array = sessionStorage.getItem("uppass");
    //let check1 = array.localeCompare(inpass.toString());
    let signin_password = document.getElementById('inpassword').value; 
    // if ((!str.localeCompare(sessionStorage.getItem("upname"))) && !check1) {
    //     var myText = "Login is successful";
    //     alert(myText);
    // }
    // else{
    //     var myText = "Login Failed";
    //     alert(myText);
    // }
    var position_values = getCookie("position").split(',');
    console.log(position_values);
    var pos1 = parseInt(position_values[order[signin_password.charAt(0)-'1']])+1;
    var pos2 = parseInt(position_values[order[signin_password.charAt(1)-'1']])+1;
    var pos3 = parseInt(position_values[order[signin_password.charAt(2)-'1']])+1;
    var pos4 = parseInt(position_values[order[signin_password.charAt(3)-'1']])+1;
    console.log(pos1);
    var inputpassword = convertToHex($("#wheel div.sec:nth-child("+ pos1 +")").css("border-color"))
    + convertToHex($("#wheel div.sec:nth-child("+ pos2 +")").css("border-color"))
    + convertToHex($("#wheel div.sec:nth-child("+ pos3 +")").css("border-color"))
    + convertToHex($("#wheel div.sec:nth-child("+ pos4 +")").css("border-color"));
    //const rgb2hex = (rgb) => `#${rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/).slice(1).map(n => parseInt(n, 10).toString(16).padStart(2, '0')).join('')}`
    console.log(inputpassword.toUpperCase());
    document.cookie = "inputpassword = "+ inputpassword.toUpperCase();
    //var col_password = document.cookie;
    //console.log(col_password);

    $.ajax({
        url: 'signin-2.php',
        type: 'post',
        success: function(response){
            console.log(typeof(response));
            if(response == "Invalid details"){
                alert("Invalid Details");
            }
            else if(response == "succesfully logged in"){
                console.log("sucessfully logged in");
                window.location.href = "page.php";
            }
            else{
                alert("Network error. Please try again")
            }
        },
        error: function(response){
            alert("error!!");
        }
    }); 


}

function shuffle(array) {
    for (let i = array.length - 1; i > 0; i--) {
      let j = Math.floor(Math.random() * (i + 1)); // random index from 0 to i
  
      // swap elements array[i] and array[j]
      // we use "destructuring assignment" syntax to achieve that
      // you'll find more details about that syntax in later chapters
      // same can be written as:
      // let t = array[i]; array[i] = array[j]; array[j] = t
      [array[i], array[j]] = [array[j], array[i]];
    }
  }


function signincontinue() {
   
    let array = sessionStorage.getItem("uppass");
    //let check1 = array.localeCompare(inpass.toString());
    let signin_email = document.getElementById('inmail').value; 
    pass_signin = "";
    inpass.forEach(element => {
        pass_signin = pass_signin+element;
    });
    console.log(pass_signin);
    document.cookie = "inpass = " + pass_signin;
    document.cookie = "inemail = " + signin_email;
    //var cookie = document.cookie;
    //console.log(cookie);
    //console.log(getCookie("col_password"));
    $.ajax({
        url: 'signin-1.php',
        type: 'post',
        success: function(response){
            console.log(typeof(response));
            if(response == "Invalid details"){
                console.log("error!!");
                alert("Invalid Details");
            }
            else{
                const obj = JSON.parse(response);
                // get colors
                console.log(obj.col_password);
                let colors = obj.col_password.match(/.{7}/g);
                console.log(colors);

                // const password_colors = colors;

                container.classList.add('right-panel-active-2');
                // signInContinue.addEventListener('click', () => {
                    
                // });
                
                let allColors = ["#FF0000","#0000FF", "#00FF00", "#FFFF00", "#FFC0CB", "#8F00FF", "#000000",
            "#FFFFFF", "#808080", "#E75480", "#FFA500", "#006400", "#87CEEB"];

                shuffle(allColors);

                for(let i=0;i<13;i++){
                    if(colors.length == 8){
                        break;
                    }
                    if(colors.includes(allColors[i])){
                        continue;
                    }
                    else{
                        colors.push(allColors[i]);
                    }
                }
                console.log(colors);
                shuffle(colors);
                // let random_numbers = randoSequence(0, 8);
                // console.log(random_numbers);
                
                let password_position = [];
                // for(let i=0;i<4;i++){
                //     colors.push(newColors[random_numbers[i]]);
                //     // if(password_colors.includes(colors[random_numbers[i]])){
                //     //     password_position.push(random_numbers[i]);
                //     // }
                //     //var wer = i+1;
                    
                    
                // }
               

                $("#wheel div.sec:nth-child(1)").css("border-color",colors[0]);
                $("#wheel div.sec:nth-child(2)").css("border-color",colors[1]);
                $("#wheel div.sec:nth-child(3)").css("border-color",colors[2]);
                $("#wheel div.sec:nth-child(4)").css("border-color",colors[3]);
                $("#wheel div.sec:nth-child(5)").css("border-color",colors[4]);
                $("#wheel div.sec:nth-child(6)").css("border-color",colors[5]);
                $("#wheel div.sec:nth-child(7)").css("border-color",colors[6]);
                $("#wheel div.sec:nth-child(8)").css("border-color",colors[7]);
                for(let j=0;j<4;j++){
                    password_position.push(colors.indexOf(colors[j]));
                }
                console.log(password_position);
                console.log(colors);

                
            }
            
        },
        error: function(response){
            alert("error!!");
        }
    });

    
    
}

function getCookie(cookieName) {
    let cookie = {};
    document.cookie.split(';').forEach(function(el) {
      let [key,value] = el.split('=');
      cookie[key.trim()] = value;
    })
    console.log(cookie);
    return cookie[cookieName];
}

 function sendMail2(){
    var templateParams1 = {
        email: getCookie("inmail"),
        notes: 'Check this out!'
    };
     

    emailjs.send('service_7q1sn6s', 'template_v7f98gs', templateParams1)
    .then(function(res){
        // console.log("Success", res.status);
        alert("mail sent successfully");
    })
}
function sendMail1(){
    var templateParams2 = {
        name: document.getElementById('inmail').value,
        notes: 'Check this out!'
    };
     
    emailjs.send('service_7q1sn6s', 'template_ogw30ms', templateParams2)
    .then(function(res){
        // console.log("Success", res.status);
        alert("mail sent successfully");
    })
}

function NewTab() {
    window.open(
      "https://sih.gov.in/", "_blank");
}






/***************************************************************************************** */

//set default degree (360*5)
var degree = 1800;
//number of clicks = 0
var clicks = 0;
var position=[];
var position_name=[];
var position_left=[];

var num_order = [1,7,8,2,6,3,5,4]

$(document).ready(function(){
	
	/*WHEEL SPIN FUNCTION*/
	$('.spinbtn').click(function(){
		
		//add 1 every click
		clicks ++;
		
		/*multiply the degree by number of clicks
	    generate random number between 1 - 360, 
        then add to the new degree*/
		var newDegree = degree*clicks;
		var extraDegree = Math.floor(Math.random() * 8) + 1;
		totalDegree = newDegree+extraDegree*45;
		
		/*let's make the spin btn to tilt every
		time the edge of the section hits 
		the indicator*/
        var function_call=false;
		$('#wheel .sec').each(function(){
			var t = $(this);
			var noY = 0;
			
			var c = 0;
			var n = 700;	
			var interval = setInterval(function () {
				c++;				  
				if (c === n) { 
					clearInterval(interval);
				}	

				var aoY = t.offset().top;
				$("#txt").html(aoY);
				//console.log(aoY);
                //console.log('this',position);
        
				
				/*23.7 is the minumum offset number that 
				each section can get, in a 30 angle degree.
				So, if the offset reaches 23.7, then we know
				that it has a 30 degree angle and therefore, 
				exactly aligned with the spin btn*/
				if(aoY <= 23.7){
					console.log('<<<<<<<<');
					$('.spinbtn').addClass('spin'); 
					setTimeout(function () { 
						$('.spinbtn').removeClass('spin');
					}, 100);	
				} 
    
                if(c == n) {
                    if(function_call == false) {
                        console.log('done');
                        console.log('ans',t.data('name'));
                        function_call=true;
                        getCounterData(aoY);
                
                    }
    
                }
			}, 10);
			
			$('#inner-wheel').css({
				'transform' : 'rotate(' + totalDegree + 'deg)'			
			});
			// $('#inner-wheel-1').css({
			// 	'transform' : 'rotate(-' + totalDegree + 'deg)'			
			// });
		 
			noY = t.offset().top;
			
		});

        


	});



	function setPosition() {
        position=[];
        position_name=[];
        position_left=[];
        console.log('reset');
	    $('.sec').each(function(){                 
            var pos = $(this).offset().top;
            var left_pos = $(this).offset().left;
            position_left.push(left_pos);
            position.push(pos);
            position_name.push($(this).data('name'));
            $(this).attr('data-position',pos);
        }); 
    }

    function setPosition1() {
        position1=[];
        position1_name=[];
        position1_left=[];
        console.log('reset');
	    $('.sec-1').each(function(){                 
            var pos1 = $(this).offset().top;
            var left_pos1 = $(this).offset().left;
            position1_left.push(left_pos1);
            position1.push(pos1);
            position1_name.push($(this).data('name'));
            $(this).attr('data-position',pos1);
        }); 
    }

    setPosition();
    setPosition1();

    //console.log(position); 
  
  
    function getCounterData(num) {
        setPosition(); 
        setPosition1();
        console.log("position",position,position_name);
        current = position[0];
        current_name = position_name[0];
        current1 = position1[0];
        current1_name = position1_name[0];
        console.log(current_name);
        console.log(current1_name);
        var $i=0;
        position = sortWithIndeces(position);
        posotion1 = sortWithIndeces(position1);
        console.log('wqewew',position,position.sortIndices,position[1],position.sortIndices[1]);
        console.log('wqewew1',position1,position1[1],position1.sortIndices[1]);       
        current_name=position_name[position.sortIndices[2]];
        current1_name = position1_name[position1.sortIndices[1]];
               //console.log('kk',current_name);  
        document.cookie = "position = "+position.sortIndices;        
        console.log(position_name)
        console.log(position_name[order[6]])
        console.log(position_name[order[7]])
        console.log(position_name[order[0]])
        console.log(position_name[order[1]])
        console.log($("#wheel div.sec:nth-child(1)").css("border-color"))
        //alert(current_name);
        //alert(current1_name); 
        setPosition();  
        setPosition1();
    }
	
});//DOCUMENT READY 


function sortWithIndeces(toSort) {
  for (var i = 0; i < toSort.length; i++) {
    toSort[i] = [toSort[i], i];
  }
  toSort.sort(function(left, right) {
    return left[0] < right[0] ? -1 : 1;
  });
  toSort.sortIndices = [];
  for (var j = 0; j < toSort.length; j++) {
    toSort.sortIndices.push(toSort[j][1]);
    toSort[j] = toSort[j][0];
  }
  return toSort;
}
	
