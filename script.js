$(document).ready(function(){
    $(".event-btn").on("change",function(){
        $id = $(this).attr("id");
        console.log($id);
        if($(this).parent().hasClass("off")){
            $on = 0;
        }else{
            $on = 1;
        }
        console.log($on);
        $.ajax({
            url : 'admin/includes/event-on-off.inc.php',
            type : 'GET',
            data : {active: $on,id:$id},
            dataType : 'html'
            });
    })
});