<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.4.8/p5.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.4.8/addons/p5.dom.js"></script>
</head>

<body>
    <button id="btn-submit">Submit</button>

</body>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.4.8/p5.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.4.8/addons/p5.dom.js"></script>
<script type="text/javascript">
    var text;		// variable for the text div you'll create
  var socket = new WebSocket("ws://localhost:8081");

  function setup() {
    // The socket connection needs two event listeners:
    socket.onopen = openSocket;
    socket.onmessage = showData;

    // make a new div and position it at 10, 10:
    text = createDiv("Sensor reading:");
    text.position(10,10);
  }

  function openSocket() {
    text.html("Socket open");
    socket.send("Hello server");
  }

  /*
  showData(), below, will get called whenever there is new Data
  from the server. So there's no need for a draw() function:
  */
  function showData(result) {
    // when the server returns, show the result in the div:
    text.html("Sensor reading:" + result.data);
    xPos = int(result.data);        // convert result to an integer
    text.position(xPos, 10);        // position the text

    var code = result.data.slice(5, 12);
    jQuery('#btn-submit').click(function(e){
        // console.log(result.data);
    e.preventDefault();
        console.log(code);

               jQuery.ajax({
                  url: "{{ route('demo') }}",
                  method: 'post',
                  data: {
                    _token: '{{csrf_token()}}',
                     card_id: code
                  },
                  success: function(result){
                     console.log(result);
                     window.location = result.url;
                  },
                  error : function(xhr, status, error){
                },
                  
                });
  });
}
</script>

</html>