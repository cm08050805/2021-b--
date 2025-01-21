import Draw from "./DRAW.js";

export default class Search {
    constructor(data) {
        this.STORE_DATA = data;
        this.DRAW = new Draw(data);

        this.searchInput = document.querySelector("#search-input");
        this.addEvent();
    }
    addEvent() {
        const SEARCH = this.searchInput.addEventListener("input", this.search.bind(this))
    }

    search() {
        const SEARCH = this.searchInput.value;

        const FILTER_DATA = this.STORE_DATA.filter(store=>
            store.product_name.includes(SEARCH)||
            this.hanguel(store.product_name).includes(SEARCH)
        );

        this.DRAW.draw(FILTER_DATA);

    }

    hanguel(str) {
        let cho = ['ㄱ','ㄲ','ㄴ','ㄷ','ㄸ','ㄹ','ㅁ','ㅂ','ㅃ','ㅅ','ㅆ','ㅇ','ㅈ','ㅉ','ㅊ','ㅋ','ㅌ','ㅍ','ㅎ'];
        let result = [];
        for (let i in str) {

            let char = str.substr(i, 1);
            let index = Math.floor((char.charCodeAt() - 44032) / 588)

            result.push(cho[index] || char);
        }

        return result.join('');
    }
}