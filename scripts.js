function MoveParamsToNew(query, newlink){
    var toTransfer = newlink + query;
    window.location.href = toTransfer;
}

function TogglePopup(){
    var popup = document.getElementById("popup");
    var popupBG = document.getElementById("popup_bg");
    console.log(popup.style.display);
    if(popup.style.display == "block"){
        popup.style.display = "none";
        popupBG.style.display = "none";
    }
    else if(popup.style.display == "none"){
        popup.style.display = "block";
        popupBG.style.display = "block";
    }
}