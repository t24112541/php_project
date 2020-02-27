var idleTime = 0;
$(document).ready(function () {
    var idleInterval = setInterval(timerIncrement, 60000); // 60 s  1000= 1 s
    $(this).mousemove(function (e) {
        idleTime = 0;
    });
    $(this).keypress(function (e) {
        idleTime = 0;
    });
    console.log("idleInterval "+idleInterval);
});
console.log("idleTime");
function timerIncrement() {
    idleTime++;
    console.log("idleTime "+idleTime);
    if (idleTime > 15) { // 15 min
        window.location.reload();
    }
}