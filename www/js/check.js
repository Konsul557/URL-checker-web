console.log('=== Check start ===');
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
//console.log(ar_json)

var tb = new XMLHttpRequest();
var ref = 'url_send.php';
tb.open('GET', ref, false);
tb.send();
var body = document.getElementById('tb-result');
var tr = document.getElementsByTagName('tr');
for (var j = 1; j <= tr.length-1; j++){
  for (var i = 0; i < ar_json.length; i++){
    if (ar_json[i]['http_code'] == 200 || ar_json[i]['time'] < 10) {
      var td = document.createElement('td');
      td.appendChild(document.createTextNode("OK"));
    } else {
      var td = document.createElement('td');
      td.appendChild(document.createTextNode("NO"));
    }
  }
  tr[j].appendChild(td);
}

