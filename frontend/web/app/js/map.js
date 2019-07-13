ymaps.ready(function () {
    var myMap = new ymaps.Map('map', {
            center: [55.749091, 37.555218],
            zoom: 16,
            controls: []
        }, {
            searchControlProvider: 'yandex#search'
        }),

        myPlacemark = new ymaps.Placemark([53.907477, 30.316820], {
            hintContent: 'Guruleads'
        }, {
            iconLayout: 'default#image',
            iconImageHref: 'https://mogilevcci.by/assets/templates/mogilevcci/img/logo.png',
            iconImageSize: [71, 82],
            iconImageOffset: [-35, -82]
        });


    myMap.geoObjects.add(myPlacemark);

    if ($(window).width() > 650) {
        mapCenter = [53.907477, 30.316820];
    } else {
        mapCenter = [53.907477, 30.316820];
    }

    myMap.setCenter(mapCenter);
    myMap.behaviors.disable('scrollZoom');
    $(window).resize(function () {
        if ($(window).width() > 650) {
            myMap.setCenter([53.907477, 30.316820]);
        } else {
            myMap.setCenter([53.907477, 30.316820]);
        }
    });
});