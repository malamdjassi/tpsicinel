<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="js/main.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <form class="form-inline">
              <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
              </div>
              <div class="form-group">
                <label for="morada">Vota&ccedil;&otilde;es</label>
                <input type="text" class="form-control" id="votacao" name="votacao" placeholder="Nr Votos">
              </div>
            </form>
              <button class="btn btn-default" onclick="go2Fire()" >Submeter</button>
       </div>
        <script src="https://www.gstatic.com/firebasejs/3.6.2/firebase.js"></script>
        <script>
          // Initialize Firebase
          var config = {
            apiKey: "AIzaSyBFAaxwyvqsCKEOCcSHzkSYC04JIw6wRPE",
            authDomain: "sondagensmundial.firebaseapp.com",
            databaseURL: "https://sondagensmundial.firebaseio.com",
            storageBucket: "sondagensmundial.appspot.com",
            messagingSenderId: "751997788183"
          };
          firebase.initializeApp(config);
        </script>
    </body>
    </html>
