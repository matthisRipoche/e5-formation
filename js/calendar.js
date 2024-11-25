document.addEventListener("DOMContentLoaded", function () {
    var calendarEl = document.getElementById("calendar");
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
    });
    calendar.render();
});

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("select-class-calendar");
    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const classId = document.getElementById("classe").value;
        console.log(classId);

        // do post ajax with selected classe
        fetch("include/calendar.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ classId }),
        })
            .then((response) => response.json())
            .then((data) => {
                console.log(data.cour);
                // clear calendar
                var calendarEl = document.getElementById("calendar");
                calendarEl.innerHTML = "";

                // create events
                var events = [];
                data.cour.forEach((cour) => {
                    events.push({
                        title: cour.matiere_name,
                        start: cour.date + "T" + cour.timestart,
                        end: cour.date + "T" + cour.timeend,
                    });
                });

                // create new calendar
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
            })
            .catch((error) => {
                console.error("Erreur lors de l'envoi :", error);
            });
    });
});
