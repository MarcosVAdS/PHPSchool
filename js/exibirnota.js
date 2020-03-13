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
        let obj = JSON.parse(data);
        console.log(obj)
        for (var i = 0; i < obj.length; i++) {
            $('<tr><th scope="row">' + obj[i]['id_nota'] + '</th><td>' + obj[i]['aluno'] + '</td><td>' + obj[i]['disciplina'] + '</td><td>' + obj[i]['valornota'] + '</td></tr>').appendTo("#dados")
        }
      }
    });
    var pesquisa = function pesquisar(){
  
    }
});


/*
const pesquisa = function pesquisar(){
  var itemPesquisa = document.getElementById('itemPesquisa')
  //chamada ajax para enviar o que se quer do back
  $.ajax({
    url:'url para onde vai enviar os dados',
    type:'post',
    data = itemPesquisa,
    sucess: function (data) {
      if(data.error){
        console.log('nao foi possivel faze a pesquisa')
      }
      console.log(data)
    } 
  })
}
*/
