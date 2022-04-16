var op = null;

function equalTo() {
    var current = $("#cal-scr").val();
    if(op === "add") {
        op = "+";
        $("#cal-scr").val(Number($("#history-scr").val()) + Number($("#cal-scr").val()));
    }
    else if(op === "sub") {
        op = "-";
        $("#cal-scr").val(Number($("#history-scr").val()) - Number($("#cal-scr").val()));
    }
    else if(op === "multi") {
        op = "*";
        $("#cal-scr").val(Number($("#history-scr").val()) * Number($("#cal-scr").val()));
    }
    else if(op === "div") {
        op = "/";
        $("#cal-scr").val(Number($("#history-scr").val()) / Number($("#cal-scr").val()));
    }
    else if(op === "mod") {
        op = "%";
        $("#cal-scr").val(Number($("#history-scr").val()) % Number($("#cal-scr").val()));
    }

    $("#history-scr").val($("#history-scr").val() + op + current);
}

function numericKey(key){
    if($("#cal-scr").val() === "0") {
        $("#cal-scr").val(key);
    }
    else {
        if($("#cal-scr").val() === "-")
            $("#cal-scr").val((key * -1));
        else
            $("#cal-scr").val($("#cal-scr").val() + key);
    }
}

function changeAllBtnsProp(value) {
    $("button.calc-btns:not([value='clear'])").prop("disabled", value);
}

$(".calc-btns").click(function(){
    if($.isNumeric($(this).val())){
        numericKey($(this).val());
    }
    else {
        switch ($(this).val()) {
            case "add":
            case "sub": 
            case "multi":
            case "div":
            case "mod":
                if($("#cal-scr").val() === "0") {
                    if($(this).val() === "sub") {
                        $("#cal-scr").val("-");
                    } 
                    break;
                }
                op = $(this).val();
                $("#history-scr").val($("#cal-scr").val());
                $("#cal-scr").val("0");
                break;

            case "ans":
                equalTo();
                changeAllBtnsProp(true);
                break;

            case ".":
                if($("#cal-scr").val().indexOf(".") == -1) {
                    $("#cal-scr").val($("#cal-scr").val() + $(this).val());
                }
                break;

            case "root":
                $("#history-scr").val("√" + $("#cal-scr").val());
                $("#cal-scr").val(Math.sqrt(Number($("#cal-scr").val())));    
                changeAllBtnsProp(true);
                break;

            case "clear":
                changeAllBtnsProp(false);
                $("#history-scr").val("");
                $("#cal-scr").val("0");
                break;

            case "delete":
                $("#cal-scr").val($("#cal-scr").val().slice(0, $("#cal-scr").val().length - 1));
                if($("#cal-scr").val() === "")
                    $("#cal-scr").val("0");
                break;

            default: 
                break;    
        }
    }
});