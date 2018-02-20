function showdiv()
{
   var divID = $("#ddlOption option:selected").attr("data-div");
   divID = divID.replace(" ","");
   $("div[id$='" + divID+"']").show();
   $("div[id$='" + divID + "']").siblings().hide();
}