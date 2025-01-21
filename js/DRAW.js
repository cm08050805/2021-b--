export default class Draw {
    static STORE_DATA = "";
    
    constructor(data) {
        this.listDOM = document.querySelector("#listDOM");

        if(data) {
            Draw.STORE_DATA = data;
            this.draw()
        }
    }
    
        draw(list = Draw.STORE_DATA) {
            this.listDOM.innerHTML='';
    
            if(list.length==0) {
                this.listDOM.innerHTML=`
                    <tr>
                        <th colspan=4>일치하는 상품이 없습니다.</th>
                    </tr>
                `

            return;
        }

        list.forEach(store => {
            this.listDOM.innerHTML+=`
                <tr draggle="true" data-id="${store.id}">
                    <td><img src="./resources/${store.photo}" alt="" width="70" height="70"></td>
                    <td>${store.product_name}</td>
                    <td>${store.brand}</td>
                    <td>${store.price}</td>
                </tr>
            `
        });
    }
}