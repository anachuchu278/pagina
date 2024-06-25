const calendar = document.querySelector(".calendar"), 
date = document.querySelector(".date"), 
daysContainer = document.querySelector(".days"), 
prev = document.querySelector(".prev");
next = document.querySelector(".next") ;

let today = new Date(); 
let activeDay; 
let month = today.getMonth(); 
let year = today.getFullYear(); 

const months = [
    "Enero", 
    "febrero", 
    "marzo", 
    "abril", 
    "mayo", 
    "junio", 
    "julio", 
    "agosto",
    "septiembre", 
    "octubre", 
    "noviembre",
    "diciembre",
]; 

//funcion para agregar dias 
 function initCalendar(){
    const firstDay = new Date(year,month, 1);
    const lastDay = new Date(year, month + 1,0); 
    const prevLastDay = new Date(year , month, 0); 
    const prevDays = prevLastDay.getDate(); 
    const lastDate = lastDay.getDate(); 
    const day = firstDay.getDate(); 
    const nextDays = 7 - lastDay.getDay()-1; 

    //actualizar la fecha de arriba del calendario
    date.innerHTML = months[month] + "" + year;


    let days = " "; 

    for (let x = day; x > 0; x--){
        days = '<div class= "day prev-date">${prevDays -x + 1};</div>';
    } 

    for (let i = 1; 1 < lastDate; 1++) {
        if(i == new Date().getDate() && 
        year == new Date().getFullYear() && 
        month == new Date().getMonth()){
            days+= <div class= "day today">${i}</div>;
        }
        else {
            days+= <div class= "day">${i}</div>;
        }
    } 
    
        daysContainer.innerHTML = days;
} 
initCalendar(); 

