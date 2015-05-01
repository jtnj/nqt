$(function() {
    var timezone = 7.0;

    function getWDay(dNum) {
        switch (dNum) {
            case 1:
                return "Thứ Hai";
                break;
            case 2:
                return "Thứ Ba";
                break;
            case 3:
                return "Thứ Tư";
                break;
            case 4:
                return "Thứ Năm";
                break;
            case 5:
                return "Thứ Sáu";
                break;
            case 6:
                return "Thứ Bảy";
                break;
            case 0:
                return "Chủ Nhật";
                break;
            default:
                break;
        }
    }

    function convertDates() {
        var cYear = parseInt($('#cYear').val());
        $('.event').each(function() {
            var lMonth = parseInt($(this).find('.lDate').text().split("/")[1]);
            var lDay = parseInt($(this).find('.lDate').text().split("/")[0]);
            var solarDate = convertLunar2Solar(lDay, lMonth, cYear, 0, timezone);
            $(this).find('.wDate').text(solarDate[0] + " / " + solarDate[1] + " / " + solarDate[2]);
            $(this).find('.wDay').text(getWDay(new Date(solarDate[2], solarDate[1] - 1, solarDate[0]).getDay()));
        });
        $('.print .cYear').val($('#cYear').val());
    };

    convertDates();
    $('#cYear').change(function() {
        convertDates();
        $('.print .cYear').val($(this).val());
    });
});