if (!window.WebSocket){
    alert("Ваш браузер неподдерживает веб-сокеты!");
}

var webSocket = new WebSocket("ws://front.task.local:8080?channel=" + channel);

document.getElementById("chat_form")
    .addEventListener('submit', function(event){
        var data = {
          message: this.message.value,
          channel: this.channel.value,
          user_id: this.user_id.value,
        };
        webSocket.send(JSON.stringify(data));
        event.preventDefault();
        return false;
    });

webSocket.onmessage = function (event) {
  /*
  var params = window
    .location
    .search
    .replace('?','')
    .split('&')
    .reduce(
      function(p,e){
        var a = e.split('=');
        p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
        return p;
      },
      {}
    );

  console.log( params['id']);

  console.log(webSocket);
  */
    var data = event.data;
    var messageContainer = document.createElement('div');
    var textNode = document.createTextNode(data);
    messageContainer.appendChild(textNode);
    document.getElementById("root_chat")
        .appendChild(messageContainer);



};