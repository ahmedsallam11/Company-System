

function valText(eleName,locName,regx,regxmessa,min,max){
    var eleName = document.getElementById(eleName).value;       
    if (eleName.length ==0){
      showMessa(locName,"Required","red");}
else if (eleName.length <min){
     showMessa(locName,"Must be gtreater than "+min+" characters","red");   }
        else if(!eleName.match(regx)){
      showMessa(locName,regxmessa,"red");  
    }else if (eleName.length >max){
     showMessa(locName,"Must be less than "+max+" characters","red");  
    } else{showMessa(locName,"Valid","green");return true; }}

function valNumbers(eleName,locName){
   var eleName = document.getElementById(eleName).value;       
    if (eleName.length ==0){
      showMessa(locName,"Required","red");}
    else if (eleName.length <2){
     showMessa(locName,"Must be gtreater than 2 characters","red");  
   
    }else if (eleName.length >7){
     showMessa(locName,"Must be less than 7 characters","red");  
    }else if (eleName <0){
     showMessa(locName,"Must be positive value","red");  
    }else{showMessa(locName,"Valid","green"); return true; }    
}
function valMatch(eleName1,eleName2){
  var eleName1 = document.getElementById(eleName1).value;
  var eleName2 = document.getElementById(eleName2).value;
    if(eleName1 === eleName2){
        return true;
    }else{return false;}
}

function valfName(){
    valText("fName","fNameMessa",/^[a-zA-Z\s]*$/,"Must be letters!",2,20);}

function valLName(){
valText("lName","lNameMessa",/^[a-zA-Z\s]*$/,"Must be letters!",2,20);
}
function valsalary(){ 
valNumbers("salary","salaryMessa");
}
function valdep(){ 
valText("depName","depMessa",/^[a-zA-Z\s]*$/,"Must be letters!",2,25);
}
function valusername(){ 
valText("username","usernameMessa",/^[a-zA-Z0-9]+([-_\.][a-zA-Z0-9]+)*[a-zA-Z0-9]$/,"Only letters and numbers!",4,35);
}
function valemail(){ 
valText("email","emailMessa",/^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/,"Invalid!",6,100);
}
function valpassword(){ 
valText("password","passwordMessa",/^(?=.*[a-zA-Z])(?=.*[0-9])/,"Must contains letters and numbers!",6,100);
}
function valpassAgain(){ 
valid = valText("passAgain","passAgainMessa",/^(?=.*[a-zA-Z])(?=.*[0-9])/,"Must contains letters and numbers!",6,100);
if(valid){
  var matched = valMatch("password","passAgain");
 if(matched){showMessa("passAgainMessa","Matches Password","green");}
    else{showMessa("passAgainMessa","Password again doesn't match password!","red");}
}    
}
function showMessa(location,message,color){
    var messaLocation = document.getElementById(location);
messaLocation.innerHTML=message; 
messaLocation.style.color=color;    
}