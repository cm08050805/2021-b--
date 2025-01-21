let alreadydraw = false;
const shoppingbag_list = [];
let purchase=0;

async function jasontolist() {
    let jsonData = null;
    try {
        const response = await fetch('./store.json');
        jsonData = await response.json();
        if (!alreadydraw) {
            draw_al(jsonData);  
            draw_sb();
            alreadydraw = true;
        }
        addEvent(jsonData);
    } catch (error) {
        console.error('Error loading JSON:', error);
    }
}

function draw_al(data) {                                                                    
    const list = document.querySelector(".all_list");
    list.innerHTML = '';

    if (data.length === 0) {
        list.innerHTML = `<h1 id="nothing">일치하는 상품이 없습니다.</h1>`; 
    } else { 
        data.forEach(staff => {
            list.innerHTML += `
            <div class="item" draggable="true">
                <img class="img" src="./상품사진/${staff['photo']}" width="100px" height="100px">
                <div class="textbox">
                    <h1 class="name">${staff['product_name']}</h1>
                    <h4 class="brand">${staff['brand']}</h4>
                </div>
                <h1 class="price">${staff['price']}원</h1>
            </div>
            `;
        });
    }   
}

function draw_sb() {
    const shoppingList = document.querySelector(".shopping_list");
    shoppingList.innerHTML = '';
    const paying = document.querySelector(".paying_region");
    paying.innerHTML = '';

    purchase=0;
    shoppingbag_list.forEach(function(staff) {
        if (typeof staff.price === "string")    {
            staff.price = Number(staff.price.replace(/,/g, ""));
        }
        staff.real_price = staff.cnt * staff.price;
        purchase += staff.real_price;
    });
    

    paying.innerHTML += `
        <button class="purchase_btn">구매하기</button>
        <h1>합계</h1>
        <h1 class="howmuch">${purchase}원</h1>
    `

    if (shoppingbag_list.length === 0) {
        shoppingList.innerHTML = '<h1 id="empty">장바구니가 비어있습니다.</h1>';
    } else {
        shoppingbag_list.forEach((item, index) => {
            shoppingList.innerHTML += `
            <div class="item">
                <img src="./상품사진/${item.photo}" width="100px" height="100px">
                <div class="textbox">
                    <h1 class="name">${item.product_name}</h1>
                    <h4 class="brand">${item.brand}</h4>
                </div>
                <h1 class="price">${item.real_price}원</h1>
                <button class="minus" data-index="${index}">-</button>
                <h5 class="cnt">${item.cnt}</h5>
                <button class="plus" data-index="${index}">+</button>
                <button class="remove" data-index="${index}">삭제</button>
            </div>
            `;
        });
    }
}

function addEvent(data) {
    document.querySelector("#search").addEventListener("input", function () { search(data); });

    document.querySelector(".shopping_list").addEventListener("click", function (e) {
        const index = e.target.getAttribute("data-index");

        if (e.target.classList.contains("plus")) {
            shoppingbag_list[index].cnt += 1;
            draw_sb();
        } else if (e.target.classList.contains("minus")) {
            if (shoppingbag_list[index].cnt > 1) shoppingbag_list[index].cnt -= 1;
            draw_sb();
        } else if (e.target.classList.contains("remove")) {
            shoppingbag_list.splice(index, 1);
            draw_sb();
        }
    });
    const modal = document.querySelector('.modal');
    const openbtn = document.querySelector('.purchase_btn');
    const completebtn = document.querySelector('.complete');
    const canclebtn = document.querySelector('.cancle')
    
    openbtn.addEventListener("click", () => {
        if (shoppingbag_list.length===0){
            alert("장바구니가 비었습니다")
        } else{
            modal.style.display = 'flex';
        }  
    });
    completebtn.addEventListener("click", () => {
        modal.style.display = 'none';
    });
    canclebtn.addEventListener("click", () => {
        modal.style.display = 'none';
    });    
    
}

function search(data) {
    const name = document.querySelector("#search").value.toLowerCase();
    const cho = hanguel(name);
    if (!data) return;

    let filterData;

    if (cho === name) {
        filterData = data.filter(staff => 
            hanguel(staff['product_name'].toLowerCase()).includes(cho)
        );
        console.log(filterData);
        filterData.forEach(e => {
            console.log(hanguel(e.product_name));
            const cho_pn = hanguel(e.product_name);
            for (let i=0; i<cho_pn.length; i++){
                if(cho_pn[i]=== cho[0]){
                    e.product_name= e.product_name.replace(e.product_name[i], `<span class="highlight">${e.product_name[i]}</span>`);
                    e.product_name = e.product_name.replace(e.product_name[i + cho.length ], `${e.product_name[i + cho.length - 1]}</span>`);
                    console.log(e.product_name);
                }
            }
        });
        
    } else {
        filterData = data.filter(staff => 
            staff['product_name'].toLowerCase().includes(name)
        );
        filterData.forEach(e => {
            e.product_name=e.product_name.replace(name, `<span class="highlight">${name}</span>`)
        });
    }

    draw_al(filterData.length === 0 ? []: filterData);
}

function hanguel(str) {
    let cho = ['ㄱ','ㄲ','ㄴ','ㄷ','ㄸ','ㄹ','ㅁ','ㅂ','ㅃ','ㅅ','ㅆ','ㅇ','ㅈ','ㅉ','ㅊ','ㅋ','ㅌ','ㅍ','ㅎ'];
    let result = [];
    for (let i in str) {
        let char = str.substr(i, 1);
        let index = (char.charCodeAt() - 44032) / 588
        result.push(cho[index] || char);
    }   
    return result.join(''); 
}

const dropContainer = document.querySelector(".drop");

dropContainer.addEventListener("dragover", (e) => {
    e.preventDefault();
});

dropContainer.addEventListener("drop", (e) => {
    e.preventDefault();
    const productData = e.dataTransfer.getData("text/plain");
    const product = JSON.parse(productData);

    const existingProduct = shoppingbag_list.find(item => item.product_name === product.product_name);
    if (existingProduct) {
        alert("이미 장바구니에 담긴 상품입니다.");
    } else {
        product.cnt = 1;
        shoppingbag_list.push(product);
    }

    draw_sb();
});

document.addEventListener("dragstart", (e) => {
    if (e.target.classList.contains("item")) {
        const productData = {
            product_name: e.target.querySelector(".name").textContent,
            price: e.target.querySelector(".price").textContent.replace('원', ''),
            brand: e.target.querySelector(".brand").textContent,
            photo: e.target.querySelector("img").src.split('/').pop()
        };
        e.dataTransfer.setData("text/plain", JSON.stringify(productData));
    }
});

jasontolist();