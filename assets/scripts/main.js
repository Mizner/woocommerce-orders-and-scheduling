jQuery(document).ready(function ($) {
    var valueUp = $(".spinner .btn:first-of-type"),
        valueDown = $(".spinner .btn:last-of-type"),
        valueInput = $(".spinner input"),
        sessions = $("#sessions"),
        orderButton = document.getElementById("newOrderButton"),
        hours = $("#hours"),
        sessionsDOM = document.getElementById("sessions"),
        sessionsValue = sessionsDOM.value,
        hoursDOM = document.getElementById("hours"),
        hoursValue = hoursDOM.value,
        totalDOM = document.getElementById("total");



    var sessionLength = .25; // mins

    var sessionsAmount = hoursValue / sessionLength;
   console.log(sessionsAmount);


    valueUp.on("click", function () {
        console.log(hoursValue + "is the old amount");
        hoursValue = +hoursValue + +sessionLength;
        hoursDOM.value = hoursValue;
        console.log(hoursValue + " is the new amount");
        sessionsDOM.value = +hoursValue / .25;
        totalDOM.value = sessionsDOM.value * 20;
        checkSessionValue();
    }).trigger("change");
    valueDown.on("click", function () {
        console.log(hoursValue + "is the old amount");
        hoursValue = +hoursValue - +sessionLength;
        hoursDOM.value = hoursValue;
        console.log(hoursValue + " is the new amount");
        sessionsDOM.value = +hoursValue / .25;
        totalDOM.value = sessionsDOM.value * 20;
        checkSessionValue();
    }).trigger("change");


    // valueUp.on("click", function () {
    //     valueInput.val(parseFloat(valueInput.val(), 10) + .25).trigger("change");
    // });
    // valueDown.on("click", function () {
    //     valueInput.val(parseFloat(valueInput.val(), 10) - .25).trigger("change");
    // });
    // Date Time Picker
    $(function () {
        $("#datetimepicker1").datetimepicker();
    });


    // #newOrder session check (can not be below 8)
    $("#session").attr("value", "7");

    function checkSessionValue() {
        console.log(sessionsDOM.value);
        if (sessionsDOM.value < 8) {
            console.log(sessionsAmount + "too little");
            orderButton.disabled = true;
            sessionsDOM.style.color = "red";
            totalDOM.style.color = "red";
        }
        else {
            console.log(sessionsDOM.value + "it's enough to get started");
            orderButton.disabled = false;
            sessionsDOM.style.color = "black";
            totalDOM.style.color = "black";
        }
    }

    hours.change(function () {
        checkSessionValue();
    });
    hours.bind("input", function () {
        checkSessionValue();
    });
});
