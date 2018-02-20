  function choose()
  {
   var divID = $("#clusterOption option:selected").attr("data-div");
   //divID = divID.replace(" ","");
   $("div[id$='" + divID+"']").show();
   $("div[id$='" + divID + "']").siblings().hide();
 }