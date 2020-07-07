require('./Pagination.tea');

const Pagination = ({onPage,pageCount,pageNumber}) => {
    let paginationPages = [];
    let prev = 0;
    let around = 5;
    for (let i=1;i<=pageCount;i++) {
        if (Math.abs(i-pageNumber)>around && pageCount!=i && 1!=i) continue;
        if (i-prev>1) paginationPages.push(html`<li> ... </li>`);
        prev = i;

        if (pageNumber==i)
            paginationPages.push(html`<li class="current">${i}</li>`);
        else
            paginationPages.push(html`<li><a href="#" onClick=${(e)=>{
                e.preventDefault();
                onPage && onPage(i);
            }}>${i}</a></li>`);
    }
    if (paginationPages.length==1) paginationPages = [];
    return html`
        <div class="pagination">
            <ul>${paginationPages}</ul>
        </div>
    `;
}

exports.Pagination = Pagination;