require("./EntityList.tea");
const {Form} = require("../Form/Form");
const {Layout} = require("../../pages/Layout/Layout");

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

const EntityList = class extends Component {

    constructor(props) {
        super(props);
        this.state = {
            filter:{},
            pageNumber: 1,
            sortBy: props.sortBy,
            sortOrder: props.sortOrder,
            loading:false
        };
        if (props.filter_form) {
            this.state.filter = props.filter_form.props.value || {};
        }
    }

    reload() {
        this.setState({loading:true});
        SiteApp.fetchApi(
            "entity-list",
            {
                type:this.props.entity.id,
                p:this.state.pageNumber,
                perPage:this.props.perPage,
                sortBy:this.state.sortBy,
                sortOrder:this.state.sortOrder,
                ...this.state.filter
            },
            ({list,pageCount,pageNumber}) => this.setState({list,pageCount,pageNumber,loading:false})
        );
    }

    componentDidMount() {
        this.reload();
    }

    change(item,what) {
        Object.assign(item,what);       
        SiteApp.fetchApi(
            "entity-edit",
            {
                ...what,
                id: item.id,
                type: this.props.entity.id,
            },
            () =>  this.reload()
       );
    }

    edit(item) {
        SiteApp.redirect(this.props.entity.id+"/edit/" + (item ? item.id : ''));
    }

    delete(item) {
        SiteApp.fetchApi("entity-delete",{id:item.id},()=>this.reload())
    }

    render(props,{list,pageCount,pageNumber,sortBy,sortOrder,loading}) {
        let filterFormHash = {};
        let filterFormProps = {};
        let hasFilter = false;
        if (props.filter_form) {
            props.filter_form.props.children.forEach((child)=>{
                filterFormHash[child.props.name] = child;
            });
            hasFilter = true;
            filterFormProps = {...props.filter_form.props};
            delete filterFormProps['children'];
        }

        let hasItemActions = props.item_actions;
        let hasPageActions = props.page_actions;
        let hasExtraColumn = hasItemActions || hasFilter;

        const {entity} = props;
        return html`
            <${Layout} 
                loading=${loading}
                title=${entity.labelMultiple}
                ...${props}
            >
                ${hasPageActions && html`<div class="page-actions">
                    ${Object.entries(props.page_actions).map(([label,action])=>html`
                        <button onClick=${()=>action.call(this)}>${label}</button>${" "}
                    `)}
                </div>`}
                <${Pagination} 
                    pageNumber=${pageNumber} 
                    pageCount=${pageCount} 
                    onPage=${(i)=>this.setState({pageNumber:i},()=>this.reload())} 
                />
                <div class="entity-list">
                    <div class="tr">
                        ${Object.entries(props.fields).map(([field,field_title])=>html`
                            <div class="th">
                                ${props.sort_fields.indexOf(field)!=-1 && html`
                                    <a href="#" class="sort-field ${ sortBy==field ? sortOrder:'' }" onClick=${(e)=>{
                                        e.preventDefault();
                                        if (sortBy==field) {
                                            this.setState({sortOrder:sortOrder=='ASC'?'DESC':'ASC',pageNumber:1},()=>this.reload());
                                        } else {
                                            this.setState({sortBy:field,sortOrder:'ASC',pageNumber:1},()=>this.reload());
                                        }
                                    }}>
                                        ${field_title}
                                    </a>
                                `}
                                ${props.sort_fields.indexOf(field)==-1 && html`
                                    ${field_title}
                                `}
                            </th>
                        `)}
                        ${hasExtraColumn && html`<div class="th"></div>`}
                    </div>
                    ${hasFilter && html`
                        <${Form} ...${filterFormProps} value=${this.state.filter} class="tr entity-list-filter" onSubmit=${(e,value)=>{
                            let filter = props.filter_transform(value);
                            this.setState({filter,pageNumber:1},()=>this.reload());
                        }}>
                            ${Object.entries(props.fields).map(([field,field_title])=>html`
                                <div class="th">${filterFormHash[field] || ''}</div>
                            `)}
                            <div class="th">
                                <button type="submit">${_t('filter')}</button>
                            </div>
                        <//>
                    `}
                    ${!!list && list.map((item)=>html`
                        <div class="tr">
                            ${Object.entries(props.fields).map(([field,field_title])=>html`
                                <div class="td">
                                    ${props.field_filters[field] ? 
                                        props.field_filters[field].call(this,item[field],item) 
                                        : 
                                        item[field]
                                    }
                                </div>
                            `)}
                            ${hasExtraColumn && html`<div class="td">
                                ${Object.entries(props.item_actions).map(([label,action])=>html`
                                    <button onClick=${()=>action.call(this,item)}>${label}</button>${" "}
                                `)}
                            </div>`}
                        </div>
                    `)}
                </div>
            <//>
        `;
    }
}

EntityList.defaultProps = {
    fields: {'id':_t('#')},
    field_filters: {},
    filter_form: false,
    filter_transform: (filter)=>filter,
    perPage: 10,
    page_actions: false,
    item_actions: {},
    sort_fields: [],
    sortBy: 'id',
    sortOrder: 'DESC'
}
exports.EntityList = EntityList;