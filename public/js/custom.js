
$(document).on("keyup",".form-control",function(){
    var keyword = $(this).val();
    if(keyword.length > 0)
    {
        $(this).removeClass("is-invalid");
    }
});