$("#cadastronota").submit(function(){
    var data = $(this).serializeArray();
    console.log(data)
    $.ajax({
        url: '/php/forms/new_nota.php',
        type: 'post',
        data: data,
        success: function(result){
            if(result.success == true){
              alert("funcionou");
            }
            else{
                alert(result.error);
            }
        }
    });
});