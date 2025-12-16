var modo;
let togle = document.getElementById('togle');
//var id = document.getElementById('id-user').value;
var id = 67;
togle.addEventListener('change',(event)=>{
    let checked = event.target.checked;
    console.log(checked)
    if(checked){
        window.open('modo.php?id='+ id +'&valor='+ checked, '_self');
    }else{
        window.open('modo.php?id='+ id +'&valor='+ checked, '_self');
    }
})
