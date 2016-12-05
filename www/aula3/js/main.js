function loadNotifications(){
    var tpsicinel = firebase.database().ref('tpsicinel');
/*    tpsicinel.on("value", function(snapshot) {
        console.log(snapshot.val().alunos);
    }, function (error) {
        console.log("Error: " + error.code);
    });
*/
    tpsicinel.on("child_added", function(data, prevChildKey) {
        var novoAluno = data.val();
        console.log(novoAluno);
        var dadosAluno = "Nome: " + novoAluno.nome + "\n";
        dadosAluno += " Morada: " + novoAluno.morada + "\n";
        dadosAluno += " Contacto: " + novoAluno.contacto;

        Notification.requestPermission(function (permission) {
            // If the user accepts, let's create a notification
            if (permission === "granted") {
                var opt = {
                        body : dadosAluno
                };
                var notification = new Notification("Novo Aluno", opt);
            }
        });
    });
};


$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

function go2Fire(){
debugger;
    var jsondata = $("form").serializeObject();

    var tpsicinel = firebase.database().ref('tpsicinel');

    var coisas = tpsicinel.push(jsondata);

        console.log(coisas);
}

function notifyMe() {
  // Let's check if the browser supports notifications
  if (!("Notification" in window)) {
    alert("This browser does not support desktop notification");
  }

  // Let's check whether notification permissions have alredy been granted
  else if (Notification.permission === "granted") {
    // If it's okay let's create a notification
    var notification = new Notification("Hi there!");
  }

  // Otherwise, we need to ask the user for permission
  else if (Notification.permission !== 'denied') {
    Notification.requestPermission(function (permission) {
      // If the user accepts, let's create a notification
      if (permission === "granted") {
        var notification = new Notification("Hi there!");
      }
    });
  }

  // At last, if the user has denied notifications, and you 
  // want to be respectful there is no need to bother them any more.
}

