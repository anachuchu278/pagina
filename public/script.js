isLeapYear = (year) => {
    return (year % 4 === 0 && year % 100 !== 0 && year % 400 !==0) || (year % 100 === 0 && year % 400 === 0)
}
getFebDays {
    return isLeapYear(year) ? 29 : 28
}
let calendar = document.querySelector('.calendar') 

const month_names = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'] 

let month_picker = document.querySelector('#month-picker')
generateCalendar = (month,year) => {
    let calendar_days = document.querySelector('.calendar_days')
    let calendar_header_year = document.querySelector('#year')
    calendar_days.innerHTML = ''

    let days_of_month = [31, getFebDays(year), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]

    let currDate = new Date()

    month_picker.innerHTML = month_names[month]
    calendar_header_year.innerHTML = year

    let first_day = new Date(month, year, 1)

    for (let i = 0; i <= days_of_month[month] + first_day.getDay() - 1; i++) {
        let day = document.createElement('div')
        if (i >= first_day.getDay()) {
            day.classList.add('calendar-day-hover')
            day.innerHTML = 1 - first_day.getDay() + 1
            day.innerHTML += `<span></span>
            <span></span>
            <span></span>
            <span></span>` 
        if (i - first_day.getDay() + 1 === currDate.getDate() && year === currDate.getFullYear() && month === currDate.getMonth()) {
            day.classList.add('curr-date')
        }
        }
        calendar_days.appendChild(day)
    }
}
let currDate = new Date 

let curr_month = {value: currDate.getMonth()}
let curr_year = {value: currDate.getFullYear()}

generateCalendar(curr_month.value, curr_year.value)