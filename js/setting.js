function showPass() 
    {
        const showPass = document.querySelector(".password-info")
        const hideAcc = document.querySelector(".public-info")
        showPass.style.diplay = "flex"
        hideAcc.style.display = "none"
    }
function showAcc() 
    {
        const hidePass = document.querySelector(".password-info")
        const showAcc = document.querySelector(".public-info")
        showAcc.style.diplay = "flex"
        hidePass.style.display = "none"
    }