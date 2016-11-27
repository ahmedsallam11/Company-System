function valText(eleName,locName){
    var eleName = document.getElementById(eleName).value;       
    if (eleName.length ==0){
      showMessa(locName,"Required","red");}
    else if(!eleName.match(/^[a-zA-Z\s]*$/)){
      showMessa(locName,"Must be letters","red");  
    }else if (eleName.length <2){
     showMessa(locName,"Must be gtreater than 2 characters","red");  
   
    }else if (eleName.length >20){
     showMessa(locName,"Must be less than 20 characters","red");  
    } else{showMessa(locName,"Valid","green");}}

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
    }else{showMessa(locName,"Valid","green");}    
}

function valfName(){
    valText("fName","fNameMessa");
// var rules ={};
//    rules['fName'] = ['required','min','2','max','20','letters',true];
//   
//   for (i=0; i<rules.fName.length;i++){
//       switch(rules.fName[i]){
//            case "required":
//          if (fName.length ==0){
//           showMessa("fNameMessa","Required","red"); } break;
//           case "min":
//          if (fName.length <rules.fName[i+1]){
//           showMessa("fNameMessa","Must be greater than +rules.fName[i+1]","red"); } break; 
//       
//       }}
}

function valLName(){
valText("lName","lNameMessa");
}
function valsalary(){ 
valNumbers("salary","salaryMessa");
}
function valdep(){ 
valText("depName","depMessa");
}
function showMessa(location,message,color){
    var messaLocation = document.getElementById(location);
messaLocation.innerHTML=message; 
messaLocation.style.color=color;    
}