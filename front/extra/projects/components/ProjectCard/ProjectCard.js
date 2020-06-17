const {Dialog} = require("../../../../editor/components/internal");
const marked = require('../../lib/marked');

exports.ProjectCard = ({project,block_value}) => {
    const dialog = preact.hooks.useRef(null);

    return project && html`
        <div class="col-4"> 
            <div class="item">
                <div class="item_data">
                    ${block_value.show_thumbnail && html`
                        <div class="img_wrap">
                            <div class="img">
                                <img src=${config.base_url+"/"+project.thumb} alt />
                            </div>
                        </div>
                    `}
                    <div class="name">
                        ${project.title}
                    </div>
                    ${block_value.show_desc && html`
                        <div class="desc">
                            ${project.excerpt}
                        </div>
                    `}
                </div>
                <div class="item_action">
                    <div class="btn_wrap"> 
                        <a 
                            class="btn_form blue" 
                            href="#" 
                            onClick=${(e)=>{
                                e.preventDefault();
                                dialog.current.open();
                            }}
                        >
                            ${block_value.button_text}
                        </a>
                        <${Dialog} ref=${dialog} scrollable=${true} class="projects-card-dialog" width="940" overlayColor="rgba(0,0,0,0.5)">
                            <div class="container">
                                <div class="case_header">
                                <h1 class="title"> 
                                    ${project.title}
                                </h1>
                                </div>
                                <div class="case_content">
                                    <div class="template" dangerouslySetInnerHTML=${{__html: project.text ? marked(project.text) : ''}} />
                                </div>
                            </div>
                        <//>
                    </div>
                </div>
            </div>
        </div>
    `;
}