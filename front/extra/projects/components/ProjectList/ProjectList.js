require("./ProjectList.tea");
const {EntityList} = require("../../../../site/components/EntityList/EntityList");

function ProjectList(props) {
    return html`<${EntityList}
        ...${props}
        class="projects-list"
        fields=${{
            id: _t('#'), 
            title: _t('Title'), 
            excerpt: _t('Short description'), 
            thumb: _t('Thumbnail')
        }}
        field_filters=${{
            thumb: (val) => {
                if (!val) return;
                return html`
                    <div class="thumb">
                        <img src=${config.base_url+"/"+val} />
                    </div>
                `;
            }
        }}
        item_actions=${{
            [_t('delete')]: function (item) { this.delete(item) },
            [_t('edit')]: function (item) { this.edit(item) }
        }}
        page_actions=${{
            [_t('new project')]: function (item) { this.edit() }
        }}
        sort_fields=${['id','page','status','created','ip']}
    />`;
}

exports.ProjectList = ProjectList;