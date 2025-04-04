
export default class BucketItem
{
    constructor(item, parent, productDom, changeHandler) {
        this.item = item;
        this.dom = this.makeBucketItem(item);
        parent.appendChild(this.dom);

        this.input = this.dom.querySelector(".count");
        this.totalPriceDom = this.dom.querySelector(".total-price");
        this.addListener();

        this.count = 1;
        this.input.value = this.count;
        this.changeHandler = changeHandler;

        this.productDom = productDom;
        productDom.classList.add("off");
        productDom.draggable = false; //드래그 꺼줌.

        this.totalPrice = item.price * 1;
        this.updateUI();
    }

    addListener = () =>{
        this.dom.querySelector(".minus").addEventListener("click", this.removeCount);
        this.dom.querySelector(".plus").addEventListener("click", this.addCount);
    }

    addCount = () =>{
        this.count += 1;
        this.input.value = this.count;
        this.totalPrice += this.item.price;
        this.updateUI();
        this.changeHandler();
    }

    removeCount = () => {
        this.count -= 1;
        if(this.count <= 0) this.count =1;
        this.input.value = this.count;
        this.totalPrice -= this.item.price;
        this.updateUI();
        this.changeHandler();
    }

    updateUI = () =>{
        this.totalPriceDom.innerHTML = this.totalPrice.toLocaleString();
    }


    makeBucketItem = (item) => {
        const div = document.createElement("div");
        div.innerHTML = `<div class="order-product d-flex align-items-center border border-primary mb-2" draggable="true" id="order_${item.id}">
                    <img src="${item.image}" alt="" class="me-2" draggable="false">
                    <div class="info d-flex flex-column flex-grow-1">
                        <div class="text-row d-flex justify-content-between">
                            <div class="title">${item.title}</div>
                            <div class="price">${item.price.toLocaleString()}</div>
                            <div class="total-price"></div>
                        </div>
                        <div class="button-row d-flex justify-content-end">
                            <input class="form-control none-select count me-2" type="number" readonly value="1">
                            <button class="minus btn btn-sm btn-outline-primary me-2">-</button>
                            <button class="plus btn btn-sm btn-outline-primary me-2">+</button>
                        </div>
                    </div>
                </div>`;

        return div.firstElementChild;
    }
}