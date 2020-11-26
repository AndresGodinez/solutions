<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Testing</title>
</head>
<body>
<button onclick="sendText()">Enviar datos</button>
<script>
    let exampleSocket = new WebSocket("ws://127.0.0.1:8001");
    function sendText(){
        let msg = {
            action:"imprimir",
            date: Date.now(),
            text: "texto informativo"

        };
        exampleSocket.send(JSON.stringify(msg))
    }
</script>
</body>
</html>
