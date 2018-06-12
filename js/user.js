$(document).ready(function()
{
    $("#loaduser").on("click", function()
    {
        var e = document.getElementById("userlist");
        var selectedUser = e.options[e.selectedIndex].value;
        post("user.php", {id: selectedUser});
    });

    document.getElementById("userlist").selectedIndex = document.getElementById("id").value - 1;
    document.getElementById("skillselect").selectedIndex = document.getElementById("skill").innerHTML;
});

function post(path, parameters) 
{
    var form = $('<form></form>');

    form.attr("method", "post");
    form.attr("action", path);

    $.each(parameters, function(key, value) 
    {
        var field = $('<input></input>');

        field.attr("type", "hidden");
        field.attr("name", key);
        field.attr("value", value);

        form.append(field);
    });

    $(document.body).append(form);
    form.submit();
}