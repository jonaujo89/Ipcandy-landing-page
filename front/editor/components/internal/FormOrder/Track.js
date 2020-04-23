const {Entity} = require("../../../../site/Entity");
const {EntityForm} = require("../../../../site/components/EntityForm/EntityForm");
const {EntityList} = require("../../../../site/components/EntityList/EntityList");

const {Form,Select,Text} = require("../../../../site/components/Form/Form");

function TrackList(props) {
    [pages,setPages] = preact.hooks.useState(false);
    preact.hooks.useEffect(() => SiteApp.fetchApi("page-list",{},setPages),[]);

    let statusLabels = {
        'new':_t('new'),
        'in_progress': _t('in progress'),
        'done': _t('done'),
        'canceled': _t('canceled')
    }

    return html`<${EntityList}
        ...${props}
        fields=${{
            id: _t('#'),
            page: _t('page'),
            status: _t('status'),
            created: _t('date'),
            ip: _t('ip addr'),
            form: _t('data')
        }}
        field_filters=${{
            page: (val,track) => track.page_title,
            status: function(val,track) {
                return html`
                    <select value=${val} onChange=${(e)=>this.change(track,{status:e.target.value})}>
                        ${Object.entries(statusLabels).map(([val,label])=>html`
                            <option value=${val}>${label}</option>
                        `)}
                    </select>
                `;
            },
            form: (val,track) => {
                return JSON.parse(val).map(({label,value})=>{
                    if (Array.isArray(value)) value = value.map((name)=>{
                        let [original_name,_] = track.files[name];
                        let download_url = config.base_url+"/api/entity-file?id="+track.id+"&name="+encodeURIComponent(name);
                        return html`<a href=${download_url}>${original_name}</a> `;
                    });
                    return html`${label}: ${value}<br />`
                });
            },
            created: (val) => {
                let date = new Date(val*1000);
                return date.toLocaleDateString()+" "+date.toLocaleTimeString();
            }
        }}
        filter_form=${html`
            <${Form} value=${{status:'new'}}>
                <${Select} name="status" style="width:auto">
                    <option value=""></option>
                    ${Object.entries(statusLabels).map(([val,label])=>html`
                        <option value=${val}>${label}</option>
                    `)}
                <//>
                <${Select} name="page" style="width:auto;max-width:200px">
                    <option value=""></option>
                    ${pages && pages.map((page)=>html`
                        <option value=${page.id}>${page.title}</option>
                    `)}
                <//>
                <${Text} name="ip" //>
            <//>
        `}
        filter_transform=${(filter)=>{
            return {
                ...filter, 
                ip: filter.ip ? "LIKE %"+filter.ip+"%" : ''
            }
        }}
        item_actions=${{
            [_t('delete')]: function (item) { this.delete(item) }
        }}
        sort_fields=${['id','page','status','created','ip']}
    />`;
}

function TrackForm(props) {
    return html`<${EntityForm}>
        <label>${_t('#')}</label>
        <${Text} name="id" readonly=${true} />
    <//>`;
}

Entity.register('track',class extends Entity {
    static get menuLabel() { return _t('Tracks') }
    static get label() { return  _t('Client track') }
    static get labelMultiple() { return _t('Client tracks') }
    static get listComponent() { return TrackList }
    static get formComponent() { return TrackForm }
});