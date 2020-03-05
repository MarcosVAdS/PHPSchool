$("#cadastronota").submit(function(){
    var data = $(this).serializeArray();
    console.log(data);
    $.ajax({
        url: '../php/forms/new_nota.php',
        type: 'post',
        data: data,
        sucess: console.log("work!"),
    });
});