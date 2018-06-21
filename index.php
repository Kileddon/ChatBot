<html>
  <head>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <title>Chat</title>
  </head>
  <body>
      <label>Ask your question:</label>
      <br>
      <input id='command' type="text">
      <button id='submit' type="submit">Send</button>
    <div width=100% height=100% id=results></div>
    <script>
    $( "#submit" ).click(function () {
      let command = $( "#command" ).val();
      $( "#command" ).val('');
      $.ajax({
        url: "ajax.php?command=" + command,
      })
      .done(function( html ) {
        $( "#results" ).append( html );
      });
    });
    </script>
  </body>
</html>
