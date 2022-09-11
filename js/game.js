

var listValue = document.querySelectorAll(".me");
var arrImg = ["at_ko","b_bich","k_ko","c_zo","j_ko"];
var arrCheck = [];

Array.prototype.randomElement = function () {
    return this[Math.floor(Math.random() * this.length)]
}

// function random(arrImg) {
//     var a = arrImg[Math.floor(Math.random()*arrImg.length)];
//     return a;
// }

var check1 = false;

listValue.forEach(function(a){
    var random1 = "";
    a.onclick = function(){
        if(!this.classList.contains("open") && !check1){
            this.classList.toggle("up");
            random1 = arrImg.randomElement();
            arrCheck.push(random1);
            this.classList.add(random1);
            this.classList.add("open");
            // var a = arrCheck.filter((value, index, arr)=>value === arr[index]);
            console.log(random1);
        }
        var check = arrCheck.every(value => value === random1);
        if(!check){
            check1 = true;
            document.querySelector(".ketqua").innerHTML = "thua rồi. bấm vào đây để chơi lại!";
            // document.querySelector(".ketqua").classList
            document.querySelector(".ketqua").onclick = () => window.location.reload();
            // window.location.reload();
        }
    }
})