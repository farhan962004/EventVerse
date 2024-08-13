document.getElementById('loadMore').addEventListener('click', function() {
    var lastEvent = document.querySelector('.events-list .event-item:last-child');
    var lastEventId = lastEvent ? lastEvent.getAttribute('data-id') : 0;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/EventVersee/public_html/events/load_more_events.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            var newEvents = document.createElement('div');
            newEvents.innerHTML = xhr.responseText;
            document.querySelector('.events-list').appendChild(newEvents);
        }
    };
    xhr.send('lastEventId=' + lastEventId);
});
