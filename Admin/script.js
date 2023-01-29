/*let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");

sidebarBtn.onclick = function(){
    sidebar.classList.toggle("active");
}*/
document.getElementById("btn").onclick= function(){
    var x = document.getElementById("login_form");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }