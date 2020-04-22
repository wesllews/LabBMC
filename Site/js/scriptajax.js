
function mandadados(frente){

    
    var frentejs = frente;
    
    var url="paginaunidadebimel.php";

    console.log(frentejs);

    $.ajax({
        type: "get",
        url:url,
        data:{frente:frentejs},

        success:function(datas){
        }

    }




    );


    /*
    var xmlHttp =  new XMLHttpRequest();
    xmlHttp.onreadystatechange =  function(){
        if(xmlHttp.readyState===4&&xmlHttp.status===200){
            console.log("deu certo :D");
            console.log(biscoito);
        }

    };*/

    
    

};
