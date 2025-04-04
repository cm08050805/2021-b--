class NoticeApp
{
    constructor() {
        this.pagination = document.querySelector("#pagination");
        this.tbody = document.querySelector("#tableBody");
        this.tbody.innerHTML = ""; //테이블 클리어
        this.page = 1;
        this.totalPage = 0;

        //이 2개의 값을 localstorage화 시키면 저장도 가능
        this.order = "DESC";
        this.filter = "All"

        this.originalList = [];
        this.dataList = [];
        this.currentPageData = [];
        this.loadData();

        this.addEvents();
    }

    addEvents = () =>{
        this.pagination.addEventListener("click", evt => {
            if(evt.target.classList.contains("page-link"))
            {
                this.page = evt.target.dataset.page * 1;
                this.calcPages();
            }
        });
        document.querySelector(".order-container").addEventListener("click", evt=>{
            if(evt.target.dataset.order === undefined) return;

            this.order = evt.target.dataset.order;
            this.remakeList();
        });

        document.querySelector(".filter-container").addEventListener("click", evt => {
            if(evt.target.dataset.filter === undefined) return;

            this.filter = evt.target.dataset.filter;
            this.remakeList();
        });
    }

    loadData = async () => {
        const res = await fetch("/notices");
        const json = await res.json();
        this.dataList = this.originalList = json.notices;
        this.calcPages();
    };

    remakeList = () =>{

        if(this.filter !== "All")
            this.dataList = this.originalList.filter(x => x.category === (this.filter === "Normal" ? "일반" : "이벤트"));
        else
            this.dataList = this.originalList;

        if(this.order === "ASC")
            this.dataList = this.dataList.sort((a, b) => new Date(a.date) - new Date(b.date));
        else
            this.dataList = this.dataList.sort((a, b) => new Date(b.date) - new Date(a.date));

        this.calcPages();
    };

    calcPages = () =>
    {
        this.totalPage = Math.ceil(this.dataList.length / 6);
        if(this.page > this.totalPage)
            this.page = this.totalPage;

        let start = (this.page - 1) * 6;
        let end = start + 6;
        if(end > this.dataList.length)
            end = this.dataList.length;
        this.currentPageData = this.dataList.slice(start, end);

        this.drawNotices();
    }

    drawNotices = () => {
        this.tbody.innerHTML = this.currentPageData.reduce((html, item) => html += this.makeTr(item), "");

        this.pagination.innerHTML = "";
        if(this.page !== 1)
            this.pagination.appendChild(this.makePageBtn("이전", this.page - 1));

        this.pagination.appendChild(this.makePageBtn(this.page, this.page));

        if(this.page < this.totalPage)
            this.pagination.appendChild(this.makePageBtn("다음", this.page + 1));
    }

    makePageBtn = (text, pageNumber) =>{
        let div = document.createElement("div");
        div.innerHTML = `<li class="page-item"><button class="page-link" data-page="${pageNumber}">${text}</button></li>`;
        return div.firstElementChild;
    }

    makeTr = (item) =>
        `<tr>
            <td>${item.category}</td>
            <td class="table-title">${item.content}</td>
            <td>${item.date}</td>
        </tr>`


}

let notice = new NoticeApp();