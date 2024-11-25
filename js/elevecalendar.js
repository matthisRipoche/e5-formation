console.log("elevecalendar.js loaded");

document.addEventListener("DOMContentLoaded", function () {
    const calendarEl = document.getElementById("elevecalendar");
    if (!calendarEl) {
        return;
    }

    let cours = calendarEl.getAttribute("data-cours");
    let coursArray = JSON.parse(cours);

    // create events
    var events = [];
    coursArray.forEach((c) => {
        events.push({
            title: c.matiere_name,
            start: c.date + "T" + c.timestart,
            end: c.date + "T" + c.timeend,
        });
    });

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "timeGridWeek",
        slotMinTime: "08:30:00",
        slotMaxTime: "17:30:00",
        slotDuration: "01:00:00",
        slotLabelInterval: "01:00",
        locale: "fr",
        firstDay: 1,
        allDaySlot: false,
        hiddenDays: [0, 6],
        events: events,
    });
    calendar.render();
});
