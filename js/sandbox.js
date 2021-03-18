console.log("%cAlrights Reserved 2021", "color:orange");

// edit
const btn_edit = document.querySelectorAll(" .edit");

btn_edit.forEach(element => {
    element.addEventListener("click", e => {
        console.log(e);
        if (e.target.tagName == "I") {
            e.target.nextElementSibling.style.display = "block";
        }





    })
})