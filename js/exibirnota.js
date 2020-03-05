$(document).ready(function () {
    $.ajax({
      url: '../php/index.php',
      type: 'get',
      success: function (data) {
        if (data.error) {
          console.log(data.error);
          return "nao funcionou";
        }
        console.log(data)
        const obj = data;
        for (var i = 0; i < obj.length; i++) {
            $('<tr><th scope="row">' + obj[i]['id_nota'] + '</th><td>' + obj[i]['aluno'] + '</td><td>' + obj[i]['disciplina'] + '</td><td>' + obj[i]['valornota'] + '</td></tr>').appendTo("#dados")
        }
      }
    });
});