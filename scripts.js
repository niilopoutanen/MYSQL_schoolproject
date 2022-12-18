function MoveParamsToNew(query, newlink){
    window.location.href = newlink + query;
}

function TogglePopup(){
    var popup = document.getElementById("popup");
    var popupBG = document.getElementById("popup_bg");
    if(popupBG.style.display == "block"){
        popup.style.display = "none";
        popupBG.style.display = "none";
    }
    else if(popupBG.style.display == "none"){
        popup.style.display = "flex";
        popupBG.style.display = "block";
    }
}