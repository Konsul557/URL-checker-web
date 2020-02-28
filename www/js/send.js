console.log('=== Send start ===');
/**
 * Отправка результатов
 */
var buttonSend = document.getElementById('button-send');

buttonSend.addEventListener('click', function (event) {
    event.preventDefault();

    var formData = new FormData(document.forms.send);

    var send = 'api/send_url.php';
    var xhr = new XMLHttpRequest();

    xhr.open("POST", send);

    xhr.send(formData);
    xhr.onload = function() {
        console.log(xhr.response);
    }
/**
 * Обработка json
 */
    var ajax = new XMLHttpRequest();
    var json_data = '../api/json_data.php';
    ajax.open('GET', json_data, false);
    ajax.send();
    var json  = ajax.response;
    var ar_json = [];
    ar_json.push(json.split("}"))
    ar_json = ar_json[0]
    var ar_result = []
    for (var i = 0; i < ar_json.length; i++) {
      ar_json[i] += "}"
      ar_result.push(ar_json[i])
    }
    ar_json = []
    for (var i = 0; i <ar_result.length-1; i++) {
      ar_json.push(JSON.parse(ar_result[i]))
    }
/**
 * Отрисовка таблицы
 */
    var tb = new XMLHttpRequest();
    var ref = 'url_send.php';
    tb.open('GET', ref, false);
    tb.send();
    var body = document.getElementById('tb-result');
    for (var i = 0; i < ar_json.length; i++) {
      var row = document.createElement('tr');
      var td_id = document.createElement('td');
      var td_url = document.createElement('td');
      var td_date = document.createElement('td');
      var td_http = document.createElement('td');
      var td_time = document.createElement('td');
      td_id.appendChild(document.createTextNode(ar_json[i]['id']))
      td_url.appendChild(document.createTextNode(ar_json[i]['url']))
      td_date.appendChild(document.createTextNode(ar_json[i]['date_time']))
      td_http.appendChild(document.createTextNode(ar_json[i]['http_code']))
      td_time.appendChild(document.createTextNode(ar_json[i]['time']))
    }
    row.appendChild(td_id);
    row.appendChild(td_url);
    row.appendChild(td_date);
    row.appendChild(td_http);
    row.appendChild(td_time);
    body.appendChild(row)
    document.getElementById("url").value = "";
});