const monthYearDisplay = document.getElementById("month-year");
const calendarDays = document.getElementById("calendar-days");
const prevMonthBtn = document.getElementById("prev-month");
const nextMonthBtn = document.getElementById("next-month");

let currentDate = new Date();

function renderCalendar() {
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();

    const firstDayOfMonth = new Date(year, month, 1).getDay();
    const lastDateOfMonth = new Date(year, month + 1, 0).getDate();

    // Clear previous days
    calendarDays.innerHTML = "";

    // Update the month-year display
    const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    monthYearDisplay.textContent = `${monthNames[month]} ${year}`;

    // Fill in empty days for previous month
    for (let i = 0; i < firstDayOfMonth; i++) {
        const emptyDiv = document.createElement("div");
        calendarDays.appendChild(emptyDiv);
    }

    // Add the days of the month
    for (let day = 1; day <= lastDateOfMonth; day++) {
        const dayDiv = document.createElement("div");
        dayDiv.textContent = day;

        // Highlight today's date
        if (day === new Date().getDate() && month === new Date().getMonth() && year === new Date().getFullYear()) {
            dayDiv.classList.add("today");
        }

        calendarDays.appendChild(dayDiv);
    }
}
// Navigation for next and previous months
prevMonthBtn.addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
});

nextMonthBtn.addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
});

// Initialize the calendar
renderCalendar();
