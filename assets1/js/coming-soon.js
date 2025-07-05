
function updateTimer() {
    future = Date.parse("Dec 19, 2023 11:30:00");
    now = new Date();
    diff = future - now;

    days = Math.floor(diff / (1000 * 60 * 60 * 24));
    hours = Math.floor(diff / (1000 * 60 * 60));
    mins = Math.floor(diff / (1000 * 60));
    secs = Math.floor(diff / 1000);

    d = days;
    h = hours - days * 24;
    m = mins - hours * 60;
    s = secs - mins * 60;

    document.getElementById("timer")
        .innerHTML =
        '<div class="col-xxl-3 col-xl-6 col-lg-6 col-md-3 col-sm-3 col-6"><div class="p-3 coming-soon-time rounded"><p class="mb-1 text-fixed-white fs-12">DAYS</p><h4 class="fw-semibold text-fixed-white mb-0">' + d + '</h4></div></div>' +
        '<div class="col-xxl-3 col-xl-6 col-lg-6 col-md-3 col-sm-3 col-6"><div class="p-3 coming-soon-time rounded"><p class="mb-1 text-fixed-white fs-12">HOURS</p><h4 class="fw-semibold text-fixed-white mb-0">' + h + '</h4></div></div>' +
        '<div class="col-xxl-3 col-xl-6 col-lg-6 col-md-3 col-sm-3 col-6"><div class="p-3 coming-soon-time rounded"><p class="mb-1 text-fixed-white fs-12">MINUTES</p><h4 class="fw-semibold text-fixed-white mb-0">' + m + '</h4></div></div>' +
        '<div class="col-xxl-3 col-xl-6 col-lg-6 col-md-3 col-sm-3 col-6"><div class="p-3 coming-soon-time rounded"><p class="mb-1 text-fixed-white  fs-12">SECONDS</p><h4 class="fw-semibold text-fixed-white mb-0">' + s + '</h4></div></div>'
}
setInterval('updateTimer()', 1000);