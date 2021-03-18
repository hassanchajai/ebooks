const txt_author = document.querySelector("input#search");
//trigger the event when text changed
txt_author.addEventListener("input", e => {
    const items = document.querySelectorAll(".item-title");
    items.forEach(item => {
        if (item.textContent.toString().includes(txt_author.value)) {
            item.parentElement.parentElement.parentElement.style.display = "block";
        } else {
            item.parentElement.parentElement.parentElement.style.display = "none";
        }
    });
});
// price
function trait(item, a) {
    if (a) {
        item.parentElement.parentElement.parentElement.parentElement.style.display = "block";
    } else {
        item.parentElement.parentElement.parentElement.parentElement.style.display = "none";
    }
}

function filterPrice() {

    const min = document.querySelector("input#min").value;
    const max = document.querySelector("input#max").value;
    const items = document.querySelectorAll(".details .price");

    items.forEach(item => {
        if (min === "") {
            let cond = Number(max) > Number(item.textContent);
            trait(item, cond);
        } else if (max === "") {
            let cond = Number(min) < Number(item.textContent);
            trait(item, cond);
        } else {
            let cond = Number(min) < Number(item.textContent) && Number(max) > Number(item.textContent);
            trait(item, cond);
        }

    });
}

min.addEventListener("input", filterPrice);
max.addEventListener("input", filterPrice);