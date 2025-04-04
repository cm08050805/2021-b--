import BucketItem from "/js/BucketItem.js"
class ProductApp
{
    constructor(categories, products) {
        this.categories = categories;
        this.products = products;

        this.productSection = document.querySelector("#productSection");
        this.orderSection = document.querySelector("#orderSection");

        this.priceInfo = document.querySelector("#priceInfo");
        //아이템들을 카테고리별로 정렬시킴.
        this.categoryItem = products.reduce((sum, item) => ({...sum, [item.category] : [...(sum[item.category] || []), item] }), {});

        this.initialize();
        this.addDragEvent();
        this.bucketItems = [];
    }

    //각 카테고리별로 만들어진 것을 템플릿생성기로 생성해서 넣어준다.
    initialize = () =>
        this.productSection.innerHTML = Object.keys(this.categoryItem).reduce( (totalHtml, cat) =>
            totalHtml + this.makeCategory( cat, this.categoryItem[cat].reduce( (html, item) => html + this.makeTemplate(item), "")), "");

    addDragEvent = () => {
        //주문영역으로 넣어주기
        this.productSection.addEventListener("dragstart", evt => {
            if(evt.target.classList.contains("product"))
            {
                evt.dataTransfer.setData("text/plain", evt.target.id);
            }
        });

        this.orderSection.addEventListener("dragover", evt => {
            evt.preventDefault();
        });

        this.orderSection.addEventListener("drop", evt =>{
            evt.preventDefault();
            evt.stopPropagation();
            const targetId = evt.dataTransfer.getData("text/plain");
            const targetElem = document.getElementById(targetId);

            if(targetElem == null || !targetElem.classList.contains("product"))
                return;
            let id = targetId.split("_")[1] * 1;
            let targetItem = this.products.find(x => x.id === id);
            if(targetItem == null) return;

            this.bucketItems.push(new BucketItem(targetItem, this.orderSection, targetElem, this.reDrawMoney));
            this.reDrawMoney();
        });


        //주문영역에서 빼주기
        this.orderSection.addEventListener("dragstart", evt => {
            if(evt.target.classList.contains("order-product"))
            {
                evt.dataTransfer.setData("text/plain", evt.target.id)
            }
        })

        const modal = document.querySelector(".modal-background");
        modal.addEventListener("dragover", evt => evt.preventDefault());
        modal.addEventListener("drop", evt => {
            //밖으로 뺀 녀석들 없애주면 된다.
            evt.preventDefault();
            evt.stopPropagation();
            const targetId = evt.dataTransfer.getData("text/plain");

            let productId =  targetId.split("_")[1] * 1;
            let targetItemIdx = this.bucketItems.findIndex(x => x.item.id === productId);

            if(targetItemIdx < 0) return;

            this.bucketItems[targetItemIdx].dom.remove();
            this.bucketItems[targetItemIdx].productDom.draggable =true;
            this.bucketItems[targetItemIdx].productDom.classList.remove("off");
            this.bucketItems.splice(targetItemIdx, 1);

            this.reDrawMoney();
        });
    }

    reDrawMoney = () =>{
        let totalPrice = this.bucketItems.map(x => x.totalPrice).reduce((sum, price) => sum + price, 0);
        this.priceInfo.innerHTML = totalPrice.toLocaleString();
    }

    makeTemplate = (item) =>
        `<div class="card product" draggable="true" id="product_${item.id}">
            <img src="${item.image}" class="card-img-top" draggable="false">
            <div class="card-body">
                <h5 class="card-title fs-6">${item.title}</h5>
                <p class="card-text fs-6">
                    ${item.price.toLocaleString()}
                </p>
            </div>
        </div>`;

    makeCategory = (title, items) =>
        `<div class="category-header none-select">
            ${categories[title]}
        </div>
        <div class="products mb-3 none-select">
            ${items}
        </div>`;
}



let app = new ProductApp(categories, products);

document.querySelector("#nonMemberOrder").addEventListener("click", ()=>{
   document.querySelector(".modal-background").classList.add("on");
});