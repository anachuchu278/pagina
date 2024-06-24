const calendar = document.querySelector(".calendar"), 
date = document.querySelector(".date"), 
daysContainer = document.querySelector(".days"), 
prev = document.querySelector(".prev");
next = document.querySelector(".next") ;

let today = new Date(); 
let activeDay; 
let month = today.getFullMonth(); 
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

 }
