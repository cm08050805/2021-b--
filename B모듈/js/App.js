import Draw from "./DRAW.js";
import Search from "./Search.js";

class App {
    constructor() {
        this.init();
    }

    async init() {
        const STORE_DATA = await $.getJSON("./store.json")
        
        new Search(STORE_DATA);
    }
}

new App();