function getUser(userId){
    var startdate = document.getElementById("startDate").value
    var enddate = document.getElementById("endDate").value
    var anchor=document.getElementById(userId);
    anchor.setAttribute("href","GetChecksData.php?startDate="+startdate+"&endDate="+enddate+"&user="+userId);
}
function go(userId){
    var startdate = document.getElementById("startDate").value
    var enddate = document.getElementById("endDate").value
    var anchor=document.getElementById("selectUser").value;
    window.location.href="GetChecksData.php?startDate="+startdate+"&endDate="+enddate+"&user="+anchor;
}

function getOrderData(orderId,data){
    var order=document.getElementById('O'+orderId);
    console.log(order)
    order.setAttribute("href","GetChecksData.php?order="+orderId+"&oldData="+data);
}
